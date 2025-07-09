<?php

namespace App\Http\Controllers;

use App\Models\CommandeAbonnement;
use App\Http\Requests\StoreCommandeAbonnementRequest;
use App\Http\Requests\UpdateCommandeAbonnementRequest;

class CommandeAbonnementController extends Controller
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
     * @param  \App\Http\Requests\StoreCommandeAbonnementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommandeAbonnementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CommandeAbonnement  $commandeAbonnement
     * @return \Illuminate\Http\Response
     */
    public function show(CommandeAbonnement $commandeAbonnement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CommandeAbonnement  $commandeAbonnement
     * @return \Illuminate\Http\Response
     */
    public function edit(CommandeAbonnement $commandeAbonnement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCommandeAbonnementRequest  $request
     * @param  \App\Models\CommandeAbonnement  $commandeAbonnement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommandeAbonnementRequest $request, CommandeAbonnement $commandeAbonnement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommandeAbonnement  $commandeAbonnement
     * @return \Illuminate\Http\Response
     */
    public function destroy(CommandeAbonnement $commandeAbonnement)
    {
        //
    }
}
