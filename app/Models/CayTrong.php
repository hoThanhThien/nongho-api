<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CayTrong extends Model
{
    use HasFactory;

    protected $fillable = [
        'thua_dat_id', 
        'ten_cay', 
        'loai_cay',
        'giong', 
        'dien_tich',
        'ngay_trong',
        'trang_thai',
        'ghi_chu'
    ];

    protected $casts = [
        'ngay_trong' => 'date',
        'dien_tich' => 'decimal:2'
    ];

    public function thuaDat()
    {
        return $this->belongsTo(ThuaDat::class, 'thua_dat_id');
    }
}

