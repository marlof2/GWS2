<?php

namespace App\Http\Controllers;

use App\Models\Programation;
use App\Http\Requests\StoreProgramationRequest;
use App\Http\Requests\UpdateProgramationRequest;

class ProgramationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProgramationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProgramationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Programation  $programation
     * @return \Illuminate\Http\Response
     */
    public function show(Programation $programation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProgramationRequest  $request
     * @param  \App\Models\Programation  $programation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProgramationRequest $request, Programation $programation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Programation  $programation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programation $programation)
    {
        //
    }
}
