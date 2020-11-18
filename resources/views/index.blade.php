<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'APILogger') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    @include('dogger::css')
</head>
<body>
    <div class="app">
        <div>
            <div class="collapse" id="navbarToggleExternalContent">
              <div class="p-4">
                <h5 class=" h4">
                    Comming Soon ...
                </h5>
              </div>
            </div>
            <nav class="navbar shadow-sm">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                Filter 
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-filter-circle" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path fill-rule="evenodd" d="M7 11.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5z"/>
                  </svg>
              </button>
            </nav>
          </div>
          <br>
          <div class="container-fluid">
            {{-- <h3 class="text-center">Filter Result</h3> --}}
            <div class="list-group list-group-flush">
                @forelse ($logs as $key => $log)
                <div href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between" data-toggle="collapse" data-target="#collapse{{$key}}">
                        @if ($log->response > 400)
                        <div class="method-bg-danger">
                            <button class="btn btn-danger btn-sm">{{$log->method}}</button> /{{$log->url}}
                        </div>
                        @elseif($log->response > 300)
                        <div class="method-bg-waring">
                            <button class="btn btn-warning btn-sm">{{$log->method}}</button> /{{$log->url}}
                        </div>
                        @elseif($log->response > 200)
                        <div class="method-bg-success">
                            <button class="btn btn-success btn-sm">{{$log->method}}</button> /{{$log->url}}
                        </div>
                        @else
                        <div class="method-bg-primary">
                            <button class="btn btn-primary btn-sm">{{$log->method}}</button> /{{$log->url}}
                        </div>
                        @endif
                            
                        <small><b>IP :</b> {{$log->ip}}</small>
                        <small><b>Date :</b> {{$log->created_at}}</small>
                        <small><b>Duration :</b> {{$log->duration * 1000}} ms</small>
                        <large><span class="badge badge-success user-select-none">200</span></large>
                    </div>
                    
                    <div class="collapse" id="collapse{{$key}}">
                        <hr>
                        <div class="row"">
                            <div class="col-md-5"><b>Controller</b></div>
                            <div class="col-md-7">| {{$log->controller}}</div>

                            <div class="col-md-5"><b>Method</b></div>
                            <div class="col-md-7">| {{$log->action}}()</div>

                            <div class="col-md-5"><b>Models</b></div>
                            <div class="col-md-7">|  {{$log->models}}</div>
                        </div>
                        <hr>
                        <div class="d-flex w-100 justify-content-between">
                            <button class="btn btn-primary btn-sm" type="button">Request JSON</button>
                            <button class="btn btn-primary btn-sm" type="button">Response JSON</button>
                            <button class="btn btn-primary btn-sm" type="button">Exceptions</button>
                        </div>
                    </div>
                </div>
                @empty
                <h5>
                  No Records
                </h5>
              @endforelse
                
            </div>
        </div>
    </div>
</body>
    @include('dogger::js')
</html>