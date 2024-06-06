<?php

namespace Modules\UserPreferences\Http\Controllers\Actions;

use Illuminate\Support\Facades\Auth;
use Modules\UserPreferences\UserPreference;

class GetUserPreferenceByUserIdAction
{

    public function execute($user_id)
    {
        // Get the User Preference By Slug
        return UserPreference::with(['user', 'preference'])->where('user_id', $user_id)->first();
    }
}
