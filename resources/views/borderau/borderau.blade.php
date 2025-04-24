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
		size: portrait;
	    margin: 0;  /* this affects the margin in the printer settings */
	}
	@media print {
		html,body{
			height:297mm;
	    	width:210mm;
		}
        .pagebreak { 
            clear: both;
            break-after:page;
            page-break-before: always; 
            page-break-after: always; 
        } /* page-break-after works, as well */
		
	}

	html,body{
	    height:287mm;
	    width:210mm;
	    margin: auto;
	    line-height: 1.6;
	    -webkit-print-color-adjust: exact !important;
	}
    table{
    	width:100%;
		margin-right: 0%;
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
<?php 
$j = 0;
$debut = 0;
$indice = 5;
$tot = count($engs);
$n = ceil($tot/$indice);
$i = 1;

$cdars = false;
if (str_contains($direction, 'محافظة تنمية الفلاحة')) {
$cdars = true;
}
//echo $direction."\n".$cdars;
?>
</head>
<body contenteditable="true">

<section  style="background-color: white; text-align: center; font-size: 12.5px; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div style="  display: inline-block; text-decoration : underline; ">
			<h3 style="text-decoration: underline; padding: 0px 5px 0px 5px;">    الجمهورية الجزائرية الديمقراطية الشعبية    </h3>
		</div>
		<br>
      
		<div style="  display: inline-block; float: left; max-width : 50%; " dir="rtl">
        <h3>{{$ville}} في : &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</h3>
        <br><br>
        <h3>الى السيد : المراقب الميزانياتي لولاية {{$ville}}</h3>
		</div>
		<div style="  display: inline-block; float: right; ">
            @if(!$cdars)
            <h3 style="text-align : right;"> وزارة    {{$ministere}}  <br>
            @else
            <h3 style="text-align : right;">     {{$ministere}}  <br>
            @endif
            @if(!$cdars)
            مديرية  {{$direction}}<br> لولاية {{$ville}} <br>
            @else
			{{$direction}} ب{{$ville}} <br>
			@endif

            مكتب المحاسبة  
			</h3>
            <h3 style="text-align : right;" >       رقم :   &emsp;&emsp;/{{$year}}  </h3>
            
		</div>
		<div style="  display: inline-block; width : 100%; ">
			<h3 style="background-color: rgb(210,210,210)  !important;  padding: 0px 5px 0px 5px;">    جــــــــــدول إرســـــــــال  </h3>
		</div>
		<div dir="rtl" style="  display: inline-block; width : 100%; font-weight :  normal; text-align : justify; ">
        <table>
                <tr>
                    <th style="width : 5%;">الرقم </th>
                    <th style="width : 30%;"> رقم و تعيين العملية</th>
                    <th style="width : 25%;">موضوع الإلتزام</th>
                    <th style="width : 15%;">المتعامل المتعاقد</th>
                    <th style="width : 15%;">المبلغ</th>
                    <th style="width : 10%;">الملاحظة</th>
                </tr>
        </table>
        <?php while($j < $n && $debut < $tot){
                    // echo ("j = ".$j."<br>");
                    // echo ("debut = ".$debut."<br>");
                    // echo ("fin = ".$fin."<br>");
                    // echo"<tr>";
                    if( $j < 2 && $j > 0 ){
                        $indice = 6;
                        
                    }
                    

                    $engss = array_slice($engs, $debut, $indice);  
                    $j++;
                    $debut += $indice;
                     
                //}
                ?>
            <table dir="rtl" style="border-left : none; border-right : none;">
                <tr style="visibility : collapse; border : white !important;">
                    <th style="width : 5%; border : white !important">الرقم </th>
                    <th style="width : 30%; border : white !important"> رقم و تعيين العملية</th>
                    <th style="width : 25%; border : white !important">موضوع الإلتزام</th>
                    <th style="width : 15%; border : none; border : white !important ">المتعامل المتعاقد</th>
                    <th style="width : 15%; border : none; border : white !important">المبلغ</th>
                    <th style="width : 10%; border : none; border : white !important">الملاحظة</th>
                </tr>
                <?php 
                $m = count($engss);
                $eng = $engss[0]; ?>
                <tr>
                    <td style="">{{$i}}</td>
                    <td style=""><span style="text-decoration : underline" >
                    {{$eng->numero}}</span><br>{{$eng->intitule_ar}}</td>
                    <td style=";">{{$eng->real_sujet}}</td>
                    @if($eng->name =="")
                    <td >/</td>
                    @else
                    <td style="">{{$eng->name}}</td>
                    @endif
                    <td  style=""><span dir="ltr">{{ number_format((float)$eng->montant_eng, 2, '.', ' ')}}</span> دج</td>
                    <td style="" rowspan="{{$m}}">للتأشيرة</td>
                </tr>
                <?php array_shift($engss);?>
                @foreach($engss as $eng)
                <?php $i++; ?>
                <tr>
                    <td style="">{{$i}}</td>
                    <td style=""><span style="text-decoration : underline" >
                    {{$eng->numero}}</span><br>{{$eng->intitule_ar}}</td>
                    <td style="">{{$eng->real_sujet}}</td>
                    @if($eng->name =="")
                    <td style="">/</td>
                    @else
                    <td style="">{{$eng->name}}</td>
                    @endif
                    <td style=""><span dir="ltr">{{ number_format((float)$eng->montant_eng, 2, '.', ' ')}}</span> دج</td>
                </tr>
                @endforeach
                
            </table>
	    </div>
        @if($j <$n && $debut < $tot)
        <div class="pagebreak"></div>
        @endif

            <?php $i++; } ?>
        <br><br><br>
        <div style="text-align : left; font-weight : bold; margin-left : 100px;">
        إمضـــــاء
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
  onclick=location.href="../borderaux"> رجوع </button>


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


