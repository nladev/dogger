<?php

namespace Cracki\Dogger\Http\Controllers;

use Cracki\Dogger\Models\Dlog;
use App\Http\Controllers\Controller;
use Cracki\Dogger\DlogInterface;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the log table.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getLogs(Request $request)
    {
       $logs = Dlog::all();
       return response()->json($logs, 200);
    }
    public function clearLogs()
    {
        Dlog::truncate();
        return response()->json([
            'result' => 'success',
            'message' => 'Successfully Deleted!'
        ], 200);
    }
    
}