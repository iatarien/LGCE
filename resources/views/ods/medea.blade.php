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
<?php 
$cdars = false;
if (str_contains($direction, 'محافظة تنمية الفلاحة')) {
$cdars = true;
}
?>
</head>
<body contenteditable="true">
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
<section  style="background-color: white; text-align: center; font-size: 14.5px; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div style="  display: inline-block; text-decoration : underline; ">
			<h2 style="text-decoration: underline; padding: 0px 5px 0px 5px;">    الجمهورية الجزائرية الديمقراطية الشعبية    </h2>
            <h3 style="text-decoration: underline; padding: 0px 5px 0px 5px;">  {{$num}} أمر بخدمة للمفاول رقم   </h3>
		</div>
		<br>
		<div style="  display: inline-block; float: right; width : 30%; text-align : right; font-weight : bold;">
        <br>
			ولاية {{$ville}}  
			<br>  
			@if($cdars)
			 {{$direction}}  
			@else
			مديرية {{$direction}}
            @endif

			<br> مصلحة الصفقات


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
			<h3 style="text-align : right;" >        رقم :   &emsp;&emsp;/  م ت هـ م ب /{{$year}}  </h3>
            
		</div>
		<div style="  display: inline-block; float: right; text-align : right; max-width : 70%; " dir="rtl">
        <h4 style=""> 
                عملية رقم :    <strong>{{$op}}</strong> 
                <br>
                عنوان العملية : <strong> {{$intitule}} </strong>
                <br>

                المشروع: <strong> {{$sujet}} </strong>
                <br>
               المقاولة: <strong>{{$e}}<strong>
                
            </h4>	
		</div>

		<div style="  display: inline-block; width : 100%; ">
			<h2 style="padding: 0px 5px 0px 5px;">     أمر  ب{{$ods_type}}   </h2>
		</div>
		<div dir="rtl" style="  display: inline-block; width : 100%; font-weight :  normal; text-align : justify; font-size : 16px;">
			طبقا للمادة 30 الفقرة 2 من دفتر الشروط الإدارية الخاصة رقم 21-219 المؤرخ في 20/05/2021 <br>
            @if($ods->real_type =="d")
                ننهي إلى علم المقاولة {{$e}} بالمصادقة على {{$ods->deal_type}} رقم {{$ods->deal_num}} المؤشر عليها من طرف المراقب المالي بتاريخ 
                {{$visa_date}} <br>
                بمبلغ <span dir="ltr"> {{ number_format((float)$ods->montant, 2, '.', ' ')}} </span><b style="color : transparent">w</b>دج 

            و المتعلقة بمشروع {{$ods->lot}} <br>
            وعليه فإنه مدعو إلى : <br>
            - استلام نسخة من {{$ods->deal_type}}  المتضمنة مشروع {{$ods->lot}} <br>
            - الإنطلاق في الأشغال إبتداءا من تاريخ تبليغ هذا الأمر بالخدمة<br>
            @else
            أعطي الأمر لـ : <strong>{{$e}}</strong> ب{{$ods_type}} المنصوص عليها في  ال{{$deal}} رقم <strong>{{$deal_num}}</strong> المؤشر من قبل المراقب المالي بتاريخ  <strong dir="ltr">{{$visa_date}}</strong>  تحت رقم <strong>{{$visa}}</strong> و هذا ابتداءا من تاريخ التبليغ.<br>
            @endif
            @if($cause != NULL and $cause != "")
				السبب : {{$cause}} <br>
			@endif

			 هذا الأمر بالخدمة الخالي المؤشر و المطابق للوثيقة الأصلية المدونة في الدفتر الخاص بهذه العملية تحت رقم : / &emsp;&emsp;/م ت هـ م ب/{{$year}}<br>

			 يبلغ للمقاولة : <strong>{{$e}}</strong> <br>

			عن طريق السيد : مدير {{$direction}} لولاية {{$ville}}


		</div>

		<div style="font-size: 16px; font-weight: bold; float: left;margin-left: 20px;" >
			<span>         <span style="color : black;">{{$ods_date}}</span> حرر بـ{{$ville}} في       </span>
		</div>

	</div>

</section>
<br>
<hr>
<section style="background-color: white; text-align: center; font-size: 13.5px; margin: 20px;" id="fiche">
	<div id="fiche_top">

    <div style="  display: inline-block; float: right; width : 30%; text-align : right;">
        <br>
			ولاية {{$ville}}  
			<br>  
			@if($cdars)
			 {{$direction}}  
			@else
			مديرية {{$direction}}
            @endif

			<br> مصلحة الصفقات


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
			<h3 style="text-align : right;" >        رقم :   &emsp;&emsp;/  م ت هـ م ب /{{$year}}  </h3>
            
		</div>
		<div style="  display: inline-block; float: right; text-align : right; max-width : 70%; " dir="rtl">
    		<h4 style=""> 
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
                فــي : .............................................. <br>
                استلم السيد {{$e}}  نسخة مطابقة للأصل من الأمر بالخدمة المؤرخ في {{$ods_date}} المسجل تحت رقم ..........
                
            </h4>
		</div>
		<div style="  display: inline-block; width : 100%; ">
			<h2 style="text-decoration : underline; padding: 0px 5px 0px 5px;">    تنـــبـــيه  </h2>
		</div>
		<div dir="rtl" style="  display: inline-block; width : 100%; font-weight :  normal; text-align : justify; font-size : 16px;">
			<p>
            هذه القسيمة المبلغة يجب أن تفصل عن الأمر بالخدمة و تحفظ بمكتب المدير بعد إلصاقها في السجل
			</p>
		</div>

		<div style="font-size: 16px; font-weight: bold; float: left;margin-left: 50px;" >
			<span>         <span style="color : transparent;">...................</span> الإمضــــــاء         </span>
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


