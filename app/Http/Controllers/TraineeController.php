<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Models\Trainee;


class TraineeController extends Controller
{
    public function store(Request $request)
    {
        $request_out=$request->all();
        
        $trainee=Trainee::create([
            'name'=> $request_out['name'],
            'gender'=> $request_out['gender'],
            'date_of_birth'=> $request_out['date_of_birth'],
            // 'imag_path'=> $request_out['imag_path'],
            'email'=> $request_out['email'],
            'password' => $request_out['password']
        ])->id;
        return $trainee;
    }

    public function edit(Request $request, $id)
    {
        return view('trainees.edit_form', ['id'=>$id]);
    }

    public function update(Request $request, $id)
    {
        $request_out=$request->all();
        Trainee::where('id', $id)->update([
            'name'=> $request_out['name'],
            'gender'=> $request_out['gender'],
            'date_of_birth'=> $request_out['date_of_birth'],
            // 'imag_path'=> $request_out['imag_path'],
            'email'=> $request_out['email'],
            'passwd' => $request_out['password']
        ]);
        return view('trainees.view');
    }

    public function destroy(Request $request)
    {
        $request_out=$request->all();
        Trainee::where("id",$request_out['id'] )->delete();
        return back();
    }

    public function getTrainees()
    {
        $data = Trainee::all();
        return DataTables::of($data)
        ->addColumn('action', function ($row) {
            return view('trainees.edit_delete_form', compact('row'))->render();
        })
        -> make(true) ;
    }

    public function index(Request $request)
    {
        return view('trainees.view');
    }
}
