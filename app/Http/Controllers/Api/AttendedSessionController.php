<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AttendedSession;
use App\Models\Trainee;
use App\Models\TrainingPackage;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AttendedSessionController extends Controller
{
    public function storeGUI(Request $request)
    {
        $session = TrainingSession::find($request['training_session_id']);
        $date = explode(" ", $session->starts_at);
        $remaining_sessions = Trainee::find($request['trainee_id'])->remaining_session;
        
        $trn = Trainee::find($request['trainee_id']);
        $email = $trn->email;
        $sname = $session->name;
        $sid = $session->id;
        $today_date = explode(" ", today());
        $message = "";
        if ($today_date[0] === $date[0]) {
            $attended = AttendedSession::where('training_session_id', '=', $request['training_session_id'])->first();
            if ($attended === null) {
                if ($remaining_sessions > 0) {
                    $attended_session = AttendedSession::create([
                        'trainee_id' => $request['trainee_id'],
                        'training_session_id' => $request['training_session_id'],
                    ]);
                    
                    $trn->remaining_session = --$remaining_sessions;
                    $trn->save();
                    
                    $message =  "Attended Successfully! - Remaining sessions: ($remaining_sessions)";
                } else {
                    $message =  "Insufficient session credits. Buy a package to get more sessions";
                }
            } else {
                $message =  "Error! The trainee ($email) has already attended this session.";
            }
        } else {
            $message =  "you can only attend in session's day";
        }
        return redirect()->route('attendance')->with('message', $message) ;
    }
    public function store(Request $request)
    {
        $session = TrainingSession::find($request['training_session_id']);
        $date = explode(" ", $session->starts_at);
        $remaining_sessions = Trainee::find($request['trainee_id'])->remaining_session;
       
        $trn = Trainee::find($request['trainee_id']);
        $email = $trn->email;
        $sname = $session->name;
        $sid = $session->id;
        $today_date = explode(" ", today());

        if ($today_date[0] === $date[0]) {
            $attended = AttendedSession::where('training_session_id', '=', $request['training_session_id'])->first();
            if ($attended === null) {
                if ($remaining_sessions > 0) {
                    $attended_session = AttendedSession::create([
                        'trainee_id' => $request['trainee_id'],
                        'training_session_id' => $request['training_session_id'],
                    ]);

                    $trn->remaining_session = $remaining_sessions-1;
                    $trn->save();
                    return $attended_session;
                } else {
                    return "Insufficient session credits. Buy a package to get more sessions";
                }
            } else {
                return "Error! The trainee ($email) has already attended this session.";
            }
        } else {
            return "you can only attend in session's day";
        }
    }

    public function index()
    {
        return AttendedSession::all();
    }

    public function show($attended_session_id)
    {
        return AttendedSession::find($attended_session_id);
    }

    public function update(Request $request, $attended_session_id)
    {
        AttendedSession::where('id', $attended_session_id)->update([

            'trainee_id' => $request['trainee_id'],
            'training_session_id' => $request['training_session_id'],
        ]);
        return AttendedSession::find($attended_session_id);
    }

    public function destroy($attended_session_id)
    {
        AttendedSession::where('id', $attended_session_id)->delete();
    }

    public function getAttendance()
    {
        $models = AttendedSession::with(['trainee', 'session']);
        return DataTables::of($models)
            ->addColumn('traineename', function ($model) {
                return $model->trainee->name;
            })
            ->addColumn('traineeemail', function ($model) {
                return $model->trainee->email;
            })
            ->addColumn('sessions', function ($model) {
                return $model->session->name;
            })
            ->editColumn('date', function ($model) {
                return $model->created_at->format('d-m-Y');
            })
            ->editColumn('time', function ($model) {
                return $model->created_at->format('H:i');
            })
            ->addColumn('gym', function ($model) {
                return $model->session->gym->name;
            })
            ->addColumn('city', function ($model) {
                return $model->session->gym->city_name;
            })
            ->toJson();
    }

    public function view()
    {
        return view('attendance.view');
    }

    public function create()
    {
        return view('attendance.create');
    }
}
