<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function taskCommentList($id)
    {   
        $tasks = Task::where('id',$id)->first();

        $comments = Comment::with(['user:id,name', 'task:id,name'])
        ->where('task_id', $id)
        ->get();

                 return  view('admin.module.comment.index',compact('tasks','comments'));
    }
    public function taskComment(Request $request,$id)
    {   
        $auth = Auth::user()->id;
        $task = Task::find($id);
        
        $comment = new Comment();
        $comment->comment= $request->comment;
        $comment->user_id=$auth;
        $comment->task_id=$task->id;
        $comment->save();
        return  redirect()->back();
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
