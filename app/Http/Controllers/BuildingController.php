<?php

namespace App\Http\Controllers;

use App\Models\Building;
use Illuminate\Http\Request;

class BuildingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buildings = Building::with('owner', 'category')->get();
        return view('buildings.index', compact('buildings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buildings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required',
            'details' => 'nullable|json',
            'pictures' => 'nullable|json',
            'rent_price' => 'required|numeric',
            'owner_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:building_categories,id',
        ]);

        $building = Building::create($validatedData);

        return redirect()->route('buildings.show', $building->id)->with('success', 'Building created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Building $building)
    {
        return view('buildings.show', compact('building'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Building $building)
    {
        return view('buildings.edit', compact('building'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Building $building)
    {
        $validatedData = $request->validate([
            'description' => 'required',
            'details' => 'nullable|json',
            'pictures' => 'nullable|json',
            'rent_price' => 'required|numeric',
            'owner_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:building_categories,id',
        ]);

        $building->update($validatedData);

        return redirect()->route('buildings.show', $building->id)->with('success', 'Building updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Building $building)
    {
        $building->delete();
        return redirect()->route('buildings.index')->with('success', 'Building deleted successfully.');
    }
}