<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Aset extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_aset',
        'nama_aset',
        'kategori_id',
        'lokasi',
        'foto',
    ];

    public function Kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
