@extends('comptabilite.master_compta')

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
  <div class=" col-lg-offset-2 col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="info-box green-bg" onclick="document.location.href='#';">
      <img src="img/eng.png" class="chap-img">
      <h2>الالتزامات </h2>
      <h3><div id="education_count" >{{$number_eng}}   : عدد الالتزامات </div></h3>
      <hr>
     
    </div>
    <!--/.info-box-->
  </div>
  <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
    <div class="info-box blue-bg" onclick="document.location.href='#';">
      <img src="img/finances.png" class="chap-img">
      <h2>الدفعات </h2>
      <h3><div id="education_count" >{{$number_pay}}   : عدد التسديدات </div></h3>
      <hr>
      
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