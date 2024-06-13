<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\ListPembimbing;
use App\Helpers\AlertHelper;

class PersetujuanController extends Controller
{
    //
    public function index()
    {
        $mahasiswa = Mahasiswa::whereHas('pengajuan', function ($query) {
            $query->whereDoesntHave('listPembimbing');
        })->with(['pengajuan'])->get();


        $user = Auth::user();

        $userFakultasId = $user->kaprodi->fakultas_id;
        $dosen = Dosen::whereHas('fakultas', function ($query) use ($userFakultasId) {
            $query->where('id', $userFakultasId);
        })->get();

        return view('pages.kaprodi.persetujuan.index', compact('dosen'));
    }


    public function store(Request $request)
    {
        try {
            foreach ($request->pembimbing as $pembimbing_id) {
                ListPembimbing::create([
                    'dosen_id' => $pembimbing_id,
                    'pengajuan_id' => $request->pengajuan_id,
                ]);
            }
            AlertHelper::alertSuccess('Anda telah berhasil mencari bimbingan', 'Selamat!', 2000);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data'], 500);
        }
    }


    public function getData()
    {
        $mahasiswa = Mahasiswa::whereHas('pengajuan', function ($query) {
            $query->whereDoesntHave('listPembimbing');
        })->with(['pengajuan' => function ($query) {
            $query->whereDoesntHave('listPembimbing')->with('tema');
        }])->get();

        // Bangun HTML table
        $html = '<table id="example" class="cell-border" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Judul</th>
                        <th>Tema</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($mahasiswa as $index => $mhs) {
            foreach ($mhs->pengajuan as $pengajuan) {
                $html .= '<tr>
                        <td>' . ($index + 1) . '</td>
                        <td>' . $mhs->nama . '</td>
                        <td>' . $pengajuan->judul . '</td>
                        <td>' . $pengajuan->tema->nama . '</td>';
                $html .= '
                      <td>
                          <button id="cari-pembimbing" class=" btn btn-primary btn-sm"
                              data-bs-toggle="modal" data-bs-target="#exampleModal"
                              value="' . $pengajuan->id . '">
                              <span><i class="fa-solid fa-magnifying-glass me-1"></i></span>
                              <span>Pembimbing</span>
                          </button>
                      </td>
                    </tr>';
            }
        }

        $html .= '</tbody>
            </table>';

        echo $html;
    }
}
