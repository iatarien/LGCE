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
			/*overflow-y : hidden !important; */
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

<section contenteditable="true" style="background-color: white; text-align: center;  margin: 20px;" id="fiche">
	<div id="fiche_top">
		<br><br>
        <div style="font-weight : bold;">
            <div style="float : left; text-align : left;" >
            Gestionnaire : DEP Ouargla <br>
            Ministère de ratachement : {{strtoupper($op->secteur)}} <br>
            Sous Secteur N ° : {{strtoupper($op->chapitre)}}
            </div>
            <div style="float : right; text-align : left; padding-right : 15%;" >
            Compte Spéciale N° : @if($op->source =="FSDRS") 3 0 7 - 0 3 0  
            @elseif($op->source =="PSC")
            {{$nums[0]." - ".$nums[1]}}
            @else
            2 6 2 - 1 3 0
            @endif
            </div>
        </div>
        <br><br><br><br>
		<table>
			<tr>
				<th style="width : 20%;">Numero et <br>intitulé de l'opération</th>
				<th style="width : 13%;"> AP Année {{ Date('Y') - 1 }} (1)</th>
				<th style="width : 37%"> Lots </th>
				<th style="width : 10%;">Engagements comptables <br>cumulés année {{ Date('Y') - 1 }} (2)</th>
				<th style="width : 10%;">Payements cumulés<br> année {{ Date('Y') - 1 }} (3)</th>
				<th style="width : 10%;">Solde engagement comptable année année {{ Date('Y') - 1 }} <br> (4) = (2 - 3)</th>
			</tr>
           
			<tr dir="ltr">
				<td rowspan="{{$n + 1}}"><strong>{{$op->numero}}</strong> <br>{{$op->intitule_ar }}</td>
                <td rowspan="{{$n}}">{{ number_format((float)$op->AP_act, 2, '.', ',')}}</td>
				@if (isset($engs[0]) and $engs[0] != NULL)
				<td>{{$engs[0]->real_sujet}}</td>
                <td>{{ number_format((float)$engs[0]->somme, 2, '.', ',')}}</td>
                <td>{{ number_format((float)$engs[0]->pays, 2, '.', ',')}}</td>
                <?php $solde = $engs[0]->somme - $engs[0]->pays ?>
                <td>{{ number_format((float)$solde, 2, '.', ',')}}</td>
				@else 
				<td>/</td>
                <td>/</td>
                <td>/</td>
                <td>/</td>
				@endif
                
                    

			</tr>
            <?php array_shift($engs);?>
            @foreach($engs as $eng)
            <tr>
                <td>{{$eng->real_sujet}}</td>
                <td>{{ number_format((float)$eng->somme, 2, '.', ',')}}</td>
                <td>{{ number_format((float)$eng->pays, 2, '.', ',')}}</td>
                <?php $solde = $eng->somme - $eng->pays ?>
                <td>{{ number_format((float)$solde, 2, '.', ',')}}</td>
            </tr>
            @endforeach 
            <tr>
                <th>{{ number_format((float)$op->AP_act, 2, '.', ',')}}</th>
                <th></th>
                <th>{{ number_format((float)$tot_eng, 2, '.', ',')}}</th>
                <th>{{ number_format((float)$tot_pay, 2, '.', ',')}}</th>
				<?php $solde = $tot_eng - $tot_pay ?>
                <th>{{ number_format((float)$solde, 2, '.', ',')}}</th>
            </tr>
            
		</table>
        

		<br><br><br>

		<div  style="width: 30%; float : left; font-weight: bold;">
		<span>Visa du l'ordonnateur</span>
		</div>
        <div  style="width: 40%; float : left; text-align : center; font-weight: bold;">
		<span>Visa du CFW</span>
		</div>
        <div  style="width: 30%; float : right; font-weight: bold;">
		<span>Visa du Tresorier</span>
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

  onclick="window.close()"> رجوع </button>
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


