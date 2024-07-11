<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DaftarPegawai;
use App\Models\Kriteria;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user');
    }

    /**
     * Show the user dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Mengambil jumlah pegawai
        $jumlahPegawai = DaftarPegawai::count();

        // Mengambil jumlah kriteria
        $jumlahKriteria = Kriteria::count();

        // Mengambil nama pengguna yang sedang login
        $namaPengguna = Auth::user()->name;

        // Ambil jumlah pegawai berdasarkan jenis kelamin
        $jumlahLakiLaki = DaftarPegawai::where('jenis_kelamin', 'Laki-laki')->count();
        $jumlahPerempuan = DaftarPegawai::where('jenis_kelamin', 'Perempuan')->count();

        // Luluskan data ke view
        return view('admin.dashboard', compact('jumlahPegawai', 'jumlahKriteria', 'namaPengguna', 'jumlahLakiLaki', 'jumlahPerempuan'));
    }
}

