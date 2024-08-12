<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Role;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeController extends Controller
{
    function getUserTask()  {

         $authUser = Auth::user()->id;

        $tasks = Task::with('assignee','creator','project')
        ->where('assigned_to',$authUser)
        ->get();
        
        return  view('admin.module.Employee.index',compact('tasks'));
    }

    public function getTaskEdit($id)
    {
       

        $tasks = Task::with('assignee','creator','project')
        ->where('id',$id)
        ->first();

        return view('admin.module.Employee.chnage-status',compact('tasks'));

    }
    public function getTaskStatus( Request $request,$id)
    {
       
        $tasks = Task::find($id);
        $tasks->status = $request->status;
        $tasks->save();

       return redirect('Employe/task/list');

    }
}
