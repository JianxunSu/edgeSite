<?php

namespace App\Http\Controllers;

use App\Store;
use DB;

class StoreController extends Controller
{
    //Need login to access list info
    public function __construct()
    {
        $this->middleware('auth');
    }
    // show list
    public function index()
    {
        // $stores = Store::orderBy('region', 'name')->get();
        $stores = DB::table('store')->leftJoin('supervisor', 'store.id', '=', 'supervisor.store_id')
            ->select(DB::raw('store.*, count(supervisor.id) as hosted'))
            ->groupBy('store.id')->orderBy('store.region', 'store.name')->get();
        foreach ($stores as $key => $store) {
            $store = (array) $store; //Transfer $store to array;
            if ($store['hosted'] > 0) {
                $store['type'] = 'Host';
            } else {
                //Calculate distance to host store
                $result = $this->getDistanceToHost($store, $stores);
                if ($result['distance'] <= 15) {
                    $store['type'] = 'Surrounding';
                    $store['hostId'] = $result['hostId'];
                    $store['distanceToHost'] = $result['distance'];
                } else {
                    $store['type'] = 'General';
                }
            }
            $stores[$key] = (object) $store; //Transfer $store back to object
        }
        // var_dump($stores);
        return view('stores')->with('stores', $stores);
    }
/**
 * Calculate a store shortest distance to other host stores
 * @param Store $store
 * @param Store List to calcuate $stores
 * @return Array, shortest distance, to a host Id
 */
    private function getDistanceToHost($store, $stores)
    {
        $distance = 20; //Initial $distance as any number>15;
        $hostId = 0;
        foreach ($stores as $value) {
            if (($store['id'] != $value->id) && $value->hosted > 0) {
                $currentDistance = $this->distanceByMiles($store['latitude'], $store['longitude'], $value->latitude, $value->longitude);
                if ($distance > $currentDistance) {
                    $distance = $currentDistance;
                    $hostId = $value->id;
                }

            }
        }
        return array('distance' => $distance, 'hostId' => $hostId);
    }

/*
 * Calculate Distance between 2 poins by Lat&Lon
 * @return miles
 */
    private function distanceByMiles($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = rad2deg(acos($dist));
        $miles = $dist * 60 * 1.1515;
        return $miles;
    }
}
