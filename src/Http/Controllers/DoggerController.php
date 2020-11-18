<?php

namespace Cracki\Dogger\Http\Controllers;

use Cracki\Dogger\DlogInterface;
use App\Http\Controllers\Controller;

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
    public function index(DlogInterface $logger)
    {
        $logs = $logger->getLogs();
        
        if(count($logs)>0){
            $logs = $logs->sortByDesc('created_at');
        }
        else{
            $logs = [];
        }
        return view('dogger::index',compact('logs'));
        
    }
    public function delete(DlogInterface $logger)
    {
        $logger->deleteLog();
        return redirect()->back();
    }
    
}