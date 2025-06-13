<?php

namespace App\Http\Controllers\Admin;

use App\Models\Obat;
use Illuminate\Http\Request;
use App\Http\Requests\ObatRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::paginate(10);
        return view('admin.obat.index', compact('obats'));
    }

    public function create()
    {
        return view('admin.obat.create');
    }

    public function store(ObatRequest $request)
    {
        Obat::create($request->validated());
        return redirect()->route('admin.obat.index')->with('success', 'Data obat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.edit', compact('obat')); // ✅ path view sudah sesuai
    }


    public function update(ObatRequest $request, $id)
    {
        $obat = Obat::findOrFail($id);
        $obat->update($request->validated());

        return redirect()->route('admin.obat.index')->with('success', 'Data obat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();

        return redirect()->route('admin.obat.index')->with('success', 'Data obat berhasil dihapus!');
    }

    // API
    public function apiAll()
    {
        return response()->json(Obat::all());
    }

    public function apiShow($id)
    {
        return response()->json(Obat::findOrFail($id));
    }
}
