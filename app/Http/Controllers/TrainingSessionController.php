<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Models\TrainingSession;
use App\Models\AttendedSession;
use App\Models\Gym;


class TrainingSessionController extends Controller
{
    public function create(Request $request)
    {
        $gyms = [];
        foreach (Gym::all() as $k) {
            array_push($gyms, [$k["id"] , $k["name"]]);
        }
        return view('trainingSessions.create',['gyms'=>$gyms]);
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
        $gyms = [];
        foreach (Gym::all() as $k) {
            array_push($gyms, [$k["id"] , $k["name"]]);
        }
        return view('trainingSessions.edit_form', ['id'=>$id,'gyms'=>$gyms]);
    }

    public function update(Request $request, $id){
        $request_out=$request->all();
        if(AttendedSession::where("id",$id)->first()){
            return redirect()->back() ->with('alert', 'This session already had Trainees');
        }else{
            TrainingSession::where('id', $id)->update([
                'name'=> $request_out['name'],
                'gym_id'=> $request_out['gym_id'],
                'coach_id'=> $request_out['coach_id'],
                'starts_at'=> $request_out['starts_at'],
                'finishes_at'=> $request_out['finishes_at'],
            ]);
            return redirect('training_sessions');
        }

        
    }

    public function destroy(Request $request)
    {
        $request_out=$request->all();
        if(AttendedSession::where("id",$request_out['id'])->first()){
            return("maynf34 ya ngm");
        }else{
            TrainingSession::where("id", $request_out['id'])->delete();
            return("removed");
        }
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
