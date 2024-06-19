<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
            'pembimbing' => 'required|array|min:2',
            'pembimbing.*' => 'exists:tb_dosen,id',
            'pengajuan_id' => 'required|exists:tb_pengajuan,id',
        ], [
            'pembimbing.required' => 'Anda harus memilih minimal dua pembimbing.',
            'pembimbing.array' => 'Pembimbing harus berupa array.',
            'pembimbing.min' => 'Anda harus memilih minimal dua pembimbing.',
            'pembimbing.*.exists' => 'Pembimbing yang dipilih tidak valid.',
            'pengajuan_id.required' => 'ID Pengajuan diperlukan.',
            'pengajuan_id.exists' => 'ID Pengajuan tidak valid.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            foreach ($request->pembimbing as $pembimbing_id) {
                ListPembimbing::create([
                    'dosen_id' => $pembimbing_id,
                    'pengajuan_id' => $request->pengajuan_id,
                ]);
            }

            // Jika berhasil, kembalikan respons success
            return response()->json(['success' => 'Anda telah berhasil mencari bimbingan'], 200);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan saat menyimpan data
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
        $html = '<table id="example" class="table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:5%;">No</th>
                        <th style="width:20%;">Nama</th>
                        <th style="width:15%;">Tema</th>
                        <th style="width:30%;">Judul</th>
                        <th class="text-center" style="width:20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>';
        foreach ($mahasiswa as $index => $mhs) {
            foreach ($mhs->pengajuan as $pengajuan) {
                $html .= '<tr>
                        <td class="text-start">' . ($index + 1) . '</td>
                        <td class="text-start">' . $mhs->nama . '</td>
                         <td class="text-start">' . $pengajuan->tema->nama . '</td>
                        <td class="text-start">' . $pengajuan->judul . '</td>
                       ';
                $html .= '
                      <td class="text-center">
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
