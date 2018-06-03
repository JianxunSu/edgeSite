@extends('layouts.app')

@section('content')
<div class="container">
   <ul>
    <li>Total hosts:{{count($supervisors)}}</li>
    <li>Participation Count:{{count(array_filter($supervisors->all(), function($v) {
    return $v->store_id>0;
}))}}</li>
   </ul>
   <table class="table">
      <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Region</th>
          <th>Store Id</th>
          <th>Store Name</th>
          <th>Store Region</th>
          <th>FormLink</th>
      </tr>
      @foreach($supervisors as $supervisor)
      <tr>
        <strong>
          <td>{{ $supervisor->firstname }}</td>
          <td>{{ $supervisor->lastname }}</td>
          <td>{{ $supervisor->email }}</td>
          <td>{{ $supervisor->region }}</td>
          <td>@if($supervisor->store_id>0){{ $supervisor->store_id }}@endif</td>
          <td>{{ $supervisor->name }}</td>
          <td>{{ $supervisor->storeregion }}</td>
          <td>
              <a class="nav-link js-scroll-trigger" href="{{ route('supervisor_form',$supervisor->id) }}">
                  Register A Store
              </a>
          </td>
        </strong>
      </tr>
      @endforeach
   </table>
</div>
@endsection
