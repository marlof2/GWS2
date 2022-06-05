<?php

namespace App\Http\Controllers;

use App\Models\Condominium;
use App\Http\Requests\StoreCondominiumRequest;
use App\Http\Requests\UpdateCondominiumRequest;

class CondominiumController extends Controller
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
     * @param  \App\Http\Requests\StoreCondominiumRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCondominiumRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Condominium  $condominium
     * @return \Illuminate\Http\Response
     */
    public function show(Condominium $condominium)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Condominium  $condominium
     * @return \Illuminate\Http\Response
     */
    public function edit(Condominium $condominium)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCondominiumRequest  $request
     * @param  \App\Models\Condominium  $condominium
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCondominiumRequest $request, Condominium $condominium)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Condominium  $condominium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Condominium $condominium)
    {
        //
    }
}
