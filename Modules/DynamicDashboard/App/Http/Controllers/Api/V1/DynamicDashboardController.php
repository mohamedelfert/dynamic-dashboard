<?php

namespace Modules\DynamicDashboard\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\DynamicDashboard\App\Http\Requests\StoreUserTemplate;
use Modules\DynamicDashboard\App\Http\Requests\StoreUserWidgets;

class DynamicDashboardController extends Controller
{
    public function index($id)
    {
        $userWidgets = DB::table('user_widgets')
            ->where('id', $id)
            ->where('user_id', auth()->user()->id)
            ->get();

        $userWidgets->transform(function ($widget) {
            $widget->config = json_decode($widget->config);
            return $widget;
        });

        return response()->json([
            'data' => $userWidgets,
            'message' => "Data Retrieved Successfully",
            'status' => 200,
        ]);
    }

    public function getWidgets()
    {
        $widgets = DB::table('widgets')->get();

        $widgets->transform(function ($widget) {
            $widget->config = json_decode($widget->config);
            return $widget;
        });

        return response()->json([
            'data' => $widgets,
            'message' => "Data Retrieved Successfully",
            'status' => 200,
        ]);
    }

    public function getTemplates()
    {
        $templates = DB::table('templates')->get();

        $templates->transform(function ($template) {
            $template->config = json_decode($template->config);
            return $template;
        });

        return response()->json([
            'data' => $templates,
            'message' => "Data Retrieved Successfully",
            'status' => 200,
        ]);
    }

    public function store(StoreUserWidgets $request)
    {
        // Store the widget data
        DB::table('user_widgets')->insert([
            'name' => $request['name'],
            'description' => $request['description'] ?? '',
            'user_id' => $request['user_id'],
            'config' => json_encode($request['config']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Widgets stored successfully']);
    }

    public function storeTemplate(StoreUserTemplate $request)
    {
        $template = DB::table('templates')->where('id', $request->id)->first();

        if ($template) {
            $template->config = json_decode($template->config);

            // Remove unwanted fields
            unset($template->id, $template->image, $template->deleted_at, $template->created_at, $template->updated_at);
            $template->user_id = auth()->user()->id;
        }

        // Store the widget data
        DB::table('user_widgets')->insert([
            'name' => $template->name,
            'description' => $template->description,
            'user_id' => $template->user_id,
            'config' => json_encode($template->config),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'User Template stored successfully']);
    }

    public function updateUserWidgets(StoreUserWidgets $request)
    {
        DB::table('user_widgets')->where('user_id', $request->user_id)->delete();

        // Store the widget data
        DB::table('user_widgets')->insert([
            'name' => $request['name'],
            'description' => $request['description'] ?? '',
            'user_id' => $request['user_id'],
            'config' => json_encode($request['config']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Widgets stored successfully']);
    }
}
