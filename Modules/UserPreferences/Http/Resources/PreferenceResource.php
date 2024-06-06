<?php

namespace Modules\UserPreferences\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PreferenceResource extends Resource
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
            'default' => $this->default,
            'parent_id' => $this->parent_id,
            'name' => $this->name,
            'description' => $this->description,
            'options' => $this->options,
            'slug' => $this->slug,
            'is_hidden' => $this->is_hidden
        ];
    }
}
