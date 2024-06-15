<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;
use App\Models\AMC;

class TaskController extends Controller
{
    //
    function view_calendar(Request $request)
    {
        return view('calendar.index');

        // return \File::get(public_path() . '/calender/dynamic-full-calendar.html');

    }
    function add_task(Request $request)
    {
        $task= new task();

        $task->task_name=$request->task_name;
        $task->start_date_time=$request->start_date_time;
        $task->end_date_time=$request->end_date_time;

        $task->save();

        $task->id;
        return redirect()->back();

    }
    function get_calendar ()
    {
        $tasks = task::all();

        $events = [];
        foreach ($tasks as $task) {
            $events[] = [
                'title' => $task->task_name,
                'start' => $task->start_date_time,
                'end' => $task->end_date_time,
            ];
        }

        return response()->json($events);
    }

    public function calender(Request $request)
    {
  
        if($request->ajax()) {
    
            $currentDate = date('Y-m-d');
            $thirtyDaysLater = date('Y-m-d', strtotime('+30 days'));
                $data = AMC::join('users', 'amcs._user_id', '=', 'users.id')
                               ->join('amc_visit', 'amc_visit._amc_id', '=', 'amcs.id')
                               ->select('users.name', 'amcs.*', 'amc_visit.*')
                               ->whereBetween('amc_visit.visit_date', [$currentDate, $thirtyDaysLater])
                               ->get();
  
             return response()->json($data);
        }
  
        return view('calendar.fullcalender');
    }

}
