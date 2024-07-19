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
		size: A4 portrait;
	    margin: 0;  /* this affects the margin in the printer settings */
	}
	@media print {
		html, body {
			height:100vh; 
			margin: 0 !important; 
			padding: 0 !important;
			overflow: hidden;
		}
	}
	html,body{
	    height:297mm;
	    width:210mm;
	    margin: auto;
	    margin-top: 5mm !important;
	    line-height: 1.5;
	    font-size: 15px;
	    -webkit-print-color-adjust: exact !important;
		page-break-after: auto;
	}
	#fiche {
		margin: 20px;
		text-align: center;
	}
	#numero {
		border-collapse: collapse;
		border: 1px solid;
		table-layout: fixed;

	}
	#numero td {

		font-weight: bold;
		border: 1px solid;
		font-size: 12px;
		padding: 7px;
	}
	#titles {
		float: right;
		font-size: 16px;
		margin-right: 50px;
		border-spacing: 1em;
	}
	#titles td {
		vertical-align: top;
	    direction: rtl;
    	text-align: justify;

	}
	#intitule td {
		font-weight: bold;

	}
	#sujet {
		float: right;
	}
	#sujet span {

		font-size: 16px;

	}
	#payement {
		border-collapse: collapse;
		table-layout: fixed;
		width: 100%;
		float: right;
	}

	#payement td {
		font-size: 14px;
		font-weight: bold;
		width: 50%;
		padding: 0 1px 0 1px;
	}
	#payement td:nth-child(2) {
		text-align: right;
		width: 25%;
	}
	#payement td:nth-child(1) {
		text-align: right;
		width: 25%;
		border-right: 1px solid;
		border-left: 1px solid ;
	}
	#summary {
		border-collapse: collapse;
		border : 1px solid;
		table-layout: fixed;
		width: 100%;

	}
	#summary th {
		border : 1px solid;
		width: 25%;
	}
	#summary th:first-child {
		border : 1px solid;
		width: 50%;
	}
	#summary td {
		border : 1px solid;
		font-weight: bold;
		padding: 3px 3px 3px 3px;
	}
	#summary-bottom {
		border-collapse: collapse;
		border : 1px solid;
		table-layout: fixed;
		width: 100%;
		text-align: center;

	}
	#summary-bottom th {
		border : 1px solid;
		width: 50%;
	}
	#summary-bottom td {
		border : 1px solid;
		border-top: none;
		border-bottom: none;
		font-weight: bold;
		padding: 3px 3px 3px 3px;
	}

</style>

</head>
<body contenteditable ="true">

<section id="fiche">
	<div align="center">
		<h3 style="text-decoration : underline;">	الجمهورية الجزائرية الديمقراطية الشعبية</h3>
	</div>
	
	<div style=" width : 25%;  float: right; display: inline-block;">
			<h4 style="padding: 0px 5px 0px 5px; ">  
		وزارة    {{ $ministere }}  <br>	
			مديرية {{ $direction }} <br>لولاية {{ $ville }}   </h4>
		</div>
	<div style="width : 60%; border: 1px solid;  background-color: rgb(245,245,245) !important;">
		<br>
		<span style="font-size: 1.3em; font-weight: bold;">     شهـــــــــــــــــــــــــادة  للـــــــــــــــدفع رقم {{ $pay->num }}  </span>
		<br><br>
	</div>
	<br>
	<div style="text-align: center; width: 100%; display: inline-block;">
		<div style="display: inline-block; float: right; text-align: right;">
			<span> <b>{{ $op->programme }}</b>  :  البرنامج	</span>
			<br>
			<span> <b>{{ $pay->year }}</b> : السنة     </span>
			<br>
			<span> <b>{{ $op->numero }}</b> : العملية     </span>
			<br>
			

		</div>	
	</div>
	<br><br>	
	<div style="width: 90%; display: inline-block; font-size : 17px;">
		<p dir="rtl">إن السيد مدير {{ $direction }} لولاية {{ $ville }} يشهد على صحة مبلغ 
		{{ $pay->travaux_type }} رقم {{  $pay->travaux_num }} <br> بتاريخ {{ $pay->date_pay }}
		مبلغها الصافي القابل للدفع : <strong dir="ltr"> {{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</strong>  
		{{ " "}}دج
		</p>
	</div>	
	<br><br>
	<div style="display: inline-block; width: 100%;">
		<div style="width: 60%; display: inline-block;">
			<div style="float: right; text-align: right;">
			<p dir="rtl" style="line-height : 2.1;"> 
				<span style="text-decoration : underline; font-weight : bold;">الاسترجاع</span> <br>
				التسيبق على التموين
				<br>
				<span style="font-weight : bold;">المدفوعات التي تم تسديدها للمقاولة حسب الجدول المقابل <br>
				 الباقي للدفع :
				</span>
				<br>
				يشهد أنه يمكن الدفع لمفاولة : ؤ
				<br>
				<span style="font-weight : bold;">
				  من البرنامج : </span>{{$op->programme}} &emsp; <span style="font-weight : bold;"> المادة : </span>001 <br>
				<span style="font-weight : bold;">
				من الميزانية لسنة : </span>{{$pay->year}} <br>
				<span style="font-weight : bold;">
				المبلغ : </span> <span dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</span> دج
				<br>
				<span style="font-weight : bold;">
				 أي بالأحرف : </span> <span id="montant">  </span>
			</p>
			<br><br>
				
			<div dir="ltr" style='text-align : center'>
			<span> ................. {{$ville}} في </span><br>
			</div>
			<br><br>
				
			<div dir="ltr" style='text-align : center; text-decoration : underline; font-size : 22px;'>
			<span> الـــمديــر</span><br>
			</div>

			</div>
		</div>
		<div style="width: 35%; display: inline-block; margin-left: 4%; margin-top : 20px; float : right;">
			<table id="summary">
				<tr>
					<th>المبلغ   </th>
					<th> الرقم </th>
					<th> التاريخ     </th>
					<th> السنة المالية </th>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				
				

			</table>
			<table id="summary-bottom">
				<tr>
					<td>@if($pay->old_payments != 0)  {{ number_format((float)$pay->old_payments, 2, '.', ' ')}} @endif</td>
					<td > ..........  المجمـــــــوع    </td>
				</tr>
				<tr>
					<td style="border: 0.1px dotted">@if($pay->to_pay != 0)  {{ number_format((float)$pay->to_pay, 2, '.', ' ')}} @endif</td>
					<td> مبلغ شهادة الدفع    </td>
				</tr>
				<tr>
					<td style="border: 0.1px dotted">@if($pay->to_pay != 0)  {{ number_format((float)$pay->to_pay, 2, '.', ' ')}} @endif</td>
					<td>  دفع للمفاولة   </td>
				</tr>
				
			</table>
		</div>
		
	</div>
	

</section>
<br><br><br><br>
<div align="center" id="bouton">
	<button  style="
	  background-color: lightgray; /* Green */
	  border: none;
	  color: black;
	  cursor: pointer;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;" 
  onclick="printdiv('fiche')"> طبع </button>
  <button  style="
	  background-color: lightblue; /* Green */
	  border: none;
	  color: black;
	  cursor: pointer;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;" 
  onclick="retour()"> رجوع </button>

 <br><br>
</div>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
<script src="{{ url('js/tagfeet.js') }}" ></script>
<script type="text/javascript">
window.onbeforeunload = function () {
    window.close();
};
function retour(){
	if(window.history.length == 1){
		window.close();
	}else{
		document.location.href = "/fiche_pay/{{$id}}";
	}
}

convert({{ $pay->to_pay }});

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
	txt+= " "+"دينار جزائري";
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

   /* var footstr = "</body>";
    var newstr = document.getElementById(printdivname).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = ""+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;*/
    print();
    document.getElementById('bouton').style.display = "block";
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


