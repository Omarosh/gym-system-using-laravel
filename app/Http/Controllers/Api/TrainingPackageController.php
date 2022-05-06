<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TrainingPackage;
use Illuminate\Http\Request;

class TrainingPackageController extends Controller
{
    public function store(Request $request)
    {
        $input = $request->all();
        
       
            
        
        
        $package=TrainingPackage::create([
        'name'=>$input['name'],
        'price'=>$input['price'],
        'num_of_sessions'=>$input['num_of_sessions'],
       
    ]);
    return $package;
    }
}
