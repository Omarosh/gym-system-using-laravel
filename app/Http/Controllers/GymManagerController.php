<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File; 

use App\Models\GymManger;
use Illuminate\Http\Request;
use App\Models\User;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreGymManagerRequest;

class GymManagerController extends Controller
{
    public function getGymManagers()
    {
        $data = GymManger::with('user');
        return DataTables::of($data)
        ->addColumn('action', function ($row) {
            return view('gym_manager.edit_delete_buttons', compact('row'))->render();
        })
        ->addColumn('username', function ($row) {
            return $row->user->name;
        })
        ->addColumn('gymname', function ($row) {
            return $row->gym->name;
        })
        -> make(true) ;
    }

    public function index()
    {
        return view('gym_manager.view');
    }

    public function create(Request $request)
    {
        return view('gym_manager.create');
    }

    public function store(StoreGymManagerRequest $request)
    {
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
      'password'=>Hash::make($input['password']),
    ])->id;
        $gym_manager= GymManger::create([
        'user_id'=>$user,
        'city_name'=>$input['city_name'],
        'national_id'=>$input["national_id"],
        'gym_id'=>$input['gym_id'] ,
        'image_path'=> $new_name,
        'status'=>0,
    ]);

        $role_id = DB::table('roles')->where('name', 'gym_manager')->value('id');
        User::find($user)->roles()->sync($role_id) ;

        
        return redirect('gym_managers');
    }

    public function view($GymMangerId)
    {
        $manager=GymManger::find($GymMangerId);
   
        return view("gym_manager.view_gymManager", ["manager"=>$manager]);
    }

    public function edit($user_id)
    {
        $manager= GymManger::where('user_id', $user_id)->first();

        return view('gym_manager.edit_form', ['manager' => $manager]);
    }

    public function update(StoreGymManagerRequest $request, $user_id)
    {
        $request_out=$request->all();
        if($request['image']){
                $manager= GymManger::where('user_id', $user_id)->first();
                File::delete(public_path('gymManagers_images/'.$manager['image_path'])); 
                $image = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('gymManagers_images'), $new_name); 
                User::where('id', $user_id)->update([
                    'name'=>$request_out["name"],
                    'email'=>$request_out["email"],
                    'password'=>$request_out["password"],
                ]);
                GymManger::where("user_id", $user_id)->update([
        
                    'city_name'=>$request_out["city"],
                    'national_id'=>$request_out["national_id"],
                    'gym_id'=>$request_out["gym_id"],
                    'image_path'=>$new_name,

                ]);
        }else{
            User::where('id', $user_id)->update([
                'name'=>$request_out["name"],
                'email'=>$request_out["email"],
                'password'=>$request_out["password"],
            ]);
            GymManger::where("user_id", $user_id)->update([
    
                'city_name'=>$request_out["city"],
                'national_id'=>$request_out["national_id"],
                'gym_id'=>$request_out["gym_id"],
            ]);

        }
      
      

        return redirect('gym_managers');
    }

    public function destroy(Request $request)
    {
        $request_out=$request->all();
        $cityManager=GymManger::where("id", $request_out['user_id'])->first();

        GymManger::where("id", $request_out['user_id'])->delete();

        User::where('id', $cityManager['user_id'])->delete();
        return back();
    }

    public function status(Request $request){
        $request_out=$request->all();
        GymManger::where("id",$request_out['user_id'])->update([
            'status'=>$request_out['status']
        ]);
    }
}
