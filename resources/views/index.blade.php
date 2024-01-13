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
</style>
@endsection
@section('content')

<br><br>
<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="info-box red-bg" onclick="document.location.href='operations/education';">
      <img src="img/education.png" class="chap-img">
      <div class="count">Education</div>
      <div id="education_count" class="title">{{$education}} operations</div>
    </div>
    <!--/.info-box-->
  </div>
  <!--/.col-->

  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="info-box brown-bg" onclick="document.location.href='operations/ens_sup';">
      <img src="img/ens_sup.png" class="chap-img">
      <div class="count">Esneignement superieur</div>
      <div id="ens_sup_count" class="title">{{$ens_sup}} operations</div>
    </div>
    <!--/.info-box-->
  </div>
  <!--/.col-->

  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="info-box dark-bg" onclick="document.location.href='operations/justice';">
      <img src="img/justice.png" class="chap-img">
      <div class="count">Justice</div>
      <div id="justice_count" class="title">{{$justice}} operations</div>
    </div>
    <!--/.info-box-->
  </div>
  <!--/.col-->

</div>
<div class="row">
  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="info-box green-bg" onclick="document.location.href='operations/dgsn';">
      <img src="img/dgsn.png" class="chap-img">
      <div class="count">DGSN</div>
      <div id="dgsn_count" class="title">{{$dgsn}} operations</div>
    </div>
    <!--/.info-box-->
  </div>
  <!--/.col-->
  
  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="info-box blue-bg" onclick="document.location.href='operations/sante';">
      <img src="img/sante.png" class="chap-img">
      <div class="count">Santé</div>
      <div id="sane_count" class="title">{{$sante}} operations</div>
    </div>
    <!--/.info-box-->
  </div>
  <!--/.col-->
  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="info-box teal-bg" onclick="document.location.href='operations/finances';">
      <img src="img/finances.png" class="chap-img">
      <div class="count">Finances</div>
      <div id="finances_count" class="title">{{$finances}} operations</div>
    </div>
    <!--/.info-box-->
  </div>
  <!--/.col-->

</div>
<!--/.row-->

<div id="myModal" class="modal" style="display: block;">

  <!-- The Close Button -->

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01" src="img/loading.gif">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
@endsection

@section('js_scripts')
<script type="text/javascript">
window.onload = function(){
	document.getElementById('myModal').style.display = "none";
};

</script>
@endsection