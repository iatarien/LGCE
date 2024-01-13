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
			<div class="panel-heading"></div>
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
	get_suivi_e("{{$e}}");

};


function get_suivi_e(value){
	var url = "/get_suivi_e/"+value;
	console.log(value);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     display(response,"");
		 document.getElementById('myModal').style.display = "none";
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
				'<td style=" width : 18%;"><div> المقاول</div></td>'+
				'<td style="width : 10%;"><div> صفقة/عقد </div></td>'+
		        '<td style="width : 15%;"><div> الحصة </div></td>'+
				'<td style=" width : 12%;" id="intitule"><div>  القيمة </div></td>'+
		        '<td style=" width : 14%;" id="intitule"><div>  المدة </div></td>'+
                '<td style=" width : 20%;" id="intitule"><div> ODS</div></td>'+
				'<td style=" width : 10%;" id="intitule"><div>تاريخ إنتهاء الأشغال</div></td>'+
                '<td style=" width : 8%;" id="intitule"><div>نسبة التقدم في الأشعال</div></td>'+
                //'<td style=" width : 14%;" id="intitule"><div>الوضعيات</div></td>'+
		      '</tr>';
	const op = engagements;
	console.log(engagements.length);
	for (var i = 0; i < engagements.length; i++) {
		tds +=
		'<tr style="font-weight : bold">'+
		    '<td ><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
			'<td >'+
		        '<span><h5><strong>'+op[i].name+'</strong></h5></span>'+
		    '</td>'+
			'<td >'+
		        '<span style="text-align : right" dir="rtl"><h5><strong>'+op[i].deal_type+" رقم "+op[i].deal_num+'</strong></h5></span>'+
		    '</td>'+
            '<td >'+
		        '<span style="text-align : right" dir="rtl"><h5><strong>'+op[i].sujet+'</strong></h5></span>'+
		    '</td>'+
			'<td >'+
		        '<span><h5><strong>'+numberWithCommas(op[i].total)+'</strong></h5></span>'+
		    '</td>'+
		    '<td >'+'<span></span>'+
		        //'<span><h5><strong>'+duration(op[i].years,op[i].months,op[i].days)+'</strong></h5></span>'+
		    '</td>'+
			'<td >';
			for(var z = 0; z < op[i].odss.length; z++){
		
				tds+='<span><a class="e_link" target="_blank" href="/ods/'+op[i].odss[z].id+'"><strong>'+op[i].odss[z].type_ods+' ('+op[i].odss[z].ods_date+')</strong></a></span><hr style="border-color : black;">';
			}
		    tds+='</td>'+
			'<td >'+'<span></span>'+
		        //'<span><h5><strong>'+op[i].fin_delai+'</strong></h5></span>'+
		    '</td>'+
			'<td >'+'<span></span>'+
		        '<span><h5><strong>'+op[i].taux_eng+'</strong></h5></span>'+
		    '</td>'+
			'<td >';
            // for(var z = 0; z < op[i].situations.length; z++){
		
            //     tds+='<span><a class="e_link" href="/situations/'+op[i].id_eur+'"><strong>'+op[i].situations[z].numero+'</strong></a></span><hr style="border-color : black;">';
            // }
            tds+='</td>';
            
			
		    

		tds+='</tr>';
		      
	}
	document.getElementById('ops_place').innerHTML = tds;
}
// function display(engagements,value){
//     var user_id = {{ $user->id }};
// 	var tds = '<tr style="  font-weight : bolder;">'+
// 		        '<td style="width : 2%;" ><div>#</div></td>'+
// 		        '<td style="width : 6%;"><div> الحصة </div></td>'+
// 		        '<td style=" width : 18%;"><div> المقاول</div></td>'+
// 		        '<td style=" width : 14%;" id="intitule"><div>  المدة </div></td>'+
//                 '<td style=" width : 20%;" id="intitule"><div> ODS</div></td>'+
// 				'<td style=" width : 20%;" id="intitule"><div>تاريخ إنتهاء الأشغال</div></td>'+
//                 '<td style=" width : 6%;" id="intitule"><div>نسبة التقدم في الأشعال</div></td>'+
//                 '<td style=" width : 14%;" id="intitule"><div>الوضعيات</div></td>'+
// 		      '</tr>';
// 	const op = engagements;
// 	console.log(engagements.length);
// 	for (var i = 0; i < engagements.length; i++) {
// 		tds +=
// 		'<tr style="font-weight : bold">'+
// 		    '<td ><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
//             '<td >'+
// 		        '<span style="text-align : right" dir="ltr"><h5><strong>'+op[i].projet+'</strong></h5></span>'+
// 		    '</td>'+
// 		    '<td >'+
// 		        '<span><h5><strong>'+op[i].name+'</strong></h5></span>'+
// 		    '</td>'+
// 		    '<td >'+
// 		        '<span><h5><strong>'+duration(op[i].years,op[i].months,op[i].days)+'</strong></h5></span>'+
// 		    '</td>'+
// 			'<td >';
// 			for(var z = 0; z < op[i].odss.length; z++){
		
// 				tds+='<span><a class="e_link" href=""><strong>'+op[i].odss[z].type_ods+' ('+op[i].odss[z].ods_date+')</strong></a></span><hr style="border-color : black;">';
// 			}
// 		    tds+='</td>'+
// 			'<td >'+
// 		        '<span><h5><strong>'+op[i].fin_delai+'</strong></h5></span>'+
// 		    '</td>'+
// 			'<td >'+
// 		        '<span><h5><strong>'+op[i].taux_av+'</strong></h5></span>'+
// 		    '</td>'+
// 			'<td >';
//             for(var z = 0; z < op[i].situations.length; z++){
		
//                 tds+='<span><a class="e_link" href="/situations/'+op[i].id_eur+'"><strong>'+op[i].situations[z].numero+'</strong></a></span><hr style="border-color : black;">';
//             }
//             tds+='</td>';
            
			
		    

// 		tds+='</tr>';
		      
// 	}
// 	document.getElementById('ops_place').innerHTML = tds;
// }
</script>
@endsection