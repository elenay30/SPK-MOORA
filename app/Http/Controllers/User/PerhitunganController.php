<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\HasilPerhitungan;
use App\Service\MooraService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PerhitunganController extends Controller
{
    protected $mooraService;

    public function __construct(MooraService $mooraService)
    {
        $this->mooraService = $mooraService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hasilPerhitungans = HasilPerhitungan::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc')
            ->get();
            
        return view('user.perhitungan.index', compact('hasilPerhitungans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.perhitungan.create');
    }

    /**
     * Calculate using MOORA method and store the result
     */
    public function calculate(Request $request)
    {
        // Validate basic requirements
        $request->validate([
            'nama_perhitungan' => 'required|string|max:255',
            'input_mode' => 'required|in:lama,baru',
        ]);

        // Additional validation based on input mode
        if ($request->input_mode === 'baru') {
            $request->validate([
                'alternatifs' => 'required|array|min:1',
                'alternatifs.*.nama' => 'required|string|max:255',
                'alternatifs.*.nilai' => 'required|array',
                'alternatifs.*.nilai.C1' => 'required|numeric|min:1|max:4',
                'alternatifs.*.nilai.C2' => 'required|numeric|min:1|max:4',
                'alternatifs.*.nilai.C3' => 'required|numeric|min:1|max:4',
                'alternatifs.*.nilai.C4' => 'required|numeric|min:1|max:4',
                'alternatifs.*.nilai.C5' => 'required|numeric|min:1|max:4',
                'alternatifs.*.nilai.C6' => 'required|numeric|min:1|max:4',
                'alternatifs.*.nilai.C7' => 'required|numeric|min:1', // Masa kerja minimal 1 tahun
                'alternatifs.*.nilai.C8' => 'required|numeric|min:1|max:4',
            ], [
                'alternatifs.required' => 'Minimal harus ada 1 alternatif',
                'alternatifs.*.nama.required' => 'Nama karyawan harus diisi',
                'alternatifs.*.nilai.*.required' => 'Semua kriteria harus diisi',
                'alternatifs.*.nilai.C7.min' => 'Masa kerja minimal 1 tahun',
            ]);
        }

        try {
            // Run MOORA calculation based on input mode
            if ($request->input_mode === 'baru') {
                // Convert form data to format expected by MooraService
                $alternatifData = [];
                foreach ($request->alternatifs as $index => $alternatif) {
                    $alternatifData[] = [
                        'nama' => $alternatif['nama'],
                        'nilai' => $alternatif['nilai']
                    ];
                }
                
                // Pass new data to MOORA service
                $hasil = $this->mooraService->hitungMooraWithData($alternatifData);
            } else {
                // Use existing data from database
                $hasil = $this->mooraService->hitungMoora();
            }

            // Save the result
            HasilPerhitungan::create([
                'nama_perhitungan' => $request->nama_perhitungan,
                'user_id' => Auth::id(),
                'data_perhitungan' => [
                    'input_mode' => $request->input_mode,
                    'alternatif_data' => $request->input_mode === 'baru' ? $alternatifData : null,
                    'matriks_keputusan' => $hasil['matriks_keputusan'],
                    'matriks_normalisasi' => $hasil['matriks_normalisasi'],
                    'nilai_optimasi' => $hasil['nilai_optimasi']
                ],
                'hasil_perangkingan' => $hasil['hasil_perangkingan']
            ]);

            return redirect()->route('user.perhitungan.index')
                ->with('success', 'Perhitungan MOORA berhasil dilakukan');

        } catch (\Exception $e) {
            // Log error for debugging
            Log::error('MOORA Calculation Error: ' . $e->getMessage(), [
                'input_mode' => $request->input_mode,
                'alternatifs_count' => $request->input_mode === 'baru' ? count($request->alternatifs ?? []) : 'existing_data',
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan dalam perhitungan: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hasil = HasilPerhitungan::findOrFail($id);

        // Check if the hasil perhitungan belongs to the authenticated user
        if ($hasil->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('user.perhitungan.show', compact('hasil'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hasil = HasilPerhitungan::findOrFail($id);

        // Check if the hasil perhitungan belongs to the authenticated user
        if ($hasil->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $hasil->delete();

        return redirect()->route('user.perhitungan.index')
            ->with('success', 'Hasil perhitungan berhasil dihapus');
    }

    /**
     * FIXED: Print method yang konsisten dengan show method
     */
    public function cetak($id)
    {
        $hasil = HasilPerhitungan::findOrFail($id);

        // Check if the hasil perhitungan belongs to the authenticated user
        if ($hasil->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }

        // ✅ PERBAIKAN: Gunakan variabel yang sama dengan show method
        // dan panggil view user, bukan admin
        return view('user.perhitungan.cetak', compact('hasil'));
    }
}