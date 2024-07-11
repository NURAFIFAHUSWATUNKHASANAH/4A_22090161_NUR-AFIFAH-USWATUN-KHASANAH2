<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::all(); // Fetch all criteria from the database
        return view('kriteria.index', compact('kriteria'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode' => 'required|unique:kriteria',
            'nama_kriteria' => 'required',
            'atribut' => 'required',
            'bobot' => 'required'
        ]);
    
        Kriteria::create($validatedData);
    
        return redirect()->route('kriteria.index');
    }

    public function edit($id)
    {
        $kriteria = Kriteria::find($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'kode' => 'required|unique:kriteria,kode,'.$id,
            'nama_kriteria' => 'required',
            'atribut' => 'required',
            'bobot' => 'required'
        ]);

        $kriteria = Kriteria::find($id);
        $kriteria->update($validatedData);

        return redirect()->route('kriteria.index');
    }

    public function destroy($id)
    {
        Kriteria::destroy($id);
        return redirect()->route('kriteria.index');
    }
}
