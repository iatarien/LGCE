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
		size: portrait;
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
	    height:287mm;
	    width:210mm;
	    margin: auto;
	    line-height: 1.4;
	    -webkit-print-color-adjust: exact !important;
	}
	#numero {
		border-collapse: collapse;
		border: 1px solid;
		table-layout: fixed;
		width : 50%;

	}
	#numero td {

		font-weight: bold;
		border: 1px solid;
		font-size: 15px;
		padding: 7px;
		width : 40%;
	}
	#numero td:firs-child {

		width : 20%;
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
	#engagement {
		border-collapse: collapse;
		border : 1px solid;
		table-layout: fixed;
		width: 100%;
	}
	#engagement th {
		border : 1px solid;
		width: 20%;
		font-size: 16px;
	}
	#engagement td {
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
	}
	#CF td {
		border : 1px solid;
		font-size: 16px;
		font-weight: bold;
		padding: 0 3px 0 3px;
	}
</style>

</head>
<body>

<section style="background-color: white; text-align: center; font-size: 14.5px; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div style=" border: 1px solid; display: inline-block; background-color: rgb(245,245,245) !important; ">
			<h3 style="text-decoration: underline; padding: 0px 2px 0px 2px;">    بطـــــــــــــاقة الإلـــــــــتـــزام     </h3>
		</div>
		<br>
		<div style=" display: inline-block; float: right; margin-right: 30px; ">
			<h3 style="text-decoration: underline; padding: 0px 2px 0px 2px;"> عمليات الميزانية </h3>
		</div>
		<br><br><br>
		<div style=" border: 1px solid; display: inline-block; float: left; background-color: rgb(245,245,245) !important; ">
			<h3 style="padding: 0px 2px 0px 2px;">ميــــــــــزانيــــة التجهيــــــــز</h3>
		</div>
		<div style=" border: 1px solid; display: inline-block; float: right; background-color: rgb(245,245,245) !important; ">
			<h3 style="padding: 0px 2px 0px 2px;">      مديرية التجهيزات العمومية لولاية ورقلة   </h3>
		</div>
		
		<br><br><br><br>
		
		<table id="numero" >
			<tr>
				<td style="width: 90px; background-color: rgb(245,245,245) !important; ">       رقم البطاقة   </td>
				<td style="width: 200px; background-color: rgb(245,245,245) !important; "> رقم الــــــعمـــلــــــــــــــية</td>
				
			</tr>
			<tr>
				<td>{{ $eng->numero_fiche }}</td>
				<td>{{ $eng->numero }}</td>
			</tr>
		</table>

		<br>
		
		<table id="titles" style="width : 96%;" >
			<tr id="intitule">
				<td>      {{ $eng->intitule_ar }}      </td>
				<td style="text-decoration : underline; width: 200px;">     تعييــــــــــن العمليـــــــــــــــــة : </td>
				
				
			</tr>
			<tr>
				<td>    {{ $txt }}    </td>
				<td style=" text-decoration : underline; font-weight: bold;"> موضــــــــــــوع الإلـــــتـــــزام : </td>
				
			</tr>
		</table>
		<br>

		<div style=" border: 1px solid; display: inline-block; float: right;">
			<h3 style="padding: 0px 5px 0px 5px;">     تركيـــب الإلتــــــزام المقتـــــــــــرح    </h3>
		</div>
		<br><br><br><br><br><br><br><br><br>
		<table id="engagement" >
			<tr>	
				<th>الرصيـــد  الجـديد</th>
				<th> المبلغ المـــقترح </th>
				<th>الرصيـد القديـم</th>
				<th style=" border : none; text-align: right;width : 35%;">العنــــــــــــــــــــــــــــاويــــــــــن</th>
				<th style="width: 5%; border : none;"></th>
			</tr>
			<tr>	
				<td>@if($eng->etude_2 !== NULL and $eng->etude_2 != 0) {{ number_format((float)$eng->etude_2, 2, '.', ',')}} @else - @endif</td>
				<td>@if($eng->etude != 0 and $eng->etude !== NULL) {{ number_format((float)$eng->etude, 2, '.', ',')}} @endif</td>
				<td>@if($eng0->etude != 0 and $eng0->etude !== NULL) {{ number_format((float)$eng0->etude, 2, '.', ',')}}@else - @endif</td>
				<td>   الدراســــــات و/أو الهندســــــة  </td>
				<td>01</td>
			</tr>
			<tr>	
				<td>@if($eng->genie_civil_2 !== NULL and $eng->genie_civil_2 != 0) {{ number_format((float)$eng->genie_civil_2, 2, '.', ',')}} @else - @endif</td>
				<td>@if($eng->genie_civil != 0 and $eng->genie_civil !== NULL) {{ number_format((float)$eng->genie_civil, 2, '.', ',')}} @endif</td>
				<td>@if($eng0->genie_civil != 0 and $eng0->genie_civil !== NULL) {{ number_format((float)$eng0->genie_civil, 2, '.', ',')}}@else - @endif</td>
				<td>    البناء و ما يربط به  هندسة مدنية    </td>
				<td>02</td>
			</tr>
			<tr>	
				<td>@if($eng->travaux_publics_2 !== NULL and $eng->travaux_publics_2 != 0) {{ number_format((float)$eng->travaux_publics_2, 2, '.', ',')}} @else - @endif</td>
				<td>@if($eng->travaux_publics != 0 and $eng->travaux_publics !== NULL) {{ number_format((float)$eng->travaux_publics, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->travaux_publics != 0 and $eng0->travaux_publics !== NULL) {{ number_format((float)$eng0->travaux_publics, 2, '.', ',')}}@else - @endif</td>
				<td>   الأشــــــغال العمــــــومية   </td>
				<td>03</td>
			</tr>
			<tr>	
				<td>@if($eng->equipements_2 !== NULL and $eng->equipements_2 != 0) {{ number_format((float)$eng->equipements_2, 2, '.', ',')}} @else -  @endif</td>
				<td>@if($eng->equipements != 0 and $eng->equipements !== NULL) {{ number_format((float)$eng->equipements, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->equipements != 0 and $eng0->equipements !== NULL) {{ number_format((float)$eng0->equipements, 2, '.', ',')}}@else - @endif</td>
				<td>    ألات و تجهيـــــــــــــــــــــــزات   </td>
				<td>04</td>
			</tr>
			<tr>	
				<td>@if($eng->materiel_transport_2 !== NULL and $eng->materiel_transport_2 != 0) {{ number_format((float)$eng->materiel_transport_2, 2, '.', ',')}} @else - @endif</td>
				<td>@if($eng->materiel_transport != 0 and $eng->materiel_transport !== NULL) {{ number_format((float)$eng->materiel_transport, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->materiel_transport != 0 and $eng0->materiel_transport !== NULL) {{ number_format((float)$eng0->materiel_transport, 2, '.', ',')}}@else - @endif</td>
				<td>  عتاد النقــــــل  والتفريـــــــغ  </td>
				<td>05</td>
			</tr>
			<tr>	
				<td>@if($eng->formation_2 !== NULL and $eng->formation_2 != 0) {{ number_format((float)$eng->formation_2, 2, '.', ',')}} @else - @endif</td>
				<td>@if($eng->formation != 0 and $eng->formation !== NULL) {{ number_format((float)$eng->formation, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->formation != 0 and $eng0->formation !== NULL) {{ number_format((float)$eng0->formation, 2, '.', ',')}}@else - @endif</td>
				<td>    التكويــــــــــــــــــــــــــــــــن   </td>
				<td>06</td>
			</tr>
			<tr>	
				<td>@if($eng->travaux_exterieurs_2 !== NULL and $eng->travaux_exterieurs_2 != 0) {{ number_format((float)$eng->travaux_exterieurs_2, 2, '.', ',')}} @else - @endif</td>
				<td>@if($eng->travaux_exterieurs != 0 and $eng->travaux_exterieurs !== NULL) {{ number_format((float)$eng->travaux_exterieurs, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->travaux_exterieurs != 0 and $eng0->travaux_exterieurs !== NULL) {{ number_format((float)$eng0->travaux_exterieurs, 2, '.', ',')}}@else - @endif</td>
				<td>  تقديم الخدمـــــات الخارجيـــــة    </td>
				<td>07</td>
			</tr>
			<tr>	
				<td>@if($eng->publicite_2 !== NULL and $eng->publicite_2 != 0) {{ number_format((float)$eng->publicite_2, 2, '.', ',')}} @else - @endif</td>
				<td>@if($eng->publicite != 0 and $eng->publicite !== NULL) {{ number_format((float)$eng->publicite, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->publicite != 0 and $eng0->publicite !== NULL) {{ number_format((float)$eng0->publicite, 2, '.', ',')}}@else - @endif</td>
				<td>الإشهــــــــــــــــــــــــــــار </td>
				<td>08</td>
			</tr>
			<?php $j = 8; ?>
			@if(($eng->fonds_2 != 0 and $eng->fonds_2 !== NULL) or ($eng->fonds != 0 and $eng->fonds !== NULL) ) 
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td>@if($eng->fonds_2 !== NULL and $eng->fonds_2 != 0) {{ number_format((float)$eng->fonds_2, 2, '.', ',')}}@else - @endif</td>
				<td>@if($eng->fonds != 0 and $eng->fonds !== NULL) {{ number_format((float)$eng->fonds, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->fonds != 0 and $eng0->fonds !== NULL) {{ number_format((float)$eng0->fonds, 2, '.', ',')}}@else - @endif</td>
				<td> مال متداول إضافي </td>
				<td>{{ $i }}</td>
			</tr>
			@endif
			@if(($eng->env_2 != 0 and $eng->env_2 !== NULL) or ($eng->env != 0 and $eng->env !== NULL) ) 
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td>@if($eng->env_2 !== NULL and $eng->env_2 != 0) {{ number_format((float)$eng->env_2, 2, '.', ',')}}@else - @endif</td>
				<td>@if($eng->env != 0 and $eng->env !== NULL) {{ number_format((float)$eng->env, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->env != 0 and $eng0->env !== NULL) {{ number_format((float)$eng0->env, 2, '.', ',')}}@else - @endif</td>
				<td> المنشات الأساسية المحيطة  </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if(($eng->terrain_2 != 0 and $eng->terrain_2 !== NULL) or ($eng->terrain != 0 and $eng->terrain !== NULL) ) 
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td>@if($eng->terrain_2 !== NULL and $eng->terrain_2 != 0) {{ number_format((float)$eng->terrain_2, 2, '.', ',')}}@else - @endif</td>
				<td>@if($eng->terrain != 0 and $eng->terrain !== NULL) {{ number_format((float)$eng->terrain, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->terrain != 0 and $eng0->terrain !== NULL) {{ number_format((float)$eng0->terrain, 2, '.', ',')}}@else - @endif</td>
				<td>الأرضية </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if(($eng->interets_2 != 0 and $eng->interets_2 !== NULL) or ($eng->interets != 0 and $eng->interets !== NULL) ) 
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td>@if($eng->interets_2 !== NULL and $eng->interets_2 != 0) {{ number_format((float)$eng->interets_2, 2, '.', ',')}}@else - @endif</td>
				<td>@if($eng->interets != 0 and $eng->interets !== NULL) {{ number_format((float)$eng->interets, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->interets != 0 and $eng0->interets !== NULL) {{ number_format((float)$eng0->interets, 2, '.', ',')}}@else - @endif</td>
				<td>الفوائد الاضافية </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if(($eng->douane_2 != 0 and $eng->douane_2 !== NULL) or ($eng->douane != 0 and $eng->douane !== NULL) ) 
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td>@if($eng->douane_2 !== NULL and $eng->douane_2 != 0) {{ number_format((float)$eng->douane_2, 2, '.', ',')}}@else - @endif</td>
				<td>@if($eng->douane != 0 and $eng->douane !== NULL) {{ number_format((float)$eng->douane, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->douane != 0 and $eng0->douane !== NULL) {{ number_format((float)$eng0->douane, 2, '.', ',')}}@else - @endif</td>
				<td>حقوق الجمرك و الرسوم </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if(($eng->stock_2 != 0 and $eng->stock_2 !== NULL) or ($eng->stock != 0 and $eng->stock !== NULL) ) 
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td>@if($eng->stock_2 !== NULL and $eng->stock_2 != 0) {{ number_format((float)$eng->stock_2, 2, '.', ',')}}@else - @endif</td>
				<td>@if($eng->stock != 0 and $eng->stock !== NULL) {{ number_format((float)$eng->stock, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->stock != 0 and $eng0->stock !== NULL) {{ number_format((float)$eng0->stock, 2, '.', ',')}}@else - @endif</td>
				<td>المخزون الأدنى </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if(($eng->suiv_2 != 0 and $eng->suiv_2 !== NULL) or ($eng->suiv != 0 and $eng->suiv !== NULL) or  $eng->source=="PSC") 
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td>@if( $eng->suiv_2 !== NULL and $eng->suiv_2 != 0) {{ number_format((float)$eng->suiv_2, 2, '.', ',')}}@else - @endif</td>
				<td>@if($eng->suiv != 0 and $eng->suiv !== NULL) {{ number_format((float)$eng->suiv, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->suiv != 0 and $eng0->suiv !== NULL) {{ number_format((float)$eng0->suiv, 2, '.', ',')}}@else - @endif</td>
				<td> متـــــابعة </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if(($eng->tech_2 != 0 and $eng->tech_2 !== NULL) or ($eng->tech != 0 and $eng->tech !== NULL) or $eng->source=="PSC") 
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td>@if($eng->tech_2 !== NULL and $eng->tech_2 != 0) {{ number_format((float)$eng->tech_2, 2, '.', ',')}}@else - @endif</td>
				<td>@if($eng->tech != 0 and $eng->tech !== NULL) {{ number_format((float)$eng->tech, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->tech != 0 and $eng0->tech !== NULL) {{ number_format((float)$eng0->tech, 2, '.', ',')}}@else - @endif</td>
				<td> مراقبة تقنـيــة </td>
				<td>{{ $i}}</td>
			</tr>
			@endif
			@if(($eng->labo_2 != 0 and $eng->labo_2 !== NULL) or ($eng->labo != 0 and $eng->labo !== NULL) or $eng->source=="PSC") 
			
			<?php $j++;
			$i = $j;
			if($j< 10){
				$i = "0".$i;
			}
			?>
			<tr>	
				<td>@if($eng->labo_2 !== NULL and $eng->labo_2 != 0) {{ number_format((float)$eng->labo_2, 2, '.', ',')}}@else - @endif</td>
				<td>@if($eng->labo != 0 and $eng->labo !== NULL) {{ number_format((float)$eng->labo, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->labo != 0 and $eng0->labo !== NULL) {{ number_format((float)$eng0->labo, 2, '.', ',')}}@else - @endif</td>
				<td> مخبـــــــر </td>
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
				<td>@if($eng->montant_libre_2 !== NULL and $eng->montant_libre_2 != 0) {{ number_format((float)$eng->montant_libre_2, 2, '.', ',')}} @else - @endif</td>
				<td>@if($eng->montant_libre != 0 and $eng->montant_libre !== NULL) {{ number_format((float)$eng->montant_libre, 2, '.', ',')}} @endif</td>
				
				<td>@if($eng0->montant_libre != 0 and $eng0->montant_libre !== NULL) {{ number_format((float)$eng0->montant_libre, 2, '.', ',')}}@else - @endif</td>
				<td>   مبلـــــــــــــــــــــــغ غير موزع  </td>
				<td>{{ $i}}</td>
			</tr>
			<tr>	
				<td>@if($eng->total_2 != 0 and $eng->total_2 !== NULL) {{ number_format((float)$eng->total_2, 2, '.', ',')}} @endif</td>
				<td>{{ number_format((float)$eng->total, 2, '.', ',')}}</td>
				
				<td>@if($eng0->total != 0 and $eng0->total !== NULL) {{ number_format((float)$eng0->total, 2, '.', ',')}} @endif</td>
				
				<td style="border : none; text-align: right;" >المجمـــــــــــــــوع</td>
				<td style="border : none;" ></td>
			</tr>
		</table>
		<br><br><br>
		<table id="CF">
			<tr><td>     تأشيـــــــرة المراقب المالـــــــــــي    </td></tr>
			<tr><td> {{ $eng->num_visa }}  : الرقــــــــــــــــــــــــــم  </td></tr>
			<tr><td>     {{ $eng->date_visa }} :  التاريح  </td></tr>
		</table>

		<div style="font-size: 16px; font-weight: bold; float: left;margin-left: 50px;" >
			<span>         ................... ورقلة في        </span>
		</div>

	</div>

</section>
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
@if($eng->type == "comptable")
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
  onclick="document.location.href='../eng_apro/{{$id}}';"> رجوع </button>
@elseif(strpos($eng->numero, "/") !== false)
<a id="bouton_2" style="
	  background-color: skyblue; /* Green */
	  border: none;
	  color: black;
	  cursor: pointer;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;" 
  href='../engagements/{{str_replace("/","_",$eng->numero)}}'> رجوع </a>
@else
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
  onclick="document.location.href='../engagements/{{$eng->numero}}';"> رجوع </button>
@endif
@if($user->id == $eng->user_id )
<button id="bouton_3" style="
	  background-color: lightgreen; /* Green */
	  border: none;
	  color: black;
	  cursor: pointer;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;" 
  onclick="document.location.href='../modifier_engagement/{{$eng->id_eng}}';"> تعديل </button>
@endif
 <br><br><br><br>
</div>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
<script type="text/javascript">
window.onbeforeunload = function () {
    window.close();
};
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
	if(document.getElementById('bouton_3')){
		document.getElementById('bouton_3').style.display = "none";
	}
	
   /* var footstr = "</body>";
    var newstr = document.getElementById(printdivname).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = ""+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;*/
    print();
    document.getElementById('bouton').style.display = "inline-block";
	document.getElementById('bouton_2').style.display = "inline-block";
	if(document.getElementById('bouton_3')){
		document.getElementById('bouton_3').style.display = "inline-block";
	}
	
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


