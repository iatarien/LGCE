@extends('layouts.master')

@section('content')

<div id="main" class="row main">
	<div class="row">
		<div style="margin-right : 50%" class="col-sm-4 form-group">
				<input id="e_input" autocomplete="off" dir="ltr" placeholder=" Nom de l'entreprise" list="ops" class="form-control"  onclick="e_like(this.value)" onkeyup="e_like(this.value)" > 
                    <div id="myDropdown1" class="dropdown-content" style="display: none;">
                      @foreach ($es as $e)
                      <span class="es_clss" style="cursor: pointer; text-align : right;" onclick="filter_e('{{ $e->name }}')">{{ $e->name  }}</span>
                      @endforeach
                    </div>
		</div>
	</div>
	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table; width : 70%; float : left;" lang="ar" dir="ltr">
			<div class="panel-heading">Entreprises</div>
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
document.onclick= function(event) {
	if(event.srcElement.id != "e_input"){
		document.getElementById('myDropdown1').style.display = "none";
	}
	
};
function get_e(){
    var url = "/e_get";
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
function filter_e(value){

	var url = "/entreprises_get/"+value;
	console.log(url);
	$.ajax({
	    url: url,
	    type:"GET", 
	    cache: false,
	    success:function(response) {
	     display(response);
	   	},
	   	error:function(response) {
	     console.log(response);
	   	},

	  });
}
function display(es){

	var tds = '<tr style="  font-weight : bolder;">'+
		        '<td style="width : 5%;" ><div>#</div></td>'+
		        '<td style="width : 57%;"><div> Nom</div></td>'+
				'<td style="width : 20%;"><div>  Type</div></td>'+
		        '<td style="width : 15%;"><div>Modifier</div></td>'+
		      '</tr>';
	const op = es;
	for (var i = 0; i < es.length; i++) {
		tds +=
		'<tr style="font-weight : bold">'+
		    '<td><span><h5><strong>'+(i+1)+'</strong></h5></span></td>'+
		    '<td>'+
		        '<span><h5><strong>'+op[i].name+'</strong></h5></span>'+
		    '</td>';
			if(op[i].nature =="bet"){
				tds+='<td>'+
		        	'<span><h5><strong> Bureau d\'etudes</strong></h5></span>'+
		    	'</td>';
			}else{
				tds+='<td>'+
		        	'<span><h5><strong>Entreprise </strong></h5></span>'+
		    	'</td>';
			}
            tds +='<td>'+
            '<span><button class="btn btn-primary"  onclick="document.location.href=\'/modifier_e/'+op[i].id+'\'">Modifier</button></span>'+
            '</td>';
	

		tds+='</tr>';
	}
	document.getElementById('ops_place').innerHTML = tds;
}
</script>
@endsection