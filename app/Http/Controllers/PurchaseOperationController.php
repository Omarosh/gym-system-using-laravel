<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use yajra\Datatables\Datatables;
class PurchaseOperationController extends Controller
{
    public function getDatatables()
    {
        $operations=PurchaseOperation::all();
        return Datatables::of($operations)
            ->make(true);
    }

    public function index()
    {
        return view('purchase_operations.view');
    }
}
