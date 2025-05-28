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
	}
	#numero td:firs-child {

		width : 20%;
	}
	#titles {
		float: right;
		font-size: 16px;
		margin-right: 50px;
		border-spacing: 1em;
	}
	#titles td {
		vertical-align: top;
	    direction: rtl;
    	text-align: justify;

	}
	#intitule td {
		font-weight: bold;

	}
	th {
		background-color : lightgray;

	}
	#sujet {
		float: right;
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
		font-size: 15px;
		padding : 5px;
	}
	#engagement td {
		border : 1px solid;
		font-size: 12px;
		/* font-weight: 700; */
		padding: 0 3px 0 3px;
		padding : 10px;
	}
	#engagement td:last-child {
		text-align : right;
	}
	#CF {
		float: right;
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

<section style="background-color: white; text-align: center; font-size: 14.5px; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div>
			<h3 style="text-decoration : underline">   الجمهورية الجزائرية الديمقراطية الشعبية   </h3>
		</div>
		<div style="float: right; margin-right: 30px; text-align : right; width : 100%;">
			<h3 style="text-decoration : underline">  وزارة    {{$ministere}}  </h3>
            <h3 style="text-decoration : underline">  مديرية {{$direction}} <br> لولاية {{$ville}}</h3>
            <h3>  <b style="text-decoration : underline">رمز الأمر بالصرف :</b>
                <span style="border : 2px solid; padding : 8px; font-weight : bold;">
                 {{$ordre}}</span> </h3>
            <br>
            <div style="display : inline-block" dir="rtl">
                <div class="boold">
                    <span style="text-decoration : underline"> رقم بطاقة الإلتزام :</span>&emsp;&emsp;
                    <?php if(str_contains($eng->numero_fiche,"/")){
						$num_fiche = explode("/",$eng->numero_fiche)[1];
					}else{
						$num_fiche = $eng->numero_fiche;
					}
					 ?>
                    <span style="border : 2px solid; padding : 5px 15px 5px 15px;"> {{ $num_fiche }}</span> 
                </div>
                <div class="boold">
					&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
					<span style="text-decoration : underline">  التـــــاريخ :</span>&emsp;&emsp;
                    <span style="border : 2px solid; padding : 5px 15px 5px 15px;"> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</span> 
                </div>
            </div>
		</div>
		<br><br><br><br><br><br><br><br><br><br>
        <div dir="rtl" style="float: right; margin-right: 30px; text-align : right; width : 100%;">
			<br>
			<h3>  <b style="text-decoration : underline">رمز البرنامج :</b> {{$eng->portefeuille}}.{{$eng->programme}} 
                 &emsp;&emsp;&emsp;الميزانية  &emsp;&emsp;&emsp;&emsp;
                @if($eng->sous_programme != "")
                <b style="text-decoration : underline">رمز البرنامج الفرعي :</b>
					@if(strlen($eng->sous_programme) == 1)
						{{$eng->portefeuille}}.{{$eng->programme}}.0{{$sous->code}}
					@else
						{{$eng->portefeuille}}.{{$eng->programme}}.{{$sous->code}}
					@endif
				@endif
				@if($eng->sous_programme != "")
                &emsp;&emsp;&emsp;دعم الاستثمار 
				@endif
            </h3>
            <?php 
            $acti = $eng->portefeuille.".".$eng->programme;
            if(strlen($eng->sous_programme) == 1){
                $acti = $acti.".0".$sous->code;
            }else{
                $acti = $acti.".".$sous->code;
            } 
            $acti = $acti.".".$eng->activite; ?>
            <h3>  <b style="text-decoration : underline">رمز الــنشاط :</b> {{$acti}}</h3>

		</div>
		<div dir="rtl" style="float: right; margin-right: 30px; text-align : right; width : 100%;">
			<h3> <b style="text-decoration : underline"> رقم العملية :</b>&emsp;
				<span dir="ltr" style=" border : 3px solid; padding : 5px 5px 5px 5px;"> 
				<?php 
				$numero = str_replace(".","",$eng->numero);
				$numeros = str_split($numero); 
				
				?>
				<?php $max = count($numeros); $i = 0;?>
				@foreach ($numeros as $n)
				<?php $i++; ?>
					@if($n !== '-' && $n !== '/' && $n !== '.' && $n !== ',')
						@if($i == $max)
						<span style='font-weight : bold; padding : 2px 2px 2px 2px;'>{{$n}}</span>
						@else
						<span style='font-weight : bold; border-right : 3px solid; padding : 2px 5px 2px 2px;'>{{$n}}</span>
						@endif 
					@endif
				 @endforeach
			</span>
			</h3>
			<h3> <b style="text-decoration : underline"> عنوان العملية :</b> <span>{{$eng->intitule_ar}}<span>   </h3>
		</div>
		<br>

		<br><br><br><br><br><br><br><br><br>
		<table id="engagement" contenteditable="true" >
			<tr>	
				<th>الرصيـــد  المتبقي</th>
				<th> الإلتزام المـــقترح </th>
				<th>الرصيـد الأولي</th>
				<th>مجموع الإلتزامات السابقة</th>
				<th>رخصة الإلتزام المفتوحة/</th>
				<th style="text-align : right; width : 30%">   الصنف / الصنف الفرعي </th>
			</tr>
			<tbody id="with_all" style="display : none">
			@foreach($titres as $titre)
				@if($titre->sums["montant_2"] != 0 || $titre->sums["montant"] != 0 || $titre->sums["montant_1"] != 0)
				<tr style='font-weight : 900;'>	
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td dir="rtl">
						الصنف / 
						{{$titre->code}}
					</td>
				</tr>
				@endif
				@foreach($titre->rebriques as $reb)
				@if($reb->sous_montant != 0 || $reb->sous_montant_2 != 0 || $reb->sous_montant_1 != 0)
				<tr style='font-weight : 900;'>	
					<td>{{ number_format((float)$reb->sous_montant_2, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_montant, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_montant_1, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_cumul, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_AP, 2, '.', ' ')}}</td>
					<td dir="rtl">
						 الصنف الفرعي / 
						{{$reb->code}}
					</td>
				</tr>
				@endif
				@endforeach
			@endforeach
			</tbody>
			<tbody id="with_sous" style="display : none;">
			@foreach($titres1 as $titre)
				<tr style='font-weight : 900;'>	
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td dir="rtl">
						الصنف / 
						{{$titre->code}}
					</td>
				</tr>
				@foreach($titre->rebriques as $reb)
				@if($reb->sous_montant != 0)
				<tr style='font-weight : 900;'>	
					<td>{{ number_format((float)$reb->sous_montant_2, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_montant, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_montant_1, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_cumul, 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$reb->sous_AP, 2, '.', ' ')}}</td>
					<td dir="rtl">
						 الصنف الفرعي / 
						{{$reb->code}}
					</td>
				</tr>
				@endif
				@endforeach
			@endforeach
			</tbody>
			<tbody id="with_none" style="display : none">
			@foreach($titres as $titre)
				<tr style='font-weight : 900;'>	
					<td>{{ number_format((float)$titre->sums["montant_2"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["montant"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["montant_1"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["cumul"], 2, '.', ' ')}}</td>
					<td>{{ number_format((float)$titre->sums["AP"], 2, '.', ' ')}}</td>
					<td dir="rtl">
						الصنف / 
						{{$titre->code}}
					</td>
				</tr>
				@foreach($titre->rebriques as $reb)
				@if($reb->sous_montant != 0 || $reb->sous_montant_1 != 0 || $reb->sous_montant_2 != 0)
				<tr style='font-weight : 900;'>	
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td>/</td>
					<td dir="rtl">
						 الصنف الفرعي / 
						{{$reb->code}}
					</td>
				</tr>
				@endif
				@endforeach
			@endforeach
			</tbody>
		</table>
		<br>
		<div id="show_sous" dir="rtl">
			@if($pref_eng == "with_all")
				<input type="radio" name="genderS" value="all" checked> كل الأصناف
				<input type="radio" name="genderS" value="sous" > الصنف الفرعي
				<input type="radio" name="genderS" value="none" > الصنف 
			@elseif($pref_eng == "with_sous")
				<input type="radio" name="genderS" value="all" > كل الأصناف
				<input type="radio" name="genderS" value="sous" checked> الصنف الفرعي
				<input type="radio" name="genderS" value="none" > الصنف 
			@elseif($pref_eng == "with_none")
				<input type="radio" name="genderS" value="all"> كل الأصناف
				<input type="radio" name="genderS" value="sous" > الصنف الفرعي
				<input type="radio" name="genderS" value="none" checked > الصنف 
			@endif
			
		</div>

		<div dir="rtl" style="float: right; margin-right: 30px; text-align : justify;">
			<h3> <span style="text-decoration : underline; font-weight : bold">موضوع الإلتزام :</span>
			<span> {{$eng->real_sujet}}</span></h3>
		</div>
		<br><br><br>
		@if($eng->montant != 0)
		<h3><span style="text-decoration : underline">أوقف هذا الكشف عند مبلغ :</span>
		<span id="montant"></span>
		<h3>
		<br>
		@endif
		<table id="numero" >
			<tr>
				<td style=" background-color: lightgray !important; "> إطار مخصص لللأمر بالصرف</td>
				<td style=" background-color: lightgray !important; ">       إطار مخصص للمراقب الميزانياتي  </td>
			</tr>
			<tr>
				<td>
					<div style="text-align : right" dir="rtl">
						<div class="boold">
							<span> ختم   :&emsp;&emsp;&emsp;&emsp;</span>
						</div><br><br><br>
						<div class="boold">
							<span>  إمضاء :&emsp;&emsp;&emsp;&emsp;</span>
						</div>
					</div>
				</td>
				<td>
					<div style="text-align : right" dir="rtl">
						<br>
						<div class="boold">
							<span> رقـم  التــأشيرة :&emsp;&emsp;&emsp;&emsp;</span>
							@if($eng->num_visa != NULL && $eng->num_visa != "")
							<span style=" text-align : center; border : 2px solid; padding : 5px 47px 5px 47px;"> {{ $eng->num_visa }}</span> 
							@else
							<span style="border : 2px solid; padding : 5px 125px 5px 15px;"> {{ $eng->num_visa }}</span> 
							@endif
						</div><br><br><br>
						<div class="boold">
							<span> تاريخ التأشيرة :&emsp;&emsp;&emsp;&emsp;</span>
							@if($eng->date_visa != NULL && $eng->date_visa != "")
							<span style="border : 2px solid; padding : 5px 15px 5px 15px;"> {{ $eng->date_visa }}</span> 
							@else
							<span style="border : 2px solid; padding : 5px 125px 5px 15px;"> {{ $eng->date_visa }}</span> 
							@endif
						</div>
						<br><br><br>
						<span dir="rtl" style="text-align : right">إمضاء : &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;   الختم :   </span>
					</div>
					<br>

				</td>
			</tr>
		</table>
	</div>
</section>
<br><br><br><br><br><br><br><br><br>
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
  onclick="printdiv('fiche')"> طباعة </button>
@if($eng->type == "comptable")
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
  onclick="document.location.href='../eng_apro/{{$id}}';"> رجوع </button>
@elseif(strpos($eng->numero, "/") !== false)
<a id="bouton_2" style="
	  background-color: skyblue; /* Green */
	  border: none;
	  color: black;
	  cursor: pointer;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;" 
  href='../engagements/{{str_replace("/","_",$eng->numero)}}'> رجوع </a>
@else
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
  onclick="document.location.href='../engagements/all';"> رجوع </button>
@endif
@if($user->id == $eng->user_id )
<button id="bouton_3" style="
	  background-color: lightgreen; /* Green */
	  border: none;
	  color: black;
	  cursor: pointer;
	  padding: 15px 32px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  font-size: 16px;" 
  onclick="document.location.href='../modifier_engagement/{{$eng->id_eng}}';"> تعديل </button>
@endif
 <br><br><br><br>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js "></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js" integrity="sha512-csNcFYJniKjJxRWRV1R7fvnXrycHP6qDR21mgz1ZP55xY5d+aHLfo9/FcGDQLfn2IfngbAHd8LdfsagcCqgTcQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
<script src="{{ url('js/tagfeet.js') }}" ></script>
<script type="text/javascript">
	
window.onbeforeunload = function () {
    window.close();
};
window.onload = function(){
	convert({{$eng->montant}});
};
document.getElementById('{{$pref_eng}}').style.display = "contents";
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
	if (this.value == 'sous') {
		document.getElementById('with_all').style.display = "none";
		document.getElementById('with_none').style.display = "none";
		document.getElementById('with_sous').style.display = "contents";
		
	}
	else if (this.value == 'none') {
		document.getElementById('with_all').style.display = "none";
		document.getElementById('with_none').style.display = "contents";
		document.getElementById('with_sous').style.display = "none";
	}else{
		document.getElementById('with_all').style.display = "contents";
		document.getElementById('with_none').style.display = "none";
		document.getElementById('with_sous').style.display = "none";
	}
});
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
	if(document.getElementById('bouton_3')){
		document.getElementById('bouton_3').style.display = "none";
	}
	document.getElementById('show_sous').style.display = "none";


    print();
    document.getElementById('bouton').style.display = "inline-block";
	document.getElementById('bouton_2').style.display = "inline-block";
	if(document.getElementById('bouton_3')){
		document.getElementById('bouton_3').style.display = "inline-block";
	}
	document.getElementById('show_sous').style.display = "block";

    return false;
}
function printdiv1(printdivname) {
	// document.getElementById('bouton').style.display = "none";
	// document.getElementById('bouton_2').style.display = "none";
	// if(document.getElementById('bouton_3')){
	// 	document.getElementById('bouton_3').style.display = "none";
	// }
	// var txt = document.documentElement.outerHTML;
	// txt = txt.replace("&","&amp;");
	// txt = txt.replace("<","&lt;");
	// txt = txt.replace(">","&gt;");
	// document.getElementById('boody').innerHTML += txt;
	html2canvas($("#boody")[0]).then((canvas) => {
		alert("done ... ");
		//document.body.appendChild(canvas);
		var imagedata = canvas.toDataURL("images/png");
		const { jsPDF } = window.jspdf;
        var doc = new jsPDF();
		doc.addImage(imagedata,"PNG",0,0);
		doc.save("sample.pdf");
	});
	

    // document.getElementById('bouton').style.display = "inline-block";
	// document.getElementById('bouton_2').style.display = "inline-block";
	// if(document.getElementById('bouton_3')){
	// 	document.getElementById('bouton_3').style.display = "inline-block";
	// }
	
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


