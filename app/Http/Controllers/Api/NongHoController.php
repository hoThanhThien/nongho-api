<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NongHo;

class NongHoController extends Controller
{
    public function index()
    {
        return response()->json(NongHo::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ten' => 'required|string',
        ]);

        return response()->json(NongHo::create($validated), 201);
    }

    public function show($id)
    {
        return response()->json(NongHo::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $nongho = NongHo::findOrFail($id);
        $nongho->update($request->all());

        return response()->json($nongho);
    }

    public function destroy($id)
    {
        NongHo::destroy($id);

        return response()->json(null, 204);
    }
}
