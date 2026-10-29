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
<?php if(isset($op->order_ville) && $op->order_ville !="" && $op->order_ville !=NULL){
$ordre = $op->order_ville;
} ?>
<section  style="background-color: white; text-align: center; font-size: 12.5px; margin: 20px;" id="fiche">
	<div id="fiche_top" style="margin-right : 2.5%; margin-left : 2.5%;" >
		
		<div style="  display: inline-block; width : 30%; float : right; text-align : left" dir="ltr">
		<br>
		<h3 >AVIS DE VIREMENT A UN C/C</h3>
		<h4>d'une dépense imputable à un compte du budget d'état</h4>
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
		<div style="  display: inline-block; width : 35%; float: left;">
            <h3 dir="ltr" style="text-align : left;">
				<br>
				<b style="font-size : 11px">REPUBLIQUE ALGERIENNE DEMOCRATIQUE ET POPULAIRE</b><br>
				ولاية {{$ville}} <br>
				Wilaya de {{$ville_fr}}
			</h3>
            
		</div>
		<div style="  display: inline-block; float: left; margin-top : 2%;
		width : 25%; margin-right : 2%; margin-left : 5%;">
			<table style="text-align : left">
				<tr>
					<td dir="ltr">  Comptable assignataire <br> <span> Trésorier de la wilaya de {{$ville_fr}} 
						<br>    
						 Compte à Debiter <br> <span dir="ltr"> {{$compte_tresor}} </span> </td>
                </tr>
        	</table>
            <br>
		</div>
        
		<div dir="ltr" style="  display: inline-block; width : 100%; font-weight :  normal; text-align : justify; ">
            <table>
                <tr>
                    <th rowspan="2" style="width : 13%;"> 1 <br> Désignation du Bénificiaire  </th>
					<th rowspan="2" style="width : 12%;"> 2 <br> N° du C/C à Crediter</th>
                    <th rowspan="2" style="width : 10%;"> 3 <br> Montant</th>
                    <th rowspan="2" style="width : 5%;"> 4 <br> Ret du Compt</th>
                    <th rowspan="2" style="width : 5%;"> 5 <br> Net à payer</th>
					<th rowspan="2" style="width : 5%;"> 6 <br> N° d'eng</th>
					<th rowspan="1" colspan="5" style="width : 20%;"> 7 <br> IDENTIFICATION</th>
					<th rowspan="1" colspan="2" style="width : 10%;"> 8 <br> N°</th>
                    <th rowspan="2" style="width : 20%;"> 9 <br> Références et Observations</th>
                </tr>
				<tr>
                    <th style="width : 3%;"> A <br> Désignation du Bénificiaire  </th>
					<th style="width : 3%;"> B <br> N° du C/C à Crediter</th>
                    <th style="width : 3%;"> C <br> Montant</th>
                    <th style="width : 3%;"> D <br> Ret du Compt</th>
                    <th style="width : 3%;"> E <br> Net à payer</th>
                    <th style="width : 2.5%;">Mandat</th>
					<th style="width : 2.5%;">Ligne</th>
                </tr>
                <tr>
                    <td>{{$e->name}}</td>
                    <td>
						{{$bank->bank_acc}} <br>
                        {{$bank->bank}} Agence : {{$bank->bank_agc}}
					</td>
                    <td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}} </td>
					<td></td>
					<td></td>
					<td colspan="6">{{$op->numero}} <br> {{$op->old_numero}}</td>	
					<td></td>
					<td></td>				
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


