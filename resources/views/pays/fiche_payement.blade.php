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
		<table id="CF" style="border : none; text-align : center;">
			<tr>
				<td>  
				@if($op->source == "PSC") 
				<div id="stamp" style = "border : 5px solid red; margin-left : 10mm; width : 60%; font-weight : bold; color : red; font-size : 7mm;">
				302.145.001
				</div>
				@elseif($op->source == "PSD")
				<div id="stamp" style = "border : 5px solid red; margin-left : 10mm; width : 60%; font-weight : bold; color : red; font-size : 7mm;">
				302.145.002
				</div>
				@elseif($op->source == "FSDRS")
				<?php $sf = substr($op->numero, 0, 2); ?>
					@if($sf == "SF")
					<div id="stamp" style = "border : 5px solid red; margin-left : 10mm; width : 50%; font-weight : bold; color : red; font-size : 5mm;">
					302.145.012
					</div>
					@else
					<div id="stamp" style = "border : 5px solid red; margin-left : 10mm; width : 50%; font-weight : bold; color : red; font-size : 5mm;">
					302.145.010
					</div>
					@endif
				@endif
				</td>
			</tr>

		</table>

		<br>
		
		<table id="titles" >
			<tr id="intitule">
				<td><b>        {{ $op->intitule_ar }}   </b> </td>
				<td style="text-decoration : underline; width: 200px;">     تعييــــــــــن العمليـــــــــــــــــة : </td>
				
				
			</tr>
			<tr>
				<td><b>     {{ $sujet }}    </b></td>
				<td style=" text-decoration : underline; font-weight: bold;"> موضوع الدفـــــــــــع : </td>
				
			</tr>
		</table>
		<br>

		<div style=" border: 1px solid; display: inline-block; float: right;">
			<h3 style="padding: 0px 5px 0px 5px;">     تركيـــــــب الدفـــــــــــــع المقتــــــــــــرح  </h3>
		</div>
		<br><br><br><br><br><br><br><br><br><br><br><br>
		<table id="payement" >
			<tr>	
				<th>     الملا حظــــــــــــــــــــات    </th>
				<th>   المبــــــــــالـــــــــــغ   </th>
				<th style=" border : none; text-align: right; width : 39%;">العنــــــــــــــــــــــــــــاويــــــــــن</th>
				<th style="width: 5%; border : none;"></th>
			</tr>
			<tr>
				<td></td>	
				<td>@if($pay0->etude != 0 and $pay0->etude != NULL) {{ number_format((float)$pay0->etude, 2, '.', ' ')}} @endif</td>
				<td>   الدراســــــات و/أو الهندســــــة  </td>
				<td>01</td>
			</tr>
			<tr>
				<td></td>	
				<td>@if($pay0->genie_civil != 0 and $pay0->genie_civil != NULL) {{ number_format((float)$pay0->genie_civil, 2, '.', ' ')}} @endif</td>
				<td>    البناء و ما يربط به  هندسة مدنية    </td>
				<td>02</td>
			</tr>
			<tr>	
				<td></td>
				<td>@if($pay0->travaux_publics != 0 and $pay0->travaux_publics != NULL) {{ number_format((float)$pay0->travaux_publics, 2, '.', ' ')}} @endif</td>
				<td>   الأشــــــغال العمــــــومية   </td>
				<td>03</td>
			</tr>
			<tr>	
				<td></td>
				<td>@if($pay0->equipements != 0 and $pay0->equipements != NULL) {{ number_format((float)$pay0->equipements, 2, '.', ' ')}} @endif</td>
				<td>    ألات و تجهيـــــــــــــــــــــــزات   </td>
				<td>04</td>
			</tr>
			<tr>	
				<td></td>
				<td>@if($pay0->materiel_transport != 0 and $pay0->materiel_transport != NULL) {{ number_format((float)$pay0->materiel_transport, 2, '.', ' ')}} @endif</td>
				<td>  عتاد النقــــــل ا ولتفريـــــــغ  </td>
				<td>05</td>
			</tr>
			<tr>	
				<td></td>
				<td>@if($pay0->formation != 0 and $pay0->formation != NULL) {{ number_format((float)$pay0->formation, 2, '.', ' ')}} @endif</td>
				<td>    التكويــــــــــــــــــــــــــــــــن   </td>
				<td>06</td>
			</tr>
			<tr>	
				<td></td>
				<td>@if($pay0->travaux_exterieurs != 0 and $pay0->travaux_exterieurs != NULL) {{ number_format((float)$pay0->travaux_exterieurs, 2, '.', ' ')}} @endif</td>
				<td>  تقديم الخدمـــــات الخارجيـــــة    </td>
				<td>07</td>
			</tr>
			<tr>	
				<td></td>
				<td>@if($pay0->publicite != 0 and $pay0->publicite != NULL) {{ number_format((float)$pay0->publicite, 2, '.', ' ')}} @endif</td>
				<td>الإشهــــــــــــــــــــــــــــار </td>
				<td>08</td>
			</tr>
			<?php $j = 8; ?>
			@if($pay0->fonds != 0 and $pay0->fonds != NULL)  
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td></td>
				<td>@if($pay0->fonds != 0 and $pay0->fonds != NULL) {{ number_format((float)$pay0->fonds, 2, '.', ' ')}} @endif</td>
				<td> مال متداول إضافي </td>
				<td>{{ $i }}</td>
			</tr>
			@endif
			@if($pay0->env != 0 and $pay0->env != NULL)
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td></td>
				<td>@if($pay0->env != 0 and $pay0->env != NULL) {{ number_format((float)$pay0->env, 2, '.', ' ')}} @endif</td>
				<td> المنشات الأساسية المحيطة  </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if($pay0->terrain != 0 and $pay0->terrain != NULL)  
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td></td>
				<td>@if($pay0->terrain != 0 and $pay0->terrain != NULL) {{ number_format((float)$pay0->terrain, 2, '.', ' ')}} @endif</td>
				<td>الأرضية </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if($pay0->interets != 0 and $pay0->interets != NULL) 
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td></td>
				<td>@if($pay0->interets != 0 and $pay0->interets != NULL) {{ number_format((float)$pay0->interets, 2, '.', ' ')}} @endif</td>
				<td>الفوائد الاضافية </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if($pay0->douane != 0 and $pay0->douane != NULL) 
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td></td>
				<td>@if($pay0->douane != 0 and $pay0->douane != NULL) {{ number_format((float)$pay0->douane, 2, '.', ' ')}} @endif</td>
				<td>حقوق الجمرك و الرسوم </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if($pay0->stock != 0 and $pay0->stock != NULL)
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td></td>
				<td>@if($pay0->stock != 0 and $pay0->stock != NULL) {{ number_format((float)$pay0->stock, 2, '.', ' ')}} @endif</td>
				<td>المخزون الأدنى </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if($pay0->suiv != 0 and $pay0->suiv != NULL)
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td></td>
				<td>@if($pay0->suiv != 0 and $pay0->suiv != NULL) {{ number_format((float)$pay0->suiv, 2, '.', ' ')}} @endif</td>
				<td> متـــــابعة </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if($pay0->tech != 0 and $pay0->tech != NULL)
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td></td>
				<td>@if($pay0->tech != 0 and $pay0->tech != NULL) {{ number_format((float)$pay0->tech, 2, '.', ' ')}} @endif</td>
				<td> مراقبة تقنيــــة </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if($pay0->labo != 0 and $pay0->labo != NULL)
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td></td>
				<td>@if($pay0->labo != 0 and $pay0->labo != NULL) {{ number_format((float)$pay0->labo, 2, '.', ' ')}} @endif</td>
				<td> مخبـــــر </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td></td>
				<td>@if($pay0->montant_libre != 0 and $pay0->montant_libre != NULL) {{ number_format((float)$pay0->montant_libre, 2, '.', ' ')}} @endif</td>
				<td>   مبلـــــــــــــــــــــــغ غير موزع  </td>
				<td>{{ $i}}</td>
			</tr>
			<tr>	

				<td></td>
				<td>{{ number_format((float)$pay0->total, 2, '.', ' ')}}</td>
				<td style="border : none; text-align: right;" >المجمـــــــــــــــوع</td>
				<td style="border : none;" ></td>
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


