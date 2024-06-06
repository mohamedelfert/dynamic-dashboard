<?php

namespace Modules\UserPreferences\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PreferencesSeeder extends Seeder
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

        /*  ===========================
            === General Preferences === 
            ========================= */

        // Insert Preferences
        DB::table('preferences')->insert([
            // General
            ['id' => 1, 'default' => null, 'parent_id' => null, 'slug' => 'general', 'is_hidden' => false, 'is_checkbox' => false, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            // Languages
            ['id' => 2, 'default' => 'en', 'parent_id' => 1, 'slug' => 'default-language', 'is_hidden' => false, 'is_checkbox' => false, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],

            // Follow-up Notifications
            ['id' => 3, 'default' => null, 'parent_id' => null, 'slug' => 'follow-up-notifications', 'is_checkbox' => false, 'is_hidden' => false, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['id' => 4, 'default' => 1, 'parent_id' => 3, 'slug' => 'email-follow-up-notifications', 'is_checkbox' => true, 'is_hidden' => false, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['id' => 5, 'default' => 1, 'parent_id' => 3, 'slug' => 'push-follow-up-notifications', 'is_checkbox' => true, 'is_hidden' => false, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['id' => 6, 'default' => 1, 'parent_id' => 3, 'slug' => 'mobile-follow-up-notifications', 'is_checkbox' => true, 'is_hidden' => false, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['id' => 7, 'default' => 1, 'parent_id' => 3, 'slug' => 'google-calendar-follow-up-notifications', 'is_checkbox' => true, 'is_hidden' => false, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],

            // Workspace Settings
            ['id' => 8, 'default' => null, 'parent_id' => null, 'slug' => 'workspace-settings', 'is_checkbox' => false, 'is_hidden' => false, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['id' => 9, 'default' => 'table', 'parent_id' => 8, 'slug' => 'workspace-layout', 'is_checkbox' => false, 'is_hidden' => false, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['id' => 10, 'default' => 'table', 'parent_id' => 8, 'slug' => 'workspace-layout-minimal-view', 'is_checkbox' => true, 'is_hidden' => false, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],

            // Dashboard Settings
            ['id' => 11, 'default' => null, 'parent_id' => null, 'slug' => 'dashboard-settings', 'is_checkbox' => false, 'is_hidden' => false, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['id' => 12, 'default' => 'sales_agent', 'parent_id' => 11, 'slug' => 'dashboard-mode', 'is_checkbox' => false, 'is_hidden' => false, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at]
        ]);

        // Global Trans Options
        $yes_or_no_options = json_encode([1 => 'Yes', 0 => 'No']);
        
        // Insert General Preferences Translations
        $languages_options = json_encode(['en' => 'English', 'ar' => 'العربية']);
        DB::table('preference_trans')->insert([
            // General
            ['preference_id' => 1, 'language_id' => 1, 'name' => 'General', 'description' => null, 'options' => null, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['preference_id' => 1, 'language_id' => 2, 'name' => 'عام', 'description' => null, 'options' => null, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            // Languages
            ['preference_id' => 2, 'language_id' => 1, 'name' => 'Languages', 'description' => null, 'options' => $languages_options, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['preference_id' => 2, 'language_id' => 2, 'name' => 'اللغة', 'description' => null, 'options' => $languages_options, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
        ]);

        // Insert Follow-up Notifications Preferences Translations
        DB::table('preference_trans')->insert([
            // Notifications
            ['preference_id' => 3, 'language_id' => 1, 'name' => 'Follow-ups Notifications Settings', 'description' => null, 'options' => null, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['preference_id' => 3, 'language_id' => 2, 'name' => 'إعدادات الإشعارات للمتابعات', 'description' => null, 'options' => null, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            // Email
            ['preference_id' => 4, 'language_id' => 1, 'name' => 'Email Notifications', 'description' => null, 'options' => $yes_or_no_options, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['preference_id' => 4, 'language_id' => 2, 'name' => 'البريد الإلكتروني', 'description' => null, 'options' => $yes_or_no_options, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            // Push
            ['preference_id' => 5, 'language_id' => 1, 'name' => 'Push Notifications', 'description' => null, 'options' => $yes_or_no_options, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['preference_id' => 5, 'language_id' => 2, 'name' => 'الإشعارات المباشرة', 'description' => null, 'options' => $yes_or_no_options, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            // Mobile
            ['preference_id' => 6, 'language_id' => 1, 'name' => 'Mobile Notifications', 'description' => null, 'options' => $yes_or_no_options, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['preference_id' => 6, 'language_id' => 2, 'name' => 'الإشعارات تطبيق الموبايل', 'description' => null, 'options' => $yes_or_no_options, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            // Google Calendar
            ['preference_id' => 7, 'language_id' => 1, 'name' => 'Google Calendar Notifications', 'description' => 'You must link it with your Google Account', 'options' => $yes_or_no_options, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['preference_id' => 7, 'language_id' => 2, 'name' => 'الإشعارات بتقويم جوجل', 'description' => 'يجب ربط بحساب جوجل الخاص بك', 'options' => $yes_or_no_options, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
        ]);

        // Insert Follow-up Notifications Preferences Translations
        $workspace_layout_options_en = json_encode(['table' => 'Table View', 'side' => 'Side View']);
        $workspace_layout_options_ar = json_encode(['table' => 'عرض الجدول', 'side' => 'عرض جانبي']);
        DB::table('preference_trans')->insert([
            // Workspace Settings
            ['preference_id' => 8, 'language_id' => 1, 'name' => 'Workspace Settings', 'description' => null, 'options' => null, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['preference_id' => 8, 'language_id' => 2, 'name' => 'إعدادات مساحة العمل', 'description' => null, 'options' => null, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            // Workspace Layout
            ['preference_id' => 9, 'language_id' => 1, 'name' => 'Workspace Layout', 'description' => null, 'options' => $workspace_layout_options_en, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['preference_id' => 9, 'language_id' => 2, 'name' => 'طريقة عرض مساحة العمل', 'description' => null, 'options' => $workspace_layout_options_ar, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            // Minimal View
            ['preference_id' => 10, 'language_id' => 1, 'name' => 'Disable minimal view', 'description' => null, 'options' => $yes_or_no_options, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['preference_id' => 10, 'language_id' => 2, 'name' => 'إيقاف العرض البسيط', 'description' => null, 'options' => $yes_or_no_options, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
        ]);

        // Insert Dashboard Preferences Translations
        $dashboard_options_en = json_encode([
            'default' => 'Default',
            'owner_ceo' => 'Owner/CEO',
            'sales_admin' => 'Sales Admin',
            'sales_manager' => 'Sales Manager',
            'sales_team_leader' => 'Sales Team Leader',
            'sales_agent' => 'Sales Agent',
            'marketing_manager' => 'Marketing Manager',
            'telemarketing_agent' => 'Telemarketing Agent',
            'customer_service_agent' => 'Customer Service Agent',
            'quality_assurance_agent' => 'Quality Assurance Agent'
        ]);
        $dashboard_options_ar = json_encode([
            'default' => 'الإفتراضي',
            'owner_ceo' => 'المدير العام',
            'sales_admin' => 'مشرف فريق المبيعات',
            'sales_manager' => 'مدير المبيعات',
            'sales_team_leader' => 'قائد فريق المبيعات',
            'sales_agent' => 'ممثل مبيعات',
            'marketing_manager' => 'مدير التسويق',
            'telemarketing_agent' => 'تسويق عبر الهاتف',
            'customer_service_manager' => 'مدير خدمة العملاء',
            'customer_service_agent' => 'ممثل خدمة العملاء',
            'quality_assurance_agent' => 'مراقب الجودة'
        ]);
        DB::table('preference_trans')->insert([
            // Dashboard Settings
            ['preference_id' => 11, 'language_id' => 1, 'name' => 'Dashboard', 'description' => null, 'options' => null, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['preference_id' => 11, 'language_id' => 2, 'name' => 'الرئيسية', 'description' => null, 'options' => null, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            // Dashboard Mode
            ['preference_id' => 12, 'language_id' => 1, 'name' => 'Dashboard Mode', 'description' => null, 'options' => $dashboard_options_en, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at],
            ['preference_id' => 12, 'language_id' => 2, 'name' => 'وضع الرئيسية', 'description' => null, 'options' => $dashboard_options_ar, 'created_by' => 1, 'created_at' => $created_at, 'updated_by' => 1, 'updated_at' => $created_at]
        ]);
    }
}
