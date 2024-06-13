<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\StatusPengajuan;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $dosenId = $user->dosen->id;

        $mahasiswa = Mahasiswa::whereHas('pengajuan.statusPengajuan', function ($query) use ($dosenId) {
            $query->where('dosen_id', $dosenId)
                ->where('status', 'diproses');
        })->with(['pengajuan' => function ($query) {
            $query->with(['statusPengajuan', 'Tema']);
        }])->get();

        return view('pages.dosen.pengajuan.index', compact('mahasiswa'));
    }


    public function updateStatus(Request $request, $id)
    {
        $user = Auth::user();
        $dosenId = $user->dosen->id;

        $statusPengajuan = StatusPengajuan::where('pengajuan_id', $id)
            ->where('dosen_id', $dosenId)
            ->firstOrFail();

        $statusPengajuan->update([
            'status' => $request->status,
        ]);
        // Update status pengajuan
        // $statusPengajuan->update([
        //     'status' => $request->status,
        // ]);
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
        //
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
