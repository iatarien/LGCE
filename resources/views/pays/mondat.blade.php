<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		@page {
			size: auto;   /* auto is the initial value */
			size: A3 landscape;
			margin: 0;  /* this affects the margin in the printer settings */
		}
		@media print {
			html,body{
				height:280mm;
				width:420mm;
				overflow-y : hidden !important;
			}
			
		}
		html body {
			width: 420mm;
			height: 280mm;
			margin: auto;
			margin-top: 5%;
			font-size: 16px;
			line-height: 1.5em;
			-webkit-print-color-adjust: exact !important;
		}
		#fiche {
			padding-top: 30px;
			font-weight: bold; 
			display: inline-block; 
			width: 100%;
			max-height: 100%;
			overflow: hidden;
		}
		#sarf {
			border : 1px solid;
			border-collapse : collapse;
			width : 100%;
		}
		#sarf td {
			border : 1px solid;
			padding: 3px;
		}
		#sarf th {
			border : 1px solid;
			padding: 3px;
		}
		#things {
			border-collapse : collapse;
			width : 100%;
			
		}
		#things td {
			border : 1px solid;
			padding: 5px;
		}
		#big-tab {
			border-collapse : collapse;
			width : 100%;
			text-align: center;
			
		}
		#big-tab td {
			border : 1px solid;
			padding: 5px;
			vertical-align: top;
		}
		#bottom-left {
			border-collapse : collapse;
			width : 100%;
			text-align: center;
			margin-top : -10%;
			
		}
		#bottom-left td {
			border : 1px solid;
			padding: 5px;
			width: 50%;
		}
	</style>
</head>
<body contenteditable ="true">
<section id="fiche">
	<div style="float: right; width: 50%;" id="top-right">
		<div style="width: 25%; display: inline-block; float: right; ">
			<br>
			<span>
				الجمهـــورية الجــــزائــــرية   <br>  الديمــقــــــراطية الشــــعبية
			</span>
			<br><br>
			<span>
				مديـــــرية التجهـــــــيزات   <br> العمـــومية لولاية ورقــــلة
			</span>
		</div>
		<div style="width: 60%; display: inline-block; text-align: center; float: right; margin-right: 10%;">
			<div style="border: 1px solid; border-bottom: none; padding: 3px;" >
				<span >  المحاسب المختص     </span>
			</div>
			<div style="border: 1px solid; padding: 3px;" >
				<span>  السيد أمين الخزينة لولاية ورقلة <br>  ح ج ب رقم 3000 03 الجزائر   </span>
			</div>
			<br><br>
			<table id="sarf">
				<tr>
					<th>  البـــــاب  </th>
					<th>تسييــر</th>
					<th colspan="2"> الأمر بالصرف  </th>
				</tr>
				<tr>
					@if($op->source == "FSDRS")
					<?php $sf = substr($op->numero, 0, 2); ?>
						@if($sf == "SF")
						<td> 302.145.012</td>
						@else
						<td> 302.145.010</td>
						@endif
					@else 
						<td> {{$op->chapitre}} </td>
					@endif
					<td>{{ $pay->year }}</td>
					@if($pay->type =="FSDRS")
					<td>307</td>
					<td>030</td>
					@elseif($op->source=="PSC")
					<td>{{$nums[0]}}</td>
					<td>{{$nums[1]}}</td>
					
					@else
					<td>262</td>
					<td>130</td>
					@endif
				</tr>
			</table>
		</div>
		<div style="width: 85%; margin-top: 5%; margin-right: 10%; text-align: center; float: right;">
			<table id="things">
				<tr>
					<td style="width: 25%;"></td>
					<td style="width: 15%;"> طريقة الدفع </td>
					<td style="width: 5%; border : none;"></td>
					<td style="width: 20%;"></td>
					<td style="width: 10%;">التاريخ</td>
					<td style="width: 5%; border : none;"></td>
					<td style="width: 15%;"></td>
					<td style="width: 10%;">الرقم</td>
				</tr>
			</table>
		</div>
	</div>
	<div style="width: 50%; float: right; text-align: center;" id="top-left">
		<br>
		<h1 style="font-size: 1.8em;">   حـــوالــــة دفــــــع   </h1>
		@if($pay->type =="FSDRS")
		<h1 style="font-size: 1.8em;">   لنــفـقـة مقيــــدة في الصـــندوق الـــخـــاص   </h1>
		<h1 style="font-size: 1.8em;">   لتـــنمــية منـــاطـق الجــنــوب </h1>
		<?php $sf = substr($op->numero, 0, 2); ?>
			@if($sf == "SF")
			<h1 style="font-size: 1.8em;">   302-145-012 </h1>
			@else
			<h1 style="font-size: 1.8em;">   302-145-010  </h1>
			@endif
		@elseif($op->source =="PSC")
		<h1 style="font-size: 1.8em;">   لنــفـقـة مقيــــدة في  ميزانية الدولة   </h1>
		<h1><br></h1>
		<h1 style="font-size: 1.8em;">   {{$nums[0]." - ".$nums[1]}} </h1>
		@else
		<h1 style="font-size: 1.8em;">   لنــفـقـة مقيــــدة في  ميزانية الدولة   </h1>
		<h1><br></h1>
		<h1 style="font-size: 1.8em;">   2 6 2 - 1 3 0  </h1>
		@endif
		<br>
				@if($op->source == "PSC") 
				<div id="stamp"  style = "border : 5px solid red; margin-left : 20mm; width : 25%; font-weight : bold; color : red; font-size : 8mm;">
				302.145.001
				</div>
				@elseif($op->source == "PSD")
				<div id="stamp"  style = "border : 5px solid red; margin-left : 20mm; width : 25%; font-weight : bold; color : red; font-size : 8mm;">
				302.145.002
				</div>
				@elseif($op->source == "FSDRS")
				<?php $sf = substr($op->numero, 0, 2); ?>
					@if($sf == "SF")
					<div id="stamp"  style = "border : 5px solid red; margin-left : 20mm; width : 25%; font-weight : bold; color : red; font-size : 6mm;">
					302.145.012
					</div>
					@else
					<div id="stamp"  style = "border : 5px solid red; margin-left : 20mm; width : 25%; font-weight : bold; color : red; font-size : 6mm;">
					302.145.010
					</div>
					@endif
				@endif
		<br>

	</div>
	<br>
	<div style="width: 90%; margin-right: 5%; float: right;">
		<table id="big-tab">
			<tr>
				<td rowspan="2" style="width: 25%;">9<br> ملاحظات و مــــراجع </td>
				<td rowspan="2" style="width: 10%;">8<br> رفم الحوالة <br> رقم السطر</td>
				<td colspan="5" style="width: 20%;">7<br> تعيــيـــــــن</td>
				<td rowspan="2" style="width: 5%;">6<br> رقم  الإرتباط</td>
				<td rowspan="2" style="width: 5%;">5<br> الصافي  للدفع</td>
				<td rowspan="2" style="width: 5%;">4<br> خصم المح  </td>
				<td rowspan="2" style="width: 12.5%;">3<br>  المبلــــغ  </td></td>
				<td rowspan="2" style="width: 5%;">2<br>  رقم الحساب الدائن </td></td>
				<td rowspan="2" style="width: 12.5%;">1<br> تعييــــن  المستفيــــد</td></td>
			</tr>
			<tr>
	
				<td colspan="2">e &emsp; d<br> أمر بصرف</td>
				<td>c<br>تسيير</td>
				<td>b<br>مادة</td>
				<td>a<br>باب</td>
			</tr>
			<tr>
			@if($pay->deal_date != Null)
				@if($pay->travaux_num == NULL)
						@if($pay->annexe == Null)
							<td rowspan="3" style="vertical-align: middle;" lang="ar" dir="rtl" >  
							حساب الدائن {{ $bank->bank }} وكالة {{ $bank->bank_agc }} رقم {{ $bank->bank_acc }} مفتوح بإسم {{ $bank->bank_user }}  لل{{ $pay->deal_type }} رقم {{ $pay->deal_num }}/{{ date('Y', strtotime($pay->deal_date)) }} المبرمة مع {{ $e->name }}  و ذلك من أجل {{ $pay->sujet }}
						@else
						<td rowspan="3" style="vertical-align: middle;" lang="ar" dir="rtl" >  
							حساب الدائن {{ $bank->bank }} وكالة {{ $bank->bank_agc }} رقم {{ $bank->bank_acc }} مفتوح بإسم {{ $bank->bank_user }}  لل{{ $pay->deal_type }} رقم {{ $pay->deal_num }}/{{ date('Y', strtotime($pay->deal_date)) }} في إطار الملحق {{explode('الذي',$pay->annexe)[0]}} المبرمة مع {{ $e->name }}  و ذلك من أجل {{ $pay->sujet }}
						@endif
					<br>
				@else
						@if($pay->annexe == Null)
							<td rowspan="3" style="vertical-align: middle;" lang="ar" dir="rtl" >  
							حساب الدائن {{ $bank->bank }} وكالة {{ $bank->bank_agc }} رقم {{ $bank->bank_acc }} مفتوح بإسم {{ $bank->bank_user }} لتسوية {{$pay->travaux_type }} رقم {{ $pay->travaux_num}}  لل{{ $pay->deal_type }} رقم {{ $pay->deal_num }}/{{ date('Y', strtotime($pay->deal_date)) }} المبرمة مع {{ $e->name }}  و ذلك من أجل {{ $pay->sujet }}
						
						@else
						<td rowspan="3" style="vertical-align: middle;" lang="ar" dir="rtl" >  
							حساب الدائن {{ $bank->bank }} وكالة {{ $bank->bank_agc }} رقم {{ $bank->bank_acc }} مفتوح بإسم {{ $bank->bank_user }} لتسوية {{$pay->travaux_type }} رقم {{ $pay->travaux_num}}  لل{{ $pay->deal_type }} رقم {{ $pay->deal_num }}/{{ date('Y', strtotime($pay->deal_date)) }} في إطار الملحق {{explode('الذي',$pay->annexe)[0]}} المبرمة مع {{ $e->name }}  و ذلك من أجل {{ $pay->sujet }}
						@endif
					
				@endif
			@else
				@if($pay->travaux_num == NULL)
						@if($pay->annexe == Null)
							<td rowspan="3" style="vertical-align: middle;" lang="ar" dir="rtl" >  
							حساب الدائن {{ $bank->bank }} وكالة {{ $bank->bank_agc }} رقم {{ $bank->bank_acc }} مفتوح بإسم {{ $bank->bank_user }}  لل{{ $pay->deal_type }} رقم {{ $pay->deal_num }} المبرمة مع {{ $e->name }}  و ذلك من أجل {{ $pay->sujet }}
						@else
						<td rowspan="3" style="vertical-align: middle;" lang="ar" dir="rtl" >  
							حساب الدائن {{ $bank->bank }} وكالة {{ $bank->bank_agc }} رقم {{ $bank->bank_acc }} مفتوح بإسم {{ $bank->bank_user }}  لل{{ $pay->deal_type }} رقم {{ $pay->deal_num }} في إطار الملحق {{explode('الذي',$pay->annexe)[0]}} المبرمة مع {{ $e->name }}  و ذلك من أجل {{ $pay->sujet }}
						@endif
					<br>
				@else
						@if($pay->annexe == Null)
							<td rowspan="3" style="vertical-align: middle;" lang="ar" dir="rtl" >  
							حساب الدائن {{ $bank->bank }} وكالة {{ $bank->bank_agc }} رقم {{ $bank->bank_acc }} مفتوح بإسم {{ $bank->bank_user }} لتسوية {{$pay->travaux_type }} رقم {{ $pay->travaux_num}}  لل{{ $pay->deal_type }} رقم {{ $pay->deal_num }} المبرمة مع {{ $e->name }}  و ذلك من أجل {{ $pay->sujet }}
						
						@else
						<td rowspan="3" style="vertical-align: middle;" lang="ar" dir="rtl" >  
							حساب الدائن {{ $bank->bank }} وكالة {{ $bank->bank_agc }} رقم {{ $bank->bank_acc }} مفتوح بإسم {{ $bank->bank_user }} لتسوية {{$pay->travaux_type }} رقم {{ $pay->travaux_num}}  لل{{ $pay->deal_type }} رقم {{ $pay->deal_num }} في إطار الملحق {{explode('الذي',$pay->annexe)[0]}} المبرمة مع {{ $e->name }}  و ذلك من أجل {{ $pay->sujet }}
						@endif
					
				@endif
			@endif
				
				<br>
				تأشيرة المراقب المالي 
				<br><br>
				<span>   رقم  {{ $pay->num_visa }}  بتاريخ <b dir="ltr">{{ $pay->date_visa }}</b>  </span>
				</td>
				<td rowspan="3"></td>
				<!---   ***** !-->
				<td style="border-bottom : none;" ></td>
				<td style="border-bottom : none;" ></td>
				<td style="border-bottom : none;" ></td>
				<td style="border-bottom : none;" ></td>
				<td style="border-bottom : none;" ></td>
				<!---   ***** !-->
				<td rowspan="3"></td>
				<td rowspan="3"></td>
				<td rowspan="3"></td>
				<td rowspan="3" style="vertical-align: middle; font-size : 20px;"> {{ number_format((float)$pay->to_pay, 2, '.', ' ')}} </td>
				<td rowspan="3" style="vertical-align: middle;"> {{$bank->num}} </td>
				<td rowspan="3" style="vertical-align: middle;"> {{$bank->bank}}<br>وكالة<br>*ورقلة* </td>
			</tr>
			<tr>
				<td colspan="5" style="vertical-align: middle; height: 10%; border-top: none; border-bottom: none; font-size: 18px;" > {{ $op->numero }} </td>
			</tr>
			<tr>
				<!---   ***** !-->
				<td style="border-top : none;" ></td>
				<td style="border-top : none;" ></td>
				<td style="border-top : none;" ></td>
				<td style="border-top : none;" ></td>
				<td style="border-top : none;" ></td>
				<!---   ***** !-->
			</tr>
			<tr>
				<td rowspan="3" colspan="2" style="border: none;"></td>
				<td rowspan="3" colspan="8" style="border: none;">    حــــدد المبـــلغ <br><b id="montant">   </b>  </td>
				<td style="font-size : 20px;">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
				<td colspan="2" style="border: none;"> مجموع الحوالة </td>
			</tr>
			<tr>
				@if($op->source == "FSDRS")
				<?php $sf = substr($op->numero, 0, 2); ?>
					@if($sf == "SF")
					<td> 302.145.012</td>
					@else
					<td> 302.145.010</td>
					@endif
				@else 
					<td> {{$op->chapitre}} </td>
				@endif
				<td colspan="2" style="border: none;" >البــــــاب</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2" style="border: none;" >اليوم</td>
			</tr>

		</table>
	</div>
	<div style="width: 20%; margin-left: 5%; display: inline-block;">
		<table id="bottom-left">
			<tr>
				<td></td>
				<td>المبلغ الخام</td>
			</tr>
			<tr>
				<td></td>
				<td>المرفوضــــات</td>
			</tr>
			<tr>
				<td></td>
				<td>نقطة مقبولة</td>
			</tr>
			<tr>
				<td></td>
				<td>خصم المحاسب</td>
			</tr>
			<tr>
				<td></td>
				<td>المبلغ الخام</td>
			</tr>
		</table>

	</div>
	<div style="width: 30%; margin-right: 35%; display: inline-block; float: right;">
		@if($op->source == "PSC") 
		<div id="stamp1"  style = "text-align : center; padding : 5px; margin-right : 20%; float : right; border : 5px solid red; margin-left : 10mm; width : 150px; font-weight : bold; color : red; font-size : 7mm;">
		عــن الــوزير
		</div>
		@else
		<div id="stamp1"  style = "text-align : center; padding : 5px; margin-right : 20%; float : right; border : 5px solid red; margin-left : 10mm; width : 150px; font-weight : bold; color : red; font-size : 7mm;">
		عــن الــــوالي
		</div>
		@endif
		<div style='text-align : right'>
			<span> ................. ورقلة في </span><br>
		</div>
		<br><br>
		<div align="center">
			<span> الأمـــر بالصـــــــرف </span>
			<br>
			<img id="stamp2" src="/img/cachet.jpeg" style="width : 130px; display : none;">
		</div>

	</div>
</section>

<div align="center" id="bouton" >
<br><br><br><br>
	<button style="
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
  <button style="
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
function hide_stamp(){
	document.getElementById('stamp').style.visibility ="hidden";
	document.getElementById('stamp1').style.visibility ="hidden";
	document.getElementById('stamp2').style.visibility ="hidden";
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
function printdiv(printdivname) {
	document.getElementById('bouton').style.display = "none";
	//document.getElementsByTagName('body')[0].style.marginRight = "30%";
	document.getElementsByTagName('body')[0].style.marginLeft = "25%";
   /* var footstr = "</body>";
    var newstr = document.getElementById(printdivname).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = ""+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;*/
    print();
    document.getElementById('bouton').style.display = "block";
	document.getElementsByTagName('body')[0].style.marginLeft = "auto";
    return false;
}
</script>
</body>
</html>