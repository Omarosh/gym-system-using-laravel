<?php

namespace App\Http\Controllers;

use App\Models\TrainingSession;
use Illuminate\Http\Request;

class TrainingSessionController extends Controller
{
    public function store(Request $request){
        $session=TrainingSession::create([
            'name'=>$request['name'],
            'starts_at'=>$request['starts_at'],
            'finishes_at'=>$request['finishes_at'],
            'gym_id'=>$request['gym_id'],
            'coach_id'=>$request['coach_id'],

        ]);
        return $session;
    }

    public function index(){
        return TrainingSession::all();
    }

   public function show($sessionId){
      return TrainingSession::find($sessionId);
   }

   public function update(Request $request , $sessionId){
       TrainingSession::where('id',$sessionId)->update([
           
        'name'=>$request['name'],
        'starts_at'=>$request['starts_at'],
        'finishes_at'=>$request['finishes_at'],
        'gym_id'=>$request['gym_id'],
        'coach_id'=>$request['coach_id'],
       
       ]);
       return TrainingSession::find($sessionId);
   }

   public function destroy($sessionId){
    TrainingSession::where('id',$sessionId)->delete();
   }


}
