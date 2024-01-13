@extends('comptabilite.master_compta')
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

<div class="row">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-offset-3 col-sm-1 form-group">
				@if($user->service == "Comptabilité")
				<button style="cursor : pointer" onclick="imprimer()" class="btn btn-basic">
				<img style="max-width : 50%;" src="{{ url('img/print.png') }}">
				</button>
				@endif
			</div>
			<div class="col-sm-2  form-group">
				<select class="form-control" onchange="filter_y(this.value)">
					<option style="visibility: hidden;" value="">السنة</option>
					@for($i=2019; $i< 2040; $i++)
					<option value="{{$i}}">{{$i}}</option>
					@endfor
				</select>
			</div>
			<div class=" col-sm-12 col-md-2  form-group">
				<select class="form-control" onchange="filter(this.value)">
					<option value="ctc">  CTC</option>
					<option value="anep"> ANEP</option>
				</select>
			</div>
			
		</div>
	</div>
	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table;" lang="ar" dir="rtl">
			<div class="panel-heading">الدفعات</div>
				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody id="ops_place">
				      
				    </tbody>
				  </table>
		</section>
		<!--Project Activity end-->
	</div>
</div>
<div style="display: none;" id="filters-year"></div>
<div style="display: none;" id="filters-user_id">{{$user->id}}</div>

<div style="display: none;" id="filters-type">ctc</div>
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
	const ze_type ="ctc";
	get_pays(ze_type);
	
	//document.getElementById('myModal').style.display = "none";
};

function filter_y(value){
	let type = document.getElementById('filters-type').innerHTML;
	console.log("value ",value);
	document.getElementById('filters-year').innerHTML = value;

	var url = "/get_ctc/"+type+"/"+value;
	console.log(url);
	$.ajax({
		url: url,
		type:"GET", 
		cache: false,
		success:function(response) {
		display(response,value);
		document.getElementById('myModal').style.display = "none";
		},
		error:function(response) {
		console.log(response);
		},

	});
}

function filter(value){
	let year = document.getElementById('filters-year').innerHTML;
	console.log("value ",value);
	document.getElementById('filters-type').innerHTML = value;

	var url = "/get_ctc/"+value;
	if(year !=""){
		url += "/"+year;
	}
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     display(response,value);
		 document.getElementById('myModal').style.display = "none";
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function numberWithCommas(x) {
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(!x.includes('.')){
      x += ".00";
    }
    return x;
}
function subject(deal,deal_num,deal_date,annexe,sujet,e,travaux_type,travaux_num){

    var txt = "تسوية"+" ";
    if(travaux_type != "فاتورة" && travaux_num != null){
        txt +=travaux_type+" رقم"+" "+travaux_num+" ";
    }
    if(annexe !="" && annexe != null){
        txt +="في إطار الملحق " +" "+annexe+" ";
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
function get_pays(value){
	var url = "/get_ctc/"+value;
	console.log(value);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     display(response,value);
		 document.getElementById('myModal').style.display = "none";
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function imprimer(){

	var filters = ['type','year'];


	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML+"/";
	}
	var url = "/print_ctc/"+query;
	console.log(url);
	window.open(url, '_blank').focus();
}
function display(engagements,value){
    var user_id = {{ $user->id }};
    var type= "";
	var tds = '<tr style="  font-weight : bolder;">'+
		        '<td style="width : 2%;" ><div>#</div></td>'+
		        '<td style=" width : 18%;"><div>رقم العملية</div></td>'+
		        '<td style=" width : 13%;" id="intitule"><div> الموضوع  </div></td>'+
                '<td style=" width : 12%;" id="intitule"><div>المقـــاول</div></td>'+
				'<td style="width : 20%;"><div> القيمة </div></td>'+
				'<td style="width : 10%;"><div>  رقم الحوالة </div></td>'+
				'<td style=" width : 15%;" id="intitule"><div>تـــــاريخ الدفع</div></td>';

				
		      tds+='</tr>';
	const op = engagements;
	for (var i = 0; i < engagements.length; i++) {
		tds +=
		'<tr style="font-weight : bold">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
		    '<td>'+
		        '<span style="text-align : right" dir="ltr"><h5><strong>'+op[i].numero+'</strong></h5></span>'+
		    '</td>'+
		    '<td style="overflow : auto;">'+
		        '<span><h5><strong>'+subject(op[i].deal_type,op[i].deal_num,op[i].deal_date,op[i].annexe,op[i].sujet,op[i].name,op[i].travaux_type,op[i].travaux_num)+'</strong></h5></span>'+
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

		tds+='</tr>';
	}
	document.getElementById('ops_place').innerHTML = tds;
}
</script>
@endsection