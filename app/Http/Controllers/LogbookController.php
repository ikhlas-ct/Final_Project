<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Pengajuan;
use App\Models\Dosen;
use Carbon\Carbon;

class LogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $mahasiswaId = $user->mahasiswa->id;
        $pengajuan = Pengajuan::with([
            'judulFinal.pembimbing1.bimbinganp1' => function ($query) {
                $query->where('status', 'selesai');
            },
            'judulFinal.pembimbing2.bimbinganp2' => function ($query) {
                $query->where('status', 'selesai');
            }
        ])->where('id', $mahasiswaId)->get(); // Menggunakan get() untuk mendapatkan koleksi pengajuan

        $dataBimbingan1 = [];
        foreach ($pengajuan as $item) {
            // Ambil nama dosen
            $namaDosen = Dosen::find($item->judulFinal->pembimbing1->dosen_id)->pluck('nama')->first();

            $tanggalBimbingan = "";
            $update = "";

            foreach ($item->judulFinal->pembimbing1->bimbinganp1 as $bimbinganP1) {
                // Ambil tanggal bimbingan
                $tanggalBimbingan = $bimbinganP1->tanggal_reschedule ? $bimbinganP1->tanggal_reschedule : $bimbinganP1->tanggal;

                // Ambil waktu terakhir kali diupdate dan format ke dalam string
                $update = Carbon::parse($bimbinganP1->updated_at)->toDateTimeString(); // Menggunakan toDateTimeString() untuk mendapatkan format datetime string
            }

            $dataBimbingan1[] = [
                "nama_dosen" => $namaDosen,
                "tanggal_bimbingan" => $tanggalBimbingan,
                'updated_at' => $update,
            ];
        }
        $dataBimbingan2 = [];
        foreach ($pengajuan as $item) {
            // Ambil nama dosen
            $namaDosen = Dosen::find($item->judulFinal->pembimbing2->dosen_id)->pluck('nama')->first();

            $tanggalBimbingan = "";
            $update = "";

            foreach ($item->judulFinal->pembimbing2->bimbinganp2 as $bimbinganP2) {
                // Ambil tanggal bimbingan
                $tanggalBimbingan = $bimbinganP2->tanggal_reschedule ? $bimbinganP2->tanggal_reschedule : $bimbinganP2->tanggal;

                // Ambil waktu terakhir kali diupdate dan format ke dalam string
                $update = Carbon::parse($bimbinganP2->updated_at)->toDateTimeString(); // Menggunakan toDateTimeString() untuk mendapatkan format datetime string
            }

            $dataBimbingan2[] = [
                "nama_dosen" => $namaDosen,
                "tanggal_bimbingan" => $tanggalBimbingan,
                'updated_at' => $update,
            ];
        }
        // usort($array, function ($a, $b) {
        //     return strtotime($a['tanggal']) <=> strtotime($b['tanggal']);
        // });
        // Gabungkan kedua array menjadi satu
        $mergeData = array_merge($dataBimbingan1, $dataBimbingan2);
        usort($mergeData, function ($a, $b) {
            return strtotime($a['tanggal_bimbingan']) <=> strtotime($b['tanggal_bimbingan']);
        });
        // Print atau kembalikan array $dataBimbinganp1
        // echo '<pre>';
        // print_r($mergeData);
        // echo '</pre>';

        return view('pages.mahasiswa.logbook.index', compact('mergeData'));
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
