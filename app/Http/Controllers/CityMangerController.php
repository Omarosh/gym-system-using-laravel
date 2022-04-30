<?php

namespace App\Http\Controllers;
use App\Models\CityManger;
use App\Models\GymManger;
use App\Models\Gym;
use App\Models\Coach;
use App\Models\User;

use Illuminate\Http\Request;

class CityMangerController extends Controller
{
    public function store(Request $request){
        
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

    public function update(Request $request){
        
        $request_out=$request->all();
        User::where('id',$request_out["user_id"])->update([
            'name'=>$request_out["citymanger_name"],
            'email'=>$request_out["citymanger_email"],
            'password'=>$request_out["citymanger_password"]


        ]);
       CityManger::where("user_id",$request_out["user_id"])->update([

            'city_name'=>$request_out["city_name"],
            'national_id'=>$request_out["national_id"]
        ]);
    }
   public function delete(Request $request){
        $request_out=$request->all();
        CityManger::where("user_id",$request_out["user_id"])->delete();
        User::where('id',$request_out["user_id"])->delete();
    }


    public function allCityMangers(){
       $citymanger= CityManger::all();

    }
}
