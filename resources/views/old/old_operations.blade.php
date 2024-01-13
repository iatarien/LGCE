@extends('layouts.master')
@section('style')
<style>

</style>
@endsection
@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="row">
			<div class=" col-lg-3 form-group">
				<select onchange="filter(this.value);" class="form-control">
					<option value="" selected="" style="visibility: hidden;">Chapitre</option>
					@foreach($chapitres as $chapitre)
					<option value="{{ $chapitre->chapitre }}">{{ $chapitre->chapitre }}</option>
					@endforeach
					
				</select>
			</div>
			<div class=" col-lg-3 form-group">
				<select class="form-control">
					<option value="" selected="" style="visibility: hidden;">Bureau d'etude</option>	
				</select>
			</div>
			<div class=" col-lg-3 form-group">
				<select class="form-control">
					<option selected="" style="visibility: hidden;">Fournisseur</option>
				</select>
			</div>
			<div class=" col-lg-3 form-group">
				<select class="form-control">
					<option selected="" style="visibility: hidden;">Secteur</option>
				</select>
			</div>


		</div>
	</div>
	<div class="col-lg-12">
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
<div style="display: none;" id="filters"></div>
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

function filter(value){
	
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
	document.getElementById('order').innerHTML = value;
	var url = "/get_operations/"+value;
	console.log(value);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     display(response,value);
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function display(operations,value,order){

	var tds = '<tr style="font-weight : bolder;">'+
		        '<td id="0" onclick="load_ops(\'0\')" ><div>#</div></td>'+
		        '<td id="chapitre" onclick="load_ops(\'chapitre\')" ><div>Chapitre</div></td>'+
		        '<td id="numero" onclick="load_ops(\'numero\')" ><div>Numéro</div></td>'+
		        '<td style="cursor : pointer;" id="intitule" onclick="load_ops(\'intitule\')" ><div>Intitulé</div></td>'+
		        '<td style="cursor : pointer;" id="source" onclick="load_ops(\'source\')" ><div>Source de financement</div></td>'+
		        '<td style="cursor : pointer;" id="AP_act" onclick="load_ops(\'AP_act\')" ><div>AP Actuel</div></td>'+
		        '<td style="cursor : pointer;" id="eng_cumul" onclick="load_ops(\'eng_cumul\')" ><div>Engagements</div></td>'+
		        '<td style="cursor : pointer;" id="pay_cumul" onclick="load_ops(\'pay_cumul\')" ><div>Payements</div></td>'+
		        '<td style="cursor : pointer;" id="taux" onclick="load_ops(\'taux\')" ><div>Taux Physiques des Travaux</div></td>'+
		        '<td style="cursor : pointer;" id="observations" onclick="load_ops(\'observations\')" ><div>Observations</div></td>'+
		      '</tr>';
	const op = operations;
	for (var i = 0; i < operations.length; i++) {
		tds +=
		'<tr style="cursor : pointer; font-weight : bold"  onclick="document.location.href=\'/operation/'+op[i].id+'\'">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].chapitre+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].numero+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].intitule+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].source+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].AP_act+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].eng_cumul+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].pay_cumul+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].taux*100+'%</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].observations+'</strong></h5></span>'+
		    '</td>'+

		'</tr>';
	}
	document.getElementById('ops_place').innerHTML = tds;
	console.log(order)
	document.getElementById(order).classList.add('active');
}
</script>
@endsection