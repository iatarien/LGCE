@extends('layouts.master')
@section('style')
<style>
table {
	table-layout: auto;
	overflow-y : scroll;
}

.dropdown-content {
  display: block;
  position: absolute;
  background-color: white;
  width: 90%;
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

<div id="main" class="row main" dir="rtl">
	<div class="col-lg-12">
		<div class="row">
			<div class=" col-lg-3 form-group">
				<select class="form-control" onchange="document.location.href='/operations_ar/'+this.value;">	
					
					<option style="visibility : hidden" value="{{$porte}}"> 
					@if($porte =="all")
						محفظة البرنامج 
					@else
						{{$porte}}	
					@endif
					</option>
					@foreach($portefeuilles as $portefeuille)
					<option value="{{$portefeuille->code}}">{{$portefeuille->ministere}} ({{$portefeuille->code}})</option>
					@endforeach
				</select>
			</div>
			<div class=" col-lg-3 form-group">
				<select onchange="filter('programme',this.value);" class="form-control">
					<option style="visibility : hidden">البرنامج</option>
					@foreach($programmes as $programme)
					<option value="{{$programme->code}}">{{$programme->designation}} ({{$programme->code}})</option>
					@endforeach
				</select>
			</div>
			<div class=" col-lg-3 form-group">
				<select class="form-control" onchange="filter('source',this.value);">
					<option style="visibility : hidden"> النشاط</option>
					<option value="PSD">تفويض التسيير الغير ممركز (PSD)</option>
					<option value="PSC">تفويض التسيير القطاعي الممركز (PSC)</option>
					
				</select>
			</div>
			<div class="col-lg-3 form-group">
				<input autocomplete='off' id="op_input" dir="ltr" placeholder="N° Operation" list="ops" class="form-control"  onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
                    <div id="myDropdown" class="dropdown-content" style="display: none;">
                      @foreach ($ops as $operation)
                      <span class="ops_clss" style="cursor: pointer;" onclick="filter_op('{{ $operation->id }}1989raouf1989{{ $operation->numero }}')">{{ $operation->numero  }}</span>
                      @endforeach
                    </div>
			</div>
			


		</div>
	</div>
	<div >
	<br>
		<!--Project Activity start-->
		<section dir="rtl" class="panel panel-info" >
			<div class="panel-heading">العمليات المغلقة</div>
				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody id="ops_place">
				      
				    </tbody>
				  </table>
		</section>
		<!--Project Activity end-->
	</div>
</div>
<div style="display: none;" id="filters-programme"></div>
<div style="display: none;" id="filters-source"></div>

@endsection

@section('js_scripts')
<script type="text/javascript">
window.onload = function(){
	const portefeuille = "{{$porte}}";
	get_ops(portefeuille);
	//document.getElementById('loading').style.display = "none";
};

document.onclick= function(event) {
	if(event.srcElement.id != "op_input"){
		document.getElementById('myDropdown').style.display = "none";
	}
	
};
function filter_op(value){
    var values = value.split("1989raouf1989");
    value = values[0];
	var secteur = "{{  $porte }}";
	var url = "/sam_cumul_clotures/"+secteur+"/empty/"+value;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     display(response,value);
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
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
	const portefeuille = "{{$porte}}";
	if(id !=""){
		document.getElementById("filters-"+id).innerHTML = value;
	}
	if(order ==""){
		order = "0";
	}
	const filters = ['programme','source'];
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}

	var url = "/sam_cumul_clotures/"+portefeuille+"/"+query;
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
function get_ops(value){
	var url = "/sam_cumul_clotures/"+value;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     display(response,value);
		 document.getElementById('loading').style.display ="none";
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function numberWithCommas(x) {
	if(x == null){
		return "0.00";
	}
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    if(!x.includes('.')){
      x += ".00";
    }
    return x;
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
	const user_id = "{{$user->id}}";
	var tds = '<tr style=" cursor : pointer; font-weight : bolder;">'+
		        '<td style="cursor : pointer; width : 2%; id="0" onclick="load_ops(\'0\')" ><div>#</div></td>'+
		        '<td style="cursor : pointer; width : 14%;" id="source" onclick="load_ops(\'source\')" ><div>  رقم العملية و تعيين العملية </div></td>'+
				'<td style="cursor : pointer; width : 4%;" id="source" onclick="load_ops(\'source\')" ><div> النشاط </div></td>'+
		        '<td style="cursor : pointer; width : 10%;" id="pay_cumul" onclick="load_ops(\'pay_cumul\')" ><div>رخصة الإلتزام الحالي</div></td>'+
				'<td style="cursor : pointer; width : 10%;" id="eng_cumul" onclick="load_ops(\'eng_cumul\')" ><div> مجموع الإلتزامات</div></td>'+
		        '<td style="cursor : pointer; width : 10%;" id="pay_cumul" onclick="load_ops(\'pay_cumul\')" ><div>  مجموع الدفعات</div></td>'+
		        '<td style="cursor : pointer; width : 9.5%; text-align : right;" id="taux" onclick="load_ops(\'taux\')" ><div>  PEC</div></td>'+
				'<td style="cursor : pointer; width : 9.5%; text-align : right;" id="taux" onclick="load_ops(\'taux\')" ><div> Solde sur AE</div></td>'+
				'<td style="cursor : pointer;text-align : cente; width : 5%;"><div><i class="bi bi-pencil"></i></div></td>'+
				'<td style="cursor : pointer; text-align : cente; width : 5%;"><div><i class="bi bi-eye"></i></div></td>'+
		      '</tr>';
	const op = operations;
	console.log()
	for (var i = 0; i < operations.length - 3; i++) {
		tds +=
		'<tr style="font-weight : bold">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
			'<td><span><h5 style="text-decoration: underline;"><strong>'+op[i].numero+'</strong></h5>'+
			'<strong>'+op[i].intitule_ar+'</strong>'+
			'</span></td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].source+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5 style="text-align : right" dir="ltr"><strong>'+numberWithCommas(op[i].AP_act)+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 style="text-align : right" dir="ltr"><strong>'+numberWithCommas(op[i].somme_total_eng)+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 style="text-align : right" dir="ltr"><strong>'+numberWithCommas(op[i].somme_total_pay)+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5 style="text-align : right" dir="ltr"><strong>'+numberWithCommas(op[i].AP_act-op[i].somme_total_pay)+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 style="text-align : right" dir="ltr"><strong>'+numberWithCommas(op[i].AP_act-op[i].somme_total_eng)+'</strong></h5></span>'+
		    '</td>';
			if(user_id == op[i].user_id){
				tds+='<td>'+
		    	'<span><button  class="btn btn-primary"  onclick="document.location.href=\'/modifier_operation_ar/'+op[i].oper_id+'\'"><i class="bi bi-pencil"></i></button></span>'+
		    	'</td>';
			}else{
				tds+='<td>'+
		    	'<span><button  class="btn btn-primary" disabled  onclick="document.location.href=\'/modifier_operation_ar/'+op[i].oper_id+'\'"><i class="bi bi-pencil"></i></button></span>'+
		    	'</td>';
			}
			tds+='<td>'+
		    	'<span><button  class="btn btn-default"  onclick="document.location.href=\'/engagements/'+op[i].numero+'\'"><i class="bi bi-eye"></i></button></span>'+
		    	'</td>';

		tds+='</tr>';
	}
	tds += '<tr style="font-weight : bold; background-color : #acdef6;">'+
		    '<td><span><h5><strong> </strong></h5></span></td>'+
		    '<td colspan="2" style="text-align : center">'+
		        '<span><h5><strong>المجموع : </strong></h5></span>'+
		    '</td>'+
			// '<td>'+
		    //     '<span><h5 style="text-align : right" dir="ltr"><strong>'+numberWithCommas(operations[operations.length -7 ])+'</strong></h5></span>'+
		    // '</td>'+
		    // '<td>'+
		    //     '<span><h5 style="text-align : right" dir="ltr"><strong>'+numberWithCommas(operations[operations.length -6 ])+'</strong></h5></span>'+
		    // '</td>'+
			'<td>'+
		        '<span><h5 style="text-align : right" dir="ltr"><strong>'+numberWithCommas(operations[operations.length -3 ])+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5 style="text-align : right" dir="ltr"><strong>'+numberWithCommas(operations[operations.length -2 ])+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 style="text-align : right" dir="ltr"><strong>'+numberWithCommas(operations[operations.length -1 ])+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 style="text-align : right" dir="ltr"><strong>'+numberWithCommas(operations[operations.length -3 ] - operations[operations.length -1 ])+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 style="text-align : right" dir="ltr"><strong>'+numberWithCommas(operations[operations.length -3 ] - operations[operations.length -2 ])+'</strong></h5></span>'+
		    '</td>'+
			'<td colspan="2" style="text-align : center">'+
		        '<span><h5><strong></strong></h5></span>'+
		    '</td>'+
		'</tr>';
	document.getElementById('ops_place').innerHTML = tds;
}
</script>
@endsection