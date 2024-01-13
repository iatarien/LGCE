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
	<div class="col-lg-12">
		<div class="row">
			<div class=" col-lg-offset-4  col-lg-4 form-group">
				<input autocomplete='off' id="op_input" dir="rtl" placeholder="اختيار العملية" list="ops" class="form-control"  onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
                    <div id="myDropdown" class="dropdown-content" style="display: none;">
                      @foreach ($operations as $operation)
                      <span class="ops_clss" style="cursor: pointer;" onclick="filter('{{ $operation->id }}1989raouf1989{{ $operation->numero }}')">{{ $operation->numero  }}</span>
                      @endforeach
                    </div>
			</div>
			


		</div>
	</div>
	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table;" lang="ar" dir="rtl">
			<div class="panel-heading">التراكمات</div>
				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody id="ops_place">
				      
				    </tbody>
				  </table>
		</section>
		<!--Project Activity end-->
	</div>
</div>

<div style="display: none;" id="filters-numero"></div>

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
    const type = "{{$type}}";
	get_cumul(type);
	document.getElementById('myModal').style.display = "none";
};
document.onclick= function(event) {
	if(event.srcElement.id != "op_input"){
		document.getElementById('myDropdown').style.display = "none";
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

function filter(value){
    const type = "{{$type}}";
    var values = value.split("1989raouf1989");
    value = values[0];

	console.log("value ",value);
    document.getElementById("myDropdown").style.display ="none";
	document.getElementById('op_input').value = values[1];
	document.getElementById("filters-numero").innerHTML = value;

	const filters = ['numero'];
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML;
	}
	if(type ==""){
		type = "all";
	}
	var url = "/get_cumul/"+type+"/"+query;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     display(response,type);
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function get_cumul(value){

	var url = "/get_cumul/"+value;
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

function display(engagements,type){
	var user_id = {{$user_id}};
	var tds = '<tr style="  font-weight : bolder;">'+
		        '<td style="width : 2%;" ><div>#</div></td>'+
		        '<td style=" width : 16%;"><div>رقم العملية</div></td>'+
				'<td style=" width : 16%;"><div>تعيين العملية</div></td>';
				
    
                 tds+= '<td style=" width : 10%;" id="intitule"><div> مجموع الاتزامات نهاية 2019  </div></td>';

                 tds+= '<td style=" width : 10%;" id="intitule"><div> مجموع الدفعات نهاية 2019  </div></td>';
				 tds+= '<td style=" width : 10%;" id="intitule"><div> مجموع الاتزامات منذ 2020  </div></td>';

                 tds+= '<td style=" width : 10%;" id="intitule"><div> مجموع الدفعات منذ 2020  </div></td>';
				 tds+= '<td style=" width : 10%;" id="intitule"><div> مجموع الاتزامات    </div></td>';

                 tds+= '<td style=" width : 10%;" id="intitule"><div> مجموع الدفعات    </div></td>';

				//tds+= '<td style=" width : 26%;" id="intitule"><div> مجموع الاتزامات   </div></td>';

                //tds+= '<td style=" width : 26%;" id="intitule"><div> مجموع الدفعات  </div></td>';



			 tds+= '<td style=" width : 8%;" id="intitule"><div>   تعديل </div></td>'+'</tr>';
               
		        
	const op = engagements;
	for (var i = 0; i < engagements.length; i++) {
		tds +=
		'<tr style="font-weight : bold">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
		    '<td>'+
		        '<span style="text-align : right" dir="ltr"><h5><strong>'+op[i].numero+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span><h5><strong>'+op[i].intitule_ar+'</strong></h5></span>'+
		    '</td>';
		    if(op[i].somme_eng_cumul == null || op[i].somme_eng_cumul == 0){
				tds+='<td>'+
		         '<span><h5><strong>/</strong></h5></span>'+
		     	'</td>';
			}else{
				tds+='<td dir="ltr" style="text-align : right">'+
		         '<span><h5><strong>'+numberWithCommas(op[i].somme_eng_cumul)+'</strong></h5></span>'+
		     '</td>';
			}
			if(op[i].somme_pay_cumul == null || op[i].somme_pay_cumul == 0){
				tds+='<td dir="ltr" style="text-align : right">'+
		         '<span><h5><strong>/</strong></h5></span>'+
		     	'</td>';
			}else{
				tds+='<td dir="ltr" style="text-align : right">'+
		         '<span><h5><strong>'+numberWithCommas(op[i].somme_pay_cumul)+'</strong></h5></span>'+
		     '</td>';
			}
			
			tds+='<td dir="ltr" style="text-align : right">'+
		        '<span><h5><strong>'+numberWithCommas(op[i].somme)+'</strong></h5></span>'+
		    '</td>'+
			'<td dir="ltr" style="text-align : right">'+
		        '<span><h5><strong>'+numberWithCommas(op[i].somme_pay)+'</strong></h5></span>'+
		    '</td>'+
			'<td dir="ltr" style="text-align : right">'+
		        '<span><h5><strong>'+numberWithCommas(op[i].somme_total_eng)+'</strong></h5></span>'+
		    '</td>'+
			'<td dir="ltr" style="text-align : right">'+
		        '<span><h5><strong>'+numberWithCommas(op[i].somme_total_pay)+'</strong></h5></span>'+
		    '</td>';
			
			if(op[i].op_id != null && op[i].user_id === user_id){
				tds+='<td>'+
		        	'<span><h5><strong><button class="btn btn-primary" onclick="document.location.href=\'/modifier_cumul/'+op[i].op_id+'\'">تعديل</button></strong></h5></span>'+
		    	'</td>';
			}
			console.log("op[i].user_id : "+op[i].user_id);
			console.log("op[i].op_id : "+op[i].op_id);
			console.log("user_id : "+user_id);
			
			
		tds+='</tr>';
	}
	document.getElementById('ops_place').innerHTML = tds;
}
</script>
@endsection