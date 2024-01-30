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
	<div class="col-lg-10 col-md-10 col-sm-10 portlets " lang="ar" dir="ltr" style="margin-right: 10%;"  >
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-left"><h4>
               Ajouter une Banque </h4>
            </div>
	        <div class="clearfix"></div>
	      </div>
         
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" action="/insert_banque" method="POST">
	            	@csrf
                
                <div class="form-group row">
                    <label class="control-label col-md-3" style="text-align : left; font-weight: bold;" for="title">  Nom de banque : </label>
	                <div class="col-md-9">
	                  <input dir="ltr" style="text-align : left"  required type="text" class="form-control" id="nom" name="nom">
	                </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="control-label col-md-3" style="text-align : left; font-weight: bold;" for="title">  Code : </label>
	                <div class="col-md-9">
	                  <input dir="ltr" style="text-align : left"  required type="text" class="form-control" id="abr" name="abr">
	                </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="control-label col-md-3" style="text-align : left; font-weight: bold;" for="title">Numéro : </label>
	                <div class="col-md-9">
	                  <input dir="ltr" style="text-align : left"  required type="text" class="form-control" id="nom" name="num">
	                </div>
                </div>
                <br>
                <div class="form-group">
                    <label class="control-label col-md-3" style="text-align : left; font-weight: bold;" for="title">  Clé : </label>
	                <div class="col-md-9">
	                  <input dir="ltr" style="text-align : left"  required type="text" class="form-control" id="cle" name="cle">
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
    document.getElementById('loading').style.display = "none";
  };
  
</script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



function op_like(value){
  document.getElementById("myDropdown").style.display ="block";
  var input, filter, ul, li, a, i;
  filter = value.toUpperCase();
  a = document.getElementsByClassName("ops_clss");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

function ops_changed(value){
  document.getElementById("myDropdown").style.display ="none";

  var id = value.split("1989raouf1989")[0];

  var numero =  value.split('1989raouf1989')[1];
  var intitule_ar =  value.split('1989raouf1989')[2];
  document.getElementById("op_input").value = numero;
  document.getElementById('id_op').value = id;
  document.getElementById('intitule_ar').value = intitule_ar;
}
</script>
@endsection

