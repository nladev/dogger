<?php

namespace Cracki\Dogger\Http\Controllers;

use Cracki\Dogger\DlogInterface;
use App\Http\Controllers\Controller;
use Cracki\Dogger\Models\Dlog;
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
    public function delete()
    {
        Dlog::truncate();
        return redirect()->back();
    }
    
}