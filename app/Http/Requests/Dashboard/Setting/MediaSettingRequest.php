<?php

namespace App\Http\Requests\Dashboard\Setting;

use App\Support\Traits\ValidationRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class MediaSettingRequest extends FormRequest
{
    use ValidationRequest;

    public function rules()
    {
        return [
            'media' => 'array',
            'media.email_logo' => 'nullable|mimes:png|dimensions:max_width=1000,max_height=1000',
            'media.site_logo' => 'nullable|mimes:png|dimensions:max_width=1000,max_height=1000',
            'media.dashboard_logo' => 'nullable|mimes:png|dimensions:max_width=1000,max_height=1000',
            'media.preloader' => 'nullable|mimes:png|dimensions:max_width=1000,max_height=1000',
            'media.fav_icon' => 'nullable|mimes:png|dimensions:max_width=1000,max_height=1000',
            'media.login_page_background' => 'nullable|mimes:png|dimensions:max_width=1000,max_height=1000',
            'media.dark_site_logo' => 'nullable|mimes:png|dimensions:max_width=1000,max_height=1000',
            'media.white_dashboard_logo' => 'nullable|mimes:png|dimensions:max_width=1000,max_height=1000',
            'media.dark_dashboard_logo' => 'nullable|mimes:png|dimensions:max_width=1000,max_height=1000',
            'media.white_preloader_logo' => 'nullable|mimes:png|dimensions:max_width=1000,max_height=1000',
            'media.dark_preloader_logo' => 'nullable|mimes:png|dimensions:max_width=1000,max_height=1000',
            'media.white_fav_icon' => 'nullable|mimes:png|dimensions:max_width=1000,max_height=1000',
            'media.dark_fav_icon' => 'nullable|mimes:png|dimensions:max_width=1000,max_height=1000',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {

            if ($validator->errors()) {
                return redirect()->back()->withErrors($validator);
            }
        });
    }


    public function messagesAction(): array
    {
        return [
            'media.white_email_logo.mimes.png' => t_('email logo must be png image'),
            'media.white_email_logo.dimensions' => t_('email logo must be max height 1000px and max width 1000px'),
            'media.dark_email_logo.mimes.png' => t_('email logo must be png image'),
            'media.dark_email_logo.dimensions' => t_('email logo must be max height 1000px and max width 1000px'),

            'media.white_site_logo.mimes.png' => t_('website logo must be png image'),
            'media.white_site_logo.dimensions' => t_('site logo must be max height 1000px and max width 1000px'),
            'media.dark_site_logo.mimes.png' => t_('website logo must be png image'),
            'media.dark_site_logo.dimensions' => t_('site logo must be max height 1000px and max width 1000px'),

            'media.white_dashboard_logo.mimes.png' => t_('dashboard logo must be png image'),
            'media.white_dashboard_logo.dimensions' => t_('dashboard logo must be max height 1000px and max width 1000px'),
            'media.dark_dashboard_logo.mimes.png' => t_('dashboard logo must be png image'),
            'media.dark_dashboard_logo.dimensions' => t_('dashboard logo must be max height 1000px and max width 1000px'),

            'media.white_preloader_logo.mimes.png' => t_('dashboard logo must be png image'),
            'media.white_preloader_logo.dimensions' => t_('preloader logo must be max height 1000px and max width 1000px'),
            'media.dark_preloader_logo.mimes.png' => t_('dashboard logo must be png image'),
            'media.dark_preloader_logo.dimensions' => t_('preloader logo must be max height 1000px and max width 1000px'),

            'media.white_fav_icon.mimes.png' => t_('dashboard logo must be png image'),
            'media.white_fav_icon.dimensions' => t_('fav icon must be max height 1000px and max width 1000px'),
            'media.dark_fav_icon.mimes.png' => t_('dashboard logo must be png image'),
            'media.dark_fav_icon.dimensions' => t_('fav icon must be max height 1000px and max width 1000px'),

            'media.login_page_background.mimes.png' => t_('dashboard logo must be png image'),
            'media.login_page_background.dimensions' => t_('fav icon must be max height 1000px and max width 1000px'),

        ];
    }
}
