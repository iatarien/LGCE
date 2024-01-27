@extends('layouts.master')
@section('style')
<style type="text/css">
#engagement {
    border-collapse: collapse;
    border : 1px solid;
    table-layout: fixed;
}
#engagement th {
    border : 1px solid;
    width: 23%;
    text-align: center;
    color: black;
}
#engagement th:last-child {
    width: 31%;
}
#engagement td {
    border : 1px solid;
    font-weight: bold;
    padding: 0 3px 0 3px;
    text-align: center;
}
.input_num {
  color: black;
}
#engagement td:nth-last-child(2) {
    text-align: right;
}
#engagement td:first-child {
  padding : 0;
}
#engagement td:nth-last-child(4) {
    padding : 0;
}
#engagement td:last-child {
    display: none;
}
.dropdown-content {
  display: block;
  position: absolute;
  background-color: white;
  width: 96%;
  padding: 12px 16px;
  border: 1px solid #c7c7cc;
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content span {
  color: black;
  padding: 6px 16px;
  text-decoration: none;
  display: block;
}
.dropdown-content span:hover {
  background-color: lightblue;
}

</style>
@endsection
@section('content')
<div id="main" class="row main">
	<div class="col-lg-10 col-xs-10 col-sm-10 portlets pull-left" lang="ar" dir="ltr" style="margin-right: 15%;"  >
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-left">
                 Réglages
            </div>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" action="/update_password" method="POST">
	            	@csrf

                <div class="form-group">
                <label class="control-label col-xs-2" style="text-align : left;; font-weight: bold;" for="title">   Utilisateur  : </label>
	                <div class="col-xs-10">
	                  <input dir="ltr" style="text-align : left;" readonly type="text" class="form-control" id="ods_num" value="{{$user->username}}" name="direction">
	                </div>
                    
	            </div>
                <div class="form-group">
                <label class="control-label col-xs-2" style="text-align : left;; font-weight: bold;" for="title">     Mot de passe  : </label>
	                <div class="col-xs-10">
	                  <input dir="ltr" style="text-align : left;" required type="text" class="form-control" id="ods_num" value="{{$pwd}}" name="password">
	                </div>
                    
	            </div>

              
            <br>
            <br>


	              <!-- Buttons -->
	              <div class="form-group" align="center">
	                <!-- Buttons -->
	                <div class="col-lg-offset-2 col-lg-9">
	                  <button type="submit" class="btn btn-primary">Sauvegarder</button>
	                </div>
	              </div>
	            </form>
	          </div>


	        </div>
	        <div class="widget-foot">
	          <!-- Footer goes here -->
	        </div>
	      </div>
	    </div>
	</div>
</div>

@endsection

@section('js_scripts')

<script type="text/javascript">
  window.onload = function(){
    document.getElementById('loading').style.display ="none";
  };
</script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


</script>
@endsection

