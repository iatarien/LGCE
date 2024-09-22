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
	    line-height: 1.2;
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
		text-align :center;
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
	th {
		background-color : rgba(240,240,240,1);

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
		width: 20%;
		font-size: 13.5px;
		padding : 5px;
	}
	#engagement td {
		border : 1px solid;
		/* font-weight: 700; */
		padding: 0 1px 0 1px;
		padding : 5px;
        font-size: 13.5px;
	}
	#engagement td:nth-child(2) {
		text-align : right;
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
<body id="boody" class="container" dir="rtl">

<section  style="background-color: white; text-align: center; font-size: 14.5px; margin: 20px; margin-top : 5%;" id="fiche">
	<div id="fiche_top">
        <div style=" width : 25%; display: inline-block; float: right; ">
			<h3 style="margin: 0px 2px 0px 2px;">      مديرية {{ $direction }} <br>لولاية {{ $ville }}   </h3>
		</div>
        <div style="display : inline-block; width : 100%;" dir="ltr">
            <div class="boold">
                <h2 style="text-decoration : underline; margin: 0px 2px 0px 2px;">بــطــاقــة الــدفــع</h2>
            </div>
        </div>	
		
        <div style="width : 100%"><br>	<br></div>
        <table id="numero" style="width : 25%; float : left;">
            <tr>
                <td>رقم البطاقة</td>
                <td> بطاقة الإلتزام</td>

			</tr>
			<tr>
                <td>{{ $pay->num }}</td>
                <td>{{ $pay->numero_fiche }}</td>
			</tr>

		</table>
        <table id="numero" style="width : 15%; float : right;">

		</table>
		<table id="numero" style="width : 50%; float : right; margin-right : 5%;">
			<tr>
				<td style="width: 100%;"> رقم الــــــعمـــلــــــــــــــية</td>
			</tr>
			<tr>
				<td>{{ $op->numero }}</td>
			</tr>
		</table>
		<div dir="rtl" style="float: right; text-align : right; width : 100%;">
			<br>
			<h3> تعيين العملية  : <span>{{$op->intitule_ar}}<span>   </h3>
            <h3> موضوع الدفع : <span>تسوية {{$sujet}} المبريمة مع {{$e->name}}</span>   </h3>
            <h3> تركيب الدفع المقترح  </h3>
		</div>
        <div style="width : 100%">

            <br><br><br><br><br><br><br><br><br><br><br><br>
        </div>

		<table id="engagement" contenteditable="true" dir="rtl" style="margin-top : 10px;">
			<tr>	
                <th style="width : 10%"></th>
                <th style="width : 40%">العناوين</th>
                <th style="width : 23%; border-right : none;">د ج للمبالغ</th>
				<th style="width : 20%"> الملاحظات  </th>
            </tr>
			<?php array_shift($titres); ?>
            @foreach($titres as $t)
            <tr style="text-align :  center; font-weight : bold" dir="ltr">
                <td>{{$t->code}}</td>
                <td>{{$t->definition}}</td>
				@if($t->code == $sous_titre->code)
				<td style="width : 23%;">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}  </td>
				@else
				<td style="width : 23%;"></td>
				@endif
                <td></td>
            </tr>
            @endforeach
			<tr style="text-align :  center; font-weight : bold" dir="ltr">
				<td>{{$titre->code}} </td>
                <td>مجموع {{$titre->definition}}</td>
                <td></td>
                <td></td>

            </tr>
			<tr style="text-align :  center; font-weight : bold" dir="ltr">
				<td></td>
                <td>مبلغ العملية الغير موزعة</td>
                <td></td>
                <td></td>

            </tr>
			<tr style="text-align :  center; font-weight : bold" dir="ltr">
				<td></td>
                <td>المجموع</td>
                <td style="width : 23%;">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}  </td>

                <td></td>
                
            </tr>      
		</table>
	</div>
	<div dir="rtl" style="float: right; text-align : right; width : 100%;">
			<h3> خلاصة </h3>
	</div>
	<table id="numero" style="width : 90%; float : right; text-align : right;" dir="ltr">
		<tr  style=" background-color: rgb(245,245,245) !important; ">
            <td> الملاحظات </td>
			<td> الدفع الخام</td>
			<td> الدفع المزدوج</td>
			<td> المدفوعات السابقة</td>
		</tr>
		<tr >
            <td></td>
			<td>{{ number_format((float)$pay0->cumul_new, 2, '.', ' ')}} </td>
			<td>{{ number_format((float)$pay->to_pay, 2, '.', ' ')}} </td>
			<td>{{ number_format((float)$pay0->cumul_old, 2, '.', ' ')}} </td>

		</tr>
	</table>
    <br><br><br><br><br><br><br><br>
    <table id="numero" style="width : 33%; float : right; text-align : center;">
		<tr>
			<td colspan="1" style="width: 90px; background-color: rgb(245,245,245) !important; ">       
				حوالة رقم : &emsp;&emsp;&emsp;
			</td>
		</tr>
		<tr>
			<td>&emsp;</td>
		</tr>

	</table>
</section>
<br><br><br><br><br><br><br><br><br><br><br><br>
<div align="center" style="display : inline-block; width : 100%;">
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
  onclick="printdiv('fiche')"> طياعة </button>


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
  onclick="retour()"> رجوع </button>


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


