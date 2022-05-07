<?php

namespace App\Http\Controllers;

use App\Models\CityManger;
use App\Models\User;

use App\Models\Coach;
use Illuminate\Http\Request;
use App\Models\Gym;
use App\Models\TrainingSession;
use App\Models\GymManger;
use Illuminate\Support\Facades\File;
use yajra\Datatables\Datatables;

class GymController extends Controller
{
    public function create(Request $request)
    {
        $cities = [];
        foreach (CityManger::all() as $k) {
            array_push($cities, [$k["id"] , $k["city_name"]]);
        }
        
        return view('gyms.create', ['cities' => $cities]);
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
        Gym::create([
            'name'=>$request_out['name'],
            'cover_image_path'=>$new_name,
            'city_name'=> $request_out['city_name'],
        ]);

        return redirect('gyms');
    }

    public function edit(Request $request, $id)
    {
        $cities = [];
        foreach (CityManger::all() as $k) {
            array_push($cities, [$k["id"] , $k["city_name"]]);
        }
        $gym= Gym::where('id', $id)->first();

        return view('gyms.edit_form', ['gym'=>$gym,'cities' => $cities]);
    }

    public function update(Request $request, $id)
    {
        $request_out=$request->all();
        if ($request['image']) {
            $gym= Gym::find($id);
            File::delete(public_path('gyms_images/'. $gym['cover_image_path']));
            $image = $request->file('image');
            $new_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('gyms_images'), $new_name);
            Gym::where('id', $id)->update([
                'name'=>$request_out['name'],
                'cover_image_path'=>$new_name,
                'city_name'=> $request_out['city_name'],

            ]);
        } else {
            Gym::where('id', $id)->update([
                'name'=>$request_out['name'],
                'city_name'=> $request_out['city_name'],

            ]);
        }

        return redirect('gyms');
    }

    public function destroy(Request $request)
    {
        $request_out=$request->all();

        $gym_has_sessions = TrainingSession::where('gym_id', '=', $request_out['id'])->first();

        if ($gym_has_sessions === null) {
            Gym::where("id", $request_out['id'])->delete();
            return ('removed');
        } else {
            return('doesnt removed');
        }
    }

    public function allGyms()
    {
        $gyms= Gym::all();
    }

    public function gymDatatables()
    {
        $gyms=Gym::all();
        return Datatables::of($gyms)
            ->editColumn('created_at', function ($gym) {
                return $gym->created_at->format('d-m-Y');
            })
            ->addColumn('cityName', function ($gym) {
                return $gym->city_name;
            })
            ->addColumn('username', function ($gym) {
                $cityManagerId=CityManger::where('city_name', $gym->city_name)->first();
                return $cityManagerId->user->name;
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
    public function view($gymId)
    {
        $gym=Gym::find($gymId);
        return view("gyms.view_gym", ["gym"=>$gym]);
    }
}
