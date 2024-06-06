<?php

namespace Modules\DynamicDashboard\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserTemplate extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:templates,id'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
