@extends('layouts.app')

@section('content')

<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Gejala</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('db.admin') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ route('gejala') }}">Gejala</a></div>
              <div class="breadcrumb-item">Semua Data</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Data Gejala</h2>
            
            <div class="row mt-4">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="section-header-button">
                      <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Gejala</button>
                    </div>
                    <br>
                    <br>
                    <hr class="">
                      <form class="form-inline my-2 my-lg-0" method="get" action="{{ route('gejala.search') }}">
                        <input class="form-control mr-sm-2" style="width:350px;" type="text" name="q" placeholder="Masukkan Kode Gejala / Kategori Gejala / Nama Gejala" aria-label="Search">
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
                            <th>Kode Gejala</th>
                            <th>Kategori</th>
                            <th>Nama Gejala</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if ($count != '')
                        @foreach($gejala as $g)
                          <tr>
                            <td>{{ $g->kode_gejala }}</td>
                            <td>{{ $g->kategori }}</td>
                            <td>{{ $g->nama_gejala }}</td>
                            <td>
                              <a href="{{ route('gejala.edit', $g->id) }}" class="btn btn-success"><i class="far fa-edit"></i> Edit</a>
                              <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$g->id}})" 
                                  data-target="#DeleteModal" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </td>
                          </tr>
                        @endforeach
                        @else
                          <tr>
                            <td colspan="7" class="text-center">Tidak ada data gejala.</td>
                          </tr>
                        @endif
                        </tbody>
                      </table>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        {{ $gejala->links() }}
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
            <h4 class="modal-title">Form Tambah Gejala</h4>
            <button class="btn btn-danger" type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form method="post" action="{{ route('gejala.save')}}">
              {{ csrf_field() }}
            
              <div class="form-group">
                <label>Kode Gejala</label>
                <input type="text" name="generate" class="form-control" value="{{ $kode_gejala }}" disabled>
                <input type="hidden" name="kode_gejala" class="form-control" value="{{ $kode_gejala }}">
 
                @if($errors->has('kode_gejala'))
                  <div class="text-danger">
                    {{ $errors->first('kode_gejala')}}
                  </div>
                @endif
              </div>

              <div class="form-group">
                <label>Kategori*</label>
                <br>
                <select name="kategori" class="form-control" id="kategori">
                  <option>Pilih Kategori...</option>
                  <option value="Makanan">Makanan</option>
                  <option value="Kotoran">Kotoran</option>
                  <option value="Pernafasan">Pernafasan</option>
                </select>
                                                
                @if($errors->has('kategori'))
                  <div class="text-danger">
                    {{ $errors->first('kategori')}}
                  </div>
                @endif
              </div>
        
              <div class="form-group">
                <label>Nama Gejala*</label>
                <input type="text" name="nama_gejala" class="form-control" placeholder="Nama Gejala .." value="{{ old('nama_gejala') }}">
            
                @if($errors->has('nama_gejala'))
                  <div class="text-danger">
                    {{ $errors->first('nama_gejala')}}
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
            var url = '{{ route("gejala.delete", ":id") }}';
            url = url.replace(':id', id);
            $("#deleteForm").attr('action', url);
        }
        function formSubmit()
        {
            $("#deleteForm").submit();
        }
    </script>

      
@endsection