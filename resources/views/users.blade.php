@extends('layouts.master')
@section('style')
<style>
table {
	table-layout: fixed;

}
#demo-table {
		width: 100%;
}
table td {
	width: 100px;
}

.dropdown-content {
  display: block;
  position: absolute;
  background-color: white;
  width: 280px;
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
table td h5 {
	font-size : 12px !important;
}
table tr  {
	font-size : 12px !important;
}
table td span a {
	font-size : 12px !important;
}
input {
  font-size: 13px !important;
}
.dropdown-content span:hover {
  background-color: lightblue;
}
.es_clss {
	font-size : 12px !important;
}
.ops_clss {
	font-size : 13px !important;
}
</style>
@endsection
@section('content')
<br><br><br><br>
<div class="row main" id="main" style="margin-top : 0">
<div class="col-lg-9 portlets">
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-left">Ajouter Utilisateur</div>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" action="add_user" method="POST">
	            	@csrf
	              <!-- Title -->
	              <div class="form-group">
	                <label class="control-label col-lg-2" for="title">Nom et Prénom</label>
	                <div class="col-lg-10">
	                  <input required="" type="text" class="form-control" id="full_name" name="full_name">
	                </div>
	              </div>
	              <!-- Content -->
	              <div class="form-group">
	                <label class="control-label col-lg-2" for="content">Username</label>
	                <div class="col-lg-10">
	                  <input required="" type="text" class="form-control" id="username" name="username">
		              </div>
		          </div>
	              <div class="form-group">
	                <label class="control-label col-lg-2" for="content">Mot de passe</label>
	                <div class="col-lg-10">
	                  <input required="" type="password" class="form-control" id="password" name="password">
	                </div>
	              </div>
	              <!-- Cateogry -->
	              <div class="form-group" style="display : none">
	                <label class="control-label col-lg-2">Position</label>
	                <div class="col-lg-10">
	                  <select required="" class="form-control" name="position">
                          <option selected value="Employé">Employé</option>
                          <option value="Chef de service">Chef de service</option>
                          <option value="Directeur">Directeur</option>
                          <option value="Admin">Admin</option>
                        </select>
	                </div>
	              </div>
	              <div class="form-group">
	                <label class="control-label col-lg-2">Service</label>
	                <div class="col-lg-10">
	                  <select required="" class="form-control" name="service">
                          <option value="Admin">Admin</option>
						  <option value="ODS">ODS</option>
                          <option value="Comptabilité">Comptabilité</option>
						  <option value="Coordination">Coordination</option>
						  @if($ville_fr == "Medea")
						  <option value="Marché">Marché</option>
						  @endif
						  @if($ville_fr == "Touggourt")
						  <option value="Engagement">Engagement</option>
						  <option value="Paiement">Paiement</option>
						  @endif
                        </select>
	                </div>
	              </div>
				  <div class="form-group" style="display : none">
	                <label class="control-label col-lg-2" for="content">Chapitre</label>
	                <div class="col-lg-10">
	                  <input type="text" class="form-control" id="chapitre" name="chapitre">
		              </div>
		          </div>
	              <!-- Buttons -->
	              <div class="form-group">
	                <!-- Buttons -->
	                <div class="col-lg-offset-2 col-lg-9">
	                  <button type="submit" class="btn btn-primary">Ajouter</button>
	                  <button type="reset" class="btn btn-default">Annuler</button>
	                </div>
	              </div>
	            </form>
	          </div>


	        </div>
	        <div class="widget-foot">
	          <!-- Footer goes here -->
	        </div>
	      </div>
	    </div>
	</div>
	<div class="col-lg-9">
		<!--Project Activity start-->
		<section class="panel">
		  <div class="panel-body progress-panel">
		    <div class="row">
		      <div class="col-lg-12 task-progress pull-left">
		        <h1>Utilisateurs</h1>
		      </div>
		    </div>
		  </div>
		  <table class="table table-hover personal-task">
		    <tbody>
		      <tr>
		        <th>Nom et Prénom</th>
		        <th>Username</th>
		        <th>Service</th>
		        <th>Modifier</th>
		      </tr>
		      @foreach($users as $u)
		      <tr>
		        <td><span class="profile-ava">
                        <img alt="" style="width: 30px; height: 30px;" class="simple" src="{{ $u->photo }}">
                    </span>
                    <span>{{ $u->full_name }}</span>

		        </td>
		        <td>
                    <span>{{ $u->username }}</span>
		        </td>
		        <td>
                    <span>{{ $u->service }}</span>
		        </td>
		        <td>
                    <span><a  class="btn btn-primary" href="/modify_user/{{ $u->id }}" >Modifier</a></span>
		        </td>
		      </tr> 
		      @endforeach  
		    </tbody>
		  </table>
		</section>
		<!--Project Activity end-->
	</div>
</div>
@endsection

@section('js_scripts')
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
function delete_user(id){
	const answer = confirm('Etes-vous sur de vouloir Supprimer cet utilisateur ?');
	if (answer) {
		$.ajax({
	    url:"/delete_user",
	    type:"POST", 
	    data:{
	      id: id,
	    },
	    cache: false,
	    success:function(response) {
	     console.log(response);
	     location.reload();
	   	},

	  });
	}
	  
}	
</script>
@endsection

