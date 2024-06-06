<?php

namespace Modules\UserPreferences\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserPreferenceResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user' => $this->user->full_name,
            'module' => $this->module_name,
            'name' => $this->name,
            'value' => $this->value,
            'created_at' => $this->created_at ? $this->created_at->timezone(auth()->user()->timezone)->toDateTimeString() : null,
        ];
    }
}
