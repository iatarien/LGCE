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
#engagement td:nth-last-child(3) {
    padding : 0;
}
#engagement td:last-child {
    display: none;
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
	<div class="col-lg-10 portlets pull-right" lang="ar" dir="rtl" style="margin-right: 10%;"  >
	    <div class="panel panel-default">
	      <div class="panel-heading">
            <div class="pull-right">
                تعديل بطاقة الدفع
            </div>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body" >
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" action="../update_fiche_pay" method="POST" onsubmit="event.preventDefault(); return change_nulls(this);">
	            	@csrf
                <input type="hidden" name="id" value="{{ $pay->id}}">
                <input type="hidden" name="id_reb" value="{{ $pay0->id}}">
                

	               
	              <div class="form-group" style="display : none;">
	                <div class="col-lg-10">
	                  <input required="" value="{{ $pay->fiche_pay }}" type="text" class="form-control" id="fiche_pay" name="fiche_pay">
	                </div>
                    <label class="control-label col-lg-2" style="text-align : right; font-weight: bold;" for="title">رقم البطاقة</label>
	              </div>
            <table id="engagement" class="col-lg-12" dir="ltr" style="display : none;">
                <tr>
                    <th>الملاحظات</th>
                    <th> المبالغ  </th>
                    <th style="border-right : none; text-align : right;" >     العناوين    </th>
                    <th style="border : none;"></th>
                </tr>  
                <tr>	
                    <td rowspan="19"></td>    
                    <td style="padding : 0"><input value="@if($pay0->etude != 0 and $pay0->etude != NULL){{number_format((float)$pay0->etude, 2, '.', ' ')}}@endif" name="etude"  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$"></td>
                    <td>   الدراســــــات و/أو الهندســــــة  </td>
                    <td>01</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->genie_civil != 0 and $pay0->genie_civil != NULL){{number_format((float)$pay0->genie_civil, 2, '.', ' ')}}@endif" name="genie_civil" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>    البناء و ما يربط به  هندسة مدنية    </td>
                    <td>02</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->travaux_publics != 0 and $pay0->travaux_publics != NULL){{number_format((float)$pay0->travaux_publics, 2, '.', ' ')}}@endif" name="travaux_publics" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>   الأشــــــغال العمــــــومية   </td>
                    <td>03</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->equipements != 0 and $pay0->equipements != NULL){{number_format((float)$pay0->equipements, 2, '.', ' ')}}@endif" name="equipements" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>    ألات و تجهيـــــــــــــــــــــــزات   </td>
                    <td>04</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->materiel_transport != 0 and $pay0->materiel_transport != NULL){{number_format((float)$pay0->materiel_transport, 2, '.', ' ')}}@endif" name="materiel_transport" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>  عتاد النقــــــل ا ولتفريـــــــغ  </td>
                    <td>05</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->formation != 0 and $pay0->formation != NULL){{number_format((float)$pay0->formation, 2, '.', ' ')}}@endif" name="formation" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>    التكويــــــــــــــــــــــــــــــــن   </td>
                    <td>06</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->travaux_exterieurs != 0 and $pay0->travaux_exterieurs != NULL){{number_format((float)$pay0->travaux_exterieurs, 2, '.', ' ')}}@endif" name="travaux_exterieurs" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>  تقديم الخدمـــــات الخارجيـــــة    </td>
                    <td>07</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->publicite != 0 and $pay0->publicite != NULL){{number_format((float)$pay0->publicite, 2, '.', ' ')}}@endif" name="publicite" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>الإشهــــــــــــــــــــــــــــار </td>
                    <td>08</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->fonds != 0 and $pay0->fonds != NULL){{number_format((float)$pay0->fonds, 2, '.', ' ')}}@endif" name="fonds" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td> مال متداول إضافي </td>
                    <td>09</td>
                </tr>
                <tr>	
                  <td><input value="@if($pay0->env != 0 and $pay0->env != NULL){{number_format((float)$pay0->env, 2, '.', ' ')}}@endif" name="env" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                  <td> المنشات الأساسية المحيطة  </td>
                  <td>10</td>
                </tr>
                <tr>	
                  <td><input value="@if($pay0->terrain != 0 and $pay0->terrain != NULL){{number_format((float)$pay0->terrain, 2, '.', ' ')}}@endif" name="terrain" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>الأرضية </td>
                    <td>11</td>
                </tr>
                <tr>	
                  <td><input value="@if($pay0->interets != 0 and $pay0->interets != NULL){{number_format((float)$pay0->interets, 2, '.', ' ')}}@endif" name="interets" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>الفوائد الاضافية </td>
                    <td>12</td>
                </tr><tr>	
                    <td><input value="@if($pay0->douane != 0 and $pay0->douane != NULL){{number_format((float)$pay0->douane, 2, '.', ' ')}}@endif" name="douane" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>حقوق الجمرك و الرسوم </td>
                    <td>13</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->stock != 0 and $pay0->stock != NULL){{number_format((float)$pay0->stock, 2, '.', ' ')}}@endif" name="stock" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>                    
                    <td>المخزون الأدنى </td>
                    <td>14</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->suiv != 0 and $pay0->suiv != NULL){{number_format((float)$pay0->suiv, 2, '.', ' ')}}@endif" name="suiv" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>                    
                    <td> متــــابعة </td>
                    <td>15</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->tech != 0 and $pay0->tech != NULL){{number_format((float)$pay0->tech, 2, '.', ' ')}}@endif" name="tech" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>                    
                    <td> مـراقبة تقنيــة </td>
                    <td>16</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->labo != 0 and $pay0->labo != NULL){{number_format((float)$pay0->labo, 2, '.', ' ')}}@endif" name="labo" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>                    
                    <td> مخبـــــر </td>
                    <td>17</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->montant_libre != 0 and $pay0->montant_libre != NULL){{number_format((float)$pay0->montant_libre, 2, '.', ' ')}}@endif" name="montant_libre" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>   مبلـــــــــــــــــــــــغ غير موزع  </td>
                    <td>18</td>
                </tr>
                <tr>	
                    <td><input value="@if($pay0->total != 0 and $pay0->total != NULL){{number_format((float)$pay0->total, 2, '.', ' ')}}@endif" name="total" id="total" readonly  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td style="border : none; text-align: right;" >المجمـــــــــــــــوع</td>
                    <td style="border : none;" ></td>
                </tr>
            </table>
            <br><br><br>
            <input type="hidden" name="to_pay" value="{{ $pay->to_pay }}" >
            <br>
            <div class="form-group">
              <div class="col-lg-10">
              <input dir="ltr" style="text-align : right; color : black;" required="" value="{{ $pay0->cumul_old }}" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" class="form-control" id="cumul_old" name="cumul_old">
              
              </div>
                <label class="control-label col-lg-2" style="text-align : right; font-weight: bold;" for="title"> مجموع الدفعات السابقة </label>
            </div>
            <br>
	              <!-- Buttons -->
	              <div class="form-group" align="center">
	                <!-- Buttons -->
	                <div class="col-lg-offset-2 col-lg-9">
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



@endsection

@section('js_scripts')
<script type="text/javascript">
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      var rebriques = ['etude','genie_civil','travaux_publics','equipements','materiel_transport','formation','travaux_exterieurs','publicite','fonds','env','terrain','interets','douane','stock','suiv','tech','labo','montant_libre','total'];
      var index = rebriques.indexOf(event.srcElement.name);
      if(index < rebriques.length-1){
        index += 1;
      }
      var ele = rebriques[index];
      document.getElementsByName(ele)[0].focus();
      document.getElementsByName(ele)[0].select();
      console.log(event.srcElement.name);
    }
  });
});

</script>
<script type="text/javascript">
  window.onload = function(){
    document.getElementById('loading').style.display = "none";
    fiche_num();
  };
  
</script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function change_nulls(form){
  var inputs = document.getElementsByClassName("input_num");
    for(var i = 0;  i < inputs.length; i++){
      if(inputs[i].value ==""){
        inputs[i].value = 0.00;
      }else{
        inputs[i].value = inputs[i].value.replaceAll(',','');
      }
    }
    form.submit();
    return true;

}
function fiche_num(){
    var id = "{{$pay->id}}";
    var fiche = "{{$pay->fiche_pay}}";
    if(fiche == null || fiche == ""){
      var url = "/get_last_fiche_pay/"+id;
      console.log(url);
      $.ajax({
          url: url,
          type:"GET", 
          cache: false,
          success:function(response) {
            var value = response;
            console.log(value);
            if(value[0] != null){
              var old = value[0].fiche_pay;
              old = old.split("/")[1];
            }else{
              var old = "0";
            }
            
            var nv = ""+(parseInt(old) + 1);
            if(nv.length == 1){
              nv = "00"+nv;
            }else if(nv.length == 2){
              nv = "0"+nv;
            }
            var new_num = new Date().getFullYear()+"/"+nv;
            console.log(new_num);
            document.getElementsByName('fiche_pay')[0].value = new_num;
          },
          error:function(response) {
          console.log(response);
          },

      });
    }
    
}

function numberWithCommas(x) {
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(!x.includes('.')){
      x += ".00";
    }
    return x;
}

function somme(){
  var rebriques = ['etude','genie_civil','travaux_publics','equipements','materiel_transport','formation','travaux_exterieurs','publicite','fonds','env','terrain','interets','douane','stock','suiv','tech','labo','montant_libre','total'];
  var S = 0;
    for(var i = 0;  i < rebriques.length -1; i++){
      var l = null;
      var input = document.getElementsByName(rebriques[i])[0];
      var num = 0;
      if(input.value !="" && input.value !="-"){
        var clean = input.value.replaceAll(",","");
        num = parseFloat(clean);
        
        S = S + num;
        //console.log("num " +num+", clean "+clean+", S "+S );
        var txt = S.toLocaleString("en");
        if(!txt.includes(".")){
          txt += ".00";
        }
        document.getElementById('total').value = txt;
      }
    
    }
    

    
}
$( ".input_num" ).on('keyup', function () {
    
    if(this.value !="" && !this.value.includes(".") && !this.value == "-"){
        var clean = this.value.replaceAll(",","");

        //console.log("num " +num+", clean "+clean+", txt "+txt );
        this.value = txt;
    }
    somme();
    
});



</script>
@endsection

