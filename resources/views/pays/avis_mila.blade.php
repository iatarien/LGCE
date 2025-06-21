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
	    line-height: 1.1;
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
	th {
		background-color : lightgray;

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
		font-size: 15px;
		padding : 5px;
	}
	#engagement td {
		border : 1px solid;
		/* font-weight: 700; */
		padding: 0 3px 0 3px;
		padding : 10px;
        font-size: 15px;
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
		font-size: 15px;
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
@include('pays.nuts')
<?php 

$brut = (float)$pay->to_pay + (float)$pay->total_cut;
$txt = " ";
if($pay->travaux_type != "فاتورة" && $pay->travaux_num != null){
    $txt = $txt.$pay->travaux_type." N° ".$pay->travaux_num." DU ".$pay->date_pay;
}
elseif($pay->travaux_type  !="facture" && $pay->deal != null){
    $txt = $txt.$pay->deal_type." ";
}

if($pay->deal_num != null){
    $txt=$txt." ".$pay->deal_type." N° ".$pay->deal_num;
}
if($pay->deal_date != null){
    $txt=$txt." DU ".$pay->deal_date." ";
}


$txt =$txt." Relative à : ".$pay->lot;
?>

<?php 

$brut = (float)$pay->to_pay + (float)$pay->total_cut;
$obj = new nuts($pay->to_pay, "EUR");
$text = $obj->convert("fr-FR");
$text = str_replace("euro","Dinar",$text);
$text = str_replace(","," et",$text);
$text = ucfirst($text);
?>
<section style="background-color: white; text-align: center; font-size: 13.5px; margin: 20px;" id="fiche" contenteditable="true">
	<div id="fiche_top">
		<div>
			<h3 >الجمهورية الجزائرية الديمقراطية الشعبية  </h3>
		</div>
		<div style="float: right;  text-align : right; width : 70%;">
			<h3> وزارة {{$ministere}} </h3>
            <h3> مديرية {{$direction}} لولاية {{$ville}}</h3>
            <h3>   رمز الأمر بالصرف : {{$ordre}} </h3>
            <h3>   رمز النشاط : {{$op->activite}} </h3>
            <br>
		</div>
        <div style="display : inline-block; width : 40%; marign-left : 30%" dir="ltr">
            <div class="boold">
                <h2>إشعار تحويل  </h2>
            </div>
        </div>
		<div align="right">
                <h2 style="text-align : right; margin-right : 30px">
        
                التاريخ :
                &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
				&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
				المكان : {{$ville}}</h2>
		</div>
		<div dir="rtl" style="float: right;  text-align : right; width : 100%;">
			<h3><span>عن طريق مدين حسابنا المفتوح في كتاباتكم المحاسبية تحت رقم : </span></h3>
			<h3>   حساب التعريف البنكي :&emsp;
				<span dir="ltr" style=" border : 3px solid; padding : 5px 5px 5px 5px;"> 
				<?php 

				$numero = str_replace(" ","",$compte_tresor);
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
			<br>
			<h3> تعيين الأمر بالتحويل،  <span>مديرية {{$direction}} لـــولاية <span> {{$ville}}   </h3>
			<h3> عــــنوان العملية  : <span>{{$op->intitule_ar}}<span>   </h3>
            <h3> وضعية التسبيق الجزافي: <span> </span>   </h3>
            <h3>   رقم العملية : <span> {{$op->numero}}</span>   </h3>
            <h3>   رقم الحوالة : <span>{{$pay->num_mondat}} </span> &emsp;&emsp; بتاريخ <span>{{$pay->date_mondat}} </span> </h3>
			<h3><span>نرجو منكم التقييد على حساب دائننا (المستفيد) و المتمثل في : </span></h3>
            <h3> اللقب : <span>{{$e->name}}</span>   </h3>
            <h3> الاسم   : <strong></strong>   </h3>
			<h3> المقر الإجتماعي  : <strong></strong>   </h3>
			<h3> عنوان المستفيد : <strong></strong>   </h3>
			<h3>   حساب التعريف البنكي :&emsp;
				<span dir="ltr" style=" border : 3px solid; padding : 5px 5px 5px 5px;"> 
				<?php 
				$pay0 = $pay;
				$numero = str_replace(" ","",$bank->bank_acc);
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
            <h3>الوكالة البنكية: <strong>{{$bank->bank}}</strong>   </h3>
			<h3> بمبلغ   </h3>
			<h3> بالأرقام  : <span dir="ltr"> {{ number_format((float)$pay->to_pay, 2, '.', ' ')}} </span><span style="color : transparent">i</span>  <span> دج </span>  </h3>
			<h3> بالحروف   : <span id="montant"></span>   </h3>
		</div>
		<br>
		
		<br>
	</div>

</section>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
<script src="{{ url('js/tagfeet.js') }}" ></script>

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

convert({{ $pay->to_pay }});
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


