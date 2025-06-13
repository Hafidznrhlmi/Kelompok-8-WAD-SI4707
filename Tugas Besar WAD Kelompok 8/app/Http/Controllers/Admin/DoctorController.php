<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Requests\DoctorRequest;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::latest()->paginate(10);
        return view('admin.doctorss.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.doctorss.create');
    }

    public function store(DoctorRequest $request)
    {
        Doctor::create($request->validated());
        return redirect()->route('admin.doctorss.index')
            ->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function edit(Doctor $doctorss)
    {
        return view('admin.doctorss.edit', compact('doctorss'));
    }

    public function update(DoctorRequest $request, Doctor $doctorss)
    {
        $doctorss->update($request->validated());
        return redirect()->route('admin.doctorss.index')
            ->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy(Doctor $doctorss)
    {
        if($doctorss->appointments()->count() > 0) {
            return redirect()->route('admin.doctorss.index')
                ->with('error', 'Dokter tidak dapat dihapus karena masih memiliki appointment.');
        }
        
        $doctorss->delete();
        return redirect()->route('admin.doctorss.index')
            ->with('success', 'Dokter berhasil dihapus.');
    }
} 