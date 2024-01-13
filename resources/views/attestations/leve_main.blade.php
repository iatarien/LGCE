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

<section  style="background-color: white; text-align: center; font-size: 13.5px; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div style="  display: inline-block; text-decoration : underline; ">
			<h3 style="text-decoration: underline; padding: 0px 5px 0px 5px;">    الجمهورية الجزائرية الديمقراطية الشعبية    </h3>
		</div>
		<br>
		<div style="  display: inline-block; float: right; ">
            <h3 style="text-align : right;"> وزارة الســـــكن و العمــــران و المديـــــنة <br>
			مـــديـــريـــة التـــجهــيـزات الــعـمـومــيــة
            <br> لولايـــــــــــــــة ورقلـــــــــــة 
            <br> مصلـحة الإدارة و الــوســائل 
            <br> مـــــــــــكتب المحـــــــــاسبة

		</div>
		<div style="  display: inline-block; width : 100%; " dir="rtl">
			<h1 style=" font-size : 10mm; margin : 0; text-decoration : underline; text-underline-offset: 10px;"> 
            مقرر يتضمن رفع اليد 
            </h1>
            <h2 style="font-weight : lighter; text-align : justify;">
            - إن مدير التجهيزات العمومية لولاية ورقلة <br>
            - بمقتضى القانون رقم 09/90 المؤرخ في 07/04/1990 المتضمن قانون الولاية <br>
            - بمقتضى المرسوم الرئاسي رقم 247/15 المؤرخ في 16/09/2015 المتضمن تنظيم الصفقات العمومية و تفويضات المرفق العام . <br>
            <?php $le_sujet = "" ?>
			@if($att->deal_date != "" and $att->deal_date != NULL)
            <?php $le_sujet = $le_sujet."- نظرا ل".$att->deal_type." رقم ".$att->deal_num." بتاريخ ".$att->deal_date."  المبرم مع ".$att->name ." من أجل ".$att->lot; ?>
            @else
			<?php $le_sujet = $le_sujet."- نظرا ل".$att->deal_type." رقم ".$att->deal_num."  المبرم مع ".$att->name ." من أجل ".$att->lot; ?>
            @endif<br>

			<strong>{{$le_sujet}}</strong>
			<br>
            <strong>
				@if($att->extra == "مدير الخزينة العمومية لولاية ورقلة")
                - نظرا للبند رقم 02-05 الذي يفرض على المقاولة استقطاع الضمان قدره %05 من المبلغ الإجمالي لل{{$att->deal_type}} بمبلغ : 
                @else 
				- نظرا للبند رقم 02-05 الذي يفرض على المقاولة كفالة بنكية قدرها %05 من المبلغ الإجمالي لل{{$att->deal_type}} بمبلغ : 
				@endif
				<span id="montant" style="font-weight: bold;">  </span> ( {{ number_format((float)$att->montant, 2, '.', ',')}} دج)
            </strong><br>
			{!! $att->pvs !!}<br>
            و المرتبطة بإدارة : مديرية التجهيزات العمومية لولاية ورقلة
		
            </h2>
			<hr>
			<h2 align="center"> بإقتراح من السيد / رئيس مصلحة الإدارة و الوسائل</h2>
			<h2 align="right"><span style='font-style : italic; font-weight : lighter; text-decoration : underline;'>المادة الأولى</span> : يرفع الــيد عن خصم الضمان المقدر %5 من المبلغ الإجمالي للعقد بمبلغ : ( {{ number_format((float)$att->montant, 2, '.', ',')}} دج) و المبرمة مع {{$att->name}}
			<br><span style='font-style : italic; font-weight : lighter; text-decoration : underline;'>المادة الثانية</span> : يكلف السادة رئيس مصلحة الإدارة و الوشائل و {{$att->extra}} بتنفيذ هذا القرار</h2>
		</div>
		<h2 style="text-align : left;font-weight : lighter; margin-left : 10%;" dir="rtl">
		ورقلـــة في : .....................
		</h2>
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
  onclick=location.href="../attestations/leve_main"> رجوع </button>


 <br><br><br><br>
</div>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
<script src="{{ url('js/tagfeet.js') }}" ></script>
<script type="text/javascript">
window.onbeforeunload = function () {
    window.close();
};

convert({{ $att->montant }});

function convert(num){
	num = ""+ num;
	var num1 = num;
	var num2 = null
	if(num.includes('.')){
		num1 = parseInt(num.split(".")[0]);
		num2 = parseInt(num.split(".")[1]);
	}
	if(num2 != null && num.split(".")[1].length == 1 ){
		num2 = num2 *10;
	}
	var txt = nArabicWords(num1);
	txt = txt.replace('ومليون', "و واحد مليون")
	txt+= " "+"دينار";
	if(num2 != null){
		txt +=" "+"و"+" "+nArabicWords(num2)+" "+"سنتيم";
	}
	document.getElementById('montant').innerHTML = txt;
}
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


