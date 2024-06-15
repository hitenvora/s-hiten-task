<?php

namespace App\Http\Controllers;

use App\Models\CustomerDetails;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class SupervisorController extends Controller
{
    public function index()
    {
        return view('supervisor.index');
    }
    public function create()
    {
        return view('supervisor.create');
    }
    public function store(Request $request)
    {

        $validated = $request->validate([
            'supervisor_mobile_no' => 'required|unique:supervisors',
        ]);

        $supervisor = new Supervisor();
        $supervisor->supervisor_name = $request->supervisor_name;
        $supervisor->supervisor_mobile_no = $request->supervisor_mobile_no;
        $supervisor->save();
        return redirect()->route('supervisor.index');
    }
    public function edit($id)
    {
        $supervisor = Supervisor::find($id);
        return view('supervisor.edit',compact('supervisor'));
    }
    public function update(Request $request, $id)
    {
        $supervisor = Supervisor::find($id);
        $supervisor->supervisor_name = $request->supervisor_name;
        $supervisor->supervisor_mobile_no = $request->supervisor_mobile_no;
        $supervisor->save();
        return redirect()->route('supervisor.index');
    }
}