@extends('layouts.master')
@section('style')
<style>
table {
	table-layout: fixed;

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
  width: 280px;
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
table td h5 {
	font-size : 12px !important;
}
table tr  {
	font-size : 12px !important;
}
table td span a {
	font-size : 12px !important;
}
input {
  font-size: 13px !important;
}
.dropdown-content span:hover {
  background-color: lightblue;
}
.es_clss {
	font-size : 12px !important;
}
.ops_clss {
	font-size : 13px !important;
}
</style>
@endsection
@section('content')

<div id="main" class="main row">
	<div class="col-sm-12">
		<div class="row">
            <div class="  col-sm-3 form-group"></div>
			<div class="  col-sm-3 form-group">
				<input id="op_input" autocomplete="off" dir="ltr" placeholder="Opération" list="ops" class="form-control"  onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
                    <div id="myDropdown" class="dropdown-content" style="display: none;">
                      @foreach ($operations as $operation)
                      <span class="ops_clss" style="cursor: pointer;" onclick="filter('{{$type}}','{{ $operation->numero }}')">{{ $operation->numero  }}</span>
                      @endforeach
                    </div>
			</div>
			<div class="  col-sm-3 form-group">
				<input id="e_input" autocomplete="off" dir="ltr" placeholder="Entreprise" list="ops" class="form-control"  onclick="e_like(this.value)" onkeyup="e_like(this.value)" > 
                    <div id="myDropdown1" class="dropdown-content" style="display: none;">
                      @foreach ($es as $e)
                      <span class="es_clss" style="cursor: pointer; text-align : left;" onclick="filter_e('{{$type}}','{{ $e->id }}1989raouf1989{{ $e->name }}')">{{ $e->name  }}</span>
                      @endforeach
                    </div>
			</div>

		</div>
	</div>
    <br><br>
	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table;" lang="ar" dir="ltr">
			<div class="panel-heading">Marchés</div>
            <br>
				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody id="ops_place">
				      
				    </tbody>
				  </table>
		</section>
		<!--Project Activity end-->
	</div>
</div>
<div style="display: none;" id="filters-secteur"></div>
<div style="display: none;" id="filters-chapitre"></div>
<div style="display: none;" id="filters-numero"></div>
<div style="display: none;" id="filters-user_id">{{$user->id}}</div>
<div style="display: none;" id="filters-e"></div>
<div style="display: none;" id="filters-type"></div>
<div style="display: none;" id="filters-year"></div>
<div style="display: none;" id="filters-all">{{$type}}</div>

@endsection

@section('js_scripts')
<script type="text/javascript">
window.onload = function(){
	get_deals("{{$type}}");

	
	//document.getElementById('myModal').style.display = "none";
};
function get_deals(value){
	if(value=="avenant"){
		var url = "/get_deals/*1989**1989*{{$user->id}}*1989*avenant";
	}else if(value=="engagement"){
		var url = "/get_deals/*1989**1989*{{$user->id}}*1989*engagement";
	}else {
		var url = "/get_deals/";
	}
	
	console.log(value);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     display(response,value);
		 document.getElementById('loading').style.display = "none";
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
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

function filter(type="",value){

	document.getElementById('filters-type').innerHTML = type;
    document.getElementById("myDropdown").style.display ="none";
	document.getElementById('op_input').value = value;
	document.getElementById("filters-numero").innerHTML = value;

	
	var filters = ['numero','e','user_id'];

	
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	if(type ==""){
		type = "all";
	}
	var url = "/get_deals/"+query;
    if(type=="avenant"){
        url+="avenant";
    }
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     display(response,value);
		 document.getElementById('loading').style.display = "none";
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
	console.log("value ",value);
    document.getElementById("myDropdown1").style.display ="none";
	document.getElementById('e_input').value = name;
	document.getElementById("filters-e").innerHTML = value;


	var filters = ['numero','e','user_id'];

	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	if(type ==""){
		type = "all";
	}
	var url = "/get_deals/"+query;
    if(type=="avenant"){
        url+="avenant";
    }
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



function supprimer(link){
	var result = confirm("هل أنت متأكد من أنك تريد حذف هذه الصفقة ؟");
	if (result) {
		document.location.href = link;
	}
}

function numberWithCommas(x) {
	if(x== null){
		return "/";
	}
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    if(!x.includes('.')){
      x += ".00";
    }
    return x;
}

function display(engagements,value){
    var user_id = {{ $user->id }};
	var user_service = "{{ $user->service }}";
    var type= "{{ $type }}";
	var tds = '<tr style="  font-weight : bolder;">'+
		        '<td style="width : 2%;" ><div>#</div></td>'+
		        '<td style=" width : 22%;"><div>N° et intitulé de l\'opération</div></td>'+
				'<td style="width : 11%;"><div>Marché </div></td>'+
				'<td style=" width : 11.5%;" id="total"><div>Entreprise</div></td>'+
		        '<td style=" width : 8%;" id="intitule"><div> Date  </div></td>'+
                '<td style=" width : 10.5%;" id="intitule"><div>Lot</div></td>'+
				'<td style=" width : 12%;" id="total"><div>Montant</div></td>'+
				'<td style="width : 6%;"><div>Durée</div></td>'+
		       '<td style="width : 10%; text-align : center;"><div>Selectionner</div></td>'+
		      '</tr>';
	const op = engagements;
	for (var i = 0; i < engagements.length; i++) {
		var style = '';
		tds +=
		'<tr style="font-weight : bold'+style+'">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
		    '<td>'+
		        '<span style="text-align : left; text-decoration : underline" dir="ltr"><h5><strong>'+op[i].numero+'</strong></h5></span>'+
				'<span style="text-align : left" dir="ltr"><h5><strong>'+op[i].intitule+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].deal_type+' N° '+op[i].deal_num+'</strong></h5></span>'+
		    '</td>';
			if(op[i].name != null){
				tds +='<td>'+
		        '<span><h5><strong>'+op[i].name+'</strong></h5></span>'+
		    '</td>';
			}else{
				tds +='<td>'+
		        '<span><h5><strong>/</strong></h5></span>'+
		    '</td>';
			}
			if(op[i].deal_date != null){
				tds +='<td>'+
		        '<span><h5><strong>'+op[i].deal_date+'</strong></h5></span>'+
		    '</td>';
			}else{
				tds +='<td>'+
		        '<span><h5><strong>/</strong></h5></span>'+
		    '</td>';
			}
			
		    tds+= '<td>'+
		        '<span><h5><strong>'+op[i].lot+'</strong></h5></span>'+
		    '</td>';
			tds +='<td dir="ltr" style="text-align : left">'+
		        '<span><h5><strong>'+numberWithCommas(op[i].montant)+'</strong></h5></span>'+
		    '</td>';
			if(op[i].duree != null){
				tds +='<td>'+
		        '<span><h5><strong>'+op[i].duree+' jours</strong></h5></span>'+
		    '</td>';
			}else{
				tds +='<td>'+
		        '<span><h5><strong>/</strong></h5></span>'+
		    '</td>';
			}
			
		    if(type == "avenant"){
				if(op[i].user_id == user_id){
					tds +='<td>'+
					'<span><button class="btn btn-success"  onclick="document.location.href=\'/ajouter_avenant/'+op[i].deal_id+'\'">Selectionner</button></span>'+
					'</td>';
				}else{
					tds +='<td>'+
					'<span><button class="btn btn-success" disabled  onclick="document.location.href=\'/ajouter_avenant/'+op[i].deal_id+'\'">Selectionner</button></span>'+
					'</td>';
				}
				
			}else if(type == "engagement"){
				if(op[i].user_id == user_id){
					tds +='<td>'+
					'<span><button class="btn btn-success"  onclick="document.location.href=\'/ajouter_engagement/eng/'+op[i].deal_id+'\'">Selectionner</button></span>'+
					'</td>';
				}else{
					tds +='<td>'+
					'<span><button class="btn btn-success" disabled  onclick="document.location.href=\'/ajouter_engagement/eng/'+op[i].deal_id+'\'">Selectionner</button></span>'+
					'</td>';
				}
			}


		tds+='</tr>';
	}
	document.getElementById('ops_place').innerHTML = tds;
}
</script>
@endsection