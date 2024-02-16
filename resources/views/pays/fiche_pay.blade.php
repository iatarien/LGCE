@extends('layouts.master')
@section('style')
<style>

#fiche_pay {
    width: 100%;
    text-align: center;
    height: 250px;
}
#fiche_pay th {
    border : 1px solid;
    width: 15%;
    font-size: 16px;
    background-color: rgb(245,245,245) !important;
    text-align: center;
}
#fiche_pay td {
    border : 1px solid;
    font-size: 16px;
    font-weight: bold;
    padding: 0 3px 0 3px;
}
.btn {
    width: 80%;
}	
</style>
@endsection
@section('content')

<div id="main" class="row main">

    <div class="col-lg-offset-5 col-lg-2" align="center" style="margin-top : 4%">
        <a class="btn btn-primary" href="../payments/all">رجوع </a>
    </div>
	<div class=" col-lg-offset-1 col-lg-10" style="margin-top : 5%;">
    
    <table id="fiche_pay">
        <tr>
            <th> كشف الحساب </th>
            <th> حوالة الدفع </th>
            <th> شهادة الدفع </th> 
            <th style="display : none"> بطاقة الدفع </th>
            <th> إشعار بالتحويل </th>
            <th> بيان بالتحويل </th>
            <th> تعديل رقم الحساب </th>
        </tr>
        <tr>
            <td>
                <a class="btn btn-default" target="_blank" href="/avancement/{{$id}}" > معاينة</a>
                <br><br>
                @if($editor == $user->id )
                    <a class="btn btn-primary"  href="/modifier_pay/{{$id}}">تعديل </a>
                @else
                    <a class="btn btn-primary" disabled href="/modifier_pay/{{$id}}">تعديل </a>
                @endif
            </td>
            <td>
                <a class="btn btn-default" target="_blank" href="/mondat1/{{$id}}"> معاينة</a>
             </td>
            <td>
                <a class="btn btn-default" target="_blank" href="/attestation_payment/{{$id}}">معاينة</a>
                @if($ville_fr =="Ouled Djellal" || $ville_fr =="Ouled djellal" || $ville_fr =="ouled djellal")
                <br><br><br>
                <a class="btn btn-info" target="_blank" href="/attestation_payment_2/{{$id}}">معاينة</a>
                @endif
            </td>
            
            <td style="display : none;">
                <a class="btn btn-default" disabled target="_blank" href="/fiche_payment/{{$id}}"> معاينة</a>
                <br><br>
                @if($editor == $user->id)
                <a class="btn btn-primary" disabled href="/edit_fiche_payment/{{$id}}">تعديل </a>
                @else
                <a class="btn btn-primary"  disabled href="/edit_fiche_payment/{{$id}}">تعديل </a>
                @endif
            </td>
            <td>
                <a class="btn btn-default" target="_blank" href="/order_pay/{{$id}}"> معاينة</a>
            </td>
            <td>
                <a class="btn btn-default" target="_blank" href="/declaration_pay/{{$id}}"> معاينة</a>
            </td>
            <td>
                <br>
                @if($editor == $user->id)
                    <a class="btn btn-primary"  href="/edit_bank/{{$id}}">تعديل </a>
                @else
                    <a class="btn btn-primary" disabled >تعديل </a>
                @endif
            </td>
        </tr>
    </table>
		<div class="row">
			
		</div>
	</div>
</div>
<div style="display: none;" id="filters-secteur"></div>
<div style="display: none;" id="filters-chapitre"></div>
<div style="display: none;" id="filters-numero"></div>


@endsection

@section('js_scripts')
<script type="text/javascript">
window.onload = function(){
    document.getElementById('loading').style.display = "none";
};
</script>
@endsection