@extends('layouts.app')

@section('content')

<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Penyakit</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('db.admin') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ route('penyakit') }}">Penyakit</a></div>
              <div class="breadcrumb-item">Semua Data</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Data Penyakit</h2>
            
            <div class="row mt-4">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="section-header-button">
                      <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Penyakit</button>
                    </div>
                    <br>
                    <br>
                    <hr class="">
                      <form class="form-inline my-2 my-lg-0" method="get" action="{{ route('penyakit.search') }}">
                        <input class="form-control mr-sm-2" style="width:350px;" type="text" name="q" placeholder="Masukkan Kode Penyakit / Nama Penyakit" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><span class="mdi mdi-magnify"></span> Cari</button>
                      </form>
                  </div>
                  <div class="card-body">
                    <div class="clearfix mb-3"></div>
                    @if (session('success'))
                      <div class="alert alert-success">
                        {{ session('success') }}
                      </div>
                    @endif
                    @if (session('error'))
                      <div class="alert alert-danger">
                        {{ session('error') }}
                      </div>
                    @endif
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover table-striped">
                        <thead>
                          <tr>
                            <th>Kode Penyakit</th>
                            <th>Nama Penyakit</th>
                            <th>Detail Penyakit</th>
                            <th>Saran Penyakit</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if ($count != '')
                        @foreach($penyakit as $p)
                          <tr>
                            <td>{{ $p->kode_penyakit }}</td>
                            <td>{{ $p->nama_penyakit }}</td>
                            <td>{{ $p->detail }}</td>
                            <td>{{ $p->saran }}</td>
                            <td>
                              <a href="{{ route('penyakit.edit', $p->id) }}" class="btn btn-success"><i class="far fa-edit"></i> Edit</a>
                              <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$p->id}})" 
                                  data-target="#DeleteModal" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </td>
                          </tr>
                        @endforeach
                        @else
                          <tr>
                            <td colspan="7" class="text-center">Tidak Ada Data Penyakit.</td>
                          </tr>
                        @endif
                        </tbody>
                      </table>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        {{ $penyakit->links() }}
                    </div> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <div id="DeleteModal" class="modal fade" role="dialog">
        <div class="modal-dialog ">
          <!-- Modal content-->
          <form action="" id="deleteForm" method="post">
            <div class="modal-content">
              <div class="modal-header bg-danger">
                  <h4 class="modal-title text-light"> Konfirmasi !</h4>
              </div>
              <div class="modal-body">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <p class="text-center">Apakah anda yakin akan menghapus gejala ? </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                <button type="submit" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()"><span class="mdi mdi-delete"></span> Ya, Hapus</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Form Tambah Penyakit</h4>
            <button class="btn btn-danger" type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form method="post" action="{{ route('penyakit.save')}}">
              {{ csrf_field() }}
            
              <div class="form-group">
                <label>Kode Penyakit</label>
                <input type="text" name="generate" class="form-control" value="{{ $kode_penyakit }}" disabled>
                <input type="hidden" name="kode_penyakit" class="form-control" value="{{ $kode_penyakit }}">
 
                @if($errors->has('kode_penyakit'))
                  <div class="text-danger">
                    {{ $errors->first('kode_penyakit')}}
                  </div>
                @endif
              </div>

              <div class="form-group">
                <label>Nama Penyakit*</label>
                <input type="text" name="nama_penyakit" class="form-control" placeholder="Nama Penyakit .." value="{{ old('nama_penyakit') }}">
            
                @if($errors->has('nama_penyakit'))
                  <div class="text-danger">
                    {{ $errors->first('nama_penyakit')}}
                  </div>
                @endif
              </div>
        
              <div class="form-group">
                <label>Detail*</label>
                <textarea name="detail" id="" cols="30" rows="10" class="form-control" placeholder="Detail Penyakit .." value="{{ old('detail') }}"></textarea>
            
                @if($errors->has('detail'))
                  <div class="text-danger">
                    {{ $errors->first('detail')}}
                  </div>
                @endif
              </div>

              <div class="form-group">
                <label>Saran*</label>
                <textarea name="saran" id="" cols="30" rows="10" class="form-control" placeholder="Saran Penyakit .." value="{{ old('saran') }}"></textarea>
            
                @if($errors->has('saran'))
                  <div class="text-danger">
                    {{ $errors->first('saran')}}
                  </div>
                @endif
              </div>

              <div class="form-group">
                <label>Gambar*</label>
                
                <input type="file" name="foto" class="form-control" placeholder="Upload foto profil">
                <br>
                  <label>Format file foto yang diizinkan: jpg,jepg,png dan ukuran file maksimal 2MB</label>
     
                  @if($errors->has('foto'))
                    <div class="text-danger">
                      {{ $errors->first('foto')}}
                    </div>
                  @endif
              </div>
            
              <label style="color:red;">* Wajib diisi.</label>
              <br>
              <button class="btn btn-success float-right" type="submit" name="submit" id="insert" value="Submit"><i class="far fa-save"></i> Submit</button>
            
            </form>
          </div>
          </div>
        </div>
      </div>


      <script type="text/javascript">
        function deleteData(id)
        {
            var id = id;
            var url = '{{ route("penyakit.delete", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>

      
@endsection