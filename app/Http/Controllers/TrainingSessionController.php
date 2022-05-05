<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Models\TrainingSession;


class TrainingSessionController extends Controller
{
    public function create(Request $request)
    {
        return view('trainingSessions.create');
    }
    
    public function store(Request $request)
    {
        $request_out=$request->all();
        
        $trainingPackage=TrainingSession::create([
            'name'=> $request_out['name'],
            'gym_id'=> $request_out['gym_id'],
            'coach_id'=> $request_out['coach_id'],
            'starts_at'=> $request_out['starts_at'],
            'finishes_at'=> $request_out['finishes_at'],
        ])->id;
        
        return redirect('training_sessions');
    }

    public function edit(Request $request, $id)
    {
        return view('trainingSessions.edit_form', ['id'=>$id]);
    }

    public function update(Request $request, $id){
        $request_out=$request->all();
        TrainingSession::where('id', $id)->update([
            'name'=> $request_out['name'],
            'gym_id'=> $request_out['gym_id'],
            'coach_id'=> $request_out['coach_id'],
            'starts_at'=> $request_out['starts_at'],
            'finishes_at'=> $request_out['finishes_at'],
        ]);

        return redirect('training_sessions');
    }

    public function destroy(Request $request)
    {
        $request_out=$request->all();
        TrainingSession::where("id", $request_out['id'])->delete();
        return back();
    }

    public function getTrainingSessions()
    {
        $data = TrainingSession::all();
        return DataTables::of($data)
        ->addColumn('action', function ($row) {
            return view('trainingSessions.edit_delete_buttons', compact('row'))->render();
        })
        -> make(true) ;
    }

    public function index(Request $request)
    {
        return view('trainingSessions.view');
    }
}
