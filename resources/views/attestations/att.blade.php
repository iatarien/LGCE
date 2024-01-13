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

		<div style="  display: inline-block; float: left; max-width : 50%; " dir="rtl">
			<br><br>
            <h4 style="">  {{$ville}} في : ................................
                
            </h4>
		</div>
		<div style="  display: inline-block; float: right; ">
            <h3 style="text-align : right;">     {{$ministere}}  <br>
			ولاية {{$ville}}
            <br>  مديرية {{$direction}} 
			<br> مصلـحة الإدارة و الــوســائل 
            <br> مـــــــــــكتب المحـــــــــاسبة
            <br><br> رقم ................./م. ت. ع/{{Date('Y')}}  

		</div>
		<div style="  display: inline-block; width : 100%; " dir="rtl">
			<h1 style=" font-size : 10mm; margin : 0;">   شهادة إدارية  </h1>
            <h1>عملية رقم : {{$att->numero}}</h1>
            <h1>{{$att->intitule_ar}}</h1>
            <h2 style="font-weight : lighter; text-align : justify;">
            {{$att->deal_type}} رقم {{$att->deal_num}} المبرمة مع {{$att->name}} و ذلك من أجل {{$att->lot}}
            </h2>
		</div>
	</div>
</section>
<hr>
<section dir="rtl" style="background-color: white; text-align: center; font-size: 13.5px; margin: 20px;" id="fiche">
	<div id="fiche_top">
       <h1> إن مدير {{$direction}} لولاية {{$ville}}</h1>
       <h2 style="font-weight : lighter; text-align : justify;">
            يشهد بأن {!! $att->causes !!}
        </h2>

		<div style=" font-weight: bold; float: left;margin-left: 50px;" >
			<h2>         <span style="color : transparent;">...................</span> المــديـــر         </h2>
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
  onclick=location.href="../attestations/admin"> رجوع </button>


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


