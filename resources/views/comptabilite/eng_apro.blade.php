@extends('comptabilite.master_compta')
@section('style')
<style>

#fiche_pay {
    width: 100%;
    text-align: center;
    height: 250px;
}
#fiche_pay th {
    border : 1px solid;
    width: 20%;
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

<div class="row">
    <div align="center" style="margin-top : 3%;">
        <a style="width : 10%" class="btn btn-info" href="/engagements/{{$numero}}" >رجوع </a>
    </div>
	<div class=" col-lg-offset-3 col-lg-6" style="margin-top : 5%;">
    <table id="fiche_pay">
        <tr>
            <th>  بطاقة الالتزام </th>
            @if($apro != Null && $user->service =="Comptabilité")
                <th>  بطاقة الاعتماد </th>
            @endif

        </tr>
        <tr>
            <td>
                <a class="btn btn-default"  href="/fiche_eng/{{$eng->id}}"> معاينة</a>
                <br><br>
                @if($eng->user_id == $user->id and $eng->num_visa == NULL)
                    <a class="btn btn-primary"  href="/modifier_engagement/{{$eng->id}}">تعديل </a>
                @else
                    <a class="btn btn-primary" disabled href="">تعديل </a>
                @endif
            </td>

            @if($apro != Null && $user->service =="Comptabilité")
                <td>
                    <a class="btn btn-default" href="/apro/{{$apro->id}}"> معاينة</a>
                    <br><br>
                    @if($apro->user_id == $user->id)
                    <a class="btn btn-primary"  href="/modifier_apro/{{$apro->id}}">تعديل </a>
                    @else
                    <a class="btn btn-primary"  disabled href="">تعديل </a>
                    @endif
                </td>
            @endif
            

        </tr>
    </table>
		<div class="row">
			
		</div>
	</div>
</div>
<div style="display: none;" id="filters-secteur"></div>
<div style="display: none;" id="filters-chapitre"></div>
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
</script>
@endsection