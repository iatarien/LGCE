@extends('layouts.master')

@section('content')

<div id="main" class="row main">
	<div class="col-lg-12">
		<div class="row">
		<div class="col-lg-3"></div>	
		<div class="col-lg-3 form-group">
				<input  id="op_input" autocomplete="off" list="ops" dir="ltr" class="form-control" placeholder=" Opération"  onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
                <div id="myDropdown"  class="dropdown-content" style="display: none;">
                      @foreach ($operations as $operation)
                      <span class="ops_clss" style="cursor: pointer;" onclick="filter('{{ $operation->numero }}')">{{ $operation->numero  }}</span>
                      @endforeach
                    </div>
				
			</div>
		<div class="col-sm-3 form-group">
				<input id="e_input" autocomplete="off" dir="ltr" placeholder=" Entreprise" list="ops" class="form-control"  onclick="e_like(this.value)" onkeyup="e_like(this.value)" > 
                    <div id="myDropdown1" class="dropdown-content" style="display: none;">
                      @foreach ($es as $e)
                      <span class="es_clss" style="cursor: pointer; text-align : left;" onclick="filter_e('','{{ $e->id }}1989raouf1989{{ $e->name }}')">{{ $e->name  }}</span>
                      @endforeach
                    </div>
			</div>	
			
			

		</div>
	</div>

	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table;" lang="ar" dir="ltr">
			<div class="panel-heading">Engagements</div>
				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody id="ops_place">
				      
				    </tbody>
				  </table>
		</section>
		<!--Project Activity end-->
	</div>
</div>
<div style="display: none;" id="filters-numero"></div>
<div style="display: none;" id="filters-chapitre"></div>
<div style="display: none;" id="filters-secteur"></div>
<div style="display: none;" id="filters-e"></div>
<div style="display: none;" id="filters-year"></div>

@endsection

@section('js_scripts')
<script type="text/javascript">
window.onload = function(){
	get_engs();

};
document.onclick= function(event) {
	if(event.srcElement.id != "op_input"){
		document.getElementById('myDropdown').style.display = "none";
	}
	if(event.srcElement.id != "e_input"){
		document.getElementById('myDropdown1').style.display = "none";
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
function e_like(value){
  document.getElementById("myDropdown1").style.display ="block";
  var input, filter, ul, li, a, i;
  filter = value.toUpperCase();
  a = document.getElementsByClassName("es_clss");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}

function filter(value){
    document.getElementById("myDropdown").style.display ="none";
	document.getElementById('op_input').value = value;
	document.getElementById("filters-numero").innerHTML = value;
	document.getElementById("filters-e").innerHTML = document.getElementById('e_input').value;
    //document.getElementById("op_input").value = value.split("raouf1989")[1];

	const filters = ['numero','e','year'];
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	var type = "eng";
	if(type ==""){
		type = "all";
	}
	query = query.replaceAll('/','__');
	var url = "/engs_vise/"+type+"/"+query;
	console.log(url);
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

function filter_e(type="",value){
	const values = value.split("1989raouf1989");
	const name = values[1];
	value = values[0];
	document.getElementById("filters-numero").innerHTML = document.getElementById('op_input').value;
	console.log("value ",value);
    document.getElementById("myDropdown1").style.display ="none";
	document.getElementById('e_input').value = name;
	document.getElementById("filters-e").innerHTML = value;

    //document.getElementById("op_input").value = value.split("raouf1989")[1];
	var all_engs = "{{$type}}";
	
	const filters = ['numero','e','year'];
	
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	
	var type = "eng";

	
	var url = "/engs_vise/"+type+"/"+query;
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
function get_engs(){
	var real_type= "{{ $type }}";
	var type = "eng";
	
	var url = "/engs_vise/"+type;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     display(response,type);
		 document.getElementById('loading').style.display = "none";
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}


function display(engagements,value){
    var user_id = {{ $user->id }};
    var type= "{{ $type }}";
	var tds = '<tr style="  font-weight : bolder;">'+
		        '<td style="width : 2%;" ><div>#</div></td>'+
				'<td style=" width : 30%;"><div> N° Opération</div></td>'+
		        '<td style="width : 8%;"><div> Marché </div></td>'+
		        '<td style=" width : 25%;" id="intitule"><div> Lot  </div></td>'+
                '<td style=" width : 25%;" id="intitule"><div>Entreprise</div></td>'+
		        '<td style="width : 10%;"><div>Selectionner</div></td>'+
		      '</tr>';
	const op = engagements;
	var  j = 0;
	for (var i = 0; i < engagements.length; i++) {

		tds +=
		'<tr style="font-weight : bold">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
			'<td>'+
		        '<span><h5 style="text-decoration : underline"><strong>'+op[i].numero+'</strong></h5></span>'+
				'<span><h5><strong>'+op[i].intitule+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].deal_type+' N° '+op[i].deal_num+'</strong></h5></span>'+
		    '</td>'+

		    '<td>'+
		        '<span><h5><strong>'+op[i].lot+'</strong></h5></span>'+
		    '</td>';
			if(op[i].name !=null){
				tds+='<td>'+
		        	'<span><h5><strong>'+op[i].name+'</strong></h5></span>'+
		    	'</td>';
			}else{
				tds+='<td>'+
		        	'<span><h5><strong>/</strong></h5></span>'+
		    	'</td>';
			}
		    

			tds +='<td>'+
		    	'<span><button class="btn btn-success"  onclick="document.location.href=\'/ajouter_ods/'+op[i].eng_id+'\'">Selectionner</button></span>'+
		        '</td>';
		    

		tds+='</tr>';
		
	}
	document.getElementById('ops_place').innerHTML = tds;
}
</script>
@endsection