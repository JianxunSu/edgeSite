@extends('layouts.app')

@section('content')
<div class="container">
   <table class="table">
      <tr>
          <th>Name</th>
          <th>Region</th>
          <th>Ship Address</th>
          <th>Ship City</th>
          <th>Ship State</th>
          <th>Ship Zip</th>
          <th>Latitude</th>
          <th>Longitude</th>
          <th>Type</th>
          <th>Supervisor</th>
      </tr>
      @foreach($stores as $store)
      <tr>
          <td>{{ $store['name'] }}</td>
          <td>{{ $store['region'] }}</td>
          <td>{{ $store['ship_address'] }}</td>
          <td>{{ $store['ship_city'] }}</td>
          <td>{{ $store['ship_state'] }}</td>
          <td>{{ $store['ship_zip'] }}</td>
          <td>{{ $store['latitude'] }}</td>
          <td>{{ $store['longitude'] }}</td>
          <td></td>
          <td></td>
      </tr>
      @endforeach
   </table>
</div>
@endsection
