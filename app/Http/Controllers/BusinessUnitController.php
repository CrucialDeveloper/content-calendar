<?php

namespace App\Http\Controllers;

use App\BusinessUnit;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BusinessUnitController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required | unique:business_units,name',
            'color' => 'required | unique:business_units,color',
        ]);

        BusinessUnit::create($request->all());

        return 'done';

    }

    public function update(Request $request, BusinessUnit $businessUnit)
    {
        $request->validate([
            'name' => ['required', Rule::unique('business_units')->ignore($businessUnit->id)],
            'color' => ['required', Rule::unique('business_units')->ignore($businessUnit->id)],
        ]);

        $businessUnit->update($request->all());

        return 'done';
    }
}
