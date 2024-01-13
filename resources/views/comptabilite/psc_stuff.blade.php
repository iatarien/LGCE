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
</style>
@endsection
@section('content')

<br><br>
<div class="row">
  <div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
    <div class="row info-box yellow-bg">
        <div class="col-md-4" style="text-align : left; color : black";>
            <img src="img/nc13.png" class="chap-img">
            <div class="count">N.C.13</div>
        </div>
        <div style="margin-top : 10%;" class="col-md-3 from-group">
            <?php $i=0; $months = ['Janvier','Fevrier',"Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"]; ?>
            <select id="month" class="form-control">
              <?php $m = $months[Date('m')-1]; ?>
              <option style="visibility : hidden;" value="{{$m}}">{{$m}}</option>
                @foreach ($months as $month)
                <?php $i = $i+1 ?>
                <option value="{{$month}}">{{$month}}</option>
                @endforeach
            </select>
        </div>
        <div style="margin-top : 10%;" class="col-md-3 from-group">
            <select id="nc_year" class="form-control">
              <option style="visibility : hidden;" value="{{Date('Y')}}">{{Date('Y')}}</option>
                <?php for($i =2021; $i <2100; $i = $i+1){ ?>
                <option value="{{$i}}">{{$i}}</option>
                <?php } ?>
            </select>
        </div>
        <div style="margin-top : 10%;" class="col-md-2 from-group">
            <button style="width : 80%" class="btn btn-primary" 
            onclick="document.location.href='nc13/'+document.getElementById('nc_year').value+'/'+document.getElementById('month').value" > معــاينة
            </button>
        </div>
    </div>
    <!--/.info-box-->
  </div>
  <!--/.col-->

  
  <!--/.col-->

</div>
<!--/.row-->

<div class="row">
  <div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
    <div class="row info-box green-bg">
        <div class="count" style="color : black">Consommation des CP</div>
        <div class="col-md-3" style="text-align : left; color : black";>
            <img src="img/consommation.png" class="chap-img">
            <div class="count" style="visibility : hidden">CP</div>
        </div>
        <div style="margin-top : 8%;" class="col-md-4 from-group">
          <input id="start" type ="date" class="form-control" />
        </div>
        <div style="margin-top : 8%;" class="col-md-4 from-group">
          <input id="end" type ="date" class="form-control" />
        </div>
        <div style="margin-top : 8%; padding : 0;" class="col-md-1 from-group">
            <button style="width : 100%" class="btn btn-primary" 
            onclick="document.location.href
            ='consommation/'+document.getElementById('start').value+'/'+document.getElementById('end').value"> 
            معــاينة
            </button>
        </div>
    </div>
    <!--/.info-box-->
  </div>
  <!--/.col-->

  
  <!--/.col-->

</div>
<!--/.row-->

<div class="row">
  <div class="col-md-offset-3 col-md-6 col-sm-12 col-xs-12">
    <div class="row info-box red-bg">
        <div class="count" style="color : black">Situation Financière PSC</div>
        <div class="col-md-4" style="text-align : left; color : black";>
            <img src="img/situation_psc.png" class="chap-img">
            <div class="count" style="visibility : hidden">CP</div>
        </div>
        <div style="margin-top : 8%;" class="col-md-4 from-group">
            <select id="ze_year" class="form-control">
              <option style="visibility : hidden;" value="{{Date('Y')}}">{{Date('Y')}}</option>
                <?php for($i =2021; $i <2100; $i = $i+1){ ?>
                <option value="{{$i}}">{{$i}}</option>
                <?php } ?>
            </select>
        </div>
        <div style="margin-top : 8%;" class="col-md-4 from-group">
            <button style="width : 80%" class="btn btn-primary" 
            onclick="document.location.href='situation_psc/'+document.getElementById('ze_year').value" > معــاينة
            </button>
        </div>
    </div>
    <!--/.info-box-->
  </div>
  <!--/.col-->

  
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