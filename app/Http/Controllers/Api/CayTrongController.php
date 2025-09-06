<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CayTrong;

class CayTrongController extends Controller
{
    public function index()
    {
        return response()->json(CayTrong::with('thuaDat')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ten_cay' => 'required|string',
            'giong' => 'required|string',
            'thuadat_id' => 'required|exists:thuadats,id',
        ]);
        return response()->json(CayTrong::create($validated), 201);
    }

    public function show($id)
    {
        return response()->json(CayTrong::with('thuaDat')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $caytrong = CayTrong::findOrFail($id);
        $validated = $request->validate([
            'ten_cay' => 'string',
            'giong' => 'string',
        ]);
        $caytrong->update($validated);
        return response()->json($caytrong);
    }

    public function destroy($id)
    {
        CayTrong::destroy($id);
        return response()->json(null, 204);
    }
}
