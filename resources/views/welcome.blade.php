@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success">
                <div class="panel-heading">List of Stores&Supervisors</div>

                    @if(Auth::check())
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{ route('stores') }}">List of Stores</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="{{ route('supervisors') }}">
                  List of Supervisors
              </a>
            </li>
          </ul>
          @if(! empty($errorMessage))<space>{{$errorMessage}}</space>
          @endif
            @endif


            </div>
            @if(Auth::guest())
              <a href="/login" class="btn btn-info"> You need to login to see more info >></a>
            @endif
        </div>
    </div>
</div>
@endsection
