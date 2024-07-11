<?php

namespace App\Http\Controllers;

use App\Models\DaftarPegawai;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DaftarPegawaiController extends Controller
{
    public function index()
    {
        $pegawai = DaftarPegawai::all();
        return view('daftar_pegawai.index', compact('pegawai'));
    }

    public function create()
    {
        return view('daftar_pegawai.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:daftar_pegawai',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            // Create DaftarPegawai
            $pegawai = DaftarPegawai::create($request->all());

            // Create corresponding Alternatif entry
            Alternatif::create([
                'nip' => $pegawai->nip,
                'nama' => $pegawai->nama,
                'c1' => 0,  // Default values for criteria
                'c2' => 0,
                'c3' => 0,
                'c4' => 0,
                'c5' => 0,
            ]);
        });

        return redirect()->route('daftar_pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pegawai = DaftarPegawai::findOrFail($id);
        return view('daftar_pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|exists:daftar_pegawai,nip',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $pegawai = DaftarPegawai::findOrFail($id);
                $pegawai->update($request->all());

                // Update corresponding Alternatif entry if NIP or name is changed
                $alternatif = Alternatif::where('nip', $pegawai->nip)->first();
                if ($alternatif) {
                    $alternatif->update([
                        'nama' => $pegawai->nama,
                    ]);
                }
            });

            return redirect()->route('daftar_pegawai.index')->with('success', 'Pegawai berhasil diupdate');
        } catch (\Exception $e) {
            return back()->withError('Failed to update employee: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        // Redirect to index or show a 404 page
        return redirect()->route('daftar_pegawai.index');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $pegawai = DaftarPegawai::findOrFail($id);

            // Delete related records in the 'alternatif' table
            Alternatif::where('nip', $pegawai->nip)->delete();

            // Delete the record in 'daftar_pegawai' table
            $pegawai->delete();
        });

        return redirect()->route('daftar_pegawai.index')->with('success', 'Pegawai berhasil dihapus');
    }
    public function search(Request $request)
    {
        $query = $request->query('query');
        $pegawai = DaftarPegawai::where('nama', 'LIKE', "%$query%")
            ->orWhere('nip', 'LIKE', "%$query%")
            ->orWhere('jenis_kelamin', 'LIKE', "%$query%")
            ->orWhere('alamat', 'LIKE', "%$query%")
            ->get();
        return $pegawai;
    }
}
