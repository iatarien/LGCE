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
			<div class=" col-sm-offset-4  col-sm-4 form-group">
				<select class="form-control" onchange="filter(this.value)">
					
				</select>
			</div>
		</div>
	</div>
	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table;" lang="ar" dir="rtl">
			<div class="panel-heading">الالتزامات</div>
				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody id="ops_place">
                        <tr style="  font-weight : bolder;">
                            <td style="width : 2%;" ><div>#</div></td>
                            <td style="width : 10%;"><div>صفقة / عقد</div></td>
                            <td style=" width : 20%;"><div> موضوع الالتزام</div></td>
                            <td style=" width : 15%;"><div> المجموع القديم</div></td>
                            <td style=" width : 15%;" id="intitule"><div> مبلغ الإلتزام </div></td>
                            <td style=" width : 15%;" id="intitule"><div>المجموع الجديد</div></td>
                            <td style="width : 8%;"><div>معاينة</div></td>
                        </tr>
                        <?php $i = 0; ?>
                        @foreach($engs as $op)
                        <?php $i = $i +1; 
                        $total_0 =floatval($op->total_2) + floatval($op->total);
                        ?>
                        <tr style="font-weight : bold">
                            <td><span><h5><strong>{{$i}}</strong></h5></span></td>
                            <td>
                                <span><h5><strong>{{$op->deal_type}}." ".{{$op->deal_num}}</strong></h5></span>
                            </td>
                            <td>
                                <span style="text-align : right" dir="ltr"><h5><strong>{{$op->real_sujet}}</strong></h5></span>
                            </td>
                            <td>
                                <span style="text-align : right" dir="ltr">
                                <h5><strong>
                                            {{ number_format((float)$total_0, 2, '.', ',')}} 
                                </strong></h5>
                                </span>
                            </td>
                            
                            <td>
                                <span style="text-align : right" dir="ltr">
                                <h5><strong>@if($op->total != 0 and $op->total !== NULL) 
                                            {{ number_format((float)$op->total, 2, '.', ',')}} 
                                            @endif
                                </strong></h5>
                                </span>
                            </td>
                            <td>
                                <span style="text-align : right" dir="ltr">
                                <h5><strong>@if($op->total_2 != 0 and $op->total_2 !== NULL) 
                                            {{ number_format((float)$op->total_2, 2, '.', ',')}} 
                                            @endif
                                </strong></h5>
                                </span>
                            </td>
                            
                            <td>
                                <span><a class="btn btn-default"  href='/fiche_eng/{{$op->id}}'>الالتزام</a></span>
                                </td>
                            </tr>
                            @endforeach
				    </tbody>
				  </table>
		</section>
		<!--Project Activity end-->
	</div>
</div>

<div style="display: none;" id="filters-chapitre"></div>

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
	document.getElementById('myModal').style.display = "none";
};



function filter(value){
	console.log("value ",value);
    document.getElementById("filters-chapitre").innerHTML = value;
	var filters = ['chapitre'];

	
	var query = "";
	for(var i =0; i<filters.length; i++){
		query += document.getElementById("filters-"+filters[i]).innerHTML;
	}
	var url = "/get_apros/"+query;
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

function get_apros(value){

	var url = "/get_apros/"+value;
	
	
	console.log(value);
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

function supprimer(link){
	var result = confirm("هل أنت متأكد من أنك تريد حذف هذا الالتزام ؟");
	if (result) {
		document.location.href = link;
	}
}

function numberWithCommas(x) {
	x= x.toString();
	if(x.includes('.')){
		xs = x.split(".");
		x = xs[0].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"."+ xs[1].substring(0,2);
    }else{
		x = x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") +".00"
	}
    return x;
}

function display(engagements,value){
    var user_id = {{ $user->id }};
	var tds = '<tr style="  font-weight : bolder;">'+
		        '<td style="width : 2%;" ><div>#</div></td>'+
		        '<td style="width : 10%;"><div>صفقة / عقد</div></td>'+
                '<td style=" width : 20%;"><div> موضوع الالتزام</div></td>'+
		        '<td style=" width : 15%;"><div> المقاول</div></td>'+
		        '<td style=" width : 15%;" id="intitule"><div> مبلغ الاعتماد </div></td>'+
                '<td style=" width : 15%;" id="intitule"><div>المبلغ المقترح للاعتماد</div></td>'+
				'<td style=" width : 15%;" id="total"><div>مبلغ الاعتماد المتبقي</div></td>'+
				'<td style="width : 8%;"><div>معاينة</div></td>'+
		      '</tr>';
	const op = engagements;
	for (var i = 0; i < engagements.length; i++) {
		tds +=
		'<tr style="font-weight : bold">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].deal_type+' '+op[i].deal_num+'</strong></h5></span>'+
		    '</td>'+
			'<td>'+
		        '<span style="text-align : right" dir="ltr"><h5><strong>'+op[i].real_sujet+'</strong></h5></span>'+
		    '</td>'+
		    '<td>'+
		        '<span style="text-align : right" dir="ltr"><h5><strong>'+op[i].name+'</strong></h5></span>'+
		    '</td>';
			
			tds +='<td dir="ltr" style="text-align : right">'+
		        '<span><h5><strong>'+numberWithCommas(op[i].old_cp)+'</strong></h5></span>'+
		    '</td>';
            tds +='<td dir="ltr" style="text-align : right">'+
		        '<span><h5><strong>'+numberWithCommas(op[i].montant)+'</strong></h5></span>'+
		    '</td>';
            tds +='<td dir="ltr" style="text-align : right">'+
		        '<span><h5><strong>'+numberWithCommas(op[i].new_cp)+'</strong></h5></span>'+
		    '</td>';
			
			tds +='<td>'+
		    	'<span><button class="btn btn-default"  onclick="document.location.href=\'/eng_apro/'+op[i].id_eng+'\'">الالتزام</button></span>'+
		        '</td>';
			
			
		
		    

		tds+='</tr>';
	}
	document.getElementById('ops_place').innerHTML = tds;
}
</script>
@endsection