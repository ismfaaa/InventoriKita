<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'aset_id',
        'status_pelaporan',
        'feedback',
        'tingkat_kerusakan',
        'deskripsi',
        'foto',
        'lokasi',
        'tanggal_pelaporan',
    ];

    public function user ()
    {
        return $this->belongsTo(User::Class);
    }

    public function aset ()
    {
        return $this->belongsTo(Aset::Class);
    }
}
