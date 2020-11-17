<?php

namespace Cracki\Dogger\Http\Middleware;

use Cracki\Dogger\DlogInterface;
use Closure;
use Illuminate\Support\Facades\DB;

class Dogger
{
    protected $logger;

    public function __construct(DlogInterface $logger)
    {
        $this->logger = $logger;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        return $response;
    }

    public function terminate($request, $response){
        file_put_contents(__DIR__ . '/1.txt', json_encode($request->all()).$request->ip().$request->method().$request->path());
        
        // DB::table('dlogs')->insert([
        //     'ip'            => $request->ip(),
        //     'method'        => $request->method(),
        //     'url'           => $request->path(),
        //     'request'       => json_encode($request),
        //     'response'      => json_encode($response),
        //     'status'        => $response->status(),
        //     'duration'      => 1,
        //     'controller'    => "-",
        //     'action'        =>"-",
        //     'models'        => "-"
        // ]);
        $this->logger->saveLog($request,$response);
    }
}