@extends('layouts.master')
@section('style')
<style>
table {
	table-layout: fixed;
  color : black;
  font-weight : bold;
}
#demo-table {
		width: 100%;
}
table th {
	width: 100px;
  text-align : right;
}
table td {
	width: 100px;
  text-align : right;
}
.dropdown-content {
  display: block;
  position: absolute;
  background-color: white;
  width: 96%;
  padding: 12px 16px;
  border: 1px solid #c7c7cc;
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content span {
  color: black;
  padding: 6px 16px;
  text-decoration: none;
  display: block;
}
.dropdown-content span:hover {
  background-color: lightblue;
}

</style>
@endsection
@section('content')

<div id="main" class="row main">
  <div align="center">
    <br>
    <a class="btn btn-primary" href="/ajouter_penalite">Ajouter Penalité</a>
    <br><br>
  </div>
	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table;" lang="ar" dir="ltr">
			<div class="panel-heading">Penalités de Retard</div>
				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody id="ops_place">
                        <tr>
                            <th style="width : 20%">Opération</th>
                            <th style="width : 15%">Entreprise</th>
                            <th style="width : 40%">Projet</th>
                            <th>Consulter</th>
                            <th>Supprimer</th>
                        </tr>
                        @foreach($attestations as $att)
                          <tr>
                            <td>{{$att->numero}}</td>
                            <td>{{$att->name}}</td>
                            <td>{{$att->lot}}</td>
                            <td><a href="/penalite1/{{$att->id_pen}}" class="btn btn-default">Consulter</a></td>
                            <td><a onclick="return confirm('Etes-vous de vouloir supprimer ?')" href="/delete_pen/{{$att->id_pen}}" class="btn btn-danger">حذف</a></td>
                        </tr>
                        @endforeach
				    </tbody>
				  </table>
		</section>
		<!--Project Activity end-->
	</div>
</div>
<div style="display: none;" id="filters-secteur"></div>
<div style="display: none;" id="filters-chapitre"></div>
<div style="display: none;" id="filters-numero"></div>
<div style="display: none;" id="filters-user_id">{{$user->id}}</div>
<div style="display: none;" id="filters-e"></div>

@endsection
@section('js_scripts')
<script type="text/javascript">
window.onload = function(){
	document.getElementById('loading').style.display = "none";
};
</script>
@endsection
