<?php

namespace App\Support\Traits;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

trait ValidationRequest
{
    public function authorize()
    {
        return true;
    }

    public function messagesAction(): array
    {
        return [];
    }

    public function messages()
    {
        return array_merge([
            'vehicle_ensurance.required' => t_('the vehicle ensurance field required.'),
            'vehicle_license.required' => t_('the vehicle license field required.'),
            'vehicle_form.required' => t_('the vehicle form field required.'),
            'periodic_end_date.required' => t_('the periodic end date field required.'),
            'ensurance_end_date.required' => t_('the ensurance end date field required.'),
            'license_end_date.required' => t_('the license end date field required.'),
            'ussid_number.required' => t_('the ussid number field required.'),
            'ussid.required' => t_('the ussid field required.'),
            'driver_license.required' => t_('the driver license field required.'),
            'vehicle_letter.required' => t_('the vehicle letter field required.'),
            'vehicle_number.required' => t_('the vehicle number field required.'),
            'driver_license_number.required' => t_('the driver license number field required.'),
            'vehicle_year_id.required' => t_('the vehicle year id field required.'),
            'color.required' => t_('the color field required.'),
            'vehicle_periodic.required' => t_('the vehicle periodic field required.'),
            'date_of_birth.required' => t_('the date of birth field required.'),
            'name.ar.required' => t_('the name in arabic field required.'),
            'name.en.required' => t_('the name in english field required.'),
            'name.ar.string' => t_('the name in arabic field must be string.'),
            'name.en.string' => t_('the name field must be string.'),
            'capacity.required' => t_('the capacity field required.'),
            'avatar.required' => t_('the avatar field required.'),

            'user_vehicle_id.required' => t_('the user vehicle id field required.'),
            'driver_id.required' => t_('the driver id field required.'),
            'repeat.required' => t_('the repeat field required.'),

            'track_id.required' => t_('the track field required.'),
            'valid_till.required' => t_('the valid till field required.'),
            'quota.required' => t_('the quota field required.'),
            'type_of_estimation.required' => t_('the type of estimation field required.'),





            'bank_name.required' => t_('the bank name field required.'),
            'organization_name.required' => t_('the organization name field required.'),
            'organization_commercial_number.required' => t_('the organization commercial number field required.'),
            'bank_personal_id.required' => t_('the bank personal id field required.'),
            'iban.required' => t_('the iban field required.'),

            'name.required' => t_('the name field required.'),
            'name.string' => t_('the name field must be string.'),
            'phone.required' => t_('the phone number field required.'),
            'owner.array' => t_('the title must be array.'),
            'owner.*.required' => t_('the :attribute field required.'),
            'owner.*.email' => t_('the :attribute field must be email.'),

            'name.unique' => t_('the name field has already been taken.'),
            'phone.unique' => t_('the phone number field has already been taken.'),
            'phone.exists' => t_('the phone number not found'),
            'phone.phone' => t_('the phone number field does not contain an invalid number.'),

            'email.required' => t_('the email field required.'),
            'email.unique' => t_('the email has already been taken.'),
            'email.email' => t_('the email must be a valid email.'),
            'email.exists' => t_('this email not found.'),

            'password.required' => t_('the password field required.'),
            'password.string' => t_('the password field must be string.'),
            'password.min:4' => t_('the password field must not be less than 4 characters.'),
            'password.confirmed' => t_('the password field must be confirmed.'),
            'account_type.required' => t_('the account type field required.'),
            'account_type.in' => t_('the account type field Not Valid Type.'),
            'country.array' => t_('the country field required.'),
            'company_name.required_if' => t_('the company name field is required when account type is company.'),
            'commercial_no.required_if' => t_('the commercial no field is required when account type is company.'),
            'data.array' => t_('the data must be array.'),
            'sort.numeric' => t_('sort field must be numeric'),
            'sort.max' => t_('sort field must be less than 1000'),

            'title.array' => t_('the title must be array.'),
            'title.*.required' => t_('the :attribute field required.'),
            'title.*.string' => t_('the :attribute field must be a string.'),
            'title.*.max:100' => t_('the :attribute field must be max 100 characters.'),
            'title.*.min:2' => t_('the :attribute field must be max 100 characters.'),

            'description.array' => t_('the description must br array.'),
            'roles.array' => t_('the roles must be array.'),
            'level.integer' => t_('the level must be integer.'),
            'latitude.numeric' => t_('the latitude must be numeric.'),
            'longitude.numeric' => t_('the longitude must be numeric.'),
            'address.max:255' => t_('the address must less than 255 characters.'),
            'site_name.max:100' => t_('the site_name must less than 100 characters.'),
            'site_logo.image' => t_('the site_logo must be image.'),
            'site_favicon.image' => t_('the site_favicon must be image.'),
            'type.required' => t_('the type field required.'),
            'price.numeric' => t_('the price must be numeric.'),
            'price.min:1' => t_('the price must not be less than 1 characters.'),
            'price.max:9999999999' => t_('the price must be less than 9999999999 characters.'),
            'images_collection.array' => t_('the images collection must be array.'),
            'images_collection.min:1' => t_('the images collection must be not less than 1 .'),
            'logo.image' => t_('the logo must be image..'),
            'cover.image' => t_('the cover must be image..'),
            'avatar.image' => t_('the avatar must be image..'),
            'facebook_url.max:50' => t_('the facebook url must less than 50 characters.'),
            'twitter_url.max:50' => t_('the twitter url must less than 50 characters.'),
            'instagram_url.max:50' => t_('the instagram url must less than 50 characters.'),
            'bank_number.max:15' => t_('the bank_number  must less than 15 characters.'),
            'manager_number.max:15' => t_('the manager number  must less than 15 characters.'),
            'store_number.max:15' => t_('the store number must less than 15 characters.'),
            'employee_number.max:15' => t_('the employee number must less than 15 characters.'),
            'area_id.required' => t_('the area id field required.'),
            'bio.required' => t_('the bio field required.'),
            'bio.max:50' => t_('the bio must less than 50 characters.'),
            'location.max:200' => t_('the location must less than 200 characters.'),
            'store_id.required' => t_('the store field required.'),
            'category_id.required' => t_('the category field required.'),
            'price.required' => t_('the price field required.'),
            'store_id.exists' => t_('the store field must be valid store.'),
            'category_id.exists' => t_('the category field must be valid store.'),
            'code.required' => t_('the code field required.'),
            'code.unique' => t_('the code field has already been taken.'),
            'code.in' => t_('the code field invalid.'),
            'media.array' => t_('media must be array'),
        ], $this->messagesAction());
    }


    // public function failedValidation(Validator $validator , Request $request)
    // {
    //         throw new HttpResponseException(sendError(__('validation.error_validation'), $validator->errors()));
    // }
}
