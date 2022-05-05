<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;
use yajra\Datatables\Datatables;
class CoachController extends Controller
{
    public function index(){
      return view('coaches.view');
    }

    public function getCoaches()
    {
        $data = Coach::all();
        return DataTables::of($data)
        ->addColumn('action', function ($row) {
            return view('coaches.edit_delete_buttons', compact('row'))->render();
        })
        -> make(true) ;
    }

    public function show($coachId){
        return Coach::find($coachId);
    }

    public function create(Request $request)
    {
        return view('coaches.create');
    }

    public function store(Request $request){
     $input = $request->all();
      $coach= Coach::create([
      'name'=>$input['name'],
      'gym_id'=>$input['gym_id'],
      ]);
       return redirect('coaches');
    }

    public function edit($id)
    {
        return view('coaches.edit_form', ['id' => $id]);
    }

    public function update(Request $request ,$coachId){
      $input = $request->all();
      Coach::where('id',$coachId)->update([
        'name'=>$input['name'],
        'gym_id'=>$input['gym_id'],
     ]);
      return redirect('coaches');
    }

    public function destroy(Request $request){
      $request_out=$request->all();
      Coach::where("id", $request_out['id'])->delete();
      return back();
    }


}
