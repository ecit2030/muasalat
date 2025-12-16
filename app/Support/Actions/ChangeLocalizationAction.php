<?php

namespace App\Support\Actions;

use App\Http\Resources\Api\General\LanguageRecourse;
use App\Support\Api\ApiResponse;
use Modules\Language\Models\Language;

class ChangeLocalizationAction
{
    use ApiResponse;

    public function __invoke($code = null)
    {
        $language = Language::where('code', $code)->firstOrFail();

        session()->put([
            'language.code' => data_get($language, 'code', 'ar'),
            'language.rtl' => data_get($language, 'rtl', true),
            'language.direction' => data_get($language, 'direction', 'rtl'),
        ]);
        if (activeGuard()) {
            auth(activeGuard())->user()?->info()->updateOrCreate([], ['language_code' => data_get($language, 'code', 'en')]);
        }
        self::apiCode(200)->apiMessage(t_('Language changed successfully'))
            ->apiBody(['language' => LanguageRecourse::make($language)]);

        return request()->wantsJson() ? self::apiResponse() : redirect()->back();
    }

    public function index()
    {
        self::apiCode(200)->apiMessage(t_('success get language list data'))
            ->apiBody(['languages' => LanguageRecourse::collection(Language::all())]);

        return self::apiResponse();
    }

    public function translationList()
    {
        if (file_exists(lang_path('/').get_current_lang().'.json')) {
            self::apiCode(200)->apiMessage(t_('success get translation list'));
        }

        return self::apiResponse();
    }
}
