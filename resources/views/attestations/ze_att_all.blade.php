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

<section  style="background-color: white; text-align: center; font-size: 14.5px; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div style="  display: inline-block; text-decoration : underline; ">
			<h3 style="text-decoration: underline; padding: 0px 5px 0px 5px;">    الجمهورية الجزائرية الديمقراطية الشعبية    </h3>
		</div>
		<br>

		<div style="  display: inline-block; float: left; max-width : 50%; " dir="rtl">
			<br><br>
            <h4 style="">  {{$ville}} في : ................................
                
            </h4>
            @if($type=="att_commune" or $type=="att_error")
            <br>
            <h3 style="">الى السيد : أمين خزينة ولاية {{$ville}}
                
            </h3>
            @endif
		</div>
		<div style="  display: inline-block; float: right; ">
            <h3 style="text-align : right;">     {{$ministere}}  <br>
			ولاية {{$ville}}
            <br>  مديرية {{$direction}} 
			<br> مصلـحة الإدارة و الــوســائل 
            <br> مـــــــــــكتب المحـــــــــاسبة
            <br> رقم ................./م. ت. ع/{{Date('Y')}}  

		</div>
		@if($type =="att_error")
		<div style="  display: inline-block; width : 88%; " dir="rtl">
			<h1 style=" font-size : 10mm; margin : 0;">   شهادة إدارية  </h1>
            <p style="text-align : justify; font-size : 5.5mm;">أنا الممضي أسفله السيد مدير {{$direction }} <br><br>
			أشهد بأن المبلغ : <span style="font-weight : bold;">{{ number_format((float)$att->to_pay, 2, '.', ',')}} دج</span> المقيد بالحوالة رقم : <span style="font-weight : bold;">{{$att->mondat}}</span>
			<br><br>
			المدفوعة بتاريخ : <span style="font-weight : bold;">{{$att->visa}}</span> <br> <br>
			هو لفائدة : <span style="font-weight : bold;">{{$att->name}} </span><br> <br>
			يدفع في الحساب : <span style="font-weight : bold;">{{$bank}} </span> <br> <br>
			بدلا من : <span style="font-weight : bold;">{{$att->compte}} </span>
			</p>
           
		</div>
		<div style="  display: inline-block; float: left; max-width : 20%; " dir="rtl">
			<br><br><br>
			<h3 style="font-size : 6mm;">
			الآمر بالصرف				
			</h3>
		</div>
		@endif
		@if($type =="att_commune")
		<div style="  display: inline-block; width : 92%; " dir="rtl">
			<h1 style=" font-size : 10mm; margin : 0;">   شهادة إدارية  </h1>
            <p style="text-align : justify; font-size : 5.5mm;">أنا الممضي أسفله السيد مدير {{$direction }} <br><br>
			أشهد بأن المبلغ : <span style="font-weight : bold;">{{ number_format((float)$att->to_pay, 2, '.', ',')}} دج</span> المقيد بالحوالة رقم : <span style="font-weight : bold;">{{$att->mondat}}</span>
			المرسلة إلى الخزينة بتاريخ : {{$att->date}} تنفيذا ل{{$sujet}}
			<br>
			هو لفائدة : <span style="font-weight : bold;">{{$att->name}} </span><br> <br>
			يدفع في الحساب الجاري البريدي رقم : : <span style="font-weight : bold;">{{$bank}} </span> بإسم المعني المذكور أعلاه<br> <br>
			</p>
           
		</div>
		<div style="  display: inline-block; float: left; max-width : 20%; " dir="rtl">
			<br><br><br>
			<h3 style="font-size : 6mm;">
			 المــــدير				
			</h3>
		</div>
		@endif
		@if($type =="att_retard")
		<div style="  display: inline-block; width : 88%; " dir="rtl">
			<h1 style=" font-size : 10mm; margin : 0;">   شهادة إدارية  </h1>
            <p style="text-align : justify; font-size : 5.5mm;">
			طبقا لقانون 17/84 المؤرخ في 07/07/1984 المتعلق بقوانين المالية المعدل و المتمم خاصة المواد 
			16-17-18 منه و التعليمة رقم 19 المؤرخة في 30/05/1989 الصادرة عن وزارة المالية مديرية المحاسبة
			<br>
			نحن مدير {{$direction}} لولاية {{$ville}} السيد شريفي أحمد، أشهد بان تسدد :  {{$att->travaux_type}} رقم {{$att->travaux_num}} والمتعلقة بـ{{$att->lot}}
			<br>
			اسم الدائن و صفته و مبلغ الدين : {{$att->name}} بصفته المؤسسة المدين بمبلغ {{ number_format((float)$att->to_pay, 2, '.', ',')}} دج
			<br>
			أنه لم نتمكن من تسديد {{$att->travaux_type}} رقم {{$att->travaux_num}} بتاريخ {{$att->date_pay}} و في آجالها بمبلغ قدره {{ number_format((float)$att->to_pay, 2, '.', ',')}} دج
			بسبب عمل الإدارة و لذلك نلتمس منكم تسديد هذه الحوالة 
			</p>
           
		</div>
		<div style="  display: inline-block; float: left; max-width : 20%; " dir="rtl">
			<br><br>
			<h3 style="font-size : 6mm;">
			 عـــن الوالـــي				
			</h3>
		</div>
		@endif
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
  onclick=location.href="/attestations/{{$type}}"> رجوع </button>


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


