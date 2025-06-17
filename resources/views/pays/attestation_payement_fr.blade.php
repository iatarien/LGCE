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
		size: A4 portrait;
	    margin: 0;  /* this affects the margin in the printer settings */
	}
	@media print {
		html, body {
			height:100vh; 
			margin: 0 !important; 
			padding: 0 !important;
			overflow: hidden;
		}
	}
	html,body{
	    height:297mm;
	    width:210mm;
	    margin: auto;
	    margin-top: 5mm !important;
	    line-height: 1.3;
	    font-size: 15px;
	    -webkit-print-color-adjust: exact !important;
		page-break-after: auto;
	}
	#fiche {
		margin: 20px;
		margin-right : 60px;
		margin-left : 60px;
		text-align: center;
	}
	#numero {
		border-collapse: collapse;
		border: 1px solid;
		table-layout: fixed;

	}
	#numero td {

		font-weight: bold;
		border: 1px solid;
		font-size: 12px;
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
		table-layout: fixed;
		width: 100%;
		float: right;
	}

	#payement td {
		font-size: 14px;
		font-weight: bold;
		width: 50%;
		padding: 0 1px 0 1px;
	}
	#payement td:nth-child(2) {
		text-align: right;
		width: 25%;
	}
	#payement td:nth-child(1) {
		text-align: right;
		width: 25%;
		border-right: 1px solid;
		border-left: 1px solid ;
	}
	#summary {
		border-collapse: collapse;
		border : 1px solid;
		table-layout: fixed;
		width: 100%;

	}
	#summary th {
		border : 1px solid;
		width: 25%;
	}
	#summary th:first-child {
		border : 1px solid;
		width: 50%;
	}
	#summary td {
		border : 1px solid;
		font-weight: bold;
		padding: 3px 3px 3px 3px;
	}
	#summary-bottom {
		border-collapse: collapse;
		border : 1px solid;
		table-layout: fixed;
		width: 100%;
		text-align: center;

	}
	#summary-bottom th {
		border : 1px solid;
		width: 50%;
	}
	#summary-bottom td {
		border : 1px solid;
		border-top: none;
		border-bottom: none;
		font-weight: bold;
		padding: 3px 3px 3px 3px;
	}
    #le_table {
        width: 100%;
        margin-right: 0%;
        border: solid 1px black;
        border-collapse: collapse;
        text-align: center;
    }
	#le_table1 {
        width: 100%;
        margin-right: 0%;
        border: solid 1px black;
        border-collapse: collapse;
        text-align: center;
    }
    #le_table1 td:first-child {
        border-bottom : none;
        border-top : none;
        text-align : left;
		border-left :none;
    }
	#le_table1 td {
        border-bottom : none;
        border-top : none;
		border-left : 1px solid;
        text-align : center;

    }
	.boghders td {
		border-top : 1px solid !important;
		border-bottom : 1px solid !important;
	}
</style>

</head>
<?php
$deal_type = $pay->deal_type;
if($deal_type =="صفقة"){
	$deal_type = "{{$deal_type}}";
}else if($deal_type =="عقد"){
	$deal_type = "Convention";
}else if($deal_type =="فاتورة"){
	$deal_type = "Facture";
}
$le ="la";
$du ="de la";
if($deal_type =="Marché"){
	$le = "le";
	$du = "du";
}

?>
<body contenteditable ="true">

<section id="fiche">
<div style="  display: inline-block; ">
            <h3>    République Algérienne Démocratique et Populaire    </h3>
		</div>
    <div style="  display: inline-block; width : 100%; float : left;" dir="ltr">
        <table id="le_table" style="width : 70%; margin-bottom : 2%;">
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
    </div>

	<div> 
		<span style="font-size: 1.5em; text-decoration: underline; font-weight: bold;">    CERTIFICAT POUR PAIEMENT</span>
		<br>
	</div>
	<br>
	<div style="text-align: center; width: 100%; display: inline-block;">
		<div style="display: inline-block; float: left; text-align: left; width : 50%;">
            <br>
			<b> OPERATION N ° : {{$op->numero}} </b>
			<br>
            <b> VISA CF N ° : {{$pay->num_visa}} DU {{$pay->date_visa}} </b>
			<br>
            <b> FICHE ENG N ° : {{$pay->numero_fiche}} </b>
			<br><br>
            <b> ENTREPRENEUR : {{$e->name}} </b>
			<br>
		</div>
        <div style="display: inline-block; float: left; text-align: left; width : 50%;">
            <b> BUDGET D'EQUIEPEMENT </b>
			<br>
            <b> EXERCICE : {{$pay->year}} </b>
			<br>
            <b> ACTION : {{$direction_fr}} </b>
			<br>
            <b> CHAPITRE : @if(isset($titre->definition_fr)){{$titre->definition_fr}}@endif </b>
			<br>
            <b> ARTICLE : @if(isset($sous_titre->definition_fr)){{$sous_titre->definition_fr}} @endif </b>
			<br>
            <b> SOMME A PAYER : {{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</b>
			<br><br>
            <b> MAndat N° : {{$pay->num_mondat}} </b>
		</div>
        <div style="display: inline-block; float: left; text-align: left; width : 100%;">
            <br>
            <b> COMPTE BANCAIRE N° : {{$bank->bank_acc}} </b>
		</div>


		<br><br><br>
		
		
	</div>
	
	<div style="display: inline-block; width: 100%; border-top : 1px solid; border-right : 1px solid;">

		<div style="width: 44%; display: inline-block; margin-right: 1%; font-size : 12px; float : left;">
			<div style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
				<b>  CERTIFICATS DELIVRES</b>
				<br>
			    <b> sur les fonds de toutes nature des </b>
			</div>
			<table id="summary">
				<tr>
					<th rowspan="2" style="width : 20%">Exercice   </th>
					<th rowspan="2" style="width : 20%">Nature des fonds  </th>
					<th rowspan="2" style="width : 40%">Montant des certificats    </th>
                    <th colspan ="2" style="width : 20%">Montant</th>

				</tr>
                <tr>
					<td>N°</td>
					<td>DU</td>
				</tr>
				<tr>
                    <td>{{$pay->year}}</td>
                    <td></td>
					<td><span>@if($pay->to_pay != 0)  {{ number_format((float)$pay->to_pay, 2, '.', ' ')}} @endif</span></td>
					<td></td>
					<td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr><tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr><tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
				<tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
                <tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr><tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr><tr>
					<td>&emsp;</td>
					<td></td>
					<td></td>
                    <td></td>
                    <td></td>

				</tr>
				
                <tr>
                    <td colspan="2">Total</td>
					<td colspan="3">@if($pay->to_pay != 0)  {{ number_format((float)$pay->to_pay, 2, '.', ' ')}} @endif</td>
				</tr>
                <tr>
                    <td colspan="2">Montant du present</td>
					<td colspan="3">@if($pay->old_payments != 0)  {{ number_format((float)$pay->old_payments, 2, '.', ' ')}} @endif</td>
				</tr>
                <tr>
                    <td colspan="2"></td>
					<td colspan="3">@if($pay->to_pay != 0)  {{ number_format((float)$pay->to_pay, 2, '.', ' ')}} @endif</td>
				</tr>
                <tr>
                    <td colspan="2"></td>
					<td colspan="3">@if($pay->old_payments != 0)  {{ number_format((float)$pay->old_payments, 2, '.', ' ')}} @endif</td>
				</tr>
                <tr>
                    <td colspan="2">Retenues de garantie</td>
					<td colspan="3">@if($pay->assurance_cut != 0)  {{ number_format((float)$pay->assurance_cut, 2, '.', ' ')}} @endif</td>
				</tr>
			</table>
			<table id="summary-bottom">

				

				
			</table>

			<div style="float: left; text-align: left; margin-top: 30px; font-weight : bold;     line-height: 2;  ">
				les pieces du {{$deal_type}} pnt été joint au mandat<br>
                N° {{$pay->num_mondat}}&emsp;&emsp;&emsp;&emsp; DU {{$pay->date_mondat}}<br>
                de {{ number_format((float)$pay->to_pay, 2, '.', ' ')}} <br>
                EX {{$pay->year}}

			</div>
		</div>
		<div style="width: 55%; display: inline-block; line-height : 1.5;
		 float : right; text-align : left; font-size : 13px;">
			<b>Le Directeur soussigne <br>
			Vu {{$le}}
			{{$deal_type}} passé le : {{$pay->deal_date}}
			aprouvé le : {{$pay->date_visa}} <br>
			au profit de l'entrepreneur ci-dessous exécutant des travaux ci-dessous 
			désignés moyennant les prix du borderau, le dit {{$deal_type}} enregistré à 
			{{$ville_fr}} sous le N° {{$pay->deal_num}}<br>
			Le montant {{$du}} {{$deal_type}} est de : 
			{{ number_format((float)$pay->montant, 2, '.', ' ')}} DA 
			</b>
			<hr>
			<b>Vu le décompte provisoire N° &emsp;&emsp;&emsp;&emsp;
				en date du &emsp;&emsp;&emsp;&emsp;<br>
				duquel il resulte que les ouvrages executés et les dépenses faites <br>
				en vertu du marché sus-visé s'éelevent à : 
				{{ number_format((float)$pay->to_pay, 2, '.', ' ')}} DA 
			</b><br>
			<table id="le_table1" style="width : 100%; margin-bottom : 2%; border : none;">

                <tr style="">
                    <td style="width : 40%;">Travaux Terminés</td>
                    <td style="width : 35%; border-top : 1px solid;">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
                    <td style="width : 25%; border-top : 1px solid;"></td>
                </tr>
                <tr>
                    <td>Travaux non terminés </td>
                    <td></td>
                    <td></td>
                </tr>
				<tr>
                    <td>Travaux en règle </td>
                    <td></td>
                    <td></td>
                </tr>
				<tr>
                    <td>Approvisionnement (4/5) </td>
                    <td></td>
                    <td></td>
                </tr>
				<tr>
                    <td>Revision des prix </td>
                    <td></td>
                    <td></td>
                </tr>
				<tr class="boghders">
                    <td>Retenue de garantie </td>
                    <td>{{ number_format((float)$pay->assurance_cut, 2, '.', ' ')}}</td>
                    <td></td>
                </tr>
				<tr class="boghders">
                    <td>Net</td>
                    <td></td>
                    <td></td>
                </tr>
        </table>
		</div>
	</div>
	

</section>
<br><br><br><br>
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

 <br><br>
</div>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
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
hide_stamp();
function hide_stamp(){
	document.getElementById('stamp').style.visibility ="hidden";
	document.getElementById('stamp1').style.visibility ="hidden";
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
jQuery(document).bind(" keydown", function(e){
    if(e.ctrlKey && e.keyCode == 80){
		printdiv('fiche');
		return false;
    }
	
});
</script>
</body>
</html>


