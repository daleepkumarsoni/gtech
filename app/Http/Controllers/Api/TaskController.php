<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $authUser = Auth::user()->id;
        // Retrieve tasks created by the authenticated user, including related data
        $tasks = Task::with(['assignee', 'creator', 'project'])
            ->where('created_by', $authUser)
            ->get();
        // Return the tasks as a JSON response
        return response()->json([
            'success' => true,
            'tasks' => $tasks
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
            'assigned_to' => 'required|exists:users,id',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date',
        ]);

        $user = auth()->user();
        // Check if the user has the 'admin' role
        if (!$user->hasRole('manager')) {
           return response()->json(['error' => 'Unauthorized'], 403);
       }

        // Prepare the task data
        $taskData = $request->all();
        $taskData['created_by'] = Auth::id(); // Assign the currently authenticated user's ID as the creator

        // Create a new task with the validated data
        $task = Task::create($taskData);

        // sending mail
        $user = User::findOrFail($request->assigned_to);
        // Email details
        $details = [
            'title' => 'Mail from gtech.com',
            'body' => 'This is for testing email using SMTP'
        ];
        // Send email
        Mail::to($user->email)->send(new \App\Mail\TaskNotificationMail($details));

        // Return a success response with the newly created task
        return response()->json([
            'success' => true,
            'message' => 'Task created successfully',
            'task' => $task
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'required|exists:projects,id',
            'status' => 'required|in:pending,in_progress,completed',
            'assigned_to' => 'required|exists:users,id',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'required|date',
        ]);

        $user = auth()->user();
        // Check if the user has the 'admin' role
        if (!$user->hasRole('manager')) {
           return response()->json(['error' => 'Unauthorized'], 403);
       }
        // Find the task by ID
        $task = Task::find($id);

        // Check if the task exists
        if (!$task) {
            return response()->json([
                'success' => false,
                'message' => 'Task not found'
            ], 404);
        }

        // Update the task with validated data
        $task->name = $request->name;
        $task->description = $request->description;
        $task->project_id = $request->project_id;
        $task->status = $request->status;
        $task->assigned_to = $request->assigned_to;
        $task->priority = $request->priority;
        $task->due_date = $request->due_date;
        $task->save();

        // Return a success response with the updated task
        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully',
            'task' => $task
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        
        $user = auth()->user();
        // Check if the user has the 'manager' role
        if (!$user->hasRole('manager')) {
           return response()->json(['error' => 'Unauthorized'], 403);
       }
         // Find the task by ID
         $task = Task::find($id);

         // Check if the task exists
         if (!$task) {
             return response()->json([
                 'success' => false,
                 'message' => 'Task not found'
             ], 404);
         }
 
         // Delete the task
         $task->delete();
 
         // Return a success response
         return response()->json([
             'success' => true,
             'message' => 'Task deleted successfully'
         ], 200);
    }
}
