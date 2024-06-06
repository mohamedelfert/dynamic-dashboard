<?php

namespace Modules\UserPreferences\Http\Requests;

use Auth;
use App\Http\Requests\FormRequest;

class UpdateUserPreferenceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $default_connection = 'tenant';

        $array = [];
        $array['value'] = ['required'];
        return $array;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
