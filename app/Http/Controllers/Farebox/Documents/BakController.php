<?php

namespace App\Http\Controllers\Farebox\Documents;

use App\Models\Bak;
use App\Http\Requests\StorebakRequest;
use App\Http\Requests\UpdatebakRequest;
use App\Http\Controllers\Controller;

class BakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Bak::all();

        return view('bak.index', compact('bak'));
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
    public function store(StorebakRequest $request)
    {
        $validated = $request->validated();

        Bak::create($validated);
        
        return redirect()->route('bak.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(bak $bak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // get the bak by id
        $bak = Bak::findOrFail($id);

        return view('bak.edit', compact('bak'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebakRequest $request, $id)
    {
        // validate the request and update the bak by id
        $validated = $request->validated();

        Bak::where('id_bak', $id)
        ->update($validated);

        return redirect()->route('bak.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // delete the bak by id
        $bak = Bak::findOrFail($id);
        $bak->delete();

        return redirect()->route('bak.index');
    }
}
