<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengadaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'aset_id',
        'status_pengadaan',
        'feedback_pengadaan',
        'estimasi_biaya',
        'tanggal_pengadaan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aset()
    {
        return $this->belongsTo(Aset::class);
    }
}
