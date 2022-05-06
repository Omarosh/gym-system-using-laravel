<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use yajra\Datatables\Datatables;
use App\Models\TrainingSession;
use App\Models\AttendedSession;
use App\Models\Gym;
use App\Models\Coach;
use Carbon\Carbon;


class TrainingSessionController extends Controller
{
    public function create(Request $request)
    {
        $gyms = [];
        foreach (Gym::all() as $k) {
            array_push($gyms, [$k["id"] , $k["name"]]);
        }
        $coaches = [];
        foreach (Coach::all() as $k) {
            array_push($coaches, [$k["id"] , $k["name"]]);
        }
        return view('trainingSessions.create',['gyms'=>$gyms,'coaches'=>$coaches]);
    }
    
    public function store(Request $request)
    {
        $request_out=$request->all();
        if(TrainingSession::where('gym_id',$request_out['gym_id'])->whereBetween('finishes_at',[$request->starts_at, $request->finishes_at])->exists()){
            return redirect()->back() ->with('alert', 'There is a session in this period');
        }else if(TrainingSession::where('gym_id',$request_out['gym_id'])->whereBetween('starts_at',[$request->starts_at, $request->finishes_at])->exists()){
            return redirect()->back() ->with('alert', 'There is a session in this period');
        }else{
            $trainingPackage=TrainingSession::create([
                'name'=> $request_out['name'],
                'gym_id'=> $request_out['gym_id'],
                'coach_id'=> $request_out['coach_id'],
                'starts_at'=> $request_out['starts_at'],
                'finishes_at'=> $request_out['finishes_at'],
            ])->id;
            
            return redirect('training_sessions');
        }
        
            
        // }
        
    }

    public function edit(Request $request, $id)
    {
        $gyms = [];
        foreach (Gym::all() as $k) {
            array_push($gyms, [$k["id"] , $k["name"]]);
        }
        $coaches = [];
        foreach (Coach::all() as $k) {
            array_push($coaches, [$k["id"] , $k["name"]]);
        }
        return view('trainingSessions.edit_form', ['id'=>$id,'gyms'=>$gyms,'coaches'=>$coaches]);
    }

    public function update(Request $request, $id){
        $request_out=$request->all();
        if(AttendedSession::where("id",$id)->first()){
            return redirect()->back() ->with('alert', 'This session already had Trainees');
        }else{
            if(TrainingSession::where('gym_id',$request_out['gym_id'])->whereBetween('finishes_at',[$request->starts_at, $request->finishes_at])->exists()){
                return redirect()->back() ->with('alert', 'There is a session in this period');
            }else if(TrainingSession::where('gym_id',$request_out['gym_id'])->whereBetween('starts_at',[$request->starts_at, $request->finishes_at])->exists()){
                return redirect()->back() ->with('alert', 'There is a session in this period');
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

    public function getTrainingSessions(){
        $data = TrainingSession::all();
        return DataTables::of($data)
        ->addColumn('action', function ($row) {
            return view('trainingSessions.edit_delete_buttons', compact('row'))->render();
        })
        -> make(true) ;
    }

    public function index(Request $request){
        return view('trainingSessions.view');
    }
}
