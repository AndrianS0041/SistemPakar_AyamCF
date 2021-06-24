<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengetahuanController extends Controller
{
    public function index()
    {
        $pengetahuan = Pengetahuan::orderby('id','ASC')->paginate(5);
        $count = Pengetahuan::count();
        $kode_pengetahuan = $this->newKode();
        return view('admin/pengetahuan/index', compact('pengetahuan', 'count','kode_pengetahuan'));
    }

    public function newKode()
    {
        $code = 'G'; 
        $noAkhir = Pengetahuan::max('kode_pengetahuan');
        $last = (int) substr($noAkhir, 3, 3);
        $last++;
        $hasil = $code . sprintf("%03s", $last);

        return $hasil;
    }

    public function tambah()
    {
        $kode_pengetahuan = $this->newKode();
        return view('admin/pengetahuan/tambah_pengetahuan', compact('kode_pengetahuan'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_pengetahuan' => ['required', 'max:6'],
            'kategori' => ['required'],
            'nama_pengetahuan' => ['required', 'string']
        ]);

        Pengetahuan::create([
            'kode_pengetahuan' => $request->kode_pengetahuan,
            'kategori' => $request->kategori,
            'nama_gejala' => $request->nama_gejala
        ]);

        return redirect('/gejala')->with(['success' => 'Gejala '. $request->nama_gejala .' berhasil ditambahkan.']);;
    }

    public function edit($id)
    {
        $gejala = Pengetahuan::find($id);
        return view('admin/gejala/edit_gejala', compact('gejala'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'kode_gejala' => ['required', 'max:6'],
            'kategori' => ['required'],
            'nama_gejala' => ['required', 'string']
        ]);

        $gejala = Gejala::find($id);
        $gejala->kategori = $request->kategori;
        $gejala->nama_gejala = $request->nama_gejala;

        $gejala->save();

        return redirect('/gejala')->with(['success' => 'Gejala '. $request->nama_gejala .' berhasil diubah.']);
    }

    public function search(Request $request){
        $gejala = Pengetahuan::when($request->g, function ($query) use ($request) {
        $query->where('kategori', 'LIKE', "%{$request->g}%")
                ->orWhere('nama_gejala', 'LIKE', "%{$request->g}%")
                ->orWhere('kode_gejala', 'LIKE', "%{$request->g}%");
        })->paginate(5);
        $count = Pengetahuan::when($request->g, function ($query) use ($request) {
        $query->where('kategori', 'LIKE', "%{$request->g}%")
                ->orWhere('nama_gejala', 'LIKE', "%{$request->g}%")
                ->orWhere('kode_gejala', 'LIKE', "%{$request->g}%");
        })->count();
        $gejala->appends($request->only('g'));
        $old = $request->g;
    
        return view('/gejala', compact('gejala', 'old', 'count'));
    }

    public function delete($id)
    {
        $gejala = Pengetahuan::find($id);
        $gejala->delete();
        return redirect('/gejala')->with(['success' => 'Gejala '. $gejala->nama_gejala .' berhasil dihapus']);
    }
}