<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ThuaDat;

class ThuaDatController extends Controller
{
    public function index()
    {
        return response()->json(ThuaDat::with('nongho')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ten_thua' => 'required|string',
            'dien_tich' => 'required|numeric',
            'nongho_id' => 'required|exists:nong_hos,id',
        ]);

        return response()->json(ThuaDat::create($validated), 201);
    }



    public function show($id)
    {
        return response()->json(ThuaDat::with('nongho')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $thuadat = ThuaDat::findOrFail($id);
        $thuadat->update($request->all());
        return response()->json($thuadat);
    }

    public function destroy($id)
    {
        ThuaDat::destroy($id);
        return response()->json(null, 204);
    }
}
