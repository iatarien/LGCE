@extends('layouts.master')
@section('content')
<div id="main" class="row main" dir="rtl">
	<div class="col-lg-offset-2 col-lg-8 portlets" >
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-right"><h3>تعديل عملية</h3> </div>
	        <br><br>
	      </div>
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" dir="rtl" action="/update_op_admin" method="POST">
	            
					@csrf
					<!-- Title -->
				  @if(isset($sous->id))
				  <?php $sous_id = $sous->id; $sous_code =  $sous->code;?>
				  @else
				  <?php $sous_id = NULL; $sous_code = NULL;?>
				  @endif
				  <input id="sous_id" value="{{$sous_id}}" name="sous_id" type="hidden" >
                  <input id="id_op" value="{{$op->id}}" name="id_op" type="hidden" >


	              <!-- Title -->
				  <?php $readonly = "readonly"; ?>

				  <?php // $readonly = ""; ?>

	              <div class="form-group row">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="title">رقم العملية</label>
	                <div class="col-lg-9">
	                  <input {{$readonly}} required="" dir="ltr" style="text-align : right" value="{{$op->numero}}" type="text" class="form-control" id="numero" name="numero">
	                </div>
	              </div><br>
	              <!-- Content -->
				  @if($ville_fr =="Ouargla" && $direction_fr =="Direction de l'Administration Locale")
	              <div class="form-group row">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="title">رقم العملية القديم</label>
	                <div class="col-lg-9">
	                  <input {{$readonly}} required="" dir="ltr" style="text-align : right" value="{{$op->old_numero}}" type="text" class="form-control" id="old_numero" name="old_numero">
	                </div>
	              </div><br>
				  @endif
                  <div class="form-group row ">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="content">تعيين العملية</label>
	              	<div class="col-lg-9">
	                  <input {{$readonly}} dir="rtl" style="text-align : right" required="" type="text" value="{{$op->intitule_ar}}" class="form-control" id="intitule_ar" name="intitule_ar">
		            </div>
                  </div><br>
				  <div class="form-group row ">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="content">Intitulé</label>
	              	<div class="col-lg-9">
	                  <input {{$readonly}} dir="ltr" type="text" value="{{$op->intitule}}" class="form-control" id="intitule" name="intitule">
		            </div>
                  </div><br>
				  <div class="form-group row">
				  	<label readonly class="control-label col-lg-3" style="text-align : left;" for="title"> المحاسب </label>
	                <div class="col-lg-9">
	                	<select  name="user_id" id="user_id" class="form-control">
                            <option dir ="ltr" selected style="visibility :  hidden" value="{{$u->id}}">{{$u->full_name}}</option>
							@foreach($users as $us)
							<option dir="ltr" value="{{$us->id}}">{{$us->full_name}}</option>
							@endforeach
						</select>  
					</div>
	              </div><br>

				


	              <!-- Buttons -->
	              <div class="form-group" align="center">
	                <!-- Buttons -->
	                <div class="col-lg-offset-2 col-lg-10">
	                  <button type="submit" class="btn btn-primary">حفظ</button>
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
<div style="display : none" id="div-porte">{{$p->code}}</div>
<div style="display : none" id="div-prog">{{$prog->code}}</div>
<div style="display : none" id="div-sous">{{$sous_code}}</div>
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
	const sous_action = document.getElementById('sous_action').value; 
	const activite = document.getElementById('activite').value; 
	if(div_sous != ""){
		numero.value ="N1."+ porte +"."+ div_prog +"."+ div_sous +"."+activite+"."+sous_action+"."+annee;
	}else{
		numero.value ="N1."+ porte +"."+ div_prog +"."+activite+"."+sous_action+"."+annee;
	}
	numero.value = numero.value.replaceAll('..','.');
	var url = "/get_progs/"+porte;
	$.ajax({
		url: url,
		type:"GET", 
		cache: false,
		success:function(response) {
		//console.log(response);
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
	const sous_action = document.getElementById('sous_action').value; 
	var url = "/get_sous/"+code;
	$.ajax({
		url: url,
		type:"GET", 
		cache: false,
		success:function(response) {
			//console.log(response);
			display1(response);
			if(response.length > 0){
				document.getElementById('sous_id').value = response[0].id;
				div_sous = document.getElementById('div-sous').innerHTML = response[0].code; 
			}else{
				document.getElementById('sous_id').value = null;
				div_sous = document.getElementById('div-sous').innerHTML = ""; 
			}

			if(div_sous != ""){
				numero.value ="N1."+ div_porte +"."+ div_prog +"."+ div_sous +"."+activite+"."+sous_action+"."+annee;
			}else{
				numero.value ="N1."+ div_porte +"."+ div_prog +"."+activite+"."+sous_action+"."+annee;
			}
		},
		error:function(response) {
			console.log(response);
		},

	});
	console.log(div_sous);
	if(div_sous != ""){
		numero.value ="N1."+ div_porte +"."+ code +"."+ div_sous +"."+activite+"."+sous_action+"."+annee;;
	}else{
		numero.value ="N1."+ div_porte +"."+ code +"."+activite+"."+sous_action+"."+annee;;
	}
	numero.value = numero.value.replaceAll('..','.');
}
function sous(code){	
	codes = code.split("*1989raouf1989*");
	sous_id = codes[0];
	code = codes[1];
	var numero = document.getElementById('numero');
	document.getElementById('sous_id').value = sous_id;
	const div_porte = document.getElementById('div-porte').innerHTML; 
	const div_prog = document.getElementById('div-prog').innerHTML; 
	const div_sous = document.getElementById('div-sous').innerHTML = code; 
	const annee = document.getElementById('annee').value; 
	const activite = document.getElementById('activite').value; 
	const sous_action = document.getElementById('sous_action').value; 
	if(div_sous != ""){
		numero.value ="N1."+ div_porte +"."+ div_prog +"."+ code +"."+activite+"."+sous_action+"."+annee;
	}else{
		numero.value ="N1."+ div_porte +"."+ div_prog +"."+activite+"."+sous_action+"."+annee;
	}
	numero.value = numero.value.replaceAll('..','.');
}
function change_num(){	
	var numero = document.getElementById('numero');
	const div_porte = document.getElementById('div-porte').innerHTML; 
	const div_prog = document.getElementById('div-prog').innerHTML; 
	const div_sous = document.getElementById('div-sous').innerHTML; 
	const annee = document.getElementById('annee').value; 
	const activite = document.getElementById('activite').value; 
	const sous_action = document.getElementById('sous_action').value; 
	if(div_sous != ""){
		numero.value ="N1."+ div_porte +"."+ div_prog +"."+ div_sous +"."+activite+"."+sous_action+"."+annee;
	}else{
		numero.value ="N1."+ div_porte +"."+ div_prog +"."+activite+"."+sous_action+"."+annee;
	}
	numero.value = numero.value.replaceAll('..','.');
}
function display(progs){

	const op = progs;
	var tds = "";
	for (var i = 0; i < progs.length; i++) {
		tds +=
		'<option value="'+progs[i].code+'">'+progs[i].code+' - '+progs[i].designation+'</option>';
	}
	document.getElementById('programme').innerHTML = tds;
}
function display1(progs){

	const op = progs;
	var tds = "";
	for (var i = 0; i < progs.length; i++) {
		tds +=
		'<option value="'+progs[i].id+'*1989raouf1989*'+progs[i].code+'">'+progs[i].code+' - '+progs[i].designation+'</option>';
	}
	document.getElementById('sous_programme').innerHTML = tds;
}

function update_AP(){
	const init = document.getElementById('AP_init').value;
	const rev = document.getElementById('reevaluation').value;
	document.getElementById('AP_act').value = parseFloat(init) + parseFloat(rev);
}
</script>
@endsection

