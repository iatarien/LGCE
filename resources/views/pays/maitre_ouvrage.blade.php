<!DOCTYPE html>
<html>
<head>
	  <!-- Bootstrap CSS -->
	  <link href="/css/bootstrap.min.css" rel="stylesheet">
	  
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
	    line-height: 0.8;
	    -webkit-print-color-adjust: exact !important;
	}
	
	#numero {
		border-collapse: collapse;
		border: 1px solid;
		table-layout: fixed;
		width : 100%;

	}
	#numero td {

		font-weight: bold;
		border: 1px solid;
		font-size: 15px;
		padding: 7px;
		width : 40%;
	}
	#numero td:firs-child {

		width : 20%;
	}
	#titles {
		float: left;
		font-size: 16px;
		margin-right: 50px;
		border-spacing: 1em;
	}
	#titles td {
		vertical-align: top;
	    direction: ltr;
    	text-align: justify;

	}
	#intitule td {
		font-weight: bold;

	}

	#sujet {
		float: left;
	}
	#sujet span {

		font-size: 16px;

	}
	#engagement {
		border-collapse: collapse;
		border : 1px solid;
		table-layout: fixed;
		width: 100%;
	}
	#engagement th {
		border : 1px solid;
		width: 25%;
		font-size: 13px;
		padding : 5px;
	}
	#engagement td {
		border : 1px solid;
		/* font-weight: 700; */
		padding: 0 3px 0 3px;
		padding : 10px;
        font-size: 13px;
	}

	#CF {
		float: left;
		border-collapse: collapse;
		border : 1px solid;
		table-layout: fixed;
		width : 250px;
	}
	#CF td {
		border : 1px solid;
		font-size: 16px;
		font-weight: bold;
		padding: 0 3px 0 3px;
	}
    .boold {
        font-size: 1.17em; 
        font-weight : bold;
        display : inline;
    }
	h3 span {
		font-weight : lighter;
	}
</style>

</head>
<body id="boody" class="container">

<section style="background-color: white; text-align: center; font-size: 12.5px; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div>
			<h2 >II - PARTIE MAITRE D'OUVRAGE</h2>
            <br>
		</div>
		<div dir="ltr" style="float: left; margin-right: 30px; text-align : left; width : 100%;">
            <h3> N° de l'operation : <span>{{$op->numero}}</span></h3>
            <h3> N° de Marché/Contrat : <span>{{$pay->deal_num}}</span>   
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; 
                Approuvé le : <span>{{$pay->date_visa}}</span>   
            </h3>
            <h3> Montant du Marché/Contrat : <span>{{ number_format((float)$pay->montant, 2, '.', ' ')}} DA</span></h3>
		</div>
		<div dir="ltr" style="float: left; margin-right: 30px; padding-left: 5%; text-align : left; width : 95%; border : 1px solid;">
            <h3> 1- Montant demandé par l'entreprise : <span>{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</span></h3>
            <h3> 2- A Déduire : <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;Pénalité de retard <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;Autre : ...............<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;.............................&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp; .......................<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;................. (A préciser)&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; .......................<br>
            </h3>
			<h3> 3- Montant Net à payer : <span>{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</span></h3>
            <h3>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; &emsp;&emsp;<span>Recu du maitre de l'ouvrage : </span>............................<h3>
            <h3>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; &emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; &emsp;&emsp; 
                Fait à {{$ville_fr}} le :............................<h3>
            <h3><span>Deposée auprès de l'organisme payeur le : </span>............................<h3>
            <h3>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; &emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; &emsp;&emsp; 
                LE MAITRE DE L'OUVRAGE<br><br>
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; &emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; &emsp;&emsp; &emsp;&emsp; 
                <span>(Cachet et Signature)</span><h3>

                <br><br>
		</div>
		<table id="engagement" contenteditable="true" dir="ltr" >
			<tr dir="ltr">	
				<th colspan="4"><br></th>
            </tr>
			<tbody style="text-align :  center; font-weight : bold">
				<td></td>
				<td colspan="2"> III - PARTIE ORGANISME PAYEUR </td>
                <td></td>
			</tbody>
		</table>
		<div dir="ltr" style="float: left; margin-right: 30px; padding-left: 5%; text-align : left; width : 95%; border : 1px solid;">
            <h3><span>Payer à concurrence de : </span>................................................................................................................<h3>
            <h3><span>Parviennent au compte N° : </span>..........................................................................................................<h3>
            <h3><span>Ouvert au nom de l'organisme : </span>.....................................................................................................<h3>
            <h3>..........................................................................................................................................................<h3>
            <h3><span>Auprés de l'organisme bancaire ou CCP : </span>.......................................................................................<h3>
            <h3><span>Recu du maitre de l'ouvrage le : </span>......................................................................................................<h3>
            <h3>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; &emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; &emsp;&emsp; 
                Fait à {{$ville_fr}} le :............................<h3>
            <h3>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; &emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; &emsp;&emsp; 
                ORGANISME PAYEUR<br><br>
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; &emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp; &emsp;&emsp;&emsp;
                <span>(Cachet et Signature)</span><h3>

                <br><br>
		</div>
        <table style="width : 100%" contenteditable="true" dir="ltr" >
            <tr>
				<td style="border : none"></td>
				<td colspan="2" style="border : 1px solid; width : 35%;padding: 7px; font-size : 13px; font-weight : bold;"> PARTIE REJETEE </td>
                <td style="border : none"></td>
            </tr>
		</table>
        <div dir="ltr" style="float: left; margin-right: 30px; text-align : left; width : 100%;">
            <h3> Motif exact du rej <span>..................................................................................................................</span></h3>
            <h3> Auteur du rejet 
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; 
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;
                Date de retaraite du dossier 
            </h3>
            </div>
	</div>

</section>
<br><br><br><br><br><br><br><br><br><br><br><br>
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
  onclick="retour()"> Retour </button>


 <br><br><br><br>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js" integrity="sha512-csNcFYJniKjJxRWRV1R7fvnXrycHP6qDR21mgz1ZP55xY5d+aHLfo9/FcGDQLfn2IfngbAHd8LdfsagcCqgTcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
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

$('input[type=radio]').on('change',function() {

	const url ="/update_pref_eng/with_"+this.value;
	$.ajax({
		url: url,
		type:"GET", 
		cache: false,
		success:function(response) {
			console.log(response);
		},
		error:function(response) {
			console.log(response);
		},

	});
	
});


function printdiv(printdivname) {
	document.getElementById('bouton').style.display = "none";
	document.getElementById('bouton_2').style.display = "none";
	if(document.getElementById('bouton_3')){
		document.getElementById('bouton_3').style.display = "none";
	}



    print();
    document.getElementById('bouton').style.display = "inline-block";
	document.getElementById('bouton_2').style.display = "inline-block";
	if(document.getElementById('bouton_3')){
		document.getElementById('bouton_3').style.display = "inline-block";
	}


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


