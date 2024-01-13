@extends('layouts.master')
@section('style')
<style>

table {
	table-layout: fixed;
	font-size : 12px !important;
}
#demo-table {
		width: 99.5%;
}
#demo-table tr td {
		border-color : black;
		vertical-align : middle;
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
			<div class="panel-heading">العمليات</div>
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
	//get_suivis("","0");
	get_all();

};


function get_suivis(value,order){
	var url = "/get_suivis/"+value;
	console.log(value);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     display(response,value);
		 document.getElementById('myModal').style.display = "none";
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function get_all(){
	var url = "/get_all/";
	//console.log(value);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     display1(response);
		 document.getElementById('myModal').style.display = "none";
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
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

function display1(all){
	user_id = "{{$user->id}}";
	var tds = '<tr style="  font-weight : bolder;">'+
		        '<td style="width : 5%;"><div> القطاع </div></td>'+
		        '<td style=" width : 20%;"><div>رقم و تعيين العملية</div></td>'+
				'<td style=" width : 18%;" id="intitule"><div>مكاتب الدراسات</div></td>'+
				'<td style=" width : 22%;" id="intitule"><div>المقـــاولين</div></td>'+
                '<td style=" width : 25%;" id="intitule"><div>الحصة</div></td>'+
                '<td style=" width : 10%;" id="intitule"><div>نسبة التقدم في الأشعال</div></td>'+
		      '</tr>';
	const op = all;
	//console.log(engagements.length);
	for (var i = 0; i < op.length; i++) {
		//const max = op[i].es.length;
		max = op[i].max;
		tds +=
		'<tr style="font-weight : bold">'+
            '<td rowspan="'+max+'">'+
		        '<span style="text-align : right" dir="ltr"><strong>'+op[i].operation.chapitre+'</strong></span>'+
		    '</td>'+
		    '<td rowspan="'+max+'" align="center">'+
		        '<span><strong>'+op[i].operation.numero+'<br><br>'+op[i].operation.intitule_ar+'</strong></span>'+
		    '</td>'+

			'<td rowspan="'+max+'">';
			for(var z = 0; z < op[i].engs_bets.length; z++){
		
				tds+='<span><a class="e_link" href="/suivi_e/'+op[i].engs_bets[z].id_eng+'"><strong>'+op[i].engs_bets[z].name+'</strong></a></span><hr style="border-color : black;">';
			}
		    tds+='</td>';
			tds+='<td style="font-weight : bold"><a class="e_link" href="/suivi_e/'+op[i].engs_comp[0].id_eng+'"><strong>'+op[i].engs_comp[0].name+'</strong></a></td>';
			tds+='<td style="font-weight : bold"><a class="e_link" href="/suivi_e/'+op[i].engs_comp[0].id_eng+'"><strong>'+op[i].engs_comp[0].sujet+'</strong></a></td>';
			if(user_id == op[i].user)
		    tds+='<td  rowspan="'+max+'">'+
		        '<input id="inp'+i+'" onkeyup="update_taux(this.value,'+op[i].id_op+')"'+
				'style="width : 80%; text-align : center; background-color : white;"'+ 
				'class="form-control" type="text" value="'+(op[i].operation.taux)+'"/>';
			else{
				tds+='<td rowspan="'+max+'">'+
		        '<input id="inp'+i+'" disabled style="width : 80%; text-align : center; background-color : white;"'+ 
				'class="form-control" type="text" value="'+(op[i].operation.taux)+'"/>';
				
		    	tds+='</td>';
			}
			
			
		    

		tds+='</tr>';
		
		for(var j = 1; j < op[i].engs_comp.length; j++){
			tds +='<tr style="font-weight : bold">';
			tds+='<td><a class="e_link" href="/suivi_e/'+op[i].engs_comp[j].id_eng+'"><strong>'+op[i].engs_comp[j].name+'</strong></a></td>';
			tds+='<td><a class="e_link" href="/suivi_e/'+op[i].engs_comp[j].id_eng+'"><strong>'+op[i].engs_comp[j].sujet+'</strong></a></td>';
			tds+='</tr>';
		}
			
		
		      
	}
	document.getElementById('ops_place').innerHTML = tds;
}

function update_taux(value,id){
	var data = new FormData();
	data.append('taux',value);
    data.append('id',id);
	data.append("_token", "{{ csrf_token() }}");
    $.ajax({
        url:"/update_op_taux",
        type:"POST", 
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        success:function(response) {
         console.log(response);
         //location.reload();
         //modal.style.display = "none";
         //location.reload();
        },
        error:function(response) {
         console.log(response);
         //location.reload();
         //modal.style.display = "none";
         //location.reload();
        },

      });
	console.log(value,id)
}
  
// function display(engagements,value){
//     var user_id = {{ $user->id }};
// 	var tds = '<tr style="  font-weight : bolder;">'+
// 		        '<td style="width : 2%;" ><div>#</div></td>'+
// 		        '<td style="width : 6%;"><div> القطاع </div></td>'+
// 		        '<td style=" width : 18%;"><div>رقم العملية</div></td>'+
// 		        '<td style=" width : 14%;" id="intitule"><div> تعيين العملية </div></td>'+
//                 '<td style=" width : 20%;" id="intitule"><div>مكاتب الدراسات</div></td>'+
// 				'<td style=" width : 20%;" id="intitule"><div>المقـــاولين</div></td>'+
//                 '<td style=" width : 14%;" id="intitule"><div>الحصة</div></td>'+
//                 '<td style=" width : 6%;" id="intitule"><div>نسبة التقدم في الأشعال</div></td>'+
// 		      '</tr>';
// 	const op = engagements;
// 	console.log(engagements.length);
// 	for (var i = 0; i < engagements.length; i++) {
// 		const max = op[i].es.length;
// 		tds +=
// 		'<tr style="font-weight : bold">'+
// 		    '<td rowspan="'+max+'"><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
//             '<td rowspan="'+max+'">'+
// 		        '<span style="text-align : right" dir="ltr"><h5><strong>'+op[i].chapitre+'</strong></h5></span>'+
// 		    '</td>'+
// 		    '<td rowspan="'+max+'">'+
// 		        '<span><h5><strong>'+op[i].numero+'</strong></h5></span>'+
// 		    '</td>'+
// 		    '<td rowspan="'+max+'">'+
// 		        '<span><h5><strong>'+op[i].intitule_ar+'</strong></h5></span>'+
// 		    '</td>'+
// 			'<td rowspan="'+max+'">';
// 			for(var z = 0; z < op[i].bets.length; z++){
		
// 				tds+='<span><a class="e_link" href="/suivi_e/'+op[i].bets[z].id+'"><strong>'+op[i].bets[z].name+'('+op[i].bets[z].projet+')</strong></a></span><hr style="border-color : black;">';
// 			}
// 		    tds+='</td>'+
// 			'<td >'+
// 				'<a class="e_link" href="/suivi_e/'+op[i].es[0].id+'"><strong>'+op[i].es[0].name+'</strong></a>'+
// 			'</td>'+
// 			'<td >'+
// 				'<a class="e_link" href="/suivi_e/'+op[i].es[0].id+'"><h5><strong>'+op[i].es[0].projet+'</strong></a>'+
// 			'</td>'+
//             '<td rowspan="'+max+'">'+
// 		        '<span><h5><strong>'+op[i].taux+'</strong></h5></span>'+
// 		    '</td>';
			
		    

// 		tds+='</tr>';
		
// 		for(var j = 1; j < op[i].es.length; j++){
// 			tds +='<tr style="font-weight : bold">';
// 			tds+='<td><a class="e_link" href="/suivi_e/'+op[i].es[j].id+'"><strong>'+op[i].es[j].name+'</strong></a></td>';
// 			tds+='<td><a class="e_link" href="/suivi_e/'+op[i].es[j].id+'"><strong>'+op[i].es[j].projet+'</strong></a></td>';
// 			tds+='</tr>';
// 		}
			
		
		      
// 	}
// 	document.getElementById('ops_place').innerHTML = tds;
// }
</script>
@endsection