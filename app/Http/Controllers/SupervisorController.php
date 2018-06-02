<?php

namespace App\Http\Controllers;

use App\Supervisor;

class SupervisorController extends Controller
{
    //show list
    public function index()
    {
        $supervisors = Supervisor::orderBy('id')->get();
        return view('supervisors')->with('supervisors', $supervisors);
    }
    //TODO manage a store
    public function manageStore()
    {
    }
}
