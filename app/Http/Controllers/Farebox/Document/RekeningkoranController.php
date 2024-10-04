<?php

namespace App\Http\Controllers\Farebox\Document;

use App\Models\Rekeningkoran;
use App\Http\Requests\StoreRekeningkoranRequest;
use App\Http\Requests\UpdateRekeningkoranRequest;
use App\Http\Controllers\Controller;

class RekeningkoranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Rekeningkoran::all();

        return view('rekeningkoran.index', compact('rekeningkoran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorerekeningkoranRequest $request)
    {
        $validated = $request->validated();

        Rekeningkoran::create($validated);
        
        return redirect()->route('rekeningkoran.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(rekeningkoran $rekeningkoran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // get the rekeningkoran by id
        $rekeningkoran = Rekeningkoran::findOrFail($id);

        return view('rekeningkoran.edit', compact('rekeningkoran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdaterekeningkoranRequest $request, $id)
    {
        // validate the request and update the rekeningkoran by id
        $validated = $request->validated();

        Rekeningkoran::where('id_rekeningkoran', $id)
        ->update($validated);

        return redirect()->route('rekeningkoran.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // delete the rekeningkoran by id
        $rekeningkoran = Rekeningkoran::findOrFail($id);
        $rekeningkoran->delete();

        return redirect()->route('rekeningkoran.index');
    }
}
