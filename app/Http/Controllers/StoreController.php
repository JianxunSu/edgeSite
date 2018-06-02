<?php

namespace App\Http\Controllers;

use App\Store;

class StoreController extends Controller
{
    // show list
    public function index()
    {
        $stores = Store::orderBy('id', 'name')->paginate(50);
        return view('stores')->with('stores', $stores);
    }
}
