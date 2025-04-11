<?php

namespace App\Http\Controllers;

use App\Models\Potion;
use Illuminate\Http\Request;

class PotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Potion::with("ingredients", "wizards")->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'magical_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'curative' => 'required|boolean',
            'magic_level_required' => 'required|integer|min:1',
        ]);

        return Potion::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Potion::with('ingredients', 'wizards')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $potion = Potion::findOrFail($id);
        $potion->update($request->all());

        return $potion;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Potion::destroy($id);
        return response()->json(['message' => 'Potion deleted']);
    }

    //Get the highest level required potions 
    public function highestLevelRequired()
    {
        $maxLevel = Potion::max('magic_level_required');
        $potion = Potion::where('magic_level_required', $maxLevel)->get();

        if($potion -> isEmpty())
        {
            return response()->json(['message'=>'No potions found']);
        }

        return response()->json($potion,200);
    }

    //Get the lowest level required potions 
    public function lowestLevelRequired()
    {
        $minLevel = Potion::min('magic_level_required');
        $potion = Potion::where('magic_level_required', $minLevel)->get();

        if($potion -> isEmpty())
        {
            return response()->json(['message'=>'No potions found']);
        }

        return response()->json($potion,200);
    }

    //Get the curative potions 
    public function getCurativePotions()
    {
        $curativePotions = Potion::where('curative',true)->get();

        if($curativePotions -> isEmpty())
        {
            return response()->json(['message'=>'No potions found']);
        }

        return response()->json($curativePotions,200);
    }

    //Get potions by required level
    public function getPotionsByRequiredLevel($level)
    {
        $potions = Potion::where('magic_level_required', $level)->get();

        if($potions -> isEmpty())
        {
            return response()->json(['message'=>'No potions found']);
        }

        return response()->json($potions,200);
    }

    //Get potion by name
    public function getPotionByName(Request $request)
    {
        $name = $request->query('q');

        $potion = Potion::where('magical_name','ILIKE', "%$name%")->get();

        if($potion -> isEmpty())
        {
            return response()->json(['message'=>'No potions found']);
        }

        return response()->json($potion,200);
    }

    //Get stats
    public function getStats()
    {
        return response()->json([
            'total'=>Potion::count(),
            'curative'=>Potion::where('curative',true)->count(),
            'nonCurative'=>Potion::where('curative',false)->count(),
            'avg_magic_level'=>round(Potion::avg('magic_level_required'), 2)
        ], 200);
    }

}