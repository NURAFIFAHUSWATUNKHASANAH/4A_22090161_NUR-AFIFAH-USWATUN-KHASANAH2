<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPegawai extends Model
{
    use HasFactory;

    protected $table = 'daftar_pegawai';

    protected $fillable = [
        'nama',
        'nip',
        'jenis_kelamin',
        'alamat'
    ];
    public function showDashboard()
{
    $jumlahLakiLaki = DaftarPegawai::where('jenis_kelamin', 'Laki-laki')->count();
    $jumlahPerempuan = DaftarPegawai::where('jenis_kelamin', 'Perempuan')->count();

    return view('dashboard')->with(compact('jumlahLakiLaki', 'jumlahPerempuan'));
}
}

