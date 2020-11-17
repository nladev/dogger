<?php

namespace Cracki\Dogger;

use Cracki\Dogger\Models\Dlog;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class Dogger implements DlogInterface
{
    protected $logs = [];

    protected $models = [];

    public function __construct()
    {
        $this->boot();
    }
    public function boot(){
        Event::listen('eloquent.*', function ($event, $models) {
            if (Str::contains($event, 'eloquent.retrieved')) {
                foreach (array_filter($models) as $model) {
                    $class = get_class($model);
                    $this->models[$class] = ($this->models[$class] ?? 0) + 1;
                }
            }
        });
    }
    public function saveLog($request,$response)
    {
        $controller = "";
        $action = "";

        $currentRouteAction = Route::currentRouteAction();

        if ($currentRouteAction) {
            if (strpos($currentRouteAction, '@') !== false) {
                list($controller, $action) = explode('@', $currentRouteAction);
            } else {
                if (is_string($currentRouteAction)) {
                    list($controller, $action) = ["", $currentRouteAction];
                } else {
                    list($controller, $action) = ["", (string)json_encode($currentRouteAction)];
                }
            }
        }

        $end = microtime(true);

        $implode_models = $this->models;

        array_walk($implode_models, function(&$value, $key) {
            $value = "{$key} ({$value})";
        });
        $models = implode(', ',$implode_models);

        Dlog::create([
            'ip'            => $request->ip(),
            'method'        => $request->method(),
            'url'           => $request->path,
            'request'       => $this->blackList($request),
            'response'      => json_encode($response),
            'status'        => $response->status(),
            'duration'      => $end - LARAVEL_START,
            'controller'    => $controller,
            'action'        => $action,
            'models'        => $models
        ]);
    }

    public function getLog()
    {
        $data = Dlog::all();
        return response()->json($data, 200);
    }

    public function deleteLog()
    {
        Dlog::truncate();
        return response()->json([
            'result' => 1,
            'message' => "All cleared!"
        ], 200);
    }

    protected function blackList($request)
    {
        $allFields = $request->all();

        foreach (config('apilog.dont_log', []) as $key) {
            if (array_key_exists($key, $allFields)) {
                unset($allFields[$key]);
            }
        }

        return json_encode($allFields);
    }
}