<?php

namespace Modules\UserPreferences\Http\Controllers\Actions;

use Illuminate\Support\Facades\Auth;
use Modules\UserPreferences\Preference;
use Cache;
use Modules\UserPreferences\Http\Resources\PreferenceResource;

class GetAllPreferencesAction
{

    public function execute()
    {
        // Get All Preferences
        return Cache::rememberForever('all_preferences', function () {
            $all_preferences = Preference::all();
            return PreferenceResource::collection($all_preferences);
        });
    }
}
