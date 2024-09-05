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
	    line-height: 1.3;
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
		font-size: 16px;
		font-weight: bold;
		width: 20%;
		padding: 0 1px 0 1px;
	}
	#payement td:nth-child(2) {
		text-align: right;
		width: 25%;
		font-weight : normal;
	}
	#payement td:nth-child(1) {
		display : none;
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
			
            <h4>   النشاط الفرعي : {{$op->sous_action}}</h4>
			@else
			<h4>   النشاط الفرعي : /</h4>
			@endif
			<h4>   دفعة جزئية : <span dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</span>
			&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			<span style="font-size: 1.3em; font-weight: bold;">      {{$pay->deal_type }} رقم  {{ $pay->deal_num}}  </span>
			</h4>


		</div>
	
	</div>
	<div style="display: inline-block; width: 100%;">
		<div style="width: 60%; display: inline-block;">
			<div align="center" dir="rtl">
			<br>
			<span style="font-size: 1.3em; font-weight: bold; text-decoration : underline;">  
				شهادة الدفع
			</span>
			</div>

			<br>
			
			<div style="float: right; text-align: right;">
			<p dir="rtl">
				<b>رقم العملية :</b> {{$op->numero}}<br>
				<b>عنوان العملية :</b> {{$op->intitule_ar}}<br><span dir="ltr">{{$op->intitule}}</span><br>
				<b> المشروع :</b> {{$pay->lot}}<br>
				<b> المؤسسة :</b> {{$e->name}}<br>
				<b> أشغال موجودة بال{{$pay->deal_type}} بتاريخ :</b> {{$pay->deal_date}}<br>
				<b> مصادق عليها في :</b> {{$pay->date_visa}}<br>
				<b> بمبلغ :</b> <span dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</span><br>
			</p>
			<p dir="rtl"> <b>  نحن  والي ولاية {{$ville}} الممضي أسفله</b>
				<b> نظرا للحساب المؤقت رقم  : </b> {{$pay->num}}<br>
				<b> الذي تبين منه الأشغال المنجزة بتاريخ :</b> {{$pay->date_pay}}<br>
			</p>
				<table id="payement">
					<tr>
						<td style="border-top : 1px solid;"></td>
						<td>{{ number_format((float)$pay->etude_done, 2, '.', ' ')}}</td>
						<td><span style="opacity : 0.3;"></span>  : أشغال منجزة</td>
						<td style="display: none;">1</td>
					</tr>
					<tr>
						<td></td>
						<td>{{ number_format((float)$pay->avan_done, 2, '.', ' ')}}</td>
						
						<td><span style="opacity : 0.3;"></span> :   التسبيق الجزافي    </td>
						<td style="display: none;">9</td>
					</tr>
					<tr>
						<td></td>
						<td>{{ number_format((float)$pay->extra_done, 2, '.', ' ')}}</td>
						<td><span style="opacity : 0.3;"></span> :  التسبيق على التموين    </td>
						<td style="display: none;">3</td>
					</tr>
					<tr>
						<td style="text-align: center;"></td>
						
						<td> {{ number_format((float)$pay->assurance_cut, 2, '.', ' ')}}</td>
						
						<td><span style="opacity : 0.3;"></span> :  خصم الضمان    </td>
						<td style="display: none;">11</td>
					</tr>
					@if($pay->rev1_done != NULL && $pay->rev1_done != 0)
					<tr>
						<td style="text-align: center;"></td>
						
						<td> {{ number_format((float)$pay->rev1_done, 2, '.', ' ')}}</td>
						
						<td><span style="opacity : 0.3;"></span> :   مراجعة الاسعار   </td>
						<td style="display: none;">11</td>
					</tr>
					@endif
					@if($pay->rev2_done != NULL && $pay->rev2_done != 0)
					<tr>
						<td style="text-align: center;"></td>
						
						<td> {{ number_format((float)$pay->rev2_done, 2, '.', ' ')}}</td>
						
						<td><span style="opacity : 0.3;"></span> :    تحيين الاسعار   </td>
						<td style="display: none;">11</td>
					</tr>
					@endif
					<tr>
						<td style="text-align: center;"></td>
						
						<td> {{ number_format((float)$pay->revision_done, 2, '.', ' ')}}</td>
						
						<td><span style="opacity : 0.3;"></span> :   مراجعة و تحيين الاسعار   </td>
						<td style="display: none;">11</td>
					</tr>
					<tr>
						<td></td>
						<td>{{ number_format((float)$pay->avancement_cut, 2, '.', ' ')}}</td>
						
						<td><span style="opacity : 0.3;"></span>  :    تعويض على التسبيق الجــــزافي      </td>
						<td style="display: none;">9</td>
					</tr>

					

					<tr>
						<td style="border-bottom: 1px solid;"></td>
						<td>{{ number_format((float)$pay->sanction_cut, 2, '.', ' ')}}</td>
						
						<td><span style="opacity : 0.3;"></span> :  تعويض  على التموين     </td>
						<td style="display: none;">12</td>
					</tr>

					<tr>
						<td style="text-align: center;"></td>
						<td><span style="opacity : 0.3;"></span>{{ number_format((float)$total, 2, '.', ' ')}}</td>
						<td><span style="opacity : 0.3;"></span>   :   الباقي للدفع     </td>
						<td style="display: none;">13</td>
					</tr>

					<tr>
						<td style="text-align: center;"></td>
						<td><span style="opacity : 0.3;"></span>{{ number_format((float)$pay->old_payments, 2, '.', ' ')}}</td>
						<td> : الذي سدد منه   </td>
						<td style="display: none;">14</td>
					</tr>

					<tr>
						<td style="border-bottom : 1px solid; border-top : 1px solid; text-align: center;"></td>
						<td><span style="opacity : 0.3;"></span>{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
						<td> <span style="opacity : 0.3;"></span>  :   الباقي للتسديد   </td>
						<td style="display: none;">15</td>
					</tr>
				</table>
				<p style="color: transparent;">dgggggggggggggggggggg</p>
				@if($op->source == "FSDRS")
				<?php $sf = substr($op->numero, 0, 2); ?>
					@if($sf == "SF")
					<?php $chap_chap = "302.145.012"; ?>
					@else 
					<?php $chap_chap = "302.145.010"; ?>
					@endif
				@else 
					<?php $chap_chap =  $op->programme."-".$op->sous_programme; ?>
				@endif
				<?php ?>
				<div dir='rtl'>

					<p> <b> يشهد  أنه   يمكن التسديد الى المؤسسة :  </b> <span> {{ $e->name }} </span> 
					<br> <b>المبلغ :  </b>
					<span id="montant" style="font-weight: bold;">  </span>
					</p>
					@if($op->source == "PSC") 
					<div id="stamp1"  style = "text-align : center; visbility hidden; padding : 3px; margin-right : 20%; float : right; border : 5px solid transparent; margin-left : 10mm; width : 150px; font-weight : bold; color : transparent; font-size : 6mm;">
					عــن الــوزير
					</div>
					@else
					<div id="stamp1"  style = "text-align : center; visbility hidden; padding : 3px; margin-right : 20%; float : right; border : 5px solid transparent; margin-left : 10mm; width : 150px; font-weight : bold; color : transparent; font-size : 6mm;">
					عــن الــــوالي
					</div>
					@endif
				</div>

			</div>
		</div>
		<div style="width: 35%; display: inline-block; margin-left: 4%; float : right; margin-top : 80px;">
			<div style="border: 1px solid; padding : 10px;">
				<span> شهادات حررت </span>
			</div>
			<table id="summary">
				<tr>
					<th>المبلغ   </th>
					<th> السنة     </th>

				</tr>
				<tr>
					<td><span>@if($pay->old_payments != 0)  {{ number_format((float)$pay->old_payments, 2, '.', ' ')}}@else &emsp;@endif</span></td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>

				</tr><tr>
					<td>&emsp;</td>
					<td></td>

				</tr><tr>
					<td>&emsp;</td>
					<td></td>

				</tr><tr>
					<td>&emsp;</td>
					<td></td>

				</tr>
				

			</table>
			<table id="summary-bottom">
				<tr>
					<td>@if($pay->old_payments != 0)  {{ number_format((float)$pay->old_payments, 2, '.', ' ')}} @endif</td>
					<td>   المجمـــــــوع السابق   </td>
				</tr>
				<tr>
					<td style="border: 0.1px dotted">@if($pay->to_pay != 0)  {{ number_format((float)$pay->to_pay, 2, '.', ' ')}} @endif</td>
					<td>   الدفعة المسلة   </td>
				</tr>
				<tr>
					<td style="border: 0.1px dotted">@if($pay->to_pay  != 0)  {{ number_format((float)$total, 2, '.', ' ')}} @endif</td>
					<td>  المجموع العام  </td>
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
hide_stamp();
function hide_stamp(){
	document.getElementById('stamp1').style.visibility ="hidden";
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


