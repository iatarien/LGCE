@extends('layouts.master')
@section('style')
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
@endsection
@section('content')

<div id="main" class="row main">
	<div class="col-lg-12">
		<div class="row">
			<div class=" col-lg-offset-3 col-lg-3 form-group">
				<input  id="op_input" autocomplete="off" list="ops" dir="rtl" placeholder="إختيـــــار العملية" class="form-control"  onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
                <div id="myDropdown"  class="dropdown-content" style="display: none;">
                      @foreach ($operations as $operation)
                      <span class="ops_clss" style="cursor: pointer;" onclick="filter('{{ $operation->numero }}')">{{ $operation->numero  }}</span>
                      @endforeach
                    </div>
				
			</div>
			<div class="  col-sm-3 form-group">
				<input id="e_input" autocomplete="off" dir="rtl" placeholder="اختيار المقاول" list="ops" class="form-control"  onclick="e_like(this.value)" onkeyup="e_like(this.value)" > 
                    <div id="myDropdown1" class="dropdown-content" style="display: none;">
                      @foreach ($es as $e)
                      <span class="es_clss" style="cursor: pointer; text-align : right;" onclick="filter_e('','{{ $e->id }}1989raouf1989{{ $e->name }}')">{{ $e->name  }}</span>
                      @endforeach
                    </div>
			</div>		

		</div>
	</div>

	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table;" lang="ar" dir="rtl">
			<div class="panel-heading">الالتزامات</div>
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
<div style="display: none;" id="filters-user_id">{{$user->id}}</div>
<div style="display: none;" id="filters-e"></div>
<div style="display: none;" id="filters-year"></div>
<div style="display: none;" id="filters-type"></div>

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

function filter_e(type="",value){
	const values = value.split("1989raouf1989");
	const name = values[1];
	value = values[0];
	console.log("value ",value);
    document.getElementById("myDropdown1").style.display ="none";
	document.getElementById('e_input').value = name;
	document.getElementById("filters-e").innerHTML = value;

    //document.getElementById("op_input").value = value.split("raouf1989")[1];
	var all_engs = "{{$type}}";
	
	if(all_engs == ""){
		var filters = ['numero','e','year','type','user_id'];
	}else{
		var filters = ['numero','e','year','type','user_id'];
	}
	
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	var real_type= "{{ $type }}";
	if(real_type=="retrait"){
		var type = "all";
	}else if(real_type == "ajouter_pay"){
		var type = "ajouter_pay";
	}else{
		var type = "eng";
	}
	
	var url = "/engs/"+type+"/"+query.replaceAll('/','__');;
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


function filter(value){
    document.getElementById("myDropdown").style.display ="none";
	document.getElementById('op_input').value = value;
	document.getElementById("filters-numero").innerHTML = value;
    //document.getElementById("op_input").value = value.split("raouf1989")[1];

	var filters = ['numero','e','year','type','user_id'];
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	var real_type= "{{ $type }}";
	if(real_type=="retrait"){
		var type = "all";
	}else if(real_type == "ajouter_eng_compta"){
		var type = "juridique,mixte";
	}else if(real_type == "ajouter_pay"){
		var type = "ajouter_pay";
	}else{
		var type = "eng";
	}
	
	query = query.replaceAll('/','__');
	var url = "/engs/"+type+"/"+query;
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
function get_engs(){
	var real_type= "{{ $type }}";
	if(real_type=="retrait"){
		var type = "all";
	}else if(real_type == "ajouter_eng_compta"){
		var type = "juridique,mixte";
	}else if(real_type == "ajouter_pay"){
		var type = "ajouter_pay";
	}
	else{
		var type = "eng";
	}
	
	var url = "/engs/"+type+"/*1989**1989**1989**1989*{{$user->id}}*1989*";
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



function numberWithCommas(x) {
	if(x == null){
		return "0.00";
	}
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(!x.includes('.')){
      x += ".00";
    }
    return x;
}
function display(engagements,value){
    var user_id = {{ $user->id }};
    var type= "{{ $type }}";
	var tds = '<tr style="  font-weight : bolder;">'+
		        '<td style="width : 2%;" ><div>#</div></td>'+
		        '<td style="width : 8%;"><div>رقم البطاقة</div></td>'+
		        '<td style=" width : 20%;"><div>رقم العملية</div></td>'+
		        '<td style=" width : 18%;" id="intitule"><div> موضوع الالتزام </div></td>'+
                '<td style=" width : 18%;" id="intitule"><div>المقـــاول</div></td>'+
				'<td style=" width : 10%;" id="total"><div>القيـــمة</div></td>'+
				'<td style=" width : 10%;" id="total"><div>تاريخ التأشيرة</div></td>'+
		        '<td style="width : 10%;"><div>اختيار</div></td>'+
		      '</tr>';
	const op = engagements;
	for (var i = 0; i < engagements.length; i++) {
		tds +=
		'<tr style="font-weight : bold">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].numero_fiche+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span style="text-align : right" dir="ltr">'+
				'<h5 style="text-decoration : underline"><strong>'+op[i].numero+'</strong></h5>'+
				'<h5><strong>'+op[i].intitule_ar+'</strong></h5>'+
				'</span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].real_sujet+'</strong></h5></span>'+
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
			
		    tds +='<td dir="ltr" style="text-align : right">'+
		        '<span><h5><strong>'+numberWithCommas(op[i].montant)+'</strong></h5></span>'+
		    '</td>';
			if(op[i].date_visa != null){
				tds +='<td>'+
		        '<span><h5><strong>'+op[i].date_visa+'</strong></h5></span>'+
				'</td>';
			}else{
				tds +='<td>'+
		        '<span><h5><strong>/</strong></h5></span>'+
		    '</td>';
			}
			if(type == "retrait"){
				tds +='<td>'+
		    	'<span><button class="btn btn-success"  onclick="document.location.href=\'/ajouter_engagement/'+op[i].type+'/'+op[i].eng_id+'1989raouf1989'+op[i].id_op+'\'">اختيار</button></span>'+
		        '</td>';
			}else if(type == "ajouter_pay"){
				tds +='<td>'+
		    	'<span><button class="btn btn-success"  onclick="document.location.href=\'/'+type+'/'+op[i].eng_id+'/{{$n}}\'">اختيار</button></span>'+
		        '</td>';
			}else{
				tds +='<td>'+
		    	'<span><button class="btn btn-success"  onclick="document.location.href=\'/'+type+'/'+op[i].eng_id+'\'">اختيار</button></span>'+
		        '</td>';
			}
		    

		tds+='</tr>';
	}
	document.getElementById('ops_place').innerHTML = tds;
}
</script>
@endsection