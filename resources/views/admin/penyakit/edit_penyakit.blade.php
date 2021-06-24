@extends('layouts.app')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Penyakit</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('db.admin') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('penyakit') }}">Penyakit</a></div>
                <div class="breadcrumb-item">Edit Data</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Form Edit Data Penyakit</h2>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="section-header-button">
                                <a href="{{ route('penyakit') }}"><button type="button" class="btn btn-primary"><i class="far fa-hand-point-left"></i> Kembali</button></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('penyakit.update',$penyakit->id) }}">
 
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kode Penyakit</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="generate" class="form-control" value="{{ $penyakit->kode_penyakit }}" disabled>
                                        <input type="hidden" name="kode_penyakit" class="form-control" value="{{ $penyakit->kode_penyakit }}">
            
                                        @if($errors->has('kode_penyakit'))
                                            <div class="text-danger">
                                                {{ $errors->first('kode_penyakit')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Penyakit*</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="nama_penyakit" class="form-control" value="{{ $penyakit->nama_penyakit }}">
                                    
                                        @if($errors->has('nama_penyakit'))
                                            <div class="text-danger">
                                                {{ $errors->first('nama_penyakit')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Detail*</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="detail" id="" cols="30" rows="10" class="form-control">{{ $penyakit->detail }}</textarea>
                                    
                                        @if($errors->has('detail'))
                                        <div class="text-danger">
                                            {{ $errors->first('detail')}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Saran*</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea name="saran" id="" cols="30" rows="10" class="form-control">{{ $penyakit->saran }}</textarea>
                                    
                                        @if($errors->has('saran'))
                                        <div class="text-danger">
                                            {{ $errors->first('saran')}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Gambar*</label>
                                    <div class="col-sm-12 col-md-7">
                                        <img class="rounded-circle profile-widget-picture" src="{{ $penyakit->gambar }}" >
                                        <input type="file" name="foto" class="form-control" placeholder="Upload foto profil">
                                        <br>
                                        <label>Format file foto yang diizinkan: jpg,jepg,png dan ukuran file maksimal 2MB</label>
                            
                                        @if($errors->has('foto'))
                                            <div class="text-danger">
                                            {{ $errors->first('foto')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-success float-right" type="submit" name="submit" id="insert" value="Submit"><i class="far fa-save"></i> Simpan</button>
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection