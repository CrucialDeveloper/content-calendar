<?php

namespace App\Http\Controllers;

use App\BusinessUnit;
use App\Project;
use App\User;

class CalendarController extends Controller
{

    public function index()
    {
        return view('calendar.index', [
            'projects' => Project::all(),
            'businessUnits' => BusinessUnit::all(),
            'users' => User::all(),
        ]);
    }
}
