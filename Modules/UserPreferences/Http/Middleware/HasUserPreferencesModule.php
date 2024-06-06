<?php

namespace Modules\UserPreferences\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Cache;
use DB;

class HasUserPreferencesModule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Workaround for locahost use
        $current_host = request()->getHttpHost();
        $current_host = str_replace(":8000", "", $current_host);
        $current_host = str_replace(":8080", "", $current_host);

        // Check the hostnames that has this module
        // Provide the hosts that are allowed to use the user_preferences module
        $hosts = Cache::rememberForever('has_user_preferences_module', function () {
            $user_preferences_module = DB::connection('mysql')->table('modules')->where('name', 'User Preferences Module')->first();
            $user_preferences_module_packages = DB::connection('mysql')->table('package_modules')->where('module_id', $user_preferences_module->id)->pluck('package_id')->toArray();
            $package_hosts = DB::connection('mysql')->table('host_details')->whereIn('package_id', $user_preferences_module_packages)->pluck('host_id')->toArray();
            $hostnames = DB::connection('mysql')->table('hostnames')->whereIn('id', $package_hosts)->pluck('fqdn')->toArray();
            return $hostnames;
        });

        if (!in_array($current_host, $hosts)) :
            abort(404);
        endif;

        return $next($request);
    }
}
