<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::with('type', 'technologies')->paginate(12);

        foreach ($projects as $project) {
            if ($project->image) {
                $project->image = asset('storage/' . $project->image);
            }
        }

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Ok',
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $project = Project::where('slug', $slug)->with('type', 'technologies')->firstOrFail();

            if ($project->image) {
                $project->image = asset('storage/' . $project->image);
            }

            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Ok',
                'project' => $project
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
