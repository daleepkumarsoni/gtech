<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Project;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->user();
         // Check if the user has the 'admin' role
         if (!$user->hasRole('admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
         $authId = Auth::user()->id;
        $user = User::with('projects')->find($authId);
        $projects = $user ? $user->projects : [];

        return response()->json([
            'success' => true,
            'projects' => $projects
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);


        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
        $user = auth()->user();
        // Check if the user has the 'admin' role
        if (!$user->hasRole('admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Create the project
        $project = Auth::user()->projects()->create($request->all());

        // Return a JSON response
        return response()->json([
            'success' => true,
            'project' => $project
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
        // return $request;
         // Validation rules
         $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $user = auth()->user();
        // Check if the user has the 'admin' role
        if (!$user->hasRole('admin')) {
           return response()->json(['error' => 'Unauthorized'], 403);
       }

        // Find the project by ID
        $project = Project::find($id);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found'
            ], 404);
        }

        // Update the project fields
        $project->name = $request->name;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->save();

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Project updated successfully',
            'project' => $project
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = auth()->user();
        // Check if the user has the 'admin' role
        if (!$user->hasRole('admin')) {
           return response()->json(['error' => 'Unauthorized'], 403);
       }
        $project = Project::find($id);

        // Check if the project exists
        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project not found'
            ], 404);
        }

        // Delete the project
        $project->delete();

        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Project deleted successfully'
        ], 200);
        
    }
}
