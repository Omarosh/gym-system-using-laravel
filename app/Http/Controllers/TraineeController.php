<?php

namespace App\Http\Controllers;

use App\Http\Resources\TraineeResource;
use App\Models\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\AttendedSession;
use App\Models\Trainingpackege;


class TraineeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "hello";
        return new TraineeResource;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        // $trainee = Trainee::create(['name','gender','date_of_birth','the path','email','passwd']);
        $request['passwd'] = Hash::make($request['passwd']);
        // dd($request->all());
        $trainee = Trainee::create([
            'name'=>$request['name'],
            'gender'=>$request['gender'],
            'date_of_birth'=>$request['date_of_birth'],
            'imag_path'=>$request['imag_path'],
            'email'=>$request['email'],
            'passwd'=>$request['passwd'],
            'training_package_id'=>$request['training_package_id']
        ]);
        // event(new Registered($trainee));
        return $trainee;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
        $trainee=Trainee::find($id);
        // dd($trainee->name);
        return $trainee;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function show_trainee_sessions($id){
       $trainee_package_id=Trainee::find($id)->training_package_id;
       $training_package_sessions=Trainingpackege::find($trainee_package_id)->num_of_sessions;
       $attended_sessions_arr=AttendedSession::where('trainee_id',$id);
       $attended_sessions_num=$attended_sessions_arr->count();
       $remaining_sessions=$training_package_sessions-$attended_sessions_num;
    //    dd($training_package_sessions,$remaining_sessions);
   
    
    //   $obj->training_package_sessions=  $training_package_sessions;
    //   dd($obj);
    $obj=['training_package_sessions'=>   $training_package_sessions,

          'remaining_sessions'=>$remaining_sessions
        
    ];
      return $obj;

    

    }


}
