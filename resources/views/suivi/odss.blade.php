@extends('layouts.master')
@section('style')
<style>
table {
	table-layout: fixed;

}
#demo-table {
		width: 100%;
}
#demo-table tr td {
		border-color : black;
}
table td {
	width: 10%;
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

.e_link:link {
  color: black;
}

/* visited link */
.e_link:visited {
  color: black;
}

/* mouse over link */
.e_link:hover {
  color: blue;
}

/* selected link */
.e_link:active {
  color: black;
}
.e_span{
	height : 50px;
	overflow : hidden;
}
</style>
@endsection
@section('content')

<div class="row">

	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table;" dir="rtl">
			<div class="panel-heading">الوضعيات</div>
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
	get_situations("{{$e}}");
	document.getElementById('myModal').style.display = "none";
};


function get_situations(value){
	var url = "/get_situations/"+value;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     display(response,"");
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}

function duration(years,months,days){
	var s = "";
	if(years != 0){
		s+= years +" أعوام";
	}
	if(months != 0){
		s+= months +" أشهر";
	}
	if(days != 0){
		if(days > 10){
			s+= days +" يوم";
		}else{
			s+= days +" أيام";
		}
	}
	return s;
}

function numberWithCommas(x) {
	
	if(x == null){
		return 0;
	}
	x = x.toString();
	xs = x.split(".");
    x0 =  xs[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    if(!x.includes('.')){
      	x = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+".00";
    }else if(x.split(".")[1].length == 1){
        x = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"0";
    }else if(x.split(".")[1].length >= 2){
		x1 = xs[1];
		x1 = x1[0] + x1[1];
		x = x0 +"."+x1;
	}
    return x;
}

function display(engagements,value){
    var user_id = {{ $user->id }};
	var tds = '<tr style="  font-weight : bolder;">'+
		        '<td style="width : 2%;" ><div>#</div></td>'+
		        '<td style="width : 18%;"><div> وضعية أشغال رقم </div></td>'+
		        '<td style=" width : 20%;"><div> التاريخ </div></td>'+
                '<td style=" width : 20%;"><div> نوع وضعية الأشغال</div></td>'+
		        '<td style=" width : 20%;" id="intitule"><div> السبب </div></td>'+
                '<td style=" width : 20%;" id="intitule"><div> التعديل </div></td>'+
		      '</tr>';
	const op = engagements;
	console.log(engagements.length);
	for (var i = 0; i < engagements.length; i++) {
		tds +=
		'<tr style="font-weight : bold">'+
		    '<td ><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
			'<td >'+
		        '<span><h5><strong>'+op[i].ods_num+'</strong></h5></span>'+
		    '</td>'+
			'<td >'+
		        '<span><h5><strong>'+op[i].type_ods+'</strong></h5></span>'+
		    '</td>'+
			'<td >'+
		        '<span><h5><strong>'+op[i].cause+'</strong></h5></span>'+
		    '</td>'+
			'<td >'+
		        '<span><h5><strong></strong></h5></span>'+
		    '</td>'+

            tds+='</td>';
            
		tds+='</tr>'; 
	}
	document.getElementById('ops_place').innerHTML = tds;
}
</script>
@endsection