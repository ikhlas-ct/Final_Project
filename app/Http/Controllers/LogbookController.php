<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Pengajuan;
use App\Helpers\AlertHelper;

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
                $query->where('status', 'selesai')->with('logbookB1');
            },
            'judulFinal.pembimbing2.bimbinganp2' => function ($query) {
                $query->where('status', 'selesai')->with('logbookB2');
            }
        ])->where('id', $mahasiswaId)->get();

        $dataBimbingan1 = [];
        foreach ($pengajuan as $item) {
            if (empty($item->judulFinal) || empty($item->judulFinal->pembimbing1)) {
                AlertHelper::alertError('Selesaikan pengajuan terlebih dahulu', 'Opsss!!', 3000);
                return redirect()->back();
            }
            $namaDosen = $item->judulFinal->pembimbing1->dosen->nama;
            foreach ($item->judulFinal->pembimbing1->bimbinganp1 as $bimbinganP1) {
                $logbook = [];
                foreach ($bimbinganP1->logbookB1 as $logbookB1) {
                    $logbook[] = [
                        "id" => $logbookB1->id,
                        "kegiatan" => $logbookB1->kegiatan,
                        "detail_kegiatan" => $logbookB1->detail_kegiatan
                    ];
                }
                // Tentukan tanggal bimbingan
                $tanggalBimbingan = $bimbinganP1->tanggal_reschedule ? $bimbinganP1->tanggal_reschedule : $bimbinganP1->tanggal;

                // Pastikan tanggal bimbingan tidak kosong
                if (!empty($tanggalBimbingan)) {
                    $dataBimbingan1[] = [
                        "id" => $bimbinganP1->id,
                        "type" => 1,
                        "nama_dosen" => $namaDosen,
                        "tanggal_bimbingan" => $tanggalBimbingan,
                        "status" => $item->judulFinal->pembimbing1->status,
                        'logbook' => $logbook,
                    ];
                }
            }
        }
        $dataBimbingan2 = [];
        foreach ($pengajuan as $item) {
            if (empty($item->judulFinal) || empty($item->judulFinal->pembimbing2)) {
                AlertHelper::alertError('Selesaikan pengajuan terlebih dahulu', 'Opsss!!', 3000);
                return redirect()->back();
            }
            $namaDosen = $item->judulFinal->pembimbing2->dosen->nama;
            foreach ($item->judulFinal->pembimbing2->bimbinganp2 as $bimbinganP2) {
                $logbook = [];
                foreach ($bimbinganP2->logbookB2 as $logbookB2) {
                    $logbook[] = [
                        "id" => $logbookB2->id,
                        "kegiatan" => $logbookB2->kegiatan,
                        "detail_kegiatan" => $logbookB2->detail_kegiatan
                    ];
                }
                // Tentukan tanggal bimbingan
                $tanggalBimbingan = $bimbinganP2->tanggal_reschedule ? $bimbinganP2->tanggal_reschedule : $bimbinganP2->tanggal;

                // Pastikan tanggal bimbingan tidak kosong
                if (!empty($tanggalBimbingan)) {
                    $dataBimbingan2[] = [
                        "id" => $bimbinganP2->id,
                        "type" => 2,
                        "nama_dosen" => $namaDosen,
                        "tanggal_bimbingan" => $tanggalBimbingan,
                        "status" => $item->judulFinal->pembimbing2->status,
                        'logbook' => $logbook,
                    ];
                }
            }
        }

        // Gabungkan kedua array menjadi satu
        $mergeData = array_merge($dataBimbingan1, $dataBimbingan2);
        usort($mergeData, function ($a, $b) {
            return strtotime($a['tanggal_bimbingan']) <=> strtotime($b['tanggal_bimbingan']);
        });

        $status_p1 = "";
        $status_p2 = "";
        foreach ($mergeData as $item) {
            if ($item['type'] == 1) {
                $status_p1 = $item['status'];
            }
            if ($item['type'] == 2) {
                $status_p2 = $item['status'];
            }
        }

        // echo $status_p1 . $status_p2;
        // die;
        // Print atau kembalikan array $dataBimbinganp1
        // echo '<pre>';
        // print_r($mergeData);
        // echo '</pre>';
        // die;
        return view('pages.mahasiswa.logbook.index', compact('mergeData', 'status_p1', 'status_p2', 'mahasiswaId'));
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

        $modelClass = "App\\Models\\LogbookB" . $request->type;
        $bimbingan = "bimbingan_p$request->type" . "_id";
        $modelClass::create([
            $bimbingan => $request->id,
            'kegiatan' => $request->kegiatan,
            'detail_kegiatan' => $request->detail_kegiatan,
        ]);
        // print_r($request->all());
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
