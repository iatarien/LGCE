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
			<div class="col-sm-offset-1 col-sm-1 form-group">
				@if($user->service == "Comptabilité")
				<button style="cursor : pointer" onclick="print_engs()" class="btn btn-basic">
				<img style="max-width : 50%;" src="{{ url('img/print.png') }}">
				</button>
				@endif
			</div>
			<!-- <div class=" col-sm-2 form-group">
				<select class="form-control" onchange="filter(this.value,document.getElementById('op_input').value)">
					<option style="visibility: hidden;" value="">نوع الالتزام</option>
					<option value="decision,reevaluation">مقرر</option>
					<option value="eng"> إلتزام</option>
				</select>
			</div> -->
			<div class=" col-sm-2 form-group">
				<select class="form-control" onchange="filter_y(this.value)">
					<option style="visibility: hidden;" value="">السنة</option>
					@for($i=2019; $i< 2040; $i++)
					<option value="{{$i}}">{{$i}}</option>
					@endfor
				</select>
			</div>
			<div class="  col-sm-3 form-group">
				<input id="op_input" autocomplete="off" dir="rtl" placeholder="اختيار العملية" list="ops" class="form-control"  onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
                    <div id="myDropdown" class="dropdown-content" style="display: none;">
                      @foreach ($operations as $operation)
                      <span class="ops_clss" style="cursor: pointer;" onclick="filter('','{{ $operation->numero }}')">{{ $operation->numero  }}</span>
                      @endforeach
                    </div>
			</div>
			<div class="  col-sm-3 form-group">
				<input id="e_input" autocomplete="off" dir="rtl" placeholder="اختيار الشركة" list="ops" class="form-control"  onclick="e_like(this.value)" onkeyup="e_like(this.value)" > 
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
	const ze_type ="{{$type}}";
	if(ze_type =="all" || ze_type ==""){
		get_engs("{{$type}}");
	}else{
		filter('',"{{$type}}");
	}
	
	//document.getElementById('myModal').style.display = "none";
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

function filter(type="",value){
	if(value.includes('_')){
		value = value.replaceAll('_','/');
	}
	document.getElementById('filters-type').innerHTML = type;
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
	if(type ==""){
		type = "all";
	}
	var url = "/engs/"+type+"/"+query;
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
	if(type ==""){
		type = "all";
	}
	var url = "/engs/"+type+"/"+query;
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
	document.getElementById('filters-year').innerHTML = value;
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
	type ="";
	if(type ==""){
		type = "all";
	}
	var url = "/engs/"+type+"/"+query;
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


function get_engs(value){
	if(value==""){
		var url = "/engs/all/*1989**1989**1989**1989*{{$user->id}}*1989*";
	}else{
		var url = "/engs/";
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
function print_engs(){

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
	var url = "/print_engs/"+query;
	
	window.open(url, '_blank').focus();
}
function supprimer(link){
	var result = confirm("هل أنت متأكد من أنك تريد حذف هذا الالتزام ؟");
	if (result) {
		document.location.href = link;
	}
}

function numberWithCommas(x) {
	if(x == null){
		return "0.00";
	}
	x = parseFloat(x).toFixed(2);
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
		        '<td style="width : 2.5%;" ><div>#</div></td>'+
		        '<td style="width : 6%;"><div>رقم البطاقة</div></td>'+
		        '<td style=" width : 20.5%;"><div>رقم و تعيين العملية</div></td>'+
		        '<td style=" width : 14%;" id="intitule"><div> موضوع الالتزام </div></td>'+
                '<td style=" width : 13%;" id="intitule"><div>المقـــاول</div></td>'+
				'<td style=" width : 11%;" id="total"><div>القيـــمة</div></td>'+
				'<td style=" width : 9%;" id="total"><div>تاريخ التأشيرة</div></td>'+
				'<td style="width : 7%;"><div>معاينة</div></td>'+
		        '<td style="width : 7%;"><div>تعديل</div></td>'+
				'<td style="width : 7%; text-align : center;"><div>حذف</div></td>'+
		      '</tr>';
	const op = engagements;
	for (var i = 0; i < engagements.length; i++) {
		var style = '';
		if((user_service == "Comptabilité" || user_service =="Engagement" )&& op[i].date_visa != null){
			style = ';background-color : pink';
		}
		tds +=
		'<tr style="font-weight : bold'+style+'">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].numero_fiche+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span style="text-align : right" dir="rtl"><h5 style="text-decoration : underline"><strong>'+op[i].numero+'</strong></h5>'+
				'<h5><strong>'+op[i].intitule_ar+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].real_sujet+'</strong></h5></span>'+
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

			tds +='<td>'+
			'<span><a class="btn btn-default"  href="/fiche_eng/'+op[i].eng_id+'">معاينة</a></span>'+
		    '</td>';
	
			
		    if((user_id == op[i].user_id || user_service =="Engagement" ) && op[i].num_visa == null){
				tds +='<td>'+
		    	'<span><button class="btn btn-primary"  onclick="document.location.href=\'/modifier_engagement/'+op[i].eng_id+'\'">تعديل</button></span>'+
		        '</td>';
			}else{
				tds +='<td>'+
		    	'<span><button disabled class="btn btn-primary"  onclick="document.location.href=\'/'+type+'/'+op[i].eng_id+'\'">تعديل</button></span>'+
		        '</td>';
			}
			if((user_id == op[i].user_id || user_service =="Engagement" )  && op[i].num_visa == null){
				tds +='<td style="text-align : center;">'+
			'<span><button class="btn btn-danger"   onclick="supprimer(\'/delete_eng/'+op[i].eng_id+'\')">حذف</button></span>'+
			'</td>';
			}else{
				tds +='<td style="text-align : center;">'+
			'<span><button class="btn btn-danger" disabled >حذف</button></span>'+
			'</td>';
			}
		    

		tds+='</tr>';
	}
	document.getElementById('ops_place').innerHTML = tds;
	
}
</script>
@endsection