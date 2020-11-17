<?php

namespace Cracki\Dogger\Http\Middleware;

use Cracki\Dogger\DlogInterface;
use Closure;

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
        $this->logger->saveLog($request,$response);
    }
}