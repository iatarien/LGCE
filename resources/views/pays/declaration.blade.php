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
		size: landscape;
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
	    height:210mm;
	    width:287mm;
	    margin: auto;
	    line-height: 1.5;
        font-size : 8px;
	    -webkit-print-color-adjust: exact !important;
	}
    table{
    	width:100%;
		margin-right: 0%;
		border : solid 1px black;
		border-collapse: collapse;
		text-align: center;
    }
    table td{
        white-space: wordwrap;  /** added **/
		border : solid 1px black;
        padding : 5px;
		font-weight : bold;
    }
	table th{
        white-space: wordwrap;  /** added **/
		border : solid 1px black;
        padding : 5px;
		background-color : lightgray;

    }
    .le_table td {
        border-bottom : none;
        border-top : none;
        text-align : right;
    }

    #stamp {
        width : 30mm;
        float : left;
    }
</style>
</head>
<body contenteditable="true">

<section  style="background-color: white; text-align: center; font-size: 12.5px; margin: 20px;" id="fiche">
	<div id="fiche_top" style="margin-right : 10%; margin-left : 10%;" >
		<div style="  display: inline-block; ">
			<h3>    الجمهورية الجزائرية الديمقراطية الشعبية    </h3>
            <h3>    République Algérienne Démocratique et Populaire    </h3>
		</div>
		<br>
        <div style="width : 100%; background-color : lightgray" >
            <h3>   بيان بالتحويل </h3>
        </div>
		<div style="width : 100%;" >
			<h4>نفقات مقيدة في الميزانية العامة للدولة</h4>
        </div>
		
		<div style="  display: inline-block; max-width : 50%; " dir="rtl">
        <table id="le_table">
                <tr>
                    <th style="width : 34%;">التصنيف حسب النشاط </th>
                    <th style="width : 33%;">الرمز</th>
                    <th style="width : 33%;">التسمية</th>
                </tr>
                <tr>
                    <td>محفظة البرنامج </td>
                    <td>{{$op->portefeuille}}</td>
                    <td>{{$op->ministere}}</td>
                </tr>
                <tr>
                    <td>البرنامج </td>
                    <td>{{$prog->code}}</td>
                    <td>{{$prog->designation}}</td>
                </tr>
                <tr>
				<td> النشاط</td>
					<td>{{$op->activite}}</td>
					@if($op->source =="PSC")
					<td>َتفويض التسيير القطاعي الممركز</td>
					@else
					<td>َتفويض التسيير الغير ممركز</td>
					@endif
					
                </tr>
                <tr>
                    <td>النشاط الفرعي </td>
					<td></td>
					<td></td>
                </tr>
        </table>
      <br>  
      @if($op->source == "PSC") 
				<div id="stamp"  style = "border : 5px solid transparent; margin-left : 20mm;  font-weight : bold; color : transparent; font-size : 5mm; padding : 2px; ">
				302.145.001
				</div>
				@elseif($op->source == "PSD")
				<div id="stamp"  style = "border : 5px solid transparent; margin-left : 20mm;  font-weight : bold; color : transparent; font-size : 5mm; padding : 2px;">
				302.145.002
				</div>
				@elseif($op->source == "FSDRS")
				<?php $sf = substr($op->numero, 0, 2); ?>
					@if($sf == "SF")
					<div id="stamp"  style = "border : 5px solid transparent; margin-left : 20mm;  font-weight : bold; color : transparent; font-size : 5mm; padding : 2px;">
					302.145.012
					</div>
					@else
					<div id="stamp"  style = "border : 5px solid transparent; margin-left : 20mm;  font-weight : bold; color : transparent; font-size : 5mm; padding : 2px;">
					302.145.010
					</div>
					@endif
				@endif

        </div>
		<div style="  display: inline-block; width : 20%; float: right;">
            <h3 dir="rtl" style="text-align : right;"> رمز الأمر بالصرف : {{$ordre}}<br>
			سنة التسيير : {{ $pay->year}} <br>
             رقم  الحوالة :  <br>
             تاريخ  الحوالة :  <br>
			 طريقة الدفع : {{$bank->bank}} وكالة : {{$bank->bank_agc}}  <br>
			</h3>
            
		</div>
		<div style="  display: inline-block; float: right; margin-top : 2%;
		width : 25%; margin-right : 2%; margin-left : 2%;">
			<table style="text-align : right">
				<tr>
					<td>المحاسب العمومية المخنص : <span>  السيد أمين الخزينة لولاية {{$ville}}  
					</span>
					</td>
                </tr>
				<tr>
					<td dir="rtl">  الخزينة RIB  : <span dir="rtl">ح ج ب رقم {{$compte_tresor}} الجزائر </span> </td>
                </tr>
        	</table>
            <br>
		</div>
        
		<div dir="rtl" style="  display: inline-block; width : 60%; font-weight :  normal; text-align : justify; ">
            <table style="border : none;">
                <tr>
                    <th style="width : 25%;">تحديد المستفيد  </th>
					<th style="width : 10%;">البرنامج الفرعي  </th>
					<th style="width : 20%;">رقم الحساب الدائن</th>
                    <th style="width : 25%;">المبلغ</th>                
				</tr>
                <tr>
                    <td>{{$e->name}}</td>
					<td>{{$prog->code}}.{{$sous_prog->code}}<br>{{$sous_prog->designation}}</td>
                    <td>
						{{$bank->bank_acc}} <br>
					</td>
                   	<td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}} </td>
                </tr>
				<tr>
					<td colspan="2" style="border : none;"></td>
                    <td>المجموع</td>
                   	<td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}} </td>
                </tr>
            </table>
			<br>
			<div align= "center">
			توقف مجموع هذا الجدول على مبلغ : <b id="montant">   </b>
			<div>
			<br>
			<div align="left">
				<b> الأمـــر بالصــرف </b>
				<br>
			</div>
	    </div>
        <br><br>
        
</section>
<br>


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
  onclick="retour()">رجوع </button>
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
function retour(){
	if(window.history.length == 1){
		window.close();
	}else{
		document.location.href = "/fiche_pay/{{$id}}";
	}
}
function hide_stamp(){
	document.getElementById('stamp').style.visibility ="hidden";
	
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
	//document.getElementById('bouton_3').style.display = "none";
   /* var footstr = "</body>";
    var newstr = document.getElementById(printdivname).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = ""+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;*/
    print();
    document.getElementById('bouton').style.display = "inline-block";
	document.getElementById('bouton_2').style.display = "inline-block";
	//document.getElementById('bouton_3').style.display = "inline-block";
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


