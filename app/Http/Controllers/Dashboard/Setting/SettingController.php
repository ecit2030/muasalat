<?php

namespace App\Http\Controllers\Dashboard\Setting;

use App\Events\ChangePriceEvent;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Requests\Dashboard\Setting\ApiSettingRequest;
use App\Http\Requests\Dashboard\Setting\EmailSettingRequest;
use App\Http\Requests\Dashboard\Setting\EmergencyNumberRequest;
use App\Http\Requests\Dashboard\Setting\GeneralSettingRequest;
use App\Http\Requests\Dashboard\Setting\MediaSettingRequest;
use App\Http\Requests\Dashboard\Setting\PriceRequest;
use App\Http\Requests\Dashboard\Setting\SocialSettingRequest;
use App\Http\Requests\Dashboard\Setting\StyleSettingRequest;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;

class SettingController extends DashboardController
{
    protected string $routeName = 'dashboard.setting';

    protected string $model = Setting::class;

    public function index()
    {
        $route = $this->routeName;

        //general
        $general = setting('general');

        //emails
        $emails = setting('emails');
        $media = setting('media');
        $social = setting('social');

        //api keys
        $api_keys = setting('api_keys');
        $page_name = t_('Settings');

        $searchRange = setting('searchRange');
        $tax = setting('tax');
        $appPercentage = setting('appPercentage');
        $timeRange = setting('timeRange');
        $captain_accept_reject_time = setting('captain_accept_reject_time');
        $client_trip_payment_time_before_cancel = setting('client_trip_payment_time_before_cancel');
        $price = setting('price');
        $numbers = setting('numbers');

        return view('dashboard.settings.index', get_defined_vars());
    }

    public function generalSubmit(GeneralSettingRequest $request)
    {
        cache()->clear();
        Setting::updateOrcreate(
            ['key' => 'general'],
            ['value' => $request->validated('general')]
        );
        Cache::forget('settings');
        toast(t_('general updated successfully'), 'success');

        return redirect()->route('dashboard.setting.index', ['general']);
    }

    public function priceSubmit(PriceRequest $request)
    {
        cache()->clear();

        $price = setting('price');

        $sendNotification = false;
        if ($price) {
            foreach (array_keys($request->validated()["price"]) as $value) {
                $check = $request->validated()["price"][$value] == data_get($price, $value);
                if (!$check) {
                    $sendNotification = true;
                    break;
                }
            }
        }

        Setting::updateOrcreate(
            ['key' => 'price'],
            ['value' => $request->validated('price')]
        );

        Cache::forget('settings');
        toast(t_('price updated successfully'), 'success');

        if ($sendNotification) {
            $prices = $request->validated()["price"];
            event(new ChangePriceEvent(
                $prices["other_min"],
                $prices["other_max"],
                $prices["talebat_min"],
                $prices["talebat_max"],
            ));
        }

        return redirect()->route('dashboard.setting.index', ['price']);
    }

    public function mediaSubmit(MediaSettingRequest $request)
    {
        cache()->clear();
        //old settings
        $logos_model = Setting::firstOrCreate(['key' => 'media']);
        $media = $logos_model->value;

        request('media.white_site_logo') && $media['white_site_logo']['url'] = uploadMedia(
            'white_site_logo',
            request('media.white_site_logo'),
            $logos_model
        )?->getFullUrl();
        request('media.dark_site_logo') && $media['dark_site_logo']['url'] = uploadMedia(
            'dark_site_logo',
            request('media.dark_site_logo'),
            $logos_model
        )?->getFullUrl();

        request('media.white_dashboard_logo') && $media['white_dashboard_logo']['url'] = uploadMedia(
            'white_dashboard_logo',
            request('media.white_dashboard_logo'),
            $logos_model
        )?->getFullUrl();
        request('media.dark_dashboard_logo') && $media['dark_dashboard_logo']['url'] = uploadMedia(
            'dark_dashboard_logo',
            request('media.dark_dashboard_logo'),
            $logos_model
        )?->getFullUrl();

        request('media.white_preloader') && $media['white_preloader']['url'] = uploadMedia(
            'white_preloader',
            request('media.white_preloader'),
            $logos_model
        )?->getFullUrl();
        request('media.dark_preloader') && $media['dark_preloader']['url'] = uploadMedia(
            'dark_preloader',
            request('media.dark_preloader'),
            $logos_model
        )?->getFullUrl();

        request('media.white_fav_icon') && $media['white_fav_icon']['url'] = uploadMedia(
            'white_fav_icon',
            request('media.white_fav_icon'),
            $logos_model
        )?->getFullUrl();
        request('media.dark_fav_icon') && $media['dark_fav_icon']['url'] = uploadMedia(
            'dark_fav_icon',
            request('media.dark_fav_icon'),
            $logos_model
        )?->getFullUrl();

        request('media.login_page_background') && $media['login_page_background']['url'] = uploadMedia(
            'login_page_background',
            request('media.login_page_background'),
            $logos_model
        )?->getFullUrl();

        //update reports logo
        if (request('media.white_email_logo') instanceof UploadedFile) {
            $media['white_email_logo']['base64'] = base64_encode(file_get_contents(request('media.white_email_logo')));
            $media['white_email_logo']['url'] = uploadMedia('white_email_logo', request('media.white_email_logo'), $logos_model)->getFullUrl();
        }

        //update reports logo
        if (request('media.dark_email_logo') instanceof UploadedFile) {
            $media['dark_email_logo']['base64'] = base64_encode(file_get_contents(request('media.dark_email_logo')));
            $media['dark_email_logo']['url'] = uploadMedia('dark_email_logo', request('media.dark_email_logo'), $logos_model)->getFullUrl();
        }

        Setting::updateOrcreate(
            ['key' => 'media'],
            ['value' => $media]
        );
        Cache::forget('settings');

        toast(t_('media updated successfully'), 'success');

        return redirect()->route('dashboard.setting.index');
    }

    public function socialSubmit(SocialSettingRequest $request)
    {
        cache()->clear();
        Setting::updateOrcreate(
            ['key' => 'social'],
            ['value' => $request->validated('social')]
        );
        Cache::forget('settings');
        toast(t_('social updated successfully'), 'success');

        return redirect()->route('dashboard.setting.index');
    }

    public function emregencySubmit(EmergencyNumberRequest $request)
    {

        cache()->clear();
        Setting::updateOrcreate(
            ['key' => 'numbers'],
            ['value' => $request->numbers]
        );
        Cache::forget('settings');
        toast(t_('emergency updated successfully'), 'success');

        return redirect()->route('dashboard.setting.index');
    }

    public function emailsSubmit(EmailSettingRequest $request)
    {
        cache()->clear();

        Setting::updateOrcreate(
            ['key' => 'emails'],
            ['value' => $request->validated('emails')]
        );
        Cache::forget('settings');

        toast(t_('email setting updated successfully'), 'success');

        return redirect()->route('dashboard.setting.index');
    }

    public function apiKeysSubmit(ApiSettingRequest $request)
    {
        cache()->clear();

        Setting::updateOrcreate(
            ['key' => 'api_keys'],
            ['value' => $request->validated('api_keys')]
        );
        Cache::forget('settings');

        toast(t_('social updated successfully'), 'success');

        return redirect()->route('dashboard.setting.index');
    }

    public function styleSubmit(StyleSettingRequest $request)
    {
        cache()->clear();
        $style_setting = Setting::where('key', 'style')->where('created_by', get_current_login())->first();
        if ($style_setting) {
            $style = $style_setting->value;
            if (isset($style[$request->type])) {
                if ($request->type === 'dark_mode') {
                    $style['dark_mode'] ? $style['dark_mode'] = false : $style['dark_mode'] = true;
                    $style_setting->update([
                        'value' => $style,
                    ]);
                    $data = ['success' => true, 'message' => t_('Mode_changed')];
                }
            } else {
                $style[$request->type] = true;
                $style_setting->update([
                    'value' => $style,
                ]);
            }
            $data = ['success' => true, 'message' => t_('Mode_changed')];
        } else {
            Setting::create([
                'key' => 'style',
                'created_by' => get_current_login(),
                'value' => [],
            ]);

            $data = ['success' => true, 'message' => t_('Style_array_Added_Successful')];
        }
        Cache::forget('settings');
        cache()->set('setting_style_' . auth(activeGuard())->id(), $style_setting);

        return response()->json($data, 200);
    }

    public function videoSubmit(MediaSettingRequest $request)
    {
        cache()->clear();
        //old settings
        $logos_model = Setting::firstOrCreate(['key' => 'media']);
        $video = $logos_model->value;

        request('video.intro') && $video['video']['intro'] = uploadMedia(
            'intro',
            request('video.intro'),
            $logos_model
        )?->getFullUrl();

        Setting::updateOrcreate(
            ['key' => 'video'],
            ['value' => $video]
        );
        Cache::forget('settings');

        toast(t_('video intro updated successfully'), 'success');

        return redirect()->route('dashboard.setting.index');
    }
}
