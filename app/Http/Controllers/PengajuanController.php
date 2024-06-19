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

    public function getData()
    {
        $user = Auth::user();
        $dosenId = $user->dosen->id;

        $mahasiswa = Mahasiswa::whereHas('pengajuan', function ($query) use ($dosenId) {
            $query->whereHas('statusPengajuan', function ($query) use ($dosenId) {
                $query->where('dosen_id', $dosenId)
                    ->where('status', 'diproses');
            })->whereDoesntHave('judulFinal');
        })->with(['pengajuan' => function ($query) {
            $query->with(['statusPengajuan', 'Tema']);
        }])->get();



        echo '<table id="example" class="table-bordered" style="width:100%">
        <thead>
            <tr>
                <th style="width: 3%">No</th>
                <th style="width: 17%">Tema</th>
                <th style="width: 40%">Judul</th>
                <th class="text-center" style="width: 20%">Proposal</th>
                <th class="text-center" style="width: 20%">Aksi</th>
            </tr>
        </thead>
        <tbody>';

        foreach ($mahasiswa as $key => $value) {
            foreach ($value->pengajuan as $pengajuan) {
                echo '<tr id="row-' . $pengajuan->id . '">
                <td>' . ($key + 1) . '</td>
                <td>' . $pengajuan->Tema->nama . '</td>
                <td class="text-justify">' . $pengajuan->judul . '</td>
                <td class="text-center">
                  <a href="' . asset('uploads/tugas-akhir/profosal/' . $pengajuan->proposal) . '" class="btn btn-sm btn-info" target="_blank">Lihat</a>
                </td>
                <td class="text-center">
                    <form class="terima-form" data-id="' . $pengajuan->id . '">
                        <button type="submit" class="btn btn-success btn-sm">Terima</button>
                    </form>
                </td>
            </tr>';
            }
        }

        echo '</tbody>
    </table>';
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
