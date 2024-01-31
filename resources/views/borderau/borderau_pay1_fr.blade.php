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
        size: A4 landscape;
        margin: 0;  /* this affects the margin in the printer settings */
    }
    @media print {
		html,body{
			height:210mm;
	    	width:297mm;
			overflow-y : hidden !important;
		}
		
	}
	html,body{
	    height:210mm;
	    width:287mm;
	    margin: auto;
	    line-height: 1.6;
	    -webkit-print-color-adjust: exact !important;
    }

    #fiche {
        padding-top: 30px;
        font-weight: bold; 
        display: inline-block; 
        width: 100%;
        max-height: 100%;
        overflow: hidden;
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
    #le_table td {
        border-bottom : none;
        border-top : none;
        text-align : left;
    }
    #le_table {
        width : 120mm !important;
    }
    #stamp {
        width : 30mm;
        float : left;
    }
</style>
<script type="text/javascript">
function subject2(deal,deal_num,deal_date,sujet,e,travaux_type,travaux_num){
    var txt = "";
    if(travaux_type != "فاتورة" && travaux_num != null){
    txt +=travaux_type+" "+travaux_num+" ";
    }

    if(travaux_type !="facture" && deal != null){
    txt += " "+deal+" ";
    }
    if(travaux_type !="facture" && deal_num != null){
    txt+= " N° "+deal_num;
    }
    if(travaux_type !="facture" && deal_date != null){
    txt+=" Du "+deal_date+" ";
    }

    if(e != "" && e != null){
    txt +=" De "+" "+e+" ";
    }
    txt +=" pour "+sujet;
    document.getElementById('real_sujet'+id).innerHTML= txt;
}
</script>
</head>
<body contenteditable="true">

<section  style="background-color: white; text-align: center; font-size: 11px; margin: 20px; width : 90%; margin-left : 5%;" id="fiche">
	<div id="fiche_top" style="margin-right : 5%; margin-left : 5%;">
		<div style="  display: inline-block; ">
			<h3>    الجمهورية الجزائرية الديمقراطية الشعبية    </h3>
            <h3>    République Algérienne Démocratique et Populaire    </h3>
		</div>
		<br>
        <div style="width : 100%; background-color : lightgray" >
            <h3>   journal de Mondats </h3>
        </div>
		<div style="  display: inline-block; max-width : 70%; " dir="ltr">
        <table id="le_table">
                <tr>
                    <th style="width : 34%;">  Classification par activité </th>
                    <th style="width : 33%;">Code</th>
                    <th style="width : 33%;">Intitulé</th>
                </tr>
                <tr>
                    <td> Portefeuille </td>
                    <td>{{$op->portefeuille->code}}</td>
                    <td>{{$op->portefeuille->ministere_fr}}</td>
                </tr>
                <tr>
                    <td>Programme </td>
                    <td>{{$op->programme->code}}</td>
                    <td>{{$op->programme->designation_fr}}</td>
                </tr>
                <tr>
                    <td>Action </td>
                    <td>{{$engs[0]->activite}}</td>
                    @if($engs[0]->source =="PSC")
                    <td>Programme Sectoriel Centralisé</td>
                    @else
                    <td> Programme Sectoriel Déconcentré </td>
                    @endif
                </tr>
                <tr>
                    <td> Sous Action </td>
                    <td>/</td>
                    <td>/</td>
                </tr>
        </table>
      <br>  
        <div style="display : none">
                @if($engs[0]->source == "PSC") 
				<div id="stamp"  style = "border : 5px solid red; margin-left : 5mm;  font-weight : bold; color : red; font-size : 5mm; padding : 2px; ">
				302.145.001
				</div>
				@elseif($engs[0]->source == "PSD")
				<div id="stamp"  style = "border : 5px solid red; margin-left : 5mm;  font-weight : bold; color : red; font-size : 5mm; padding : 2px;">
				302.145.002
				</div>
				@elseif($engs[0]->source == "FSDRS")
				<?php $sf = substr($engs[0]->numero, 0, 2); ?>
					@if($sf == "SF")
					<div id="stamp"  style = "border : 5px solid red; margin-left : 5mm;  font-weight : bold; color : red; font-size : 5mm; padding : 2px;">
					302.145.012
					</div>
					@else
					<div id="stamp"  style = "border : 5px solid red; margin-left : 5mm;  font-weight : bold; color : red; font-size : 5mm; padding : 2px;">
					302.145.010
					</div>
					@endif
				@endif
            </div>
        </div>

		<div style="  display: inline-block; width : 28%; float: left; ">
            <h3 dir="ltr" style="text-align : left;"> Code Ordonnateur  : {{$ordre}}<br>
			Gestion  : {{ $year}} <br>
             N° Journal des Mondats :  <br>
              Date Journal des Mondats  :  <br>
             Comptable Assignataire  : Trésorier de la wilaya de {{$ville_fr}}<br>
			</h3>
            
		</div>
        <br><br>
		<div dir="ltr" style="  display: inline-block; width : 100%; font-weight :  normal; text-align : justify; ">
            <table>
                <tr>
                    <th rowspan="2" style="width : 8%;">   N° Séquentiel du Mondat </th>
                    <th rowspan="2" style="width : 12%;"> Sous programme</th>
                    <th colspan="2" style="width : 24%;">  Budget </th>
                    <th rowspan="2" style="width : 16%;">  N° fiche engagement</th>
                    <th colspan="2" style="width : 30%;">Montant</th>
                    <th rowspan="2" style="width : 10%;"> Date Mondat </th>
                </tr>
                <tr>
                    <th style="width : 12%;"> Catégorie</th>
                    <th style="width : 12%;"> Sous Catégorie</th>
                    <th style="width : 12%;"> Mondat </th>
                    <th style="width : 12%;"> catégorie</th>
                </tr>
                <?php $i = 0; ?>
                @foreach($engs as $eng)
                <?php $i++; ?>
                <tr>
                    <td></td>
                    <td>َ{{$eng->sous_programme0->code}} - {{$eng->sous_programme0->designation_fr}}</td>
                    <td>َ{{$eng->titre->code}} - {{$eng->titre->definition_fr}}</td></td>
                    <td>َ{{$eng->sous_titre->code}} - {{$eng->sous_titre->definition_fr}}</td></td>
                    <td>{{$eng->numero_fiche}}</td>
                    <td dir="ltr">{{ number_format((float)$eng->to_pay, 2, '.', ' ')}} </td>
                    <td>َ{{$eng->titre->code}} - {{$eng->titre->definition_fr}}</td></td>
                </tr>
                @endforeach
            </table>
	    </div>
        <br><br>
        <h3 style="text-align : center; font-weight : bold;">
        &emsp;  Ordonnateur &emsp; &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;
        &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;
        &emsp;   Comptable Assignataire  &emsp; &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;
        </h3>
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
  onclick="printdiv('fiche')"> imprimer </button>

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
  onclick=location.href="../borderaux"> Retour </button>


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
   // document.getElementsByTagName('body')[0].style.marginLeft = "25%";


   /* var footstr = "</body>";
    var newstr = document.getElementById(printdivname).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = ""+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;*/
    print();
    document.getElementById('bouton').style.display = "inline-block";
	document.getElementById('bouton_2').style.display = "inline-block";
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


