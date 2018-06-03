@extends('layouts.app')

@section('content')
<div class="container">
   <table class="table">
      <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Region</th>
          <th>HostId</th>
          <th>Distance to Host</th>
      </tr>
      @foreach($stores as $store)
      <tr>
          <td>{{ $store->id }}</td>
          <td>{{ $store->name }}</td>
          <td>{{ $store->type }}</td>
          <td>{{ $store->region }}</td>
          @if(property_exists($store,'hostId'))<td>{{ $store->hostId }}</td>
          <td>{{ $store->distanceToHost }}</td>@endif
      </tr>
      @endforeach
   </table>
</div>
@endsection
