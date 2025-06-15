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
        <a class="btn btn-primary" href="../payments/all">Retour </a>
    </div>
	<div class=" col-lg-offset-1 col-lg-10" style="margin-top : 5%;">
    
    <table id="fiche_pay">
        <tr>
            @if($ville_fr =="Biskra")
            <th> Maitre Ouvrage </th>
            @endif
            <th style="display : none"> Décompte</th>
            <th>  Mandat </th>
            <th style="display : none">Attestation de paiement</th> 
            <th > Fiche de paiement </th>
            <th>  Avis de virement </th>
            <th style="display : none">  Déclaration de virement </th>
            <th>   Modifier Compte bancaire </th>
        </tr>
        <tr>
            @if($ville_fr =="Biskra")
            <td>
                <a class="btn btn-default" target="_blank" href="/maitre_ouvrage/{{$id}}"> Conculter</a>
            </td>
            @endif
            <td style="display : none">
                <a class="btn btn-default" target="_blank" href="/avancement/{{$id}}" > Conculter</a>
                <br><br>

            </td>
            <td >
                <a class="btn btn-default" target="_blank" href="/mondat1/{{$id}}"> Consulter</a>
                <br><br>
                @if($editor == $user->id )
                    <a class="btn btn-primary"  href="/modifier_pay/{{$id}}">Modifier </a>
                @else
                    <a class="btn btn-primary" disabled href="/modifier_pay/{{$id}}">Modifier </a>
                @endif
             </td>
            <td style="display : none"> 
                <a class="btn btn-default" target="_blank" href="/attestation_payment/{{$id}}">Consulter</a>
                @if($editor == $user->id)
                <a class="btn btn-primary" disabled href="/edit_fiche_payment/{{$id}}">Modifier </a>
                @else
                <a class="btn btn-primary"  disabled href="/edit_fiche_payment/{{$id}}">Modifier </a>
                @endif
            </td>
            
            <td >
                <a class="btn btn-default"  target="_blank" href="/fiche_payment/{{$id}}"> Consulter</a>
                @if($ville_fr == "Mila" || $ville_fr =="Biskra" || $ville_fr =="Ouargla")
                    <br><br>
                    <a class="btn btn-primary" target="_blank" href="/edit_fiche_payment/{{$id}}"> تعديل</a>
                @endif
            </td>
            <td>
                <a class="btn btn-default" target="_blank" href="/order_pay/{{$id}}"> Consulter</a><br><br>
                <a class="btn btn-default" target="_blank" href="/avis/{{$id}}"> Consulter</a>
            </td>
            <td style="display : none;">
                <a class="btn btn-default" target="_blank" href="/declaration_pay/{{$id}}"> consulter</a>
            </td>
            <td>
                <br>
                @if($editor == $user->id)
                    <a class="btn btn-primary"  href="/edit_bank/{{$id}}">modifier </a>
                @else
                    <a class="btn btn-primary" disabled >modifier </a>
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