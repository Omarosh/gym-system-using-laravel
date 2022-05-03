<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
// use Datatables;
use yajra\Datatables\Datatables;

class AttendanceController extends Controller
{
    public function index()
    {
        $model = Attendance::with(['trainee','session']); 
            return DataTables::eloquent($model) 
            ->addColumn('trainees', function (Attendance $attendance) { 
                    return ([$attendance->trainee->name , 
                    $attendance->trainee->email]); 
            }) 
            ->addColumn('sessions', function (Attendance $attendance) { 
                    return $attendance->session->name ;
            })
            ->toJson(); 

    }
    public function showView()
    {
        return view('datatables.attendance');
    }
}
