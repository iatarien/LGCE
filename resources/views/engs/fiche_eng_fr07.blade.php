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
	    line-height: 1.1;
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
		font-size: 15px;
		padding: 7px;
		width : 40%;
	}
	#numero td:firs-child {

		width : 20%;
	}
	#titles {
		float: left;
		font-size: 16px;
		margin-right: 50px;
		border-spacing: 1em;
	}
	#titles td {
		vertical-align: top;
	    direction: ltr;
    	text-align: justify;

	}
	#intitule td {
		font-weight: bold;

	}
	th {
		background-color : lightgray;

	}
	#sujet {
		float: left;
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
		text-align : left;
	}
	#CF {
		float: left;
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

<section style="background-color: white; text-align: center; font-size: 14px; margin: 60px;" id="fiche">
	<div id="fiche_top">
		<div>
			<h3 >République Algérienne Démocratique et Populaire  </h3>
		</div>
		<div style="float: left;  text-align : left; width : 100%;">
			<h3>  {{$ministere_fr}} </h3>
            <h3> {{$direction_fr}} de la Wilaya de {{$ville_fr}}</h3>
            <h3>   Code Ordonnateur  : {{$ordre}} </h3>
            <br>
            <div style="display : inline-block" dir="ltr">
                <div class="boold">
                    <span> &emsp;&emsp;  Fiche d'engagement N° :&emsp;&emsp;</span>
                    <span style="border : 2px solid; padding : 5px 15px 5px 15px;"> {{ $eng->numero_fiche }}</span> 
                </div>
                <div class="boold">
                    <span> &emsp; Date :&emsp;&emsp;</span>
					@if($ville_fr =="Biskra" && $eng->inserted_at != NULL)
					<span style="border : 2px solid; padding : 5px 15px 5px 15px;">{{ $eng->inserted_at }}</span> 
					@else
					<span style="border : 2px solid; padding : 5px 15px 5px 15px;"> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</span> 
					@endif

                </div>
            </div>
		</div>
		<br><br><br><br><br><br><br><br><br><br>
        <div dir="ltr" style="float: left; margin-right: 30px; text-align : left; width : 100%;">
			<h3>   Code Programme : {{$eng->programme}}</h3>
            <h3>   Code Action : {{$eng->activite}}</h3>
			@if($eng->sous_action !==NULL )
            <h3>  Code Sous-action : {{$eng->sous_action}}</h3>
			@else
			<h3> Code Sous-action : /</h3>
			@endif
			@if($eng->sous_programme == "")
			<h3>  Code Sous-programme : </h3>
			@elseif(strlen($eng->sous_programme) == 1)
			<h3>    Code Sous-programme : 0{{$sous->code}}</h3>
			@else
			<h3>    Code Sous-programme : {{$sous->code}}</h3>
			@endif
            
		</div>
		<div dir="ltr" style="float: left; margin-right: 30px; text-align : left; width : 100%;">
			<h3>   N° de l'opération :&emsp;
				<span dir="ltr" style=" border : 3px solid; padding : 3px 3px 3px 3px; font-size : 13.5px;"> 
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
			<br>
			<h3> Libellé de l'opération   : <span>{{$eng->intitule}}<span>   </h3>
            <h3> Titre 3 : les dépenses d'investissement  </h3>
		</div>
		<br>
        @if($eng0 != NULL)
        <?php  
            //var_dump($eng0[0]);
            $tots0 =   $eng0[0]->tots;
            $titres20 =  $eng0[0]->titres2 ;
            //$titres0 = $eng0[0]->$titres;
            //$titres10 = $eng0[0]->$titres1;
        ?>
        @endif
		<?php $finale = false;  ?>
		<br><br><br><br><br><br><br><br><br>
		<table id="engagement" contenteditable="true" dir="rtl" >
			<tr dir="ltr">	
				<th>  Solde disponible</th>
				<th>  Engagement proposé </th>
				<th> Solde initial</th>
				<th>  Cumul des engagements souscrits</th>
				<th>  AE :<br>Ouverte/ Révisée</th>
				<th style="text-align : left; width : 30%"> Imputation budgétaire Cat/S.cat</th>
			</tr>
			<tbody id="with_all" style="display : none">
			<?php $i = -1; ?>
            @foreach($titres as $titre)
			<?php $i++; ?>
				<tr dir="ltr" style='font-weight : 900;'>	
					<td>{{ number_format((float)$titre->sums["montant_2"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["montant"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["montant_1"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["cumul"], 2, '.', ' ')}}</td>
					@if(isset($eng0[0]->titres[$i]))
					<td>{{ number_format((float)$eng0[0]->titres[$i]->sums["AP"], 2, '.', ' ')}}</td>
					@else
					<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
					@endif
					<td dir="ltr">{{$titre->code." ".$titre->definition_fr}}</td>
				</tr>
                    <?php $j = -1; ?>
					<?php $finale = false;  ?>
					@foreach($titre->rebriques as $reb)
						@if($reb->id_titre == 127 && ($reb->sous_montant != 0 || $reb->sous_montant_2 != 0 || $reb->sous_montant_1 != 0 ))
						<?php $finale = true; ?>
                        @else
                        <?php $j++ ?>
							@if($reb->sous_montant != 0 && $reb->sous_titre != 127)
							<tr dir="ltr">	
								<td>{{ number_format((float)$reb->sous_montant_2, 2, '.', ' ')}}</td>
								<td>{{ number_format((float)$reb->sous_montant, 2, '.', ' ')}}</td>
								<td>{{ number_format((float)$reb->sous_montant_1, 2, '.', ' ')}}</td>
								<td>{{ number_format((float)$reb->sous_cumul, 2, '.', ' ')}}</td>
								@if(isset($eng0[0]->titres[$i]->rebriques[$j]))
                                <td>{{ number_format((float)$eng0[0]->titres[$i]->rebriques[$j]->sous_AP, 2, '.', ' ')}}</td>
                                @else
                                <td>{{ number_format((float)0, 2, '.', ' ')}}</td>
                                @endif

								<td dir="ltr">{{$reb->code." ".$reb->definition_fr}}</td>
							</tr>
							@endif
						@endif
					@endforeach
			@endforeach
			@if(!$finale)
					<tr style='font-weight : 900;'>	
						<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
						<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
						<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
						<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
						<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
						<td dir="rtl">Montant Non Ventillé</td>
					</tr>
				@endif
            @if($ville_fr =="Biskra" || $ville_fr =="Touggourt")
			<tr style='font-weight : 900;' dir="ltr">	
				<td>{{ number_format((float)$tots->montant_2, 2, '.', ' ')}}</td>
				@if($insc == true)
				<td>{{ number_format((float)$tots->montant, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant_1, 2, '.', ' ')}}</td>
				@else
				<td>{{ number_format((float)0, 2, '.', ' ')}}</td>
				<td>{{ number_format((float)$tots->montant, 2, '.', ' ')}}</td>
				@endif
				<td>{{ number_format((float)$tots->cumul, 2, '.', ' ')}}</td>
				@if(isset($tots0))
                <td>{{ number_format((float)$tots0->AP, 2, '.', ' ')}}</td>
                @else
                <td>{{ number_format((float)0, 2, '.', ' ')}}</td>
                @endif
				<td dir="rtl">Total</td>
			</tr>
			@endif

			</tbody>
			<tbody id="with_sous" style="display : none;">
			@foreach($titres1 as $titre)
				<tr dir="ltr" style='font-weight : 900;'>	
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td dir="ltr">{{$titre->code." ".$titre->definition_fr}}</td>
				</tr>
				@foreach($titre->rebriques as $reb)
				@if($reb->sous_montant != 0)
				<tr dir="ltr" style='font-weight : 900;'>	
					<td>{{ number_format((float)$reb->sous_montant_2, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_montant, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_montant_1, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_cumul, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_AP, 2, '.', ' ')}}</td>
					<td dir="ltr">{{$reb->code." ".$reb->definition_fr}}</td>
				</tr>
				@endif
				@endforeach
			@endforeach
			</tbody>
			<tbody id="with_none" style="display : none">
			@foreach($titres1 as $titre)
				<tr dir="ltr" style='font-weight : 900;'>	
					<td>{{ number_format((float)$titre->sums["montant_2"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["montant"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["montant_1"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["cumul"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["AP"], 2, '.', ' ')}}</td>
					<td dir="ltr">{{$titre->code." ".$titre->definition_fr}}</td>
				</tr>
				@foreach($titre->rebriques as $reb)
				@if($reb->sous_montant != 0)
				<tr dir="ltr">	
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td dir="ltr">{{$reb->code." ".$reb->definition_fr}}</td>
				</tr>
				@endif
				@endforeach
			@endforeach
			</tbody>
		</table>
		<br>
		<div id="show_sous" dir="ltr">
			@if($pref_eng == "with_all")
				<input type="radio" name="genderS" value="all" checked>  Touts les catégories
				<input type="radio" name="genderS" value="sous" > Sous Catégories
				<input type="radio" name="genderS" value="none" > Catégorie 
			@elseif($pref_eng == "with_sous")
				<input type="radio" name="genderS" value="all" > Touts les catégories
				<input type="radio" name="genderS" value="sous" checked> Sous Catégories
				<input type="radio" name="genderS" value="none" > Catégorie 
			@elseif($pref_eng == "with_none")
				<input type="radio" name="genderS" value="all"> Touts les catégories
				<input type="radio" name="genderS" value="sous" > Sous Catégories
				<input type="radio" name="genderS" value="none" checked > Catégorie  
			@endif
			
		</div>

		<div dir="ltr" style="float: left; width : 100%">
            <h3 style="text-align : left;">Objet de l'engagement :</h3>
            <h3 style="text-align : center; font-weight : normal;">{!! nl2br($eng->real_sujet) !!}</h3>
		</div>
		<br><br><br>
		<table id="numero" >
			<tr dir="ltr">
                <td style=" background-color: lightgray !important; ">       Cadre reservé au controleur budgétaire  </td>
				<td style=" background-color: lightgray !important; ">  Cadre reservé à l'ordonnateur    </td>
			</tr>
			<tr dir="ltr">
                <td>
					<div style="text-align : left" dir="ltr">
						<br>
						<div class="boold">
							<span>   N° de visa :&emsp;&emsp;&emsp;&emsp;&emsp;</span>
							@if($eng->num_visa != NULL && $eng->num_visa != "")
							<span style=" text-align : center; border : 2px solid; padding : 5px 35px 5px 35px;"> {{ $eng->num_visa }}</span> 
							@else
							<span style="border : 2px solid; padding : 5px 125px 5px 15px;"> {{ $eng->num_visa }}</span> 
							@endif
						</div><br><br><br>
						<div class="boold">
							<span>  Date de visa :&emsp;&emsp;&emsp;&emsp;</span>
							@if($eng->date_visa != NULL && $eng->date_visa != "")
							<span style="border : 2px solid; padding : 5px 15px 5px 15px;"> {{ $eng->date_visa }}</span> 
							@else
							<span style="border : 2px solid; padding : 5px 125px 5px 15px;"> {{ $eng->date_visa }}</span> 
							@endif
						</div>
						<br><br><br>
						<span dir="ltr" style="text-align : left">Cachet griffe :  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;Signature :  </span>
					</div>
					<br><br><br><br>

				</td>
				<td>
					<div style="text-align : left" dir="ltr">
						<div class="boold">
							<span> Cachet griffe   :&emsp;&emsp;&emsp;&emsp;</span>
						</div><br><br><br>
						<div class="boold">
							<span>  Signature  :&emsp;&emsp;&emsp;&emsp;</span>
						</div>
					</div>
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
  onclick="printdiv('fiche')"> Imprimer </button>
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
  onclick="document.location.href='../eng_apro/{{$id}}';"> Retour </button>
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
  href='../engagements/{{str_replace("/","_",$eng->numero)}}'> Retour </a>
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
  onclick="document.location.href='../engagements/all';"> Retour </button>
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
  onclick="document.location.href='../modifier_engagement/{{$eng->id_eng}}';"> Modifier </button>
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
	if (this.value == 'sous') {
		document.getElementById('with_all').style.display = "none";
		document.getElementById('with_none').style.display = "none";
		document.getElementById('with_sous').style.display = "contents";
		
	}
	else if (this.value == 'none') {
		document.getElementById('with_all').style.display = "none";
		document.getElementById('with_none').style.display = "contents";
		document.getElementById('with_sous').style.display = "none";
	}else{
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


