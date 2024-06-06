<?php

namespace Modules\DynamicDashboard\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JsonException;

class WidgetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws JsonException
     */
    public function run(): void
    {
        // build property arrays for widgets
        function buildProperties($label, $slug, $type, $options = null, $default = null, $icon = null, $is_required = false, $additionalProps = null)
        {
            return [
                'label' => $label,
                'slug' => $slug,
                'type' => $type,
                'options' => $options,
                'default' => $default,
                'icon' => $icon,
                'is_required' => $is_required,
                'additionalProps' => $additionalProps
            ];
        }

        // create widget arrays
        function createWidget($name, $slug, $min_column, $image, $config)
        {
            return [
                'name' => $name,
                'slug' => $slug,
                'min_column' => $min_column,
                'image' => $image,
                'config' => json_encode($config, JSON_THROW_ON_ERROR),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // Array of widgets insert into database
        $widgets = [
            createWidget('List Statuses', 'list-statuses', '1', 'image', [
                'properties' => [
                    buildProperties('show percentage', 'show-percentage', 'boolean', null, true, null, true),
                    buildProperties('with leads filter', 'with-leads-filter', 'boolean', null, true, null, true),
                    buildProperties('with team filter', 'with-team-filter', 'boolean', null, true, null, true),
                    buildProperties('with agent filter', 'with-agent-filter', 'boolean', null, false, null, true),
                    buildProperties('display', 'display', 'list', [
                        ['label' => 'vertical', 'value' => 'vertical'],
                        ['label' => 'horizontal', 'value' => 'horizontal'],
                    ], 'vertical', null, true)
                ]
            ]),
            createWidget('Recent Activities', 'recent-activities', '1', 'image', [
                'properties' => [
                    buildProperties('show timestamps', 'show-timestamps', 'boolean', null, true, null, true),
                ]
            ]),
            createWidget('User Profile', 'user-profile', '1', 'image', [
                'properties' => [
                    buildProperties('show agent', 'show-agent', 'boolean', null, true, null, true),
                    buildProperties('show points', 'show-points', 'boolean', null, true, null, true),
                    buildProperties('display', 'display', 'list', [
                        ['label' => 'vertical', 'value' => 'vertical'],
                        ['label' => 'horizontal', 'value' => 'horizontal'],
                    ], 'vertical', null, true)
                ]
            ]),
            createWidget('Top Agents', 'top-agents', '1', 'image', [
                'properties' => [
                    buildProperties('show the best', 'show-the-best', 'boolean', null, true, null, true),
                    buildProperties('show action', 'show-action', 'boolean', null, true, null, true),
                    buildProperties('display', 'display', 'list', [
                        ['label' => 'vertical', 'value' => 'vertical'],
                        ['label' => 'horizontal', 'value' => 'horizontal'],
                    ], 'vertical', null, true)
                ]
            ]),
            createWidget('Shortcuts', 'shortcuts', '1', 'image', [
                'properties' => [
                    buildProperties('welcoming', 'welcoming', 'boolean', null, true, null, true),
                    buildProperties('todos', 'todos', 'boolean', null, true, 'string', true),
                    buildProperties('reports', 'reports', 'boolean', null, true, 'string', true),
                    buildProperties('deals', 'deals', 'boolean', null, true, 'string', true),
                    buildProperties('inventory', 'inventory', 'boolean', null, true, 'string', true),
                    buildProperties('top agents', 'top-agents', 'boolean', null, true, 'string', true),
                    buildProperties('marketing', 'marketing', 'boolean', null, true, 'string', true),
                    buildProperties('brokers', 'brokers', 'boolean', null, true, 'string', true),
                    buildProperties('cases', 'cases', 'boolean', null, true, 'string', true),
                    buildProperties('check in', 'check-in', 'boolean', null, true, 'string', true),
                    buildProperties('organization', 'organization', 'boolean', null, true, 'string', true),
                    buildProperties('display', 'display', 'list', [
                        ['label' => 'vertical', 'value' => 'vertical'],
                        ['label' => 'horizontal', 'value' => 'horizontal'],
                    ], 'vertical', null, true)
                ]
            ]),
            createWidget('Insights and Activities', 'insights-activities', '1', 'image', [
                'properties' => [
                    buildProperties('scheduled meetings', 'scheduled-meetings', 'boolean', null, true, null, true),
                    buildProperties('daily activities', 'daily-activities', 'boolean', null, true, 'string', true, 'number'),
                    buildProperties('daily tens', 'daily-tens', 'boolean', null, true, 'string', true, 'chart'),
                    buildProperties('display', 'display', 'list', [
                        ['label' => 'vertical', 'value' => 'vertical'],
                        ['label' => 'horizontal', 'value' => 'horizontal'],
                    ], 'vertical', null, true)
                ]
            ]),
            createWidget('Deals', 'deals', '1', 'image', [
                'properties' => [
                    buildProperties('show numbers', 'show-numbers', 'boolean', null, true, null, true),
                    buildProperties('display', 'display', 'list', [
                        ['label' => 'vertical', 'value' => 'vertical'],
                        ['label' => 'horizontal', 'value' => 'horizontal'],
                    ], 'vertical', null, true)
                ]
            ]),
            createWidget('User Welcome', 'user-welcome', '1', 'image', [
                'properties' => [
                    buildProperties('new leads', 'new-leads', 'boolean', null, true, null, true),
                    buildProperties('recent assignments', 'recent-assignments', 'boolean', null, true, null, true),
                    buildProperties('hot leads', 'hot-leads', 'boolean', null, true, null, true),
                    buildProperties('display', 'display', 'list', [
                        ['label' => 'vertical', 'value' => 'vertical'],
                        ['label' => 'horizontal', 'value' => 'horizontal'],
                    ], 'vertical', null, true)
                ]
            ])
        ];

        // Insert the widget data into the 'widgets' table
        DB::table('widgets')->insert($widgets);
    }
}
