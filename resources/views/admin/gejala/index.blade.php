@extends('layouts.app')

@section('content')

<div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Gejala</h1>
            <div class="section-header-breadcrumb">
              <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
              <div class="breadcrumb-item"><a href="#">Gejala</a></div>
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
                  </div>
                  <div class="card-body">

                    <div class="clearfix mb-3"></div>

                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tr>
                          <th>Kode</th>
                          <th>Kategori</th>
                          <th>Nama</th>
                          <th>Aksi</th>
                        </tr>
                        <tr>

                        </tr>
                      </table>
                    </div>
                    <div class="float-center">
                      <nav>
                        <ul class="pagination">
                          <li class="page-item disabled">
                            <a class="page-link" href="#" aria-label="Previous">
                              <span aria-hidden="true">&laquo;</span>
                              <span class="sr-only">Previous</span>
                            </a>
                          </li>
                          <li class="page-item active">
                            <a class="page-link" href="#">1</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">3</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                              <span aria-hidden="true">&raquo;</span>
                              <span class="sr-only">Next</span>
                            </a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
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
            <label>Kode</label>
            <input type="text" name="kode" id="kode" class="form-control" />
            <br />
            <label>Nama Gejala</label>
            <input type="text" name="nama" id="nama" class="form-control"/>
            <br />
            <label>Kategori</label>
            <select name="kategori" id="kategori" class="form-control">
              <option value="Laki-laki">Makanan</option>  
              <option value="Perempuan">Kotoran</option>
            </select>
            <br />
            <button class="btn btn-success float-right" type="submit" name="submit" id="insert" value="Submit"><i class="far fa-save"></i> Submit</button>
            </form>
          </div>
          </div>
        </div>
        </div>

      <script>
        var myIndex = 0;
        carousel();

        function carousel() {
          var i;
          var x = document.getElementsByClassName("mySlides");
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
          }
          myIndex++;
          if (myIndex > x.length) {myIndex = 1}    
          x[myIndex-1].style.display = "block";  
          setTimeout(carousel, 3000);    
        }
      </script>

      <script>

        //Begin Tampil Detail Karyawan
        $(document).on('click', '.view_data', function(){
          var employee_id = $(this).attr("id");
          $.ajax({
          url:"select.php",
          method:"POST",
          data:{employee_id:employee_id},
          success:function(data){
            $('#detail_karyawan').html(data);
            $('#dataModal').modal('show');
          }
          });
        });
        //End Tampil Detail Karyawan
        
        //Begin Tampil Form Edit
          $(document).on('click', '.edit_data', function(){
          var employee_id = $(this).attr("id");
          $.ajax({
          url:"edit.php",
          method:"POST",
          data:{employee_id:employee_id},
          success:function(data){
            $('#form_edit').html(data);
            $('#editModal').modal('show');
          }
          });
        });
        //End Tampil Form Edit

        //Begin Aksi Delete Data
        $(document).on('click', '.hapus_data', function(){
          var employee_id = $(this).attr("id");
          $.ajax({
          url:"delete.php",
          method:"POST",
          data:{employee_id:employee_id},
          success:function(data){
          $('#employee_table').html(data);  
          }
          });
        });
        }); 
        //End Aksi Delete Data
        </script>
      
@endsection