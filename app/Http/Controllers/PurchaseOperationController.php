<?php

namespace App\Http\Controllers;

use App\Models\CityManger;
use App\Models\Gym;
use Illuminate\Support\Facades\Auth;
use App\Models\PurchaseOperation;
use App\Models\GymManger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use yajra\Datatables\Datatables;
use Session;

class PurchaseOperationController extends Controller
{
    public function getDatatables()
    {
        $operations = PurchaseOperation::with(['trainee', 'gym', 'user', 'training_package']);
        return Datatables::of($operations)
            ->addColumn('traineename', function ($operation) {
                return $operation->trainee->name;
            })
            ->addColumn('traineeemail', function ($operation) {
                return $operation->trainee->email;
            })
            ->addColumn('packagename', function ($operation) {
                return $operation->training_package->name ?? 'None';
            })
            ->addColumn('gym', function ($operation) {
                return $operation->gym->name;
            })
            ->addColumn('city', function ($operation) {
                return $operation->gym->city_name;
            })
            ->addColumn('createdby', function ($operation) {
                return $operation->user->name;
            })
            ->make(true);
    }

   

    public function index(Request $request)
    {
        $cc = CityManger::where("user_id", Auth::id())->first();
        $total_city = "nope";
        if ($cc !== null) {
            $city = $cc->city_name;
            $gymId = Gym::where('city_name', "=", $city)->get();
            $total_city = 0;
            foreach ($gymId as $key => $value) {
                $total_city += PurchaseOperation::where('gym_id', $value->id)->sum('price');
            }
        }
        
        $gym_man = GymManger::where('user_id', Auth::id())->first();
        $total_gym = "nope";
        if ($gym_man !== null) {
            $gym_id = $gym_man->gym_id;
            $total_gym = PurchaseOperation::where('gym_id', $gym_id)->sum('price');
        }
        $total_admin = "nope";
        if ($total_city === "nope" && $total_gym === "nope") {
            $total_admin = PurchaseOperation::all()->sum('price');
        }
        $data = [
            "city" => $total_city,
            "gym" => $total_gym,
            "admin" => $total_admin,
        ];
        return view('purchase_operations.view', $data);
    }
   
    

    public function totalRevenue()
    {
        $total = PurchaseOperation::select('price', 'surname')->sum();
        return view('purchase_operations.view', ["total"=>$total]);
    }
}
