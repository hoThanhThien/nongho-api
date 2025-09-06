<?php

namespace App\Http\Controllers;

use App\Models\CayTrong;
use App\Models\ThuaDat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CayTrongController extends Controller
{
    public function index()
    {
        $caytrangs = CayTrong::with(['thuaDat.nongHo'])->latest()->paginate(15);
        return view('caytrong.index', compact('caytrangs'));
    }

    public function create()
    {
        $thuaDats = ThuaDat::with('nongHo')->get();
        return view('caytrong.create', compact('thuaDats'));
    }

    public function store(Request $request)
    {
        // Debug: Log request data
        Log::info('CayTrong store request:', $request->all());
        
        $request->validate([
            'ten_cay' => 'required|string|max:255',
            'loai_cay' => 'required|string|max:100',
            'giong' => 'nullable|string|max:255',
            'thua_dat_id' => 'required|exists:thuadats,id',
            'dien_tich' => 'required|numeric|min:0',
            'ngay_trong' => 'nullable|date',
            'trang_thai' => 'nullable|in:đang_phát_triển,thu_hoạch,hoàn_thành',
            'ghi_chu' => 'nullable|string|max:1000'
        ]);

        $caytrong = CayTrong::create($request->all());
        Log::info('CayTrong created:', ['id' => $caytrong->id]);

        // Check if request came from thuadat.show modal
        if ($request->has('thua_dat_id') && $request->input('thua_dat_id')) {
            return redirect()->route('thuadat.show', $request->input('thua_dat_id'))
                            ->with('success', 'Cây trồng đã được thêm thành công!');
        }

        return redirect()->route('caytrong.index')->with('success', 'Cây trồng đã được thêm thành công!');
    }

    public function show(CayTrong $caytrong)
    {
        $caytrong->load(['thuaDat.nongHo']);
        return view('caytrong.show', compact('caytrong'));
    }

    public function edit(CayTrong $caytrong)
    {
        $thuaDats = ThuaDat::with('nongHo')->get();
        return view('caytrong.edit', compact('caytrong', 'thuaDats'));
    }

    public function update(Request $request, CayTrong $caytrong)
    {
        // Debug: Log request data
        Log::info('CayTrong update request:', [
            'id' => $caytrong->id,
            'data' => $request->all()
        ]);
        
        $request->validate([
            'ten_cay' => 'required|string|max:255',
            'loai_cay' => 'required|string|max:100',
            'giong' => 'nullable|string|max:255',
            'thua_dat_id' => 'required|exists:thuadats,id',
            'dien_tich' => 'required|numeric|min:0',
            'ngay_trong' => 'nullable|date',
            'trang_thai' => 'nullable|in:đang_phát_triển,thu_hoạch,hoàn_thành',
            'ghi_chu' => 'nullable|string|max:1000'
        ]);

        $caytrong->update($request->all());
        Log::info('CayTrong updated:', ['id' => $caytrong->id]);

        // Check if request came from thuadat.show modal
        if ($request->has('thua_dat_id') && $request->input('thua_dat_id')) {
            return redirect()->route('thuadat.show', $request->input('thua_dat_id'))
                            ->with('success', 'Cây trồng đã được cập nhật thành công!');
        }

        return redirect()->route('caytrong.index')
                        ->with('success', 'Cây trồng đã được cập nhật thành công!');
    }

    public function destroy(CayTrong $caytrong)
    {
        $caytrong->delete();
        
        return redirect()->route('caytrong.index')
                        ->with('success', 'Cây trồng đã được xóa thành công!');
    }
}
