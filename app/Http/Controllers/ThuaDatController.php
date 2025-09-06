<?php

namespace App\Http\Controllers;

use App\Models\ThuaDat;
use App\Models\NongHo;
use Illuminate\Http\Request;

class ThuaDatController extends Controller
{
    public function index(Request $request)
    {
        $query = ThuaDat::with('nongHo');
        
        if ($request->has('search') && $request->search) {
            $query->where('ten_thua', 'like', '%' . $request->search . '%');
        }
        
        if ($request->has('nongho_filter') && $request->nongho_filter) {
            $query->where('nongho_id', $request->nongho_filter);
        }
        
        $thuaDats = $query->paginate(10);
        $thuaDats->appends($request->query());
        
        $nongHos = NongHo::all();
        
        return view('thuadat.index', compact('thuaDats', 'nongHos'));
    }

    public function create()
    {
        $nongHos = NongHo::all();
        return view('thuadat.create', compact('nongHos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten_thua' => 'required|string|max:255',
            'dien_tich' => 'required|numeric|min:0',
            'nongho_id' => 'required|exists:nong_hos,id',
        ]);

        ThuaDat::create($request->all());

        return redirect()->route('thuadat.index')->with('success', 'Thửa đất đã được thêm thành công!');
    }

    public function show(ThuaDat $thuadat)
    {
        $thuadat->load(['nongHo', 'cayTrongs']);
        return view('thuadat.show', compact('thuadat'));
    }

    public function edit(ThuaDat $thuadat)
    {
        $nongHos = NongHo::all();
        return view('thuadat.edit', compact('thuadat', 'nongHos'));
    }

    public function update(Request $request, ThuaDat $thuadat)
    {
        $request->validate([
            'ten_thua' => 'required|string|max:255',
            'dien_tich' => 'required|numeric|min:0',
            'nongho_id' => 'required|exists:nong_hos,id',
        ]);

        $thuadat->update($request->all());

        return redirect()->route('thuadat.index')->with('success', 'Thửa đất đã được cập nhật thành công!');
    }

    public function destroy(ThuaDat $thuadat)
    {
        $thuadat->delete();
        return redirect()->route('thuadat.index')->with('success', 'Thửa đất đã được xóa thành công!');
    }
}
