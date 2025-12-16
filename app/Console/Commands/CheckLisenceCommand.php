<?php

namespace App\Console\Commands;

use App\Classes\FCMAction;
use App\Classes\FCMTopic;
use App\Models\User;
use App\Notifications\FcmNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Modules\Vehicle\Models\UserVehicle;

class CheckLisenceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lisence:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check cars & drivers and captains for lisences .';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // driver lisence ends //
        $this->drivers();

        // captain lisence ends //
        $this->captains();

        // cars liscens end //
        $this->cars();
    }



    private function drivers()
    {
        $drivers = User::role("driver")->where("driver_license_end_date", "<", carbon::now()->today())->get();

        foreach ($drivers as $driver) {
            $tokens = $driver->driverOrg->sendableTokens;
            $driver->driverOrg->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.your_driver_lisence_is_expired") . " " . $driver->name ,FCMTopic::DRIVER_LICENCE_EXPIRED,FCMAction::DRIVER_CHANGE_LICENCE_DATE));
        }

    }

    private function captains()
    {
        $captains = User::role("captain")->where("driver_license_end_date", "<", carbon::now()->today())->with("deviceTokens")->get();

        foreach ($captains as $captain) {
            $tokens = $captain->sendableTokens ;
            $captain->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.your_lisence_is_expired"),FCMTopic::DRIVER_LICENCE_EXPIRED,FCMAction::DRIVER_CHANGE_LICENCE_DATE));
        }
    }

    private function cars()
    {
        $cars = UserVehicle::expiredLisences()->with([
            "user.drivers" => function ($q) {
                return $q->role("moderator")->with("deviceTokens");
            }, "user.deviceTokens"
        ])->get();

        foreach ($cars as $car) {
            $tokens = [$car->pluck("deviceTokens"), $car->pluck("drivers.deviceTokens")];
            $tokens = collect(spread($tokens))->unique("token")->pluck("token");
            $car->user->notify(new FcmNotification($tokens, t_("messages.you_have_new_notification"), t_("messages.your_car_lisence_is_expired") . " " . $car->vehicle_number . " " . $car->vehicle_letter,FCMTopic::DRIVER_LICENCE_EXPIRED,FCMAction::DRIVER_CHANGE_LICENCE_DATE));
        }
    }
}
