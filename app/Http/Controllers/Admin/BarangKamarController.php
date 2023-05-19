<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangKamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangKamarController extends Controller
{

    public function index()
    {
        return view('dashboard.barang-kamar.index', [
            'barangKamars' => BarangKamar::all(),
        ]);
    }


    public function create()
    {
        return view('dashboard.barang-kamar.create');
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "nama" => "required|max:255",
            "jumlah" => "required",
            "img" => "image|file|max:1024",
        ]);

        if ($request->file('img')) {
            $validatedData["img"] = $request->file('img')->store('foto-barang-kamar');
        }

        BarangKamar::create($validatedData);

        return redirect('/admin/barang-kamar')->with('success', 'Barang baru telah ditambahkan!');
    }


    public function edit(BarangKamar $barangKamar)
    {
        return view('dashboard.barang-kamar.edit', [
            'barangKamar' => $barangKamar,
        ]);
    }


    public function update(Request $request, BarangKamar $barangKamar)
    {
        $validatedData = $request->validate([
            "nama" => "required|max:255",
            "jumlah" => "required",
            "img" => "image|file|max:1024",
        ]);

        if ($request->file('img')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData["img"] = $request->file('img')->store('foto-barang-kamar');
        }

        BarangKamar::where('id', $barangKamar->id)
            ->update($validatedData);

        return redirect('/admin/barang-kamar')->with('success', 'Barang telah diperbarui!');
    }
    

    public function destroy(BarangKamar $barangKamar)
    {
        if ($barangKamar->img) {
            Storage::delete($barangKamar->img);
        }

        BarangKamar::destroy($barangKamar->id);
        return redirect('/admin/barang-kamar')->with('success', 'Barang telah dihapus!');
    }
}
