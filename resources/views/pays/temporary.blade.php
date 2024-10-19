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
			height:297mm;
	    	width:210mm;
			margin: 0 !important; 
			padding: 0 !important;
			/* overflow-y: hidden; */
		}
	}
	html,body{
	    height:297mm;
	    width:210mm;
	    margin: auto;
	    margin-top: 5mm !important;
	    line-height: 1.3;
	    font-size: 15px;
	    -webkit-print-color-adjust: exact !important;
		page-break-after: auto;
	}
	#fiche {
		margin: 20px;
		text-align: center;
		margin-bottom : 5px;
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
		width: 90%;
        margin-left : 5%;
        margin-right : 5%;
		float: right;
        border : 1px solid;
        margin-bottom : 50px;
	}

	#payement td {
		font-size: 15px;
		font-weight: bold;
		width: 50%;
		padding: 5px 5px 5px 5px;
        text-align: center;
        border : 1px solid;
	}
	#payement td:nth-child(2) {
        width : 35%;

	}
	#payement td:nth-child(3) {
		width : 15%;
	}
	#summary {
		border-collapse: collapse;
		border : 1px solid;
		table-layout: fixed;
		width: 100%;

	}

	h4 {
		line-height : 0.35;
	}
	b {
		line-height : 1.5;
	}
</style>

</head>
<body contenteditable ="true">

<section id="fiche">
	<div>
		<h3 >   الجمهورية الجزائرية الديمقراطية الشعبية   </h3>
	</div>
	<div style="text-align: center; width: 100%; display: inline-block;">
		<div dir="rtl" style="display: inline-block; float: right; text-align: right;">
            <h4> ولاية {{$ville}}</h4>
            <h4> مديرية {{$direction}}</h4>
            <br>
			<h4> السنة المالية : {{$pay->year}}</h4>
			<h4> محفظة البرنامج : {{$op->portefeuille}}&emsp;&emsp; وزارة {{$ministere}}</h4>
			<h4>  البرنامج : {{$op->programme}} &emsp;&emsp; {{$prog->designation}}</h4>
			<h4>  البرنامج الفرعي : {{$sous_prog->code}} &emsp;&emsp; {{$sous_prog->designation}}</h4>
			<?php $act_txt = "";
			if($op->source =="PSC"){
				$act_txt = $act_txt. "نشاط ممركز ";
			}else{
				$act_txt = $act_txt. "نشاط غير ممركز ";
			}
			$act_txt = $act_txt." البرنامج الجاري لولاية ميلة";
			?>	
            <h4>  الــنشاط : {{$op->activite}} &emsp;&emsp; {{$act_txt}}</h4>
			@if($op->sous_action !==NULL )
			<?php $sousy = explode(".",$op->sous_action)[0]; ?>
            <h3>  رمز النشاط الفرعي : {{$sousy}}</h3>
			@else
			<h3>  رمز النشاط الفرعي : /</h3>
			@endif



		</div>
	
	</div>
	<div style="display: inline-block; width: 100%;">
		<div style="width: 60%; display: inline-block;">
			<div align="center" dir="rtl">
			
			<div style="float: right; text-align: right;">
			<p dir="rtl">
				<b>رقم العملية :</b> {{$op->numero}}<br>
				<b>عنوان العملية :</b> {{$op->intitule_ar}}<br><span dir="ltr">{{$op->intitule}}</span><br>
                <b>{{$pay->deal_type }} رقم : </b> {{ $pay->deal_num}}<br>
				<b> المشروع :</b> {{$pay->lot}}<br>
				<b> المؤسسة :</b> {{$e->name}}<br>
				<b> أشغال منجزة لنفقات منفذة بتاريخ :</b> {{$pay->date_pay}}<br>
			</p>
		</div>
		<div style="width: 35%; display: inline-block; margin-left: 4%; float : right; visibility : hidden;">

		</div>
</section>
</div>
<h4 style="float : right; margin-right : 5%; margin-top : 0px;" dir="rtl">   دفعة جزئية : <span dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</span>
			</h4>
<table id="payement" dir="ltr">
        <tr>
            <td colspan="2" style="text-align : center;">النفــــقات</td>
            <td rowspan="2" style="text-align : center;">تحديد نوعية الأشغال</td>
            <td rowspan="2" style="text-align : center;">الرقم التسلسلي للجدول</td>
        </tr>
        <tr>
            <td style="text-align : center;">الباقي</td>
            <td style="text-align : center;">الخام</td>
        </tr>
        <tr>
            <td>{{ number_format((float)$pay->etude_done, 2, '.', ' ')}}</td>
            <td>{{ number_format((float)$pay->etude_done, 2, '.', ' ')}}</td>
            <td><span style="opacity : 0.3;"></span>   أشغال منجزة</td>
            <td>01</td>
        </tr>
        <tr>
            <td>{{ number_format((float)$pay->avan_done, 2, '.', ' ')}}</td>
            <td>{{ number_format((float)$pay->avan_done, 2, '.', ' ')}}</td>
            
            <td><span style="opacity : 0.3;"></span> التسبيق الجزافي    </td>
            <td>02</td>
        </tr>
        <tr>
            <td>{{ number_format((float)$pay->extra_done, 2, '.', ' ')}}</td>
            <td>{{ number_format((float)$pay->extra_done, 2, '.', ' ')}}</td>
            <td><span style="opacity : 0.3;"></span>التسبيق على التموين    </td>
            <td>03</td>
        </tr>
        <tr>
            <td> {{ number_format((float)$pay->assurance_cut, 2, '.', ' ')}}</td>
            
            <td> {{ number_format((float)$pay->assurance_cut, 2, '.', ' ')}}</td>
            
            <td><span style="opacity : 0.3;"></span>خصم الضمان    </td>
            <td>04</td>
        </tr>
		<?php $i = 4; $yes ="";?>

		@if(($pay->rev1_done != NULL && $pay->rev1_done != 0) || ($pay->rev2_done != NULL && $pay->rev2_done != 0))
		<?php $yes = "yes"; ?>
		@endif
		<?php $i++;  ?>
		@if(($pay->rev1_done != NULL && $pay->rev1_done != 0) || $yes =="yes")
		<tr>
            <td> {{ number_format((float)$pay->rev1_done, 2, '.', ' ')}}</td>
            
            <td> {{ number_format((float)$pay->rev1_done, 2, '.', ' ')}}</td>
            
            <td><span style="opacity : 0.3;"></span> مراجعة الاسعار   </td>
            <td>0{{$i}}</td>
        </tr>
		@endif
		@if(($pay->rev2_done != NULL && $pay->rev2_done != 0) || $yes =="yes")
		<?php $i++; $yes = "yes";?>
		<tr>
            <td> {{ number_format((float)$pay->rev2_done, 2, '.', ' ')}}</td>
            
            <td> {{ number_format((float)$pay->rev2_done, 2, '.', ' ')}}</td>
            
            <td><span style="opacity : 0.3;"></span>  تحيين الاسعار   </td>
            <td>0{{$i}}</td>
        </tr>
		@endif
		@if(($pay->revision_done != NULL && $pay->revision_done != 0) || $yes =="" )
		<?php $i++; ?>
        <tr>
            <td> {{ number_format((float)$pay->revision_done, 2, '.', ' ')}}</td>
            
            <td> {{ number_format((float)$pay->revision_done, 2, '.', ' ')}}</td>
            
            <td><span style="opacity : 0.3;"></span> مراجعة و تحيين الاسعار   </td>
            <td>0{{$i}}</td>
        </tr>
		@endif
		<?php $i++; ?>
        <tr>
            <td> {{ number_format((float)$pay->avancement_cut, 2, '.', ' ')}}</td>
            <td>{{ number_format((float)$pay->avancement_cut, 2, '.', ' ')}}</td>
            
            <td><span style="opacity : 0.3;"></span>   تعويض على التسبيق الجــــزافي      </td>
            <td>0{{$i}}</td>
        </tr>
		<?php $i++; ?>
        <tr>
            <td> {{ number_format((float)$pay->sanction_cut, 2, '.', ' ')}}</td>
            <td>{{ number_format((float)$pay->sanction_cut, 2, '.', ' ')}}</td>
            
            <td><span style="opacity : 0.3;"></span>تعويض  على التموين     </td>
            <td>0{{$i}}</td>
        </tr>

    </table>

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


