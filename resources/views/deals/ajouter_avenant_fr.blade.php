@extends('layouts.master')
@section('style')
<style type="text/css">
#engagement {
    border-collapse: collapse;
    border : 1px solid;
    table-layout: fixed;
}
#engagement th {
    border : 1px solid;
    width: 23%;
    text-align: center;
    color: black;
}
#engagement th:last-child {
    width: 31%;
}
#engagement td {
    border : 1px solid;
    font-weight: bold;
    padding: 0 3px 0 3px;
    text-align: center;
}
.input_num {
  color: black;
}
#engagement td:nth-last-child(2) {
    text-align: right;
}
#engagement td:first-child {
  padding : 0;
}
#engagement td:nth-last-child(4) {
    padding : 0;
}
#engagement td:last-child {
    display: none;
}
.dropdown-content {
  display: block;
  position: absolute;
  background-color: white;
  width: 47%;
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
<div id="main" class="row main" style="margin-right : 0;">
	<div class="col-sm-10 poltrets" lang="ar" dir="ltr" style="margin-right: 10%;"  >
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-left" style="font-size : 25px; font-weight : bold">
            Ajouter Avenant 
            </div>
            <br>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" action="/add_deal" method="POST">
	            @csrf
                <input type="hidden" name="parent" value="{{$id}}">
                <input type="hidden" name="type" value="avenant">
                <input type="hidden" name="id_op" value="{{$deal->id_op}}" id="id_op">
                <div class="form-group row">
                    <label class="control-label col-sm-3" style="text-align : left; font-weight: bold;" for="title">N° d'opération </label>
	                <div class="col-sm-7">
                        <input readonly value="{{$deal->numero}}" id="op_input" dir="ltr" style="text-align : left;" list="ops" class="form-control" id="numero_op_txt" onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
	                </div>
                </div><br>
                <div class="form-group row">
                    <label  class="control-label col-sm-3" style="text-align : left; font-weight: bold;" for="title">Intitulé</label>
	                <div class="col-sm-7">
	                  <input readOnly ="" value="{{$deal->intitule}}" type="text" class="form-control" id="intitule_ar" name="intitule_ar">
	                </div>
                </div><br>
                <input type="hidden" value="avenant" name="type_ar"/>
                  <div class="form-group row">
                    <label class="control-label col-sm-3" style="text-align : left; font-weight: bold;" for="title">N° et date de l'avenant</label>
	                <div class="col-sm-3">
                      <input  type="text" placeholder="N°"  class="form-control" id="deal_num" name="deal_num" style="color: black;" required>
                    </div>
                    <div class="col-sm-4">
                      <input  type="date" class="form-control" id="deal_date" name="deal_date" style="color: black;" >
                    </div> 
                  </div><br>
                  
                  <div class="form-group row">
                    <label  class="control-label col-sm-3" style="text-align : left; font-weight: bold;" for="title">Montant de l'avenant</label>
	                <div class="col-sm-7">
	                  <input  required="" type="number"  class="form-control" step="0.01" id="montant" name="montant" placeholder="0.00">
	                </div>
                </div><br>
                  

                <div class="form-group row">
                    <label class="control-label col-sm-3" style="text-align : left; font-weight: bold;" for="title"> Entreprise</label>
	              
	                <div class="col-sm-7">
                        <input id="comp_input" readonly value="{{$e->name}}" class="form-control" > 
                        <div id="myDropdown_comp" class="dropdown-content" style="display: none;">
                            <input type="hidden" readonly value="{{$deal->entreprise}}" required id="entreprise" name="entreprise_id" >
                            <div id="es">
       
                            </div>
                        </div>
	                </div>

                </div><br>

                <div class="form-group row">
                    <label class="control-label col-sm-3" style="text-align : left; font-weight: bold;" for="title">  Objet du {{$deal->deal_type}} </label>
	            
                    <div class="col-sm-7">
                        <input readonly value="{{$deal->lot}}" style="resize: none; color: black;"
                        required="" class="form-control"  id="sujet" />
                    </div>
                </div><br>
                <div class="form-group row">
                    <label class="control-label col-sm-3" style="text-align : left; font-weight: bold;" for="title">  Objet de l'avenant </label>
	            
                    <div class="col-sm-7">
                        <textarea  style="resize: none; color: black;" rows="5" required="" class="form-control" name="lot" id="sujet"></textarea>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label  class="control-label col-sm-3" style="text-align : left; font-weight: bold;" for="title"> N° du Compte Bancaire </label>
	                <div class="col-sm-7">
	                  <input required="" value="{{$bank->bank_acc}}" type="text" style="color: black;" class="form-control" name="bank_acc">
	                </div>
                     </div><br>
                <div class="form-group row">
                    <label  class="control-label col-sm-3" style="text-align : left; font-weight: bold;" for="title"> Propriétaire du compte</label>
	                <div class="col-sm-7">
	                  <input  required="" value="{{$bank->bank_user}}" type="text" style="color: black;" class="form-control" name="bank_user">
	                </div>
                    </div><br>
                <div class="form-group row">
                    <label  class="control-label col-sm-3" style="text-align : left; font-weight: bold;" for="title">Banque</label>
                    <input type="hidden" name="bank_id" value="{{$bank->id}}" />
                  <div class="col-sm-7">
	                  <select required=""  style="color: black;" class="form-control" name="bank">
                    <option selected value="{{$bank->bank}}" style="visibility : hidden">{{$bank->bank}}</option>
                    @foreach($banques as $banque)
                      <option value="{{ $banque->nom }}" >{{ $banque->nom }} - {{ $banque->abr }}</option>
                    @endforeach
                    </select>
	                </div>
                     </div><br>
                    <div class="form-group row">
                    <label  class="control-label col-sm-3" style="text-align : left; font-weight: bold;" for="title">Agence</label>
	                <div class="col-sm-7">
	                  <input required="" value="{{$bank->bank_agc}}" type="text" style="color: black;" class="form-control" name="bank_agc">
	                </div>
                </div><br>
                <div class="form-group row">
                    <label  class="control-label col-sm-3" style="text-align : left; font-weight: bold;" for="title">Durée de l'avenant</label>
	                <div class="col-sm-7">
	                  <input required="" type="number" value=""  placeholder="0 jours"   style="color: black;" class="form-control" name="duree">
	                </div>
                </div>
                <br><br>
	              <!-- Buttons -->
	              <div class="form-group row" align="center">
	                <!-- Buttons -->
	                <div class="col-sm-offset-2 col-sm-9">
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


<div id="the_op" style="display: none;"></div>
@endsection

@section('js_scripts')


<script type="text/javascript">
  window.onload = function(){
    document.getElementById('loading').style.display = "none";
  };
  
</script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
document.onclick= function(event) {
	if(event.srcElement.id != "op_input"){
		document.getElementById('myDropdown').style.display = "none";
	}
	if(event.srcElement.id != "comp_input"){
		document.getElementById('myDropdown_comp').style.display = "none";
	}
	
};



function popupwindow(url, title, w, h) {
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 

function add_e(){
  var myWindow = popupwindow("/entreprise", "إضافة مقـــاول", "800","500");
  var loop = setInterval(function() {   
    if(myWindow.closed) {  
        clearInterval(loop);  
        var url = "/e_get";
        $.ajax({
            url: url,
            type:"GET", 
            cache: false,
            success:function(response) {
              console.log(response);
            url = "";
              for(var i =0; i< response.length; i++){
                var e = response[i];
                url +='<span style="color: black; cursor: pointer;" class="comps_clss" onclick="comps_changed(\''+e.id+'1989raouf1989'+e.name+'\')">'+e.name+'</span>';
                
              }
              document.getElementById('es').innerHTML = url;
            },
            error:function(response) {
            console.log(response);
            },

          });
        }  
}, 1000); 
}

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
function comp_like(e,value){
  
  document.getElementById("myDropdown_comp").style.display ="block";
  if(e.key === "Escape" || e.key === "Esc") {
    document.getElementById("myDropdown_comp").style.display ="none";
  }
  var input, filter, ul, li, a, i;
  filter = value.toUpperCase();
  a = document.getElementsByClassName("comps_clss");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
function comps_changed(value){
  document.getElementById("myDropdown_comp").style.display ="none";

  var id = value.split("1989raouf1989")[0];
  var name =  value.split('1989raouf1989')[1];
  document.getElementById("comp_input").value = name;
  document.getElementsByName("bank_user")[0].value = name;
  document.getElementById('entreprise').value = id;
  //subject();

}

function ops_changed(value){
  document.getElementById("myDropdown").style.display ="none";
  document.getElementById("the_op").innerHTML = value;
  var id = value.split("1989raouf1989")[0];
  var ar = value.split('1989raouf1989')[1];
  var numero =  value.split('1989raouf1989')[2];
  document.getElementById("op_input").value = numero;
  console.log(id+" "+ar);
  document.getElementById('id_op').value = id;
  document.getElementById('intitule_ar').value = ar;
  //subject();

}

function numberWithCommas(x) {
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    if(!x.includes('.')){
      x += ".00";
    }
    else{
      xs = x.split(".");
      x = xs[0] +"."+ xs[1].substring(0,2).replaceAll(',','0');
    }

    return x;
}

</script>
@endsection

