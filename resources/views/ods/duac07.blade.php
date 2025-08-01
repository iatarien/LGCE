<!DOCTYPE html>
<html>
<head>
	  <!-- Bootstrap CSS -->
	  <link href="{{ url('css/bootstrap.min.css')}}" rel="stylesheet">
	  <!-- bootstrap theme -->
	<title></title>
<style type="text/css">
	@page {
	    size: auto;   /* auto is the initial value */
		size: portrait;
	    margin: 0;  /* this affects the margin in the printer settings */
	}
	@media print {
		html,body{
			height:297mm;
	    	width:210mm;
			overflow-y : hidden !important;
		}
		
	}
	html,body{
	    height:287mm;
	    width:210mm;
	    margin: auto;
	    line-height: 1.6;
	    -webkit-print-color-adjust: exact !important;
	}


</style>

</head>
<body contenteditable="true">

<section  style="background-color: white; text-align: center; font-size: 13.5px; margin: 20px; margin-top : 10px;" id="fiche">
	<div id="fiche_top">
		<div style="  display: inline-block; text-decoration : underline; ">
			<h3 style="text-decoration: underline; padding: 0px 5px 0px 5px;">    الجمهورية الجزائرية الديمقراطية الشعبية    </h3>
		</div>
		<br>
        <?php $deal = $ods->deal_type; 
        $ods_type = $ods->type_ods;
        $e = $ods->name;
		$deal_num = $ods->deal_num;
		$visa = $ods->num_visa;
		$ods_date = $ods->ods_date;
		$visa_date = $ods->date_visa;
		$sujet = $ods->lot; 
		$op = $ods->numero; 
		$intitule = $ods->intitule_ar;
		$num = $ods->ods_num;
		if($num <10){
			$num = "0".$num;
		}
		
		$date = $ods->date;
		$cause = $ods->cause;
		$duree = $ods->duree;
		
		
		?>
		<div style="  display: inline-block; float: left; max-width : 50%; " dir="rtl">
			<h4 style="text-align : justify"> 
                <br>
                رقم العملية : <strong> {{$op}} </strong>
                <br>
				اسم العملية : <strong> {{$intitule}}</strong>
                <br>
                المشروع : <strong>{{$sujet}} </strong>
                <br>
                المـــقاولة : <strong>{{$e}}<strong>
                
            </h4>
		</div>
		<div style="  display: inline-block; float: right; ">
            <h3 style="text-align : right;"> وزارة {{$ministere}}<br>

			مديرية {{$direction}}<br>
            لولاية {{$ville}}  
			<br>  
			@if ($user->service == "Suivi")
			<br> مصلحة متابعة العمليات المنجزة
			@endif
			@if ($user->service == "Etude")
			<br> مصلحة الدراسة و التقويم
			@endif
			@if ($user->username == "rabhi" or $user->username == "halim" or $user->username == "nasri" or $user->username == "said")
			<br> مكتب التربية و التعليم العالي
			@endif
			</h3>
            <h3 style="text-align : right;" >       رقم التسجيل :  {{$num}}  /{{$year}}  </h3>
            
		</div>
		<div style="  display: inline-block; width : 100%; ">
			<h3 style="background-color: rgb(210,210,210)  !important;  padding: 0px 5px 0px 5px;">     أمر ب{{$ods_type}}   </h3>
		</div>
		<div dir="rtl" style="  display: inline-block; width : 100%; font-weight :  normal; text-align : justify; ">
			 السيد: <strong>{{$e}}</strong> 
     
             @if(str_contains($ods_type, "الخدمة"))
             مدعو لتبليغ و  استلام نسخة من 
             ال{{$deal}} رقم <strong>{{$deal_num}}</strong> 
             @if($ods->deal_date != null)
             بتاريخ <strong>{{$ods->deal_date}}</strong> 
             @endif
             و الإنطلاق في {{$ods->extra_type}}
             @else
             مدعو إلى
             {{$ods_type}} المنصوص عليها في  ال{{$deal}} رقم <strong>{{$deal_num}}</strong> 
             @if($ods->deal_date != null)
             بتاريخ <strong>{{$ods->deal_date}}</strong> 
             @endif
             @endif
             
             الخاصة بمشروع : {{$sujet}}
             <br>
             @if($deal =="عقد")
             <?php $t = "عليه"; ?>
             @else
             <?php $t = "عليها"; ?>
             @endif
             المؤشر  {{$t}} تحت رقم <strong>{{$visa}}</strong>
             بتاريخ <strong dir="ltr">{{$visa_date}}</strong> 
			
			@if($cause != NULL and $cause != "")
				السبب : {{$cause}} <br>
			@endif
            <br>
            و لهذا يطلب منكم أخذ كل الإجراءات اللازمة في اليوم الموالي لتاريخ الإمضاء تبليغ الأمر ب{{$ods_type}}
            <br>
			  إلى السيد : <strong>{{$e}}</strong> <br>
              من طرف السيد : مدير {{$direction}} لولاية {{$ville}}<br>
			@if($user->service =="Suivi") 
			عن طريق السيد : رئيس مصلحة متابعة العمليات المنجزة
			@elseif($user->service =="Etude")
			عن طريق السيد : رئيس مصلحة الدراسة و التقويم
			@else
            <strong>رئيس مصلحة الهندسة المعمارية و البناء </strong> 
			@endif
		</div>

		<div style="font-size: 16px; font-weight: bold; float: left;margin-left: 20px;" >
			<span>         <span style="color : black;">{{$ods_date}}</span> {{$ville}} في        </span>
			<br><br>
			<span style="font-size : 20px;">   الـمديـــر     </span>
			
		</div>


	</div>

</section>
<br><br><br><br><br>
<hr>
<section style="background-color: white; text-align: center; font-size: 13.5px; margin: 20px; margin-top : 10px;" id="fiche">
	<div id="fiche_top">

        <div style="  display: inline-block; float: left; max-width : 50%; " dir="rtl">
			<h4 style="text-align : justify"> 
                <br>
                رقم العملية : <strong> {{$op}} </strong>
                <br>
				اسم العملية : <strong> {{$intitule}}</strong>
                <br>
                المشروع : <strong>{{$sujet}} </strong>
                <br>
                المـــقاولة : <strong>{{$e}}<strong>
                
            </h4>
		</div>
		<div style="  display: inline-block; float: right; ">
            <h3 style="text-align : right;"> وزارة {{$ministere}}<br>

			مديرية {{$direction}}<br>
            لولاية {{$ville}}  
			<br>  
			@if ($user->service == "Suivi")
			<br> مصلحة متابعة العمليات المنجزة
			@endif
			@if ($user->service == "Etude")
			<br> مصلحة الدراسة و التقويم
			@endif
			@if ($user->username == "rabhi" or $user->username == "halim" or $user->username == "nasri" or $user->username == "said")
			<br> مكتب التربية و التعليم العالي
			@endif
			</h3>
            <h3 style="text-align : right;" >       رقم التسجيل :  {{$num}}  /{{$year}}  </h3>
            
		</div>
		<div style="  display: inline-block; width : 100%; ">
			<h3 style="background-color: rgb(210,210,210) !important;  padding: 0px 5px 0px 5px;">    التــبليــــغ  </h3>
		</div>
		<div dir="rtl" style="  display: inline-block; width : 100%; font-weight :  normal; text-align : justify; ">
			<p>
			<strong>في يوم : {{$ods_date}} </strong><br>
			انا الممضي أسفله السيد : <strong>{{$e}}</strong> <br>
			أصرح بأنني إنتقلت إلى مديرية {{$direction}} و استلمت نسخة من
            @if(str_contains($ods_type, "الخدمة"))
            ال{{$deal}} مصادق {{$t}} و
            @endif
             الأمر ب{{$ods_type}}<br>
			المسجل بالدفتر تحت رقم : <strong>{{$num}}  /{{$year}}</strong>
			</p>

		</div>

		<div style="font-size: 16px; font-weight: bold; float: left;margin-left: 50px;" >
			<span>         <span style="color : transparent;">...................</span> <strong style="text-decoration : underline">المتعامل المتعاقد</strong>         </span>
		</div>

	</div>

</section>
<br><br><br><br>
<div align="center">
	<button id="bouton" style="
	  background-color: lightgray; /* Green */
	  border: none;
	  color: black;
	  cursor: pointer;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;" 
  onclick="printdiv('fiche')"> طباعة </button>

<button id="bouton_2" style="
	  background-color: skyblue; /* Green */
	  border: none;
	  color: black;
	  cursor: pointer;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;" 
  onclick=location.href="../odss"> رجوع </button>


 <br><br><br><br>
</div>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
<script type="text/javascript">
window.onbeforeunload = function () {
    window.close();
};
function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title>' + document.title  + '</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(elem).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.print();


    return true;
}
function printdiv(printdivname) {
	document.getElementById('bouton').style.display = "none";
	document.getElementById('bouton_2').style.display = "none";
   /* var footstr = "</body>";
    var newstr = document.getElementById(printdivname).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = ""+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;*/
    print();
    document.getElementById('bouton').style.display = "inline-block";
	document.getElementById('bouton_2').style.display = "inline-block";
	
    return false;
}
jQuery(document).bind(" keydown", function(e){
    if(e.ctrlKey && e.keyCode == 80){
		printdiv('fiche');
		return false;
    }
	
});
</script>
</body>
</html>


