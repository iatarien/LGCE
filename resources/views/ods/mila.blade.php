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
	    line-height: 1.5;
	    -webkit-print-color-adjust: exact !important;
	}


</style>

</head>
<body contenteditable="true">
<?php 
function convert_date($var){
	if($var == ""){
		return "/";
	}
	return date("d-m-Y", strtotime($var) );
}
?>
<section  style="background-color: white; text-align: center; font-size: 13.5px; margin: 20px;" id="fiche">
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
		if($intitule ==""){
			$intitule = $ods->intitule;
		}
		$num = $ods->ods_num;
		if($num <10){
			$num = "0".$num;
		}
		
		$date = $ods->date;
		$cause = $ods->cause;
		$duree = $ods->duree;
		
		
		?>
		<div style="  display: inline-block; text-align : justify; float: left; max-width : 50%; " dir="rtl">
            <h4 style=""> 
                 - رقم العملية:    <strong>{{$op}}</strong> 
                <br>
                - عنوان العملية : <strong> {{$intitule}} </strong>
                <br>
                - عنوان المشروع : <strong> {{$ods->lot}} </strong>
				<?php $alayha = "عليها";
				if($deal =="عقد"){ $alayha = "عليه"; } ?>
                <br>
				- موضوع  ال{{$deal}}   : 
					<strong>
					@if($deal =="صفقة")
					مصادق {{$alayha}} 
					من طرف لجنة الصفقات الولائية بتاريخ 
					 {{convert_date($ods->visa_cmw)}} تحت رقم و
					 @endif
					 مؤشر {{$alayha}} 
					 {{$ods->num_cmw}}  من طرف المراقب المالي بتاريخ 
					 {{convert_date($visa_date)}} تحت رقم {{$visa}}</strong> 
                <br>

                
            </h4>
		</div>
		<div style="  display: inline-block; float: right; ">
            <h3 style="text-align : right;"> وزارة {{$ministere}}<br>
			مديرية {{$direction}} لولاية {{$ville}}  
			<br>  
			مصلحة   الإدارة و الوسائل
            <br>
            مكتب المنازعات الصفقات و الأرشيف

			</h3>
            <h3 style="text-align : right;" >     الرقم التسلسلي للسجل: &emsp;&emsp;/{{$year}}  </h3>
            
		</div>
		<div style="  display: inline-block; width : 100%; ">
			<h2 style="background-color: rgb(210,210,210)  !important;  padding: 0px 5px 0px 5px;">     أمر  بالخدمة رقم {{$num}}   </h2>
		</div>
		<div dir="rtl" style="  display: inline-block; width : 100%; font-weight :  bold; text-align : justify; font-size : 3.8mm;">
		السيد / {{$e}} مدعو لـ : <br>  
		01- {{$ods_type}} بتاريخ {{convert_date($ods_date)}} 

		 موضوع  ال{{$deal}}   : 
		<strong>
		@if($deal =="صفقة")
		مصادق {{$alayha}} 
		من طرف لجنة الصفقات الولائية بتاريخ 
			{{convert_date($ods->visa_cmw)}} تحت رقم و
			@endif
			مؤشر {{$alayha}} 
			{{$ods->num_cmw}}  من طرف المراقب المالي بتاريخ 
			{{convert_date($visa_date)}} تحت رقم {{$visa}}</strong> 
		
		الخاص بمشروع {{$intitule}} <br>
		الحصة : {{$sujet}}<br>
		@if($cause != NULL and $cause != "")
			السبب : {{$cause}} <br>
		@endif
		@if($ods->real_type =="d")
		<strong>مدة الإنجاز : {{$ods->duree}} يوم.</strong><br>
		@endif
		@if(str_contains($ods_type,'شعار'))
		03-   يستلم نسخة أصلية من ال{{$deal}}.<br>
		03-  يستلم نسخة من هذا الأمر بالخدمة.<br>
		@else
		02-  يستلم نسخة من هذا الأمر بالخدمة.<br>
		@endif

		

		يشهد على مطابقة هذا الأمر بالخدمــة للنسخة المقيدة بالسجل تحت رقم: &emsp;&emsp;/{{$year}}
		<br>
		و سيبلغ إلى : {{$e}} الكائن مقره بـ
		  : {{$ods->adresse}}  من طرف السيد
		
		: مـديـر {{$direction}} لولايـة {{$ville}} .                                                               

		</div>

		<div style="font-size: 16px; font-weight: bold; float: left;margin-left: 20px;" >
			<span>         <span style="color : black;">{{convert_date($ods_date)}}</span> {{$ville}} في        </span>
		</div>
		<br><br><br>
		<div style="font-size: 16px; font-weight: bold; float: right ;margin-right: 20px;" >
			<span style=" text-decoration : underline;">        رئيس المصلحة       </span>
		</div>
		<div style="font-size: 16px; font-weight: bold; float: left;margin-left: 20px;" >
			<span style=" text-decoration : underline;">       المــــدير      </span>
		</div>

	</div>

</section>
<br><br><br>
<hr>
<section style="background-color: white; text-align: center; font-size: 13.5px; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div style="  display: inline-block; float: right; ">
            <h3 style="text-align : right;"> وزارة {{$ministere}}<br>
			مديرية {{$direction}} لولاية {{$ville}}  <br>
			    الرقم التسلسلي للسجل:   &emsp;/{{$year}}  </h3>
            
		</div>
		<div style="  display: inline-block; width : 100%; ">
			<h2 style="background-color: rgb(210,210,210) !important;  padding: 0px 5px 0px 5px;">    إشعار  </h2>
		</div>
		<div dir="rtl" style="  display: inline-block; width : 100%; font-size : 3.8mm; font-weight :  bold; text-align : justify; ">
			
			في  <span style="color : black;">{{convert_date($ods_date)}}</span> أنا الممضي أدناه السيد / {{$e}} 
			الكائن مقره بـ: {{$ods->adresse}}  استلمت النسخة
			 المطابقة للأمر بالخدمــة المسجل تحت الرقم التسلسلي ................./2024.
			
		</div>

		<div style="font-size: 16px; font-weight: bold; float: left;margin-left: 50px;" >
			<span>         <span style="color : transparent;">...................</span> 
المتعامل المتعاقد
         </span>
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


