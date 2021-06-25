@extends('layouts.app')

@section('content')

<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          {{-- <div class="card-stats">
            <div class="card-stats-title">
              <h6 class="nav-item font-weight-semibold d-none d-lg-block">
                <i class="mdi mdi-calendar-outline"></i> {{ date("d M Y") }} - <span id="jam"></span> : <span id="menit"></span> : <span id="detik"></span></h6>
            </div>
          </div> --}}
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-heartbeat"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total gejala</h4>
            </div>
            <div class="card-body">
                {{ $gejala }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-bug"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Penyakit</h4>
            </div>
            <div class="card-body">
              {{ $penyakit }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-columns"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Basis Pengetahuan</h4>
            </div>
            <div class="card-body">
              {{ $pengetahuan }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class="w3-content w3-section" style="max-width:100%">
              <img class="mySlides w3-animate-fading" src="{{ url('assets/img/ayam.jpg') }}" style="width:100%">
              <img class="mySlides w3-animate-fading" src="{{ url('assets/img/telur.jpg') }}" style="width:100%">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
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
      
@endsection