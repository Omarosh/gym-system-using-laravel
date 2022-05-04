<?php

namespace App\Http\Controllers;

use App\Models\GymManger;
use App\Models\Gym;
use App\Models\Coach;
use App\Models\User;
use yajra\Datatables\Datatables;
use App\Models\CityManger;



use Illuminate\Http\Request;

class CityManagerController extends Controller
{
    public function store(Request $request)
    {
        $request_out=$request->all();
        
        $user=User::create([
            'name'=> $request_out['name'],
            'email'=> $request_out['email'],
            'password' => $request_out['password']
            
        ])->id;
        $CityManger=CityManger::create([
            'user_id'=>$user,
            'city_name'=>$request_out["city_name"],
            'national_id'=>$request_out["national_id"]
            
        ]);
        return $CityManger;
    }


    public function edit(Request $request, $id)
    {
        return view('edit_city_manager_view');
    }

    public function update(Request $request)
    {
        $request_out=$request->all();
        User::where('id', $request_out["user_id"])->update([
            'name'=>$request_out["citymanger_name"],
            'email'=>$request_out["citymanger_email"],
            'password'=>$request_out["citymanger_password"]


        ]);
        CityManger::where("user_id", $request_out["user_id"])->update([

            'city_name'=>$request_out["city_name"],
            'national_id'=>$request_out["national_id"]
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $request_out=$request->all();
        CityManger::where("user_id", $id)->delete();
        User::where('id', $id)->delete();
        return back();
    }

   
    public function getCityManagers(Request $request)
    {
        $data = CityManger::all();
        return DataTables::of($data)
        ->addColumn('action', function ($row) {
            return view('city_manager.edit_delete_form', compact('row'))->render();
        })
        -> make(true) ;
    }

   

    public function index(Request $request)
    {
        return view('city_manager.view');
    }
}
