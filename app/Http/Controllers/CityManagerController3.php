<?php

namespace App\Http\Controllers;

use App\Models\CityManger;
use App\Models\User;
use Illuminate\Http\Request;
// use DataTables;
use yajra\Datatables\Datatables;

class CityManagerController3 extends Controller
{
    public function index(Request $request)
    {
        return view('city_manager.view');
    }

    public function update(Request $request, $id)
    {
        return view('edit_city_manager_view');
    }
    public function destroy(Request $request, $id)
    {
        $request_out=$request->all();
        // dd($id);
        
        CityManger::where("user_id", $id)->delete();
        User::where('id', $id)->delete();
        return back();
    }

    public function getCityManagers(Request $request)
    {
        $data = CityManger::all();
        // dd($data);
        return DataTables::of($data)
        ->addColumn('action', function ($row) {
            return view('city_manager.edit_delete_form', compact('row'))->render();
        })
        -> make(true) ;
    }
}
