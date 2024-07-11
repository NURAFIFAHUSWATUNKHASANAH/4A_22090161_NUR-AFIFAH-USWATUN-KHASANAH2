<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Alternatif;
use App\Models\DaftarPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlternatifController extends Controller
{
    public function index(Request $request)
    {
        $kriteria = $request->kriteria; // Terima data kriteria dari request
        // Jika pengguna adalah admin, ambil semua data alternatif beserta data pegawai terkait
        // Jika pengguna adalah user, ambil semua data alternatif tanpa relasi pegawai
        if (Auth::user()->role === 'admin') {
            $alternatif = Alternatif::with('pegawai')->get();
        } else {
            $alternatif = Alternatif::all();
        }
        return view('alternatif.index', compact('alternatif', 'kriteria'));
    }

    public function create()
    {
        // Mengambil semua data pegawai untuk dropdown pilihan
        $pegawai = DaftarPegawai::all();
        return view('alternatif.create', compact('pegawai'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nip' => 'required|exists:daftar_pegawais,nip',
            'c1' => 'required|numeric',
            'c2' => 'required|numeric',
            'c3' => 'required|numeric',
            'c4' => 'required|numeric',
            'c5' => 'required|numeric',
        ]);

        // Mencari pegawai berdasarkan NIP
        $pegawai = DaftarPegawai::where('nip', $request->nip)->firstOrFail();
        // Menambahkan nama pegawai ke request
        $request->merge(['nama' => $pegawai->nama]);

        // Menyimpan data alternatif
        Alternatif::create($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil ditambahkan.');
    }

    public function show($id)
    {
        // Mengambil data alternatif berdasarkan id
        $alternatif = Alternatif::findOrFail($id);
        return view('alternatif.show', compact('alternatif'));
    }

    public function edit($id)
    {
        // Mengambil data alternatif berdasarkan id
        $alternatif = Alternatif::findOrFail($id);
        // Mengambil semua data pegawai untuk dropdown pilihan
        $pegawai = DaftarPegawai::all();

        return view('alternatif.edit', compact('alternatif', 'pegawai'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nip' => 'required|exists:daftar_pegawai,nip',
            'c1' => 'required|numeric',
            'c2' => 'required|numeric',
            'c3' => 'required|numeric',
            'c4' => 'required|numeric',
            'c5' => 'required|numeric',
        ]);

        // Mencari pegawai berdasarkan NIP
        $pegawai = DaftarPegawai::where('nip', $request->nip)->firstOrFail();
        // Menambahkan nama pegawai ke request
        $request->merge(['nama' => $pegawai->nama]);

        // Mengupdate data alternatif berdasarkan id
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->update($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil diupdate.');
    }

    // Di DaftarPegawaiController.php

public function destroy($id)
{
    DB::transaction(function() use ($id) {
        // Mengambil data pegawai berdasarkan id
        $pegawai = DaftarPegawai::findOrFail($id);

        // Jika terdapat alternatif terkait, hapus juga data alternatif tersebut
        $alternatif = Alternatif::where('nip', $pegawai->nip)->first();
        if ($alternatif) {
            $alternatif->delete();
        }

        // Menghapus data pegawai
        $pegawai->delete();
    });

    // Redirect ke halaman index dengan pesan sukses
    return redirect()->route('daftar_pegawai.index')->with('success', 'Pegawai dan alternatif terkait berhasil dihapus.');
}
}