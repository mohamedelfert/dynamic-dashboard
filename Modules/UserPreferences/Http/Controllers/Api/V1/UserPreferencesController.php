<?php

namespace Modules\UserPreferences\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Http\Helpers\ServiceResponse;
use Modules\UserPreferences\Http\Requests\UpdateUserPreferenceRequest;
use Modules\UserPreferences\Http\Controllers\Actions\UpdateUserPreferenceAction;
use Modules\UserPreferences\Http\Controllers\Actions\GetAllPreferencesAction;

class UserPreferencesController extends Controller
{

    public function MyPreferences(Request $request)
    {
        // Get All Preferences
        $all_preferences = (new GetAllPreferencesAction)->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'My preferences retrieved successfully';
        $resp->status = true;
        $resp->data = $all_preferences;
        return response()->json($resp, 200);
    }

    public function updateMyPreferences(UpdateUserPreferenceRequest $request, UpdateUserPreferenceAction $action)
    {
        $user_preference = $action->execute($request);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Preference has been updated successfully';
        $resp->status = true;
        $resp->data = $user_preference;
        return response()->json($resp, 200);
    }
}
