<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyakit;
use DB;

class PenyakitController extends Controller
{
    public function index()
    {
        $penyakit = Penyakit::orderby('id','ASC')->paginate(5);
        $count = Penyakit::count();
        $kode_penyakit = $this->newKode();
        return view('admin/penyakit/index', compact('penyakit', 'count','kode_penyakit'));
    }

    public function newKode()
    {
        $code = 'P'; 
        $noAkhir = Penyakit::max('kode_penyakit');
        $last = (int) substr($noAkhir, 3, 3);
        $last++;
        $hasil = $code . sprintf("%03s", $last);

        return $hasil;
    }

    public function tambah()
    {
        $kode_penyakit = $this->newKode();
        return view('admin/penyakit/tambah_penyakit', compact('kode_penyakit'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_penyakit' => ['required', 'max:6'],
            'nama_penyakit' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'max:500'],
            'saran' => ['required', 'string', 'max:500'],
            'gambar' => ['file','image','mimes:jpeg,png,jpg','max:2048']
        ]);

        if ($request->hasFile('gambar')) {
        $file = $request->file('gambar');
        $nama_file = time()."_".$file->getClientOriginalName();
        $tujuan_upload = 'upload';
        $file->move($tujuan_upload,$nama_file);

        $penyakit = Penyakit::create([
            'kode_penyakit' => $request->kode_penyakit,
            'nama_penyakit' => $request->nama_penyakit,
            'detail' => $request->detail,
            'saran' => $request->saran,
            'gambar' => $nama_file         
            ]);
        } else {
            $penyakit = Penyakit::create([
                'kode_penyakit' => $request->kode_penyakit,
                'nama_penyakit' => $request->nama_penyakit,
                'detail' => $request->detail,
                'saran' => $request->saran      
                ]);
        }

        return redirect('/penyakit')->with(['success' => 'Penyakit '. $request->nama_penyakit .' berhasil ditambahkan.']);;
    }

    public function edit($id)
    {
        $penyakit = Penyakit::find($id);
        return view('admin/penyakit/edit_penyakit', compact('penyakit'));
    }

    public function update($id, Request $request)
    {
        $nama_file = $request->foto_lama;
		$file = $request->file('foto');
        
        if ($file != '') {
            $penyakit = Penyakit::find($id);
            $this->validate($request,[
              'kode_penyakit' => ['required', 'max:6'],
            'nama_penyakit' => ['required', 'string', 'max:255'],
            'detail' => ['required', 'max:500'],
            'saran' => ['required', 'string', 'max:500'],
            'gambar' => ['file','image','mimes:jpeg,png,jpg','max:2048']
            ]);

            $nama_file = time()."_".$file->getClientOriginalName();        
            $tujuan_upload = 'upload';
            $file->move($tujuan_upload,$nama_file);
            
        } else{
            $this->validate($request,[
                'kode_penyakit' => ['required', 'max:6'],
                'nama_penyakit' => ['required', 'string', 'max:255'],
                'detail' => ['required', 'max:500'],
                'saran' => ['required', 'string', 'max:500']
            ]);
        }
        
        $penyakit = Penyakit::find($id);
        $penyakit->kode_penyakit = $request->kode_penyakit;
        $penyakit->nama_penyakit = $request->nama_penyakit;
        $penyakit->detail = $request->detail;
        $penyakit->saran = $request->saran;
        $penyakit->gambar = $nama_file; 

        $penyakit->save();
        return redirect('/penyakit')->with(['success' => 'Data penyakit '. $request->name .' berhasil diubah.']);
    }

    public function search(Request $request){
        $penyakit = Penyakit::when($request->p, function ($query) use ($request) {
        $query->where('kode_penyakit', 'LIKE', "%{$request->p}%")
                ->orWhere('nama_penyakit', 'LIKE', "%{$request->p}%");
        })->paginate(5);
        $count = Penyakit::when($request->p, function ($query) use ($request) {
        $query->where('kode_penyakit', 'LIKE', "%{$request->p}%")
                ->orWhere('nama_penyakit', 'LIKE', "%{$request->p}%");
        })->count();
        $penyakit->appends($request->only('p'));
        $old = $request->p;
    
        return view('/penyakit', compact('penyakit', 'old', 'count'));
    }

    public function delete($id)
    {
        $penyakit = Penyakit::find($id);
        $penyakit->delete();
        return redirect('/penyakit')->with(['success' => 'Penyakit '. $penyakit->nama_penyakit .' berhasil dihapus']);
    }
}