<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StorePort
 * @package App\Http\Requests
 */
class StorePort extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'           => 'unique:ports|required|min:2|max:255',
            'email'          => 'required|email|max:255',
            'city_id'        => 'required|min:2|max:255',
            'address1'       => 'nullable|max:255',
            'address2'       => 'nullable|max:255',
            'contact_nr'     => 'nullable|max:255',
            'contact_name'   => 'nullable|max:255',
            'emergency_nr'   => 'nullable|max:255',
            'emergency_name' => 'nullable|max:255',
            'body'           => 'nullable',
            'official_info'  => 'nullable',
            'url'            => 'nullable|url|max:255',
            'twitter'        => 'nullable|url|max:255',
            'facebook'       => 'nullable|url|max:255',
            'instagram'      => 'nullable|url|max:255',
            'lat'            => 'nullable|regex:/^[-+]?[0-9]{1,3}(?:\.[0-9]{1,10})?$/',
            'lng'            => 'nullable|regex:/^[-+]?[0-9]{1,3}(?:\.[0-9]{1,10})?$/',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique'      => 'The Port name already exists, please enter a unique Port name',
            'name.required'    => 'A Port name is required',
            'email.required'   => 'Provide the email of the Port',
            'body.required'    => 'A message is required',
            'city_id.required' => 'Please provide a city',
            'lat.regex'        => 'The latitude has the wrong format. Please use a dot (.) and only numbers',
            'lng.regex'        => 'The longitude has the wrong format. Please use a dot (.) and only numbers',
        ];
    }
}
