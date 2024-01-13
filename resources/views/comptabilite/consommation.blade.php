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
			height:200mm;
	    	width:297mm;
			overflow-y : hidden !important; 
		}
		
	}
	#top_right h3 {
		margin : 2mm;
		padding : 0;
	}
	html,body{
	    height:200mm;
	    width:297mm;
	    margin: auto;
        font-size : 4mm;
	    line-height: 1.6;
        font-family: "Arial", sans-serif;
	    -webkit-print-color-adjust: exact !important;
	}
    .last {
        font-weight : bold;

    } 
	.last span {
		margin : 0;
		padding : 0;
	}
	#numero {
		border-collapse: collapse;
		border: 1px solid;
		table-layout: fixed;
		width : 50%;

	}

	#titles {
		float: right;


		padding : 1em;
        width : 100%;
	}
	#titles div {
		vertical-align: top;
	    direction: rtl;
    	text-align: justify;
        max-width:85%;

        padding : 1px;

	}

    table{
    	width:100%;
		margin-right: 5%;
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
    
</style>

</head>
<body>
<section style="background-color: white; text-align: center;  margin: 20px;" id="fiche">
	<div id="fiche_top">
		<br>
        <div style="width : 100%; text-align : center; font-size : 4mm; font-weight : bold;">
            REPUBLIQUE ALGERIENNE DEOMCRATIQUE ET POPULAIRE<br>
            MINISTERE DE L'HABITAT ET L'URBANISME DE LA VILLE<br>
            <div style="text-align : left; text-decoration : underline;">
                DEP/Ouargla <br>
                Programme / PSC <br>
            </div>
        </div>
        <div style="font-size : 5mm; width : 100%; font-weight : bold;" >
            Situation Consommation des CP Arrétée au {{$end}}
        </div> 
        <br>
		<table>
			<tr>
				<th style="width : 20%;">Chapitre</th>
                <th style="width : 20%;">CP notifié {{$year}} </th>
				<th style="width : 20%;">Consommation du {{$start}} au {{$end}}</th>
				<th style="width : 20%;">Solde de CP</th>
				<th style="width : 20%;">OBS</th>
			</tr>
			@foreach($chaps as $chap)
				<tr>

					<td rowspan="{{$chap->n}}">{{$chap->ops[0]->chapitre}}</td>
					<td rowspan="{{$chap->n}}">{{ number_format((float)$chap->ops[0]->montant_cp, 2, '.', ',')}}</td>
					<td rowspan="{{$chap->n}}">{{ number_format((float)$chap->ops[0]->pay_ant, 2, '.', ',')}}</td>
					<?php $solde = $chap->ops[0]->montant_cp - $chap->ops[0]->pay_ant - $chap->ops[0]->depenses ?>
					<td rowspan="{{$chap->n}}">{{ number_format((float)$solde, 2, '.', ',')}}</td>
					<td rowspan="{{$chap->n}}">/</td>

				</tr>
				<?php array_shift($chap->ops);?>
				@foreach($chap->ops as $op)
					<tr>
	

						<?php $solde = $op->montant_cp - $op->pay_ant - $op->depenses ?>
	

					</tr>
				@endforeach
				<tr style="background-color : lightgray">
					<td colspan="1">Sous total chapitre</td>
					<td>{{ number_format((float)$chap->montant_cp, 2, '.', ',')}}</td>
					<td >{{ number_format((float)$chap->pay_ant, 2, '.', ',')}}</td>
					<?php $solde = $chap->montant_cp - $chap->pay_ant - $chap->depenses ?>
					<td >{{ number_format((float)$solde, 2, '.', ',')}}</td>
					<td>/</td>
				</tr>
			@endforeach
            <tr style="background-color : gray">
				<td colspan="1">Total Général</td>
				<td>{{ number_format((float)$tots->montant_cp, 2, '.', ',')}}</td>
				<td >{{ number_format((float)$tots->pay_ant, 2, '.', ',')}}</td>
				<?php $solde = $tots->montant_cp - $tots->pay_ant - $tots->depenses ?>
				<td >{{ number_format((float)$solde, 2, '.', ',')}}</td>
				<td>/</td>
			</tr>
		</table>
        

		<br>

		<div  style="width: 100%; text-align : center; font-weight: bold;">
                DEP
		</div>
	</div>

</section>
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
	  display: inline-block;"
 
  onclick="printdiv('fiche')"> طباعة </button>
  <a id="bouton_2" style="
	  background-color: skyblue; /* Green */
	  border: none;
	  color: black;
	  cursor: pointer;
	  padding: 10px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;"

  href='/psc_stuff';> رجوع </a>
 <br><br><br><br>
</div>
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


</script>
</body>
</html>


