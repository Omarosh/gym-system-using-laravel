<?php

namespace App\Http\Controllers;

use App\Models\GymManger;
use Illuminate\Http\Request;
use App\Models\User;

class GymManagerController extends Controller
{
    
    public function index(){
       $gym_managers= GymManger::all();
         return $gym_managers;
    }

   public function show($userId){
       $gym_manager=GymManger::find($userId);
       return $gym_manager;
   }



   public function update(Request $request,$userId){
    $input = $request->all();
    // dd($input);
    $user=User::where('id',$userId)->update([
        'name'=>$input['name'],
        'email'=>$input['email'],
        'password'=>$input['password']

    ]);
    $gym_manager=GymManger::where('user_id', $userId)->update([
       
        'city_name'=>$input['city_name'],
        'gym_id'=>$input['gym_id'] ,
        
        ]);
        return $gym_manager;
   }
   public function store(Request $request){
    $input = $request->all();
    $new_name=null;
    if ($request['image']) {
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('gymManagers_images'), $new_name);
    }
   $user= User::create([
      'name'=>$input['name'],
      'email'=>$input['email'],
      'password'=>$input['password'],
    ])->id;
   $gym_manager= GymManger::create([
        'user_id'=>$user,
        'city_name'=>$input['city_name'],
        'gym_id'=>$input['gym_id'] ,
        'image_path'=> $new_name
        
        ]);
        return $user;
   }
public function destroy($userId){
    GymManger::where('id',$userId)->delete();
    User::where('id',$userId)->delete();
    
}
public function view($GymMangerId){
    $manager=GymManger::find($GymMangerId);
    return view("gym_manager.view_gymManager",["manager"=>$manager]);
}


}
