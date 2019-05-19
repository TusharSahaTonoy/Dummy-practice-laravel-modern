<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Dummy;
use Yajra\DataTables\DataTables;
use Alert;

class OperationController extends Controller
{
    public function show()
    {
        return view('display');
    }

    public function resource()
    {
        $dummies = Dummy::all();

        return DataTables::of($dummies)->addColumn('action',function($dummies){
            return  
            '<a onclick="showData('.$dummies->id.',1)" class = "btn btn-success"><i class="fas fa-eye"></i></a>
            <a onclick="showData('.$dummies->id.',2)" class = "btn btn-warning"><i class="fas fa-pencil-alt"></i></a>
            <a onclick="showData('.$dummies->id.',3)" class = "btn btn-danger"><i class="fas fa-trash"></i></a>';
        })->make(true);
    }

    public function addDummy(Request $request)
    {
        if(($request->all())!=null)
        {
            $data = [
                'name'=>$request->input('name'),
                'email'=>$request->input('email'),
                'gender'=>$request->input('gender')
            ];
            $check = /* true; */Dummy::insert($data);
            $status = false;
            if($check){ 
                $status = true;
            }

            return Response()->json($status);
        }
    }
    public function showDummy(Request $request)
    {
        $dummy = Dummy::find($request->input('id'));
        return Response()->json($dummy);
    }

    public function updateDummy(Request $request)
    {
        $dummy = Dummy::find($request->input('dummy_id'));
        
        $dummy->name = $request->input('name');
        $dummy->email = $request->input('email');
        $dummy->gender = $request->input('gender');

        $check = $dummy->save();
        $status = false;
        if($check){ 
            $status = true;
        }

        return Response()->json($status);
    }

    


}
