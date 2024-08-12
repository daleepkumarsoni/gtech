<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getProject()
    {
        $auth= Auth::user()->id;
        $user  = User::with('projects')->find($auth);
        $projects = $user->projects;
        return view('admin.module.project.index', compact('projects'));
    }
    public function createProject(Request $request)
    {

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date',
    ]);
    return back()->withErrors($validatedData)->withInput();
    $project = Auth::user()->projects()->create($request->all());
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function projectEdit($id)
    {
        $project = Project::find($id);
        return view('admin.module.project.update',compact('project'));
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
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function projectUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        // return back()->withErrors($validatedData)->withInput();
        $project = Project::find($id);
        $project->name = $request->name;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->save();
        return redirect('admin/project');
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function projectDelete($id)
    {
        $project = Project::find($id);
        $project->delete();
        return redirect()->back();
    }
}
