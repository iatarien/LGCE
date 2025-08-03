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
		<div style="width : 23.5%; float : left; display: inline-block; text-align : left;" >
            <h3> 
				Republique Algerienne <br> Democratique Et Populaire <br>
				{{$direction_fr}} <br>
				Wilaya de {{$ville_fr}}
			</h3>
        </div>
		<div style=" float: left; margin-left : 0.5%; display: inline-block; width : 46%;">
            <span style="font-size : 9mm; font-weight : bold;">AVIS DE VIREMENT</span><br>
			<span style="font-size : 7mm;">ET PAIEMENT D'UNE DEPENSE IMPUTABLE 
			A LA WILAYA DE {{$ville_fr}}
			</span>
		</div>
		<div style="  display: inline-block; max-width : 30%; float : left;" dir="ltr">
        	<table id="le_table" style="width : 100%;">
                <tr>
                    <td>COMPTE <br>A<br>DEBITER</td>
                    <td>
						Le Trésorier de la Wilaya de {{$ville_fr}}<br>
						CCP N° {{$compte_tresor}} <br>
						Alger
					</td>
                </tr>
        	</table>
        </div>
		<br><br><br><br><br><br><br><br><br><br>
        
		<div dir="ltr" style="  display: inline-block; width : 100%; font-weight :  normal; text-align : justify; ">
            <table>
                <tr>
					<th style="width : 2%;"> N° DE LIGNE <br> 1 </th>
                    <th style="width : 14%;">Désignation du Bénificiaire <br> 2  </th>
					<th style="width : 15%;">N° de Compte à Crediter <br>3</th>
                    <th style="width : 12%;">Montant (DA) <br> 4</th>
					<th style="width : 8%;">Oppositions <br> 5</th>
					<th style="width : 8%;">Net à payer <br> 6</th>
					<th style="width : 8%;">Nos des créances <br> 7</th>

                    <th style="width : 19%;">REFERENCES ET OBSERVATIONS<br> 8</th>
				</tr>
                <tr>
					<td></td>
                    <td>{{$bank->bank_user}}</td>
                    <td>
						{{$bank->bank_acc}} <br>
                        <?php //{{$bank->bank}} Agence : {{$bank->bank_agc}} ?>
					</td>
					<td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</td>
                    <td dir="ltr"></td>
                    <td dir="ltr"></td>
                    <td dir="ltr"></td>
                    <td>{{$op->intitule}} <br> N° {{$op->numero}}</td>
                </tr>
            </table>
	    </div>
        <br>
        <h3>Mandat N° &emsp;{{$pay->num_mondat}} &emsp; de {{$pay->date_mondat}}</h3>
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


