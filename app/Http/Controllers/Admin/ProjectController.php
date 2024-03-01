<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Type;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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

        return view('admin.project.index-project', compact('projects'));
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

        return view('admin.project.create-project', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->all();

        $project = new Project();

        if ($request->hasFile('logo')) {

            //ESEGUO L'UPLOAD DEL FILE E RECUPERO IL PATH 
            $path = Storage::disk('public')->put('posts_image', $form_data['logo']);
            $form_data['logo'] = $path;
        }

        $project->fill($form_data);
        $slug = Str::slug($form_data['name'], '-');
        $project->slug = $slug;

        $project->save();

        if ($request->has('technologies')) {
            $project->technologies()->attach($form_data['technologies']);
        }

        return redirect()->route('admin.project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.project.show-project', compact('project'));
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

        return view('admin.project.edit-project', compact('project', 'types', 'technologies'));
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
        $form_data = $request->all();

        if ($request->hasFile('logo')) {
            //SE IL POST HA UN'IMMAGINE
            if ($project->logo != null) {
                Storage::disk('public')->delete($project->logo);
            }

            //ESEGUO L'UPLOAD DEL FILE E RECUPERO IL PATH 
            $path = Storage::disk('public')->put('posts_image', $form_data['logo']);
            $form_data['logo'] = $path;
        }

        $slug = Str::slug($form_data['name'], '-');
        $project->slug = $slug;

        $project->update($form_data);

        if ($request->has('technologies')) {
            $project->technologies()->sync($form_data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }

        return redirect()->route('admin.project.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->logo != null) {
            Storage::disk('public')->delete($project->logo);
        }

        $project->delete();

        return redirect()->route('admin.project.index');
    }
}
