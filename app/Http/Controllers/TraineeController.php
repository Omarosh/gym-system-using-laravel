<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTraineeRequest;
use App\Http\Resources\TraineeResource;
use App\Models\Trainee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Notifications\verifiedTrainee;
use Illuminate\Validation\ValidationException;




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
        $fileInRequest = $request->file('image'); 
        $request->merge(['imag_path' => $fileInRequest]);
        $request['passwd'] = Hash::make($request['passwd']);
        $trainee = Trainee::create($request->all());
        event(new Registered($trainee));
        $trainee->notify(new verifiedTrainee());   //send greeting notification this is needed to be done after verification

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $request->new_email = $request->new_email ?? $request->email;
        $trainee_id = Trainee::select("id")->where('email',$request->email)->first();
        Trainee::where('id',$trainee_id)
        ->update([
          'name'=>$request->name,
          'gender'=>$request->gender,
          'email'=>$request->new_email,
          'date_of_birth'=>$request->date_of_birth,

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
}
