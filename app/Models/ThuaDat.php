<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuaDat extends Model
{
    use HasFactory;

    protected $table = 'thuadats';
    protected $fillable = ['ten_thua', 'dien_tich', 'nongho_id'];

    public function nongHo()
    {
        return $this->belongsTo(NongHo::class, 'nongho_id');
    }

    public function cayTrongs()
    {
        return $this->hasMany(CayTrong::class, 'thua_dat_id');
    }
}
