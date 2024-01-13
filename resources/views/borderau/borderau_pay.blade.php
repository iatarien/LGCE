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
			overflow-y : hidden !important;
		}
		
	}
	html,body{
	    height:287mm;
	    width:210mm;
	    margin: auto;
	    line-height: 1.5;
      font-size : 8px;
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

<section  style="background-color: white; text-align: center; font-size: 12.5px; margin: 20px;" id="fiche">
	<div id="fiche_top">
		<div style="  display: inline-block; text-decoration : underline; ">
			<h3 style="text-decoration: underline; padding: 0px 5px 0px 5px;">    الجمهورية الجزائرية الديمقراطية الشعبية    </h3>
		</div>
		<br>
		<div style="  display: inline-block; float: left; max-width : 50%; " dir="rtl">
      <h3>ورقلة في : &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</h3>


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
        <br>
        <h3>الى السيد :  أمين خزينة ورقلة</h3>
        </div>

		<div style="  display: inline-block; float: right; ">
            <h3 style="text-align : right;"> وزارة الســـــكن و العمــــران و المديـــــنة <br>
			مديرية التجهيزات العمومية<br> لولاية ورقلة <br>
      مكتب المحاسبة  
			</h3>
            <h3 style="text-align : right;" >       رقم :   &emsp;&emsp;/{{$year}}  </h3>
            
		</div>
		<div style="  display: inline-block; width : 100%; ">
			<h3 style="background-color: rgb(210,210,210)  !important;  padding: 0px 5px 0px 5px;">   جــــــــــدول إرســـــــــال  </h3>
		</div>
		<div dir="rtl" style="  display: inline-block; width : 100%; font-weight :  normal; text-align : justify; ">
            <table>
                <tr>
                    <th style="width : 8%;">الرقم </th>
                    <th style="width : 23%;">العملية</th>
                    <th style="width : 37%;">موضوع التسديد</th>
                    <th style="width : 14%;">المقاولة</th>
                    <th style="width : 18%;">المبلغ</th>

                </tr>
                <?php $i = 0; ?>
                @foreach($engs as $eng)
                <?php $i++; ?>
                <tr>
                    <td style=" width : 8%;"></td>
                    <td style=" width : 23%;">{{$eng->numero}}</td>
                    <td id="real_sujet{{$i}}" style=" width : 37%;">
                        <script>
                            subject2("{{$eng->deal_type}}","{{$eng->deal_num}}","{{$eng->deal_date}}",
                            ,"{{$eng->lot}}","{{$eng->name}}","{{$eng->travaux_type}}",
                            "{{$eng->travaux_num}}","{{$i}}");
                        </script>
                    </td>
                    <td style=" width : 14%;">{{$eng->name}}</td>
                    <td style=" width : 18%;">{{ number_format((float)$eng->to_pay, 2, '.', ',')}} دج</td>
                </tr>
                @endforeach
                
            </table>
	    </div>
        <br><br><br><br>
        <div style="text-align : left; font-weight : bold;">
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


