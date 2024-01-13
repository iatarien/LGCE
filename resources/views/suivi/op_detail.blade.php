<!DOCTYPE html>
<html>
<head>
	  <!-- Bootstrap CSS -->
	  <link href="{{ url('css/bootstrap.min.css')}}" rel="stylesheet">
	  <!-- bootstrap theme -->
	<title></title>
    <style>

@page {
			size: auto;   /* auto is the initial value */
			size: A4 landscape;
			margin: 0;  /* this affects the margin in the printer settings */
		}
		@media print {
			html,body{
				height:210mm;
				width:297mm;
			}
            .pagebreak { 
                clear: both;
                break-after:page;
                page-break-before: always; 
                page-break-after: always; 
            } /* page-break-after works, as well */
			
		}
		html body {
			width: 297mm;
			height: 210mm;
			margin: auto;
            margin-left : 2%;
            padding-right : 2%;
            
			font-size : 4mm;
            line-height: 1.6;
            font-family: "Arial", sans-serif;
			-webkit-print-color-adjust: exact !important;
		}
table {
	table-layout: fixed;
    border-spacing : 0px;

}
#demo-table {
		width: 100%;
}
table td {
	width: 100px;
    border : 1px solid;
    text-align : center;
    height : 14mm !important;
    overflow : hidden;
}


</style>

</head>
<body>
<?php $i = 1; 
$j = 0;
$debut = 0;
$indice = 5;
//var_dump($conges); ?>
<section  style="background-color: white; text-align: center;  margin: 20px;" id="fiche" dir="rtl">
    
        <?php while($j < $n){
            // echo ("j = ".$j."<br>");
            // echo ("debut = ".$debut."<br>");
            // echo ("fin = ".$fin."<br>");
            // echo"<tr>";
            $engss = array_slice($engs, $debut, $indice);  
            $j++;
            $debut = $j*$indice;
                
        //}
        ?>
    <h1 style="text-decoration : underline" >{{$op->numero}}</h1>
    <h2 >{{$op->intitule_ar}}</h2>
    <table id="demo-table" class="table table-bordered personal-task resizable">
        <tbody id="ops_place">
            <tr style="  font-weight : bolder;">
                <td style="width : 2%;" ><div>#</div></td>
                <td style=" width : 8%;"><div>   صفقة / عقد / فاتورة </div></td>
                <td style=" width : 45%;"><div> المشروع </div></td>
                <td style=" width : 30%;"><div> المقـــاول</div></td>
                <td style=" width : 15%;"><div> القــيمة</div></td>
            </tr>
            <?php $i = 1; ?>
            @foreach($engss as $eng)
            
            <tr style="font-weight : bold">
                <td>
                    <span><h5><strong>{{$i}}</strong></h5></span>
                </td>
                <td>
                    <span><h5><strong>{{$eng->deal_type}} {{$eng->deal_num}}</strong></h5></span>
                </td>
                <td>
                    <span><h5><strong>{{$eng->sujet}}</strong></h5></span>
                </td>
                <td>
                    <span><h5><strong>{{$eng->name}}</strong></h5></span>
                </td>
                <td>
                    <span><h5><strong>{{ number_format((float)$eng->total, 2, '.', ',')}}</strong></h5></span>
                </td>
 
                
                
            </tr>
        <?php $i++; ?>
        @endforeach
        </tbody>
    </table>
    <div class="pagebreak"></div>
                <?php  } ?>
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

  onclick="document.location.href='../sam/{{$op->secteur}}';"> رجوع </button>
 <br><br><br><br>
</div>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
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

jQuery(document).bind(" keydown", function(e){
    if(e.ctrlKey && e.keyCode == 80){
		printdiv('fiche');
		return false;
    }
	
});
</script>
</body>
</html>


