@extends('layouts.master')
@section('style')
<style type="text/css">
input:read-only {
  background-color : white;
}
input:read-only:focus {
  background-color : white;
}
#engagement {
    border-collapse: collapse;
    border : 1px solid;
    width : 100%;
}
#engagement th {
    border : 1px solid;
    width: 23%;
    text-align: center;
    color: black;
    padding : 10px;
}
#engagement th:last-child {
    width: 31%;
}
#engagement td {
    border : 1px solid;
    /* font-weight: bold; */
    padding: 0;
    font-size : 13px;
    text-align: center;
}
.input_num {
  color: black;
  padding : 0;
  margin : 0;
  height : 35px;
  /* font-weight: bold; */
  padding: 0;
  font-size : 13px;
  text-align: center;
  border : none;
  background-color : white;
}
.input_num1 {
  color: black;
  padding : 0;
  margin : 0;
  height : 35px;
  font-weight: bold;
  padding: 0;
  font-size : 13px;
  text-align: center;
  border : none;
  background-color : white;
}

input[readonly] {
  background-color : white !important;
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
<div id="main" class="row main" style="margin-right : 0;">
	<div class="col-sm-offset-2 col-sm-8 portlets pull-right" lang="ar" dir="rtl" style="margin-right: 10%;"  >
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-right" style="font-size : 18px; font-weight : bold;">
                تعديل إلتزام
            </div>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" action="/update_eng" method="POST" >
	            	@csrf
                <input type="hidden" name="type" value="{{$eng->type}}">
                <input type="hidden" name="id" value="{{$eng->id}}" id="id">
                <input type="hidden" name="id_op" value="{{$eng->id_op}}" id="id_op">
				  
                
                <div id="myDropdown" style='display : none' ></div>
                <div class="form-group row">
                    <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">رقم العملية</label>
	                <div class="col-sm-9">
                        <input readonly value="{{$deal->numero}}" id="op_input" dir="ltr" style="text-align : right;" list="ops" class="form-control" id="numero_op_txt" onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
	                </div>
                </div><br>
                <div class="form-group row">
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> تعيين العملية</label>
	                <div class="col-sm-9">
	                  <input readOnly ="" value="{{$deal->intitule_ar}}" type="text" class="form-control" id="intitule_ar" name="intitule_ar">
	                </div>
                </div><br>
                
                <div class="form-group row">
                  <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">رقم البطاقة</label>
	                <div class="col-sm-9">
	                  <input dir="ltr" style="text-align : right" required="" value="{{$eng->numero_fiche}}"  type="text" class="form-control" id="numero_fiche" name="numero_fiche">
	                </div>
                </div><br>
                @if($eng->type=="eng")
                <input type='hidden' name="deal" value="{{$deal->id_deal}}">
                <div class="form-group row">
                    <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> المقاول</label>
	              
	                <div class="col-sm-9">
                        <input id="comp_input" readonly value="{{$deal->name}}" class="form-control" > 
	                </div>

                </div><br>
                @endif
                <div class="form-group row">
                  <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">  موضوع الالتزام </label>
	                <div class="col-sm-9">
	                  <textarea style="resize: none; color: black;" rows="5" required=""
                       class="form-control" name="real_sujet" id="real_sujet" >{{$eng->real_sujet}}</textarea>
	                </div>
                </div><br>
                
             
            <table id="engagement" dir="ltr">
                <tr>
                    <th>الرصيد المتبقي</th>
                    <th> الإلتزام المقترح </th>
                    <th>   الرصيد الأولي  </th>
                    <th> مجموع الإلتزامات السابقة </th>
                    <th>     رخصة الإلتزام المفتوحة / المعدلة    </th>
                    <th>     الإسناد الميزانياتي    </th>
                </tr>  
                @foreach($titres as $titre)
                <tr style="font-weight : bold">
                <td><input readonly name="montant_2_{{$titre->id_titre}}" id="montant_2_{{$titre->id_titre}}" readonly 
                        style="padding : 0; text-align: center;" value="0.00" 
                        class="input_num1 form-control" type="text" 
                        pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" >
                  </td>
                  <td><input readonly name="montant_{{$titre->id_titre}}" id="montant_{{$titre->id_titre}}"  
                        style="padding : 0; text-align: center;" value="0.00"
                        class="input_num1 form-control" type="text" 
                        pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" >
                  </td>
                  <td><input readonly name="montant_1_{{$titre->id_titre}}" id="montant_1_{{$titre->id_titre}}" 
                        style="padding : 0; text-align: center;" value="0.00"
                        class="input_num1 form-control" type="text" 
                        pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" >
                  </td>
                  <td><input readonly name="cumul_{{$titre->id_titre}}" id="cumul_{{$titre->id_titre}}" 
                        style="padding : 0; text-align: center;" value="0.00"
                        class="input_num1 form-control" type="text" 
                        pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" >
                  </td>
                  <td><input readonly name="AP_{{$titre->id_titre}}" id="AP_{{$titre->id_titre}}" 
                        style="padding : 0; text-align: center;" value="0.00"
                        class="input_num1 form-control" type="text" 
                        pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" >
                  </td>
                  <td dir="rtl" id="titre_{{$titre->id_titre}}">
                    <span style="cursor : pointer" onclick="show_sous('{{$titre->id_titre}}')">
                    <i class="bi bi-chevron-down"></i>
                    {{$titre->code}} {{$titre->definition}}</span>
                  </td>
                </tr>
                <tbody id="sous_{{$titre->id_titre}}" style="display : none"> 
                  @foreach($titre->sous_titres as $sous_titre)
                  <tr>
                    <td><input name="montant_2_sous_{{$sous_titre->id_titre}}" id="montant_2_sous_{{$sous_titre->id_titre}}" 
                          style="padding : 0; text-align: center;" readonly
                          class="input_num form-control" type="text" 
                          pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" >
                    </td>
                    <td><input name="montant_sous_{{$sous_titre->id_titre}}" id="montant_sous_{{$sous_titre->id_titre}}"  
                          style="padding : 0; text-align: center;" 
                          class="input_num form-control" type="text" 
                          pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" >
                    </td>
                    <td><input  name="montant_1_sous_{{$sous_titre->id_titre}}" id="montant_1_sous_{{$sous_titre->id_titre}}" 
                          style="padding : 0; text-align: center;" readonly
                          class="input_num form-control" type="text" 
                          pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" >
                    </td>
                    <td><input  name="cumul_sous_{{$sous_titre->id_titre}}" id="cumul_sous_{{$sous_titre->id_titre}}" 
                          style="padding : 0; text-align: center;" readonly
                          class=" form-control" type="text" 
                          pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" >
                    </td>
                    <td><input  name="AP_sous_{{$sous_titre->id_titre}}" id="AP_sous_{{$sous_titre->id_titre}}" 
                          style="padding : 0; text-align: center;" readonly
                          class=" form-control" type="text" 
                          pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" >
                    </td>
                    <td dir="rtl">
                      <span>{{$sous_titre->code}} {{$sous_titre->definition}}</span>
                    </td>
                  </tr>
                  @endforeach
             </tbody>
                @endforeach
            </table>
            <br>
            <br>

              <div class="form-group row">
                <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">   رقم التأشيرة   </label>
                <div class="col-sm-9">
                  <input name="num_visa" value="{{$eng->num_visa}}" type="text" class="form-control" id="numero" name="num_visa">
                </div>
              </div><br>
              <div class="form-group row">
                <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> تاريخ التأشيرة   </label>
                <div class="col-sm-9">
                  <input name="date_visa" value="{{$eng->date_visa}}" type="date" class="form-control" id="numero" name="date_visa">
                </div>
              </div><br>
	              <!-- Buttons -->
	              <div class="form-group row" align="center">
	                <!-- Buttons -->
	                <div class="col-sm-offset-2 col-sm-9">
	                  <button type="submit" class="btn btn-primary">حفــــظ</button>
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

<div id="the_op" style="display: none;">{{$the_op}}</div>


@endsection

@section('js_scripts')

<script type="text/javascript">

document.onclick= function(event) {
	if(event.srcElement.id != "op_input"){
		document.getElementById('myDropdown').style.display = "none";
	}
	
};
</script>
<script type="text/javascript">
  window.onload = function(){
    var titres = "{{json_encode($eng->titres)}}";
    titres = titres.split("&quot;").join('"');
    titres = JSON.parse(titres);
    set_values(titres);
    //document.getElementById('loading').style.display = "none";

    
  };
  
</script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function set_values(titres){
  for(var i = 0; i< titres.length; i++){
    var montant_2 = document.getElementById("montant_2_"+titres[i].id_titre);
    var montant = document.getElementById("montant_"+titres[i].id_titre);
    var montant_1 = document.getElementById("montant_1_"+titres[i].id_titre);
    var cumul = document.getElementById("cumul_"+titres[i].id_titre);
    var AP = document.getElementById("AP_"+titres[i].id_titre);
    if(montant_2){
      montant_2.value = titres[i].sums.montant_2;
    }
    if(montant){
      montant.value = titres[i].sums.montant;
    }
    if(montant_1){
      montant_1.value = titres[i].sums.montant_1;
    }
    if(cumul){
      cumul.value = titres[i].sums.cumul;
    }
    if(AP){
      AP.value = titres[i].sums.AP;
    }
    var rebriques = titres[i].rebriques;
    for(var j = 0; j< rebriques.length; j++){
      console.log("sous_montant_2_"+rebriques[j].id_titre);
      var sous_montant_2 = document.getElementById("montant_2_sous_"+rebriques[j].id_titre);
      var sous_montant = document.getElementById("montant_sous_"+rebriques[j].id_titre);
      var sous_montant_1 = document.getElementById("montant_1_sous_"+rebriques[j].id_titre);
      var sous_cumul = document.getElementById("cumul_sous_"+rebriques[j].id_titre);
      var sous_AP = document.getElementById("AP_sous_"+rebriques[j].id_titre);
      if(sous_montant_2){
        sous_montant_2.value = rebriques[j].sous_montant_2;
      }
      if(sous_montant){
        sous_montant.value = rebriques[j].sous_montant;
      }
      if(sous_montant_1){
        sous_montant_1.value = rebriques[j].sous_montant_1;
      }
      if(sous_cumul){
        sous_cumul.value = rebriques[j].sous_cumul;
      }
      if(sous_AP){
        if (rebriques[j].sous_AP !== null ) {
          const t = {'id' : 'AP_sous_'+rebriques[j].sous_titre, 'value' : rebriques[j].sous_AP - rebriques[j].sous_montant};
          olds.push(t); 
        }else{
          const t = {'id' : 'AP_sous_'+rebriques[j].sous_titre, 'value' : 0};
          olds.push(t);
        }
        sous_AP.value = rebriques[j].sous_AP;
      }
    }
  }
  document.getElementById('loading').style.display = "none";
}
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
              //console.log(response);
            url = "";
              for(var i =0; i< response.length; i++){
                var e = response[i];
                url +='<span style="color: black; cursor: pointer;" class="comps_clss" onclick="comps_changed(\''+e.id+'1989raouf1989'+e.name+'\')">'+e.name+'</span>';
                
              }
              document.getElementById('es').innerHTML = url;
            },
            error:function(response) {
            //console.log(response);
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

function ops_changed(value){
  document.getElementById("myDropdown").style.display ="none";
  document.getElementById("the_op").innerHTML = value;
  var type = "{{ $type }}";
  var id = value.split("1989raouf1989")[0];
  var ar = value.split('1989raouf1989')[1];
  var numero =  value.split('1989raouf1989')[2];
  document.getElementById("op_input").value = numero;
  //console.log(id+" "+ar);
  document.getElementById('id_op').value = id;
  document.getElementById('intitule_ar').value = ar;
  fiche_num(id);
  var type = "{{$type}}";
  if(type=="eng"){
    //subject();
  }
  
  var url = "/get_last/"+id;
  $.ajax({
      url: url,
      type:"GET", 
      cache: false,
      success:function(response) {
      //console.log(response);
      set_old(response);
      document.getElementById('loading').style.display = "none";
      somme();
      //subject();
      //fiche_num(response);
      },
      error:function(response) {
      //console.log(response);
      },

    });
}

function show_sous(id){
  c = document.getElementById('sous_'+id);
  if(c.style.display == "contents"){
    c.style.display = "none";
  }else{
    c.style.display = "contents";
  }
}


function fiche_num(id){
  var type = "{{$type}}";
  if(type == ""){
    
  }else{
    var url = "/get_last_fiche/"+id;
    //console.log(url);
    $.ajax({
        url: url,
        type:"GET", 
        cache: false,
        success:function(response) {
          var value = response;
          if(value[0] != null){
            var old = value[0].numero_fiche;
            old = old.split("/")[1];
          }else{
            var old = "0";
          }
          
          var nv = ""+(parseInt(old) + 1);
          if(nv.length == 1){
            nv = "0"+nv;
          }
          var new_num = new Date().getFullYear()+"/"+nv;
          //console.log(new_num);
          document.getElementsByName('numero_fiche')[0].value = new_num;
        },
        error:function(response) {
        //console.log(response);
        },

      });
  }
  
}
var olds = [];
function set_old(last){
  if(last[0] != null){
    if(last[0].rebriques != null){
      reb = last[0].rebriques;
      console.log(reb);
      for(var i= 0; i< reb.length; i++){
        if (reb[i].sous_AP !== null ) {
          const t = {'id' : 'AP_sous_'+reb[i].sous_titre, 'value' : reb[i].sous_AP};
          olds.push(t);
          document.getElementById('AP_sous_'+reb[i].sous_titre).value = reb[i].sous_AP; 
        }else{
          const t = {'id' : 'AP_sous_'+reb[i].sous_titre, 'value' : 0};
          olds.push(t);
          document.getElementById('AP_sous_'+reb[i].sous_titre).value = "0.00"; 
        }
        if (reb[i].montant_2 !== null) {
          if(reb[i].sous_cumul !== null && reb[i].sous_montant !== null){
            document.getElementById('cumul_sous_'+reb[i].sous_titre).value = reb[i].real_cumul;
          }else{
            document.getElementById('cumul_sous_'+reb[i].sous_titre).value = "0.00";
          }
          document.getElementById('montant_1_sous_'+reb[i].sous_titre).value = reb[i].sous_montant_2; 
          document.getElementById('montant_2_sous_'+reb[i].sous_titre).value = reb[i].sous_montant_2; 
          
        }else{
          document.getElementById('cumul_sous_'+reb[i].sous_titre).value = "0.00";
          document.getElementById('montant_1_sous_'+reb[i].sous_titre).value = "0.00"; 
          document.getElementById('montant_2_sous_'+reb[i].sous_titre).value = "0.00"; 
        }
        document.getElementById('montant_sous_'+reb[i].sous_titre).value = 0.00;
      }
    }
    
  }
  console.log(olds);
}

function numberWithCommas(x) {
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(!x.includes('.')){
      x += ".00";
    }
    else{
      xs = x.split(".");
      x = xs[0] +"."+ xs[1].substring(0,2).replaceAll(',','0');
    }

    return x;
}
$( ".input_num" ).on('keyup', function () {
    somme(); 
});

function somme(){
  var type = "{{ $type }}";


  var titres = '{{json_encode($titres)}}';
  titres = titres.split("&quot;").join('"');
  titres = JSON.parse(titres);
  for(var i =0; i< titres.length; i++){
    var  S_ap = 0.00;
    var  S_c = 0.00;
    var  S_m2 = 0.00;
    var  S_m = 0.00;
    var  S_m1 = 0.00;
    //console.log(titres[i]);
    var sous_titres = titres[i].sous_titres;
    for(var j =0; j< sous_titres.length; j++){
      var  l = 0.00;
      sous_AP = document.getElementById('AP_sous_'+sous_titres[j].id_titre);
      sous_cumul = document.getElementById('cumul_sous_'+sous_titres[j].id_titre);
      sous_montant_1 = document.getElementById('montant_1_sous_'+sous_titres[j].id_titre);
      sous_montant = document.getElementById('montant_sous_'+sous_titres[j].id_titre);
      sous_montant_2 = document.getElementById('montant_2_sous_'+sous_titres[j].id_titre);
      if(!isNaN(sous_montant.value) && sous_montant.value != ""){
        //console.log("yes ! "+sous_montant.value);
        if(isNaN(sous_montant_1.value) || sous_montant_1.value =="" ){
          sous_montant_1.value = 0.00;
        }
        if(isNaN(sous_cumul.value) || sous_cumul.value =="" ){
          sous_cumul.value = 0.00;
        }
        if(isNaN(sous_montant_2.value) || sous_montant_2.value =="" ){
          sous_montant_2.value = 0.00;
        }
        if(type == "reevaluation" || type == "decision"){
          the_AP = olds.find(x => x.id == 'AP_sous_'+sous_titres[j].id_titre);
          
          //console.log(the_AP);
          if(the_AP){
            if(isNaN(the_AP.value) || the_AP.value =="" ){
              the_AP.value = 0.00;
            }
            Ap_value = the_AP.value;
          }else{
            Ap_value = 0;
          }
          
          sous_AP.value = parseFloat(Ap_value) + parseFloat(sous_montant.value);
        }
        
      }
      if(type == "decision" || type == "reevaluation"){
        l = parseFloat(sous_montant_1.value) + parseFloat(sous_montant.value);
      }else{  
        l = parseFloat(sous_montant_1.value) - parseFloat(sous_montant.value);  
      }
      if(l<0 ){
        Swal.fire({
          title: 'حذار ! الإلتزام المقترح اكبر من الرصيد الأولي',
          icon: 'error',
        });
      }    
      
      if(!isNaN(l)){
        sous_montant_2.value = l;
      }

      if(!isNaN(sous_AP.value) && sous_AP.value != ""){
        S_ap+= parseFloat(sous_AP.value);
      }
      if(!isNaN(sous_cumul.value) && sous_cumul.value != ""){
        S_c+= parseFloat(sous_cumul.value);
      }
      if(!isNaN(sous_montant_1.value) && sous_montant_1.value != ""){
        S_m1+= parseFloat(sous_montant_1.value);
      }
      if(!isNaN(sous_montant.value) && sous_montant.value != ""){
        S_m+= parseFloat(sous_montant.value);
      }
      if(!isNaN(sous_montant_2.value) && sous_montant_2.value != ""){
        S_m2+= parseFloat(sous_montant_2.value);
      }
      
    }
    document.getElementById('AP_'+titres[i].id_titre).value = S_ap;
    document.getElementById('cumul_'+titres[i].id_titre).value = S_c;
    document.getElementById('montant_1_'+titres[i].id_titre).value = S_m1;
    document.getElementById('montant_'+titres[i].id_titre).value = S_m;
    document.getElementById('montant_2_'+titres[i].id_titre).value = S_m2;
  }
  
}

</script>
@endsection

