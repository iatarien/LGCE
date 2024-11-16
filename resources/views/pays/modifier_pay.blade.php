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
<div id="main" class="row main">
	<div class="col-lg-12 portlets pull-right" lang="ar" dir="rtl" >
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-right">
                تعديل دفع
            </div>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body">
	        <div class="padd">
	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" action="../update_pay" method="POST" onsubmit="event.preventDefault(); return change_nulls(this);">
	            	@csrf
                <input type="hidden" name="id" value="{{$pay->id}}" id="id">
                <input type="hidden" name="id_reb" value="{{$pay->rebrique}}" id="id">
                <div class="form-group">
	                <div class="col-lg-8">
	                  <input value="{{$pay->travaux_num}}"  type="text" class="form-control" id="travaux_num" name="travaux_num">
	                </div>
                  <select class="form-control col-lg-4" name="travaux_type" style="width: 33%;">
                      <option selected style="visibility: hidden;" value="{{$pay->travaux_type}}">  {{$pay->travaux_type}} رقم</opton>
                      <option value="وضعية الأشغال" > وضعية الأشغال رقم </option>
                      <option value="مذكرة أتعاب" > مذكرة أتعاب رقم </option>
                      <option value="فـــاتورة" >  فاتورة  </option>
                  </select>
	              </div>
                <div class="form-group">
	                <div class="col-lg-8">
	                  <input required="" value="{{$pay->date_pay}}" type="date" class="form-control" id="date_pay" name="date_pay">
	                </div>
                    <label  class="control-label col-lg-4" style="text-align : right; font-weight: bold;" for="title">  الأشغال المنفذة و المصاريف التي دفعت بتاريخ </label>
	              </div>
                @if($ville_fr =="Mila")
                <div class="form-group">
	                <div class="col-lg-8">
	                  <input required=""  type="text" class="form-control" id="fiche_pay" name="fiche_pay" value="{{$pay->fiche_pay}}">
	                </div>
                    <label class="control-label col-lg-4" style="text-align : center; font-weight: bold;" for="title">   رقم  الحساب المؤقت</label>
	              </div>
                @endif
	              <div class="form-group">
	                <div class="col-lg-8">
	                  <input required="" value="{{$pay->num}}"  type="text" class="form-control" id="num" name="num">
	                </div>
                    <label class="control-label col-lg-4" style="text-align : center; font-weight: bold;" for="title"> رقم بطاقة الدفع</label>
	              </div>

                <div class="form-group">
	                <div class="col-lg-8">
	                  <input   type="text" class="form-control" id="num_mondat" name="num_mondat">
	                </div>
                    <label class="control-label col-lg-4" style="text-align : center; font-weight: bold;" for="title"> رقم حوالة الدفع</label>
	              </div>
                <div class="form-group">
	                <div class="col-lg-8">
	                  <input   type="date" class="form-control" id="date_mondat" name="date_mondat">
	                </div>
                    <label class="control-label col-lg-4" style="text-align : center; font-weight: bold;" for="title"> تاريخ حوالة الدفع</label>
	              </div>


               
                
                
          
             
            <table id="engagement" class="col-lg-12" dir="ltr">
                <tr>
                    <th> الباقي </th>
                    <th>  الاستقطاعات </th>
                    <th>    نفقات تمت  </th>
                    <th>     طبيعة النفقات    </th>
                </tr>  
                <tr>	
                    <td><input name="etude" readonly class="input_num form-control" class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="etude_cut" readonly @if($pay->etude_cut !=0) value="{{ $pay->etude_cut}}" @endif  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$"></td>
                    <td><input name="etude_done" @if($pay->etude_done != 0) value="{{ $pay->etude_done}}" @endif  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$"></td>
                    @if($ville_fr =="Mila")
                    <td>  أشغال منجزة  </td>
                    @else
                    <td>  أشغال تامة  </td>
                    @endif
                    <td>01</td>
                </tr>
                <tr>	
                    <td><input name="non_termine" readonly class="input_num form-control" class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="non_termine_cut" readonly  @if($pay->non_termine_cut !=0) value="{{ $pay->non_termine_cut}}" @endif  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="non_termine_done" @if($pay->non_termine_done != 0) value="{{ $pay->non_termine_done}}" @endif  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>   أشغال غير تامة    </td>
                    <td>02</td>
                </tr>
                <tr>	
                    <td><input name="extra" readonly class="input_num form-control" class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="extra_cut" readonly @if($pay->extra_cut !=0) value="{{ $pay->extra_cut}}" @endif  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="extra_done" @if($pay->extra_done != 0) value="{{ $pay->extra_done}}" @endif  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    @if($ville_fr =="Mila")
                    <td>  التسبيق على التموين </td>
                    @else
                    <td>    أعمال إضافية   </td>
                    @endif
                    <td>03</td>
                </tr>
                <tr>	
                    <td><input name="avan" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    
                    <td><input name="avan_cut" readonly @if($pay->avan_cut !=0) value="{{ $pay->avan_cut}}" @endif style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="avan_done" @if($pay->avan_done != 0) value="{{ $pay->avan_done}}" @endif  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td><td>    التسبيقات الجــــزافية   </td>
                    <td>04</td>
                </tr>
                @if($ville_fr =="Mila")
                <tr>	
                    <td><input name="rev1" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="rev1_cut" readonly style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="rev1_done" @if($pay->rev1_done != 0) value="{{ $pay->rev1_done }}" @endif style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>  مراجعة الاسعار    </td>
                    <td>05-A</td>
                </tr>
                <tr>	
                    <td><input name="rev2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="rev2_cut" readonly style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="rev2_done" @if($pay->rev2_done != 0) value="{{ $pay->rev2_done }}" @endif style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>    تحيين الاسعار</td>
                    <td>05-B</td>
                </tr>
                @endif
                <tr>	
                    <td><input name="revision" readonly class="input_num form-control" class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="revision_cut" readonly @if($pay->revision_cut !=0) value="{{ $pay->revision_cut}}" @endif style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="revision_done" @if($pay->revision_done != 0) value="{{ $pay->revision_done}}" @endif  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td>     مراجعة و تحيين الاسعار    </td>
                    <td>05</td>
                </tr>
                <tr>	
                  <td><input name="assurance" readonly class="input_num form-control" class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="assurance_cut" @if($pay->assurance_cut !=0) value="{{ $pay->assurance_cut}}" @endif style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="assurance_done" readonly @if($pay->assurance_done != 0) value="{{ $pay->assurance_done}}" @endif  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    @if($ville_fr =="Mila")
                    <td>  خصم الضمان </td>
                    @else
                    <td>  استقطاع الضمان %5  </td>
                    @endif
                    <td>06</td>
                </tr>
                <tr>	
                  <td><input name="avancement" readonly class="input_num form-control" class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="avancement_cut" @if($pay->avancement_cut !=0) value="{{ $pay->avancement_cut}}" @endif style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="avancement_done" readonly @if($pay->avancement_done != 0) value="{{ $pay->avancement_done}}" @endif  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    @if($ville_fr =="Mila")
                    <td>    تعويض التسبيقات الجــــزافية   </td>
                    @else
                    <td>    استرجاع التسبيقات الجــــزافية   </td>
                    @endif
                    <td>07</td>
                </tr>
                <tr>	
                  <td><input name="sanction" readonly class="input_num form-control" class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="sanction_cut" @if($pay->sanction_cut !=0) value="{{ $pay->sanction_cut}}" @endif style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="sanction_done" readonly @if($pay->sanction_done != 0) value="{{ $pay->sanction_done}}" @endif  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    @if($ville_fr =="Mila")
                    <td>    تعويض  على التموين   </td>
                    @else
                    <td>    العقوبــــــات    </td>
                    @endif
                    <td>08</td>
                </tr>
                <tr>	
                  <td><input name="total"  readonly class="input_num form-control" class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input name="total_cut" @if($pay->total_cut !=0) value="{{ $pay->total_cut}}" @endif id="total_cut" readonly class="input_num form-control"  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td><input name="total_done" @if($pay->total_done !=0) value="{{ $pay->total_cut}}" @endif id="total_done" readonly class="input_num form-control"  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td style=" text-align: right;" >المجمـــــــــــــــوع</td>
                    <td style="border : none;" ></td>
                </tr>
                <tr>	
                  <td><input @if($pay->old_payments !=0) value="{{ $pay->old_payments}}" @else value="0" @endif name="old_payments" required class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td colspan="3" style="border : none; text-align: right;" >اقتطاع النفقات السنوية الى السنوات الماضية</td>
                    <td></td>
                </tr>
                <tr>	
                  <td><input @if($pay->new_payment !=0) value="{{ $pay->new_payment}}" @endif name="new_payment" readonly class="input_num form-control" class="input_num form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td colspan="3" style="border : none; text-align: right;" >ما تبقى تسديده في السنة الحالية</td>
                    <td></td>
                </tr>
                <tr>	
                  <td><input @if($pay->this_year_cut !=0 and $pay->this_year_cut != NULL ) value="{{ $pay->this_year_cut}}" @endif name="this_year_cut"  class="input_num form-control" class="input_num form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td colspan="3" style="border : none; text-align: right;" >افتطاع مبلغ الدفعات المسلمة في السنة الحالية</td>
                    <td></td>
                </tr>
                <tr>	
                  <td><input @if($pay->to_pay !=0) value="{{ $pay->to_pay}}" @endif  name="to_pay" readonly class="input_num form-control" class="input_num form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td colspan="3" style="border : none; text-align: right;" >ما تبقى للدفع</td>
                    <td></td>
                </tr>
            </table>
            <br>
            <div class="form-group">
	                <div class="col-lg-8">
	                  <input value="{{ $pay->num_visa }}"  type="text" class="form-control" id="num_visa" name="num_visa">
	                </div>
                    <label  class="control-label col-lg-4" style="text-align : right; font-weight: bold;" for="title">  رقم تأشيرة الدفع   </label>
	          </div>
            <br>
            <div class="form-group">
	                <div class="col-lg-8">
	                  <input   value="{{ $pay->visa }}" type="date" class="form-control" id="visa" name="visa">
	                </div>
                    <label  class="control-label col-lg-4" style="text-align : right; font-weight: bold;" for="title">  تاريخ تأشيرة الدفع </label>
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
  window.onload = function(){
    document.getElementById('loading').style.display = "none";
    somme();
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

function numberWithCommas(x) {
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(!x.includes('.')){
      x += ".00";
    }
    return x;
}

function somme(){
  var rebriques = ['etude','non_termine','extra','avan','revision','assurance','avancement','sanction','total'];
  @if($ville_fr =="Mila")
  var rebriques = ['etude','non_termine','extra','avan','revision','rev1','rev2','assurance','avancement','sanction','total'];
  @endif
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

    var this_year_cut = document.getElementsByName('this_year_cut')[0].value;
    if(this_year_cut ==  null || this_year_cut ==  ""){
      this_year_cut = 0.00;
    }else {
      this_year_cut = this_year_cut.replaceAll(',',"");
    }
    new_payment = t - this_year_cut;
    txt = new_payment.toLocaleString("en");
    if(!txt.includes(".")){
        txt += ".00";
    }
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

