<?php

namespace App\Http\Controllers;

use App\BusinessUnit;
use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{

    public function index()
    {
        return view('projects.index', [
            'projects' => Project::all(),
            'businessUnits' => BusinessUnit::all(),
            'users' => User::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required | unique:projects,title',
            'owner' => 'required',
            'business_unit' => 'required',
            'type' => 'required',
            'publish_date' => 'required',
        ]);

        Project::create($request->all());

        return 'done';
    }

    public function update(Request $request, Project $project)
    {

        $request->validate([
            'title' => ['required', Rule::unique('projects')->ignore($project->id)],
            'owner' => 'required',
            'business_unit' => 'required',
            'type' => 'required',
            'publish_date' => 'required',
        ]);

        $project->update($request->all());

        return 'done';
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return 'done';
    }

}
