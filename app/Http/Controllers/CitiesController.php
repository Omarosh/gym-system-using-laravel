<?php

namespace App\Http\Controllers;
use yajra\Datatables\Datatables;
use App\Models\CityManger;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    public function index()
    {
        return view('cities.view');
    }

    public function getCities()
    {
        $data = CityManger::all();
        return DataTables::of($data)-> make(true);
    }
}
