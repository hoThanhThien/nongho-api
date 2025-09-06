<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NongHo extends Model
{
    use HasFactory;
    protected $fillable = ['ten', 'dia_chi', 'so_dien_thoai', 'email'];

    public function thuaDats()
    {
        return $this->hasMany(ThuaDat::class, 'nongho_id');
    }
}

