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
	<div class="col-sm-10 portlets pull-right" lang="ar" dir="rtl" style="margin-right: 10%;"  >
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-right" style="font-size : 25px; font-weight : bold">
                @if($type == "marche")
                     صفقة
                @elseif($type =="convention")
                     عقد  
                @elseif($type =="devis")
                     كشف كمي و تقديري  
                @elseif($type =="facture")
                     فاتورة  
 
                @endif
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
                <input type="hidden" name="type" value="{{ $type}}">
                <input type="hidden" name="id_op" value="" id="id_op">

                <div class="form-group row">
                    <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">رقم العملية</label>
	                <div class="col-sm-7">
                        <input required id="op_input" dir="ltr" style="text-align : right;" list="ops" class="form-control" id="numero_op_txt" onclick="op_like(this.value)" onkeyup="op_like(this.value)" > 
                        <div id="myDropdown" class="dropdown-content" style="display: none;">
                            @foreach ($operations as $operation)
                            <?php $phrase = $operation->id."1989raouf1989".$operation->intitule_ar."1989raouf1989".$operation->numero;
                            $phrase = str_replace("'"," ",$phrase); ?>
                            <span dir="ltr" class="ops_clss" style="cursor: pointer; text-align : right;" 
                            onclick="ops_changed('{{$phrase}}')">{{ $operation->numero  }}</span>
                            @endforeach
                        </div>
	                </div>
                </div><br>
                <div class="form-group row">
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> تعيين العملية</label>
	                <div class="col-sm-7">
	                  <input readOnly ="" required="" type="text" class="form-control" id="intitule_ar" name="intitule_ar">
	                </div>
                </div><br>
                <input type="hidden" value="{{$type_ar}}" name="type_ar"/>
                  @if($number == 1)
                  <div class="form-group row">
                    <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">رقم  و تاريخ ال{{$type_ar}}</label>
	                <div class="col-sm-3">
                      <input  type="text" placeholder="رقم" class="form-control" id="deal_num" name="deal_num" style="color: black;" required>
                    </div>
                    <div class="col-sm-4">
                      <input  type="date" class="form-control" id="deal_date" name="deal_date" style="color: black;" >
                    </div> 
                  </div><br>
                  @if($ville_fr =="Mila")
                  <div class="form-group row">
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">  تاريخ الإمضاء </label>
	                <div class="col-sm-7">
	                  <input  type="date" class="form-control" id="signed" name="signed">
	                </div>
                  </div><br>
                  @endif
                  @if($ville_fr =="Mila")
                  <div class="form-group row">
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> تاريخ المصادقة من طرف لجنة الصفقات العمومية</label>
	                <div class="col-sm-7">
	                  <input type="date" class="form-control" id="visa_cmw" name="visa_cmw">
	                </div>
                  </div><br>
                  @endif
                  <div class="form-group row">
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">  قيمة ال{{$type_ar}}</label>
	                <div class="col-sm-7">
	                  <input  required="" type="number" class="form-control" step="0.01" id="montant" name="montant" placeholder="0.00">
	                </div>
                </div><br>
                  @else
                  <input type="hidden" value="" name="deal_date"/>
                  @for ($i = 1; $i <= $number; $i++)
                  <div class="form-group row">
                    <label class="control-label col-sm-2" style="text-align : right; font-weight: bold; font-size : 14px;" for="title">رقم  و قيمة ال{{$type_ar}} رقم {{$i}}</label>
	                <div class="col-sm-3">
                      <input onkeyup="update_facts()" type="text" placeholder="رقم" class="form-control" id="deal_num{{$i}}"  style="color: black;" required>
                    </div>
                    <div class="col-sm-4">
	                  <input  required="" onkeyup="update_montant()" onchange="update_montant()" type="number" class="form-control" step="0.01" id="montant{{$i}}" placeholder="0.00">
                    </div>
                  </div><br>
                  @endfor
                  <div class="form-group row">
                    <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">الفاتورات</label>
	                <div class="col-sm-7">
                      <input readonly  type="text" placeholder="رقم" class="form-control" id="deal_num" name="deal_num" style="color: black;" required>
                    </div>
                  </div><br>
                  
                  <div class="form-group row">
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">  مجموع  الفواتير</label>
	                <div class="col-sm-7">
	                  <input readonly  required="" type="number" class="form-control" id="montant" name="montant" placeholder="0.00">
	                </div>
                </div><br>
                  @endif

                <div class="form-group row">
                    <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> الشركة</label>
	              
	                <div class="col-sm-7">
                        <input id="comp_input"  class="form-control" onclick="comp_like(event,this.value)" onkeyup="comp_like(event,this.value)" > 
                        <div id="myDropdown_comp" class="dropdown-content" style="display: none;">
                            <input type="hidden" required id="entreprise" name="entreprise_id" >
                            <div id="es">
                            @foreach ($entreprises as $e)
                            <?php $phrase = $e->id."1989raouf1989".$e->name."1989raouf1989".$e->bank_acc."1989raouf1989".$e->bank.
                            "1989raouf1989".$e->bank_user."1989raouf1989".$e->bank_agc;
                            
                            $phrase = str_replace("'"," ",$phrase); ?>
                                <span  style="color: black; cursor: pointer;" class="comps_clss" 
                                onclick="comps_changed('{{$phrase}}')">
                                {!! $e->name !!}</span>
                            @endforeach
                            </div>
                        </div>
	                </div>
                    <div class="col-sm-1">
                        <button onclick="add_e()" type="button" class="btn btn-sm btn-primary">+</button>
	                </div>
                </div><br>
 
                <div class="form-group row">
                    <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">  الحصة </label>
	            
                    <div class="col-sm-7">
                        <textarea  style="resize: none; color: black;" rows="5" required="" class="form-control" name="lot" id="sujet" ></textarea>
                    </div>
                </div><br>


                <div class="form-group row">
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> الحساب البنكي </label>
	                <div class="col-sm-7">
	                  <input required="" type="text" style="color: black;" class="form-control" name="bank_acc" id="bank_acc">
	                </div>
                     </div><br>
                <div class="form-group row">
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">المفتوح بإسم</label>
	                <div class="col-sm-7">
	                  <input  required="" type="text" style="color: black;" class="form-control" id="bank_user" name="bank_user">
	                </div>
                    </div><br>
                <div class="form-group row">
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">البنك</label>
	                <div class="col-sm-7">
	                  <select required="" style="color: black;" class="form-control" name="bank">
                    <option selected id="bank" style="visibility : hidden"></option>
                    @foreach($banques as $banque)
                      <option value="{{ $banque->nom }}" >{{ $banque->nom }} - {{ $banque->abr }}</option>
                    @endforeach
                    </select>
	                </div>
                     </div><br>
                    <div class="form-group row">
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">الوكالة</label>
	                <div class="col-sm-7">
	                  <input required="" type="text" style="color: black;" class="form-control" id="bank_agc" name="bank_agc">
	                </div>
                    </div><br>
                    @if($type !="facture" and $type !="devis")
                    <div class="form-group row">
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">مدة ال{{$type_ar}}  ( أيام )</label>
	                <div class="col-sm-7">
	                  <input required="" type="number" placeholder="أيام 0"   style="color: black;" class="form-control" name="duree">
	                </div>
                    </div>
                    @endif
                    <br>

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

function update_facts(){
    const n = "{{$number}}";
    var txt = "";
    for(i =1; i < n; i++){
        txt += document.getElementById('deal_num'+i).value+" +";
    }
    txt += document.getElementById('deal_num'+n).value;
    document.getElementById('deal_num').value = txt;
}
function update_montant(){
    const n = "{{$number}}";
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
  var bank_acc =  value.split('1989raouf1989')[2];
  var bank =  value.split('1989raouf1989')[3];
  var bank_user =  value.split('1989raouf1989')[4];
  var bank_agc =  value.split('1989raouf1989')[5];
  document.getElementById("comp_input").value = name;
  document.getElementById('entreprise').value = id;
  document.getElementsByName("bank_user")[0].value = name;
  console.log(bank_acc);
  if(bank_acc != null){
    document.getElementById('bank_acc').value = bank_acc;
  }
  if(bank_user != null && bank_user != ""){
    document.getElementById('bank_user').value = bank_user;
  }
  if(bank != null){
    document.getElementById('bank').value = bank;
    document.getElementById('bank').innerHTML = bank;
  }
  if(bank_agc != null){
    document.getElementById('bank_agc').value = bank_agc;
  }


  //subject();

}

function ops_changed(value){
  document.getElementById("myDropdown").style.display ="none";
  document.getElementById("the_op").innerHTML = value;
  var type = "{{ $type }}";
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

</script>
@endsection

