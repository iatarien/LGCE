@extends('comptabilite.master_compta')
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
<div class="row">
	<div class="col-lg-10 col-xs-10 col-sm-10 portlets pull-right" lang="ar" dir="rtl" style="margin-right: 10%;"  >
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-right">
               إضافة  مقرر رفع اليد 
            </div>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post" style='margin : 5%'>
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" action="/update_leve" method="POST">
	            	@csrf

                <input type="hidden" name="id_leve" value="{{$id}}" >
                <h4 style="font-weight : lighter; text-align : justify;">
                - إن مدير التجهيزات العمومية لولاية ورقلة <br>
                - بمقتضى القانون رقم 09/90 المؤرخ في 07/04/1990 المتضمن قانون الولاية <br>
                - بمقتضى المرسوم الرئاسي رقم 10/236 المؤرخ في 10/07/2010 المتضمن تنظيم الصفقات العمومية المعدل و المتمم. <br>
                @if($eng->deal_date != "" and $eng->deal_date != NULL)
                <strong>- نظرا ل{{$eng->deal_type}} رقم {{$eng->deal_num}} بتاريخ {{$eng->deal_date}}  المبرم مع {{$eng->name }} من أجل {{$eng->lot}}</strong>
                @else
                <strong>-  نظرا ل{{$eng->deal_type}} رقم {{$eng->deal_num}} المبرم مع {{$eng->name }} من أجل {{$eng->lot}}</strong>
                @endif<br>

                </h4>

                <div class="form-group">
	                <div class="col-xs-5" style='padding-right : 0;'>
	                  <input id="input_montant" step="any" onkeyup="numberWithCommas(this.value)" dir="ltr" style="text-align : right; color : black" name="montant" required value="{{$leve->montant}}"  type="number" class="form-control">
	                </div>
                    <label class="control-label col-xs-7" style="text-align : right; font-weight: lighter; padding-left : 0;" for="title"> 
                    <h4 style='margin-top : 0; '>
                    - نظرا للبند رقم 02-05 الذي المقاول خصم الضمان قدره %05 من المبلغ الإجمالي لل{{$eng->deal_type}} بمبلغ : 
                    </h4>
                    <br>
                    </label>
	              </div>
                <div class="form-group">
	                  <div class="col-xs-12">
                        <textarea style="color : black; text-align : right;" name="pvs" rows="11" class="form-control" dir="rtl">{{ $leve->pvs }}</textarea>
                    </div>
	              </div>
                <h4>و المرتبطة بإدارة : مديرية التجهيزات العمومية لولاية ورقلة </h4>  
                <hr>
			    <h3 align="center"> بإقتراح من السيد / رئيس مصلحة الإدارة و الوسائل</h3><br>
			    <h4 align="right"><span style='font-style : italic; font-weight : lighter; text-decoration : underline;'>المادة الأولى</span> : يرفع الــيد عن خصم الضمان المقدر %5 من المبلغ الإجمالي للعقد بمبلغ : <span id="montant">&emsp;&emsp;</span> دج و المبرمة مع {{$eng->name}}
			    <br>
                <div class="form-group">
                    <label class="col-xs-2" style='padding-right : 0;padding-top : 10px;'>
                    بتنفيذ هذا القرار
                    </label>
	                <div class="col-xs-5" style='padding-right : 0;'>
	                  <input dir="rtl" style="text-align : right; color : black" name="extras" required value="{{$leve->extra}}" type="text" class="form-control">
	                </div>
                    <label class="control-label col-xs-5" style="text-align : right; font-weight: lighter; padding-left : 0;" for="title"> 
                    <h4 style='margin-top : 0; '>
                    <span style='font-style : italic; font-weight : lighter; text-decoration : underline;'>المادة الثانية</span> : يكلف السادة رئيس مصلحة الإدارة و الوشائل و 
                    </h4>
                    <br>
                    </label>
                    
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


<div id="myModal" class="modal" style="display: block;">

  <!-- The Close Button -->

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01" src="{{ url('img/loading.gif')}}">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
@endsection

@section('js_scripts')

<script type="text/javascript">
  window.onload = function(){
    document.getElementById('myModal').style.display = "none";
    numberWithCommas(document.getElementById('input_montant').value);
  };

  
</script>

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function numberWithCommas(x) {
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(!x.includes('.')){
      x += ".00";
    }
    else{
      xs = x.split(".");
      x = xs[0] +"."+ xs[1].substring(0,2).replaceAll(',','0');
    }

    document.getElementById('montant').innerHTML = '('+x+')';
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
@section('js_scripts_cancel')
<script type="text/javascript">
$(document).ready(function() {
    $(window).keydown(function(event){
    if(event.keyCode == 13) {
      console.log('lol');
    }
  });
});
</script>
@endsection
