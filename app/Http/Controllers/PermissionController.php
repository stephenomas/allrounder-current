<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function store(Request $request){

        $permission = Permission::create([
            "name" => $request->name
        ]);

        return response()->json($permission, 200);
    }
}
