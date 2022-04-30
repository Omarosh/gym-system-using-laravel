<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;
class CoachController extends Controller
{
    public function index(){
     return Coach::all();
    }

    public function show($coachId){
        return Coach::find($coachId);
    }

    public function store(Request $request){
     $input = $request->all();
    $coach= Coach::create([

     'name'=>$input['name'],
     'gym_id'=>$input['gym_id'],
     


     ]);
       return $coach;
    }

    public function update(Request $request ,$coachId){
        $input = $request->all();
      Coach::where('id',$coachId)->update([
        
        'name'=>$input['name'],
        'gym_id'=>$input['gym_id'],

     ]);
        $coach= Coach::find($coachId);
      return $coach;

    }

    public function destroy($coachId){
        Coach::where('id',$coachId)->delete();
    }


}
