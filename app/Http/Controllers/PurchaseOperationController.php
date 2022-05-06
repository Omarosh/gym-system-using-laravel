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
            ->addColumn('packegename', function ($operation) {
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
        $cc = CityManger::where("user_id", Auth::id())->first()->id ;
        $gymId = Gym::where('city_manger_id', $cc)->first()->id;
        $city = PurchaseOperation::where('gym_id', $gymId)->sum('price');
        return view('purchase_operations.view', [
            "city" => $city
        ]);
    }
   
    

    public function totalRevenue()
    {
        $total = PurchaseOperation::select('price', 'surname')->sum();
        return view('purchase_operations.view', ["total"=>$total]);
    }
}
