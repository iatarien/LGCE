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
		size: portrait;
	    margin: 0;  /* this affects the margin in the printer settings */
	}
	@media print {
		html,body{
			height:297mm;
	    	width:210mm;
			//overflow-y : hidden !important;
		}
        .pagebreak { 
            clear: both;
            break-after:page;
            page-break-before: always; 
            page-break-after: always; 
        } /* page-break-after works, as well */
		
	}
	html,body{
	    height:287mm;
	    width:210mm;
	    margin: auto;
	    line-height: 1.2;
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


</style>
<?php 
$j = 0;
$debut = 0;
$indice = 5;
$tot = count($engs);
$n = ceil($tot/$indice);
$i = 1;

$cdars = false;
if (str_contains($direction, 'محافظة تنمية الفلاحة')) {
$cdars = true;
}
//echo $direction."\n".$cdars;
?>
</head>
<body contenteditable="true">

<section  style="background-color: white; text-align: center; font-size: 11.5px; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div style="  display: inline-block; text-decoration : underline; ">
			<h3 style="text-decoration: underline; padding: 0px 5px 0px 5px;">  République Algérienne démocratique et populaire   </h3>
		</div>
		<br>
      
		<div style="  display: inline-block; float: right; max-width : 50%; " dir="ltr">
        <h3>{{$ville_fr}} le : &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</h3>
        <br><br>
        <h3> à Monsieur : Le Controleur Budgétaire de la Wilaya de {{$ville_fr}}</h3>
		</div>
		<div style="  display: inline-block; float: left; width : 45%; ">
            <h3 style="text-align : left;">{{$ministere_fr}}  <br>
			  {{$direction_fr}}<br> de la wilaya de  {{$ville_fr}} <br> 
			</h3>
            <h3 style="text-align : left;" >       N° :   &emsp;&emsp;/{{$year}}  </h3>
            
		</div>
		<div style="  display: inline-block; width : 100%; ">
			<h3 style="background-color: rgb(210,210,210)  !important;  padding: 0px 5px 0px 5px;">  Borderau d'envoi </h3>
		</div>
		<div dir="ltr" style="  display: inline-block; width : 100%; font-weight :  normal; text-align : justify; ">

        <?php while($j < $n && $debut < $tot){
                    // echo ("j = ".$j."<br>");
                    // echo ("debut = ".$debut."<br>");
                    // echo ("fin = ".$fin."<br>");
                    // echo"<tr>";
                    if( $j < 2 && $j > 0 ){
                        $indice = 6;
                        
                    }
                    

                    $engss = array_slice($engs, $debut, $indice);  
                    $j++;
                    $debut += $indice;
                     
                //}
                ?>
            <table dir="ltr" style="border-left : none; border-right : none;">
                <tr style="border : white !important;">
                    <th style="width : 5%;">Numéro </th>
                    <th style="width : 32%;">N° et intitulé de l'opération </th>
                    <th style="width : 25%;"> Objet d'engagement</th>
                    <th style="width : 15%;"> Entreprise</th>
                    <th style="width : 15%;">Mondant</th>
                    <th style="width : 8%;">Observation</th>
                </tr>
                <?php 
                $m = count($engss);
                $eng = $engss[0]; ?>
                <tr>
                    <td style="">{{$i}}</td>
                    <td style=""><span style="text-decoration : underline" >
                    {{$eng->numero}}</span><br>{{$eng->intitule}}</td>
                    <td style=";">{{$eng->real_sujet}}</td>
                    @if($eng->name =="")
                    <td >/</td>
                    @else
                    <td style="">{{$eng->name}}</td>
                    @endif
                    <td  style=""><span dir="ltr">{{ number_format((float)$eng->montant_eng, 2, '.', ' ')}}</span> DA</td>
                    <td style="" rowspan="{{$m}}">Pour Visa</td>
                </tr>
                <?php array_shift($engss);?>
                @foreach($engss as $eng)
                <?php $i++; ?>
                <tr>
                    <td style="">{{$i}}</td>
                    <td style=""><span style="text-decoration : underline" >
                    {{$eng->numero}}</span><br>{{$eng->intitule}}</td>
                    <td style="">{{$eng->real_sujet}}</td>
                    @if($eng->name =="")
                    <td style="">/</td>
                    @else
                    <td style="">{{$eng->name}}</td>
                    @endif
                    <td style=""><span dir="ltr">{{ number_format((float)$eng->montant_eng, 2, '.', ' ')}}</span> DA</td>
                </tr>
                @endforeach
                
            </table>
	    </div>
        @if($j <$n && $debut < $tot)
        <div class="pagebreak"></div>
        @endif

            <?php $i++; } ?>
            <br><br><br><br>
        <div style="text-align : right; margin-right : 10%; font-weight : bold; font-size : 11px;">
        <h2>signature</h2>
        </div>
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


