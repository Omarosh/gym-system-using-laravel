<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTraineeRequest;
use App\Http\Resources\AttendedSessionResource;
use App\Http\Resources\TraineeResource;
use App\Models\Attended;
use App\Models\Trainee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Notifications\verifiedTrainee;
use Illuminate\Validation\ValidationException;
use App\Models\TrainingPackage;


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
    public function store(StoreTraineeRequest $request )//,Request $request,)
    {
        if ($request->passwd === $request->passwd_confirmation)
        {
            $fileInRequest = $request->file('image'); 
            $request->merge(['imag_path' => $fileInRequest]);
            $request['passwd'] = Hash::make($request['passwd']);
            $trainee = Trainee::create($request->all());
            event(new Registered($trainee));
            $trainee->notify(new verifiedTrainee());   //send greeting notification this is needed to be done after verification
        }
        else {
            return "password and password_confirmation are not identical"; 
        }
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'passwd' => 'required',
            'device_name' => 'required',
        ]);
     
        $user = Trainee::where('email', $request->email)->first();
     
        if (! $user || ! Hash::check($request->passwd, $user->passwd)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
              
        $affected = Trainee::where('id', $user->id)
        ->update(['last_login' => date("Y-m-d")]);

        $token = $user->createToken($request->device_name)->plainTextToken;
        return ["user info"=> new TraineeResource($user),"token"=>$token];
       
        //Here is post method of meha
        // // $trainee = Trainee::create(['name','gender','date_of_birth','the path','email','passwd']);
        // $request['passwd'] = Hash::make($request['passwd']);
        // // dd($request->all());
        // $trainee = Trainee::create([
        //     'name'=>$request['name'],
        //     'gender'=>$request['gender'],
        //     'date_of_birth'=>$request['date_of_birth'],
        //     'imag_path'=>$request['imag_path'],
        //     'email'=>$request['email'],
        //     'passwd'=>$request['passwd'],
        //     'training_package_id'=>$request['training_package_id']
        // ]);
        // // event(new Registered($trainee));
        // return $trainee;
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
    public function update(StoreTraineeRequest $request)
    {
        $fileInRequest = $request->file('image'); 
        $request->merge(['imag_path' => $fileInRequest]);
        $request['passwd'] = Hash::make($request['passwd']);
        Trainee::where('id',$request->id)
        ->update([
          'name'=>$request->name,
          'gender'=>$request->gender,
          'email'=>$request->email,
          'date_of_birth'=>$request->date_of_birth,
          'passwd'=>$request->passwd,
          "imag_path"=>$request->imag_path,
        ]);
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
       $training_package_sessions=TrainingPackage::find($trainee_package_id)->num_of_sessions;
       $attended_sessions_arr=Attended::where('trainee_id',$id);
       $attended_sessions_num=$attended_sessions_arr->count();
       $remaining_sessions=$training_package_sessions-$attended_sessions_num;
    
    $obj=['training_package_sessions'=>   $training_package_sessions,

          'remaining_sessions'=>$remaining_sessions
        
    ];
      return $obj;

    

    }
    public function show_trainee_history($id){

        //training session name -> training sessions ->name
        //gym name -> gym id from training sessions->get gym name from gyms by id
        //attendance date-> created at in attended_sessions    done
        //attendance time -> created at in attended_sessions   done

        $attended_sessions=Attended::with('session')->where('trainee_id',$id)->get();
        
        return AttendedSessionResource::collection($attended_sessions);
        

    }
}
