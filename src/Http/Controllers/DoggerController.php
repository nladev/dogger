<?php

namespace Cracki\Dogger\Http\Controllers;

use App\Http\Controllers\Controller;
use Cracki\Dogger\Models\Dlog;
use Illuminate\Http\Request;

class DoggerController extends Controller
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
    public function index()
    {
        $logs = Dlog::orderBy('created_at','DESC')->paginate(10);
        return view('dogger::index',compact('logs'));
        
    }
    public function search(Request $request)
    {
        $logs = Dlog::query();

        if($request->filled('result')){
            $logs->where('result',$request->result);
        }
        if($request->filled('datetimes')){
            $ranges = explode(' - ', $request->datetimes);
            $start = date('Y-m-d H:i:s', strtotime($ranges[0]));
            $end = date('Y-m-d H:i:s', strtotime($ranges[1]));
            $logs->whereBetween('created_at',[$start,$end]);
        }
        if($request->filled('path')){
            $logs->where('url','LIKE','%'.$request->path.'%');
        }
        $logs = $logs->paginate(10);

        $logs->appends([
            'path' => $request->path ?? '',
            'result' => $request->result ?? '',
            'datetimes' => $request->datetimes ?? ''
        ]);
        return view('dogger::index',compact('logs'));
    }
    public function delete()
    {
        Dlog::truncate();
        return redirect()->back();
    }
    
}