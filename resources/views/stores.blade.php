@extends('layouts.app')

@section('content')
<div class="container">
   <table class="table">
      <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Region</th>
          <th>Distance to Host</th>
      </tr>
      @foreach($stores as $store)
      <tr>
          <td>{{ $store['id'] }}</td>
          <td>{{ $store['name'] }}</td>
          <td></td>
          <td>{{ $store['region'] }}</td>
          <td></td>
      </tr>
      @endforeach
   </table>
</div>
@endsection
