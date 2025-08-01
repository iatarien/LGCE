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
        size: A4 portrait;
        margin: 0;  /* this affects the margin in the printer settings */
    }
    @media print {
        html,body{
            width:280mm;
            height:420mm;
            float : none;
            /* overflow-x : hidden !important;
            overflow-y : hidden !important; */
           /* zoom : 180%; */
        }
        .pagebreak { 
            clear: both;
            break-after: page;
            break-before: page;
            page-break-before: always; 
            page-break-after: always; 
        } /* page-break-after works, as well */

        
    }
    
    html body {
        width: 280mm;
        height: 420mm;
        margin: auto;
        float : none;
        font-size: 16px;
        line-height: 1.5em;
        -webkit-print-color-adjust: exact !important;
        /* overflow-x : hidden !important; */
    }
    #fiche {
        padding-top: 30px;
        font-weight: bold; 
        
        float : none;
        /* overflow: hidden; */
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
    #le_table td {
        border-bottom : none;
        border-top : none;
        text-align : right;
    }
    #le_table {
        width : 120mm !important;
    }
    #stamp {
        width : 30mm;
        float : left;
    }
</style>
<script type="text/javascript">
function subject2(deal,deal_num,deal_date,sujet,e,travaux_type,travaux_num,id){
    console.log("deal_type "+ deal);
    console.log("deal_num "+ deal_num );
    console.log("deal_date "+ deal_date);
    console.log("sujet "+ sujet);
    console.log("e "+ e);
    console.log("travaux_type "+ travaux_type);
    console.log("travaux_num "+ travaux_num);
    
    var txt = "تسوية"+" ";
    if(travaux_type != "فاتورة" && travaux_num != null){
      txt +=travaux_type+" رقم"+" "+travaux_num+" ";
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

    document.getElementById('real_sujet'+id).innerHTML= txt;
}
</script>
</head>
<body contenteditable="true">
<?php $j = 0;
$debut = 0;
$indice = 6;
$tot = count($engs);
$n = ceil($tot/$indice);
$i = 1;
?>
<?php 
$cdars = false;
if (str_contains($direction, 'محافظة تنمية الفلاحة')) {
$cdars = true;
}
//echo $direction."\n".$cdars;
?>
<section  style="background-color: white; text-align: center; font-size: 17px; margin: 20px; width : 100%;" id="fiche">
	<div id="fiche_top" style="margin-right : 5%; margin-left : 5%;">
		<div style="  display: inline-block; ">
			<h3>    الجمهورية الجزائرية الديمقراطية الشعبية    </h3>
            <h3>    République Algérienne Démocratique et Populaire    </h3>
		</div>
		<br>
        <div style="width : 100%; background-color : lightgray" >
            <h3> جدول حوالات الدفع </h3>
        </div>
		<div style="  display: inline-block; max-width : 70%; " dir="rtl">
        <table id="le_table">
                <tr>
                    <th style="width : 34%;">التصنيف حسب النشاط </th>
                    <th style="width : 33%;">الرمز</th>
                    <th style="width : 33%;">التسمية</th>
                </tr>
                <tr>
                    <td>محفظة البرنامج </td>
                    <td>{{$op->portefeuille->code}}</td>
                    <td>{{$op->portefeuille->ministere}}</td>
                </tr>
                <tr>
                    <td>البرنامج </td>
                    <td>{{$op->programme->code}}</td>
                    <td>{{$op->programme->designation}}</td>
                </tr>
                <tr>
                    <td>النشاط </td>
                    <td>{{$engs[0]->activite}}</td>
                    @if($engs[0]->source =="PSC")
                    <td>َتفويض التسيير القطاعي الممركز</td>
                    @else
                    <td>َتفويض التسيير الغير ممركز</td>
                    @endif
                </tr>
                <tr>
                    <td>النشاط الفرعي </td>
                    <td>/</td>
                    <td>/</td>
                </tr>
        </table>
      <br>  
        <div style="display : none;">
                @if($engs[0]->source == "PSC") 
				<div id="stamp"  style = "border : 5px solid red; margin-left : 20mm;  font-weight : bold; color : red; font-size : 5mm; padding : 2px; ">
				302.145.001
				</div>
				@elseif($engs[0]->source == "PSD")
				<div id="stamp"  style = "border : 5px solid red; margin-left : 20mm;  font-weight : bold; color : red; font-size : 5mm; padding : 2px;">
				302.145.002
				</div>
				@elseif($engs[0]->source == "FSDRS")
				<?php $sf = substr($engs[0]->numero, 0, 2); ?>
					@if($sf == "SF")
					<div id="stamp"  style = "border : 5px solid red; margin-left : 20mm;  font-weight : bold; color : red; font-size : 5mm; padding : 2px;">
					302.145.012
					</div>
					@else
					<div id="stamp"  style = "border : 5px solid red; margin-left : 20mm;  font-weight : bold; color : red; font-size : 5mm; padding : 2px;">
					302.145.010
					</div>
					@endif
				@endif
            </div>
        </div>

		<div style="  display: inline-block; float: right; ">
            <h3 dir="rtl" style="text-align : right;"> رمز الأمر بالصرف : {{$ordre}}<br>
			سنة التسيير : {{$year}} <br>
             رقم جدول الحوالة :  <br>
             تاريخ جدول الحوالة :  <br>
             المحاسب المختص : السيد أمين الخزينة لولاية {{$ville}} <br>
			</h3>
            
		</div>
        <br><br>
		<div dir="rtl" style="  display: inline-block; width : 100%; font-weight :  normal; text-align : justify; ">
            <table>
                <tr>
                    <th rowspan="2" style="width : 8%;"> الرقم التسلسلي للحوالة </th>
                    <th rowspan="2" style="width : 12%;">البرنامج الفرعي</th>
                    <th colspan="2" style="width : 28%;"> التقييد الميزانياتي</th>
                    <th rowspan="2" style="width : 12%;">رقم بطاقة الالتزام</th>
                    <th colspan="2" style="width : 30%;">المبلغ</th>
                    <th rowspan="2" style="width : 10%;">تاريخ اصدار الحوالة</th>
                </tr>
                <tr>
                    <th style="width : 12%;"> الصنف</th>
                    <th style="width : 16%;">الصنف الفرعي</th>
                    <th style="width : 12%;"> الحوالة </th>
                    <th style="width : 12%;"> الصنف</th>
                </tr>
            </table>
            <?php while($j < $n && $debut < $tot){
                    // echo ("j = ".$j."<br>");
                    // echo ("debut = ".$debut."<br>");
                    // echo ("indice = ".$indice."<br>");
                    // echo"<tr>";
                    if( $j < 2 && $j > 0 ){
                        $indice = 8;
                        
                    }
                    

                    $engss = array_slice($engs, $debut, $indice);  
                    $j++;
                    $debut += $indice;
                     
                //}
                ?>
            <table dir="rtl" style="border-left : none; border-right : none;">
                <tr style="visibility : collapse; border : white !important;">
                    <th rowspan="2" style="width : 8%; border : white !important"> الرقم التسلسلي للحوالة </th>
                    <th rowspan="2" style="width : 12%; border : white !important">البرنامج الفرعي</th>
                    <th colspan="2" style="width : 28%; border : white !important"> التقييد الميزانياتي</th>
                    <th rowspan="2" style="width : 12%; border : white !important">رقم بطاقة الالتزام</th>
                    <th colspan="2" style="width : 30%; border : white !important">المبلغ</th>
                    <th rowspan="2" style="width : 10%; border : white !important">تاريخ اصدار الحوالة</th>
                </tr>
                <tr style="visibility : collapse; border : white !important;">
                    <th style="width : 12%; border : white !important"> الصنف</th>
                    <th style="width : 16%; border : white !important">الصنف الفرعي</th>
                    <th style="width : 12%; border : white !important"> الحوالة </th>
                    <th style="width : 12%; border : white !important"> الصنف</th>
                </tr>
                <?php 
                $m = count($engss);
                $eng = $engss[0]; ?>
                <tr>
                    <td>@if(isset($eng->num_mondat)) {{$eng->num_mondat}} @endif</td>
                    <td>َ{{$eng->sous_programme0->code}} - {{$eng->sous_programme0->designation}}</td>
                    <td>َ{{$eng->titre->code}}</td></td>
                    <td>َ{{$eng->sous_titre->code}}</td></td>
                    <td>{{$eng->numero_fiche}}</td>
                    <td dir="ltr">{{ number_format((float)$eng->to_pay, 2, '.', ' ')}} </td>
                    <td dir="ltr">{{ number_format((float)$eng->to_pay, 2, '.', ' ')}} </td>
                    <td>{{$eng->date_mondat}}</td>
                </tr>

                <?php array_shift($engss);?>
                @foreach($engss as $eng)
                <?php $i++; ?>
                <tr>
                    <td>@if(isset($eng->num_mondat)) {{$eng->num_mondat}} @endif</td>
                    <td>َ{{$eng->sous_programme0->code}} - {{$eng->sous_programme0->designation}}</td>
                    <td>َ{{$eng->titre->code}}</td></td>
                    <td>َ{{$eng->sous_titre->code}}</td></td>
                    <td>{{$eng->numero_fiche}}</td>
                    <td dir="ltr">{{ number_format((float)$eng->to_pay, 2, '.', ' ')}} </td>
                    <td dir="ltr">{{ number_format((float)$eng->to_pay, 2, '.', ' ')}} </td>
                    <td>{{$eng->date_mondat}}</td>
                </tr>
                @endforeach
                
            </table>
	    </div>
        @if($j <$n && $debut < $tot)

        <div class="pagebreak"></div>
        @endif
        <?php $i++; } ?>
        <br><br>
        <h3 style="text-align : right; font-weight : bold;">
        &emsp; الأمر بالصرف &emsp; &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;
        &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;
        &emsp;  المحاسب العمومي المختص &emsp; &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;
        </h3>
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
    //document.getElementsByTagName('body')[0].style.marginLeft = "25%";


   /* var footstr = "</body>";
    var newstr = document.getElementById(printdivname).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = ""+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;*/
    print();
    document.getElementById('bouton').style.display = "inline-block";
	document.getElementById('bouton_2').style.display = "inline-block";
    //document.getElementsByTagName('body')[0].style.marginLeft = "auto";

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


