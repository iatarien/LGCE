@extends('layouts.master')

@section('content')
<div id="main" class="row main" dir="ltr">
	<div class=" col-lg-8 portlets" >
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-left"><h3>Ajouter Opération</h3> </div>
	        <br><br>
	      </div>
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" dir="ltr" action="/add_op_ar" method="POST">
	            	@csrf
					<!-- Title -->
				  <div class="form-group ">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="title">  Portefeuille</label>
	                <div class="col-lg-9">
	                	<select onchange="get_progs(this.value)" name="portefeuille" class="form-control">
							<option selected style="visibility : hidden"></option>
							@foreach($portefeuilles as $porte)
								<option value="{{$porte->code}}">{{$porte->code}} - {{$porte->ministere_fr}}</option>
							@endforeach
						</select>  
					</div>
	              </div><br>
				  <div class="form-group ">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="title">  Programme</label>
	                <div class="col-lg-9">
	                	<select onchange="get_sous(this.value)" name="programme" id="programme" class="form-control">
							
						</select>  
					</div>
	              </div><br>
				  <div class="form-group ">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="title">Sous Programme</label>
	                <div class="col-lg-9">
	                	<select onchange="sous(this.value)" name="sous_programme" id="sous_programme" class="form-control">
							
						</select>  
					</div>
	              </div><br>
				  <input id="sous_id" name="sous_id" type="hidden" >
				  <div class="form-group ">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="title">  Action</label>
	                <div class="col-lg-9">
	                  <input required="" placeholder="0000.000.000" onkeyup="change_num()" dir="ltr" style="text-align : left" value="" type="text" class="form-control" id="activite" name="activite">
	                </div>
	              </div><br>
				  <div class="form-group ">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="title"> Année et N° ordre</label>
	                <div class="col-lg-9">
	                  <input required="" placeholder="23.01" onkeyup="change_num()" dir="ltr" style="text-align : left" value="" type="text" class="form-control" id="annee" name="annee">
	                </div>
	              </div><br>
	              <!-- Title -->
	              <div class="form-group ">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="title">Numéro d'opération </label>
	                <div class="col-lg-9">
	                  <input required="" dir="ltr" style="text-align : left" value="" type="text" class="form-control" id="numero" name="numero">
	                </div>
	              </div><br>
	              <!-- Content -->
				  <div class="form-group  ">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="content">Intitulé</label>
	              	<div class="col-lg-9">
	                  <textarea rows ="3" dir="ltr" value="" class="form-control" id="intitule" required name="intitule"></textarea>
		            </div>
                  </div><br>
                  <div class="form-group  " style="display : none;">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="content"> العملية</label>
	              	<div class="col-lg-9">
	                  <textarea rows="3" dir="rtl" style="text-align : left" value="" class="form-control" id="intitule_ar" name="intitule_ar"></textarea>
		            </div>
                  </div><br>
				  
				  <div class="form-group  ">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="content"> Date d'inscription</label>
	              	<div class="col-lg-9">
	                  <input dir="ltr" type="date" value="" class="form-control" id="date" name="date">
		            </div>
                  </div><br>
				  <div class="form-group ">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="title"> Action </label>
	                <div class="col-lg-9">
	                	<select  name="source" id="source" class="form-control" style="text-align : left;">
                            <option value="PSD">Programme Sectoriel Déconcentrés (PSD)</option>
					        <option value="PSC"> Programme Sectoriel Centralisé (PSC)</option>
						</select>  
					</div>
	              </div><br>

				  <div class="form-group  ">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="content"> Autorisaton d'Engagements </label>
	              	<div class="col-lg-9">
	                  <input dir="ltr" style="text-align : left;" type="number" step="0.01" placeholder="0.00" class="form-control" id="AP_init" name="AP_init">
		            </div>
                  </div><br>


	              <!-- Buttons -->
	              <div class="form-group" align="center">
	                <!-- Buttons -->
	                <div class="col-lg-offset-2 col-lg-10">
	                  <button type="submit" class="btn btn-primary">Sauvegarder</button>
	                </div>
	              </div>
	            </form>
	          </div>


	        </div>
	        <div class="widget-foot">
	          <!-- Footer goes here -->
	        </div>
	      </div>
	    </div>
	</div>
</div>
@endsection
<div style="display : none" id="div-porte"></div>
<div style="display : none" id="div-prog"></div>
<div style="display : none" id="div-sous"></div>
@section('js_scripts')
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function get_progs(porte){	
	var numero = document.getElementById('numero');
	const div_porte = document.getElementById('div-porte').innerHTML = porte; 
	const div_prog = document.getElementById('div-prog').innerHTML; 
	const div_sous = document.getElementById('div-sous').innerHTML; 
	const annee = document.getElementById('annee').value; 
	const activite = document.getElementById('activite').value; 
	if(div_sous != ""){
		numero.value ="N1."+ porte +"."+ div_prog +"."+ div_sous +"."+activite+"."+annee;
	}else{
		numero.value ="N1."+ porte +"."+ div_prog +"."+activite+"."+annee;
	}
	var url = "/get_progs/"+porte;
	$.ajax({
		url: url,
		type:"GET", 
		cache: false,
		success:function(response) {
		console.log(response);
		display(response);
		get_sous(response[0].code);

		},
		error:function(response) {
		console.log(response);
		},

	});
}

function get_sous(code){	
	var numero = document.getElementById('numero');
	const div_porte = document.getElementById('div-porte').innerHTML; 
	const div_prog = document.getElementById('div-prog').innerHTML = code; 
	var div_sous = document.getElementById('div-sous').innerHTML; 
	const annee = document.getElementById('annee').value; 
	const activite = document.getElementById('activite').value; 
	if(div_sous != ""){
		numero.value ="N1."+ div_porte +"."+ code +"."+ div_sous +"."+activite+"."+annee;;
	}else{
		numero.value ="N1."+ div_porte +"."+ code +"."+activite+"."+annee;;
	}
	var url = "/get_sous/"+code;
	$.ajax({
		url: url,
		type:"GET", 
		cache: false,
		success:function(response) {
			console.log(response);
			display1(response);
			if(response.length > 0){
				document.getElementById('sous_id').value = response[0].id;
				div_sous = document.getElementById('div-sous').innerHTML = response[0].code; 
			}else{
				document.getElementById('sous_id').value = null;
				div_sous = document.getElementById('div-sous').innerHTML = ""; 
			}

			if(div_sous != ""){
				numero.value ="N1."+ div_porte +"."+ div_prog +"."+ div_sous +"."+activite+"."+annee;
			}else{
				numero.value ="N1."+ div_porte +"."+ div_prog +"."+activite+"."+annee;
			}
		},
		error:function(response) {
			console.log(response);
		},

	});
}
function sous(code){	
	var numero = document.getElementById('numero');
	const div_porte = document.getElementById('div-porte').innerHTML; 
	const div_prog = document.getElementById('div-prog').innerHTML; 
	const div_sous = document.getElementById('div-sous').innerHTML = code; 
	const annee = document.getElementById('annee').value; 
	const activite = document.getElementById('activite').value; 
	if(div_sous != ""){
		numero.value ="N1."+ div_porte +"."+ div_prog +"."+ code +"."+activite+"."+annee;
	}else{
		numero.value ="N1."+ div_porte +"."+ div_prog +"."+activite+"."+annee;
	}
}
function change_num(){	
	var numero = document.getElementById('numero');
	const div_porte = document.getElementById('div-porte').innerHTML; 
	const div_prog = document.getElementById('div-prog').innerHTML; 
	const div_sous = document.getElementById('div-sous').innerHTML; 
	const annee = document.getElementById('annee').value; 
	const activite = document.getElementById('activite').value; 
	if(div_sous != ""){
		numero.value ="N1."+ div_porte +"."+ div_prog +"."+ div_sous +"."+activite+"."+annee;
	}else{
		numero.value ="N1."+ div_porte +"."+ div_prog +"."+activite+"."+annee;
	}
}
function display(progs){

	const op = progs;
	var tds = "";
	for (var i = 0; i < progs.length; i++) {
		tds +=
		'<option value="'+progs[i].code+'">'+progs[i].code+' - '+progs[i].designation_fr+'</option>';
	}
	document.getElementById('programme').innerHTML = tds;
}
function display1(progs){

	const op = progs;
	var tds = "";
	for (var i = 0; i < progs.length; i++) {
		tds +=
		'<option value="'+progs[i].code+'">'+progs[i].code+' - '+progs[i].designation_fr+'</option>';
	}
	document.getElementById('sous_programme').innerHTML = tds;
}
</script>
@endsection

