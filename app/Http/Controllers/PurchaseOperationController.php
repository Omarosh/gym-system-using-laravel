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

    public function payment_success(Request $request)
    {
        // echo "Session: ";
        // var_dump(Session::get('client_secrets'));
        // echo "request:" ;
        // dd($request->all()["payment_intent_client_secret"]);
        // if (isset($request->all()["redirect_status"]) && Session::has('client_secrets')) {
        //     if ($request->all()["redirect_status"] === "succeeded" && Session::get('client_secrets') == $request->all()["payment_intent_client_secret"]) {
        //     }
        // }
        return view('purchase_operations.view', ['success' => 'success']);
    }

    public function index(Request $request)
    {
        // echo "Session: ";
        // var_dump(Session::get('client_secrets'));
        // echo "request:" ;
        // dd($request->all()["payment_intent_client_secret"]);
        // if (isset($request->all()["redirect_status"]) && Session::has('client_secrets')) {
        //     if ($request->all()["redirect_status"] === "succeeded" && Session::get('client_secrets') == $request->all()["payment_intent_client_secret"]) {
        //     }
        // }
        // return view('purchase_operations.view');

        
        // $gymid = GymManger::where('user_id' , Auth::id())->select(['gym_id'])->first();
        // $gym = PurchaseOperation::where('gym_id',$gymid->gym_id)->sum('price');

        $cityManagerId = Gym::where('city_manger_id',Auth::id())->select(['id'])->first();
        $city = PurchaseOperation::where('gym_id',$cityManagerId->id)->sum('price');
                return view('purchase_operations.view',[
            // "gym" => $gym,
            "city" => $city
        ]);
    }
    public function store(Request $request)
    {
        //
    }
    public function buy_package()
    {
        return view('purchase_operations.buy_package');
    }

    public function totalRevenue()
    {
        $total = PurchaseOperation::select('price','surname')->sum();
        return view('purchase_operations.view',["total"=>$total]);
    }
}
