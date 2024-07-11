<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $table = 'alternatif';

    protected $fillable = [
        'nip',
        'nama',
        'c1',
        'c2',
        'c3',
        'c4',
        'c5'
    ];

    public function pegawai()
    {
        return $this->belongsTo(DaftarPegawai::class, 'nip', 'nip');
    }
}

