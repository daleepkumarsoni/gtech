<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Task;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'comment' => 'required|string|max:255',
            'task_id' => 'required|exists:tasks,id',
        ]);


        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
       
        // Get the authenticated user's ID
        $auth = Auth::user()->id;

        // Create a new comment
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->user_id = $auth;
        $comment->task_id = $request->task_id;
        $comment->save();

        // Return a success response with the created comment
        return response()->json([
            'success' => true,
            'message' => 'Comment added successfully',
            'comment' => $comment
        ], 200);
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showWithComments($id)
    {
         // Find the task by ID
         $task = Task::find($id);

         // Check if the task exists
         if (!$task) {
             return response()->json([
                 'success' => false,
                 'message' => 'Task not found'
             ], 404);
         }
 
         // Retrieve comments associated with the task, including related user and task data
         $comments = Comment::with(['user:id,name', 'task:id,name'])
             ->where('task_id', $id)
             ->get();
 
         // Return the task and its comments as a JSON response
         return response()->json([
             'success' => true,
             'task' => $task,
             'comments' => $comments
         ], 200);
    }
}
