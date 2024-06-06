<?php

namespace Modules\DynamicDashboard\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonException;

class TemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws JsonException
     */
    public function run(): void
    {
        // Array of dashboard templates insert into database.
        $templates = [
            // Widget configurations for the CEO Dashboard Template
            [
                'name' => 'CEO Dashboard Template',
                'description' => 'Template For CEO Dashboard',
                'image' => 'default.png',
                'config' => json_encode(
                    [
                        'layout' => 'grid',
                        'columns' => 3,
                        'widgets' => [
                            // List Statuses
                            [
                                'widget_id' => 1,
                                'row' => 1,
                                'col' => 1,
                                'config' => [
                                    'show-percentage' => true,
                                    'with-leads-filter' => true,
                                    'with-team-filter' => true,
                                    'with-agent-filter' => true
                                ]
                            ],
                            // Recent Activities
                            [
                                'widget_id' => 2,
                                'row' => 1,
                                'col' => 1,
                                'config' => [
                                    'show-timestamps' => true
                                ]
                            ],
                            // User Profile
                            [
                                'widget_id' => 3,
                                'row' => 1,
                                'col' => 1,
                                'config' => [
                                    'show-agent' => true,
                                    'show-points' => true
                                ]
                            ],
                            // Top Agents
                            [
                                'widget_id' => 4,
                                'row' => 1,
                                'col' => 1,
                                'config' => [
                                    'show-the-best' => true,
                                    'show-action' => true
                                ]
                            ],
                            // Shortcuts
                            [
                                'widget_id' => 5,
                                'row' => 1,
                                'col' => 1,
                                'config' => [
                                    'welcoming' => true,
                                    'todos' => true,
                                    'reports' => true,
                                    'deals' => true,
                                    'inventory' => true,
                                    'top-agents' => true,
                                    'marketing' => true,
                                    'brokers' => true,
                                    'cases' => true,
                                    'check-in' => true,
                                    'organization' => true,
                                ]
                            ],
                            // Insights and Activities
                            [
                                'widget_id' => 6,
                                'row' => 1,
                                'col' => 1,
                                'config' => [
                                    'scheduled-meetings' => true,
                                    'daily-activities' => true,
                                    'daily-tens' => true,
                                ]
                            ],
                            // Deals
                            [
                                'widget_id' => 7,
                                'row' => 1,
                                'col' => 1,
                                'config' => [
                                    'show-numbers' => true
                                ]
                            ]
                        ]
                    ], JSON_THROW_ON_ERROR),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Widget configurations for the Sales Agent Dashboard Template
            [
                'name' => 'Sales Agent Dashboard Template',
                'description' => 'Template for Sales Agent Dashboard',
                'image' => 'default.png',
                'config' => json_encode(
                    [
                        'layout' => 'grid',
                        'columns' => 4,
                        'widgets' => [
                            // List Statuses
                            [
                                'widget_id' => 1,
                                'row' => 1,
                                'col' => 1,
                                'config' => [
                                    'show-percentage' => true,
                                    'with-leads-filter' => true,
                                    'with-team-filter' => true,
                                    'with-agent-filter' => true
                                ]
                            ],
                            // User Profile
                            [
                                'widget_id' => 3,
                                'row' => 1,
                                'col' => 1,
                                'config' => [
                                    'show-agent' => true,
                                    'show-points' => true
                                ]
                            ],
                            // Top Agents
                            [
                                'widget_id' => 4,
                                'row' => 1,
                                'col' => 1,
                                'config' => [
                                    'show-the-best' => true,
                                    'show-action' => true
                                ]
                            ],
                            // Shortcuts
                            [
                                'widget_id' => 5,
                                'row' => 1,
                                'col' => 1,
                                'config' => [
                                    'welcoming' => true,
                                    'todos' => true,
                                    'reports' => true,
                                    'deals' => true,
                                    'inventory' => true,
                                    'top-agents' => true,
                                    'marketing' => true,
                                    'brokers' => true,
                                    'cases' => true,
                                    'check-in' => true,
                                    'organization' => true,
                                ]
                            ],
                            // Deals
                            [
                                'widget_id' => 7,
                                'row' => 1,
                                'col' => 1,
                                'config' => [
                                    'show-numbers' => true,
                                    'daily-activities' => true,
                                    'daily-tens' => true,
                                ]
                            ],
                            // User Welcome
                            [
                                'widget_id' => 8,
                                'row' => 1,
                                'col' => 1,
                                'config' => [
                                    'new-leads' => true,
                                    'recent-assignments' => true,
                                    'hot-leads' => true
                                ]
                            ]
                        ]
                    ], JSON_THROW_ON_ERROR),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        // Insert the template data into the 'templates' table.
        DB::table('templates')->insert($templates);
    }
}
