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
	<div class="col-lg-12">
		<div class="row">
			<div class=" col-lg-offset-3 col-lg-3 form-group">
				<input  id="op_input" autocomplete="off" list="ops" dir="rtl" placeholder="إختيـــــار العملية" class="form-control"  onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
                <div id="myDropdown"  class="dropdown-content" style="display: none;">
					@if($type =="eng")
                      @foreach ($operations as $operation)
                      <span class="ops_clss" style="cursor: pointer;" onclick="filter('{{ $operation->numero }}')">{{ $operation->numero  }}</span>
                      @endforeach
					@else
					  @foreach ($operations as $operation)
                      <span class="ops_clss" style="cursor: pointer;" onclick="filter2('{{ $operation->numero }}')">{{ $operation->numero  }}</span>
                      @endforeach
					@endif
                </div>

				
			</div>
			<div class="  col-sm-3 form-group">
				<input id="e_input" autocomplete="off" dir="rtl" placeholder="اختيار المقاول" list="ops" class="form-control"  onclick="e_like(this.value)" onkeyup="e_like(this.value)" > 
                    <div id="myDropdown1" class="dropdown-content" style="display: none;">
                    @if($type =="eng")  
					  @foreach ($es as $e)
                      <span class="es_clss" style="cursor: pointer; text-align : right;" onclick="filter_e('','{{ $e->id }}1989raouf1989{{ $e->name }}')">{{ $e->name  }}</span>
                      @endforeach
					@else
					  @foreach ($es as $e)
                      <span class="es_clss" style="cursor: pointer; text-align : right;" onclick="filter_e2('','{{ $e->id }}1989raouf1989{{ $e->name }}')">{{ $e->name  }}</span>
                      @endforeach
					@endif
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
<div style="display: none;" id="filters-user_id"></div>
<div style="display: none;" id="filters-e"></div>
<div style="display: none;" id="filters-year"></div>

@endsection

@section('js_scripts')
<script type="text/javascript">
window.onload = function(){
	const type= "{{$type}}";
	if(type=="eng"){
		get_engs();
	}else{
		get_pays();
	}
	//get_engs();
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
function filter_e2(type="",value){
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
		const filters = ['numero','e','year'];
	}else{
		const filters = ['numero','e','year'];
	}
	
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	var real_type= "{{ $type }}";

	var url = "/pays/"+query.replaceAll('/','__');;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     display2(response,value);
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
		const filters = ['numero','e','year'];
	}else{
		const filters = ['numero','e','year'];
	}
	
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	var real_type= "{{ $type }}";
	if(real_type=="borderau"){
		var type = "borderau";
	}else if(real_type == "ajouter_eng_compta"){
		var type = "juridique,mixte";
	}else{
		var type = "juridique,FSDRS,mixte";
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
function filter2(value){
    document.getElementById("myDropdown").style.display ="none";
	document.getElementById('op_input').value = value;
	document.getElementById("filters-numero").innerHTML = value;
    //document.getElementById("op_input").value = value.split("raouf1989")[1];

	const filters = ['numero','e','year'];
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	var real_type= "{{ $type }}";

	
	query = query.replaceAll('/','__');
	var url = "/pays_bord/"+query;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     //console.log(response);
	     display2(response,value);
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

	const filters = ['numero','e','year'];
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}
	var real_type= "borderau";
	const type = real_type;
	
	query = query.replaceAll('/','__');
	var url = "/engs/"+type+"/"+query;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     //console.log(response);
	     display(response,value);
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function get_pays(){
	var type= "borderau";

	
	var url = "/pays_bord/*1989**1989**1989**1989**1989*";
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     //console.log(response);
	     display2(response,type);
         document.getElementById('loading').style.display = "none";
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function get_engs(){
	var type= "borderau";

	
	var url = "/engs/"+type+"/*1989**1989**1989**1989**1989*";
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     //console.log(response);
	     display(response,type);
         document.getElementById('loading').style.display = "none";
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}


function subject(type,deal,deal_num,deal_date,annexe,sujet,real_sujet,e){
	if(real_sujet !=null){
		return real_sujet;
	}
	var txt = "";

	txt = "";
	
	if(type == 'juridique'){
		txt +=" الالتزام القانوني ";
	}else if(type == 'mixte'){
		txt +=" الالتزام القانوني و المحاسبي ";
	}else if(type=="FSDRS"){
		txt +=" الالتزام  ";
	}else if(type=="comptable"){
		txt +=" الالتزام المحاسبي ";
	}else{
		txt +=" تكفل بمقرر ";
	}
	
	

	if(annexe != null && annexe !=""){
		if(type == "juridique" || type == "FSDRS"){
			txt = txt+"  بالملحق "+" "+annexe+" ";
		}else{
			txt =txt+"في إطار الملحق "+" "+annexe+" ";
		}
	
	}


	if(deal !="مقرر"){
		if(type == "juridique" || type == "mixte"){
			txt =txt+"ل"+deal+" ";
		}else if(type == "FSDRS") {
			txt =txt+"ل"+deal+" ";
		}else {
			txt =txt+"في إطار ال"+deal+" ";
		}
	
	}
	if(deal_num != null){
		txt+= " رقم "+deal_num;
	}
	if(deal_date != null){
		txt+=" بتاريخ "+deal_date+" ";
	}
	if(e != "" && e != null){
	  txt +=" المقدمة من طرف "+" "+e+" ";
	}
	txt +="ل"+sujet;
	//console.log(txt);
	return txt;
}
function numberWithCommas(x) {
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(!x.includes('.')){
      x += ".00";
    }
    return x;
}
function display2(engagements,value){

	var tds = '<tr style="  font-weight : bolder;">'+
		        '<td style="width : 2%;" ><div>#</div></td>'+
		        '<td style=" width : 15%;"><div>رقم العملية</div></td>'+
		        '<td style=" width : 13%;" id="intitule"><div> الموضوع  </div></td>'+
                '<td style=" width : 12%;" id="intitule"><div>المقـــاول</div></td>'+
				'<td style="width : 10%;"><div> القيمة </div></td>'+
				'<td style="width : 10%;"><div> رقم الوضعية </div></td>'+
				'<td style="width : 8%;"><div> تاريخ الوضعية </div></td>'+
				'<td style="width : 5%;"><div>  رقم الحوالة </div></td>'+
				'<td style=" width : 8%;" id="intitule"><div>تـــــاريخ الدفع</div></td>';
				'<td style=" width : 8%;" id=""><div> إختيار</div></td>';
		      tds+='</tr>';
	const op = engagements;
	for (var i = 0; i < engagements.length; i++) {
		tds +=
		'<tr style="font-weight : bold">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
		    '<td>'+
		        '<span style="text-align : right" dir="ltr"><h5><strong>'+op[i].numero+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+subject2(op[i].deal_type,op[i].deal_num,op[i].deal_date,op[i].lot,op[i].name,op[i].travaux_type,op[i].travaux_num)+'</strong></h5></span>'+
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
		        '<span><h5><strong>'+op[i].travaux_type+" رقم "+op[i].travaux_num+'</strong></h5></span>'+
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
				tds +='<td>'+
		    	'<span><button class="btn btn-success"  onclick="document.location.href=\'/redirect_bord/'+op[i].p_id+'\'">اختيار</button></span>'+
		        '</td>';
		
		tds+='</tr>';
	}
	document.getElementById('ops_place').innerHTML = tds;
}
function subject2(deal,deal_num,deal_date,sujet,e,travaux_type,travaux_num){

	var txt = "تسوية"+" ";
	if(travaux_type != "فاتورة" && travaux_num != null){
		txt +=travaux_type+" رقم"+" "+travaux_num+" ";
	}

	if(travaux_type !="فاتورة" && deal != null){
		txt += "ل"+deal+" ";
	}else{
		txt += deal+" ";
	}
	if(deal_num != null){
		txt+= " رقم "+deal_num;
	}
	if(deal_date != null){
		txt+=" بتاريخ "+deal_date+" ";
	}

	if(e != "" && e != null){
		txt +=" المقدمة من طرف "+" "+e+" ";
	}
	txt +="ل"+sujet;

	return txt;
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
		        '<span style="text-align : right" dir="ltr"><h5><strong>'+op[i].numero+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span><h5><strong>'+subject(op[i].type,op[i].deal_type,op[i].deal_num,op[i].deal_date,op[i].annexe,op[i].sujet,op[i].real_sujet,op[i].name)+'</strong></h5></span>'+
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
			}else{
				tds +='<td>'+
		    	'<span><button class="btn btn-success"  onclick="document.location.href=\'/redirect_bord/'+op[i].eng_id+'\'">اختيار</button></span>'+
		        '</td>';
			}
		    
		tds+='</tr>';
	
	}
	document.getElementById('ops_place').innerHTML = tds;
}
</script>
@endsection