<?php

namespace Modules\UserPreferences\Http\Controllers\Actions;

use Auth, Cache;
use Illuminate\Http\Request;
use Modules\UserPreferences\UserPreference;

class UpdateUserPreferenceAction
{

    public function execute(Request $request)
    {
        $preference_id = $request->get('preference_id');
        $user_id = $request->has('user_id') ? $request->get('user_id') : Auth::user()->id;

        $user_preference = UserPreference::where('user_id', $user_id)->where('preference_id', $preference_id)->first();

        // Delete it from Cache
        Cache::forget('user_preference_'.$user_preference->slug.'_'.$user_preference->user_id);
        
        // Update it
        return UserPreference::where(['preference_id' => $preference_id, 'user_id' => $user_id])
                ->update(['value' => $request->get('value')]);
    }
}
