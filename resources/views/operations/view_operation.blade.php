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
	    line-height: 1.4;
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
    	width:100%;
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

</head>
<body>

<section dir="rtl" style="background-color: white; text-align: center;  margin: 20px;" id="fiche">
	<div id="fiche_top">
		<br>

        <div style="font-size : 7mm; width : 100%; font-weight : bold;" >
            {{$op->numero}}<hr>
            {{$op->intitule_ar}}
        </div>
        <br>

        <br><br><br><br>
		<table>
			<tr>
                <th style="width : 40%;">الموضوع</th>
				<th style="width : 15%;">المــقاول</th>
				<th style="width : 15%;">مبلغ الإلتزام</th>
				<th style="width : 15%;">مجموع الدفعات</th>
                <th style="width : 15%;">الباقي</th>
			</tr>
            @foreach($engs as $eng)
			<tr>
                <td style="width : 40%;">{{$eng->lot}}</td>
				<td style="width : 15%;">{{$eng->name}}</td>
				<td style="width : 15%;"> {{ number_format((float)$eng->eng_mont, 2, '.', ' ')}}</td>
				<td style="width : 15%;">{{ number_format((float)$eng->tot_pays, 2, '.', ' ')}}</td>
                <td style="width : 15%;">{{ number_format((float)$eng->diff, 2, '.', ' ')}}</td></td>
			</tr>
            @endforeach
			<tr style="background-color : lightgray">
                <td colspan="2">رخصة البرنامج : {{ number_format((float)$sum_eng, 2, '.', ' ')}}</td>
				<td style="width : 15%;"> {{ number_format((float)$sum_eng, 2, '.', ' ')}}</td>
				<td style="width : 15%;">{{ number_format((float)$sum_pay, 2, '.', ' ')}}</td>
                <td style="width : 15%;">{{ number_format((float)$sum_diff, 2, '.', ' ')}}</td></td>
			</tr>
		</table>
        

		<br><br><br>

		
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

  onclick="document.location.href='/operations_ar/all';"> رجوع </button>
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


