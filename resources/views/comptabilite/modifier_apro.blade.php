@extends('comptabilite.master_compta')
@section('style')
<style type="text/css">

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
        max-width:100%;
        white-space:nowrap;
        padding : 1px;

	}

    table{
    	width:100%;
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
        text-align : center;
        color : black;
    }
    table tr th {
        color : black;
    }
    
</style>
@endsection
@section('content')

<div class="row">
	<div class="col-lg-12">
        <div id="fiche_top">
            <br><br><br><br><br><br>
            <div dir="rtl" id="titles">
            <form class="form-horizontal" autocomplete="off" action="../update_apro" method="POST">
	            	@csrf

                <input type="hidden" name="id" value="{{$apro->id}}" id="id">
                
	              <!-- Title -->
                <div class="form-group">
	                <div class="col-lg-10">
                    <input id="op_input" dir="ltr" style="text-align : right;" list="ops" class="form-control" readonly value="{{ $apro->chapitre}} " > 

	                </div>
                    <label class="control-label col-lg-2" style="text-align : right; font-weight: bold;" for="title"> الباب :</label>
	              </div>
	              <div class="form-group">
	                <div class="col-lg-10">
                        @if($juri->deal_date != null)
                            <input dir="ltr" style="text-align : right" required=""  type="text" class="form-control" readonly value="{{ $juri->deal_num }}/{{ date('Y', strtotime($juri->deal_date)) }}">
                        @else
                            <input dir="ltr" style="text-align : right" required=""  type="text" class="form-control" readonly value="{{ $juri->deal_num }}">
                        @endif
	                  
	                </div>
                    <label class="control-label col-lg-2" style="text-align : right; font-weight: bold;" for="title">{{ $juri->deal_type }} رقم :</label>
	              </div>
                  <div class="form-group">
	                <div class="col-lg-10">
	                  <input readonly="" required="" type="text" class="form-control" value="{{$juri->sujet}} ">
	                </div>
                    <label  class="control-label col-lg-2" style="text-align : right; font-weight: bold;" for="title"> موضوع ال{{$juri->deal_type}} :</label>
	              </div>
                  <div class="form-group">
	                <div class="col-lg-10">
	                  <input readonly="" required="" type="text" class="form-control" value=" {{ $e->name }} ">
	                </div>
                    <label  class="control-label col-lg-2" style="text-align : right; font-weight: bold;" for="title">  النتعامل المتعاقد :</label>
	              </div>
                  
            <div>
            <br>
            <div style=" display: inline-block; text-align : center; width : 100%;">
                <h2 style=" font-size : 7mm; margin : 0;">   جدول خاص بالاعتمادات المحاسبية     </h2>
            </div>
            <br><br>
            <table dir="ltr">
                <tr>
                    <th>مبلغ الاعتماد المتبقي</th>
                    <th>المبلغ المتبقي للتسديد</th>
                    <th>المبلغ المقترح للالتزام</th>
                    <th>المبلغ المسدد</th>
                    <th>مبلغ ال{{$juri->deal_type}}</th>
                    <th>مبلغ الاعتماد</th>
                </tr>
                <tr>
                    
                    <td><input required readonly name="new_cp" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" value="{{$apro->new_cp}}"> </td>
                    <td><input required readonly name="new_pays" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" value="{{$apro->new_pays}}"> </td>
                    
                    <td><input required readonly name="montant" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" value="{{ number_format((float)$apro->montant, 2, '.', ',')}}"> </td>
                    
                    <td><input required name="old_pays" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" value="{{$apro->old_pays}}"> </td>                    
                    
                    <td><input required  name="deal_montant" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" value="{{ number_format((float)$apro->deal_montant, 2, '.', ',')}}"> </td>
                    <td><input required name="old_cp" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" value="{{$apro->old_cp}}"> </td>
                    
                </tr>
            </table>
                

            <br><br><br>
        </div>
        <div class="form-group" align="center" style="text-align : center;">
                        <button type="submit" class="btn btn-primary">حفــــظ</button>

                </div>
            </form> 
	</div>

</div>

<div style="display: none;" id="filters-numero"></div>

<div id="myModal" class="modal" style="display: block;">

  <!-- The Close Button -->

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01" src="{{ url('img/loading.gif') }}">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
@endsection

@section('js_scripts')
<script type="text/javascript">
window.onload = function(){

	document.getElementById('myModal').style.display = "none";
};



function numberWithCommas(x) {
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(!x.includes('.')){
      x += ".00";
    }else if(x.split(".")[1].length == 1){
        x+= "0";
    }else if(x.split(".")[1].length > 2){
		x0 = x.split(".")[0];
		x1 = x.split(".")[1];
		x1 = x1[0]+x1[1];
		x = x0 +"."+x1;
	}
    return x;
}
function somme(){
  var old_cp = document.getElementsByName("old_cp")[0];
  var juri_total = document.getElementsByName("deal_montant")[0];
  var old_pays = document.getElementsByName("old_pays")[0];
  var compta_total = document.getElementsByName("montant")[0];
  var new_pays = document.getElementsByName("new_pays")[0];
  var new_cp = document.getElementsByName("new_cp")[0];

  new_cp.value = numberWithCommas(parseFloat(old_cp.value.replaceAll(',','')) - parseFloat(compta_total.value.replaceAll(',','')));
  new_pays.value = numberWithCommas(parseFloat(juri_total.value.replaceAll(',','')) - (parseFloat(old_pays.value.replaceAll(',','')) + parseFloat(compta_total.value.replaceAll(',',''))));
}
$( ".input_num" ).on('keyup', function () {
    
    if(this.value !="" && !this.value.includes(".") && !this.value == "-"){
        var clean = this.value.replaceAll(",","");
        console.log("txte "+clean);
        //console.log("num " +num+", clean "+clean+", txt "+txt );
        this.value = txt;
    }
    somme();
});
</script>
@endsection