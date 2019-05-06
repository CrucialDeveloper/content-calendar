<?php

namespace App\Http\Controllers;

use App\Project;

class ReportsController extends Controller
{

    public function index()
    {
        return view('reports.index', [
            'projects' => Project::all(),
        ]);
    }

}
