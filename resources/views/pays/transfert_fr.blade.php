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
		size: landscape;
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
	    height:210mm;
	    width:287mm;
	    margin: auto;
	    line-height: 1.5;
        font-size : 8px;
	    -webkit-print-color-adjust: exact !important;
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
        text-align : left;
    }

    #stamp {
        width : 30mm;
        float : left;
    }
</style>
</head>
<body contenteditable="true">

<section  style="background-color: white; text-align: center; font-size: 12.5px; margin: 20px;" id="fiche">
	<div id="fiche_top" style="margin-right : 2.5%; margin-left : 2.5%;" >
		<div style="  display: inline-block; ">
            <h3>    République Algérienne Démocratique et Populaire    </h3>
		</div>
		<br>
        <div style="width : 100%; background-color : lightgray" >
            <h3> Avis de Virement </h3>
        </div>
		<div style="width : 100%;" >
			<h4>Dépenses imputables au budget de l'Etat</h4>
        </div>
		
		<div style="  display: inline-block; max-width : 40%; float : right;" dir="ltr">
        <table id="le_table">
                <tr>
                    <th style="width : 34%;">Classification par activité </th>
                    <th style="width : 20%;">Code</th>
                    <th style="width : 46%;">Intitulé</th>
                </tr>
                <tr>
                    <td>Portefeuille</td>
                    <td>{{$op->portefeuille}}</td>
                    <td>{{$op->ministere_fr}}</td>
                </tr>
                <tr>
                    <td>Programme </td>
                    <td>{{$prog->code}}</td>
                    <td>{{$prog->designation_fr}}</td>
                </tr>
                <tr>
					<td> Action</td>
					<td>{{$op->activite}} </td>
					@if($op->source =="PSC")
					<td>َProgramme Sectoriel Centralisé</td>
					@else
					<td>Programme Sectoriel Déconcentrés</td>
					@endif
						
                </tr>
                <tr>
                    <td> Sous Action </td>
					<td>{{$op->sous_action}}</td>
					<td></td>
                </tr>
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
		<div style="  display: inline-block; width : 25%; float: left;">
            <h3 dir="ltr" style="text-align : left;">Code Ordonnateur : {{$ordre}}<br>
			 Budget : {{ $pay->year}} <br>
             N° de mandat :  <br>
             Date de mandat :  <br>
			  Mode de paiement : {{$bank->bank}} agence : {{$bank->bank_agc}}  <br>
			</h3>
            
		</div>
		<div style="  display: inline-block; float: left; margin-top : 2%;
		width : 25%; margin-right : 2%; margin-left : 5%;">
			<table style="text-align : left">
				<tr>
					<td>  Comptable assignataire : <span> Trésorier de la wilaya de {{$ville_fr}} 
						<br>    
					</span></td>
                </tr>
				<tr>
					<td dir="ltr"> RIB : <span dir="ltr"> {{$compte_tresor}} </span> </td>
                </tr>
        	</table>
            <br>
		</div>
        
		<div dir="ltr" style="  display: inline-block; width : 100%; font-weight :  normal; text-align : justify; ">
            <table>
                <tr>
                    <th style="width : 14%;"> Désignation du Bénificiaire  </th>
					<th style="width : 15%;">N° de Compte</th>
					<th style="width : 16%;">Sous Programme  </th>
                    <th style="width : 12%;">Montant</th>
                    <th style="width : 12%;">Retenues</th>
                    <th style="width : 12%;">Montant net à payer</th>
                    <th style="width : 19%;">Observation</th>
                </tr>
                <tr>
                    <td>{{$e->name}}</td>
                    <td>
						{{$bank->bank_acc}} <br>
                        {{$bank->bank}} Agence : {{$bank->bank_agc}}
					</td>
					<td>{{$prog->code}}.{{$sous_prog->code}}<br>{{$sous_prog->designation_fr}}</td>
                    <td dir="ltr">{{ number_format((float)$pay->total_done, 2, '.', ' ')}} </td>
                    <td dir="ltr">{{ number_format((float)$pay->total_cut, 2, '.', ' ')}}</td>
                    <td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}} </td>
                    <td>{{$txt}}</td>
                </tr>
            </table>
	    </div>
        <br><br>
        
</section>
<br>


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
  onclick="retour()">Retour </button>

 <br><br><br><br>
</div>
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
	document.getElementById('bouton_2').style.display = "none";

   /* var footstr = "</body>";
    var newstr = document.getElementById(printdivname).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = ""+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;*/
    print();
    document.getElementById('bouton').style.display = "inline-block";
	document.getElementById('bouton_2').style.display = "inline-block";

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


