<?php $brut = (float)$pay->to_pay + (float)$pay->total_cut ?>
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
				zoom : 110%;
			}
			
		}
		html body {
			width: 420mm;
			height: 280mm;
			margin: auto;
			margin-top: 5%;
			font-size: 13px;
			line-height: 1.5em;
			-webkit-print-color-adjust: exact !important;
		}
		#fiche {
			padding-top: 5px;
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
    <h3 align="center">
        الجمهورية الجزائرية الديمقراطية الشعبية<br>
        République Algerienne Democratique et Populaire
    </h3>
	<div style="float: right; width: 100%;" id="top-right">
		<div style="width: 20%; display: inline-block; text-align: center; float: right; margin-right: 10%;">

			<br><br>
			<table id="sarf">
				<tr>
					<th> 
                        @if($pay->type =="FSDRS")
                        {{$ordre}}
                        @elseif($op->source=="PSC")
                        {{$ordre}}
                        @else
                        {{$ordre}}
                        @endif 
                    </th>
                    <th style="background-color : lightgray">الأمر بالصرف </th>
				</tr>
				
			</table>
		</div>

	</div>

    <div style="width: 30%; margin-right: 5%; float: right;">
        <br><br>
        <table id="things" dir="rtl">
            <tr>
                <td colspan="2" style="background-color : lightgray;
                    text-align : center">
                أعباء مقيدة في ميزانية الدولة
                </td>
            </tr>
            <tr>
                <td style="width: 30%;">المحاسب المختص</td>
                <td style="width: 70%;">
					<span>  السيد أمين الخزينة لولاية {{$ville}} 
						<br>  ح ج ب رقم {{$compte_tresor}} الجزائر   
					</span>
				</td>
            </tr>
            <tr>
                <td style="width: 30%;">تاريخ الإصدار</td>
                <td style="width: 70%;"></td>
            </tr>
            <tr >
                <td style="border : none;"><br></td>
                <td style="border : none;"></td>
            </tr>
            <tr>
                <td style="width: 30%;">موضوع النفقة</td>
                <td style="width: 70%;">{{$pay->travaux_type }} رقم {{ $pay->travaux_num}}  لل{{ $pay->deal_type }} رقم {{ $pay->deal_num }}  و ذلك من أجل {{ $pay->lot }}</td>
            </tr>
            <tr>
                <td style="width: 30%;">مرجع التأشيرة</td>
                <td style="width: 70%;">رقم  {{ $pay->num_visa }}  بتاريخ <b dir="ltr">{{ $pay->date_visa }}</b>  </td>
            </tr>

        </table>
        <br>
    </div>
    <div style="width: 20%;  margin-right: 5%; text-align: center; float: right;">
			<table id="things">
				<tr>
                    <td colspan="2" style="background-color : lightgray">حوالة الدفع</td>
                </tr>
                <tr>
                    <td style="width: 50%;">{{$pay->year}}</td>
                    <td style="width: 50%;">السنة المالية</td>
                </tr>
                <tr>
                    <td style="width: 50%;"></td>
                    <td style="width: 50%;">رقم</td>
                </tr>
                <tr>
                    <td style="width: 50%;"></td>
                    <td style="width: 50%;">التاريخ</td>
                </tr>
                <tr>
                    <td style="width: 50%;">حوالة</td>
                    <td style="width: 50%;">طريقة الدفع</td>
                </tr>

			</table>
		</div>
    <div style="width: 33%; margin-right: 2%; float: right;">
        <p style="text-align : center">القيد الميزانياتي و المحاسبي</p>
        <table id="things" dir="rtl">
            <tr>
                <td colspan="3" style="text-align : center">
                التصنيف حسب النشاط
                </td>
                <td colspan="3" style="text-align : center">
                التصنيف حسب العنوان
                </td>
            </tr>
            <tr>
                <td style="width : 18%">محفظة البرنامج</td>
                <td style="width : 10%">{{$op->portefeuille}}</td>
                <td style="width : 22%">{{$op->ministere}}</td>
                <td style="width : 18%">العنوان</td>
                <td style="width : 10%">03</td>
                <td style="width : 22%">نفقات الاستثمار</td>
                
            </tr>
            <tr>
                <td>البرنامج</td>
                <td>{{$prog->code}}</td>
                <td>{{$prog->designation}}</td>
                <td rowspan="2">الصنف</td>
                <td rowspan="2">{{$titre->code}}</td>
                <td rowspan="2">{{$titre->definition}}</td>
            </tr>
            <tr >
                <td>البرنامج الفرعي</td>
				
                <td style="width : 22%">{{$sous_prog->code}}</td>
                <td>{{$sous_prog->designation}}</td>
                
    
            </tr>
            <tr>
                <td> النشاط</td>
				<td>{{$op->activite}}</td>
				@if($ville_fr =="Medea")
				@if($op->source =="PSC")
				<td>  نشاط ممركز للتعمير و تهيئة العقار </td>
				@else
				<td> نشاط غير ممركز للتعمير و تهيئة العقار </td>
				@endif
				@else
				@if($op->source =="PSC")
				<td>تفويض التسيير القطاعي الممركز</td>
				@else
				<td>تفويض التسيير الغير ممركز</td>
				@endif
				@endif
				
				
                
				<td rowspan="2">الصنف الفرعي</td>
				<td rowspan="2">{{$sous_titre->code}}</td>
                <td rowspan="2">{{$sous_titre->definition}}</td>

            </tr>
            <tr>
                <td> النشاط الفرعي</td>
                <td>{{$op->sous_action}}</td>
                <td></td>
                
            </tr>

        </table>
        <br>
    </div>
    <br>
    <div style="width: 90%; margin-right: 5%; float: right;">
    <table id="things" dir="rtl" style="text-align: center">
            <tr style="height : 45px;">
                <td rowspan="2" style="text-align : center; width : 15%;">
                  الرمز الميزانياتي للنفقة
                </td>
                <td rowspan="2" style="text-align : center; width : 9%;">
                المبلغ الخام
                </td>
				<td colspan="3" style="text-align : cente; width : 15%;">
                 اقتطاعات
                </td>
				<td rowspan="2"  style="text-align : center; width : 9%;">
                 المبلغ الصافي للدفع للمستفيد
                </td>
				<td colspan="5" style="text-align : center; width : 52%;">
                 تحديد المستفيد
                </td>
            </tr>
            <tr style="height : 45px;">
                <td> التحديد</td>
                <td>الحساب الدائن</td>
                <td>المبلغ</td>
                <td style="width : 15%;">التسمية</td>
                <td style="width : 15%;">رقم حساب المستفيد</td>
                <td colspan="2" style="width : 15%">مرجع وثيقة الدفع</td>
				<td>ملاحظات</td>
            </tr>
			<tr style="height : 150px; vertical-align : top;">
			<td style="padding-top : 20px;" >{{$op->numero}}</td>
                <td style="padding-top : 20px;" dir="ltr">{{ number_format((float)$brut, 2, '.', ' ')}}</td>
                <td style="padding-top : 20px;"></td>
                <td style="padding-top : 20px;" dir="ltr">@if($pay->sanction_cut != 0) {{ number_format((float)$pay->sanction_cut, 2, '.', ' ')}} @endif</td>
                <td style="padding-top : 20px;"></td>
                <td style="padding-top : 20px;" dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
				<td style="padding-top : 20px;">{{$e->name}}</td>
                <td style="padding-top : 20px;">
					{{$bank->bank_acc}}َ<br>
					{{$bank->bank}}ََ <br>وكالة {{$bank->bank_agc}}
				</td>
                <td style="padding-top : 20px;"></td>
				<td style="padding-top : 20px;" ></td>
                <td style="padding-top : 20px;">/</td>
				
            </tr>
			<tr style="height : 35px;">
                <td>  المبلغ الإجمالي الخام</td>
                <td dir="ltr">{{ number_format((float)$brut, 2, '.', ' ')}}</td>
                <td colspan="2">المبلغ الإجمالي للإقتطاعات</td>
                <td dir="ltr">َ{{ number_format((float)$pay->total_cut, 2, '.', ' ')}}</td>
                <td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
            </tr>
        </table>
		<div align= "center">
		حــــدد المبـــلغ <br><b id="montant">   </b>
		<div>
		<br>
		
    </div>
	
	<div dir="rtl" style="width: 50%; margin-left : 10%; margin-right : 10%; display: inline-block; float: right; font-size  : 15px;">
    <br><br>
		<div style='text-align : right; width : 40%; display: inline-block;'>
            <span> الأمـــر بالصـــــــرف </span>
		</div>

		<div align="left" style=" width : 50%; display: inline-block;">
			<span>  المحاسب العمومي </span>
			<br>
		</div>

	</div>
	<div style="width: 20%; margin-left: 5%; display: inline-block; font-size : 12px;">
		<table id="bottom-left">
			<tr>
				<td dir="ltr">.....................................</td>
				<td>المبلغ الخام</td>
			</tr>
			<tr>
                <td dir="ltr">.....................................</td>
				<td>المبلغ المرفوض من طرف المحاسب</td>
			</tr>
			<tr>
                <td dir="ltr">.....................................</td>
				<td> المبلغ المقبول للدفع</td>
			</tr>
			<tr>
                <td dir="ltr">.....................................</td>
				<td> إقتطاعات</td>
			</tr>
			<tr>
                <td dir="ltr">.....................................</td>
				<td>المبلغ الخام</td>
			</tr>
		</table>
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
<script src="{{ url('js/tagfeet.js') }}" ></script>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
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
	//document.getElementsByTagName('body')[0].style.marginLeft = "25%";
   /* var footstr = "</body>";
    var newstr = document.getElementById(printdivname).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = ""+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;*/
    print();
    document.getElementById('bouton').style.display = "block";
	//document.getElementsByTagName('body')[0].style.marginLeft = "auto";
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