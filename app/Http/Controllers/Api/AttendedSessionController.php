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
    public function store(Request $request)
    {
        $session = TrainingSession::find($request['training_session_id']);
        $date = explode(" ", $session->starts_at);
        //$trainee_package_id = Trainee::find($request['trainee_id'])->training_package_id;
        //$package_session_num = TrainingPackage::find($trainee_package_id)->num_of_sessions;

        //$sessions_attended_arr = AttendedSession::where('trainee_id', $request['trainee_id'])->first();
        //$sessions_attended = $sessions_attended_arr->count();

        $today_date = explode(" ", today());

        if ($today_date[0] === $date[0]) 
        {
            if ($sessions_attended < $package_session_num) {
                $attended_session = AttendedSession::create([
                    'trainee_id' => $request['trainee_id'],
                    'training_session_id' => $request['training_session_id'],
                ]);
                return $attended_session;
            } else {
                return "you must buy another package to attend the session ";
            }
        }else 
        {
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
