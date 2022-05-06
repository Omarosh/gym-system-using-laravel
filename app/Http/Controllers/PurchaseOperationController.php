<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use yajra\Datatables\Datatables;
use Session;

class PurchaseOperationController extends Controller
{
    public function getDatatables()
    {
        $operations=PurchaseOperation::all();
        return Datatables::of($operations)
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
        return view('purchase_operations.view', ['success'=>'success']);
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
        return view('purchase_operations.view');
    }
    public function store(Request $request)
    {
        //
    }
    public function buy_package()
    {
        return view('purchase_operations.buy_package');
    }
}
