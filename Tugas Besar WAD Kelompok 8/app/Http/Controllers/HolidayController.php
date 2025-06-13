<?php

namespace App\Http\Controllers;

use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HolidayController extends Controller
{
    public function index()
    {
        $holidays = Holiday::with('creator')
            ->orderBy('date', 'asc')
            ->paginate(10);
        
        return view('holidays.index', compact('holidays'));
    }

    public function create()
    {
        return view('holidays.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'date' => 'required|date|after_or_equal:today',
            ]);

            $validated['created_by'] = auth()->id();

            Holiday::create($validated);

            return redirect()->route('holidays.index')
                ->with('success', 'Hari libur berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Holiday creation error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menambahkan hari libur: ' . $e->getMessage());
        }
    }

    public function show(Holiday $holiday)
    {
        return view('holidays.show', compact('holiday'));
    }

    public function edit(Holiday $holiday)
    {
        return view('holidays.edit', compact('holiday'));
    }

    public function update(Request $request, Holiday $holiday)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'date' => 'required|date',
            ]);

            $holiday->update($validated);

            return redirect()->route('holidays.index')
                ->with('success', 'Hari libur berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Holiday update error: ' . $e->getMessage());
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui hari libur: ' . $e->getMessage());
        }
    }

    public function destroy(Holiday $holiday)
    {
        try {
            $holiday->delete();
            return redirect()->route('holidays.index')
                ->with('success', 'Hari libur berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Holiday deletion error: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat menghapus hari libur: ' . $e->getMessage());
        }
    }
} 