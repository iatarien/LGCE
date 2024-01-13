<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		@page {
			size: auto;   /* auto is the initial value */
			size: landscape;
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
			border: 1px solid;
			border-bottom : none;
			margin-top: 5%;
			font-size: 15px;
			line-height: 1.5em;
			-webkit-print-color-adjust: exact !important;
		}
		#fiche {
			padding-top: 10px;
			font-weight: bold; 
			display: inline-block; 
			padding : 0 5% 0 5%;
			max-height: 100%;
			overflow: hidden;
		}
		.half {
			float: right; 
			width: 49%; 
			display: inline-block;
		}
		#top-tab {
			border : 1px solid;
			border-collapse : collapse;
			width : 100%;
			text-align: center;
		}
		#top-tab td{
			border-right : 1px solid;
			padding: 1%;
			width: 24%;
		}
		#top-tab th{
			border : 1px solid;
			padding: 1%;
			width: 49%;
		}
		#releve {
			border : 1px solid;
			border-collapse : collapse;
			width : 95%;
			margin-right: 5%;
		}
		#releve td {
			border : 1px solid;
			padding: 3px;
		}
		#releve th {
			border : 1px solid;
			padding: 3px;
		}
		#tab-bottom {
			border : 1px solid;
			border-collapse : collapse;
			width : 100%;
		}
		#tab-bottom th {
			border : 1px solid;
			padding: 5px;
		}
		#tab-bottom td {
			border : 1px solid;
			padding: 3px;
			font-weight : bold;
		}
		#tab-bottom td:last-child {
			text-align: right;
		}
	</style>
</head>
<body contenteditable ="true">
<section id="fiche">
	<div class="half" id="tables" style="text-align: center;">
		<br><br>
		<div style="width: 100%; text-align: center;" >
			<div style="text-align: right;"><span style="text-decoration: underline;">   تسبيـــقات على العتـــاد </span></div>
			
			<br>
			<table id="top-tab">
				<tr>
					<th colspan="2"> كشف حسب لاسترداد التسبيقات </th>
					<th colspan="2"> مبلغ التسبيقات </th>
				</tr>
				<tr>
					<td></td>
					<td>الاشغال المتمة</td>
					<td></td>
					<td lang="ar" dir="rtl">التسبيقة الأولى من ../../.. </td>
				</tr>
				<tr>
					<td></td>
					<td>الاشغال غير المتمة</td>
					<td></td>
					<td lang="ar" dir="rtl">التسبيقة الثانية من ../../.. </td>
				</tr>
				<tr>
					<td></td>
					<td>المجموع</td>
					<td></td>
					<td lang="ar" dir="rtl">التسبيقة الثالثة من ../../.. </td>
				</tr>
				<tr>
					<td></td>
					<td>اقتطاع العناية</td>
					<td></td>
					<td lang="ar" dir="rtl">التسبيقة الرابعة من ../../.. </td>
				</tr>
				<tr>
					<td></td>
					<td>الباقي أخذه بالاعتبار</td>
					<td></td>
					<td lang="ar" dir="rtl">التسبيقة الخامسة من ../../.. </td>
				</tr>
				<tr>
					<td></td>
					<td> الاقتطاع العام يحسب نسبة لاسترجاع ..% من المبلغ المحدد أعلاه استرجاع التسبيقات لمادة من الصفقة </td>
					<td></td>
					<td>المبلغ الاجمالي للتسبيقات : م للانقطاع : جميع الانقطاعات</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>الباقي للتعويض</td>
				</tr>
			</table>
		</div>
		<br>
		<div style="width: 100%;">
			<span> الملخــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــــص </span>
			<br>
			<table id="tab-bottom" style="text-align: center;">
				<tr>
					<th>البــــــاقي</th>
					<th>الاستقطاعات</th>
					<th>نفقات تمت</th>
					<th>طبيعة النفقات</th>
				</tr>
				<tr>
					<td>@if($pay->etude_done != 0 or $pay->etude_cut != 0) {{ number_format((float)$pay2->etude, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->etude_cut != 0) {{ number_format((float)$pay->etude_cut, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->etude_done != 0) {{ number_format((float)$pay->etude_done, 2, '.', ' ')}} @endif</td>
					<td>أشغال تامة</td>
				</tr><tr>
					<td>@if($pay->non_termine_done != 0 or $pay->non_termine_cut != 0) {{ number_format((float)$pay2->non_termine, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->non_termine_cut != 0) {{ number_format((float)$pay->non_termine_cut, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->non_termine_done != 0) {{ number_format((float)$pay->non_termine_done, 2, '.', ' ')}} @endif</td>
					<td>أشغال غير تامة</td>
				</tr><tr>
					<td>@if($pay->extra_done != 0 or $pay->extra_cut != 0) {{ number_format((float)$pay2->extra, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->extra_cut != 0) {{ number_format((float)$pay->extra_cut, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->extra_done != 0) {{ number_format((float)$pay->extra_done, 2, '.', ' ')}} @endif</td>
					<td>أعمال إضافية</td>
				</tr><tr>
					<td>@if($pay->avan_done != 0 or $pay->avan_cut != 0) {{ number_format((float)$pay2->avan, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->avan_cut != 0) {{ number_format((float)$pay->avan_cut, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->avan_done != 0) {{ number_format((float)$pay->avan_done, 2, '.', ' ')}} @endif</td>
					<td> التسبيقات الجزائية</td>
				</tr><tr>
					<td>@if($pay->revision_done != 0 or $pay->revision_cut != 0) {{ number_format((float)$pay2->revision, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->revision_cut != 0) {{ number_format((float)$pay->revision_cut, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->revision_done != 0) {{ number_format((float)$pay->revision_done, 2, '.', ' ')}} @endif</td>
					<td>مراجعة الأسعار</td>
				</tr><tr>
					<td>@if($pay->assurance_done != 0 or $pay->assurance_cut != 0) {{ number_format((float)$pay2->assurance, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->assurance_cut != 0) {{ number_format((float)$pay->assurance_cut, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->assurance_done != 0) {{ number_format((float)$pay->assurance_done, 2, '.', ' ')}} @endif</td>
					<td>  5%  استقطاع الضمان  </td>
				</tr><tr>
					<td>@if($pay->avancement_done != 0 or $pay->avancement_cut != 0) {{ number_format((float)$pay2->avancement, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->avancement_cut != 0) {{ number_format((float)$pay->avancement_cut, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->avancement_done != 0) {{ number_format((float)$pay->avancement_done, 2, '.', ' ')}} @endif</td>
					<td>استرجاع التسبيقات الجزائية </td>
				</tr><tr>
					<td>@if($pay->sanction_done != 0 or $pay->sanction_cut != 0) {{ number_format((float)$pay2->sanction, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->sanction_cut != 0) {{ number_format((float)$pay->sanction_cut, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->sanction_done != 0) {{ number_format((float)$pay->sanction_done, 2, '.', ' ')}} @endif</td>
					<td>العقوبات </td>
				</tr>
				<tr>
					<td>@if($pay->total_done != 0 or $pay->total_cut != 0) {{ number_format((float)$pay2->total, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->total_cut != 0) {{ number_format((float)$pay->total_cut, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->total_done != 0) {{ number_format((float)$pay->total_done, 2, '.', ' ')}} @endif</td>
					<td>المجموع</td>
				</tr>
				<tr>
					<td>@if($pay->old_payments != 0) {{ number_format((float)$pay->old_payments, 2, '.', ' ')}} @endif</td>
					<td style="border-top : 3px; border-bottom : none; text-align: center;" colspan="3">اقتطاع الصفقات السنوية الى السنوات الماضية</td>
				</tr>
				<tr>
					<td>{{ number_format((float)$pay->new_payment, 2, '.', ' ')}}</td>
					<td style="border-top : none; border-bottom : none; text-align: center;" colspan="3">ما تبقى تسديده في السنة الحالية</td>
				</tr>
				<tr>
					<td>@if($pay->this_year_cut != 0) {{ number_format((float)$pay->this_year_cut, 2, '.', ' ')}} @endif</td>
					<td style="border-top : none; border-bottom : none; text-align: center;" colspan="3">اقتطاع مبلغ الدفعات المسلة في السنة الحالية</td>
				</tr>
				<tr>
					<td>{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
					<td style="border-top : none; border-bottom : none; text-align: center;" colspan="3"> ما تبقى للدفع </td>
				</tr>
			</table>
		</div>
		<br><br>

		<div style='text-align : right'>
		<span> ................. {{$ville}} في </span><br>
		</div>
		
		

    </div>
	<div style=" text-align: right; border-right : 1px solid; margin-right: 1%;" id="words" class="half">
		<br><br>
        <div style="display: inline-block; width: 30%; padding-right: 2%; float : right; ">
            <span>   {{$ministere}}<br> مديرية {{$direction}}  <br> لولايــــة {{$ville}}    </span>

        </div>
		<div style="display: inline-block; width: 50%; padding-right: 2%; text-align: center;  float: right;">
            <span>   مـــيــزانيـــة التجهيـــز   </span>
			<br>
			<span>	<b> {{ $op->numero }}</b>	 : عملية رقم  	</span>

        </div>
		<div style="display: inline-block; width: 18%; padding-right: 2%; text-align: center;  float: left;">
			<br><br>
            <span> ...........  : حافظة رقم     </span>
			<br>
			<span>	...........  : ارتباط رقم 	</span>

        </div>
		<br>
		<div dir="rtl" style="width: 100%; display: inline-block; text-align: center;">
			<span> {{ $op->intitule_ar }} </span>
		</div>
		<div style="display: inline-block; width: 25%; padding-right: 2%; text-align: left;  float: left;">
			<br><br>
            <span> <b>{{ $pay->year }}</b>  : السنة     </span>
			<br>

			<span> <b>{{ $op->programme }}</b>  :  البرنامج	</span>
			<br>
			@if($sous_prog->code != "")
			<span> <b>{{$sous_prog->code}}</b>  :  البرنامج الفرعي	</span>
			@endif
			<br>

			

        </div>
		
		<div dir="rtl" style="width: 100%; display: inline-block; text-align: center; font-size: 20px; line-height: 1.6em;">
			@if($pay->deal_date != null)
				<span>   {{ $pay->deal_type }} رقم  : <b>{{ $pay->deal_num }}/{{ date('Y', strtotime($pay->deal_date)) }}   </b>     </span>
				
			@else
				<span>   {{ $pay->deal_type }} رقم  : <b>{{ $pay->deal_num }}   </b>     </span>
				
			@endif
			<br>
			<span >    المبرمة مع <b> {{ $e->name }} </b>   </span>
		</div>
		<div dir="rtl" style="width: 90%; display: inline-block; text-align: center; margin-right: 5%;">
			<br><br>
			<span>  {{ $pay->lot }}  </span>
		</div>

		<div style="display: inline-block; width: 50%; padding-right: 2%; text-align: center;  float: left;">
			<br><br>
			<span> المبلغ للدفع </span>
			<br>
            <span> <b>{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</b>  ........... الصافي للدفع     </span>
			<br>
			<span> <b>{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</b>.............  المبلغ الخام 	</span>
			<br><br>
        </div>
		<div style="display: inline-block; width: 40%; padding-right: 2%; text-align: center;  float: left;">
			<br><br><br>

        </div>
		<div style="width: 100%; display: inline-block; text-align: center;">
			<br>
			<span>  كشـــف حســــــاب رقم <b>{{ $pay->num }}</b>  </span>
			<br>
			<span >  <b dir="ltr">{{ $pay->date_pay }}</b> الأشغال المنفذة و المصاريف التي أنفقت بتاريخ    </span>
			<br>
			<table id="releve">
				<tr>
					<th colspan="2" style="width: 40%;">نفقـــــــــات</th>
					<th rowspan="2" style="width: 40%;">تعيين الأشغال <br> 2</th>
					<th rowspan="2" style="width: 10%;">رقم الدفتر اليومية</th>
				</tr>
				<tr>
					<th> خام <br> 3</th>
					<th> صافي <br> 4</th>
				</tr>
				<tr>
					<td>@if($pay->etude_done != 0) {{ number_format((float)$pay->etude_done, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->etude_done != 0) {{ number_format((float)$pay->etude_done, 2, '.', ' ')}} @endif</td>
					<td>أشغال تامة</td>
					<td>I</td>
				</tr><tr>
					<td>@if($pay->non_termine_done != 0) {{ number_format((float)$pay->non_termine_done, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->non_termine_done != 0) {{ number_format((float)$pay->non_termine_done, 2, '.', ' ')}} @endif</td>
					
					<td>أشغال غير تامة
					@if($pay->travaux_type =="وضعية الأشغال" or $pay->travaux_type =="مذكرة أتعاب" )
					<br>
					{{ $pay->travaux_type }} {{ $pay->travaux_num }}
					@endif
					</td>
					<td>II</td>
				</tr><tr>
					<td>@if($pay->extra_done != 0) {{ number_format((float)$pay->extra_done, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->extra_done != 0) {{ number_format((float)$pay->extra_done, 2, '.', ' ')}} @endif</td>
					<td>أعمال إضافية</td>
					<td>III</td>
				</tr>
					<td>@if($pay->avan_done != 0) {{ number_format((float)$pay->avan_done, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->avan_done != 0) {{ number_format((float)$pay->avan_done, 2, '.', ' ')}} @endif</td>
					<td> التسبيقات الجزائية </td>
					<td>VI</td>
				</tr>
				<tr>
					<td>@if($pay->revision_done != 0) {{ number_format((float)$pay->revision_done, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->revision_done != 0) {{ number_format((float)$pay->revision_done, 2, '.', ' ')}} @endif</td>
					<td>مراجعة الأسعار</td>
					<td>V</td>
				</tr><tr>
					<td>@if($pay->assurance_cut != 0) {{ number_format((float)$pay->assurance_cut, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->assurance_cut != 0) {{ number_format((float)$pay->assurance_cut, 2, '.', ' ')}} @endif</td>
					<td>  5%  استقطاع الضمان  </td>
					<td>VI</td>
				</tr><tr>
					<td>@if($pay->avancement_cut != 0) {{ number_format((float)$pay->avancement_cut, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->avancement_cut != 0) {{ number_format((float)$pay->avancement_cut, 2, '.', ' ')}} @endif</td>
					<td>استرجاع التسبيقات الجزائية </td>
					<td>VII</td>
				</tr><tr>
					<td>@if($pay->sanction_cut != 0) {{ number_format((float)$pay->sanction_cut, 2, '.', ' ')}} @endif</td>
					<td>@if($pay->sanction_cut != 0) {{ number_format((float)$pay->sanction_cut, 2, '.', ' ')}} @endif</td>
					<td>العقوبات </td>
					<td>VIII</td>
				</tr>
			</table>
			<br><br>
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
}
function printdiv(printdivname) {
	document.getElementById('bouton').style.display = "none";
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
jQuery(document).bind(" keydown", function(e){
    if(e.ctrlKey && e.keyCode == 80){
		printdiv('fiche');
		return false;
    }
	
});
</script>

</body>
</html>