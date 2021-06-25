@extends('layouts.app')

@section('content')

<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Diagnosa</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="{{ route('db.admin') }}">Dashboard</a></div>
              <div class="breadcrumb-item">Diagnosa</div>
            </div>
          </div>
          <div class="section-body">
            
            <div class="row mt-4">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <div class="alert alert-warning">
                      <h3>Perhatian!</h3>
                      <p>Silahkan memilih gejala sesuai dengan kondisi ayam anda, anda dapat memilih kepastian kondisi ayam dari pasti tidak sampai pasti ya, jika sudah tekan tombol proses () di bawah untuk melihat hasil.</p>
                    </div>
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
                      <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                          <div class='alert alert-info'>
                            <h5>Kategori Makanan</b></h5>
                          </div>
                          <table class="table table-bordered table-hover table-striped">
                              <thead>
                                <tr>
                                  <th>Kode Gejala</th>
                                  <th>Nama Gejala</th>
                                  <th>Pilih Kondisi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                          <div class='alert alert-info'>
                            <h5>Kategori Kotoran</b></h5>
                          </div>
                          <table class="table table-bordered table-hover table-striped">
                              <thead>
                                <tr>
                                  <th>Kode Gejala</th>
                                  <th>Nama Gejala</th>
                                  <th>Pilih Kondisi</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                          <div class='alert alert-info'>
                            <h5>Kategori Pernafasan</b></h5>
                          </div>
                          <table class="table table-bordered table-hover table-striped">
                            <thead>
                              <tr>
                                <th>Kode Gejala</th>
                                <th>Nama Gejala</th>
                                <th>Pilih Kondisi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                          <div class='alert alert-info'>
                            <h5>Kategori Telur</b></h5>
                          </div>
                          <table class="table table-bordered table-hover table-striped">
                            <thead>
                              <tr>
                                <th>Kode Gejala</th>
                                <th>Nama Gejala</th>
                                <th>Pilih Kondisi</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        
                    </div> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>



@endsection