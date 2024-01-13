<html>

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
            
			font-size: 10mm;
			line-height: 1.5mm;
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
<?php $i = 1; 
$j = 0;
$debut = 0;
$indice = 7;
//var_dump($conges); ?>
<body>
<div style="height : 10mm;"></div>
<div class="row">

	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table;" lang="ar" dir="rtl">
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

				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody id="ops_place">
                        <tr style="  font-weight : bolder;">
                            <td style="width : 2%;" ><div>#</div></td>
                            <td style=" width : 7%;"><div>  رقم البطاقة </div></td>
                            <td style=" width : 15%;"><div> رقم العملية</div></td>
                            <td style=" width : 25%;"><div> موضوع الالتزام</div></td>
                            <td style=" width : 20%;"><div> المقـــاول</div></td>
                            <td style=" width : 13%;"><div> القــيمة</div></td>
                            <td style=" width : 13%;"><div> تاريخ التأشيرة</div></td>
                        </tr>
                        @foreach($engss as $eng)
                        
                        <tr style="font-weight : bold">
                            <td>
                                <span><h5><strong>{{$i}}</strong></h5></span>
                            </td>
                            <td>
                                <span><h5><strong>{{$eng->numero_fiche}}</strong></h5></span>
                            </td>
                            <td>
                                <span><h5><strong>{{$eng->numero}}</strong></h5></span>
                            </td>
                            <td>
                                <span><h5><strong>{{$eng->real_sujet}}</strong></h5></span>
                            </td>
                            <td>
                                <span><h5><strong>{{$eng->name}}</strong></h5></span>
                            </td>
                            <td dir="ltr">
                                <span><h5><strong>{{ number_format((float)$eng->montant, 2, '.', ' ')}}</strong></h5></span>
                            </td>
                            <td>
                                @if($eng->date_visa != NULL)
                                <span><h5><strong>{{$eng->date_visa}}</strong></h5></span>
                                @else 
                                <span style="font-weight : bold"> /  </span>
                                @endif
                                
                            </td>
                            
                            
                        </tr>
                    <?php $i++; ?>
                    @endforeach
				    </tbody>
				  </table>
                  <div class="pagebreak"></div>
                <?php  } ?>
                
		</section>
		<!--Project Activity end-->
	</div>
</div>

<div style="display: none;" id="filters-numero"></div>


<script type="text/javascript">
window.onload = function(){

    window.print();
    window.onafterprint = function(){
        window.close();
    }
    
};

</script>
</body>
</html>
