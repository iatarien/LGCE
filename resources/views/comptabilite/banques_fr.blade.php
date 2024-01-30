@extends('layouts.master')

@section('content')

<div id="main" class="row main">

	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table; width : 80%; float : left;" lang="ar" dir="ltr">
			<div class="panel-heading"> Banques </div>
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


@endsection

@section('js_scripts')
<script type="text/javascript">
window.onload = function(){
	get_e("");

};

 


function get_e(value){

	var url = "/banques_get/"+value;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     display(response);
         document.getElementById('loading').style.display = "none";
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function display(es){

	var tds = '<tr style="  font-weight : bolder;">'+
		        '<td style="width : 5%;" ><div>#</div></td>'+
		        '<td style="width : 40%;"><div>Banque </div></td>'+
				'<td style="width : 13%;"><div>  Code</div></td>'+
                '<td style="width : 13%;"><div>  Numéro</div></td>'+
                '<td style="width : 13%;"><div>  Clé</div></td>'+
		        '<td style="width : 16%;"><div>Modifier</div></td>'+
		      '</tr>';
	const op = es;
	for (var i = 0; i < es.length; i++) {
		tds +=
		'<tr style="font-weight : bold">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].nom+'</strong></h5></span>'+
		    '</td>'+
            '<td>'+
		        '<span><h5><strong>'+op[i].abr+'</strong></h5></span>'+
		    '</td>'+
            '<td>'+
		        '<span><h5><strong>'+op[i].num+'</strong></h5></span>'+
		    '</td>'+
            '<td>'+
		        '<span><h5><strong>'+op[i].cle+'</strong></h5></span>'+
		    '</td>';

            tds +='<td>'+
            '<span><button class="btn btn-primary"  onclick="document.location.href=\'/modifier_banque/'+op[i].id+'\'">Modifier</button></span>'+
            '</td>';
	

		tds+='</tr>';
	}
	document.getElementById('ops_place').innerHTML = tds;
}
</script>
@endsection