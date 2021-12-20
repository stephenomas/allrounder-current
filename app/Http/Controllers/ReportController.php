<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function create()
    {
        $bran = User::all();
        return view('add-report', compact('bran'));
    }

    public function store()
    {
        $user = Auth::user();
        if(Auth::user()->role == 1){
            $to = request('from');
        }else{
            $to = 0;
        }
        Auth::user()->report()->create([
            'title' => request('title'),
            'body' => request('body'),
            'from' => $to

        ]);
        return back()->with('message', 'Report added successfully');
    }

    public function outindex()
    {
        $id = Auth::user()->id;
        $role = Auth::user()->role;

        $rep = Report::where('user_id', $id)->orderBy('id', 'desc')->get();


        return view('reports',compact('rep'));
    }
    public function inindex()
    {
            $id = Auth::user()->id;
            $role = Auth::user()->role;
            if($role == 1){
                $rep = Report::where('from', 0)->orderBy('id', 'desc')->get();
            }else{
                $rep = Report::where('from', $id)->orderBy('id', 'desc')->get();
            }


        return view('view-incoming',compact('rep'));
    }

    public function edit(Report $report)
    {

        $uid = Auth::user()->id;
        $role = Auth::user()->role;
        if($role == 1 || $report->user_id == $uid){
            return view('edit-report',compact('report'));

        }else{
            return back();
        }


    }

    public function read(Report $report)
    {
        $uid = Auth::user()->id;
        $role = Auth::user()->role;
        if($role == 1 || $report->from == $uid){
            return view('read-report',compact('report'));

        }else{
            return back();
        }

    }

    public function update(Report $report)
    {
        $report->update(request()->all());
       return back()->with('message', 'Report updated successfully');
    }

    public function destroy(Report $report)
    {
        $user = Auth::user()->id;

        if($report->user->id == $user){
            $report->delete();
            return back();
        }else{
            return back();
        }

    }

}
