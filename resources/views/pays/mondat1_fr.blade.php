@include('pays.nuts')
<?php 

$brut = (float)$pay->to_pay + (float)$pay->total_cut;
$txt = " ";
if($pay->travaux_type != "فاتورة" && $pay->travaux_num != null && $pay->travaux_type  !="facture"){
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
			font-size: 14px;
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
	<h4 align="center">
		Mandat de Paiement T2,T3,T4,T5 et T6<br>
		Dépenses imputables au Budget Geenrale de l'Etat
	</h4>
	<div style="float: left; width: 25%; margin-left: 5%;" id="top-right">
		<h3>Code ordonnateur : {{$ordre}} 
		Gestion : {{$pay->year}} <br>
		Numero de fiche d'engagement : {{$pay->numero_fiche}} <br>
		Numero de Mandat : {{$pay->num_mondat }} <br>
		Date de Mandat : {{$pay->date_mondat }} <br>
		Objet de Paiement : {{$txt}} <br>
		Mode de Paiement : {{$bank->bank}} </h3>
	</div>
	<div style="width: 25%; margin-left: 5%; float: left;">
        <br><br>
        <table id="things" dir="ltr">
            <tr>
                <td style="width: 30%;"> Comptable Assignataire</td>
                <td style="width: 70%;">
					<span>     Monsieur le Trésorier de la wilaya de {{$ville_fr}} 
					</span>
				</td>
            </tr>
            <tr>
                <td style="width: 30%;"> RIB/RIP du Tresor</td>
                <td style="width: 70%;">{{$compte_tresor}}   </td>
            </tr>
        </table>
        <br>
    </div>
	<div style="width: 30%; margin-left: 5%; float: left;">
        <br>
        <table id="things" dir="ltr">
            <tr>
                <td colspan="3" style="text-align : center">
                Classification par Activité
                </td>

            </tr>
            <tr>
                <td style="width : 18%"> Portefeuille</td>
                <td style="width : 10%">{{$op->portefeuille}}</td>
                <td style="width : 22%">{{$op->ministere_fr}}</td>
                
            </tr>
            <tr>
                <td>Programme</td>
                <td>{{$prog->code}}</td>
                <td>{{$prog->designation_fr}}</td>
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
				


            </tr>
            <tr>
                <td>  Sous Action</td>
                <td>{{$op->sous_action}}</td>
                <td></td>
                
            </tr>

        </table>
        <br>
    </div>
	<div style="float: left; width: 95%; margin-left: 5%;" id="top-right">

		<h3>Libellé de l'operation : {{$op->intitule}} </h3>
		<h3>Numero de l'operation : {{$op->numero}} </h3>
	</div>
    <div style="width: 90%; margin-left: 5%; float: left;">
    	<table id="things" dir="ltr" style="text-align: center">
            <tr>
                <td rowspan="2" style="text-align : center; width : 15%;">
                  Imputation Budgetaire
                </td>
                <td rowspan="2" style="text-align : center; width : 9%;">
                 Montant But
                </td>
				<td colspan="2" style="text-align : center; width : 20%;">
                 Retenus
                </td>

				<td colspan="3" style="text-align : center; width : 47%;">
                  Designation du benficiaire
                </td>
				<td rowspan="2"  style="text-align : center; width : 9%;">
                    Montant à payer
                </td>
				<td rowspan="2"  style="width : 17.5%">Observation</td>
            </tr>
            <tr>
                <td> Compte à Créditer</td>
                <td>Montant</td>
                <td style="width : 12%;">Bénéficiaire</td>
                <td style="width : 12%;">  N° du compte du bénificiaire</td>
                <td style="width :10%">  Piece de dépenses</td>

            </tr>
			<tr>
                <td>{{$op->numero}}</td>
                <td dir="ltr">{{ number_format((float)$brut, 2, '.', ' ')}}</td>
                <td></td>
				<td dir="ltr">@if($pay->total_cut != 0) {{ number_format((float)$pay->total_cut, 2, '.', ' ')}} @endif</td>
				<td>{{$e->name}}</td>
				<td>
					{{$bank->bank_acc}}<br>
					{{$bank->bank}} <br>Agence : {{$bank->bank_agc}}
				</td>
				<td ></td>
                <td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
                <td >{{$txt}}</td>
				
            </tr>

        </table>
		<div align= "left"><br>
		Arreté à la somme de : <b id="montant"> {{$text}}  </b>
		<div>
    </div>
	<div style="width: 20%; display: inline-block; float: left">
	<br><br><br><span> Ordonnateur </span>
	<br><br><br><br><br><span> Comptable public assignataire </span>
	</div><br>
	<div dir="rtl" style="width: 40%; float : right; display: inline-block; font-size : 11px;">
		<br>
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
		<br>
		<span style="font-size : 14px;"> Date de Réglement </span><br>
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