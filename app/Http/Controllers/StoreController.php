<?php

namespace App\Http\Controllers;

use App\Store;

class StoreController extends Controller
{
    // show list
    public function index()
    {
        // $stores = Store::orderBy('region', 'name')->get();
        $stores = DB::table('store')->leftJoin('supervisor','store.id','=','supervisor.store_id')
        ->select('store.*','count(supervisor.id) as hosted')
        ->groupBy('store.id')->orderBy('store.region','store.name')->get();
        foreach ($stores as $key=>$store) {
        	if($store['hosted']>0){
        		$stores[$key]['type']='Host';
        	}else{
//Calculate distance to host store
               $result=getDistanceToHost($store,$stores);
               if($result['distance']<=15){
               	$stores[$key]['type']='Surronding';
               	$stores[$key]['hostId']=$result['hostId'];
               }else{
               	$stores[$key]['type']='General';
               }
        	}
        }
        return view('stores')->with('stores', $stores);
    }
/**
* Calculate a store shortest distance to other host stores
* @param Store $store
* @param Store Collection $stores
* @return shorted distance to a host Id
*/
private getDistanceToHost($store,$stores){
	$distance=20; //Initial $distance as any number>15;
	$hostId=0;
	foreach ($stores as $value) {
		if($store['id']<>$value['id']){
			$currentDistance=distanceByMiles($store['latitude'],$store['long'])
			if($distance<ca)

		}
	}
		return array('distance'=>$distance,'hostId'=>$hostId);
}

/*
* Calculate Distance between 2 poins by Lat&Lon
* @return miles
*/
private distanceByMiles($lat1,$lon1,$lat2,$lon2){
  $theta=$lon1-$lon2;
  $dist=sin(deg2rad($lat1))*sin(deg2rad($lat2))+cos(deg2rad($lat1))*cos(deg2rad($lat2))*cos(deg2rad($theta));
  $dist=rat2deg(acos($dist));
  $miles=$dist*60*1.1515;
  return $miles;
}
}
