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
	    line-height: 1;
	    -webkit-print-color-adjust: exact !important;
	}
    table {
	    table-layout: fixed;
        font-size : 10px;
        text-align : center;
    }
    table {
        width: 100%;
    }
    table td{

        border : 1px solid;
        padding : 5px;
        border-top : none;
    }
    table th {

        border : 1px solid;
        padding : 5px;
 
    }




</style>

</head>
<body contenteditable="true">

<section  style="background-color: white; text-align: center; margin : 22px; font-size: 10.5px; " id="fiche">
	<div id="fiche_top">
		<div style="  display: inline-block;">
			<h4 >     الجمهورية الجزائرية الديمقراطية الشعبية <br>
            Republique Algerienne Démocratique et Populaire    </h4>
        </div><br>
        <?php $deal = $ods->deal_type; 
        $ods_type = $ods->type_ods;
        $e = $ods->name;
		$deal_num = $ods->deal_num;
		$visa = $ods->num_visa;
		$ods_date = $ods->ods_date;
		$visa_date = $ods->date_visa;
		$sujet = $ods->lot; 
		$op = $ods->numero; 
		$intitule = $ods->intitule_ar;
		$num = $ods->ods_num;
		if($num <10){
			$num = "0".$num;
		}
		
		$date = $ods->date;
		$cause = $ods->cause;
		$duree = $ods->duree;
		
		
		?>

		<div style="  display: inline-block; float: right; width : 30%; ">
            <h4 style="text-align : right;"> وزارة {{$ministere}}<br>
            مديرية {{$direction}} <br>
			لولاية {{$ville}}  
			<br>  
			</h4>
          
		</div>
		<div style="  display: inline-block; width : 40%; text-align : center; float : right;">
        <br><br><br><br><br>
			<span style="font-size : 6mm; font-weight : bold">   : أمر بالخدمة  </span><br><br>
            <span style="border : 1px solid;font-weight : bold; padding : 5px;">
            &emsp;&emsp;&emsp;&emsp;{{$ods_type}}&emsp;&emsp;&emsp;&emsp; </span><br><br>
		</div>
		<div dir="rtl" style="  display: inline-block; 
        width : 100%; font-weight :  normal; text-align : justify; ">
			<table >
                <tr>
                    <th style="border : none;"></th>
                    <th>تاريخ بداية المشروع
                        <hr>
                        {{$d->ods_date}}
                    </th>
                    <th rowspan="2" style="border : 1px solid;">
                        <table>
                        <tr>
                            <th  style="
                            border : none;">
                            مدة الإنجاز :
                            </th>
                            <th  style="
                            border : none; text-align : right">
                            أيـــام : {{$ods->duree}} <hr>
                                أشهر :
                            </th>
                        </tr>
                        </table>
                       
                    </th>
                    <?php if (DateTime::createFromFormat('Y-m-d', $delai) == false) {
                        $delai = "";
                        }
                        if($arret_days ==0){
                            $arret_days = "";
                        }else{
                            $arret_days = strval($arret_days);
                            if(strlen($arret_days) == 1){
                                $arret_days = "0".$arret_days;
                            }
                        }
                        if($ods->real_type =="a"){
                            $delai = "";
                            $arret_days = "";
                        }
                        ?>
                    <th>التاريخ الإبتدائي للتسليم
                        <hr>
                        {{$first_end}}
                    </th>
                    <th>مدة التوقيف (أيام)
                        <hr>
                        {{$arret_days}}
                    </th>
                    <th>تاريخ إنتهاء الأشغال
                        <hr>
                        {{$delai}}
                    </th>
                </tr>

            </table>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 40%; display : inline-block;">الرقم التسلسلي :</span>
            <span style="width : 50%; display : inline-block;">{{$num}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 30%; display : inline-block;"> رقم العملية :</span>
            <span style="width : 50%; text-align : center; display : inline-block;">{{$op}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 30%; display : inline-block;"> تسمية العملية :</span>
            <span style="width : 50%; text-align : center; display : inline-block;">{{$intitule}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 20%; display : inline-block;"> تسمية المشروع :</span>
            <span style="width : 70%; text-align : center; display : inline-block;">{{$sujet}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;font-size : 4mm; text-align : center">
            <span style="width : 30%; display : inline-block; border : 1px solid;">  أمر بالخدمة :</span>&emsp;&emsp;
            <span style="width : 30%; text-align : center; display : inline-block;border : 1px solid;">{{$ods_type}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 30%; display : inline-block;">  السيد :</span>
            <span style="width : 50%; text-align : center; display : inline-block;">{{$e}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 15%; display : inline-block;">صاحب الصفقة رقم :</span>
            <span style="width : 30%; text-align : center; display : inline-block;">{{$deal_num}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 45%; display : inline-block; text-align : left;">  المؤشر عليها من طرف المراقب المالي بتاريخ   :</span>
            <span style="width : 45%;  display : inline-block;
            text-align : right;">{{$visa_date}}
            &emsp;&emsp;&emsp;&emsp;&emsp;تحت رقم : {{$visa}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 20%; display : inline-block;">    مدعو لــ :</span>
            <span style="width : 20%; display : inline-block;">  {{$ods_type}}</span>
            <span style="width : 35%; display : inline-block;">  المتعلقة بالمشروع المذكور أعلاه بتاريخ :</span>
            <span style="width : 20%; display : inline-block;">{{$ods_date}}</span>
            </div>
            
            @if($cause != NULL and $cause != "")
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 15%; display : inline-block;">  بسبب :</span>
            <span style="width : 30%; text-align : center; display : inline-block;">{{$cause}}</span>
            </div>
			@endif
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 50%; display : inline-block;">  هذا الأمر بالخدمة مطابق للملصق المدون في سجل المديرية الدي سيبلغ للسيد :</span>
            <span style="width : 45%; text-align : center; display : inline-block;">{{$e}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 100%; text-align : center; display : inline-block;">
            من طرف مدير {{$direction}} لولاية {{$ville}}
            </span>
            </div>
            <hr>
		</div>

		<div style="font-size: 11px; font-weight: bold; float: left;margin-left: 20px;" >
			<span>         
                <span style="color : black;">{{$ods_date}}</span>   : {{$ville}} في 
            </span> <br><br>
            <span> المديـــر </span>
		</div>

	</div>

</section>
<br><br><br><br>
<hr style="border-width : 2px; border-style : dashed">
<section style="background-color: white; text-align: center; margin : 22px; font-size: 10.5px;" id="fiche">
	<div id="fiche_top">

        <div style="  display: inline-block; float: right; ">
            <h4 style="text-align : right;"> وزارة {{$ministere}}<br>
            مديرية {{$direction}} <br>
			لولاية {{$ville}}   
			</h4>
        
		</div>

        <div dir="rtl" style="  display: inline-block; 
        width : 100%; font-weight :  normal; text-align : justify; ">
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 40%; display : inline-block;">الرقم التسلسلي :</span>
            <span style="width : 50%; display : inline-block;">{{$num}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 30%; display : inline-block;"> رقم العملية :</span>
            <span style="width : 50%; text-align : center; display : inline-block;">{{$op}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 30%; display : inline-block;"> تسمية العملية :</span>
            <span style="width : 50%; text-align : center; display : inline-block;">{{$intitule}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 20%; display : inline-block;"> تسمية المشروع :</span>
            <span style="width : 70%; text-align : center; display : inline-block;">{{$sujet}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;font-size : 4mm; text-align : center">
            <span style="width : 0%; text-align : center; display : inline-block;">&emsp;</span>
            <span style="width : 40%; display : inline-block; border : 1px solid;">  تبليغ </span>&emsp;&emsp;

            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 30%; display : inline-block;">  أنا الممضي أسفله السيد :  :</span>
            <span style="width : 50%; text-align : center; display : inline-block;">{{$e}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 100%; text-align : center; display : inline-block;">
            أصرح باستلام هذا الأمر بالخدمة من مدير {{$direction}} لولاية {{$ville}} والذي يبلغنا فيه : &emsp;
            {{$ods_type}}
            </span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 40%; display : inline-block;"> المتعلقة بالمشروع المذكور أعلاه بتاريخ :   :</span>
            <span style="width : 50%; text-align : center; display : inline-block;">{{$ods_date}}</span>
            </div>
            <hr>
            <div style="display : inline-block; width : 100%; font-weight : bold;">
            <span style="width : 100%; text-align : center; display : inline-block;">
            الأمر بالخدمة مطابق للملصق المدون في سجل المديرية
            </span>
            </div>
            <hr>
		</div>
		<div style="font-size: 11px; font-weight: bold; float: left;margin-left: 20px;" >
			<span>         
                <span style="color : black;">{{$ods_date}}</span>   : {{$ville}} في 
            </span> <br><br>
            <span> إمضاء و ختم المسير </span>
		</div>

	</div>

</section>
<br><br><br><br>
<hr>
<p style="text-align : center; font-size : 10px;">
RUE DE L'INDEPENDANCE RN 46A <br>Tél : 033.66.01.48 Fax : 033.66.01.32 B.Email : dtp.d.ouleddjellal@gmail.com
</p>
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
  onclick=location.href="../odss"> رجوع </button>


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


