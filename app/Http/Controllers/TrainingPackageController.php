<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trainingpackege;
class TrainingPackageController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();
        
       
            
        
        
        $package=Trainingpackege::create([
        'name'=>$input['name'],
        'price'=>$input['price'],
        'num_of_sessions'=>$input['num_of_sessions'],
       
    ]);
    return $package;
    }
}