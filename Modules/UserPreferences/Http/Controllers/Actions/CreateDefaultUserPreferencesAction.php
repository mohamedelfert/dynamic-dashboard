<?php

namespace Modules\UserPreferences\Http\Controllers\Actions;

use Illuminate\Support\Facades\Auth;
use Modules\UserPreferences\Preference;
use Cache, DB;
use Modules\UserPreferences\Http\Controllers\Actions\GetAllPreferencesAction;

class CreateDefaultUserPreferencesAction
{

    public function execute($user_id)
    {
        // Get All Preferences
        $all_preferences = (new GetAllPreferencesAction)->execute();
        foreach ($all_preferences as $preference) {
            if($preference->parent_id){
                DB::connection('tenant')->table('user_preferences')->insert([
                    'preference_id' => $preference->id,
                    'user_id' => $user_id,
                    'value' => $preference->default,
                ]);
            }
        }
        return true;
    }
}
