<?php

namespace App\Http\Controllers;

use App\Store;

class StoreController extends Controller
{
    // show list
    public function index()
    {
        $stores = Store::orderBy('region', 'name')->get();
        return view('stores')->with('stores', $stores);
    }
}
