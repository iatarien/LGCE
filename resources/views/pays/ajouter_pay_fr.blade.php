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
    text-align: left;
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
<div id="main" class="row main">
	<div class="col-lg-12 portlets" lang="ar" dir="ltr"   >
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-left">
                Ajouter Paiement
            </div>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" action="/add_pay" method="POST" onsubmit="event.preventDefault(); return change_nulls(this);">
	            	@csrf
                <input type="hidden" name="id_eng" value="{{ $id_eng}}" id="id_eng">
                <input type="hidden" name="n" value="{{ $n}}" id="n">
                
                @if($n== 1)
                <div class="form-group">
                  <select class="form-control col-lg-2" name="travaux_type" style="width: 15.7%; margin-left : 1%;">
                      <option value="situation" > Situation</option>
                      <option value="facture" > Facture </option>
                    </select>
	                <div class="col-lg-8">
	                  <input  type="text" placeholder="des travaux N°" class="form-control" id="travaux_num" name="travaux_num">
	                </div>
                  
	              </div>
	              
                <div class="form-group">
                <label  class="control-label col-lg-2" style="text-align : left; font-weight: bold;" for="title"> 
                       Date : </label>
	                <div class="col-lg-8">
	                  <input required="" type="date" class="form-control" id="date_pay" name="date_pay">
	                </div>
                    
	              </div>
                @else
                  <div class="form-group">
                    <select class="form-control col-lg-2" name="travaux_type" style="width: 33%;">
                        <option value="situation" > Situation</option>
                        <option value="facture" > Facture </option>
                    </select>
                    <div class="col-lg-8">
                      <input  type="text" class="form-control" id="travaux_num" name="travaux_num">
                    </div>
                    
                  </div>
                  @for ($i = 1; $i <= $n; $i++)
                    <div class="form-group">
                        <label  class="control-label col-lg-4" style="text-align : left; font-weight: bold;" for="title"> Montant N° {{$i}} </label>
                    
                      <div class="col-lg-8">
                        <input required="" onkeyup="update_montant()" onchange="update_montant()" 
                        type="number" class="form-control" step="0.01" id="montant{{$i}}" 
                        placeholder="0.00">
                      </div>
                    </div>
                  @endfor
                  <div class="form-group">
                    <label  class="control-label col-sm-4" style="text-align : left; font-weight: bold;" for="title">  Total  </label>
                    <div class="col-sm-8">
                      <input readonly  required="" type="number" class="form-control" id="montant" name="montant" placeholder="0.00">
                    </div>
                  </div><br>
                  <div class="form-group">
                    <label  class="control-label col-lg-4" style="text-align : left; font-weight: bold;" for="title">  Date : </label>
                 
                    <div class="col-lg-8">
                      <input required="" type="date" class="form-control" id="date_pay" name="date_pay">
                    </div>
                  </div>
                @endif
                <div class="form-group" style="">
                <label class="control-label col-lg-2" style="text-align : left; font-weight: bold;" for="title">  Fiche paiement N°  </label>
               
	                <div class="col-lg-8">
	                  <input  value={{$num}} type="text" class="form-control" id="num" name="num">
	                </div>
                </div>
                <div class="form-group">
                <label class="control-label col-lg-2" style="text-align : left; font-weight: bold;" for="title"> N° Mandat </label>
	                <div class="col-lg-8">
	                  <input   type="text" class="form-control" id="num_mondat" name="num_mondat">
	                </div>
	              </div>
                <div class="form-group">
                <label class="control-label col-lg-2" style="text-align : left; font-weight: bold;" for="title"> Date Mandat </label>
	                <div class="col-lg-8">
	                  <input   type="date" class="form-control" id="date_mondat" name="date_mondat">
	                </div>
	              </div>
            <table id="engagement" class="col-lg-12" dir="rtl">
                <tr dir="ltr">
                    <th> Reste </th>
                    <th>  Retenues </th>
                    <th>   Montant  </th>
                    <th>   Nature des Dépénses    </th>
                </tr>  
                <tr dir="ltr">	
                    <td><input name="etude" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="etude_cut" readonly style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$"></td>
                    <td><input name="etude_done"  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$"></td>
                    <td>  Travaux complètes  </td>
                    <td>01</td>
                </tr>
                <tr dir="ltr">	
                    <td><input name="non_termine" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="non_termine_cut" readonly style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="non_termine_done" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td> Travaux non complètes    </td>
                    <td>02</td>
                </tr>
                <tr dir="ltr">	
                    <td><input name="extra" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="extra_cut" readonly style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="extra_done" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>    Travaux xupplémentaires   </td>
                    <td>03</td>
                </tr>
                <tr dir="ltr">	
                    <td><input name="avan" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="avan_cut" readonly style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="avan_done" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>    Avance Forfaitaire   </td>
                    <td>04</td>
                </tr>
                <tr dir="ltr">	
                    <td><input name="revision" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="revision_cut" readonly style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="revision_done" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>  Révision des prix    </td>
                    <td>05</td>
                </tr>
                
                <tr dir="ltr">	
                  <td><input name="assurance" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="assurance_cut" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="assurance_done" readonly style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>   Retenue de garantie %5  </td>
                    <td>06</td>
                </tr>
                <tr dir="ltr">	
                  <td><input name="avancement" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="avancement_cut" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="avancement_done" readonly style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>   Récupération des avances forfaitaires  </td>
                    <td>07</td>
                </tr>
                <tr dir="ltr">	
                  <td><input name="sanction" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="sanction_cut" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="sanction_done" readonly style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>    Sanctions    </td>
                    <td>08</td>
                </tr>
                <tr dir="ltr">	
                  <td><input name="total" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="total_cut" id="total_cut" readonly  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="total_done" id="total_done" readonly  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td style=" text-align : left;" >Total</td>
                    <td style="border : none;" ></td>
                </tr>
                <tr dir="ltr" style="display : none">	
                  <td><input name="old_payments" value ="0" required class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td colspan="3"  style="border : none; text-align : left;" >اقتطاع النفقات السنوية الى السنوات الماضية</td>
                    <td></td>
                </tr>
                <tr dir="ltr" style="display : none">	
                  <td><input name="new_payment" readonly class="input_num form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td colspan="3" style="border : none; text-align : left;" >ما تبقى تسديده في السنة الحالية</td>
                    <td></td>
                </tr>
                <tr dir="ltr" style="display : none">	
                  <td><input name="this_year_cut" readonly class="input_num form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td colspan="3" style="border : none; text-align : left;" >افتطاع مبلغ الدفعات المسلمة في السنة الحالية</td>
                    <td></td>
                </tr>
                <tr dir="ltr">	
                  <td><input name="to_pay" readonly class="input_num form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td colspan="3" style="border : none; text-align : center;" >  Montant à payer</td>
                    <td></td>
                </tr>
            </table>
            <br>
            <div class="form-group">
                    <label  class="control-label col-lg-4" style="text-align : left; font-weight: bold;" for="title"> N° de visa de paiement  </label>
	         
	                <div class="col-lg-8">
	                  <input   type="text" class="form-control" id="num_visa" name="num_visa">
	                </div>
            </div>
            <br>
            <div class="form-group">
                    <label  class="control-label col-lg-4" style="text-align : left; font-weight: bold;" for="title"> Date de Paiement   </label>
	          
	                <div class="col-lg-8">
	                  <input   type="date" class="form-control" id="visa" name="visa">
	                </div>
            </div>
            <br>
	              <!-- Buttons -->
	              <div class="form-group" align="center">
	                <!-- Buttons -->
	                <div class="col-lg-offset-2 col-lg-9">
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

function update_montant(){
    const n = "{{$n}}";
    var total = 0;
    for(i =1; i <= n; i++){
        const val = document.getElementById('montant'+i).value;
        console.log("val"+i +" "+val);

        if(val != null && val != ""){
            total += parseFloat(val);
            console.log("val"+i+" : "+val);
        }
    }
    total = total.toFixed(2);
    console.log("total : "+total);
    document.getElementById('montant').value = total;
}


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

function numberWithCommas(x) {
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(!x.includes('.')){
      x += ".00";
    }
    return x;
}

function somme(){
  var rebriques = ['etude','non_termine','extra','avan','revision','assurance','avancement','sanction','total'];
  var S_done = 0;
  var S_cut = 0;
    for(var i = 0;  i < rebriques.length -1; i++){
      var l = null;
      var cut = document.getElementsByName(rebriques[i]+"_cut")[0];
      var done = document.getElementsByName(rebriques[i]+"_done")[0];
      var num = 0;
      if(done.value !="" && done.value !="-"){
        var clean = done.value.replaceAll(",","");
        num = parseFloat(clean);
        l = l + num;
        
        S_done += num;
        //console.log("num " +num+", clean "+clean+", S "+S );
        var txt = S_done.toLocaleString("en");
        if(!txt.includes(".")){
          txt += ".00";
        }
        document.getElementById('total_done').value = txt;
      }
      if(cut.value !="" && cut.value !="-"){
        var clean = cut.value.replaceAll(",","");
        num = parseFloat(clean);
        l = l - num;
        
        S_cut += num;
        //console.log("num " +num+", clean "+clean+", S "+S );
        var txt = S_cut.toLocaleString("en");
        if(!txt.includes(".")){
          txt += ".00";
        }
        document.getElementById('total_cut').value = txt;
      }
      if(l != null){
          var txt = l.toLocaleString("en");
          if(!txt.includes(".")){
            txt += ".00";
          }
          document.getElementsByName(rebriques[i])[0].value = txt;
      }
    }

    var total_done = document.getElementsByName('total_done')[0].value;
    var total_cut = document.getElementsByName('total_cut')[0].value;
    var total = document.getElementsByName('total')[0];
    var t = 0;
    if(total_done != ""){
        var clean = total_done.replaceAll(",","");
        
        var num = parseFloat(clean);
        
        t= t + num;
    }
    if(total_cut != ""){
        var clean = total_cut.replaceAll(",","");
        
        var num = parseFloat(clean);
        t = t - num;
    
    }

    var txt = t.toLocaleString("en");
    if(!txt.includes(".")){
        txt += ".00";
    }
    total.value = txt; 


    var old_payments = document.getElementsByName('old_payments')[0].value;

    if(old_payments ==  null || old_payments ==  ""){
        old_payments = 0.00;
    }else {
        old_payments = old_payments.replaceAll(',',"");
    }
    var new_payment = t - old_payments;
    txt = new_payment.toLocaleString("en");
    if(!txt.includes(".")){
        txt += ".00";
    }
    document.getElementsByName('new_payment')[0].value = txt;
    document.getElementsByName('to_pay')[0].value = txt;
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

