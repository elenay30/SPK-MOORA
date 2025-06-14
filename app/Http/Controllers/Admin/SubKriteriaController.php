<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubKriteriaController extends Controller
{
    /**
     * Menampilkan daftar semua sub kriteria.
     */
    public function index()
    {
        // GUNAKAN KODE BARU DI BAWAH INI:
        $subKriterias = SubKriteria::join('kriterias', 'sub_kriterias.kriteria_id', '=', 'kriterias.id')
            ->orderBy('kriterias.kode', 'asc')      // Urutan 1: Berdasarkan Kode Kriteria (C1, C2, ...)
            ->orderBy('sub_kriterias.nilai', 'desc') // Urutan 2: Berdasarkan Nilai Sub Kriteria (4, 3, ...)
            ->select('sub_kriterias.*')              // Pilih semua kolom dari sub_kriterias
            ->with('kriteria')                       // Eager load relasi setelah diurutkan
            ->get();
        return view('admin.subkriteria.index', compact('subKriterias'));
    }

    /**
     * Menampilkan form untuk menambahkan sub kriteria baru.
     */
    public function create()
    {
        $kriterias = Kriteria::all();
        return view('admin.subkriteria.create', compact('kriterias'));
    }

    /**
     * Menyimpan sub kriteria baru ke database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kriteria_id' => 'required|exists:kriterias,id',
            'keterangan' => 'required|string|max:255',
            'nilai' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        SubKriteria::create([
            'kriteria_id' => $request->kriteria_id,
            'keterangan' => $request->keterangan,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('admin.subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit sub kriteria.
     */
    public function edit(SubKriteria $subKriteria)
    {
        $kriterias = Kriteria::all();
        return view('admin.subkriteria.edit', compact('subKriteria', 'kriterias'));
    }

    /**
     * Memperbarui data sub kriteria yang sudah ada.
     */
    public function update(Request $request, SubKriteria $subKriteria)
    {
        $validator = Validator::make($request->all(), [
            'kriteria_id' => 'required|exists:kriterias,id',
            'keterangan' => 'required|string|max:255',
            'nilai' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subKriteria->update([
            'kriteria_id' => $request->kriteria_id,
            'keterangan' => $request->keterangan,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('admin.subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil diperbarui.');
    }

    /**
     * Menghapus sub kriteria dari database.
     */
    public function destroy(SubKriteria $subKriteria)
    {
        $subKriteria->delete();

        return redirect()->route('admin.subkriteria.index')
            ->with('success', 'Sub Kriteria berhasil dihapus.');
    }
}
