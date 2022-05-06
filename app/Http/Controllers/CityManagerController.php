<?php

namespace App\Http\Controllers;

use App\Models\User;
use yajra\Datatables\Datatables;
use App\Models\CityManger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File; 

use App\Http\Requests\StoreCityManagerRequest;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class CityManagerController extends Controller
{
    public function store(StoreCityManagerRequest $request)
    {
        $request_out=$request->all();

        $user=User::create([
            'name'=> $request_out['name'],
            'email'=> $request_out['email'],
            'password' =>Hash::make($request_out['password'])
            
        ])->id;

        $new_name=null;
        if ($request['image']) {
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('cityManagers_images'), $new_name);
        }
        
        $CityManger=CityManger::create([
            'user_id'=>$user,
            'city_name'=>$request_out["city_name"],
            'national_id'=>$request_out["national_id"],
            'image_path'=> $new_name
        ]);

        $role_id = DB::table('roles')->where('name', 'city_manager')->value('id');
        User::find($user)->roles()->sync($role_id) ;

        return redirect('city_managers');
    }

    public function create(Request $request)
    {
        return view('city_manager.create');
    }


    public function edit($user_id)
    {
        $manager= CityManger::where('user_id', $user_id)->first();

        
        return view('city_manager.edit_city_manager_view', ['manager' => $manager]);
    }

    public function update(StoreCityManagerRequest $request, $user_id)
    {
        $request_out=$request->all();
        if($request['image']){
                $manager= CityManger::where('user_id', $user_id)->first();
                File::delete(public_path('cityManagers_images/'.$manager['image_path'])); 
                $image = $request->file('image');
                $new_name = rand() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('cityManagers_images'), $new_name); 
                User::where('id', $user_id)->update([
                    'name'=>$request_out["name"],
                    'email'=>$request_out["email"],
                    'password'=>$request_out["password"]
                ]);
                CityManger::where("user_id", $user_id)->update([
        
                    'city_name'=>$request_out["city"],
                    'national_id'=>$request_out["national_id"],
                    'image_path'=>$new_name,
                ]);
        }else{
            User::where('id', $user_id)->update([
                'name'=>$request_out["name"],
                'email'=>$request_out["email"],
                'password'=>$request_out["password"]
            ]);
            CityManger::where("user_id", $user_id)->update([
    
                'city_name'=>$request_out["city"],
                'national_id'=>$request_out["national_id"]
            ]);

        }

        
     

        return redirect('city_managers');
    }

    public function destroy(Request $request)
    {
        $request_out=$request->all();
        $cityManager=CityManger::where("id", $request_out['user_id'])->first();

        CityManger::where("id", $request_out['user_id'])->delete();

        User::where('id', $cityManager['user_id'])->delete();
        return back();
    }

   
    public function getCityManagers()
    {
        $data = CityManger::all();
        return DataTables::of($data)
        ->addColumn('action', function ($row) {
            return view('city_manager.edit_delete_form', compact('row'))->render();
        })
        -> make(true) ;
    }
    public function view($cityManagerId)
    {
        $manager=CityManger::find($cityManagerId);
        return view("city_manager.view_cityManager", ["manager"=>$manager]);
    }
   

    public function index()
    {
        return view('city_manager.view');
    }
}
