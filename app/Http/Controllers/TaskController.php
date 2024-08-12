<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getTask()
    {
        $employeeRole = Role::where('name', 'Employee')->first();
        $employees = $employeeRole->users;
        $projet = Project::get();

        $authUser = Auth::user()->id;

        $tasks = Task::with('assignee','creator','project')
        ->where('created_by',$authUser)
        ->get();

        return view('admin.module.Task.index', compact('employees', 'projet','tasks'));
    }

    public function TaskList($id)
    {
    
        $tasks = Task::with('assignee','creator','project')
        ->where('project_id',$id)
        ->get();

        return view('admin.module.project.task-list', compact('tasks'));
    }

    public function getPDF($id)
    {
        $tasks = Task::with('assignee', 'creator', 'project')
            ->where('project_id', $id)
            ->get();
    
        // Pass the tasks data as an array to the view
        $pdf = PDF::loadView('admin.module.pdf.pdf', ['tasks' => $tasks])
            ->setPaper('A4', 'portrait');
    
        return $pdf->stream('data.pdf');
    }


    public function getChart($id)
    {
        $tasks = Task::with('assignee', 'creator', 'project')
        ->where('project_id', $id)
        ->get();

        $chartArr = [
            'name' => $slug,
            'data' => null
        ];
       
        return response()->json($chartArr);
    }

   
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function taskAssign(Request $request)
    {
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'assigned_to' => 'required|exists:users,id',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date',
        ]);
        //  return back()->withErrors($validatedData)->withInput();
        $taskData = $request->all();
        $taskData['created_by'] = Auth::id(); // Assign the currently authenticated user's ID as the creator

        $task = Task::create($taskData); // Create a new task with the validated data

        // sending mail
         $user = User::findOrFail($request->assigned_to);
        // Email details
        $details = [
            'title' => 'Mail from gtech.com',
            'body' => 'This is for testing email using SMTP'
        ];
        // Send email
        Mail::to($user->email)->send(new \App\Mail\TaskNotificationMail($details));


        return redirect()->back();
    }


    /**
     * Display the specified resource.
     */
    public function taskEdit($id)
    {
        $projet = Project::get();
        $employeeRole = Role::where('name', 'Employee')->first();
        $employees = $employeeRole->users;

        $tasks = Task::with('assignee','creator','project')
        ->where('id',$id)
        ->first();

        return view('admin.module.Task.update',compact('tasks','projet','employees'));

    }

    /**
     * Show the form for editing the specified resource.
     */
  
    /**
     * Update the specified resource in storage.
     */
    public function taskUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'assigned_to' => 'required|exists:users,id',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date',
        ]);
        return back()->withErrors($validatedData)->withInput();
        $project = Task::find($id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->project_id = $request->project_id;
        $project->status = $request->status;
        $project->assigned_to = $request->assigned_to;
        $project->priority = $request->priority;
        $project->due_date = $request->due_date;
        $project->save();
        return  redirect('manager/task');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function taskDelete($id)
    {
        $project = Task::find($id);
        $project->delete();
        return redirect()->back();
    }


    public function showChart()
{
     $taskData = Task::select('status', 'priority', \DB::raw('count(*) as total'))
                    ->groupBy('status', 'priority')
                    ->get();

    $statuses = ['pending', 'in_progress', 'completed'];
    $priorities = ['low', 'medium', 'high'];

    $chartData = [];

    foreach ($statuses as $status) {
        foreach ($priorities as $priority) {
            $count = $taskData->where('status', $status)->where('priority', $priority)->first()->total ?? 0;
            $chartData[$status][$priority] = $count;
        }
    }
    // return $chartData;
    return view('chart', compact('chartData'));
}
public function searchTask(Request $request)
{
    $query = Task::query();
    // return $request ;
    // Filter by status
    if ($request->filled('status')) {
         $query->where('status', $request->input('status'));
    }

    // Filter by priority
    if ($request->filled('priority')) {
        $query->where('priority', $request->input('priority'));
    }

    // Filter by due_date
    if ($request->filled('due_date')) {
        $query->whereDate('due_date', $request->input('due_date'));
    }

    // Execute the query and get the results
     $tasks = $query->get();
    
    return view('admin.module.project.search',compact('tasks'));
}


public function searchTaskData(Request $request)
{
    $query = Task::query();
    // return $request ;
    // Filter by status
    if ($request->filled('status')) {
         $query->where('status', $request->input('status'));
    }

    // Filter by priority
    if ($request->filled('priority')) {
        $query->where('priority', $request->input('priority'));
    }

    // Filter by due_date
    if ($request->filled('due_date')) {
        $query->whereDate('due_date', $request->input('due_date'));
    }

    // Execute the query and get the results
    return $tasks = $query->get();
}
}
