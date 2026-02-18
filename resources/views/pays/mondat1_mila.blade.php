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
				overflow-x : hidden !important;
				zoom : 110%;
			}
			
		}
		html body {
			width: 420mm;
			height: 280mm;
			margin: auto;
			margin-top: 2%;
			font-size: 13px;
			line-height: 1.4em;
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
			display : none;
		}
	</style>
</head>
<body contenteditable ="true">
<?php if(isset($op->order_ville) && $op->order_ville !="" && $op->order_ville !=NULL){
$ordre = $op->order_ville;
} ?>
<section  style="background-color: white; text-align: center; font-size: 12.5px; margin: 20px;" id="fiche">
	<div id="fiche_top" style="margin-right : 10%; margin-left : 10%;" >
		<div style="  display: inline-block; ">
			<h3>    الجمهورية الجزائرية الديمقراطية الشعبية <br>  République Algérienne Démocratique et Populaire    </h3>
		</div>
        <div style="width : 100%; background-color : lightgray" >
            <h3>  T3  حوالة الدفع </h3>
        </div>
		<div style="width : 100%;" >
			<h4>نفقات مقيدة في الميزانية العامة للدولة</h4>
        </div>
		
		<div style=" display: inline-block; max-width : 35%; " dir="rtl">
		@if($ville_fr =="Ouargla" && $direction_fr == "Direction de l'Education Nationale")
		<div  style = " margin-bottom : 10px; margin-left : 30%; float : left; border : 3px solid black;  font-weight : bold; color : black; font-size : 6mm; padding : 2px; width : 40%;">
			@if($op->source =="PSD")	
				1812.145.020
			@else
				1812.145.010
			
			@endif
		</div>
		@endif
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
                    <td>البرنامج الفرعي </td>
                    <td>{{$sous_prog->code}}</td>
                    <td>{{$sous_prog->designation}}</td>
                </tr>
                <tr>
				<td> النشاط</td>
					<td>{{$op->activite}}</td>
					@if($op->source =="PSC")
					<td>َتفويض التسيير القطاعي الممركز</td>
					@else
					<td>َتفويض التسيير الغير ممركز لولاية {{$ville}}</td>
					@endif
					
                </tr>
				@if($op->sous_action !==NULL )
				<?php $sousy = explode(".",$op->sous_action)[0]; ?>
				@endif
                <tr>
                    <td>النشاط الفرعي </td>
					@if($op->sous_action =="")
					<td>/</td>
					<td>/</td>
					@else
					<td>{{$sousy}}</td>
					<td></td>
					@endif
					
                </tr>
				@if($ville_fr =="Ouargla" && $direction_fr == "Direction de l'Education Nationale" && $sous_titre != NULL)
					<td>الصنف الفرعي  </td>
                    <td>{{$sous_titre->code}}</td>
                    <td> {{$sous_titre->definition}}</td>
				@endif
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
		<div style="  display: inline-block; width : 35%; float: right; margin-right : 5%;">
            <h3 dir="rtl" style="text-align : right;"> رمز الأمر بالصرف : {{$ordre}}<br>
			السنة المالية : {{ $pay->year}} <br>
            رقم  الحوالة : @if(isset($pay->num_mondat)) {{$pay->num_mondat}} @endif <br>
            تاريخ  الحوالة :  @if(isset($pay->date_mondat)) {{$pay->date_mondat}} @endif <br>

			@if($ville_fr =="Ouargla" )
			 موضوع النفقة : {{$pay->lot}} <br>
			@endif
			@if($ville_fr =="Touggourt" )
				@if($direction_fr =="de l'Education")	
				موضوع النفقة : {{$txt}} <br>
				@else
				موضوع النفقة : {{$txt1}} <br>
				@endif

			@endif
			@if($ville_fr =="Djanet" )
			طريقة الدفع : حوالة  <br>
			@else
			طريقة الدفع : {{$bank->bank}} وكالة : {{$bank->bank_agc}}  <br>
			@endif
            رقم العملية : <span>{{$op->numero}}</span> <br>
            عنوان العملية : <span>{{$op->intitule_ar}}</span> <br>
			@if($ville_fr == "Mila")
            <span dir="ltr"> {{$op->intitule}}</span> 
			@endif
			</h3>
            
		</div>
		<div style="  display: inline-block; float: right; margin-top : 2%;
		width : 19%; margin-right : 2%; margin-left : 2%;">
			<table style="text-align : right">
				<tr>
					<td>المحاسب العمومي المختص : <span>  السيد أمين الخزينة لولاية {{$ville}}  
					</span>
					</td>
                </tr>
				@if($ville_fr =="Mila")
				<tr>
					<td dir="rtl"> <span dir="ltr"> {{$compte_tresor}} </span> </td>
                </tr>
				@else
				<tr>
					<td dir="rtl">  الخزينة RIP/RIB   : <span dir="rtl">{{$compte_tresor}} الجزائر </span> </td>
                </tr>
				@endif
        	</table>
            <br>
		</div>
    <br>
    <div style="width: 95%; margin-right: 5%; float: right;">
    <table id="things" dir="rtl" style="text-align: center; borde : none;">
            <tr>
                <td rowspan="2" style="text-align : center; width : 8%;">
                رقم بطاقة الإلتزام
                </td>
                <td rowspan="2" style="text-align : center; width : 8%;">
                البرنامج الفرعي
                </td>
                <td rowspan="2" style="text-align : center; width : 8%;">
                  التقييد الميزانياتي 
                </td>
                <td rowspan="2" style="text-align : center; width : 9%;">
                المبلغ الخام
                </td>
				<td colspan="2" style="text-align : cente; width : 15%;">
                 اقتطاعات
                </td>
				<td colspan="3" style="text-align : center; width : 27%;">
                 تحديد المستفيد
                </td>
                <td rowspan="2" style="text-align : center; width : 10%;">المبلغ الإجمالي للدفع</td>
                <td rowspan="2" style="text-align : center; width : 15%;">ملاحظات</td>
            </tr>
            <tr>
                <td>الحساب الدائن</td>
                <td>المبلغ</td>
                <td style="width : 9%;">المستفيد</td>
                <td style="width : 9%;">رقم حساب المستفيد</td>
                <td style="width : 9%">مرجع وثيقة الدفع</td>
				
            </tr>
			<tr>
                <td> {{$pay->numero_fiche}}</td>
                <td>{{$sous_prog->code}} {{$sous_prog->designation}}</td>
				@if($ville_fr =="Ouargla")
                <td>التأشيرة رقم {{$pay->num_visa}} بتاريخ <br>{{$pay->date_visa}} </td>
				@else
				<td>{{$titre->code}} {{$titre->definition}} <br>
                    {{$sous_titre->code}} {{$sous_titre->definition}}
                </td>
				@endif
                <td dir="ltr">{{ number_format((float)$brut, 2, '.', ' ')}}</td>
                <td></td>
                <td dir="ltr">@if($pay->total_cut != 0) {{ number_format((float)$pay->total_cut, 2, '.', ' ')}} @endif</td>
				<td>{{$bank->bank_user}}</td>
                <td>
					{{$bank->bank_acc}}َ<br>
					{{$bank->bank}}ََ <br>وكالة {{$bank->bank_agc}}
				</td>
				@if($ville_fr =="Ouargla" )
				<td>{!! nl2br($txt1) !!}</td>
				@else
                <td></td>
				@endif
                <td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
				@if($ville_fr =="Mila" || $ville_fr =="Djanet")
				<td>{!! nl2br($txt) !!}</td>
				@else
				<td>/</td>
				@endif
               
				
            </tr>
			<tr style="border : none;">
                <td colspan="8" style="border : none;"></td>
                <td>المجموع</td>
                <td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
            </tr>
        </table>
		@if($ville_fr =="Touggourt")
		<br>
		<div align= "center">
		توقف الحوالة على المبـــلغ بالأحرف : <b id="montant" style="border : 2px solid; padding : 5px 10px 5px 10px;">   </b>
		<div>
		@else
		<div align= "center">
		توقف الحوالة على المبـــلغ : <b id="montant">   </b>
		<div>
		@endif
		
    </div>
	
	<div style="width: 30%; margin-right: 35%; display: inline-block; float: right; visibility : hidden;">
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
			<span> ................. قابل للتسديد </span><br>
		</div>
		<br><br>
		<div align="center">
			<span> الأمـــر بالصـــــــرف </span>
			<br>
		</div>

	</div>
    <br> <br>
	<div style="width: 30%; margin-left: 2%; display: inline-block; font-size : 12px;">
		<table id="bottom-left">
            <tr>
				<td colspan="2" style="background-color : lightgray;"> الإطار المخصص للمحاسب العمومي</td>
			</tr>
			<tr>
				@if($ville_fr =="Touggourt")
				<td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
				@else
				<td dir="ltr"></td>
				@endif
				<td>المبلغ الإجمالي للدفع</td>
			</tr>
			<tr>
				<td></td>
				<td> الرفض   </td>
			</tr>
			<tr>
                <td></td>
				<td>  نفقة قابلة للدفع</td>
			</tr>
			<tr>
                <td></td>
				<td>إقتطاعات المحاسب العمومي </td>
			</tr>
			<tr>
				@if($ville_fr =="Touggourt")
				<td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
				@else
				<td dir="ltr"></td>
				@endif
				<td>المبلغ الإجمالي الصافي للدفع</td>
			</tr>
		</table>
    </div>
    <div align= "right">
    <h3><b> الأمـــر بالصــرف </b>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
    &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
    <b>المحاسب العمومي المختص </b></h3>
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
<script src="{{ url('js/tagfeet.js') }}" ></script>
<script src="{{ url('js/jquery.js') }}"></script>
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
	txt = txt.replace('وألف', "و واحد ألف");
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