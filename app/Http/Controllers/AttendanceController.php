<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use yajra\Datatables\Datatables;

class AttendanceController extends Controller
{
    public function getAttendance()
    {
        $models = Attendance::with(['trainee', 'session']);
        return DataTables::of($models)
            ->addColumn('traineename', function ($model) {
                return $model->trainee->name;     
            })
            ->addColumn('traineeemail', function ($model) {
                return $model->trainee->email ;
            })
            ->addColumn('sessions', function ($model) {
                return $model->session->name ; 
            })
            ->editColumn('date', function ($model) {
                return $model->created_at->format('d-m-Y');
            })
            ->editColumn('time', function ($model) {
                return $model->created_at->format('H:i');
            })
            ->addColumn('gym', function ($model) {
                return $model->session->gym->name ;
            })
            ->addColumn('city', function ($model) {
                return $model->session->gym->city_name ;
            })
            ->toJson();
    }
    public function index()
    {
        return view('attendance.view');
    }
}
