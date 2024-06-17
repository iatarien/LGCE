@extends('layouts.master')

@section('content')
<br><br><br><br>
<div class="row main" id="main">
	<div class="col-lg-8 portlets">
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-left">Modifier Utilisateur</div>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" action="../update_user" method="POST">
	            	@csrf

	              <!-- Title -->
	              <input type="hidden" name="id" value="{{ $u->id}}">
	              <div class="form-group">
	                <label class="control-label col-lg-2" for="title">Nom et Prénom</label>
	                <div class="col-lg-10">
	                  <input required="" type="text" class="form-control" value="{{ $u->full_name}}" id="full_name" name="full_name">
	                </div>
	              </div>
	              <!-- Content -->
	              <div class="form-group">
	                <label class="control-label col-lg-2" for="content">Username</label>
	                <div class="col-lg-10">
	                  <input required="" type="text" value="{{ $u->username}}" class="form-control" id="username" name="username">
		              </div>
		          </div>
	              <div class="form-group">
	                <label class="control-label col-lg-2" for="content">Mot de passe</label>
	                <div class="col-lg-10">
	                  <input required="" type="text" value="{{ $pwd}}" class="form-control" id="password" name="password">
	                </div>
	              </div>
	              <!-- Cateogry -->
	              <div class="form-group" style="display : none">
	                <label class="control-label col-lg-2">Position</label>
	                <div class="col-lg-10">
	                  <select required="" class="form-control" name="position">
	                  	  <option selected style="visibility: hidden;"  value="{{$u->position}}">{{$u->position}}</option>
                          <option value="Employé">Employé</option>
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
	                  	  <option selected style="visibility: hidden;" value="{{$u->service}}">{{$u->service}}</option>
						  <option value="Admin">Admin</option>
						  <option value="ODS">ODS</option>
                          <option value="Comptabilité">Comptabilité</option>
						  <option value="Coordination">Coordination</option>
						  @if($ville_fr == "Medea")
						  <option value="Marché">Marché</option>
						  @endif
                        </select>
	                </div>
	              </div>
				  <div class="form-group" style="display : none">
	                <label class="control-label col-lg-2" for="content">Chapitre</label>
	                <div class="col-lg-10">
	                  <input type="text" value="{{$u->chapitre}}" class="form-control" id="chapitre" name="chapitre">
		              </div>
		          </div>
	              <!-- Buttons -->
	              <div class="form-group">
	                <!-- Buttons -->
	                <div class="col-lg-offset-2 col-lg-9">
	                  <button type="submit" class="btn btn-primary">Enregistrer</button>
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
</div>
@endsection
