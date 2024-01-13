@extends('layouts.master')

@section('style')
<style type="text/css">
  .chap-img {
    height: 100px;
    width: auto;
  }
  .info-box {
    text-align: center;
    cursor: pointer;
  }
  .info-box .count {
    font-size: 22px;
  }
  .title {
    visibility : hidden;
  }
  .card-title {
    text-align : right;
  }
 
</style>
@endsection
@section('content')

<br><br>

<main id="main" class="main">

<section class="section dashboard">
  <div class="row">

    <!-- Left side columns -->
    <div class="col-lg-12">
      <div class="row">

        <!-- Sales Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card sales-card">

            <div class="card-body">
              <h5 class="card-title">ألتزامات</h5>

              <div class="d-flex align-items-center" style="float : right">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-menu-button-wide"></i>
                </div>
                <div class="ps-3">
                  <h6>{{$engagements}}</h6>
                 
                </div>
              </div>
            </div>

          </div>
        </div><!-- End Sales Card -->

        <!-- Revenue Card -->
        <div class="col-xxl-4 col-md-4">
          <div class="card info-card revenue-card">



            <div class="card-body">
              <h5 class="card-title">دفعات </h5>

              <div class="d-flex align-items-center" style="float : right">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="ps-3">
                  <h6>{{$payments}}</h6>
                 

                </div>
              </div>
            </div>

          </div>
        </div><!-- End Revenue Card -->

        <!-- Customers Card -->
        <div class="col-xxl-4 col-md-4">

          <div class="card info-card customers-card">



            <div class="card-body">
              <h5 class="card-title">مقاولين</h5>

              <div class="d-flex align-items-center" style="float : right">
                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                  <i class="bi bi-people"></i>
                </div>
                <div class="ps-3">
                  <h6>{{$entreprises}}</h6>
                  
                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->

        
    </div><!-- End Left side columns -->
  </div>
</section>

</main><!-- End #main -->

@endsection

@section('js_scripts')

@endsection