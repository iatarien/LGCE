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
		/* font-weight: 700; */
		padding: 0 3px 0 3px;
		padding : 10px;
        font-size: 15px;
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
@include('pays.nuts')
<?php 

$brut = (float)$pay->to_pay + (float)$pay->total_cut;
$txt = " ";
if($pay->travaux_type != "فاتورة" && $pay->travaux_num != null){
    $txt = $txt.$pay->travaux_type." N° ".$pay->travaux_num." DU ".$pay->date_pay;
}
elseif($pay->travaux_type  !="facture" && $pay->deal != null){
    $txt = $txt.$pay->deal_type." ";
}

if($pay->deal_num != null){
    $txt=$txt." ".$pay->deal_type." N° ".$pay->deal_num;
}
if($pay->deal_date != null){
    $txt=$txt." DU ".$pay->deal_date." ";
}


$txt =$txt." Relative à : ".$pay->lot;
?>

<?php 

$brut = (float)$pay->to_pay + (float)$pay->total_cut;
$obj = new nuts($pay->to_pay, "EUR");
$text = $obj->convert("fr-FR");
$text = str_replace("euro","Dinar",$text);
$text = str_replace(","," et",$text);
$text = ucfirst($text);
?>
<section style="background-color: white; text-align: center; font-size: 14.5px; margin: 20px;" id="fiche" contenteditable="true">
	<div id="fiche_top">
		<div>
			<h3 >République Algérienne Démocratique et Populaire  </h3>
		</div>
		<div style="float: left;  text-align : left; width : 70%;">
			<h3>  {{$ministere_fr}} </h3>
            <h3> {{$direction_fr}} de la Wilaya de {{$ville_fr}}</h3>
            <h3>   Code Ordonnateur  : <span dir="rtl">{{$ordre}}</span> &emsp; </h3>
            <br>
		</div>
        <div style="display : inline-block; width : 40%; marign-left : 30%" dir="ltr">
            <div class="boold">
                <h2>Avis de Virement</h2>
            </div>
        </div>
		<div align="left">
                <h2>&emsp;&emsp;&emsp;&emsp;Date : &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
				&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
				Lieu : {{$ville_fr}}</h2>
		</div>
		<div dir="ltr" style="float: left; margin-right: 30px; text-align : left; width : 100%;">
			<h3><span>Par le débit de notre compte ouvert dans vos écritures comptables sous le </span></h3>
			<h3>   N° RIB :&emsp;
				<span dir="ltr" style=" border : 3px solid; padding : 5px 5px 5px 5px;"> 
				<?php 

				$numero = str_replace(" ","",$compte_tresor);
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
			<h3> Designation de donneur d'ordre de, entité : <span> {{$direction_fr}} de la Wilaya de <span> {{$ville_fr}}   </h3>
			<h3> Libellé de l'opération   : <span>{{$op->intitule}}<span>   </h3>
			<h3><span>Nous vous prions de vouloir créditer notre créancier (le bénéficiaire) dont le </span></h3>
            <h3> Nom : <span>{{$e->name}}</span>   </h3>
            <h3> Prenom   : <strong></strong>   </h3>
			<h3> Raison Sociale   : <strong></strong>   </h3>
			<h3> Adresse du bénéficiaire   : <strong></strong>   </h3>
			<h3>   N° RIB :&emsp;
				<span dir="ltr" style=" border : 3px solid; padding : 5px 5px 5px 5px;"> 
				<?php 
				$pay0 = $pay;
				$numero = str_replace(" ","",$bank->bank_acc);
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
			<h3> D'un montant de    </h3>
			<h3> En chiffres   : <span>{{ number_format((float)$pay->to_pay, 2, '.', ' ')}} DA</span>  </h3>
			<h3> En lettres   : <span>{{$text}}</span>   </h3>
		</div>
		<br>
		
		<br>
	</div>
    <div style="width: 20%; display: inline-block; float: right;">
    <br><br><br>
		<div align="center">
            <p style="font-weight : bold; font-size : 18px;">
			<span> <span style="">Cachet humide du donneur d'ordre</span>
             <i style="visibility : hidden">........</i> </span>
			<br>
            </p>
		</div>
	</div>
</section>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
  onclick="printdiv('fiche')"> Imprimer </button>


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
  onclick="retour()"> Retour </button>


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

function retour(){
	if(window.history.length == 1){
		window.close();
	}else{
		document.location.href = "/fiche_pay/{{$id}}";
	}
}

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
	
});


function printdiv(printdivname) {
	document.getElementById('bouton').style.display = "none";
	document.getElementById('bouton_2').style.display = "none";
	if(document.getElementById('bouton_3')){
		document.getElementById('bouton_3').style.display = "none";
	}



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


