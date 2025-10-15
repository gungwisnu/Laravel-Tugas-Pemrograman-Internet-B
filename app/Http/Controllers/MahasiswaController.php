<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // Tampilkan semua data mahasiswa (dengan fitur sort)
    public function index(Request $request)
    {
        $sort = $request->get('sort', 'id');
        $order = $request->get('order', 'asc');

        if (!in_array($sort, ['id', 'nim', 'nama', 'prodi', 'created_at'])) {
            $sort = 'id';
        }

        $mahasiswas = Mahasiswa::orderBy($sort, $order)->get();

        return view('mahasiswa.index', compact('mahasiswas', 'sort', 'order'));
    }

    // Form tambah data
    public function create()
    {
        return view('mahasiswa.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswas,nim|min:4',
            'nama' => 'required',
            'prodi' => 'required',
        ]);

        $mahasiswa = Mahasiswa::create($request->only(['nim', 'nama', 'prodi']));

        return redirect()->route('mahasiswa.index')->with('success', "Data <b>{$mahasiswa->nim}</b> berhasil ditambahkan!");
    }

    // Form edit
    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // Update data
    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required|min:4|unique:mahasiswas,nim,' . $id,
            'nama' => 'required',
            'prodi' => 'required',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update($request->only(['nim', 'nama', 'prodi']));

        return redirect()->route('mahasiswa.index')->with('success', "Data <b>{$mahasiswa->nim}</b> berhasil diperbarui!");
    }

    // Halaman konfirmasi hapus
    public function confirmDelete($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.delete', compact('mahasiswa'));
    }

    // Hapus data
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $nim = $mahasiswa->nim;
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', "Data <b>{$mahasiswa->nim}</b> berhasil dihapus!");
    }

    // Pencarian AJAX
    public function search(Request $request)
    {
        $keyword = $request->get('keyword', '');

        $hasil = Mahasiswa::where('nama', 'like', "%{$keyword}%")
            ->orWhere('nim', 'like', "%{$keyword}%")
            ->orWhere('prodi', 'like', "%{$keyword}%")
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($hasil);
    }
}
