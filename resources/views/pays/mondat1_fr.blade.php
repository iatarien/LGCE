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
			margin-top: 2%;
			font-size: 12px;
			line-height: 1.5em;
			-webkit-print-color-adjust: exact !important;
		}
		#fiche {
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
        République Algerienne Democratique et Populaire
    </h3>
	<div style="float: left; width: 90%;" id="top-right">
		<div style="width: 40%; display: inline-block; text-align: center; float: left; margin-left: 10%;">

			<br><br>
			<table id="sarf">
				<tr>
                    <th style="background-color : lightgray"> Code Ordonnateur </th>
					<th> 
                        @if($pay->type =="FSDRS")
                        {{$ordre}}
                        @elseif($op->source=="PSC")
                        {{$ordre}}
                        @else
                        {{$ordre}}
                        @endif 
                    </th>
                    
				</tr>
				
			</table>
		</div>
		<div style="width: 30%; margin-top: 5%; margin-left: 10%; text-align: center; float: left; display : inline-block">
			<table id="things">
				<tr>
                    <td colspan="2" style="background-color : lightgray"> Mandat de Paiement</td>
                </tr>
                <tr>
                    <td style="width: 50%;"> Gestion</td>
                    <td style="width: 50%;">{{$pay->year}}</td>     
                </tr>
                <tr>
                    <td style="width: 50%;">Numéro</td>
                    <td style="width: 50%;">{{$pay->num_mondat}}</td>    
                </tr>
                <tr>
                    <td style="width: 50%;">Date</td>
                    <td style="width: 50%;">{{$pay->date_mondat}}</td>    
                </tr>
                <tr>
                    <td style="width: 50%;">Mandat</td>
                    <td style="width: 50%;">Méthode de paiement</td>
                </tr>

			</table>
		</div>
	</div>
	<div style="width: 40%; float: left; text-align: center; display : none;" id="top-left">
		<br><br><br><br><br><br>
		@if($op->source == "PSC") 
				<div id="stamp"  style = "border : 5px solid red; margin-left : 20mm; width : 25%; font-weight : bold; color : red; font-size : 7mm;">
				302.145.001
				</div>
				@elseif($op->source == "PSD")
				<div id="stamp"  style = "border : 5px solid red; margin-left : 20mm; width : 25%; font-weight : bold; color : red; font-size : 7mm;">
				302.145.002
				</div>
				@elseif($op->source == "FSDRS")
				<?php $sf = substr($op->numero, 0, 2); ?>
					@if($sf == "SF")
					<div id="stamp"  style = "border : 5px solid red; margin-left : 20mm; width : 25%; font-weight : bold; color : red; font-size : 5mm;">
					302.145.012
					</div>
					@else
					<div id="stamp"  style = "border : 5px solid red; margin-left : 20mm; width : 25%; font-weight : bold; color : red; font-size : 5mm;">
					302.145.010
					</div>
					@endif
				@endif

		<br><br><br>

	</div>
    <div style="width: 30%; margin-left: 5%; float: left;">
        <br><br>
        <table id="things" dir="ltr">
            <tr>
                <td colspan="2" style="background-color : lightgray;
                    text-align : center">
                Dépenses imputables au budget de l'Etat
                </td>
            </tr>
            <tr>
                <td style="width: 30%;"> Comptable Assignataire</td>
                <td style="width: 70%;">
					<span>     Monsieur le Trésorier de la wilaya de {{$ville_fr}} 
						<br>  RIB {{$compte_tresor}}    
					</span>
				</td>
            </tr>
            <tr>
                <td style="width: 30%;"> Date</td>
                <td style="width: 70%;"></td>
            </tr>
            <tr >
                <td style="border : none;"><br></td>
                <td style="border : none;"></td>
            </tr>

            <tr>
                <td style="width: 30%;"> Objet de paiement</td>
                <td style="width: 70%;">{{$txt }}</td>
            </tr>
            <tr>
                <td style="width: 30%;"> N° de visa CB</td>
                <td style="width: 70%;">N°  {{ $pay->num_visa }}  DU <b dir="ltr">{{ $pay->date_visa }}</b>  </td>
            </tr>

        </table>
        <br>
    </div>
    <div style="width: 50%; margin-left: 10%; float: left;">
        <br>
        <table id="things" dir="ltr">
            <tr>
                <td colspan="3" style="text-align : center">
                Classification par Activité
                </td>
                <td colspan="3" style="text-align : center">
                Classification par titre
                </td>
            </tr>
            <tr>
                <td style="width : 18%"> Portefeuille</td>
                <td style="width : 10%">{{$op->portefeuille}}</td>
                <td style="width : 22%">{{$op->ministere_fr}}</td>
                <td style="width : 18%">Titre</td>
                <td style="width : 10%">03</td>
                <td style="width : 22%">Dépenses d'investissement</td>
                
            </tr>
            <tr>
                <td>Programme</td>
                <td>{{$prog->code}}</td>
                <td>{{$prog->designation_fr}}</td>
                <td rowspan="2">Catégorie</td>
                <td rowspan="2">{{$titre->code}}</td>
                <td rowspan="2">{{$titre->definition_fr}}</td>
            </tr>
            <tr >
                <td> Sous Programme</td>
				
                <td style="width : 22%">{{$sous_prog->code}}</td>
                <td>{{$sous_prog->designation_fr}}</td>
                
    
            </tr>
            <tr>
                <td> Action</td>
				<td>{{$op->activite}}</td>
				@if($op->source =="PSC")
				<td>Programme Sectoriel Centralisé</td>
				@else
				<td> Programme Sectoriel Déconcentrés</td>
				@endif
				
                
				<td rowspan="2"> Sous-catégorie </td>
				<td rowspan="2">{{$sous_titre->code}}</td>
                <td rowspan="2">{{$sous_titre->definition_fr}}</td>

            </tr>
            <tr>
                <td>  Sous Action</td>
                <td>{{$op->sous_action}}</td>
                <td></td>
                
            </tr>

        </table>
        <br>
    </div>
    <br>
    <div style="width: 90%; margin-left: 5%; float: left;">
    <table id="things" dir="ltr" style="text-align: center">
            <tr>
                <td rowspan="2" style="text-align : center; width : 15%;">
                  N° d'opération
                </td>
                <td rowspan="2" style="text-align : center; width : 9%;">
                 Montant total à payer
                </td>
				<td colspan="3" style="text-align : center; width : 20%;">
                 Retenus
                </td>
				<td rowspan="2"  style="text-align : center; width : 9%;">
                    Montant brut
                </td>
				<td colspan="5" style="text-align : center; width : 47%;">
                  Designation du benficiaire
                </td>
            </tr>
            <tr>
                <td> Désignation</td>
                <td> Compte à Débiter</td>
                <td>Montant</td>
                <td style="width : 12%;">Désignation</td>
                <td style="width : 12%;">  N° du compte du bénificiaire</td>
                <td colspan="2" style="width :10%">  Référence de dépenses</td>
				<td style="width : 17.5%">Observation</td>
            </tr>
			<tr>
                <td>{{$op->numero}}</td>
                <td dir="ltr">{{ number_format((float)$brut, 2, '.', ' ')}}</td>
                <td></td>
                <td></td>
				<td dir="ltr">@if($pay->total_cut != 0) {{ number_format((float)$pay->total_cut, 2, '.', ' ')}} @endif</td>
                <td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
				<td>{{$e->name}}</td>
                <td>
					{{$bank->bank_acc}}<br>
					{{$bank->bank}} <br>Agence : {{$bank->bank_agc}}
				</td>
                <td ></td>
				<td></td>
                <td >{{$txt}}</td>
				
            </tr>
			<tr>
                <td>    Montant total brute</td>
                <td dir="ltr">{{ number_format((float)$brut, 2, '.', ' ')}}</td>
                <td colspan="2">  Montant total des retnues</td>
                <td dir="ltr">َ{{ number_format((float)$pay->total_cut, 2, '.', ' ')}}</td>
                <td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
            </tr>
        </table>
		<div align= "center"><br>
		Arreté à la somme de  <br><b id="montant"> {{$text}}  </b>
		<div>
		<br>
		
    </div>

	<div dir="rtl" style="width: 20%; margin-left: 5%; display: inline-block; font-size : 11px;">
		<table id="bottom-left">
			<tr>
				<td></td>
				<td> Montant total à payer</td>
			</tr>
			<tr>
				<td></td>
				<td>  Rejets  </td>
			</tr>
			<tr>
				<td></td>
				<td>   Dépenses admises</td>
			</tr>
			<tr>
				<td></td>
				<td> Retenues</td>
			</tr>
			<tr>
				<td></td>
				<td> Montant total net à payer</td>
			</tr>
		</table>
	</div>
		
	<div style="width: 20%; margin-left: 35%; display: inline-block; float: left; visibility : hidden">
		<div style='text-align : left'>
			<span> Date de Réglement </span><br>
		</div>
		<br><br>
		<div align="left">
			<span> Ordonnateur </span>
			<br>
		</div>
		<div align="right">
			<span> Comptable public assignataire </span>
			<br>
		</div>
	</div><br>
	<div style="width: 90%; display: inline-block; float: left;">
		<div style='text-align : left'>
			<span> Date de Réglement </span><br>
		</div>
		<br><br>
		<div align="left">
			<span> Ordonnateur </span>
			<br>
		</div>
		<div align="right">
			<span> Comptable public assignataire </span>
			<br>
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
  onclick="printdiv('fiche')"> Imprimer </button>
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
  onclick="retour()"> Retour </button>
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
//convert({{ $pay->to_pay }});

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