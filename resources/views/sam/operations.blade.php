@extends('layouts.master')
@section('style')
<style>
table {
	table-layout: fixed;

}
#demo-table {
		width: 465mm; 
		overflow-x : hidden;
}
table td {
	width: 10%;
}
table h5 {
	font-size : 12px;
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

<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class=" col-lg-3 form-group">
				<select class="form-control" onchange="document.location.href='../sam/'+this.value;">	
					@if($secteur == "ens_sup")
					<option selected="" style="visibility: hidden;">Enseignement Superieur</option>
					@else
					<option selected="" style="visibility: hidden;">{{ucfirst($secteur)}}</option>
					@endif
					
					<option value="education" >Education</option>
					<option value="ens_sup">Enseignement Superieur</option>
					<option value="dgsn">DGSN</option>
					<option value="sante">Sante</option>
					<option value="finances">Finances</option>
					<option value="justice">Justice</option>
				</select>
			</div>
			<div class=" col-lg-3 form-group">
				<select class="form-control" onchange="filter('source',this.value);">
					<option value="" selected="" style="visibility: hidden;">Source de financement</option>	
					@foreach($sources as $source)
					<option value="{{ $source }}">{{ $source }}</option>
					@endforeach
				</select>
			</div>
			<div class=" col-lg-3 form-group">
				<select onchange="filter('chapitre',this.value);" class="form-control">
					<option value="" selected="" style="visibility: hidden;">Chapitre</option>
					@foreach($chapitres as $chapitre)
					<option value="{{ $chapitre }}">{{ $chapitre }}</option>
					@endforeach
					
				</select>
			</div>
			<div class="col-lg-3 form-group">
				<input autocomplete='off' id="op_input" dir="ltr" placeholder="N° Operation" list="ops" class="form-control"  onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
                    <div id="myDropdown" class="dropdown-content" style="display: none;">
                      @foreach ($operations as $operation)
                      <span class="ops_clss" style="cursor: pointer;" onclick="filter_op('{{ $operation->id }}1989raouf1989{{ $operation->numero }}')">{{ $operation->numero  }}</span>
                      @endforeach
                    </div>
			</div>
			


		</div>
	</div>
	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table;">
			<div class="panel-heading">Operations</div>
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
<!--- <div style="display: none;" id="filters-commune"></div> !-->
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
function filter_op(value){
    var values = value.split("1989raouf1989");
    value = values[0];
	var secteur = "{{  $secteur }}";
	var url = "/sam_cumul/"+secteur+"/empty/"+value;
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

function filter(id,value,order=""){
	if(id !=""){
		document.getElementById("filters-"+id).innerHTML = value;
	}
	if(order ==""){
		order = "0";
	}
	const filters = ['chapitre','source'];
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	//query += document.getElementById('order').innerHTML;
	var secteur = "{{  $secteur }}";
	var url = "/sam_cumul/"+secteur+"/"+query;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     //console.log(response);
	     display(response,value,order);
		 filtering_operations();
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function get_ops(value,order){
	var url = "/sam_cumul/"+value;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     display(response,value,order);
		 document.getElementById('myModal').style.display = "none";
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function filtering_operations(){
	const secteur = "{{$secteur}}";
	var filters = ['chapitre','source'];
	
	
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}

	var url = "/ops/"+secteur+"/"+query;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     display_ops(response);
		 document.getElementById('myDropdown').style.display = "none";
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

function numberWithCommas(x) {
	
	if(x == null){
		return 0;
	}
	x = x.toString();
	xs = x.split(".");
    x0 =  xs[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");

    if(!x.includes('.')){
      	x = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")+".00";
    }else if(x.split(".")[1].length == 1){
        x = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ")+"0";
    }else if(x.split(".")[1].length >= 2){
		x1 = xs[1];
		x1 = x1[0] + x1[1];
		x = x0 +"."+x1;
	}
    return x;
}

function display(operations,value,order){
	user_service = "{{$user->service}}";
	user_chap = "{{$user->chapitre}}";
	var tds = '<tr style=" cursor : pointer; font-weight : bolder;">'+
		        '<td style="width : 2%;" id="0" onclick="load_ops(\'0\')" ><div>#</div></td>'+
		        '<td style="width : 7%;" id="chapitre" onclick="load_ops(\'chapitre\')" ><div>Chapitre</div></td>'+
		        '<td style="cursor : pointer; width : 12%;" id="numero" onclick="load_ops(\'numero\')" ><div>Numéro</div></td>'+
		        '<td style="cursor : pointer; width : 10%;" id="intitule" onclick="load_ops(\'intitule\')" ><div>Intitulé</div></td>'+
		        '<td style="cursor : pointer; width : 5%;" id="source" onclick="load_ops(\'source\')" ><div>Source</div></td>';
				//'<td style="cursor : pointer; width : 8%;" id="Ap_init" onclick="load_ops(\'Ap_init\')" ><div>AP initial</div></td>'+
				//'<td style="cursor : pointer; width : 8%;" id="AP_act" onclick="load_ops(\'AP_act\')" ><div>AP actuel</div></td>'+
				tds+='<td style="cursor : pointer; width : 9%;" id="eng_cumul" onclick="load_ops(\'AP_act\')" ><div> AP Actuelle</div></td>';
		        tds+='<td style="cursor : pointer; width : 9%;" id="eng_cumul" onclick="load_ops(\'eng_cumul\')" ><div> Total des Engagements</div></td>'+
		        '<td style="cursor : pointer; width : 9%;" id="pay_cumul" onclick="load_ops(\'pay_cumul\')" ><div>Total des Payements</div></td>';
				tds+='<td style="cursor : pointer; width : 8%;" id="eng_cumul" onclick="load_ops(\'eng_cumul\')" ><div>Engagements en 2022</div></td>'+
		        '<td style="cursor : pointer; width : 8%;" id="pay_cumul" onclick="load_ops(\'pay_cumul\')" ><div>Payements en 2022</div></td>';
				tds+='<td style="cursor : pointer; width : 8%;" id="eng_cumul" onclick="load_ops(\'eng_cumul\')" ><div>Engagements en 2023</div></td>'+
		        '<td style="cursor : pointer; width : 8%;" id="pay_cumul" onclick="load_ops(\'pay_cumul\')" ><div>Payements en 2023</div></td>';
				tds+='<td style="cursor : pointer; width : 9%; color : blue;" id="eng_cumul" onclick="load_ops(\'AP_act\')" ><div> Reste de l"AP </div></td>';
				tds+='<td style="cursor : pointer; width : 6%;" id="bilan" onclick="load_ops(\'eng_cumul\')" ><div>Bilan</div></td>'+
				'<td style="cursor : pointer; width : 6%;" id="Taux" onclick="load_ops(\'pay_cumul\')" ><div>Cons {{Date("Y") - 1}}</div></td>'+
				'<td style="cursor : pointer; width : 6%;" id="Taux" onclick="load_ops(\'pay_cumul\')" ><div>Modifier</div></td>'+
				'<td style="cursor : pointer; width : 6%;" id="Taux" onclick="load_ops(\'pay_cumul\')" ><div>Details</div></td>'+
				// '<td style="cursor : pointer; width : 13%;" id="observations" onclick="load_ops(\'pay_cumul\')" ><div>Observations</div></td>'+
				// '<td style="cursor : pointer; width : 6%;" id="observations" onclick="load_ops(\'pay_cumul\')" ><div>Modifier</div></td>'+
				
		      '</tr>';
	const op = operations;
	for (var i = 0; i < operations.length - 7; i++) {
		tds +=
		'<tr style="font-weight : bold">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].chapitre+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].numero+'</strong></h5></span>'+
		    '</td>'+
		    '<td dir="rtl" style="text-align : center">'+
		        '<span><h5><strong>'+op[i].intitule_ar+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].source+'</strong></h5></span>'+
		    '</td>';
			// '<td>'+
		    //     '<span><h5 dir="ltr"><strong>'+numberWithCommas(op[i].AP_init)+'</strong></h5></span>'+
		    // '</td>'+
			// '<td>'+
		    //     '<span><h5 dir="ltr"><strong>'+numberWithCommas(op[i].AP_act)+'</strong></h5></span>'+
		    // '</td>'+
			tds+='<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(op[i].AP_act)+'</strong></h5></span>'+
		    '</td>';
		    tds+='<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(op[i].somme_total_eng)+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(op[i].somme_total_pay)+'</strong></h5></span>'+
		    '</td>';
			tds+='<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(op[i].eng_2022)+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(op[i].pay_2022)+'</strong></h5></span>'+
		    '</td>';
			tds+='<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(op[i].eng_2023)+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(op[i].pay_2023)+'</strong></h5></span>'+
		    '</td>';
			if((op[i].AP_act - op[i].somme_total_eng) < 0 ){
				tds+='<td>'+
		        '<span style="color : red;"><h5><strong>'+numberWithCommas(op[i].AP_act - op[i].somme_total_eng)+'</strong></h5></span>'+
		    '</td>';
			}else{
				tds+='<td>'+
		        '<span style="color : blue;"><h5><strong>'+numberWithCommas(op[i].AP_act - op[i].somme_total_eng)+'</strong></h5></span>'+
		    '</td>';
			}
			
			// '<td>'+
		    //     '<span><h5><strong>'+op[i].taux*100+'%</strong></h5></span>'+
		    // '</td>'+
			// '<td>'+
		    //     '<span><h5><strong>'+op[i].observations+'</strong></h5></span>'+
		    // '</td>'+
			ze_class = "";
			if(op[i].source =="FSDRS"){
				ze_class = "disabled";
			}
			if(op[i].id_op == null){
				tds+='<td>'+
		    		'<span><a '+ze_class+' class="btn btn-success" target="_blank" href=\'/fiche_comptable/'+op[i].op_id+'\'">Bilan</a></span>'+
		    	'</td>';
			}else{
				tds+='<td>'+
		    		'<span><a '+ze_class+' class="btn btn-success" target="_blank" href=\'/fiche_comptable/'+op[i].id_op+'\'">Bilan</a></span>'+
		    	'</td>';
			}
			ze_class = "disabled";
			if(user_service =="Comptabilité" && user_chap.includes(op[i].chapitre) ){
				ze_class = "";
			}
			if(op[i].id_op == null){
				tds+='<td>'+
				'<span><button '+ze_class+' class="btn btn-warning"  onclick="document.location.href=\'/fiche_consom/'+op[i].op_id+'\'">Cons..</button></span>'+
			'</td>';
			}else{
				tds+='<td>'+
				'<span><button '+ze_class+'   class="btn btn-warning"  onclick="document.location.href=\'/fiche_consom/'+op[i].id_op+'\'">Cons..</button></span>'+
			'</td>';
			}
			if(op[i].id_op == null){
				tds+='<td>'+
				'<span><button '+ze_class+' class="btn btn-primary"  onclick="document.location.href=\'/modifier_operation_ar/'+op[i].op_id+'\'">Modifier</button></span>'+
			'</td>';
			}else{
				tds+='<td>'+
				'<span><button '+ze_class+'   class="btn btn-primary"  onclick="document.location.href=\'/modifier_operation_ar/'+op[i].id_op+'\'">Modifier</button></span>'+
			'</td>';
			}
			
			if(op[i].id_op == null){
				tds+='<td>'+
				'<span><button class="btn btn-default"  onclick="document.location.href=\'/op_detail/'+op[i].op_id+'\'">Details</button></span>'+
			'</td>';
			}else{
				tds+='<td>'+
				'<span><button   class="btn btn-default"  onclick="document.location.href=\'/op_detail/'+op[i].id_op+'\'">Details</button></span>'+
			'</td>';
			}
			
			
			
		tds+='</tr>';
	}
	tds += '<tr style="font-weight : bold; background-color : #acdef6;">'+
		    '<td><span><h5><strong> </strong></h5></span></td>'+
		    '<td colspan="4" style="text-align : center">'+
		        '<span><h5><strong>Total : </strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(operations[operations.length -7 ])+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(operations[operations.length -6 ])+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(operations[operations.length -5 ])+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(operations[operations.length -4 ])+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(operations[operations.length -3 ])+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(operations[operations.length -2 ])+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5 dir="ltr"><strong>'+numberWithCommas(operations[operations.length -1 ])+'</strong></h5></span>'+
		    '</td>'+
			'<td colspan="5" style="text-align : center">'+
		        '<span><h5><strong></strong></h5></span>'+
		    '</td>'+
		'</tr>';
	document.getElementById('ops_place').innerHTML = tds;
	//document.getElementById(order).classList.add('active');
}

function display_ops(operations){
	var tds = '';
	const op = operations;
	for (var i = 0; i < operations.length; i++) {
		tds +=
		'<span class="ops_clss" style="cursor: pointer;"'+ 
		'onclick="filter_op(\''+op[i].id+'1989raouf1989'+
		op[i].numero+'\')">'+op[i].numero+'</span>';
	}
	document.getElementById('myDropdown').innerHTML = tds;
	//document.getElementById(order).classList.add('active');
}
</script>
@endsection