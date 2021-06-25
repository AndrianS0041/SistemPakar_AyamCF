@extends('layouts.app')

@section('content')

<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Gejala</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('db.admin') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('gejala') }}">Gejala</a></div>
                <div class="breadcrumb-item">Edit Data</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Form Edit Data Gejala</h2>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="section-header-button">
                                <a href="{{ route('gejala') }}"><button type="button" class="btn btn-primary"><i class="far fa-hand-point-left"></i> Kembali</button></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="/admin/gejala/update/{{ $gejala->id }}">
 
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kode Gejala</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="generate" class="form-control" value="{{ $gejala->kode_gejala }}" disabled>
                                        <input type="hidden" name="kode_gejala" class="form-control" value="{{ $gejala->kode_gejala }}">
            
                                        @if($errors->has('kode_gejala'))
                                            <div class="text-danger">
                                                {{ $errors->first('kode_gejala')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                                        <div class="col-sm-12 col-md-7">
                                            <select class="form-control" name="kategori" id="">
                                                <option value="{{ $gejala->kategori }}">{{ $gejala->kategori }}</option>
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
                                </div>
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Gejala</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="nama_gejala" class="form-control" value="{{ $gejala->nama_gejala }}">
                                
                                        @if($errors->has('id'))
                                            <div class="text-danger">
                                                {{ $errors->first('id')}}
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