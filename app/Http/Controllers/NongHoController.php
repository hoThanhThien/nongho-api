<?php

namespace App\Http\Controllers;

use App\Models\NongHo;
use Illuminate\Http\Request;

class NongHoController extends Controller
{
    public function index(Request $request)
    {
        $query = NongHo::query();
        
        if ($request->has('search')) {
            $query->where('ten', 'like', '%' . $request->search . '%');
        }
        
        $nongHos = $query->paginate(10);
        
        return view('nongho.index', compact('nongHos'));
    }

    public function create()
    {
        return view('nongho.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
            'dia_chi' => 'nullable|string|max:500',
            'so_dien_thoai' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        NongHo::create($request->all());

        return redirect()->route('nongho.index')->with('success', 'Nông hộ đã được thêm thành công!');
    }

    public function show(NongHo $nongho)
    {
        $nongho->load('thuaDats.cayTrongs');
        return view('nongho.show', compact('nongho'));
    }

    public function edit(NongHo $nongho)
    {
        return view('nongho.edit', compact('nongho'));
    }

    public function update(Request $request, NongHo $nongho)
    {
        $request->validate([
            'ten' => 'required|string|max:255',
            'dia_chi' => 'nullable|string|max:500',
            'so_dien_thoai' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        $nongho->update($request->all());

        return redirect()->route('nongho.index')->with('success', 'Nông hộ đã được cập nhật thành công!');
    }

    public function destroy(NongHo $nongho)
    {
        $nongho->delete();
        return redirect()->route('nongho.index')->with('success', 'Nông hộ đã được xóa thành công!');
    }
}
