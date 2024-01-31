@extends('layouts.master')
@section('style')
<style>
table {
	table-layout: fixed;
}
#demo-table {
		width: 100%;
}
table th {
	width: 100px;
  text-align : left;
}
table td {
	width: 100px;
  text-align : left;
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
	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table;" lang="ar" dir="ltr">
			<div class="panel-heading"> Borderaux d'envois</div>
				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody id="ops_place">
                        <tr>
                            <th>N°</th>
                            <th>Type Borderau </th>
                            <th>Consulter</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                        <?php $i = 0; ?>
                        @foreach($bords as $bord)
                          <?php $i++; ?>
                          <tr>
                            <td>{{$i}}</td>
                            @if($bord->type =="eng")
                            <td>CB</td>
                            @else
                            <td>Trésor</td>
                            @endif
                            
                            @if($bord->type =="eng")
                              <td><a href="/borderau/{{$bord->b_id}}" class="btn btn-default">Consulter</a></td>
                            
                            @else
                              <td> <a href="/borderau1/{{$bord->b_id}}" class="btn btn-warning" style="background-color : orange;">Consulter</a></td>
                            @endif
                            <td><a href="/edit_borderau/{{$bord->b_id}}/{{$bord->type}}" class="btn btn-primary">Modifier</a></td>
                            <td><a onclick="confirm('Etes-vous sur de vouloir supprimer ?')" href="/delete_borderau/{{$bord->b_id}}" class="btn btn-danger">supprimer</a></td>
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
