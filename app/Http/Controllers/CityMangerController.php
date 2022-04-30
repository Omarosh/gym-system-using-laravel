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
    function store(Request $request){
        
        $request_out=$request->all();
        $user=User::create([
            'name'=> $request_out['name'],
            'email'=> $request_out['email'],
            'password' => $request_out['password']
            //dddd
        ])->id;
        $CityManger=CityManger::create([
            'user_id'=>$user,
            'city_name'=>$request_out["city_name"],
            'national_id'=>$request_out["national_id"]
            
        ]);
        return $CityManger;
    }

}
