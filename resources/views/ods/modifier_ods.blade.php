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
<div id="main" class="row main">
	<div class="col-lg-12 col-xs-12 col-sm-10 portlets pull-right" lang="ar" dir="rtl" style="margin-right: 10%;"  >
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-right">
               تعديل أمر مصلحي
            </div>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" action="/update_ods" method="POST">
	            	@csrf
                <input type="hidden" name="id" value="{{$id}}" >
                
                <div class="form-group">
	                <div class="col-xs-10">
	                  <input dir="rtl" style="text-align : right" value="{{$ods->ods_num}}" required type="text" class="form-control" id="ods_num" name="ods_num">
	                </div>
                    <label class="control-label col-xs-2" style="text-align : right; font-weight: bold;" for="title"> أمر مصلحي رقم : </label>
	            </div>
              <div class="form-group">
                <div class="col-xs-7">
                    <input dir="rtl" required style="text-align : right" type="text" class="form-control" id="extra_type" value ="{{$ods->extra_type}}" name="extra_type">
                  </div>
	                <div class="col-xs-3">
	                  <select class="form-control" id="real_type" name="real_type">
                      <option value="{{$ods->real_type}}" style="visibility : hidden">{{$ods->the_type}}</option>
                    </select>
	                </div>
                  
                    <label class="control-label col-xs-2" style="text-align : right; font-weight: bold;" for="title"> أمر مصلحي ب : </label>
	              </div>
                <div class="form-group" id="other" style='display : none;'>
	                <div class="col-xs-10">
	                  <input  value="{{$ods->type_ods}}" dir="rtl" style="text-align : right" required  type="text" class="form-control" id="type_ods" name="type_ods">
	                </div>
                    <label class="control-label col-xs-2" style="text-align : right; font-weight: bold;" for="title"> أمر مصلحي ب : </label>
	              </div>
                <div class="form-group">
	                <div class="col-xs-10">
	                  <input dir="rtl" style="text-align : right"   value="{{$ods->cause}}" type="text" class="form-control" id="cause" name="cause">
	                </div>
                    <label class="control-label col-xs-2" style="text-align : right; font-weight: bold;" for="title">   السبب : </label>
	            </div>

              @if($ville_fr =="Ouargla" && $direction_fr =="Direction de l'Education")
                <div class="form-group">
	                <div class="col-xs-10">
	                  <input min="01-01-1962" max="31-12-20100" dir="rtl" style="text-align : right; color :  black; font-weight :  bold;" required 
                    value="{{$ods->ods_date0}}" dir="ltr"  type="date" class="form-control" id="ods_date0" name="ods_date0">
	                </div>
                    <label class="control-label col-xs-2" style="text-align : right; font-weight: bold;" for="title">   التاريخ : </label>
	              </div>
                
                <div class="form-group">
	                <div class="col-xs-10">
	                  <input min="01-01-1962" max="31-12-20100" dir="rtl" style="text-align : right; color :  black; font-weight :  bold;" 
                    value="{{$ods->ods_date}}"  
                    dir="ltr"  type="date" class="form-control" id="ods_date" name="ods_date">
	                </div>
                    <label class="control-label col-xs-2" style="text-align : right; font-weight: bold;" for="title">   تاريخ التبليغ : </label>
	              </div>
                @else
                <div class="form-group">
	                <div class="col-xs-10">
	                  <input dir="rtl" style="text-align : right; color :  black; font-weight :  bold;" value="{{$ods->ods_date}}" required value="{{Date('Y-m-d')}}" dir="ltr"  type="date" class="form-control" id="ods_date" name="ods_date">
	                </div>
                    <label class="control-label col-xs-2" style="text-align : right; font-weight: bold;" for="title">   التاريخ : </label>
	            </div>
              @endif
                
                
                <div class="form-group">
	                <div class="col-xs-10">
	                  <input dir="rtl" style="text-align : right" readonly value="{{$ods->numero }}"  type="text" class="form-control" id="numero" name="numero">
	                </div>
                    <label class="control-label col-xs-2" style="text-align : right; font-weight: bold;" for="title"> رقم العملية</label>
	            </div>
                <div class="form-group">
	                <div class="col-xs-10">
	                  <input dir="rtl" style="text-align : right" readonly value="{{$ods->intitule_ar }}"  type="text" class="form-control" id="intitule_ar" name="intitule_ar">
	                </div>
                    <label class="control-label col-xs-2" style="text-align : right; font-weight: bold;" for="title"> تعيين العملية</label>
	            </div>
	            <div class="form-group">
	                <div class="col-xs-10">
	                  <input dir="rtl" style="text-align : right" readonly value="{{$deal->deal_num }}"  type="text" class="form-control" id="intitule_ar" name="intitule_ar">
	                </div>
                    <label class="control-label col-xs-2" style="text-align : right; font-weight: bold;" for="title">  رقم ال{{$deal->deal_type}}</label>
	            </div>
                <div class="form-group">
	                <div class="col-xs-10">
	                  <input dir="rtl" style="text-align : right" readonly value="{{$deal->lot }}"  type="text" class="form-control" id="intitule_ar" name="intitule_ar">
	                </div>
                    <label class="control-label col-xs-2" style="text-align : right; font-weight: bold;" for="title">  موضوع ال{{$deal->deal_type}}</label>
	            </div>
                <div class="form-group">
	                <div class="col-xs-10">
	                  <input dir="rtl" style="text-align : right" readonly value="{{$deal->name }}"  type="text" class="form-control" id="intitule_ar" name="intitule_ar">
	                </div>
                    <label class="control-label col-xs-2" style="text-align : right; font-weight: bold;" for="title">  الـــــشـــركة</label>
	            </div>
               
            
            <br>
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
  };
  
</script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function other(id,value,text){
  if(value =="other"){
    document.getElementById('other').style.display ="block";
    document.getElementById(id).disabled  = true;
  }else{
    document.getElementById("type_ods").value = text;
  }
  
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

  var id = value.split("1989raouf1989")[0];

  var numero =  value.split('1989raouf1989')[1];
  var intitule_ar =  value.split('1989raouf1989')[2];
  document.getElementById("op_input").value = numero;
  document.getElementById('id_op').value = id;
  document.getElementById('intitule_ar').value = intitule_ar;
}
</script>
@endsection

