<?php

namespace App\Http\Controllers;

use App\Supervisor;

class SupervisorController extends Controller
{
    //show list
    public function index()
    {
        $supervisors = Supervisor::orderBy('id')->paginate(50);
        return view('supervisors')->with('supervisors', $supervisors);

    }
    //TODO host a supdervisor
    public function hostsupdervisor()
    {
    }
}
