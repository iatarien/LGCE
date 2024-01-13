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
			/*overflow-y : hidden !important; */
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
        font-size : 3mm;
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
    	width:100%;
		margin-right: 5%;
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

<section contenteditable="true" style="background-color: white; text-align: center;  margin: 20px;" id="fiche">
	<div id="fiche_top">
		<br><br>
        <div style="font-weight : bold;">
            <div style="float : left; text-align : left;" >
            Gestionnaire : DEP Ouargla <br>
            Ministère de ratachement : {{strtoupper($op->secteur)}} <br>
            Sous Secteur N ° : {{strtoupper($op->chapitre)}}
            </div>
        </div>
        <br><br><br><br>
		<table>
			<tr>
				<th style="width : 20%;">Numero et <br>intitulé de l'opération</th>
				<th style="width : 13%;"> Fiche</th>
				<th style="width : 10%;">Payements cumulés<br> année {{ Date('Y') - 1 }} (3)</th>
			</tr>
           <script>
               function subject(id,deal,deal_num,deal_date,annexe,sujet,e,travaux_type,travaux_num){
                var txt = "تسوية"+" ";
                if(travaux_type != "فاتورة" && travaux_num != null){
                    txt +=travaux_type+" رقم"+" "+travaux_num+" ";
                }
                if(annexe !="" && annexe != null){
                    txt +="في إطار الملحق " +" "+annexe+" ";
                }
                if(travaux_type !="فاتورة" && deal != null){
                    txt += "ل"+deal+" ";
                }else{
                    txt += deal+" ";
                }
                if(deal_num != null){
                    txt+= " رقم "+deal_num;
                }
                if(deal_date != null){
                    txt+=" بتاريخ "+deal_date+" ";
                }

                if(e != "" && e != null){
                    txt +=" المقدمة من طرف "+" "+e+" ";
                }
                txt +="ل"+sujet;
                console.log("txt");
                document.getElementById(id).innerHTML = txt;
                
                }
               </script>
            <tr>
            <td dir="rtl" rowspan="{{count($pays) +1}}">{{$op->numero}}<br>
            {{$op->intitule_ar}}

            </td>
            </tr>
            @foreach($pays as $eng)
            <tr>
                <td id="ze{{$eng->p_id}}"><script>subject("ze{{$eng->p_id}}","{{$eng->deal_type}}","{{$eng->deal_num}}",null,"{{$eng->annexe}}",
                "{{$eng->sujet}}","{{$eng->name}}","{{$eng->travaux_type}}","{{$eng->travaux_num}}")</script></td>
                <td>{{ number_format((float)$eng->to_pay, 2, '.', ',')}}</td>
            </tr>
            @endforeach 
            <tr>
                <th></th>
                <th></th>
                <th>{{ number_format((float)$tot_pay, 2, '.', ',')}}</th>
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

  onclick="document.location.href='../sam/{{$op->secteur}}'"> رجوع </button>
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


