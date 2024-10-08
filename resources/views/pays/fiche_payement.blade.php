<!DOCTYPE html>
<html>
<head>
	  <!-- Bootstrap CSS -->
	  <link href="{{ url('css/bootstrap.min.css')}}" rel="stylesheet">
	  <!-- bootstrap theme -->
	<title></title>
<style type="text/css" > 
	@page {
	    size: auto;   /* auto is the initial value */
		size: A4 portrait;
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
	    height:297mm;
	    width:210mm;
	    margin: auto;
	    line-height: 1.45;
	    -webkit-print-color-adjust: exact !important;
	}
	#numero {
		border-collapse: collapse;
		border: 1px solid;
		table-layout: fixed;
		width : 70%;

	}
	#numero td {

		font-weight: bold;
		border: 1px solid;
		font-size: 16px;
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
		border : 1px solid;
		table-layout: fixed;
		width: 100%;
	}
	#payement th {
		border : 1px solid;
		width: 28%;
		font-size: 16px;
		background-color: rgb(245,245,245) !important;
	}
	#payement td {
		border : 1px solid;
		font-size: 16px;
		font-weight: bold;
		padding: 0 3px 0 3px;
	}
	#payement td:first-child {
		border : none;
	}
	#summary {
		border-collapse: collapse;
		border : 1px solid;
		table-layout: fixed;
		width: 750px;

	}
	#summary th {
		border : 1px solid;
		width: 150px;
		font-size: 16px;
		background-color: rgb(245,245,245) !important;
	}
	#summary td {
		border : 1px solid;
		font-size: 16px;
		font-weight: bold;
		padding: 0 3px 0 3px;
	}
	#CF {
		float: right;
		border-collapse: collapse;
		border : 1px solid;
		table-layout: fixed;
		width : 250px;
		text-align: right;
	}
	#CF td {
		font-size: 16px;
		font-weight: bold;
		padding: 0 3px 0 3px;
	}
</style>

</head>
<body contenteditable ="true">

<section style="background-color: white; text-align: center; font-size: 12px; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div style=" border: 1px solid; display: inline-block; background-color: rgb(245,245,245) !important; ">
			<h3 style="text-decoration: underline; padding: 0px 5px 0px 5px;">    بطـــــــــــــاقة  الدفــــــــــــــع   </h3>
		</div>
		<div style=" display: inline-block; float: right; margin-right: 30px; ">
			<h3 style="text-decoration: underline; padding: 0px 5px 0px 5px;"> عمليات الميزانية </h3>
		</div>
		<br>
		<div style=" border: 1px solid; display: inline-block; float: left; background-color: rgb(245,245,245) !important; ">
			<h3 style="padding: 0px 5px 0px 5px;">ميــــــــــزانيــــة التجهيــــــــز</h3>
		</div>
		@if($pay->type == "FSDRS")
		<?php $sf = substr($op->numero, 0, 2); ?>
		<div style=" display: inline-block;">
		@if($sf == "SF")
			<h3 style="padding: 0px 5px 0px 5px;">   حساب خاص   <br> رقم 145.012-302 	</h3>
		@else
			<h3 style="padding: 0px 5px 0px 5px;">   حساب خاص   <br> رقم 145.010-302 	</h3>
		@endif
		</div>
		@else
		<div style=" display: inline-block; visibility : hidden;">
			<h3 style="padding: 0px 5px 0px 5px;">   حساب خاص   <br> رقم 089.002-302  	</h3>
		</div>
		@endif
		<div style=" border: 1px solid; display: inline-block; float: right; background-color: rgb(245,245,245) !important; ">
			<h3 style="padding: 0px 5px 0px 5px;">      مديرية التجهيزات العمومية لولاية ورقلة   </h3>
		</div>
		
		<br>
		
		<table id="numero">
			<tr>
				<td style="width: 90px; background-color: rgb(245,245,245) !important; ">       
				رقم بطاقة الإلتزام   </td>
				<td style="width: 90px; background-color: rgb(245,245,245) !important; ">       البطاقة </td>
				<td style="width: 200px; background-color: rgb(245,245,245) !important; "> رقم الــــــعمـــلــــــــــــــية</td>
				
			</tr>
			<tr>
				<td>{{ $pay->numero_fiche }}</td>
				<td>{{ $pay->fiche_pay }}</td>
				<td>{{ $op->numero }}</td>
			</tr>
		</table>

		<div style=" display: inline-block; float: right; margin-right: 30px; ">
			<h3 style="font-weight: bold;"> خـــــــــلاصـــــــــــــــــــــــــــة   </h3>
		</div>
		<br>
		<table id="summary" >
			<tr>	
				<th>     الملا حظــــــــــــــــــــــــــــــــــات    </th>
				<th>    مجمــــــــــوع الـــــدفعــــات    </th>
				<th>    الدفـــــــــــع المقــــــــــــــــــرح    </th>
				<th style=" border : none; text-align: center;">   المبلغ القــــــــــــديم </th>
			</tr>
			<tr>	

				<td></td>
				<td>{{ number_format((float)$pay0->cumul_new, 2, '.', ' ')}} </td>
				<td> {{ number_format((float)$pay->to_pay, 2, '.', ' ')}}  </td>
				<td>{{ number_format((float)$pay0->cumul_old, 2, '.', ' ')}} </td>
			</tr>
		</table>
		<br><br>
		<table id="CF">
			<tr><td>  ..................... &emsp;&emsp;&emsp; رقم الأمر بالدفع   </td></tr>
			<tr><td>  ..................... &emsp;&emsp;&emsp;&emsp;    التاريــــــــخ    </td></tr>
			<tr><td>  ..................... &emsp;&emsp;   مقبول للدفع بتاريخ    </td></tr>
		</table>
		<div style="font-size: 16px; font-weight: bold; float: left;margin-left: 50px;" >
			@if($op->source == "PSC") 
			<div id="stamp1"  style = "text-align : center; padding : 5px; float : right; border : 5px solid red; margin-left : 10mm; width : 150px; font-weight : bold; color : red; font-size : 7mm;">
			عــن الــوزير
			</div>
			@else
			<div id="stamp1"  style = "text-align : center; padding : 5px; float : right; border : 5px solid red; margin-left : 10mm; width : 150px; font-weight : bold; color : red; font-size : 7mm;">
			عــن الــــوالي
			</div>
			@endif
			<span>         ................... ورقلة في        </span><br><br>
			<span>         الأمر بالصرف      </span><br>
			<img id="stamp2" src="/img/cachet.jpeg" style="width : 130px; display : none;">
			
		</div>
	</div>
	

</section>
<br><br><br><br><br><br><br><br>
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
  <button  style="
	  background-color: pink; /* Green */
	  border: none;
	  color: black;
	  cursor: pointer;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;" 
  onclick="hide_stamp()"> إخفاء الختم </button>
 <br><br><br><br>
</div>
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
function hide_stamp(){
	document.getElementById('stamp').style.visibility ="hidden";
	document.getElementById('stamp1').style.visibility ="hidden";
	document.getElementById('stamp2').style.visibility ="hidden";
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
</script>
</body>
</html>


