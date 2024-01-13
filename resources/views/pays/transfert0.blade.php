<!DOCTYPE html>
<html>
<head>
	  <!-- Bootstrap CSS -->
	  <link href="{{ url('css/bootstrap.min.css')}}" rel="stylesheet">
	  <!-- bootstrap theme -->
	<title></title>
<style type="text/css">
	@page {
		size: landscape;
	    margin: 0;  /* this affects the margin in the printer settings */
	}
	@media print {
		html, body {
			height : 90% !important;
			margin: 0 !important; 
			margin-top : 5mm !important;
			padding: 0 !important;
			transform : scale(0.95) !important;
			overflow: hidden !important;

		}
	}
	html,body{
	    height: 210mm;
	    width: 297mm;
	    margin: auto;
	   	margin-top: 20px;
	    font-size: 14px;
	    line-height: 1.5;
	    -webkit-print-color-adjust: exact !important;
	}
	.square {
		text-align: center;
		width: 47.5%; 
		height: 180mm; 
		border: 1px solid;
		display: inline-block;
		float: right;
	} 
	#right-tab {
		margin: 5%;
		border-collapse: collapse;
		table-layout: fixed;
		width: 90%;
	}
	#right-tab th {
		border : 1px solid;
		padding: 5px;
		background-color: rgb(240,240,240);

	}
	#right-tab td {
		border : 1px solid;
		padding: 5px;
		font-weight: bold;
	}
</style>

</head>
<body>
<div contenteditable="true" style="display: inline-block; width: 100%; " id="fiche">
	<div class="square" style="margin-right: 2%; margin-left: 1%;">
		<span style="font-size: 1.5em; font-weight: bold;"> إشعار بالتحويل    </span>
		<br>
		<b style="font-size: 1.2em;">   إلى الحساب البريدي المصرفي   </b>
		<br>
		@if($pay->type == "FSDRS")
		<b style="float: right; padding-right: 5%;">307-030</b>
		@elseif($op->source=="PSC") 
		<b style="float: right; padding-right: 5%;">{{$nums[0]."-".$nums[1]}}</b>
		@else
		<b style="float: right; padding-right: 5%;">262-130</b>
		@endif
		<b style="font-size: 1.2em;">   ينقل بأمر من أمين خزينة  ولاية ورقلة  ح ج ب  3000 03 39  </b>
		<div style="float: right;">
			<table id="right-tab">
				<tr>
					<th style="width: 30%;">  المبلـــــــــــــــــــغ  </th>
					
					<th style="border: none; width: 10%; background-color: transparent;">&emsp;</th>

					<th style="width: 15%;">المــــــادة</th>
					<th style="width: 20%;">البــــــــــــاب      </th>
					
					<th style="border: none; width: 10%; background-color: transparent;">&emsp;</th>
					
					<th style="width: 10%;"> رقم   </th>
					<th style="width: 10%;">   حوالة  </th>
					
				</tr>
				<tr>
					<td> {{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
					<td style="border: none;">&emsp;</td>

					<td style="width: 10%;">@if($pay->type !="FSDRS") 0{{$matiere}}  @endif</td>
					@if($op->source == "FSDRS")
					<?php $sf = substr($op->numero, 0, 2); ?>
						@if($sf == "SF")
						<td style="width: 20%;"> 302.145.012</td>
						@else
						<td style="width: 20%;"> 302.145.010</td>
						@endif
					@else 
						<td style="width: 20%;"> {{$op->chapitre}} </td>
					@endif
					
					
					<td style="border: none;">&emsp;</td>
					
					<td style="width: 10%;"> &emsp;   </td>
					<td style="width: 10%;">   &emsp;  </td>
				</tr>
			</table>

			<div style="text-align: right; padding: 10px; padding-bottom: 2px;">
				<b>  يصرف   إللى  السيد  : <span>  {{$bank->bank}} </span> &emsp; <span>	وكالة ورقلة  </span>    </b>
				<br>
				<b>    رقم الحســـاب   : <span>{{ $bank->num }}</span>   </b>
			</div>

			<h3 style="border: 1px solid; border-left: none; border-right: none; padding: 0; background-color: rgb(240,240,240);">  تعييــــن الوثائق  </h3>
			<div dir="rtl">
				<span> حساب  الدائن رقم  : <b> {{$bank->bank_acc}} </b> </span>
				<span>    وكالة {{$bank->bank_agc}}   </span>
				<br>
				<span>  المفتوح بإسم   :  </span>  <b dir="rtl">    {{$bank->bank_user}}  </b>  
				<br>
				@if($pay->deal_date != null)
					@if($pay->travaux_num !=NULL)
					<span>  لتسوية {{ $pay->travaux_type }}  رقم  <b>{{ $pay->travaux_num }}</b>   </span>
					بتاريخ  :   <span> {{ $pay->date_pay }} </span>
					<span>  في إطار  {{ $pay->deal_type }}  رقم  <b>{{ $pay->deal_num }}/{{ date('Y', strtotime($pay->deal_date)) }}</b>   </span>
					
					
					@else
					<span>   لتسوية   {{ $pay->deal_type }}  رقم  <b>{{ $pay->deal_num }}/{{ date('Y', strtotime($pay->deal_date)) }}</b>   </span>
					@endif
					بتاريخ  :   <span> {{ $pay->deal_date }} </span>
					<br>
					<p style="padding : 5px;" dir="rtl"> من أجل {{ $pay->sujet}}  </p>
				@else
					@if($pay->travaux_num !=NULL)
					<span>  لتسوية {{ $pay->travaux_type }}  رقم  <b>{{ $pay->travaux_num }}</b>   </span>
					بتاريخ  :   <span> {{ $pay->date_pay }} </span>
					<span>  في إطار  {{ $pay->deal_type }}  رقم  <b>{{ $pay->deal_num }}</b>   </span>
					
					
					@else
					<span>   لتسوية   {{ $pay->deal_type }}  رقم  <b>{{ $pay->deal_num }}</b>   </span>
					@endif
		
					<br>
					<p style="padding : 5px;" dir="rtl"> من أجل {{ $pay->sujet}}  </p>
				@endif
			</div>
			<hr style="color: black;">
			<div style=" text-align: right; padding: 10px;"   >
				<b>  :قبل    </b>
			</div>
			<div>
				@if($op->source == "PSC") 
				<div id="stamp1"  style = "border : 5px solid red; margin-left : 10mm; width : 30%; font-weight : bold; color : red; font-size : 7mm;">
				302.145.001
				</div>
				@elseif($op->source == "PSD")
				<div id="stamp1"  style = "border : 5px solid red; margin-left : 10mm; width : 30%; font-weight : bold; color : red; font-size : 7mm;">
				302.145.002
				</div>
				@elseif($op->source == "FSDRS")
				<?php $sf = substr($op->numero, 0, 2); ?>
					@if($sf == "SF")
					<div id="stamp1"  style = "border : 5px solid red; margin-left : 10mm; width : 30%; font-weight : bold; color : red; font-size : 5mm;">

					302.145.012
					</div>
					@else
					<div id="stamp1"  style = "border : 5px solid red; margin-left : 10mm; width : 30%; font-weight : bold; color : red; font-size : 5mm;">
					302.145.010
					</div>
					@endif
				@endif
				
				
				<br><br><br>
				<b>  تاريخ التقييد على الحساب    </b>
			</div>
			
		</div>
	</div>
	<div class="square">
		<span style="font-size: 1.5em; font-weight: bold;">   أمر    بالتحويل   </span>
		<br>
		<b style="font-size: 1.2em;">   إلى الحساب البريدي المصرفي   رقم  3000 03 39 ورقلة    </b>
		<br>
		@if($pay->type == "FSDRS")
		<b style="float: right; padding-right: 5%;">307-030</b>
		@elseif($op->source=="PSC") 
		<b style="float: right; padding-right: 5%;">{{$nums[0]."-".$nums[1]}}</b>
		@else
		<b style="float: right; padding-right: 5%;">262-130</b>
		@endif
		<b style="font-size: 1.2em;">  خزينة ولاية ورقلة      </b>
		<div style="float: right;">
			<table id="right-tab" style="width: 30%;">
				<tr>
					<th style="width: 100%;">  المبلـــــــــــــــــــغ  </th>
				</tr>
				<tr>
				<td> {{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
				</tr>
			</table>

			<div style="text-align: right; padding: 10px; padding-bottom: 2px;">
				<b>  يصرف   إللى  السيد  : <span>  {{$bank->bank}} </span> &emsp; <span>	وكالة ورقلة  </span>    </b>
				<br>
				<b>    رقم الحســـاب   : <span>{{ $bank->num }}</span>   </b>
			</div>

			<br>
			<hr>
			<br>
			
			<div dir="rtl">
				<span> حساب  الدائن رقم  : <b> {{$bank->bank_acc}} </b> </span>
				<span>    وكالة {{$bank->bank_agc}}   </span>
				<br>
				<span>  المفتوح بإسم   :  </span>  <b dir="rtl">    {{$bank->bank_user}}  </b>  
				<br>
				@if($pay->deal_date != null)
					@if($pay->travaux_num !=NULL)
					<span>  لتسوية {{ $pay->travaux_type }}  رقم  <b>{{ $pay->travaux_num }}</b>   </span>
					بتاريخ  :   <span> {{ $pay->date_pay }} </span>
					<span>  في إطار  {{ $pay->deal_type }}  رقم  <b>{{ $pay->deal_num }}/{{ date('Y', strtotime($pay->deal_date)) }}</b>   </span>
					
					
					@else
					<span>   لتسوية   {{ $pay->deal_type }}  رقم  <b>{{ $pay->deal_num }}/{{ date('Y', strtotime($pay->deal_date)) }}</b>   </span>
					@endif
					بتاريخ  :   <span> {{ $pay->deal_date }} </span>
					<br>
					<p style="padding : 5px;" dir="rtl"> من أجل {{ $pay->sujet}}  </p>
				@else
					@if($pay->travaux_num !=NULL)
					<span>  لتسوية {{ $pay->travaux_type }}  رقم  <b>{{ $pay->travaux_num }}</b>   </span>
					بتاريخ  :   <span> {{ $pay->date_pay }} </span>
					<span>  في إطار  {{ $pay->deal_type }}  رقم  <b>{{ $pay->deal_num }}</b>   </span>
					
					
					@else
					<span>   لتسوية   {{ $pay->deal_type }}  رقم  <b>{{ $pay->deal_num }}</b>   </span>
					@endif
		
					<br>
					<p style="padding : 5px;" dir="rtl"> من أجل {{ $pay->sujet}}  </p>
				@endif
				
			</div>
			<hr>
			<div style="width: 100%; display: inline-block;"   >
				<div style="width: 40%; height : 50mm; border-right: 1px solid; display : inline-block;">
					<br>
					<span style="float: right; padding-right: 10px;">   : خاتم التريخ      </span>
					<br><br><br>
					<span>   حوالة رقم     </span>
					<br><br><br>
				</div>
				<div style=" display : inline-block; width : 50%;  ">
				@if($op->source == "PSC") 
				<div id="stamp2"  style = "border : 5px solid red; margin-left : 10mm; width : 60%; font-weight : bold; color : red; font-size : 7mm;">
				302.145.001
				</div>
				@elseif($op->source == "PSD")
				<div id="stamp2"  style = "border : 5px solid red; margin-left : 10mm; width : 60%; font-weight : bold; color : red; font-size : 7mm;">
				302.145.002
				</div>
				@elseif($op->source == "FSDRS")
				<?php $sf = substr($op->numero, 0, 2); ?>
					@if($sf == "SF")
					<div id="stamp2"  style = "border : 5px solid red; margin-left : 10mm; width : 60%; font-weight : bold; color : red; font-size : 5mm;">

					302.145.012
					</div>
					@else
					<div id="stamp2"  style = "border : 5px solid red; margin-left : 10mm; width : 60%; font-weight : bold; color : red; font-size : 5mm;">
					302.145.010
					</div>
					@endif
				@endif
				</div>

			</div>
			
			
		</div>
	</div>

	
</div>
<br><br>
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
 <br><br>
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


