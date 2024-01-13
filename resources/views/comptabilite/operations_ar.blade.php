@extends('comptabilite.master_compta')
@section('style')
<style>
table {
	table-layout: fixed;
    text-align : right;

}
#demo-table {
		width: 100%;
}
table td {
	width: 100px;
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

<div class="row" >
	<div class="col-lg-12" dir="rtl" style="text-align : right;">
		<div class="row">
		<div class=" col-lg-offset-3 col-lg-3 form-group">
				<input id="op_input" autocomplete="off" dir="rtl" placeholder="اختيار العملية" list="ops" class="form-control"  onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
                    <div id="myDropdown" class="dropdown-content" style="display: none;">
                      @foreach ($operations as $operation)
                      <span class="ops_clss" style="cursor: pointer;" onclick="filter('numero','{{ $operation->numero }}')">{{ $operation->numero  }}</span>
                      @endforeach
                    </div>
			</div>
			<div class="  col-lg-3 form-group">
				<select class="form-control" onchange="document.location.href='../operations_ar/'+this.value;">	
					@if($secteur == "ens_sup")
					<option selected="" style="visibility: hidden;">Enseignement Superieur</option>
					@else
					<option selected="" style="visibility: hidden;">{{ucfirst($secteur)}}</option>
					@endif
					
					<option value="education" >التعلبم</option>
					<option value="ens_sup"> التعلبم العالي</option>
					<option value="dgsn">الأمن </option>
					<option value="sante">الصحة</option>
					<option value="finances">المالية</option>
					<option value="justice">العدل</option>
				</select>
			</div>
			<div class=" col-lg-3 form-group">
				<select onchange="filter('chapitre',this.value);" class="form-control">
					<option value="" selected="" style="visibility: hidden;">الباب</option>
					@foreach($chapitres as $chapitre)
					<option value="{{ $chapitre }}">{{ $chapitre }}</option>
					@endforeach
					
				</select>
			</div>
		</div>
	</div>
	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table;" >
			<div class="panel-heading" style="text-align : right;">العمليات</div>
				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody id="ops_place">
				      
				    </tbody>
				  </table>
		</section>
		<!--Project Activity end-->
	</div>
</div>
<div style="display: none;" id="filters-source"></div>
<div style="display: none;" id="filters-chapitre"></div>
<div style="display: none;" id="filters-commune"></div>
<div style="display: none;" id="filters-numero"></div>
<div style="display: none;" id="order"></div>
<div id="myModal" class="modal" style="display: block;">

  <!-- The Close Button -->

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01" src="{{ url('img/loading.gif') }}">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
@endsection

@section('js_scripts')
<script type="text/javascript">
window.onload = function(){
	get_ops("{{ $secteur }}","0");
	document.getElementById('myModal').style.display = "none";
};
document.onclick= function(event) {
	if(event.srcElement.id != "op_input"){
		document.getElementById('myDropdown').style.display = "none";
	}
	
};
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
function filter(id,value,order=""){
	document.getElementById("myDropdown").style.display ="none";
	if(id !=""){
		document.getElementById("filters-"+id).innerHTML = value;
	}
	if(order ==""){
		order = "0";
	}
	const filters = ['chapitre','source','commune','numero'];
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	query += document.getElementById('order').innerHTML;
	var secteur = "{{  $secteur }}";
	var url = "/ops/"+secteur+"/"+query;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     display(response,value,order);
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function get_ops(value,order){
	var url = "/ops/"+value;
	console.log(value);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     display(response,value,order);
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}

function load_ops(value){
	var order = document.getElementById('order');
	if(order.innerHTML == value + " ASC"){
		order.innerHTML = value + " DESC";
	}else{
		order.innerHTML = value +" ASC";
	}
	filter("","",value);
}
function display(operations,value,order){

	var tds = '<tr style=" cursor : pointer; font-weight : bolder;">'+
                '<td style="width : 10%;" ><div>تعديل</div></td>'+
                '<td style="cursor : pointer; width : 30%; text-align : left;" id="intitule" onclick="load_ops(\'intitule\')" ><div>Intitulé</div></td>'+

		        '<td style="cursor : pointer; width : 30%" id="intitule_ar" onclick="load_ops(\'intitule_ar\')" ><div> تعيين العملية </div></td>'+
                '<td style="cursor : pointer; width : 20%;" id="numero" onclick="load_ops(\'numero\')" ><div>رقم العملية</div></td>'+
                '<td style="width : 13%;" id="chapitre" onclick="load_ops(\'chapitre\')" ><div>الباب</div></td>'+

		        
		        '<td id="0" style="width : 8%;" onclick="load_ops(\'0\')" ><div>#</div></td>'+
		        
		      '</tr>';
	const op = operations;
	for (var i = 0; i < operations.length; i++) {
		tds +=
		'<tr style="font-weight : bold">'+
            '<td>'+
		    	'<span><button class="btn btn-primary"  onclick="document.location.href=\'/modifier_operation_ar/'+op[i].id+'\'">تعديل</button></span>'+
		    '</td>'+
            '<td style="text-align : left;">'+
		        '<span><h5><strong>'+op[i].intitule+'</strong></h5></span>'+
		    '</td>'+
            '<td dir="rtl">'+
		        '<span><h5><strong>'+op[i].intitule_ar+'</strong></h5></span>'+
		    '</td>'+
            '<td>'+
		        '<span><h5><strong>'+op[i].numero+'</strong></h5></span>'+
		    '</td>'+
            '<td>'+
		        '<span><h5><strong>'+op[i].chapitre+'</strong></h5></span>'+
		    '</td>'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
		'</tr>';
	}
	document.getElementById('ops_place').innerHTML = tds;
	console.log(order)
	document.getElementById(order).classList.add('active');
}
</script>
@endsection