<?php

namespace App\Http\Controllers;

use App\Models\Solde;
use App\Http\Requests\StoreSoldeRequest;
use App\Http\Requests\UpdateSoldeRequest;

class SoldeController extends Controller
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
     * @param  \App\Http\Requests\StoreSoldeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSoldeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Solde  $solde
     * @return \Illuminate\Http\Response
     */
    public function show(Solde $solde)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Solde  $solde
     * @return \Illuminate\Http\Response
     */
    public function edit(Solde $solde)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSoldeRequest  $request
     * @param  \App\Models\Solde  $solde
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSoldeRequest $request, Solde $solde)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Solde  $solde
     * @return \Illuminate\Http\Response
     */
    public function destroy(Solde $solde)
    {
        //
    }
}
