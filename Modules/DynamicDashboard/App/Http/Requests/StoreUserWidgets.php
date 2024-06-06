<?php

namespace Modules\DynamicDashboard\App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserWidgets extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|integer|exists:users,id',
            'config.layout' => 'required|string|in:grid,list',
            'config.columns' => 'required|integer|min:1',
            'config.widgets' => 'required|array',
            'config.widgets.*.widget_id' => 'required|integer',
            'config.widgets.*.row' => 'required|integer|min:1',
            'config.widgets.*.col' => 'required|integer|min:1',
            'config.widgets.*.config' => 'required|array'
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
