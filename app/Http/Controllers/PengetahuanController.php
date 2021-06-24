<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengetahuan;
use App\Models\Penyakit;
use App\Models\Gejala;
use DB;

class PengetahuanController extends Controller
{
    public function index()
    {   
        $data = Pengetahuan::join('penyakit', 'penyakit.id', '=', 'basis_pengetahuan.id_penyakit')
                ->join('gejala', 'gejala.id', '=', 'basis_pengetahuan.id_gejala')
                ->select('basis_pengetahuan.*','penyakit.nama_penyakit','gejala.nama_gejala')
                ->orderBy('id','DESC')->paginate(5);
        $count = Pengetahuan::count();
        $kode = $this->newKode();
        return view('admin/pengetahuan/index', compact('data', 'count','kode'));
    }

    

    public function newKode()
    {
        $code = 'BP'; 
        $noAkhir = Pengetahuan::max('kode');
        $last = (int) substr($noAkhir, 3, 3);
        $last++;
        $hasil = $code . sprintf("%03s", $last);

        return $hasil;
    }

    public function select(Request $request)
    {
        $search = $request->get('term');
        $result = Penyakit::select('id','nama_penyakit')
        ->where('nama_penyakit', 'LIKE', '%'. $search. '%')
        ->orderby('id', 'desc')
        ->limit(5)->get();
        
        return response()->json($result);
    } 

    public function select2(Request $request)
    {
        $search = $request->get('term');
        $result = Gejala::select('id','nama_gejala')
        ->where('nama_gejala', 'LIKE', '%'. $search. '%')
        ->orderby('id', 'desc')
        ->limit(5)->get();
        
        return response()->json($result);
    } 

    public function tambah()
    {
        $kode = $this->newKode();
        return view('admin/pengetahuan/tambah_pengetahuan', compact('kode'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode' => ['required', 'max:6'],
            'id_penyakit' => ['required', 'max:5'],
            'id_gejala' => ['required', 'max:5'],
            'mb' => ['required', 'max:500'],
            'md' => ['required', 'max:500']
        ]);

        Pengetahuan::create([
            'kode' => $request->kode,
            'id_penyakit' => $request->id_penyakit,
            'id_gejala' => $request->id_gejala,
            'mb' => $request->mb,
            'md' => $request->md
        ]);

        return redirect('/pengetahuan')->with(['success' => 'Pengetahuan '. $request->kode .' berhasil ditambahkan.']);;
    }

    public function edit($id)
    {
        $gejala = Pengetahuan::find($id);
        return view('admin/gejala/edit_gejala', compact('gejala'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'id_penyakit' => ['required', 'max:6'],
            'id_gejala' => ['required'],
            'mb' => ['required', 'string'],
            'md' => ['required', 'string']
        ]);

        $pengetahuan = Pengetahuan::find($id);
        $pengetahuan->id_penyakit = $request->id_penyakit;
        $pengetahuan->id_gejala = $request->id_gejala;
        $pengetahuan->mb = $request->mb;
        $pengetahuan->md = $request->md;

        $pengetahuan->save();

        return redirect('/gejala')->with(['success' => 'Gejala '. $request->nama_gejala .' berhasil diubah.']);
    }

    public function search(Request $request){
        $pengetahuan = Pengetahuan::when($request->bp, function ($query) use ($request) {
        $query->where('kode', 'LIKE', "%{$request->bp}%")
                ->orWhere('nama_penyakit', 'LIKE', "%{$request->bp}%")
                ->orWhere('nama_gejala', 'LIKE', "%{$request->bp}%");
        })->paginate(5);
        $count = Pengetahuan::when($request->bp, function ($query) use ($request) {
        $query->where('kode', 'LIKE', "%{$request->bp}%")
                ->orWhere('nama_penyakit', 'LIKE', "%{$request->bp}%")
                ->orWhere('nama_gejala', 'LIKE', "%{$request->bp}%");
        })->count();
        $pengetahuan->appends($request->only('bp'));
        $old = $request->bp;
    
        return view('/pengetahuan', compact('pengetahuan', 'old', 'count'));
    }

    public function delete($id)
    {
        $pengetahuan = Pengetahuan::find($id);
        $pengetahuan->delete();
        return redirect('/pengetahuan')->with(['success' => 'Pengetahuan '. $pengetahuan->kode .' berhasil dihapus']);
    }
}