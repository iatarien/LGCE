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
			height:297mm;
	    	width:210mm;
			overflow-y : hidden !important;
		}
		
	}
	html,body{
	    height:210mm;
	    width:287mm;
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


    }
    .le_table td {
        border-bottom : none;
        border-top : none;
        text-align : right;
    }

    #stamp {
        width : 30mm;
        float : left;
    }
</style>
</head>
<body contenteditable="true">
<?php if(isset($op->order_ville) && $op->order_ville !="" && $op->order_ville !=NULL){
$ordre = $op->order_ville;
} 
?>
<section  style="background-color: white; text-align: center; font-size: 12.5px; margin: 20px;" id="fiche">
	<div id="fiche_top" style="margin-right : 10%; margin-left : 10%;" >
		<div style="  display: inline-block; ">
			<h3>    الجمهورية الجزائرية الديمقراطية الشعبية <br>
		</div>
        <div style="width : 100%;" >
            <h3>   إشعار بتحويل لحساب الخزينة العومية <br>
			نفقات المسندة لميزانية  للدولة</h3>
        </div>
		
		<div style="  display: inline-block; max-width : 45%; " dir="rtl">
        <table id="le_table" style="font-size : 11.5px;">
                <tr>
                    <th style="width : 34%;">التصنيف حسب النشاط </th>
                    <th style="width : 33%;">الرمز</th>
                    <th style="width : 33%;">التسمية</th>
                </tr>
                <tr>
                    <td>محفظة البرنامج </td>
                    <td>{{$op->portefeuille}}</td>
                    <td>{{$op->ministere}}</td>
                </tr>
                <tr>
                    <td>البرنامج </td>
                    <td>{{$prog->code}}</td>
                    <td>{{$prog->designation}}</td>
                </tr>
                <tr>
					<td> النشاط</td>
					<td>{{$op->activite}} </td>
					@if($op->source =="PSC")
					<td>َتفويض التسيير القطاعي الممركز</td>
					@else
					<td>َتفويض التسيير الغير ممركز</td>
					@endif
						
                </tr>
                <tr>
				<?php $sousy =  $op->sous_action; ?>
					@if($ville_fr =="Mila" )
					<?php $sousy = explode(".",$op->sous_action)[0]; ?>
					@endif
                    <td>النشاط الفرعي </td>
					<td>{{$sousy}}</td>
					<td></td>
                </tr>
        </table>


        <br>
        </div>
		<div style="  display: inline-block; width : 22%; float: right;">
			<h3 style="text-align : right;" dir="rtl"> 
			وزارة {{$ministere}} <br>
            مديرية {{$direction}} لولاية {{$ville}}<br>
			</h3>
            
		</div>
		<div style="  display: inline-block; float: right; margin-top : 2%;
		width : 28%; margin-right : 2%; margin-left : 2%;">
			<table style="text-align : center">
				<tr>
					<td>المحاسب  المختص  <span>  
						<br>    
					</span></td>
                </tr>

				<tr>
					<td dir="rtl">   أمين الخزينة ولاية {{$ville}}<br> <span dir="rtl">حساب الصرف ح ج ب رقم {{$compte_tresor}} الجزائر </span> </td>
                </tr>
        	</table>
			@if($ville_fr =="Ouargla" && $direction_fr =="Direction de l'Administration Locale")
			<h1>1812.145.020</h1>
			@endif
		</div>
        
		<div dir="rtl" style="  display: inline-block; width : 100%; font-weight :  normal; text-align : justify; ">
            <table style="border : none;  min-height : 200px;">
                <tr>
                    <th rowspan="2" style="width : 25%;">تحديد المستفيد  </th>
					<th rowspan="2" style="width : 3%;">رقم الحساب الدائن</th>
                    <th rowspan="2" style="width : 10%;">المبلغ</th>          
					<th rowspan="2" style="width : 4%;">اقتطاع محاسب</th>      
					<th rowspan="2" style="width : 4%;">المبلغ الصافي للدفع</th>      
					<th rowspan="2" style="width : 4%;">رقم الإلتزام</th>    
					<th rowspan="1" colspan="5" style="width : 30%;">بــيـــانــات</th>     
					<th rowspan="2" style="width : 4%;">رقم الحوالة</th>      
					<th rowspan="2" style="width : 4%;">رقم السطر</th>           
					<th rowspan="2" style="width : 12%;">المــراجع</th>        
				</tr>
				<tr>
					<th rowspan="1" style="width : 5%;">البرنامج   </th>
					<th rowspan="1" style="width : 5%;">البرنامج الفرعي  </th>
					<th rowspan="1" style="width : 5%;"> السنة  </th>
					<th rowspan="1" style="width : 5%;"> الأمر بالصرف  </th>
					<th rowspan="1" style="width : 5%;">قسم  </th>
				</tr>
                <tr>
                    <td>{{$bank->bank}}<br>وكالة {{$bank->bank_agc}}<br>تدفع ف الحساب البنكي رقم {{$bank->bank_acc}} وكالة {{$bank->bank_agc}}<br>
					 مفتوح باسم {{$bank->bank_user}}</td>
					<td>{{ $pay->num }}</td>
					<td dir="ltr">{{ number_format((float)$pay->to_pay, 2, '.', ' ')}} </td>
					<td></td>
					<td></td>
					<td></td>
					<td>{{$prog->code}}</td>
					<td>{{$sous_prog->code}}</td>
					<td>{{$pay->year}}</td>
					<td>027/262</td>
					<td>001</td>
					<td>{{$pay->num_mondat}}</td>
					<td></td>
					<td>وضعية رقم {{$pay->travaux_num}} <br>
					بتاريخ <br>{{$pay->date_pay}}
					</td>
                </tr>

            </table>
			@if($ville_fr =="Mila")
			<br>				<br>
			<div align="left">

				<b> الأمـــر بالصــرف </b>
				<br>
			</div>
			@endif
	    </div>
        <br><br>
        
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
  onclick="retour()">رجوع </button>
 <br><br><br><br>
</div>
<script src="{{ url('js/jquery.js') }}"></script>
<script src="{{ url('js/jquery-ui-1.10.4.min.js') }}"></script>
<script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
<script src="{{ url('js/tagfeet.js') }}" ></script>
<script type="text/javascript">
window.onbeforeunload = function () {
    window.close();
};
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
function retour(){
	if(window.history.length == 1){
		window.close();
	}else{
		document.location.href = "/fiche_pay/{{$id}}";
	}
}
function hide_stamp(){
	document.getElementById('stamp').style.visibility ="hidden";
	
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
	//document.getElementById('bouton_3').style.display = "none";
   /* var footstr = "</body>";
    var newstr = document.getElementById(printdivname).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = ""+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;*/
    print();
    document.getElementById('bouton').style.display = "inline-block";
	document.getElementById('bouton_2').style.display = "inline-block";
	//document.getElementById('bouton_3').style.display = "inline-block";
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


