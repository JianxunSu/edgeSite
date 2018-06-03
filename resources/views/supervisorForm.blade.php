@extends('layouts.app')

@section('content')
<div class="container">
	<nav class="navbar navbar-inverse">
		<div class="navbar-header">
			<a class="navbar-brand" href="{{ URL::to('stores') }}">Stores List</a>
		</div>
	</nav>
	<h1>Welcome, {{ $supervisor->firstname }} {{ $supervisor->lastname }}</h1>
	<form method="POST" action="{{ route('updateStore',$supervisor['id']) }}">@csrf
		<div class="form-group">
			<label for="store">Please register a Store at your region!</label>
			<select name="store">
				<option value=0>Select...</option>
				@foreach ($stores as $store)
				@if ($store['id'] == $supervisor->store_id)
				<option value={{$store['id']}} selected>{{$store['name']}}</option>
				@else
				<option value={{$store['id']}}
                >{{$store['name']}}</option>
                @endif
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
        	{{ __('Confirm') }}
        </button>
    </form>
</div>
@endsection
