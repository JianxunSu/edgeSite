<?php

namespace App\Http\Controllers;

use App\Store;
use App\Supervisor;
use Auth;
use DB;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    //Need login to access
    public function __construct()
    {
        $this->middleware('auth');
    }
    //show list
    public function index()
    {
        // $supervisors = Supervisor::orderBy('id')->get();
        //If not admin, and not a supervisor, then refuse to show the list
        if ((Auth::user()->admin)) {
            $supervisors = DB::table('supervisor')->leftJoin('store', 'store.id', '=', 'supervisor.store_id')
                ->select('supervisor.*', 'store.name', 'store.region as storeregion')->
                orderBy('supervisor.region')->get();

        } else {
            $supervisors = DB::table('supervisor')->leftJoin('store', 'store.id', '=', 'supervisor.store_id')
                ->select('supervisor.*', 'store.name', 'store.region as storeregion')->
                where('supervisor.email', '=', Auth::user()->email)->
                orderBy('supervisor.region')->get();
            //If not a supervisor
            if (count($supervisors) < 1) {
                return View('welcome')->with('errorMessage', "Sorry, you can't visit this page! Please check other links.");
            }

        }

        return view('supervisors')->with('supervisors', $supervisors);
    }

    /**
     * Show the form.
     *
     * @param  int  $id
     * @return Response
     */
    public function manageSupervisor($id)
    {
        // get the supervisor
        $supervisor = Supervisor::find($id);
//If not admin, and not the same email address of this supervisor, then refuse to show the form
        if ((!Auth::user()->admin) && (Auth::user()->email != $supervisor['email'])) {
            return View('welcome')->with('errorMessage', "Sorry, you can't visit this page! Please check other links.");
        }

        if (Auth::user()->admin) {
//if User is admin get all stores
            $stores = Store::orderby('name')->get();
        } else {
            //Get stores by supervisor's region
            $stores = Store::where('region', 'like', "{$supervisor['region']}")->orderby('name')->get();
        }
        return View('supervisorForm')
            ->with('supervisor', $supervisor)->with('stores', $stores);
    }

    /**
     * update Store.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStore(Request $request, $id)
    {
        //
        // var_dump($request->input('store'));
        // var_dump($id);
        $supervisor = Supervisor::findOrFail($id);
        $supervisor->store_id = $request->input('store');
        $supervisor->timestamps = false;
        $supervisor->save();
        return redirect('stores');
        // exit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
