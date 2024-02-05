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
	<div class="col-lg-12">
		<div class="row">

			<div class=" col-sm-offset-4  col-lg-3 form-group">
				<input id="op_input" dir="ltr" placeholder=" Opération" list="ops" class="form-control"  onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
                    <div id="myDropdown" class="dropdown-content" style="display: none;">
                      @foreach ($operations as $operation)
                      <span class="ops_clss" style="cursor: pointer;" onclick="filter('','{{ $operation->numero }}')">{{ $operation->numero  }}</span>
                      @endforeach
                    </div>
			</div>
			<div class="  col-sm-3 form-group">
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
			<div class="panel-heading">Paiements</div>
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
<div style="display: none;" id="filters-year"></div>

@endsection

@section('js_scripts')
<script src="{{ url('js/sweetalert2.min.js') }}"></script>
<script type="text/javascript">
window.onload = function(){
	const ze_type ="{{$type}}";
	if(ze_type =="all" || ze_type ==""){
		get_pays("{{$type}}");
	}else{
		filter('',"{{$type}}");
	}
	//document.getElementById('loading').style.display = "none";
};
document.onclick= function(event) {
	if(event.srcElement.id != "op_input"){
		document.getElementById('myDropdown').style.display = "none";
	}
	if(event.srcElement.id != "e_input"){
		document.getElementById('myDropdown1').style.display = "none";
	}
	
};
function print_pays(){

	var all_engs = "{{$type}}";
	if(all_engs == ""){
		var filters = ['numero','e','year','type','user_id'];
	}else{
		var filters = ['numero','e','year','type',];
	}

	
	

	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	var url = "/print_pays/"+query.replaceAll('/','__');
	console.log(url);
	window.open(url, '_blank').focus();
}
function print_pays2(){

	var filters = ["user_id"];

	var all_engs = "{{$type}}";

	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	if(all_engs ==""){
		var url = "/print_pays2/"+query.replaceAll('/','__');
	}else {
		var url = "/print_pays2/";
	}

	console.log(url);
	window.open(url, '_blank').focus();
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
	console.log("value ",value);
	if(value.includes('_')){
		value = value.replaceAll('_','/');
	}
    document.getElementById("myDropdown").style.display ="none";
	document.getElementById('op_input').value = value;
	document.getElementById("filters-numero").innerHTML = value;
    //document.getElementById("op_input").value = value.split("raouf1989")[1];
	var all_engs = "{{$type}}";

	if(all_engs == ""){
		var filters = ['numero','e','year','type','user_id'];
	}else{
		var filters = ['numero','e','year','type',];
	}

	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}

	var url = "/pays/"+query.replaceAll('/','__');;
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
    //document.getElementById("op_input").value = value.split("raouf1989")[1];
	var all_engs = "{{$type}}";
	
	if(all_engs == ""){
		var filters = ['numero','e','year','type','user_id'];
	}else{
		var filters = ['numero','e','year','type',];
	}

	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	var url = "/pays/"+query.replaceAll('/','__');;
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
function filter_y(value){
	document.getElementById("filters-year").innerHTML = value;
    //document.getElementById("op_input").value = value.split("raouf1989")[1];
	var all_engs = "{{$type}}";

	if(all_engs == ""){
		var filters = ['numero','e','year','type','user_id'];
	}else{
		var filters = ['numero','e','year','type',];
	}

	
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}

	var url = "/pays/"+query.replaceAll('/','__');;
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
function penalite(id,id_pay){
	const url = "/delai/"+id;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
			console.log(response);
	     if(hasNumber(response)){
			document.location.href ="/penalite/"+id_pay;
		 }else{
			Swal.fire({
            title: response,
            icon: 'error',
            confirmButtonText : 'OK'
            });
		 }
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}


function hasNumber(myString) {
  return /\d/.test(myString);
}
function get_pays(value){
	if(value==""){
		var url = "/pays/*1989**1989**1989*{{$user->id}}*1989*";
	}else{
		var url = "/pays/";
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

function subject(deal,parent,deal_num,deal_date,sujet,e,travaux_type,travaux_num){

    var txt = "Paiement de "+" ";
    if(travaux_type != "فاتورة" && travaux_num != null){
        txt +=travaux_type+" N° "+" "+travaux_num+" ";
    }
    if(travaux_type !="facture" && deal != null){
        txt += "du "+deal+" ";
    }else{
        txt += deal+" ";
    }
    if(deal_num != null){
        txt+= " N° "+deal_num;
    }
    if(deal_date != null){
        txt+=" date "+deal_date+" ";
    }

    if(e != "" && e != null){
        txt +=" Réalisé par "+" "+e+" ";
    }
    txt +="pour "+sujet;

    return txt;
}
function numberWithCommas(x) {
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(!x.includes('.')){
      x += ".00";
    }
    return x;
}
function supprimer(link){
	var result = confirm("هل أنت متأكد من أنك تريد حذف هذا الدفع ؟");
	if (result) {
		document.location.href = link;
	}
}
function display(engagements,value){
    var user_id = {{ $user->id }};
	var user_service = "{{ $user->service }}";
	var tds = '<tr style="  font-weight : bolder;">'+
		        '<td style="width : 2.5%;" ><div>#</div></td>'+
		        '<td style=" width : 23.5%;"><div>N° d\'Opération </div></td>'+
		        '<td style=" width : 10%;" id="intitule"><div> Sujet  </div></td>'+
                '<td style=" width : 10%;" id="intitule"><div>Entreprise</div></td>'+
				'<td style="width : 10%;"><div> Montant </div></td>'+
				'<td style="width : 9%;"><div>  Situation </div></td>'+
				'<td style="width : 10%;"><div>  Date de la situation </div></td>'+
				'<td style="width : 5%;"><div>  N° de la situation </div></td>'+
				'<td style=" width : 10%;" id="intitule"><div> Date de Paiement</div></td>';
				tds+='<td style="width : 8%; text-align : center;"><div> Pénalité</div></td>';
				
		      tds+='</tr>';
	const op = engagements;
	for (var i = 0; i < engagements.length; i++) {
		var style = '';
		tds +=
		'<tr style="font-weight : bold '+style+'">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
		    '<td>'+
		        '<span style="text-align : left" dir="ltr">'+
				'<h5 style="text-decoration : underline"><strong>'+op[i].numero+'</strong></h5>'+
				'<h5><strong>'+op[i].intitule+'</strong></h5>'+
				'</span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+subject(op[i].deal_type,op[i].parent,op[i].deal_num,op[i].deal_date,op[i].lot,op[i].name,op[i].travaux_type,op[i].travaux_num)+'</strong></h5></span>'+
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
			tds +='<td>'+
		        '<span><h5><strong>'+numberWithCommas(op[i].to_pay)+'</strong></h5></span>'+
		    '</td>';
			if(op[i].travaux_num != null){
				tds +='<td>'+
		        '<span><h5><strong>'+op[i].travaux_type+" N° "+op[i].travaux_num+'</strong></h5></span>'+
		    '</td>';
			}else {
				tds +='<td>'+
		        '<span><h5><strong>'+op[i].travaux_type+'</strong></h5></span>'+
		    '</td>';
			}
			
			tds +='<td>'+
				'<span><h5><strong>'+op[i].date_pay+'</strong></h5></span>'+
		    '</td>';
			if(op[i].p_num_visa != null){
				tds +='<td>'+
		        '<span><h5><strong>'+op[i].p_num_visa+'</strong></h5></span>'+
				'</td>';
			}else{
				tds +='<td>'+
		        '<span><h5><strong>/</strong></h5></span>'+
		    '</td>';
			}
			if(op[i].visa != null){
				tds +='<td>'+
		        '<span><h5><strong>'+op[i].visa+'</strong></h5></span>'+
				'</td>';
			}else{
				tds +='<td>'+
		        '<span><h5><strong>/</strong></h5></span>'+
		    '</td>';
			}
			
			
			if(op[i].pay_user == user_id && op[i].visa == null ){
                tds +='<td style="text-align : center;">'+
				'<span><a class="btn btn-primary"   href="javascript:void(0)" onclick="penalite('+op[i].id_eng+','+op[i].p_id+')"> Pénalité</a></span>'+
				'</td>';	
			}

		tds+='</tr>';
	}
	document.getElementById('ops_place').innerHTML = tds;
}
</script>
@endsection