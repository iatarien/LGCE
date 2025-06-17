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
		margin-right : 60px;
		margin-left : 60px;
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
    #le_table {
        width: 100%;
        margin-right: 0%;
        border: solid 1px black;
        border-collapse: collapse;
        text-align: center;
    }
    #le_table td {
        border-bottom : none;
        border-top : none;
        text-align : left;
        border : 1px solid;
    }
    #le_table th {
        border-bottom : none;
        border-top : none;
        text-align : left;
        border : 1px solid;
    }
</style>

</head>
<body contenteditable ="true">

<section id="fiche">
<div style="  display: inline-block; ">
            <h3>    République Algérienne Démocratique et Populaire    </h3>
		</div>
    <div style="  display: inline-block; width : 100%; float : left;" dir="ltr">
        <table id="le_table" style="width : 70%; margin-bottom : 2%;">
                <tr>
                    <th style="width : 34%;">Classification par activité </th>
                    <th style="width : 20%;">Code</th>
                    <th style="width : 46%;">Intitulé</th>
                </tr>
                <tr>
                    <td>Portefeuille</td>
                    <td>{{$op->portefeuille}}</td>
                    <td>{{$op->ministere_fr}}</td>
                </tr>
                <tr>
                    <td>Programme </td>
                    <td>{{$prog->code}}</td>
                    <td>{{$prog->designation_fr}}</td>
                </tr>
                <tr>
                    <td> Action</td>
                    <td>{{$op->activite}} </td>
                    @if($op->source =="PSC")
                    <td>َProgramme Sectoriel Centralisé</td>
                    @else
                    <td>Programme Sectoriel Déconcentrés</td>
                    @endif
                        
                </tr>
                <tr>
                    <td> Sous Action </td>
                    <td>{{$op->sous_action}}</td>
                    <td></td>
                </tr>
        </table>
    </div>

	<div> 
		<span style="font-size: 1.5em; text-decoration: underline; font-weight: bold;">    CERTIFICAT POUR PAIEMENT</span>
		<br>
	</div>
	<br>
	<div style="text-align: center; width: 100%; display: inline-block;">
		<div style="display: inline-block; float: left; text-align: left; width : 50%;">
            <br>
			<b> OPERATION N ° : {{$op->numero}} </b>
			<br>
            <b> VISA CF N ° : {{$pay->num_visa}} DU {{$pay->date_visa}} </b>
			<br>
            <b> FICHE ENG N ° : {{$pay->numero_fiche}} </b>
			<br><br>
            <b> ENTREPRENEUR : {{$e->name}} </b>
			<br>
		</div>
        <div style="display: inline-block; float: left; text-align: left; width : 50%;">
            <b> BUDGET D'EQUIEPEMENT </b>
			<br>
            <b> EXERCICE : {{$pay->year}} </b>
			<br>
            <b> ACTION : {{$direction_fr}} </b>
			<br>
            <b> CHAPITRE : {{$titre->definition_fr}} </b>
			<br>
            <b> ARTICLE : {{$sous_titre->definition_fr}} </b>
			<br>
            <b> SOMME A PAYER : {{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</b>
			<br><br>
            <b> MAndat N° : {{$pay->num_mondat}} </b>
		</div>
        <div style="display: inline-block; float: left; text-align: left; width : 100%;">
            <br>
            <b> COMPTE BANCAIRE N° : {{$bank->bank_acc}} </b>
		</div>


		<br><br><br>
		
		
	</div>
	<div style="display: inline-block; width: 100%;">
		<div style="width: 55%; display: inline-block; float : right">
			<div align="center" dir="rtl">
			
			<span style="font-size: 1.3em; font-weight: bold;">      {{$pay->deal_type }} رقم  {{ $pay->deal_num}}  </span>

				<br>
				<span style="font-size: 1.17em; font-weight: bold;"> المقاول  : {{ $e->name }}    </span>
			</div>
			
			<p dir="rtl">
			{{ $pay->lot }}
			</p>
			<div dir="rtl" style="float: left; text-align: justify;">
				<span>      الصافي للدفع  :&emsp; 
					<b dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</b>   </span>
				<br>
				<span> 		المبلغ الخام  : &emsp;
					<b dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</b> </span><br>
				<span dir="ltr" style="margin-right: 20px;"> &emsp;&emsp;&emsp;.............. حوالة رقم    </span>
			</div>
			<div style="float: right; margin-right : 10mm;  text-align: justify;">
				@if($op->source == "PSC") 
				<div id="stamp" style = "border : 5px solid transparent; margin-left : 10mm; width : 80%; font-weight : bold; color : transparent; font-size : 7mm;">
				302.145.001
				</div>
				@elseif($op->source == "PSD")
				<div id="stamp"  style = "border : 5px solid transparent; margin-left : 10mm; width : 80%; font-weight : bold; color : transparent; font-size : 7mm;">
				302.145.002
				</div>
				@elseif($op->source == "FSDRS")
				<?php $sf = substr($op->numero, 0, 2); ?>
					@if($sf == "SF")
					<div id="stamp"  style = "border : 5px solid transparent; text-align : center; margin-left : 10mm; width : 80%; font-weight : bold; color : transparent; font-size : 5mm;">
					302.145.012
					</div>
					@else 
					<div id="stamp"  style = "border : 5px solid transparent; text-align : center; margin-left : 10mm; width : 80%; font-weight : bold; color : transparent; font-size : 5mm;">

					302.145.010
					</div>
					@endif
				@endif
			</div>
			<br>
			<div style="float: right; text-align: right;">
				@if($pay->deal_date != NULL )
					@if($pay->travaux_num !=NULL)
						<p dir="rtl">   ان السيد والي ولاية {{$ville}}  <br> نظرا {{ "ل".$pay->deal_type }} رقم  {{ $pay->deal_num }}/{{ date('Y', strtotime($pay->deal_date)) }} المصادق عليها في {{ $pay->deal_date}} 
						لفائدة المقاول  المذكور أعلاه لغرض تنفيذ الأشغال المذكورة سابقا و المحددة حسب جدول الأسعار  <br> نظرا لوثائق  رقم     <br> و المنتج عنه الأعمال المتمة و النفقات التي تمت بموجب رقم المشار إليها </p>
					@else
						<p dir="rtl">   ان السيد والي ولاية {{$ville}}  <br> نظرا {{ "ل".$pay->deal_type }} رقم  {{ $pay->deal_num }}/{{ date('Y', strtotime($pay->deal_date)) }} المصادق عليها في {{ $pay->deal_date}} 
						لفائدة المقاول  المذكور أعلاه لغرض تنفيذ الأشغال المذكورة سابقا و المحددة حسب جدول الأسعار  <br> نظرا لوثائق  ؤقم   <br>  و نظرا  ل{{ $pay->travaux_type }} رقم    {{ $pay->travaux_num }} بتاريخ   <span dir="ltr">{{ $pay->date_pay }}</span>  <br> و المنتج عنه الأعمال المتمة و النفقات التي تمت بموجب رقم المشار إليها </p>		
					@endif
				@else 
					@if($pay->travaux_num !=NULL)
						<p dir="rtl">   ان السيد والي ولاية {{$ville}}  <br> نظرا {{ "ل".$pay->deal_type }} رقم  {{ $pay->deal_num }}
						لفائدة المقاول  المذكور أعلاه لغرض تنفيذ الأشغال المذكورة سابقا و المحددة حسب جدول الأسعار  <br> نظرا لوثائق  ؤقم     <br> و المنتج عنه الأعمال المتمة و النفقات التي تمت بموجب رقم المشار إليها </p>		
					@else
						<p dir="rtl">   ان السيد والي ولاية {{$ville}}  <br> نظرا {{ "ل".$pay->deal_type }} رقم  {{ $pay->deal_num }} 
						لفائدة المقاول  المذكور أعلاه لغرض تنفيذ الأشغال المذكورة سابقا و المحددة حسب جدول الأسعار  <br> نظرا لوثائق  ؤقم   <br>  و نظرا  ل{{ $pay->travaux_type }} رقم    {{ $pay->travaux_num }} بتاريخ   <span dir="ltr">{{ $pay->date_pay }}</span>  <br> و المنتج عنه الأعمال المتمة و النفقات التي تمت بموجب رقم المشار إليها </p>
					@endif
				@endif
				<table id="payement">
					<tr>
						<td style="border-top : 1px solid;"></td>
						<td>@if($pay->etude_done != 0)  {{ number_format((float)$pay->etude_done, 2, '.', ' ')}} @endif </td>
						<td><span style="opacity : 0.3;">.....................................</span> أشغال تامة  </td>
						<td style="display: none;">1</td>
					</tr>

					<tr>
						<td></td>
						<td>@if($pay->non_termine_done != 0)  {{ number_format((float)$pay->non_termine_done, 2, '.', ' ')}} @endif</td>
						<td><span style="opacity : 0.3;">...................................</span> أشغال غير متمة   </td>
						<td style="display: none;">2</td>
					</tr>

					<tr>
						<td></td>
						<td>@if($pay->extra_done != 0)  {{ number_format((float)$pay->extra_done, 2, '.', ' ')}} @endif</td>
						<td><span style="opacity : 0.3;">......................................</span>  أشغال إضافية    </td>
						<td style="display: none;">3</td>
					</tr>
					<tr>
						<td></td>
						<td>@if($pay->avan_done != 0)  {{ number_format((float)$pay->avan_done, 2, '.', ' ')}} @endif</td>
						
						<td><span style="opacity : 0.3;">.......................</span>  التسبيقات الجزافية   </td>
						<td style="display: none;">9</td>
					</tr>
					<tr>
						<td rowspan="2" style="text-align: center;">@if($pay->total_done != 0)  {{ number_format((float)$pay->total_done, 2, '.', ' ')}} @endif</td>
						<td></td>
						
						<td><span style="opacity : 0.3;">.......................</span>   تموين  5/4 من قيمتها  </td>
						<td style="display: none;">4</td>
					</tr>

					<tr>
		
						<td style="border : none;"></td>
						<td><span style="opacity : 0.3;">..........................</span> أشغال التسيير   </td>
						<td style="display: none;">5</td>
					</tr>

					<tr>
						<td></td>
						<td></td>
						<td><span style="opacity : 0.3;">..................................</span>  تسديد النفقات   </td>
						<td style="display: none;">6</td>
					</tr>

					<tr>
						<td></td>
						<td></td>
						<td><span style="opacity : 0.3;">......................................</span> الضمان  </td>
						<td style="display: none;">7</td>
					</tr>

					<tr>
						<td style="border-bottom: 0.1px dotted;"></td>
						<td></td>
						<td><span style="opacity : 0.3;">............................</span> مراجعة الأسعار  </td>
						<td style="display: none;">8</td>
					</tr>

					<tr>
						<td></td>
						<td>@if($pay->avancement_cut != 0)  {{ number_format((float)$pay->avancement_cut, 2, '.', ' ')}} @endif</td>
						
						<td><span style="opacity : 0.3;">...............</span>  استرجاع التسبيقات الجزافية   </td>
						<td style="display: none;">9</td>
					</tr>

					<tr>
						<td style="text-align: center;">@if($pay->total_cut != 0)  {{ number_format((float)$pay->total_cut, 2, '.', ' ')}} @endif</td>
						
						<td>@if($pay->assurance_cut != 0)  {{ number_format((float)$pay->assurance_cut, 2, '.', ' ')}} @endif</td>
						
						<td><span style="opacity : 0.3;">..................................</span>  استقطاع الضمان    </td>
						<td style="display: none;">11</td>
					</tr>

					<tr>
						<td style="border-bottom: 1px solid;"></td>
						<td>@if($pay->sanction_cut != 0)  {{ number_format((float)$pay->sanction_cut, 2, '.', ' ')}} @endif</td>
						
						<td><span style="opacity : 0.3;">.................................</span>  العقوبات    </td>
						<td style="display: none;">12</td>
					</tr>

					<tr>
						<td style="text-align: center;">{{ number_format((float)$total, 2, '.', ' ')}}</td>
						<td><span style="opacity : 0.3;">........................</span></td>
						<td><span style="opacity : 0.3;">.....................................</span>      الباقي      </td>
						<td style="display: none;">13</td>
					</tr>

					<tr>
						<td style="text-align: center;">@if($pay->old_payments != 0)  {{ number_format((float)$pay->old_payments, 2, '.', ' ')}} @endif</td>
						<td><span style="opacity : 0.3;">...................</span></td>
						<td> على إثره قد تم تسديد  المبالغ السابقة  من قبل   </td>
						<td style="display: none;">14</td>
					</tr>

					<tr>
						<td style="border-bottom : 1px solid; border-top : 1px solid; text-align: center;">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
						<td><span style="opacity : 0.3;">......................</span></td>
						<td> <span style="opacity : 0.3;">...........................</span>  ما تبق   للتسديد و الدفع </td>
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

					<p>يشهد  أنه   يمكن الدفع الى السيد  <span> {{ $e->name }} </span> من   ميزانية التجهيز  لسنة  <span>{{ $pay->year }}</span> المبلغ :  
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
					<div dir="ltr" style='text-align : right'>
					<span> ................. {{$ville}} في </span><br>
					</div>
				</div>

			</div>
		</div>
		<div style="width: 44%; display: inline-block; margin-right: 1%; font-size : 12px; float : left;">
			<div style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
				<b>  CERTIFICATS DELIVRES</b>
				<br>
			    <b> sur les fonds de toutes nature des </b>
			</div>
			<table id="summary">
				<tr>
					<th rowspan="2" style="width : 20%">Exercice   </th>
					<th rowspan="2" style="width : 20%">Nature des fonds  </th>
					<th rowspan="2" style="width : 40%">Montant des certificats    </th>
                    <th colspan ="2" style="width : 20%">Montant</th>

				</tr>
                <tr>
					<td>N°</td>
					<td>DU</td>
				</tr>
				<tr>
                    <td>{{$pay->year}}</td>
                    <td></td>
					<td><span>@if($pay->to_pay != 0)  {{ number_format((float)$pay->to_pay, 2, '.', ' ')}} @endif</span></td>
					<td></td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr><tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr><tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr><tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr><tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
				
                <tr>
                    <td colspan="2">Total</td>
					<td colspan="3">@if($pay->to_pay != 0)  {{ number_format((float)$pay->to_pay, 2, '.', ' ')}} @endif</td>
				</tr>
                <tr>
                    <td colspan="2">Montant du present</td>
					<td colspan="3">@if($pay->old_payments != 0)  {{ number_format((float)$pay->old_payments, 2, '.', ' ')}} @endif</td>
				</tr>
                <tr>
                    <td colspan="2"></td>
					<td colspan="3">@if($pay->to_pay != 0)  {{ number_format((float)$pay->to_pay, 2, '.', ' ')}} @endif</td>
				</tr>
                <tr>
                    <td colspan="2"></td>
					<td colspan="3">@if($pay->old_payments != 0)  {{ number_format((float)$pay->old_payments, 2, '.', ' ')}} @endif</td>
				</tr>
                <tr>
                    <td colspan="2">Retenues de garantie</td>
					<td colspan="3">@if($pay->assurance_cut != 0)  {{ number_format((float)$pay->assurance_cut, 2, '.', ' ')}} @endif</td>
				</tr>
			</table>
			<table id="summary-bottom">

				

				
			</table>

			<div style="float: left; text-align: left; margin-top: 30px; font-weight : bold;     line-height: 2;  ">
				les pieces du marché pnt été joint au mandat<br>
                N° {{$pay->num_mondat}}&emsp;&emsp;&emsp;&emsp; DU {{$pay->date_mondat}}<br>
                de {{ number_format((float)$pay->to_pay, 2, '.', ' ')}} <br>
                EX {{$pay->year}}

			</div>
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
hide_stamp();
function hide_stamp(){
	document.getElementById('stamp').style.visibility ="hidden";
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


