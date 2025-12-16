<?php

namespace Database\Seeders;

use App\Enums\General\RolesEnum;
use App\Models\Module;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        \Artisan::call('permission:cache-reset');
        $this->setupPermissions();
        $this->createPermission();
        //
        $this->setupRoles();
        $this->setupUsers();
    }

    private function setupUsers()
    {
        Auth::shouldUse('dashboard');
        tap(User::updateOrCreate(['email' => 'admin@admin.com'], [
            'name'     => 'Super Admin',
            'email'    => 'super@admin.com',
            'is_active'   => true,
            'password' => Hash::make("hkc9Mj97ge0R"),
        ]))->assignRole([
            RolesEnum::mainadmin()->value,
            RolesEnum::admin()->value,
            RolesEnum::super()->value,
        ]);


        tap(User::updateOrCreate(['email' => 'admin@admin.com'], [
            'name'     => 'Admin',
            'email'    => 'admin@admin.com',
            'is_active'   => true,
            'password' => Hash::make("hkc9Mj97ge0R"),
        ]))->assignRole([
            RolesEnum::mainadmin()->value,
            RolesEnum::admin()->value,
        ]);
        echo 'Admins Created Successfully' . PHP_EOL;
    }

    private function setupRoles()
    {
        $orgPermissions = User::orgPermissions;
        $adminPermissions = User::adminPermissions;
        $moderatorPermissions = User::moderatorPermissions;
        Role::query()->delete();
        $roles = collect(RolesEnum::toArray())
            ->transform(fn ($i) => ['name' => $i, 'guard_name' => 'dashboard'])
            ->toArray();

        Role::insert($roles);
        Role::findByName('super', 'dashboard')
            ->permissions()->sync(Permission::where('guard_name', 'dashboard')->pluck('id'));

        Role::findByName('mainadmin', 'dashboard')
            ->permissions()->sync(
                Permission::where(function ($q) use ($adminPermissions) {
                    foreach ($adminPermissions as $permission) {
                        $q->where("name", "!=", $permission);
                    }
                })->pluck('id')
            );

        Role::findByName('organization', 'dashboard')
            ->permissions()->sync(
                Permission::where(function ($q) use ($orgPermissions) {
                    $q->where("name", "LIKE", '%' . array_keys($orgPermissions)[0]);
                    foreach ($orgPermissions as $key => $value) {
                        $q->orWhere("name", "LIKE", '%' . $key);
                        foreach ($value as $permission) {
                            $q->where("name", "!=", $permission . "_" . $key);
                        }
                    }
                })->pluck('id')
            );

        Role::findByName('moderator', 'dashboard')
            ->permissions()->sync(
                Permission::where(function ($q) use ($moderatorPermissions) {
                    $q->where("name", "LIKE", '%' . array_keys($moderatorPermissions)[0]);
                    foreach ($moderatorPermissions as $key => $value) {
                        $q->orWhere("name", "LIKE", '%' . $key);
                        foreach ($value as $permission) {
                            $q->where("name", "!=", $permission . "_" . $key);
                        }
                    }
                })->pluck('id')
            );

        echo 'Roles Created Successfully' . PHP_EOL;
    }

    public function setupPermissions()
    {
        $ds = DIRECTORY_SEPARATOR;
        $modules_model = glob(app_path() . '/Modules/**/Models');
        $modelPath = [];
        foreach ($modules_model as $modelsPath) {
            foreach (array_diff(scandir($modelsPath), ['..', '.']) as $file) {
                $modelPath[] = $file;
            }
        }

        // dd($modelPath);

        Permission::truncate();
        Module::truncate();
        $guard_name = 'dashboard';
        $scanned_directory = collect([]);
        $scanned_directory = collect(array_diff(scandir(__DIR__ . "$ds..$ds..{$ds}app{$ds}Models"), ['..', '.']));
        $scanned_directory = $scanned_directory->push('Administration');

        foreach ($modelPath as $modelPath) {
            $scanned_directory = $scanned_directory->push($modelPath);
        }

        // $scanned_directory = $scanned_directory->push('Administration', 'ActivityLog', 'Translation', 'Analyse');
        $this->createPermissions($scanned_directory, $guard_name);
    }

    private function createPermissions($scanned_directory, $guard_name)
    {
        // dd($scanned_directory);
        foreach ($scanned_directory as $File) {

            $model_name = basename($File, '.php');
            $this->addNewPermission($model_name);
            if ($this->addModelToPermission($model_name) || !strpos($File, '.php')) {
                $model_name = Str::snake($model_name);
                // Fetch Models
                $fetch_module = Module::Create([
                    'title'      => $model_name,
                    'guard_name' => $guard_name,
                ]);
                $fetch_module->permissions()->createMany([
                    [
                        'name'       => 'notification_' . strtolower($model_name),
                        'title'      => 'Notification',
                        'guard_name' => $guard_name,
                    ],
                    [
                        'name'       => 'view_' . strtolower($model_name),
                        'title'      => 'View',
                        'guard_name' => $guard_name,
                    ],
                    [
                        'name'       => 'create_' . strtolower($model_name),
                        'title'      => 'Create',
                        'guard_name' => $guard_name,
                    ],
                    [
                        'name'       => 'edit_' . strtolower($model_name),
                        'title'      => 'Edit',
                        'guard_name' => $guard_name,
                    ],

                    [
                        'module_id'  => $fetch_module['id'],
                        'name'       => 'delete_' . strtolower($model_name),
                        'title'      => 'Delete',
                        'guard_name' => $guard_name,
                    ],
                ]);
            }
        }
    }

    private function addModelToPermission($modelName)
    {
        $baseModel = "\App\\Models\\$modelName";
        $VehicleClass = "\App\\Modules\\Vehicle\\Models\\{$modelName}";

        if (class_exists($baseModel)) {
            $class = $baseModel;
        } elseif (class_exists($VehicleClass)) {
            $class = $VehicleClass;
        }

        if (isset($class) && app($class)->addToPermission) {
            return app($class)->addToPermission;
        }

        return false;
    }

    private function addNewPermission($modelName)
    {
        $ds = DIRECTORY_SEPARATOR;
        $modelName = Str::snake($modelName);
        $permissionPath = app_path("Enums{$ds}General{$ds}DashboardPermissionsEnum.php");
        $search = '/**';
        $line_number = false;

        if ($handle = fopen($permissionPath, 'r')) {
            $count = 0;
            while (($line = fgets($handle, 4096)) !== false and !$line_number) {
                $count++;
                $line_number = (strpos($line, $search) !== false) ? $count : $line_number;
            }
            fclose($handle);
        }

        $lines = file($permissionPath, FILE_IGNORE_NEW_LINES);

        $newLine = [" * @method static self {$modelName}()"];
        $searchIfExist = array_search(" * @method static self {$modelName}()", $lines, true);
        if ($searchIfExist == false) {
            array_splice($lines, $line_number + 1, 0, $newLine);
            file_put_contents($permissionPath, implode("\n", $lines));
        }
    }

    private function createPermission()
    {
        $permissions = [
            "vehicle_request", "vehicle", "user_vehicle", "organization", "organization_request", "captain", "captain_request", "static_page", "driver", "notification"
        ];

        $guard_name = "dashboard";
        foreach ($permissions as $permission) {
            # code...

            $fetch_module = Module::Create([
                'title'      => $permission,
                'guard_name' => $guard_name,
            ]);
            $fetch_module->permissions()->createMany([
                [
                    'name'       => 'notification_' . strtolower($permission),
                    'title'      => 'Notification',
                    'guard_name' => $guard_name,
                ],
                [
                    'name'       => 'view_' . strtolower($permission),
                    'title'      => 'View',
                    'guard_name' => $guard_name,
                ],
                [
                    'name'       => 'create_' . strtolower($permission),
                    'title'      => 'Create',
                    'guard_name' => $guard_name,
                ],
                [
                    'name'       => 'edit_' . strtolower($permission),
                    'title'      => 'Edit',
                    'guard_name' => $guard_name,
                ],

                [
                    'module_id'  => $fetch_module['id'],
                    'name'       => 'delete_' . strtolower($permission),
                    'title'      => 'Delete',
                    'guard_name' => $guard_name,
                ],
            ]);
        }
    }
}
