@extends('layouts.app')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Basis Pengetahuan</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('db.admin') }}">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="{{ route('pengetahuan') }}">Basis Pengetahuan</a></div>
              <div class="breadcrumb-item">Form Tambah Data</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Form Tambah Data Basis Pengetahuan</h2>
            
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="section-header-button">
                            <a href="{{route('pengetahuan')}}"><button type="button" class="btn btn-primary"><i class="far fa-hand-point-left"></i> Kembali</button></a>
                            </div>
                            <br>
                            <br>
                        </div>
                        <div class="card">
                            <div class="card-body">
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
                                        <form method="post" action="{{ route('p.save')}}" class="needs-validation">
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
                                                <div class="invalid-feedback">
                                                    Masukkan Nama Penyakit?
                                                </div>
                                            
                                                @if($errors->has('id_penyakit'))
                                                <div class="text-danger">
                                                    {{ $errors->first('id_penyakit')}}
                                                </div>
                                                @endif
                                            </div>
                                        
                                            <div class="form-group">
                                                <label>Gejala*</label>
                                                <select class="gejala form-control" id="cari_gejala" name="id_gejala"></select>
                                                <div class="invalid-feedback">
                                                    Masukkan Nama Gejala?
                                                </div>
                                                
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
                                                <div class="invalid-feedback">
                                                    Pilih Nilai Bobot!
                                                </div>
                                            
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
                                                <div class="invalid-feedback">
                                                    Pilih Nilai Bobot!
                                                </div>
                                            
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
        </div>
    </div>
</div>
</section>
</div>


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