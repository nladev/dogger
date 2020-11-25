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
                @include('dogger::filter')
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
                <div class="navbar-text small text-truncate mt-1 w-50 text-right order-1 order-md-last">
                    <span><b>Total :</b> {{$logs->total() ?? 0}} rows</span>
                    <form method="POST" action="{{ route('dogger.delete') }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-sm">
                                Delete All 
                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </nav>
          </div>
          <br>
          <div class="container-fluid">
            {{-- <h3 class="text-center">Filter Result</h3> --}}
            <div class="list-group list-group-flush">
                @forelse ($logs as $key => $log)
                <div class="list-group-item list-group-item-action">
                    <div class="row" data-toggle="collapse" data-target="#collapse{{$key}}">
                        <div class="col-4">
                            @if ($log->status >= 400)
                            <div class="method-bg-danger">
                                <button class="btn btn-danger btn-sm">{{$log->method}}</button> /{{$log->url}}
                            </div>
                            @elseif($log->status >= 300)
                            <div class="method-bg-waring">
                                <button class="btn btn-warning btn-sm">{{$log->method}}</button> /{{$log->url}}
                            </div>
                            @elseif($log->status >= 200)
                            <div class="method-bg-success">
                                <button class="btn btn-success btn-sm">{{$log->method}}</button> /{{$log->url}}
                            </div>
                            @else
                            <div class="method-bg-primary">
                                <button class="btn btn-primary btn-sm">{{$log->method}}</button> /{{$log->url}}
                            </div>
                            @endif
                        </div>
                        <div class="col-2">
                            <small><b>IP :</b> {{$log->ip}}</small>
                        </div>
                        <div class="col-2">
                            <small><b>Date :</b> {{$log->created_at}}</small>
                        </div>
                        
                        <div class="col-2">
                            <small><b>Duration :</b> {{$log->duration * 1000}} ms</small>
                        </div>
                        <div class="col-1">
                            @if($log->result == 'error')
                                <large><span class="badge badge-danger user-select-none">{{$log->result}}</span></large>
                            @else
                                <large><span class="badge badge-success user-select-none">{{$log->result}}</span></large>
                            @endif
                        </div>
                        <div class="col-1">
                            @if ($log->status >= 400)
                            <large><span class="badge badge-danger user-select-none">{{$log->status}}</span></large>
                            @elseif($log->status >= 300)
                            <large><span class="badge badge-success user-select-none">{{$log->status}}</span></large>
                            @elseif($log->status >= 200)
                            <large><span class="badge badge-success user-select-none">{{$log->status}}</span></large>
                            @else
                            <large><span class="badge badge-info user-select-none">{{$log->status}}</span></large>
                            @endif
                        </div>
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
                            <button class="btn btn-primary header" data-id="{{$log->id}}">Header</button>
                            <div class="overlay" id="header{{$log->id}}">
                                <button class="btn btn-dark preclose">back</button>
                                <hr><pre>{{$log->header}}</pre>
                            </div>
                            <button class="btn btn-primary request" data-id="{{$log->id}}">Request</button>
                            <div class="overlay" id="request{{$log->id}}">
                                <button class="btn btn-dark preclose">back</button>
                                <hr><pre>{{$log->request}}</pre>
                            </div>
                            <button class="btn btn-primary response" data-id="{{$log->id}}">Response</button>
                            <div class="overlay" id="response{{$log->id}}">
                                <button class="btn btn-dark preclose">back</button>
                                <hr><pre>{{$log->response}}</pre>
                            </div>
                            <button class="btn btn-primary exception" data-id="{{$log->id}}">Exception</button>
                            <div class="overlay" id="exception{{$log->id}}">
                                <button class="btn btn-dark preclose">back</button>
                                <hr><pre>{{$log->exception}}</pre>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <h5>
                  No Records
                </h5>
              @endforelse
                
            </div>
            <hr>
            {{ $logs->links('dogger::paginate') }}
        </div>
    </div>
</body>
    @include('dogger::js')
</html>