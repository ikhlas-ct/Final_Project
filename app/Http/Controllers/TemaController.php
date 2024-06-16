<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use App\Models\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TemaController extends Controller
{
    public function index()
    {
        $temas = Tema::with('fakultas')->get();
        return view('pages.kaprodi.tema.index', compact('temas'));
    }

    public function addTema()
    {
        $fakultas = Fakultas::all();
        return view('pages.kaprodi.tema.add', compact('fakultas'));
    }

    public function storeTema(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fakultas_id' => 'required|exists:tb_fakultas,id',
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('halamanTambahTema')
                ->withErrors($validator)
                ->withInput();
        }

        Tema::create([
            'fakultas_id' => $request->fakultas_id,
            'nama' => $request->nama,
        ]);

        return redirect()->route('temaIndex')->with('success', 'Tema Berhasil Ditambah');
    }

    public function editTema($id)
    {
        $tema = Tema::findOrFail($id);
        $fakultas = Fakultas::all();
        return view('pages.kaprodi.tema.edit', compact('tema', 'fakultas'));
    }

    public function updateTema(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'fakultas_id' => 'required|exists:tb_fakultas,id',
            'nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('halamanEditTema', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $tema = Tema::findOrFail($id);
        $tema->update([
            'nama' => $request->nama,
            'fakultas_id' => $request->fakultas_id,
        ]);

        return redirect()->route('temaIndex')->with('success', 'Tema Berhasil Diupdate');
    }

    public function showTema($id)
    {
        $tema = Tema::findOrFail($id);
        return view('pages.kaprodi.tema.index', compact('tema'));
    }

    public function hapusTema($id)
    {
        $tema = Tema::findOrFail($id);
        $tema->delete();

        return redirect()->route('temaIndex')->with('success', 'Tema Berhasil Dihapus');
    }
}
