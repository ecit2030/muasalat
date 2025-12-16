<?php

use App\Models\TemporaryUpload;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\PersonalAccessToken;
use Modules\Translation\Models\Translation;

if (!function_exists('dotted_string')) {
    function dotted_string(string $name): string
    {
        if ($name === '') {
            return $name;
        }

        $base = str_replace(['[', ']'], ['.', ''], $name);
        if ($base[strlen($base) - 1] === '.') {
            return substr($base, 0, -1);
        }

        return $base;
    }
}

if (!function_exists('uploadMedia')) {
    function uploadMedia($name, $file, ?Model $model)
    {
        if ($file instanceof UploadedFile) {
            $model?->clearMediaCollection($name);

            return $model->addMedia($file)->toMediaCollection($name);
        }
    }
}

if (!function_exists('moveTempMedia')) {
    function moveTempMedia($collections_name, ?Model $toModel, $newCollectionName, $disk = 'public')
    {
        if (is_array($collections_name)) {
            foreach ($collections_name as $collection_name) {
                $array_id_collection = explode('|', $collection_name);
                if (is_array($array_id_collection) && count($array_id_collection) === 2) {
                    $fromModel = TemporaryUpload::findOrFail($array_id_collection[0]);
                    $mediaItem = $fromModel->getMedia($array_id_collection[1])->first();
                    $mediaItem && $mediaItem->move($toModel, $newCollectionName, $disk);
                    $mediaItem && $fromModel->clearMediaCollection($collection_name);
                }
            }
        }
        if (is_string($collections_name)) {
            $array_id_collection = explode('|', $collections_name);
            if (is_array($array_id_collection) && count($array_id_collection) === 2) {
                $fromModel = TemporaryUpload::findOrFail($array_id_collection[0]);
                $mediaItem = $fromModel->getMedia($array_id_collection[1])->first();
                $mediaItem && $mediaItem->move($toModel, $newCollectionName, $disk);
                $mediaItem && $fromModel->clearMediaCollection($collections_name);
            }
        }
    }
}


if (!function_exists('edit_separator')) {
    function edit_separator($path): array|string
    {
        return str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);
    }
}

if (!function_exists('locale_field')) {
    function locale_field(string $name, $locale = 'ar'): ?string
    {
        if ($model = Form::getModel()) {
            return $model->getTranslation($name, $locale);
        }

        return old("{$name}.{$locale}");
    }
}

if (!function_exists('toMap')) {
    function toMap(Traversable $iterator, string $key = 'id', string $value = 'name'): array
    {
        $result = [];
        foreach ($iterator as $item) {
            $result[$item[$key]] = $item[$value];
        }

        return $result;
    }
}

if (!function_exists('toMaps')) {
    function toMaps(Traversable $iterator, string $key = 'id', string $value1 = 'name', string $value2 = 'name'): array
    {
        $result = [];
        if ($iterator) {
            foreach ($iterator as $item) {
                $result[$item[$key]] = [$item[$value1], $item[$value2]];
            }
        }

        return $result;
    }
}
if (!function_exists('spread')) {
    function spread($iterator): array
    {
        $result = [];
        foreach ($iterator as $item) {
            if (is_iterable($item)) {
                $data = spread($item);
                $result = array_merge($result, $data);
            } else {
                $result[] = $item;
            }
        }

        return $result;
    }
}


//get Data With no style
if (!function_exists('remove_style')) {
    function remove_style($data)
    {
        return preg_replace('/(<[^>]+) style=".*?"/i', '$1', strip_tags($data));
    }
}

if (!function_exists('route_group')) {
    function route_group(string|array $prefix, callable $callback): void
    {
        $prefixValue = is_array($prefix) ? $prefix['prefix'] : $prefix;
        $as = Str::of($prefixValue)->snake()->lower()->append('.');
        $namespace = Str::of($prefixValue)->singular()->studly();
        $middleware = [];

        if (is_array($prefix)) {
            $as = $prefix['as'] ?? $as;
            $namespace = $prefix['namespace'] ?? $namespace;
            $middleware = $prefix['middleware'] ?? $middleware;
        }

        \Illuminate\Support\Facades\Route::group([
            'prefix' => $prefixValue,
            'as' => $as,
            'namespace' => $namespace,
            'middleware' => $middleware,
        ], $callback);
    }
}

if (!function_exists('t_')) {
    function t_(
        $Line,
        array $replace = [],
        $locale = null
    ): array|string|\Illuminate\Contracts\Translation\Translator|\Illuminate\Contracts\Foundation\Application|null
    {
        $Line = Str::lower($Line);

        if (config('custom.APP_HZ_TRANSLATION', false)) {
            $default = preg_replace('/[^a-zA-Z0-9-:-]/', ' ', $Line);

            $check = Translation::where('key', '=', $Line)->first();

            if ($check === null && $Line !== null && $Line !== '') {
                Translation::create([
                    'key' => $Line,
                    'default' => '<p class="text-blue" >' . $default . '</p>',
                    'en' => $default,
                    't_' => [],
                ]);

                return $Line;
            }
        }

        return trans($Line, $replace, $locale);
    }
}

// Active Guard Function
if (!function_exists('activeGuard')) {
    function activeGuard($guard = null): bool|int|string|null
    {
        if ($guard) {
            return auth($guard)->check();
        }
        foreach (array_keys(config('auth.guards')) as $grd) {
            if (auth()->guard($grd)->check()) {
                return $grd;
            }
        }

        return null;
    }
}

//get json setting as array
if (!function_exists('setting')) {
    function setting($key, $value = null, $default = null)
    {
        if ($value) {
            return data_get((new App\Support\Helper\Setting())->$key, $value, $default);
        }

        return (new App\Support\Helper\Setting())->$key;
    }
}

if (!function_exists('get_current_lang')) {
    function get_current_lang()
    {
        return App::getLocale();
    }
}


if (!function_exists('requestLang')) {
    function requestLang()
    {
        return request()->hasHeader('Accept-Language') ?
            request()->header('Accept-Language') :
            App::getLocale();
    }
}


if (!function_exists('get_current_login')) {
    function get_current_login()
    {
        return auth(activeGuard())->id();
    }
}

if (!function_exists('getPaginates')) {
    function getPaginates($collection, $name = "data")
    {
        return [
            $name => $collection,
            'per_page' => $collection->perPage(),
            'path' => $collection->path(),
            'total' => $collection->total(),
            'current_page' => $collection->currentPage(),
            'next_page_url' => $collection->nextPageUrl(),
            'previous_page_url' => $collection->previousPageUrl(),
            'last_page' => $collection->lastPage(),
            'has_more_pages' => $collection->hasMorePages(),
        ];
    }
}

if (!function_exists('sendResponse')) {
    function sendResponse($result = null, $message = null)
    {


        $response['status'] = true;
        $response['code'] = 200;

        if (!is_null($result))
            $response['data'] = $result;

        if (!is_null($message))
            $response['message'] = $message;

        return response()->json($response, 200);
    }
}

if (!function_exists('sendError')) {
    function sendError($error, $errorMessages = [], $code = 400)
    {
        $response = [
            "code" => $code,
            'status' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}


if (!function_exists('user')) {
    function user()
    {
        try {
            [$id, $token] = explode('|', request()->header('Authorization'), 2);
            return (PersonalAccessToken::findToken($token)->tokenable);
        } catch (Exception $e) {
            return false;
        }
    }
}