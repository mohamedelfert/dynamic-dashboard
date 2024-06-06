<?php

namespace Modules\UserPreferences\Http\Controllers\Actions;

use Illuminate\Support\Facades\Auth;
use Modules\UserPreferences\UserPreference;
use Cache;

class GetUserPreferenceBySlugAction
{

    public function __construct()
    {
    }

    public function execute($slug, $user_id)
    {
        // Get the User Preference By Slug
        return Cache::rememberForever('user_preference_'.$slug.'_'.$user_id, function() use ($slug, $user_id) {
            return UserPreference::with(['user', 'preference'])
                ->where('user_id', $user_id)->whereHas('preference', function($preference) use($slug){
                    $preference->where('slug', $slug);
                })->first();
        });
    }
}
