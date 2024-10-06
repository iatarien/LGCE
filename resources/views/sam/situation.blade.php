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
			float : none;
		}
		.pagebreak { 
            clear: both;
            break-after: page;
            break-before: page;
            page-break-before: always; 
            page-break-after: always; 
        } /* page-break-after works, as well */
		
	}
	#top_right h3 {
		margin : 2mm;
		padding : 0;
	}
	html,body{
	    height:200mm;
	    width:297mm;
	    margin: auto;
		float : none;
        font-size : 3mm;
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
            <div style="text-align : left; text-decoration : underline;">
            <?php $ministere_fr = str_replace('é',"e",$ministere_fr); 
            $ministere_fr = str_replace('è',"e",$ministere_fr);
            $direction_fr = str_replace('é',"e",$direction_fr); 
            $direction_fr = str_replace('è',"e",$direction_fr); ?>
            {{strtoupper($ministere_fr)}}<br>
            {{strtoupper($direction_fr)}}<br>
            DE LA WILAYA DE {{strtoupper($ville_fr)}}<br>
            </div>
        </div>
        <div contenteditable="true" style="font-size : 5mm; width : 100%; font-weight : bold;" >
            Situation Financière Arretée le {{$date}}
        </div> 
        <br>
		<?php 
        $j = 0;
		$debut = 0;

		//echo ("indice = ".$indice."<br>");
		$indice = 9;
		$tot = count($ops);
		$n = ceil($tot/$indice);
		$i = 1;	
		// var_dump($chap);
		// echo ("prog = ".$chap->programme."<br>");
		// echo ("j = ".$j."<br>");
		// echo ("n = ".$n."<br>");
		// echo ("m = ".$m."<br>");
		// echo ("debut = ".$debut."<br>");
		// echo ("indice = ".$indice."<br>");
		// echo"<tr>";
		?>
        <?php $r = 0; ?> 
		<?php while($j < $n && $debut < $tot){

                    $opss = array_slice($ops, $debut, $indice);  
                    $j++;
                    $debut += $indice;
                    $n = count($opss);
                    
                //}
                ?>
        @if($j> 1)
        <div style="height : 100px;">&emsp;</div>
        @endif
		<table>

			<tr>
                <th style="width : 2%;">N°</th>
                <th style="width : 25%; ">DESIGNATION DE LA STRUCTURE ET L'ORDONNATEUR DELEGUE </th>
                <th style="width : 10%; ">MONTANT DE AE </th>
                <th style="width : 10%; ">MONTANT DES CP (Notifié {{ $the_year}}) </th>
				<th style="width : 10%; ">MONTANT DES CREDITS ENGAGES</th>
                <th style="width : 10%; ">SOLDE</th>
                <th style="width : 10%; ">TAUX DES ENGAGEMENTS</th>
				<th style="width : 10%; ">CONSOMMATION DES CP ({{$the_year}}) </th>
                <th style="width : 10%; ">TAUX DE CONSOMMATION</th>
			</tr>
				@foreach($opss as $op)
                <?php $r++; ?>
					<tr>
                        <td>{{$r}}</th>
						<td style=" text-align : left;">{{$op->intitule}}<br>{{$op->numero}}</td>
                        <td>{{ number_format((float)$op->AP_act, 2, ',', ' ')}}</td>
						<td>{{ number_format((float)$op->montant_cp, 2, ',', ' ')}}</td>
						<td>{{ number_format((float)$op->depenses, 2, ',', ' ')}}</td>
                        <?php $solde = $op->AP_act - $op->depenses; ?>
                        <td>{{ number_format((float)$solde, 2, ',', ' ')}}</td>
                        <?php 
                        if($op->depenses !=0){
                            $taux = ($op->depenses / $op->AP_act) * 100; 
                        }else{
                            $taux = 0;
                        }
                        ?>
                        <td>{{ number_format((float)$taux, 2, ',', ' ')}}%</td>
						<td>{{ number_format((float)$op->pays, 2, ',', ' ')}}</td>
						<?php if($op->montant_cp !=0){
                            $taux_cons = ($op->pays / $op->montant_cp) * 100; 
                        }else{
                            $taux_cons = 0;
                        } ?>
						<td>{{ number_format((float)$taux_cons, 2, ',', ' ')}} %</td>
						
					</tr>
				@endforeach
				@if($j >= $n or $debut >= $tot)
				<tr style="background-color : lightgray; display : none;">
					<td colspan="2">Total Programme </td>
                    <td>{{ number_format((float)$tots->AP_act, 2, ',', ' ')}}</td>
					<td>{{ number_format((float)$tots->montant_cp, 2, ',', ' ')}}</td>
					<td >{{ number_format((float)$tots->depenses, 2, ',', ' ')}}</td>
					<td >{{ number_format((float)$tots->pays, 2, ',', ' ')}}</td>
					<?php $solde = $tots->montant_cp - $tots->pays ?>
					<td >{{ number_format((float)$solde, 2, ',', ' ')}}</td>
				</tr>
				@endif
		</table>
			@if($j <$n && $debut < $tot)

			<div class="pagebreak"></div>

			@endif
			
			<?php $i++; } ?>


		<br>

		<div  style="width: 30%; float : left; font-weight: bold;">
		<span>L'Ordonnateur</span>
		</div>
        <div  style="width: 40%; float : left; text-align : center; font-weight: bold;">
		
		</div>
        <div  style="width: 30%; float : right; font-weight: bold;">
		<span>Visa  Controlleur Financier</span>
		</div>
	</div>

</section>
<br><br><br><br>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
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
	  padding: 13px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;"

  href='/operations_ar/all';> رجوع </a>
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
jQuery(document).bind(" keydown", function(e){
    if(e.ctrlKey && e.keyCode == 80){
		printdiv('fiche');
		return false;
    }
	
});

</script>
</body>
</html>


