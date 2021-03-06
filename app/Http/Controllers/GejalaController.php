<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use DB;

class GejalaController extends Controller
{
    public function index()
    {
        $gejala = Gejala::orderby('id','ASC')->paginate(5);
        $count = Gejala::count();
        $kode_gejala = $this->newKode();
        return view('admin/gejala/index', compact('gejala', 'count','kode_gejala'));
    }

    public function newKode()
    {
        $code = 'G'; 
        $noAkhir = Gejala::max('kode_gejala');
        $last = (int) substr($noAkhir, 3, 3);
        $last++;
        $hasil = $code . sprintf("%03s", $last);

        return $hasil;
    }

    public function tambah()
    {
        $kode_gejala = $this->newKode();
        return view('admin/gejala/tambah_gejala', compact('kode_gejala'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_gejala' => ['required', 'max:6'],
            'kategori' => ['required'],
            'nama_gejala' => ['required', 'string']
        ]);

        Gejala::create([
            'kode_gejala' => $request->kode_gejala,
            'kategori' => $request->kategori,
            'nama_gejala' => $request->nama_gejala
        ]);

        return redirect('/gejala')->with(['success' => 'Gejala '. $request->nama_gejala .' berhasil ditambahkan.']);;
    }

    public function edit($id)
    {
        $gejala = Gejala::find($id);
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

        return redirect('admin/gejala/index')->with(['success' => 'Gejala '. $request->nama_gejala .' berhasil diubah.']);
    }

    public function search(Request $request){
        $gejala = Gejala::when($request->g, function ($query) use ($request) {
        $query->where('kategori', 'LIKE', "%{$request->g}%")
                ->orWhere('nama_gejala', 'LIKE', "%{$request->g}%")
                ->orWhere('kode_gejala', 'LIKE', "%{$request->g}%");
        })->paginate(5);
        $count = Gejala::when($request->g, function ($query) use ($request) {
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
        $gejala = Gejala::find($id);
        $gejala->delete();
        return redirect('/gejala')->with(['success' => 'Gejala '. $gejala->nama_gejala .' berhasil dihapus']);
    }
    
}