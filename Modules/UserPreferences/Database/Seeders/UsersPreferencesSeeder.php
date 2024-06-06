<?php

namespace Modules\UserPreferences\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersPreferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $created_at = Carbon::now()->toDateTimeString();

        // Create Default Preferences for All Users
        $all_users = DB::select("SELECT `id` FROM `users`");
        $all_preferences = DB::select("SELECT `id`, `parent_id`, `default` FROM `preferences`");
        foreach ($all_users as $user) {
            foreach ($all_preferences as $preference) {
                if($preference->parent_id && !DB::table('user_preferences')->where('user_id', $user->id)->where('preference_id', $preference->id)->first()) {                
                    DB::table('user_preferences')->insert([
                        'preference_id' => $preference->id,
                        'user_id' => $user->id,
                        'value' => $preference->default,
                        'created_at' => $created_at
                    ]);
                }
            }
        }
    }
}
