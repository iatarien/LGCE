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
			overflow-y : hidden !important;
		}
		
	}
	html,body{
	    height:287mm;
	    width:210mm;
	    margin: auto;
	    line-height: 1.6;
	    -webkit-print-color-adjust: exact !important;
	}


</style>

</head>
<body contenteditable="true">

<section  style="background-color: white; text-align: center; font-size: 16px; margin-top : 0px; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div style="display: inline-block; text-decoration : underline; ">
			<h3 style="margin-top : 3px; margin-bottom : 3px; text-decoration: underline; padding: 0px 5px 0px 5px;">République Algéienne Démocratique et Populaire </h3>
		</div>
		<br>
        <?php $deal = $ods->deal_type; 
        $ods_type = $ods->type_ods;
        $e = $ods->name;
		$deal_num = $ods->deal_num;
		$visa = $ods->num_visa;
		$ods_date = $ods->ods_date;
		$visa_date = $ods->date_visa;
		$sujet = $ods->lot; 
		$op = $ods->numero; 
		$intitule = $ods->intitule;
		$num = $ods->ods_num;
		if($num <10){
			$num = "0".$num;
		}
		
		$date = $ods->date;
		$cause = $ods->cause;
		$duree = $ods->duree;
		
		
		?>

		<div style="  display: inline-block; float: left; ">
            <h3 style="text-align : left; margin-top : 3px; margin-bottom : 3px;"> {{$ministere_fr}}<br>
			{{$direction_fr}}  
			<br>  
			da la Wilaya de {{$ville_fr}}
		</div>
		<div style="  display: inline-block; width : 100%; ">
			<h2 style="margin-top : 3px; margin-bottom : 3px; background-color: rgb(210,210,210)  !important;  padding: 0px 5px 0px 5px;">
            Ordre De Service N° {{$num}} <br>  
              {{$ods_type}}   </h2>
		</div>
		<div dir="ltr" style="  display: inline-block; width : 100%;  text-align : justify; ">
			 <h4 style="font-weight : normal; margin-top : 3px; margin-bottom : 3px;"><span style="font-weight : bold">N° d'Opération :</span> {{$op}}<br>
             <span style="font-weight : bold">{{$deal}} N°</span> {{$deal_num}} DU {{DateTime::createFromFormat('Y-m-d',$ods->deal_date)->format('d-m-Y') }}<br>
             <span style="font-weight : bold">VISA CB N°</span> {{$ods->num_visa}} DU {{DateTime::createFromFormat('Y-m-d',$ods->date_visa)->format('d-m-Y') }}<br>
             <span style="font-weight : bold">Intitulé de l'Opération :</span> {{$intitule}}<br>
             <span style="font-weight : bold">Projet :</span> {{$sujet}}<br>
             </h4>
             <hr>
			 <?php 
			 $txt = "";
			 $le_type = $ods->extra_type;
			 $le_type = str_replace("des ","les ",$le_type);
			 $le_type = str_replace("d'","l'",$le_type);
			 if($ods->real_type == "d"){
				$txt = "démarrer ";
			 }elseif($ods->real_type == "a"){
				$txt = "arreter ";
			 }elseif ($ods->real_type =="r") {
				$txt = "reprendre ";
			 }else{
				$txt = "effectuer un ".$ods->type_ods;
				$le_type = "";
			 }
			 
			 $txt = $txt.$le_type;
			 ?>
             <div style="text-align : left">L'entreprise <strong>{{$e}}</strong> est invitée à <strong>{{$txt}}</strong> du {{$deal}} cité en dessous à compter du 
			 <strong>{{DateTime::createFromFormat('Y-m-d',$ods->ods_date)->format('d-m-Y') }}</strong><br>
			 @if($ods->cause != NULL)
			 <strong> Cause : </strong> {{$ods->cause}}
			 @endif
             </div>
             <hr>
             <h3 style="text-align : center">Le responsable de l'action <br><br><br><br><br><h3>
		</div>
	</div>

</section>
<br>

<section style="background-color: white; text-align: center; font-size: 13.5px; margin : 20px; margin-top : 3px; margin-bottom : 3px; " id="fiche">
	<div id="fiche_top">
    <hr>
	
		<div style="  display: inline-block; width : 100%; ">
			<h2 style=" margin-top : 3px; margin-bottom : 3px; background-color: rgb(210,210,210) !important;  
            padding: 0px 5px 0px 5px;">    Notification  </h2s>
		</div>
		<div dir="ltr" style=" font-size: 16px; display: inline-block; width : 100%; font-weight :  normal; text-align : justify; ">
			<p>
				Je soussigné <strong>{{$e}}</strong> certifie avoir reçu une copie du
                 présent ordre de service N° : <strong>{{$num}}</strong>.<br>
                Notifié par le maitre de l'ouverage <strong>{{$direction_fr}} de la Wilaya de 
                    {{$ville_fr}}</strong> dont je remets, 
                revetu de ma signature le present accusé de réception ce jour le : 
                <strong>{{DateTime::createFromFormat('Y-m-d',$ods->ods_date)->format('d-m-Y')}}</srong>.

			</p>
		</div>
        <hr>
        <h3 style="text-align : center">L'Entreprise <br><br><h3>
		
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
  onclick=location.href="../odss"> Retour </button>


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


