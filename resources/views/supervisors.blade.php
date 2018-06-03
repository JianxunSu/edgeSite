@extends('layouts.app')

@section('content')
<div class="container">
   <table class="table">
      <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Region</th>
          <th>FormLink</th>
      </tr>
      @foreach($supervisors as $supervisor)
      <tr>
          <td>{{ $supervisor['firstname'] }}</td>
          <td>{{ $supervisor['lastname'] }}</td>
          <td>{{ $supervisor['email'] }}</td>
          <td>{{ $supervisor['region'] }}</td>
          <td>
              <a class="nav-link js-scroll-trigger" href="{{ route('supervisor_form',$supervisor['id']) }}">
                  Register A Store
              </a>
          </td>
      </tr>
      @endforeach
   </table>
</div>
@endsection
