<?php

namespace App\Http\Controllers;

use App\Models\NongHo;
use App\Models\ThuaDat;
use App\Models\CayTrong;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalNongHo = NongHo::count();
        $totalThuaDat = ThuaDat::count();
        $totalCayTrong = CayTrong::distinct('giong')->count();
        
        // Lấy dữ liệu cho biểu đồ
        $thuaDatByNongHo = ThuaDat::with('nongHo')
            ->selectRaw('nongho_id, SUM(dien_tich) as total_area')
            ->groupBy('nongho_id')
            ->get();

        return view('dashboard.index', compact(
            'totalNongHo',
            'totalThuaDat',
            'totalCayTrong',
            'thuaDatByNongHo'
        ));
    }
}
