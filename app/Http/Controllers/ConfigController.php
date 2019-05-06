<?php

namespace App\Http\Controllers;

use App\BusinessUnit;

class ConfigController extends Controller
{
    public function index()
    {
        return view('config.index', [
            'businessUnits' => BusinessUnit::all(),
        ]);
    }
}
