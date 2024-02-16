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

<section dir="rtl" style="background-color: white; text-align: center; font-size: 14.5px; margin: 20px; margin-top : 50px;" id="fiche">
	<div id="fiche_top">



		<div  style=" margin-right: 30px; text-align : right; width : 100%;">
			<h4>  رقم العملية :&emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp;{{$op->numero}}</h4>
			<h4>  رقم  :&emsp; &emsp;&emsp;&emsp;&emsp;{{$pay->deal_num}}&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;مقبول في : &emsp;&emsp;&emsp;&emsp;{{$pay->date_visa}}</h4>
			<h4>   مبلغ :&emsp; &emsp;&emsp;&emsp;&emsp;<strong dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</strong> دج</h4>
		</div>

        <div style="border : 2px solid; text-align : justify;  padding-right: 30px;">
            <h4>
            1- مبلغ صافي مطلوب من طرف المقاول :&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <strong dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</strong><br>
            2- مطروح :                                                 <br>
            - جزاء التأخير :                                           <br>
            - إضافات :                                                  <br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(محددة)
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            .....................<br>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;<strong style="color : transparent">(محددة)</strong>
            &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            .....................<br><br>
            3- مبلغ صافي للدفع :  &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <strong dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}}</strong><br><br>
            استلمت من طرف مدير الأشغال في :                             <br>
            مستلمة من طرف المؤسسة الدافعة في :                          <br>

            </h4>
			<h4 style="text-align : center">
			نفذ ب : &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;{{$ville}}<br><br>
			صـــاحب المــشــروع ( ختم و توقيع )
			<br><br><br><br>
			</h4>
        </div>

		<h4 style="text-decoration : underline; padding-right : 60px; text-align : right;">.3 - قسم المؤسسة الدافعة</h4>
		<div style="border : 2px solid; text-align : justify;  padding-right: 30px;">
            <h4>
			دفع إلى منافسة : .................................................................................... <br>
			عن طرق تحويلها إلى حساب رقم : .............................................................. <br>
			مفتوح بإسم المؤسسة : ............................................................................ <br>
			إنطلاقا من (مؤسسة بنكية أو ح.ج.ب) : ........................................................ <br>
			<br><br>
			استلمت من طرف صاحب الأشغال في : &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			نفذ ب : &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;في : <br><br>
			&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			ختم و توقيع المؤسسة الدافعة
			<br><br><br><br>
			
			</h4>
        </div>

		<h4 style="text-decoration : underline; padding-right : 60px; text-align : right;">.4 - قسم الإلغاء</h4>
		<div style="border : 2px solid; text-align : justify;  padding-right: 30px; padding-left: 30px;">
            <h4>
			السبب الدقيق للإلغاء  : ..........................................................................................................................
			...............................................................................................................................................................................................
			...............................................................................................................................................................................................
			<br><br>
			صاحب الإلغاء (ختم و توقيع)
			<br>
			&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
			تاريخ سحب الملف
			<br><br><br>
			
			</h4>
        </div>
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



    print();
    document.getElementById('bouton').style.display = "inline-block";
	document.getElementById('bouton_2').style.display = "inline-block";


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


