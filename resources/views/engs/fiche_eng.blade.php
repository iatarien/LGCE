<!DOCTYPE html>
<html>
<head>
	  <!-- Bootstrap CSS -->
	  <link href="/css/bootstrap.min.css" rel="stylesheet">
	  
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
	    line-height: 1.2;
	    -webkit-print-color-adjust: exact !important;
	}
	
	#numero {
		border-collapse: collapse;
		border: 1px solid;
		table-layout: fixed;
		width : 100%;

	}
	#numero td {

		font-weight: bold;
		border: 1px solid;
		font-size: 14px;
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
	th {
		background-color : lightgray;

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
		font-size: 15px;
		padding : 5px;
	}
	#engagement td {
		border : 1px solid;
		font-size: 12px;
		/* font-weight: 700; */
		padding: 0 3px 0 3px;
		padding : 10px;
	}
	#engagement td:last-child {
		text-align : right;
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
		font-size: 14px;
		font-weight: bold;
		padding: 0 3px 0 3px;
	}
    .boold {
        font-size: 1.17em; 
        font-weight : bold;
        display : inline;
    }
	h3 span {
		font-weight : lighter;
	}
</style>

</head>
<body id="boody" class="container">
<?php 	$font = "14.5px"; ?>
@if($ville_fr =="Touggourt")
<?php 	$font = "12px"; ?>
@endif
<section style="background-color: white; text-align: center; font-size: {{$font}}; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div>
			<h3 >   الجمهورية الجزائرية الديمقراطية الشعبية   </h3>
		</div>
		<div style="float: right; margin-right: 30px; text-align : right; width : 100%;">
			<h3>  الوزارة :     {{$ministere}}  </h3>
            <h3>  الهيئة الإدارية : مديرية {{$direction}} لولاية {{$ville}}</h3>
            <h3>  رمز الأمر بالصرف : {{$ordre}} </h3>
            <br>
            <div style="display : inline-block" dir="rtl">
                <div class="boold">
                    <span> &emsp;&emsp;  رقم بطاقة الإلتزام :&emsp;&emsp;</span>
                    <span style="border : 2px solid; padding : 5px 15px 5px 15px;"> {{ $eng->numero_fiche }}</span> 
                </div>
                <div class="boold">
                    <span> &emsp; التـــــاريخ :&emsp;&emsp;</span>
                    <span style="border : 2px solid; padding : 5px 15px 5px 15px;"> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</span> 
                </div>
            </div>
		</div>
		<br><br><br><br><br><br><br><br><br><br>
        <div dir="rtl" style="float: right; margin-right: 30px; text-align : right; width : 100%;">
			<h3>  رمز البرنامج : {{$eng->programme}}</h3>
            <h3>  رمز الــنشاط : {{$eng->activite}}</h3>
			@if($eng->sous_action !==NULL )
			
            <h3>  رمز النشاط الفرعي : {{$eng->sous_action}}</h3>
			@else
			<h3>  رمز النشاط الفرعي : /</h3>
			@endif
			@if($eng->sous_programme == "")
			<h3>رمز البرنامج الفرعي : </h3>
			@elseif(strlen($eng->sous_programme) == 1)
			<h3>  رمز البرنامج الفرعي : 0{{$sous->code}}</h3>
			@else
			<h3>  رمز البرنامج الفرعي : {{$sous->code}}</h3>
			@endif
            
		</div>
		<div dir="rtl" style="float: right; margin-right: 30px; margin-left: 30px; text-align : right; width : 100%;">
			<h3>  رقم العملية :&emsp;
				<span dir="ltr" style=" border : 3px solid; padding : 5px 5px 5px 5px;"> 
				<?php 
				$numero = str_replace(".","",$eng->numero);
				$numeros = str_split($numero); 
				
				?>
				<?php $max = count($numeros); $i = 0;?>
				@foreach ($numeros as $n)
				<?php $i++; ?>
					@if($n !== '-' && $n !== '/' && $n !== '.' && $n !== ',')
						@if($i == $max)
						<span style='font-weight : bold; padding : 2px 2px 2px 2px;'>{{$n}}</span>
						@else
						<span style='font-weight : bold; border-right : 3px solid; padding : 2px 5px 2px 2px;'>{{$n}}</span>
						@endif 
					@endif
				 @endforeach
			</span>
			</h3>
		</div>
		<div dir="rtl" style="float: right; text-align : right; width : 100%;">
			
			<br>
			<div dir="ltr" style="width : 100%; text-align : center">
			<h3>  عنوان العملية : <span>{{$eng->intitule_ar}}<span>   </h3>
			<h3 dir="ltr" style="width : 100%;"> Intitulé de l'operation : <span>{{$eng->intitule}}<span>   </h3>
			</div>
            <h3> العنوان 3 : نفقات الإستثمار   </h3>
		</div>
		<br>

		<br><br><br><br><br><br><br><br><br>
		<table id="engagement" contenteditable="true" >
			<tr>	
				<th>الرصيـــد  المتبقي</th>
				<th> الإلتزام المـــقترح </th>
				<th>الرصيـد الأولي</th>
				<th>مجموع الإلتزامات السابقة</th>
				<th>رخصة الإلتزام المفتوحة/المعدلة</th>
				<th style="text-align : right; width : 30%"> الصنف / الصنف الفرعي </th>
			</tr>
			@include('engs.eng_comp.with_all_e')
			<tbody id="with_all" style="display : none">
			@if(($ville_fr =="Ouled Djellal" || $ville_fr =="ouled djellal" || $ville_fr =="Biskra" || $ville_fr =="Touggourt"
			|| $ville_fr =="Ouled djellal") && $insc == "true" )
				@foreach($titres as $titre)
					@if($titre->sums["montant_2"] != 0 || $titre->sums["montant"] != 0 || $titre->sums["montant_1"] != 0)
					<tr style='font-weight : 900;'>	
						<td>{{ number_format((float)$titre->sums["montant_2"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["montant"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["cumul"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["AP"], 2, '.', ' ')}}</td>
						
						@if($ville_fr !="Ouled Djellal")
						<td dir="rtl">{{$titre->code." ".$titre->definition}}</td>
						@else
						<td dir="rtl">الصنف  : {{$titre->code." "}}</td>
						@endif
					</tr>
					@endif
					@foreach($titre->rebriques as $reb)
					@if($reb->id_titre == 127)

					@else
						@if($reb->sous_montant != 0 || $reb->sous_montant_2 != 0 || $reb->sous_montant_1 != 0)
						<tr>	
							<td>{{ number_format((float)$reb->sous_montant_2, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
								<td>{{ number_format((float)$reb->sous_montant, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)$reb->sous_cumul, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)$reb->sous_AP, 2, '.', ' ')}}</td>
							@if($ville_fr !="Ouled Djellal")
							<td dir="rtl">{{$reb->code." ".$reb->definition}}</td>
							@else

								<td dir="rtl">الصنف الفرعي : {{$reb->code." "}}</td>
		
							@endif
						</tr>
						@endif
					@endif
					
					@endforeach
				@endforeach
			@else
				@foreach($titres as $titre)
					@if($titre->sums["montant_2"] != 0 || $titre->sums["montant"] != 0 || $titre->sums["montant_1"] != 0)
					<tr style='font-weight : 900;'>	
						<td>{{ number_format((float)$titre->sums["montant_2"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["montant"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["montant_1"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["cumul"], 2, '.', ' ')}}</td>
						<td>{{ number_format((float)$titre->sums["AP"], 2, '.', ' ')}}</td>
						@if($ville_fr !="Ouled Djellal")
						<td dir="rtl">{{$titre->code." ".$titre->definition}}</td>
						@else
							@if($titre->id_titre == 128)
							<td dir="rtl">{{$titre->code." ".$titre->definition}}</td>
							@else
							<td dir="rtl">الصنف  : {{$titre->code." "}}</td>
							@endif
						@endif
					</tr>
					@endif
					@foreach($titre->rebriques as $reb)
					@if($reb->id_titre == 127)

					@else
						@if($reb->sous_montant != 0 || $reb->sous_montant_2 != 0 || $reb->sous_montant_1 != 0)
						<tr>	
							<td>{{ number_format((float)$reb->sous_montant_2, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)$reb->sous_montant, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)$reb->sous_montant_1, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)$reb->sous_cumul, 2, '.', ' ')}}</td>
							<td>{{ number_format((float)$reb->sous_AP, 2, '.', ' ')}}</td>
							@if($ville_fr !="Ouled Djellal")
							<td dir="rtl">{{$reb->code." ".$reb->definition}}</td>
							@else
								<td dir="rtl">الصنف الفرعي : {{$reb->code." "}}</td>

							@endif
						</tr>
					@endif
					@endif
					
					@endforeach
				@endforeach
			@endif
			@if($ville_fr =="Biskra" || $ville_fr =="Touggourt")
			@if($insc =="true")
			<tr style='font-weight : 900;'>	
				<td>{{ number_format((float)$tots->montant_2, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->cumul, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->AP, 2, '.', ' ')}}</td>
				<td dir="rtl">المجموع</td>
			</tr>
			@else
			<tr style='font-weight : 900;'>	
				<td>{{ number_format((float)$tots->montant_2, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant_1, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->cumul, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->AP, 2, '.', ' ')}}</td>
				<td dir="rtl">المجموع</td>
			</tr>
			@endif
			@endif
			</tbody>
			<tbody id="with_sous" style="display : none;">
			@foreach($titres1 as $titre)
				<tr style='font-weight : 900;'>	
					<td>{{ number_format((float)$titre->sums["montant_2"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["montant"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["montant_1"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["cumul"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["AP"], 2, '.', ' ')}}</td>
					@if($ville_fr !="Ouled Djellal")
					<td dir="rtl">{{$titre->code." ".$titre->definition}}</td>
					@else
						@if($titre->id_titre == 128)
						<td dir="rtl">{{$titre->code." ".$titre->definition}}</td>
						@else
						<td dir="rtl">الصنف  : {{$titre->code." "}}</td>
						@endif
					@endif
			</tr>
				@foreach($titre->rebriques as $reb)
				@if($reb->sous_montant != 0)
				<tr>	
					<td>{{ number_format((float)$reb->sous_montant_2, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_montant, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_montant_1, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_cumul, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_AP, 2, '.', ' ')}}</td>
					@if($ville_fr !="Ouled Djellal")
					<td dir="rtl">{{$reb->code." ".$reb->definition}}</td>
					@else
						<td dir="rtl">الصنف الفرعي : {{$reb->code." "}}</td>
						
					@endif
				</tr>
				@endif
				@endforeach
			@endforeach
			@if($ville_fr =="Biskra" || $ville_fr =="Touggourt")
			@if($insc !="true")
			<tr style='font-weight : 900;'>	
				<td>{{ number_format((float)$tots->montant_2, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant_1, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->cumul, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->AP, 2, '.', ' ')}}</td>
				<td dir="rtl">المجموع</td>
			</tr>
			@else
			<tr style='font-weight : 900;'>	
				<td>{{ number_format((float)$tots->montant_2, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->cumul, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->AP, 2, '.', ' ')}}</td>
				<td dir="rtl">المجموع</td>
			</tr>
			@endif
			@endif
			</tbody>
			<tbody id="with_none" style="display : none">
			@foreach($titres1 as $titre)
				<tr style='font-weight : 900;'>	
					<td>{{ number_format((float)$titre->sums["montant_2"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["montant"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["montant_1"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["cumul"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["AP"], 2, '.', ' ')}}</td>
					@if($ville_fr !="Ouled Djellal")
					<td dir="rtl">{{$titre->code." ".$titre->definition}}</td>
					@else
						@if($titre->id_titre == 128)
						<td dir="rtl">{{$titre->code." ".$titre->definition}}</td>
						@else
						<td dir="rtl">الصنف  : {{$titre->code." "}}</td>
						@endif
					@endif
				</tr>
				@foreach($titre->rebriques as $reb)
				@if($reb->sous_montant != 0)
				<tr>	
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td>/</td>
					@if($ville_fr !="Ouled Djellal")
					<td dir="rtl">{{$reb->code." ".$reb->definition}}</td>
					@else
						<td dir="rtl">الصنف الفرعي : {{$reb->code." "}}</td>
						
					@endif
				</tr>
				@endif
				@endforeach
			@endforeach
			@if($ville_fr =="Biskra" || $ville_fr =="Touggourt")
			@if($insc !="true")
			<tr style='font-weight : 900;'>	
				<td>{{ number_format((float)$tots->montant_2, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant_1, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->cumul, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->AP, 2, '.', ' ')}}</td>
				<td dir="rtl">المجموع</td>
			</tr>
			@else
			<tr style='font-weight : 900;'>	
				<td>{{ number_format((float)$tots->montant_2, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->cumul, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->AP, 2, '.', ' ')}}</td>
				<td dir="rtl">المجموع</td>
			</tr>
			@endif
			@endif
			</tbody>
		</table>
		<br>
		<div id="show_sous" dir="rtl">
			@if($pref_eng == "with_all_e")
				<input type="radio" name="genderS" value="all_e" checked> (بالتفصيل) كل الأصناف
				<input type="radio" name="genderS" value="all"> كل الأصناف
				<input type="radio" name="genderS" value="sous" > الصنف الفرعي
				<input type="radio" name="genderS" value="none" > الصنف 
			@elseif($pref_eng == "with_all")
				<input type="radio" name="genderS" value="all_e"> (بالتفصيل) كل الأصناف
				<input type="radio" name="genderS" value="all" checked> كل الأصناف
				<input type="radio" name="genderS" value="sous" > الصنف الفرعي
				<input type="radio" name="genderS" value="none" > الصنف 
			@elseif($pref_eng == "with_sous")
				<input type="radio" name="genderS" value="all_e"> (بالتفصيل) كل الأصناف
				<input type="radio" name="genderS" value="all" > كل الأصناف
				<input type="radio" name="genderS" value="sous" checked> الصنف الفرعي
				<input type="radio" name="genderS" value="none" > الصنف 
			@elseif($pref_eng == "with_none")
				<input type="radio" name="genderS" value="all_e"> (بالتفصيل) كل الأصناف
				<input type="radio" name="genderS" value="all"> كل الأصناف
				<input type="radio" name="genderS" value="sous" > الصنف الفرعي
				<input type="radio" name="genderS" value="none" checked > الصنف 
			@endif
			
		</div>

		<div dir="rtl" style="float: right; margin-right: 30px; text-align : justify;">
			<h3> موضوع الإلتزام : <span>{{$eng->real_sujet}}<span></h3>
		</div>
		<br><br><br>
		<table id="numero" >
			<tr>
				<td style=" background-color: lightgray !important; "> إطار مخصص لللأمر بالصرف</td>
				<td style=" background-color: lightgray !important; ">       إطار مخصص للمراقب الميزانياتي  </td>
			</tr>
			<tr>
				<td>
					<div style="text-align : right" dir="rtl">
						<div class="boold">
							<span> ختم   :&emsp;&emsp;&emsp;&emsp;</span>
						</div><br><br><br>
						<div class="boold">
							<span>  إمضاء :&emsp;&emsp;&emsp;&emsp;</span>
						</div>
					</div>
				</td>
				<td>
					<div style="text-align : right" dir="rtl">
						<br>
						<div class="boold">
							<span> رقـم  التــأشيرة :&emsp;&emsp;&emsp;&emsp;</span>
							@if($eng->num_visa != NULL && $eng->num_visa != "")
							<span style=" text-align : center; border : 2px solid; padding : 5px 47px 5px 47px;"> {{ $eng->num_visa }}</span> 
							@else
							<span style="border : 2px solid; padding : 5px 125px 5px 15px;"> {{ $eng->num_visa }}</span> 
							@endif
						</div><br><br><br>
						<div class="boold">
							<span> تاريخ التأشيرة :&emsp;&emsp;&emsp;&emsp;</span>
							@if($eng->date_visa != NULL && $eng->date_visa != "")
							<span style="border : 2px solid; padding : 5px 15px 5px 15px;"> {{ $eng->date_visa }}</span> 
							@else
							<span style="border : 2px solid; padding : 5px 125px 5px 15px;"> {{ $eng->date_visa }}</span> 
							@endif
						</div>
						<br><br><br>
						<span dir="rtl" style="text-align : right">إمضاء : &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;   الختم :   </span>
					</div>
					<br>

				</td>
			</tr>
		</table>
	</div>

</section>
<br><br><br><br><br><br><br><br><br>
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
  onclick="document.location.href='../engagements/all';"> رجوع </button>
@endif
@if($user->id == $eng->user_id || $user->service =="Engagement")
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js" integrity="sha512-csNcFYJniKjJxRWRV1R7fvnXrycHP6qDR21mgz1ZP55xY5d+aHLfo9/FcGDQLfn2IfngbAHd8LdfsagcCqgTcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
<script type="text/javascript">
window.onbeforeunload = function () {
    window.close();
};
document.getElementById('{{$pref_eng}}').style.display = "contents";
$('input[type=radio]').on('change',function() {

	const url ="/update_pref_eng/with_"+this.value;
	$.ajax({
		url: url,
		type:"GET", 
		cache: false,
		success:function(response) {
			console.log(response);
		},
		error:function(response) {
			console.log(response);
		},

	});
	if (this.value == 'all_e') {
		document.getElementById('with_all_e').style.display = "contents";
		document.getElementById('with_all').style.display = "none";
		document.getElementById('with_none').style.display = "none";
		document.getElementById('with_sous').style.display = "none";
	}else if (this.value == 'sous') {
		document.getElementById('with_all_e').style.display = "none";
		document.getElementById('with_all').style.display = "none";
		document.getElementById('with_none').style.display = "none";
		document.getElementById('with_sous').style.display = "contents";
	}
	else if (this.value == 'none') {
		document.getElementById('with_all_e').style.display = "none";
		document.getElementById('with_all').style.display = "none";
		document.getElementById('with_none').style.display = "contents";
		document.getElementById('with_sous').style.display = "none";
	}else{
		document.getElementById('with_all_e').style.display = "none";
		document.getElementById('with_all').style.display = "contents";
		document.getElementById('with_none').style.display = "none";
		document.getElementById('with_sous').style.display = "none";
	}
});

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
	window.scrollTo(0, 0);
	document.getElementById('bouton').style.display = "none";
	document.getElementById('bouton_2').style.display = "none";
	if(document.getElementById('bouton_3')){
		document.getElementById('bouton_3').style.display = "none";
	}
	document.getElementById('show_sous').style.display = "none";


    print();
    document.getElementById('bouton').style.display = "inline-block";
	document.getElementById('bouton_2').style.display = "inline-block";
	if(document.getElementById('bouton_3')){
		document.getElementById('bouton_3').style.display = "inline-block";
	}
	document.getElementById('show_sous').style.display = "block";

    return false;
}
function printdiv1(printdivname) {
	// document.getElementById('bouton').style.display = "none";
	// document.getElementById('bouton_2').style.display = "none";
	// if(document.getElementById('bouton_3')){
	// 	document.getElementById('bouton_3').style.display = "none";
	// }
	// var txt = document.documentElement.outerHTML;
	// txt = txt.replace("&","&amp;");
	// txt = txt.replace("<","&lt;");
	// txt = txt.replace(">","&gt;");
	// document.getElementById('boody').innerHTML += txt;
	html2canvas($("#boody")[0]).then((canvas) => {
		alert("done ... ");
		//document.body.appendChild(canvas);
		var imagedata = canvas.toDataURL("images/png");
		const { jsPDF } = window.jspdf;
        var doc = new jsPDF();
		doc.addImage(imagedata,"PNG",0,0);
		doc.save("sample.pdf");
	});
	

    // document.getElementById('bouton').style.display = "inline-block";
	// document.getElementById('bouton_2').style.display = "inline-block";
	// if(document.getElementById('bouton_3')){
	// 	document.getElementById('bouton_3').style.display = "inline-block";
	// }
	
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


