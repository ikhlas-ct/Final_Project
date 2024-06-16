<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Pengajuan;
use App\Models\Bimbingan;
use App\Models\Reschedule;

class BimbinganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $mahasiswaId = $user->mahasiswa->id;
        $pengajuan = Pengajuan::with([
            'judulFinal.pembimbing1.dosen.bimbingan' => function ($query) {
                $query
                    ->orderBy('tanggal', 'desc')
                    ->first(); // Ambil hanya satu data terakhir
            },
            'judulFinal.pembimbing2.dosen.bimbingan' => function ($query) {
                $query
                    ->orderBy('tanggal', 'desc')
                    ->first(); // Ambil hanya satu data terakhir
            }
        ])
            ->where('mahasiswa_id', $mahasiswaId)
            ->get();

        return view('pages.mahasiswa.bimbingan.index', compact('pengajuan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Bimbingan::create([
            'dosen_id' => $request->id,
            'tanggal' => $request->tanggal,
            'status' => 'diproses',
        ]);
        echo 'berhasil';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        echo $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bimbingan = Bimbingan::findOrFail($id);
        $bimbingan->status = $request->status;
        $bimbingan->save();
    }

    public function reschedule(Request $request, string $id)
    {
        Reschedule::create([
            'bimbingan_id' => $id,
            'tanggal' => $request->date,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
