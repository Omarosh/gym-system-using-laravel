<?php

namespace App\Http\Controllers;

use App\Models\CityManger;
use App\Models\Coach;
use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\GymManger;
use Illuminate\Support\Facades\File;
use yajra\Datatables\Datatables;

class GymController extends Controller
{
    public function create(Request $request)
    {
        return view('gyms.create');
    }
    
    public function store(Request $request)
    {
        $new_name=null;
        if ($request['image']) {
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('gyms_images'), $new_name);
        }
        $request_out=$request->all();
        $citymanger=CityManger::where('city_name', $request_out['city_name'])->first();
        Gym::create([
            'city_manger_id'=>$citymanger->user_id,
            'name'=>$request_out['name'],
            'cover_image_path'=>$new_name,
            'city_name'=> $request_out['city_name'],
        ]);

        return view('gyms.view');
    }


    public function update(Request $request)
    {
        $request_out=$request->all();
        $citymanger=CityManger::where('city_name', $request_out['city_name'])->first();
        if ($request['image']) {
            $gym= Gym::find($request['gym_id']);
            File::delete(public_path('gyms_images/'. $gym['cover_image_path']));
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('gyms_images'), $new_name);
            Gym::where('id', $request['gym_id'])->update([
                        'city_manger_id'=>$citymanger->user_id,
                        'name'=>$request_out['name'],
                        'cover_image_path'=>$new_name,
                        'city_name'=> $request_out['city_name'],

                    ]);
        } else {
            Gym::where('id', $request['gym_id'])->update([
                'city_manger_id'=>$citymanger->user_id,
                'name'=>$request_out['name'],
                'city_name'=> $request_out['city_name'],

            ]);
        }
    }

    public function delete(Request $request)
    {
        Gym::where('id', $request['gym_id'])->delete();
        $gymmanger=GymManger::where('gym_id', $request['gym_id'])->first();
        GymManagerController::destroy($gymmanger->user_id);
        $coaches=Coach::where('gym_id', $request['gym_id'])->delete();
    }

    public function allGyms()
    {
        $gyms= Gym::all();
    }

    public function gymDatatables()
    {
        $gyms=Gym::with('CityManger');
        return Datatables::of($gyms)
            ->editColumn('created_at', function ($gym) {
                return $gym->created_at->format('d-m-Y');
            })
            ->addColumn('cityManager', function ($gym) {
                return $gym->city_name;
            })
            ->addColumn('action', function ($row) {
                return view('gyms.edit_delete_buttons', compact('row'))->render();
            })
            ->make(true);
    }

    public function index()
    {
        return view('gyms.view');
    }
    public function view($gymId){
        $gym=Gym::find($gymId);
        return view("gyms.view_gym",["gym"=>$gym]);
    }
}
