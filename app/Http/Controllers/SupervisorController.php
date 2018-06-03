<?php

namespace App\Http\Controllers;

use App\Store;
use App\Supervisor;
use DB;
use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    //show list
    public function index()
    {
        // $supervisors = Supervisor::orderBy('id')->get();
        $supervisors = DB::table('supervisor')->leftJoin('store', 'store.id', '=', 'supervisor.store_id')
            ->select('supervisor.*', 'store.name', 'store.region as storeregion')->
            orderBy('supervisor.region')->get();

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
        $stores = Store::where('region', 'like', "{$supervisor['region']}")->orderby('name')->get();

        // show the edit form and pass the supervisor
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
