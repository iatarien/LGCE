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
	    line-height: 1.4;
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

<section  style="background-color: white; text-align: center;  margin: 20px;" id="fiche">
	<div id="fiche_top">
		<br>
        <div style="width : 100%; text-align : center; font-size : 4mm; font-weight : bold;">
            REPUBLIQUE ALGERIENNE DEOMCRATIQUE ET POPULAIRE<br><br>
            <div style="text-align : left;">
                MINISTERE DES FINANCES <br>
                TRESOREIE DE OUARGLA <br>
            </div>
        </div>
        <div style="font-size : 7mm; width : 100%; font-weight : bold;" >
            N.C.13 DU MOIS DE : {{strtoupper($month)}} {{$year}} 
        </div>
        <br>
        <div style="font-weight : bold;">
            <div style="float : left; text-align : left;" >
            COMPTE N° : 302145001 <br>
            ORDONNATEUR : 225230 <br>
            </div>
            <div style="float : right; border : 1px solid; text-align : center; padding : 10px;" >
            PROGRAMME SECTORIEL CENTRALISE <br>
            PSC / DEP OUARGLA
            </div>
        </div>
        <br><br><br><br>
		<table>
			<tr>
                <th style="width : 40%;">N° d'operation </th>
				<th style="width : 15%;">CP {{$year}}</th>
				<th style="width : 15%;">Depenses Anterieures</th>
				<th style="width : 15%;">Depenses du mois</th>
                <th style="width : 15%;">Total des Depenses</th>
			</tr>
			@foreach($chaps as $chap)
				<?php
					$op = $chap->ops[0];
						$numero = $op->numero;
						$nums = explode("-",$op->numero);
						$chapitre = $op->chapitre;
						if (strlen($nums[0]) < 3){
							$prog = $nums[0].$nums[1];
							$article = $nums[3];
						}else{
							$prog = $nums[0];
							$article = $nums[2];
						}
						$num = $nums[count($nums)-1];; 
					?>
				<tr>
					<td style="widtd : 40%;">{{$numero}}</td>
					<td rowspan="{{$chap->n}}" style="widtd : 15%;">{{ number_format((float)$op->montant_cp, 2, '.', ',')}}</td>
					<td style="widtd : 15%;">{{ number_format((float)$op->pay_ant, 2, '.', ',')}}</td>
					<td style="widtd : 15%;">{{ number_format((float)$op->depenses, 2, '.', ',')}}</td>
					<?php $total = $op->depenses + $op->pay_ant ?>
					<td style="widtd : 15%;">{{ number_format((float)$total, 2, '.', ',')}}</td>
				</tr>
				<?php array_shift($chap->ops);?>
				@foreach($chap->ops as $op)
					<?php
						$numero = $op->numero;
						$nums = explode("-",$op->numero);
						$chapitre = $op->chapitre;
						if (strlen($nums[0]) < 3){
							$prog = $nums[0].$nums[1];
							$article = $nums[3];
						}else{
							$prog = $nums[0];
							$article = $nums[2];
						}
						$num = $nums[count($nums)-1];; 
					?>
				<tr>
					<td style="widtd : 10%;">{{$numero}}</td>
					<td style="widtd : 15%;">{{ number_format((float)$op->pay_ant, 2, '.', ',')}}</td>
					<td style="widtd : 15%;">{{ number_format((float)$op->depenses, 2, '.', ',')}}</td>
					<?php $total = $op->depenses + $op->pay_ant ?>
					<td style="widtd : 15%;">{{ number_format((float)$total, 2, '.', ',')}}</td>
				</tr>
				@endforeach
				<tr style="background-color : lightgray; font-weight : bold;">
					<td colspan="1">Total Chapitre {{$chap->chapitre}} </td>
					<td>{{ number_format((float)$chap->montant_cp, 2, '.', ',')}}</td>
					<td>{{ number_format((float)$chap->pay_ant, 2, '.', ',')}}</td>
					<td >{{ number_format((float)$chap->depenses, 2, '.', ',')}}</td>
					<?php $solde = $chap->pay_ant + $chap->depenses ?>
					<td >{{ number_format((float)$solde, 2, '.', ',')}}</td>
				</tr>
			@endforeach
		</table>
        

		<br><br><br>

		<div  style="width: 30%; float : left; font-weight: bold;">
		<span>Visa DEP</span>
		</div>
        <div  style="width: 40%; float : left; text-align : center; font-weight: bold;">
		
		</div>
        <div  style="width: 30%; float : right; font-weight: bold;">
		<span>Visa  Tresorier</span>
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
  <button id="bouton_2" style="
	  background-color: skyblue; /* Green */
	  border: none;
	  color: black;
	  cursor: pointer;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;"

  onclick="document.location.href='/psc_stuff';"> رجوع </button>
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


