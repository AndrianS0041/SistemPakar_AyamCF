@extends('layouts.app')

@section('content')

<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Basis Pengetahuan</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('db.admin') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ route('pengetahuan') }}">Basis Pengetahuan</a></div>
              <div class="breadcrumb-item">Semua Data</div>
            </div>
          </div>
          <div class="section-body">
            <h2 class="section-title">Data Basis Pengetahuan</h2>
            
            <div class="row mt-4">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="section-header-button">
                      <button type="button" name="age" id="age" data-toggle="modal" data-target="#add_data_Modal" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Basis Pengetahuan</button>
                      {{-- <a href="{{route('p.add')}}"><button type="button" class="btn btn-secondary"><i class="fas fa-plus"></i> Tambah Basis Pengetahuan</button></a> --}}
                    </div>
                    <br>
                    <br>
                    <hr class="">
                      <form class="form-inline my-2 my-lg-0" method="get" action="">
                        <input class="form-control mr-sm-2" style="width:350px;" type="text" name="bp" placeholder="Masukkan Kode / Penyakit / Gejala" aria-label="Search">
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
                            <th>Kode </th>
                            <th>Nama Penyakit</th>
                            <th>Gejala</th>
                            <th>MB</th>
                            <th>MD</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        @if ($count != '')
                        @foreach($data as $bp)
                          <tr>
                            <td>{{ $bp->kode_pengetahuan }}</td>
                            <td>{{ $bp->nama_penyakit }}</td>
                            <td>{{ $bp->nama_gejala }}</td>
                            <td>{{ $bp->mb }}</td>
                            <td>{{ $bp->md }}</td>
                            <td>
                              <a href="{{ route('p.edit', $bp->id) }}" class="btn btn-success"><i class="far fa-edit"></i> Edit</a>
                              <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$bp->id}})" 
                                  data-target="#DeleteModal" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus</a>
                            </td>
                          </tr>
                        @endforeach
                        @else
                          <tr>
                            <td colspan="7" class="text-center">Tidak Ada Data Basis Pengetahuan.</td>
                          </tr>
                        @endif
                        </tbody>
                      </table>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        {{ $data->links() }}
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
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form Tambah Basis Pengetahuan</h4>
              <button class="btn btn-danger" type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <div class='alert alert-warning'>
                    <h5><i class="fas fa-exclamation-triangle"></i> <b> Petunjuk Pengisian Pakar !</b></h5>
                    <p>Silahkan pilih gejala yang sesuai dengan kerusakan yang ada, dan berikan 
                      <b>nilai kepastian (MB & MB)</b> dengan cakupan sebagai berikut:
                      <table>
                        <tr>
                          <td><b>1</b> (Pasti Ya)</td>
                          <td><b>0.8</b> (Hampir Pasti)</td>
                        </tr>
                        <tr>
                          <td><b>0.6</b> (Kemungkinan Besar)</td>
                          <td><b>0.4</b> (Mungkin)</td>
                        </tr>
                        <tr>
                          <td><b>0.2</b> (Hampir Mungkin)</td>
                          <td><b>0</b> (Tidak Tahu atau Tidak Yakin)</td>
                        </tr>
                      </table>
                      <br>
                      <b>CF(Pakar) = MB – MD</b>
                      <br>
                      <p>
                        MB : Ukuran kenaikan kepercayaan (measure of increased belief) 
                        <br>
                        MD : Ukuran kenaikan ketidakpercayaan (measure of increased disbelief)
                      </p>
                      <b>Contoh:</b>
                      <br>
                      <p>Jika kepercayaan <b>(MB)</b> anda terhadap gejala ? untuk kerusakan ? adalah <b>0.8 (Hampir Pasti)</b>
                        <br>
                        Dan ketidakpercayaan <b>(MD)</b> anda terhadap gejala ? untuk kerusakan ? adalah <b>0.2 (Hampir Mungkin)</b><br><br>
                          <b>Maka:</b> CF(Pakar) = MB – MD (0.8 - 0.2) = <b>0.6</b> <br>
                          Dimana nilai kepastian anda terhadap gejala ? untuk kerusakan ? adalah <b>0.6 (Kemungkinan Besar)</b>
                      </p>
                    </p>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                  <form method="post" action="{{ route('p.save')}}">
                  {{ csrf_field() }}
                
                  <div class="form-group">
                    <label>Kode Pengetahuan</label>
                    <input type="text" name="generate" class="form-control" value="{{ $kode }}" disabled>
                    <input type="hidden" name="kode" class="form-control" value="{{ $kode }}">
    
                    @if($errors->has('kode'))
                      <div class="text-danger">
                        {{ $errors->first('kode')}}
                      </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label>Nama Penyakit*</label>
                    <select class="penyakit form-control" id="cari_penyakit" name="id_penyakit"></select>
                
                    @if($errors->has('id_penyakit'))
                      <div class="text-danger">
                        {{ $errors->first('id_penyakit')}}
                      </div>
                    @endif
                  </div>
            
                  <div class="form-group">
                    <label>Gejala*</label>
                    <select class="gejala form-control" id="cari_gejala" name="id_gejala"></select>
                
                    @if($errors->has('id_gejala'))
                      <div class="text-danger">
                        {{ $errors->first('id_gejala')}}
                      </div>
                    @endif
                  </div>

                  <div class="form-group">
                    <label>MB*</label>
                    <select name="mb" class="form-control" id="mb">
                      <option>Pilih Bobot MB...</option>
                      <option value="1"> (1) Pasti Ya</option>
                      <option value="0.8">(0.8) Hampir Pasti</option>
                      <option value="0.6">(0.6) Kemungkinan Besar</option>
                      <option value="0.2">(0.2) Mungkin</option>
                      <option value="0">(0) Tidak Tahu</option>
                    </select>
                
                    @if($errors->has('mb'))
                      <div class="text-danger">
                        {{ $errors->first('md')}}
                      </div>
                    @endif
                  </div>
                  
                  <div class="form-group">
                    <label>MD*</label>
                    <select name="md" class="form-control" id="md">
                      <option>Pilih Bobot MD...</option>
                      <option value="1"> (1) Pasti Ya</option>
                      <option value="0.8">(0.8) Hampir Pasti</option>
                      <option value="0.6">(0.6) Kemungkinan Besar</option>
                      <option value="0.2">(0.2) Mungkin</option>
                      <option value="0">(0) Tidak Tahu</option>
                    </select>
                
                    @if($errors->has('md'))
                      <div class="text-danger">
                        {{ $errors->first('md')}}
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
        </div>
      </div>


<script type="text/javascript">
  function deleteData(id){
    var id = id;
    var url = '{{ route("p.delete", ":id") }}';
    url = url.replace(':id', id);
    $("#deleteForm").attr('action', url);
  }
  function formSubmit(){
    $("#deleteForm").submit();
  }
</script>

<script type="text/javascript">
    $(document).ready(function() {
    $('.penyakit').select2({
        placeholder: 'Cari Penyakit...',
        ajax: {
            url: "{{ route('get.penyakit') }}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.nama_penyakit,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
});

$(document).ready(function() {
    $('.gejala').select2({
        placeholder: 'Cari Gejala...',
        ajax: {
            url: "{{ route('get.gejala') }}",
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results:  $.map(data, function (item) {
                        return {
                            text: item.nama_penyakit,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    });
});

</script>

      
@endsection