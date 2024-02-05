@include('pays.nuts')

<!DOCTYPE html>
<html>
<head>
	  <!-- Bootstrap CSS -->
	  <link href="{{ url('css/bootstrap.min.css')}}" rel="stylesheet">
	  <meta name="csrf-token" content="{{ csrf_token() }}" />
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
		font-size : 18px;
	    -webkit-print-color-adjust: exact !important;
	}


</style>

</head>
<body contenteditable="true">

<section  style="background-color: white; text-align: center;  margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div style="  display: inline-block; text-decoration : underline; ">
			<h3 style="text-decoration: underline; padding: 0px 5px 0px 5px;">République Algérienne Démocratique Et Populaire</h3>
		</div>
		<br>

		<div style="  display: inline-block; float: left; max-width : 50%; " dir="rtl">
			<h4 style="">Budget d'Equipement
                <br>
                 N° Opération :    <strong>{{$pay->numero}}</strong> 
                <br>
                 Intitule : <strong> {{$pay->intitule}} </strong>
                <br>   
            </h4>
		</div>
		<div style="  display: inline-block; float: right; ">
            <h3 style="text-align : right;"> {{$ministere_fr}}<br>
			{{$ville_fr}}  
			<br>  
			{{$direction_fr}}
			
			</h3>
            
		</div>
		<div style="  display: inline-block; width : 100%; ">
			<h3 style="font-size : 30px;"> Pénalité de retard  </h3>
		</div>
		<div dir="rtl" style="font-size : 18px;  display: inline-block; width : 100%; font-weight :  bold; text-align : center; ">
			 {{$pay->deal_type}} N° {{$pay->deal_num}}.<br> 
             Entreprise : {{$pay->name}}<br>
             Opération : {{$pay->intitule}}<br>
             Lot : {{$pay->lot}}.<br>
             <p align="center">
             Pénalité de retard sur la {{$pay->travaux_type}} N° {{$pay->travaux_num}}
              Arreté le {{$pay->date_pay}}
            </p>
             Durée de réalisation  ................................................................................................................. 
            {{$pay->duree}} jours
            <br>
            <span style="text-decoration : underline;">Date {{$d_odss[0]->type_ods}}  </span> ............................................................................................ 
            {{$d_odss[0]->ods_date}} 
			<br>
			<?php for($i =0; $i<count($a_odss); $i++ ){ ?>
			<br>
            <span style="text-decoration : underline;">Date {{$a_odss[0]->type_ods}}  </span> .............................................................................................. 
            {{$a_odss[0]->ods_date}} 
			<br>
            <span style="text-decoration : underline;">Date {{$r_odss[0]->type_ods}}  </span> ........................................................................................... 
            {{$r_odss[0]->ods_date}} 
			<br>
			<?php } ?>
			<span style="text-decoration : underline;"> Date de fin {{$d_odss[0]->type_ods}}   </span> .............................................................................................. 
            {{$delai}} 
        </div>
		<div dir="rtl" style="font-size : 18px;  display: inline-block; width : 100%; font-weight :  bold; text-align : center; ">
			La pénalité de retard est appliquée sur {{$pay->travaux_type}} N° {{$pay->travaux_num}}
			 Arrete le {{$pay->date_pay}}
			<p align="center">
			Reatrd de  : {{$delai}} à {{$pay->date_pay}} ({{$diff}} jours)
			</p>
		</div>
			<?php $ds = $pay->duree *7;
				$tot = $pay->montant / $ds; $tot = floatval(number_format((float)$tot, 2, '.', ''));
				$ze_tot = $tot * $diff;  ?>
			<div dir="rtl" style="font-size : 18px; display: inline-block; width : 70%; font-weight :  bold; text-align : justify; ">
			&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; Montant de {{$pay->deal_type}} &emsp;&emsp;&emsp;&emsp; {{ number_format((float)$pay->montant, 2, '.', ',')}} <br>
			  Montant de pénalité par jour =_______________=_______________= {{ number_format((float)$tot, 2, '.', ',')}} دج <br>
			&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;{{$pay->duree}}*7 &emsp;&emsp;&emsp;&emsp;&emsp;&emsp; {{$ds}}
			<br>
			</div>
			<br>
			<?php $nissab = $pay->montant * 0.1; ?>
			
			<p align="center" style="font-weight :  bold;">
				<span style="text-decoration : underline;">  Montant total de la pénalité </span>  
				= {{ number_format((float)$tot, 2, '.', ',')}} *{{$diff}} = {{ number_format((float)$ze_tot, 2, '.', ',')}} DA 
				<br>
				@if($nissab < $ze_tot)
				<?php $ze_tot = $nissab; ?>
				<p dir="rtl" style="text-align : center; font-weight : bold;">
					Vu le montant de la pénalite est supérieur à 10% du montnat de 
                    {{$pay->deal_type}} le montant de pénalité est : 
				<br>
			
				{{ number_format((float)$pay->montant, 2, '.', ',')}} * %10  
				= 
				{{ number_format((float)$nissab, 2, '.', ',')}} DA
				</p>

				@endif
                <?php 

                $obj = new nuts($ze_tot, "EUR");
                $text = $obj->convert("fr-FR");
                $text = str_replace("euro","Dinar",$text);
                $text = str_replace(","," et",$text);
                $text = ucfirst($text);
                ?>
			    Le montant total de la pénalité est arreté à  :
				<span style="font-weight : bold" id="montant">{{$text}}</span>
			</p>

			<div style="  display: inline-block; float: left; max-width : 20%; " dir="rtl">
			<br><br><br>
			<h3 style="font-size : 6mm;">
			 Le Directeur				
			</h3>
		</div>
			
			
		</div>
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
  onclick=location.href="/attestations/penalite"> Retour </button>


 <br><br><br><br>
</div>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
<script src="{{ url('js/tagfeet.js') }}" ></script>
<script type="text/javascript">
$.ajaxSetup({
headers: {
	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

window.onbeforeunload = function () {
    window.close();
};
const html = document.getElementsByTagName('html')[0].innerHTML;
	const id_pay = "{{$id_pay}}";
	const url = "/insert_pen/";
	$.ajax({
	    url: url,
	    type:"POST", 
	    cache: false,
		data : {"html":html,
			"id_pay":id_pay,
			"X-CSRF-Token" : "@crsf"},
		success:function(response) {
			console.log(response);
		},
		error:function(response) {
			console.log(response);
		},
	});

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
function convert(num){
	num = ""+ num;
	var num1 = num;
	var num2 = null
	if(num.includes('.')){
		num1 = parseInt(num.split(".")[0]);
		num2 = parseInt(num.split(".")[1]);
	}
	if(num2 != null && num.split(".")[1].length == 1 ){
		num2 = num2 *10;
	}
	var txt = nArabicWords(num1);
	txt = txt.replace('ومليون', "و واحد مليون")
	txt+= " "+"دينار جزائري";
	if(num2 != null){
		txt +=" "+"و"+" "+nArabicWords(num2)+" "+"سنتيم";
	}
	document.getElementById('montant').innerHTML = txt;
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


