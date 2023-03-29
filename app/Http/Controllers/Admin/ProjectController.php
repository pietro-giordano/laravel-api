<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
// Helpers
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

// Mails
use Illuminate\Support\Facades\Mail;
use App\Mail\NewProject;
use App\Models\Technology;

class ProjectController extends Controller
{
      /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {
            $projects = Project::all();
            return view('admin.projects.index', compact('projects'));
      }

      /**
       * Show the form for creating a new resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function create()
      {
            $types = Type::all();
            $technologies = Technology::all();
            return view('admin.projects.create', compact('types', 'technologies'));
      }

      /**
       * Store a newly created resource in storage.
       *
       * @param  \App\Http\Requests\StoreProjectRequest  $request
       * @return \Illuminate\Http\Response
       */
      public function store(StoreProjectRequest $request)
      {
            $data = $request->validated();
            $data['slug'] = Str::slug($data['title']);

            if (array_key_exists('image', $data)) {
                  $img_path = Storage::put('uploads', $data['image']);
                  $data['image'] = $img_path;
            }

            $newProject = Project::create($data);

            if (array_key_exists('technologies', $data)) {
                  foreach ($data['technologies'] as $techId) {
                        $newProject->technologies()->attach($techId);
                  }
                  // alternativamente si può usare anche qui il sync come con update
            }

            Mail::to('hello@example.com')->send(new NewProject($newProject));

            return redirect()->route('admin.projects.show', $newProject)->with('success', 'Progetto aggiunto con successo');
      }

      /**
       * Display the specified resource.
       *
       * @param  \App\Models\Project  $project
       * @return \Illuminate\Http\Response
       */
      public function show(Project $project)
      {
            return view('admin.projects.show', compact('project'));
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param  \App\Models\Project  $project
       * @return \Illuminate\Http\Response
       */
      public function edit(Project $project)
      {
            $types = Type::all();
            $technologies = Technology::all();
            return view('admin.projects.edit', compact('project', 'types', 'technologies'));
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  \App\Http\Requests\UpdateProjectRequest  $request
       * @param  \App\Models\Project  $project
       * @return \Illuminate\Http\Response
       */
      public function update(UpdateProjectRequest $request, Project $project)
      {
            $data = $request->validated();
            $data['slug'] = Str::slug($data['title']);

            if (array_key_exists('delete_check', $data)) {
                  if ($project->image) {
                        Storage::delete($project->image);
                        $project->image = null;
                        $project->save();
                  }
            } else if (array_key_exists('image', $data)) {
                  $img_path = Storage::put('uploads', $data['image']);
                  $data['image'] = $img_path;

                  if ($project->image) {
                        Storage::delete($project->image);
                  }
            }

            $project->update($data);

            if (array_key_exists('technologies', $data)) {
                  $project->technologies()->sync($data['technologies']);
            } else {
                  $project->technologies()->detach();
            }

            return redirect()->route('admin.projects.show', $project->id)->with('success', 'Progetto aggiornato con successo');
      }

      /**
       * Remove the specified resource from storage.
       *
       * @param  \App\Models\Project  $project
       * @return \Illuminate\Http\Response
       */
      public function destroy(Project $project)
      {
            if ($project->image) {
                  Storage::delete($project->image);
            }

            $project->delete();
            return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato con successo');
      }
}
