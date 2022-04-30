<?php

namespace App\Http\Controllers;

use App\Models\CityManger;
use App\Models\Coach;
use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\GymManger;
use Illuminate\Support\Facades\File; 


class GymController extends Controller
{
    public function store(Request $request){
        $new_name=null;
        if($request['image']){
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('gyms_images'), $new_name);
        }
        $request_out=$request->all();
        $citymanger=CityManger::where('city_name',$request_out['city_name'])->first();
        Gym::create([
            'city_manger_id'=>$citymanger->user_id,
            'name'=>$request_out['name'],
            'cover_image_path'=>$new_name,
            'city_name'=> $request_out['city_name'],
        ]);

    }
    public function update(Request $request){
        $request_out=$request->all();
        $citymanger=CityManger::where('city_name',$request_out['city_name'])->first();
        if($request['image']){
                $gym= Gym::find($request['gym_id']);
                File::delete(public_path('gyms_images/'. $gym['cover_image_path'])); 
                $image = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('gyms_images'), $new_name); 
                    Gym::where('id',$request['gym_id'])->update([
                        'city_manger_id'=>$citymanger->user_id,
                        'name'=>$request_out['name'],
                        'cover_image_path'=>$new_name,
                        'city_name'=> $request_out['city_name'],

                    ]);
        }else{
            Gym::where('id',$request['gym_id'])->update([
                'city_manger_id'=>$citymanger->user_id,
                'name'=>$request_out['name'],
                'city_name'=> $request_out['city_name'],

            ]);

        }
    }

    public function delete(Request $request){
        Gym::where('id',$request['gym_id'])->delete();
        $gymmanger=GymManger::where('gym_id',$request['gym_id'])->first();
        GymManagerController::destroy($gymmanger->user_id);
        $coaches=Coach::where('gym_id',$request['gym_id'])->delete();
        
    }

    public function allGyms(){
        $gyms= Gym::all();
     }


}
