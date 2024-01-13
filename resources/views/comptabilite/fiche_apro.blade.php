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
			overflow-y : hidden !important;
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
        font-size : 4mm;
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
    	width:90%;
		margin-right: 5%;
		border : solid 1px black;
		border-collapse: collapse;
		text-align: center;
    }
    table td{
        white-space: nowrap;  /** added **/
		border : solid 1px black;
    }
	table th{
        white-space: nowrap;  /** added **/
		border : solid 1px black;
		background-color: lightgray !important;
    }
    
</style>

</head>
<body>

<section style="background-color: white; text-align: center;  margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div style=" display: inline-block; width : 100%;">
			<h3 style="padding: 0px 5px 0px 5px;">    الجمهورية الجزائرية الديمقراطية الشعبية      </h3>
		</div>
		<br>
		<div id="top_right" style=" display: inline-block; float: right; margin-right: 2%;text-align : right; width : 30%; background-color : lightgray !important;">
			<h3 > وزارة السكن و العمران و المدينة </h3>
            <h3 >      مديرية التجهيزات العمومية لولاية ورقلة   </h3>
		</div>
        <div dir="rtl" id="titles">
			<div class="intitule">
				
				<span>      الباب : </span>
                <span style="font-weight : bold">   {{ $apro->chapitre}}      </span>
			</div>
            <div class="intitule">
				
				<span>      {{ $juri->deal_type }} رقم : </span>
				@if($juri->deal_date != null)
					<span style="font-weight : bold">      {{ $juri->deal_num }}/{{ date('Y', strtotime($juri->deal_date)) }}   </span>
				@else
					<span style="font-weight : bold">      {{ $juri->deal_num }}   </span>
				@endif
               
			</div>
            <div class="intitule">
				
				<span>       موضوع ال{{$juri->deal_type}} : </span>
                <span style="font-weight : bold;">   {{$juri->sujet}}      </span>
			</div>
            <div class="intitule">
				
				<span>       النتعامل المتعاقد : </span>
                <span style="font-weight : bold">    {{ $e->name }}     </span>
			</div>
            
        <div>
		<br>
        <div style=" display: inline-block; text-align : center; width : 100%;">
			<h2 style=" font-size : 7mm; margin : 0;">   جدول خاص بالاعتمادات المحاسبية     </h2>
		</div>
		<br><br>
		<table>
			<tr>
				<th>مبلغ الاعتماد</th>
				<th>مبلغ ال{{$juri->deal_type}}</th>
				<th>المبلغ المسدد</th>
				<th>المبلغ المقترح للالتزام</th>
				<th>المبلغ المتبقي للتسديد</th>
				<th>مبلغ الاعتماد المتبقي</th>
			</tr>
			<tr dir="ltr">
				<td>{{ number_format((float)$apro->old_cp, 2, '.', ',')}}</td>
				<td>{{ number_format((float)$apro->deal_montant, 2, '.', ',')}}</td>
				<td>{{ number_format((float)$apro->old_pays, 2, '.', ',')}}</td>
				<td>{{ number_format((float)$apro->montant, 2, '.', ',')}}</td>
				<td>{{ number_format((float)$apro->new_pays, 2, '.', ',')}}</td>
				<td>{{ number_format((float)$apro->new_cp, 2, '.', ',')}}</td>
			</tr>
		</table>
        

		<br><br><br>

		<div  style="width: 30%; float : left; font-weight: bold;">
		<span>إمضــــاء</span>
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

  onclick="document.location.href='../eng_apro/{{$compta->id}}';"> رجوع </button>
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


