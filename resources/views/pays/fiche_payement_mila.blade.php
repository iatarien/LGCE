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
		width : 70%;
        margin-left : 15%;

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
		font-size: 14px;
		/* font-weight: 700; */
		padding: 0 3px 0 3px;
		padding : 10px;
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
<?php if(isset($op->order_ville) && $op->order_ville !="" && $op->order_ville !=NULL){
$ordre = $op->order_ville;
} 
$sous = $sous_prog;
// $op->programme = $prog->code;
?>
<section style="background-color: white; text-align: center; font-size: 14.5px; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div>
			<h3 >   الجمهورية الجزائرية الديمقراطية الشعبية   </h3>
		</div>
		<div style="float: right; margin-right: 30px; text-align : right; width : 100%;">
			<h3>  الوزارة :     {{$ministere}}  </h3>
            <h3>  الهيئة الإدارية : مديرية {{$direction}} لولاية {{$ville}}</h3>
            <h3>  رمز الأمر بالصرف : {{$ordre}} </h3>
            <br>
            <div style="display : inline-block" dir="rtl">
                <div class="boold">
                    <span> &emsp;&emsp;  رقم بطاقة الدفع :&emsp;&emsp;</span>
                    <span  style="border : 2px solid; padding : 5px 15px 5px 15px;"> {{ $pay->num }}</span> 
                </div>
                <div class="boold">
                    <span> &emsp; التـــــاريخ :&emsp;&emsp;</span>
                    <span style="border : 2px solid; padding : 5px 15px 5px 15px;"> &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</span> 
                </div>
            </div>
		</div>

		<br><br><br><br><br><br><br><br><br><br>
        <div dir="rtl" style="float: right; margin-right: 30px; text-align : right; width : 100%;">
			<h3>  رمز البرنامج : {{$op->programme}} &emsp;&emsp; {{$prog->designation}}</h3>
			<?php $act_txt = "";
			if($op->source =="PSC"){
				$act_txt = $act_txt. "نشاط ممركز ";
			}else{
				$act_txt = $act_txt. "نشاط غير ممركز ";
			}
			$act_txt = $act_txt." البرنامج الجاري لولاية ميلة";
			?>	
            <h3>  رمز الــنشاط : {{$op->activite}} &emsp;&emsp; {{$act_txt}}</h3>
			@if($op->sous_action !==NULL )
			<?php $sousy = explode(".",$op->sous_action)[0]; ?>
            <h3>  رمز النشاط الفرعي : {{$sousy}}</h3>
			@else
			<h3>  رمز النشاط الفرعي : /</h3>
			@endif

			<h3>  رمز البرنامج الفرعي : {{$sous->code}} &emsp;&emsp; {{$sous->designation}}</h3>

            
		</div>
		<div dir="rtl" style="float: right; text-align : right; width : 100%;">         
			<div dir="rtl" style="width : 100%; text-align : right; margin-right: 30px;">
            <h3>  رقم العملية : <span>{{$op->numero}}<span>   </h3>
			<h3>  عنوان العملية : <span>{{$op->intitule_ar}}<span>   </h3>
			</div>
			<div dir="ltr" style="width : 100%; text-align : center">
			@if($ville_fr =="Mila")
			<h3 dir="ltr" style="width : 100%;"> Intitulé de l'operation : <span>{{$op->intitule}}<span>   </h3>
			@endif
			</div>
            <h3> العنوان 3 : نفقات الإستثمار   </h3>
		</div>
		<br>
        <table id="engagement" contenteditable="true" dir="rtl" >
			<tr>	
                <th colspan="2">الصنف / الصنف الفرعي</th>
                <th>  المدفوعات السابقة</th>
				<th>  الدفع المقترح  </th>
				<th>  مجموع المدفوعات </th>
            </tr>
			<tr style="text-align :  center; font-weight : bold" dir="ltr">
                <td>الصنف  </td>
                <td> {{$titre->code}} <br> {{$titre->definition}} </td>
				<td>{{ number_format((float)$pay0->cumul_old, 2, '.', ' ')}} </td>
				<td> {{ number_format((float)$pay->to_pay, 2, '.', ' ')}}  </td>
                <td>{{ number_format((float)$pay0->cumul_new, 2, '.', ' ')}} </td>
            </tr>
            <tr style="text-align :  center; font-weight : bold" dir="ltr">
                <td>الصنف الفرعي </td>
                <td> {{$sous_titre->code}} <br> {{$sous_titre->definition}}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
		</table>
		<div dir="rtl" style="float: right; margin-right: 30px; text-align : center;">
			<h3> موضوع الدفع : <span>{!! nl2br($sujet) !!}<span></h3>
		</div>
		<br><br><br>
		<table id="numero" >
			<tr>
				<td style=" background-color: lightgray !important; text-align : center;"> إطار مخصص لللأمر بالصرف</td>
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

