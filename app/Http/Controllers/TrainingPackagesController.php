<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Models\TrainingPackage;


class TrainingPackagesController extends Controller
{
    public function store(Request $request)
    {
        $request_out=$request->all();
        
        $trainingPackage=TrainingPackage::create([
            'name'=> $request_out['name'],
            'price'=> $request_out['price'],
            'num_of_sessions'=> $request_out['num_of_sessions'],
        ])->id;
        return $trainingPackage;
    }

    public function edit(Request $request, $id)
    {
        return view('edit_city_manager_view');
    }

    public function update(Request $request)
    {
        $request_out=$request->all();
        TrainingPackage::where('id', $request_out["id"])->update([
            'name'=> $request_out['name'],
            'price'=> $request_out['price'],
            'num_of_sessions'=> $request_out['num_of_sessions'],
        ]);
    }

    public function destroy(Request $request)
    {
        $request_out=$request->all();
        TrainingPackage::where("id",$request_out['id'] )->delete();
        return back();
    }

    public function getTrainingPackages()
    {
        $data = TrainingPackage::all();
        return DataTables::of($data)
        ->addColumn('action', function ($row) {
            return view('trainingPackages.edit_delete_form', compact('row'))->render();
        })
        -> make(true) ;
    }

    public function index(Request $request)
    {
        return view('trainingPackages.view');
    }
}