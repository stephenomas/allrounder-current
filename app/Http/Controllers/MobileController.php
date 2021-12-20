<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    public function create(Request $request){
        $data = request()->validate([
            'name' => 'required|unique:branches',
            'state' => 'required',
            'address' => 'required'
        ]);

        $branch = Branch::create([
            'name'=> $data['name'],
            'state' => $data['state'],
            'address' => $data['address'],
            'creator' => 1,
        ]);

        return response($branch, 201);
    }

    public function index(){
        $branch = Branch::all();

        return response($branch, 201);
    }

    public function edit(Branch $branch){
        return $branch;
    }

    public function update(Request $request, Branch $branch){
        if($request->name != $branch->name){
            $data = request()->validate([
                'name' => 'required|unique:branches',
                'state' => 'required',
                'address' => 'required'
            ]);

        }else{

                $data = request()->validate([
                    'name' => 'required',
                    'state' => 'required',
                    'address' => 'required'
                ]);
        }

        $branch->update([
            'name'=> $data['name'],
            'state' => $data['state'],
            'address' => $data['address'],
        ]);

        $response = [
            'message' => 'Updated successfully'
        ];

        return response($response, 201);
    }
}
