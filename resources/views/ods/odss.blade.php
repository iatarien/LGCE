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

<div id="main" class="row main">
	<div class="col-lg-12">
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-3 form-group">
				<input  id="op_input2" autocomplete="off" list="ops" class="form-control"  onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
                <div id="myDropdown2"  class="dropdown-content" style="display: none;">
                      @foreach ($operations as $operation)
                      <span class="ops_clss" style="cursor: pointer;" onclick="filter('{{ $operation->numero }}')">{{ $operation->numero  }}</span>
                      @endforeach
                    </div>
				
			</div>
			<label  class="control-label col-lg-1" style="text-align : right; font-weight: bold; margin-top : 0.7%;" for="title">   العمــــلـــيـــــة </label>    
				
            <div class=" col-lg-3 form-group">
				<input  id="op_input1" autocomplete="off" list="ops" class="form-control"  onclick="e_like(this.value)" onkeyup="e_like(this.value)" > 
                <div id="myDropdown1"  class="dropdown-content" style="display: none;">
                      @foreach ($entreprises as $e)
                      <span class="es_clss" style="cursor: pointer;" onclick="filter_e('{{ $e->id }}')">{{ $e->name  }}</span>
                      @endforeach
                    </div>
				
			</div>
			<label  class="control-label col-lg-1" style="text-align : right; font-weight: bold; margin-top : 0.7%;" for="title">   الــشــركة </label>    
			
				

		</div>
	</div>

	<div >
		<!--Project Activity start-->
		<br>
		<section class="panel panel-info" style="display: table;" lang="ar" dir="rtl">
			<div class="panel-heading">الأوامر المصلحية</div><br>
				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody id="ops_place">
				      
				    </tbody>
				  </table>
		</section>
		<!--Project Activity end-->
	</div>
</div>
<div style="display: none;" id="filters-numero"></div>
<div style="display: none;" id="filters-entreprise"></div>


@endsection

@section('js_scripts')
<script type="text/javascript">
window.onload = function(){
	get_odss();
	//document.getElementById('loading').style.display = "none";
};
document.onclick= function(event) {
	if(event.srcElement.id != "op_input1"){
		document.getElementById('myDropdown1').style.display = "none";
	}
    if(event.srcElement.id != "op_input2"){
		document.getElementById('myDropdown2').style.display = "none";
	}
	
};
function op_like(value){
  document.getElementById("myDropdown2").style.display ="block";
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
function filter(value){
    document.getElementById("myDropdown2").style.display ="none";
	document.getElementById('op_input2').value = value;
	document.getElementById("filters-numero").innerHTML = value;
	document.getElementById("filters-entreprise").innerHTML = document.getElementById('op_input1').value;

	const filters = ['entreprise','numero'];
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}

	query = query.replaceAll('/','__');
	var url = "/get_odss/"+query;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     display(response);
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function filter_e(value){
    document.getElementById("myDropdown1").style.display ="none";
	// document.getElementById('op_input1').value = value;
	document.getElementById("filters-entreprise").innerHTML = value;
	document.getElementById("filters-numero").innerHTML = document.getElementById('op_input2').value;

	const filters = ['entreprise','numero'];
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"*1989*";
	}

	query = query.replaceAll('/','__');
	var url = "/get_odss/"+query;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     display(response);
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function get_odss(){

	
	var url = "/get_odss/";
	
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     display(response);
		 document.getElementById('loading').style.display = "none";
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function supprimer(link){
	var result = confirm("هل أنت متأكد من أنك تريد حذف هذا ODS ؟");
	if (result) {
		document.location.href = link;
	}
}

function display(engagements){
    var user_id = {{ $user->id }};
	var user_service = "{{ $user->service }}";
	var ville_fr = "{{ $ville_fr }}";
	var direction_fr = "{{ $direction_fr }}";
	direction_fr = direction_fr.replace('&#039;',"'");
    var type= "";
	var tds = '<tr style="  font-weight : bolder;">'+
		        '<td style="width : 2.5%;" ><div>#</div></td>'+
		        '<td style="width : 8%;"><div> رقم الأمر المصلحي </div></td>'+
                '<td style="width : 10%;"><div> نوع الأمر المصلحي </div></td>'+
				'<td style="width : 10%;"><div> رقم الصفقة / العقد  </div></td>'+
				'<td style="width : 10%;"><div>    التاريخ  </div></td>'+
		        '<td style=" width : 24%;"><div>رقم العملية</div></td>'+
		        '<td style=" width : 15%;" id="intitule"><div> الموضوع  </div></td>'+
                '<td style=" width : 15%;" id="intitule"><div>المقـــاول</div></td>'+
		        '<td style="width : 8%;"><div>معاينة</div></td>';
				if(user_service=="ODS" || (ville_fr =="Ouargla" && direction_fr =="Direction de l'Education Nationale")){
					tds+='<td style="width : 8%;"><div>تعديل</div></td>'+
                	'<td style="width : 8%;"><div>حذف</div></td>';
				}
                
                
		      tds+='</tr>';
	const op = engagements;
	for (var i = 0; i < engagements.length; i++) {
		tds +=
		'<tr style="font-weight : bold">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>';
            if(op[i].ods_num <10){
				tds+='<td>'+
		            '<span><h5><strong>0'+op[i].ods_num+'</strong></h5></span>'+
		        '</td>';
			}else{
				tds+='<td>'+
		            '<span><h5><strong>'+op[i].ods_num+'</strong></h5></span>'+
		        '</td>';
			}
		    
		    tds+='<td>'+
		        '<span ><h5><strong>'+op[i].type_ods+'</strong></h5></span>'+
		    '</td>'+
            '<td>'+
		        '<span ><h5><strong>'+op[i].deal_type+" رقم :"+op[i].deal_num+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5><strong>'+op[i].ods_date+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5><strong>'+op[i].numero+'</strong></h5></span>'+
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
		    tds +='<td style="text-align : center;">'+
			'<span><button class="btn btn-default"   onclick="document.location.href=\'/ods/'+op[i].o_id+'\'">معاينة</button></span>'+
			'</td>';
			if(user_id == op[i].user && ( user_service =="ODS" || (ville_fr =="Ouargla" && direction_fr =="Direction de l'Education Nationale")) ){
				tds +='<td style="text-align : center;">'+
				'<span><button class="btn btn-primary"   onclick="document.location.href=\'/modifier_ods/'+op[i].o_id+'\'">تعديل</button></span>'+
				'</td>';
				tds +='<td style="text-align : center;">'+
				'<span><button class="btn btn-danger"   onclick="supprimer(\'/delete_ods/'+op[i].o_id+'\')">خذف</button></span>'+
				'</td>';
			}
			

			
		    

		tds+='</tr>';
	}
	document.getElementById('ops_place').innerHTML = tds;
}
</script>
@endsection