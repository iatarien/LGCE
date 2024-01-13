@extends('layouts.master')

@section('content')
<div class="row">
	<div class="col-lg-9 portlets">
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-left">Modifier </div>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" action="../update_op" method="POST">
	            	@csrf
	            	<input type="hidden" name="id" value="{{ $op->id }}">
	              <!-- Title -->
	              <div class="form-group">
	                <label class="control-label col-lg-3" style="text-align : left;" for="title">Numéro de l'operation</label>
	                <div class="col-lg-8">
	                  <input required="" readonly value="{{ $op->numero }}" type="text" class="form-control" id="numero" name="numero">
	                </div>
	              </div>
	              <!-- Content -->
	              <div class="form-group hidden">
	                <label class="control-label col-lg-3" style="text-align : left;" for="content">Intitulé</label>
	                <div class="col-lg-8">
	                  <input required="" type="text" value="{{ $op->intitule }}" class="form-control" id="intitule" name="intitule">
		              </div>
		          </div>
		          <div class="form-group">
	                <label class="control-label col-lg-3" style="text-align : left;" for="content">Intitulé arabe</label>
	                <div class="col-lg-8">
	                  <input lang="ar" dir="rtl" required="" type="text" value="{{ $op->intitule_ar }}" class="form-control" id="intitule" name="intitule_ar">
		              </div>
		          </div>
	              <!-- Cateogry -->
	              <div class="form-group hidden">
	                <label class="control-label col-lg-3" style="text-align : left;">Secteur</label>
	                <div class="col-lg-8">
	                  <select required="" class="form-control" name="secteur">
	                  	  @if($op->secteur == "ens_sup")
							<option value="ens_sup" selected="" style="visibility: hidden;">Enseignement Superieur</option>
							@else
							<option value="{{$op->secteur}}" selected="" style="visibility: hidden;">{{ucfirst($op->secteur)}}</option>
							@endif
                          <option value="education">Education</option>
                          <option value="ens_sup">Enseignement Supérieur</option>
                          <option value="sante">Santé</option>
                          <option value="dgsn">DGSN</option>
                          <option value="finances">Finances</option>
                          <option value="justice">Justice</option>
                        </select>
	                </div>
	              </div>
	              <div class="form-group">
	                <label class="control-label col-lg-3" style="text-align : left;" for="content">Chapitre</label>
	                <div class="col-lg-8">
	                  <input readonly required="" type="text" value="{{ $op->chapitre }}" class="form-control" id="chapitre" name="chapitre">
	                </div>
	              </div>
	              <div class="form-group hidden">
	                <label class="control-label col-lg-3" style="text-align : left;" for="content">Date d'individiualisation</label>
	                <div class="col-lg-8">
	                  <input type="date" class="form-control" value="{{ $op->date }}" id="date" name="date">
	                </div>
	              </div>
	              <div class="form-group hidden">
	                <label class="control-label col-lg-3"  style="text-align : left;" for="content">Daira</label>
	                <div class="col-lg-8">
	                	<input type="text" name="daira" value="{{ $op->daira}}" class="form-control">
	                  <!-- <select class="form-control" name="Commune">
	                  	<option value="Benaceur">Benaceur</option>
						<option value="Blidet Amor">Blidet Amor</option>
						<option value="El Allia" >El Allia</option>
						<option value="El Borma">El Borma</option>
						<option value="El Hadjira">El Hadjira</option>
						<option value="Megarine">Megarine</option>
						<option value="M\'Naguer">M'Naguer</option>
						<option value="Nezla">Nezla</option>
						<option value="Sidi Slimane">Sidi Slimane</option>
						<option value="Taibet">Taibet</option>
						<option value="Tamacine" >Tamacine</option>
						<option value="Tebesbest">Tebesbest</option>
						<option value="Touggourt">Touggourt</option>
						<option value="Zaouia El Abidia" title="">Zaouia El Abidia</option>
	                  </select> -->
	                </div>
	              </div>
	              <div class="form-group hidden">
	                <label class="control-label col-lg-3" style="text-align : left;" for="content">Commune</label>
	                <div class="col-lg-8">
	                	<input type="text" name="commune" class="form-control" value="{{ $op->commune }}">
	                  <!-- <select class="form-control" name="Commune">
	                  	<option value="Benaceur">Benaceur</option>
						<option value="Blidet Amor">Blidet Amor</option>
						<option value="El Allia" >El Allia</option>
						<option value="El Borma">El Borma</option>
						<option value="El Hadjira">El Hadjira</option>
						<option value="Megarine">Megarine</option>
						<option value="M\'Naguer">M'Naguer</option>
						<option value="Nezla">Nezla</option>
						<option value="Sidi Slimane">Sidi Slimane</option>
						<option value="Taibet">Taibet</option>
						<option value="Tamacine" >Tamacine</option>
						<option value="Tebesbest">Tebesbest</option>
						<option value="Touggourt">Touggourt</option>
						<option value="Zaouia El Abidia" title="">Zaouia El Abidia</option>
	                  </select> -->
	                </div>
	              </div>
	              <div class="form-group">
	                <label class="control-label col-lg-3" style="text-align : left;">Source</label>
	                <div class="col-lg-8">
	                  <select required="" readonly class="form-control" name="source">
	                  	  <option selected="" style="visibility: hidden;">{{$op->source}}</option>
                          <!-- <option value="PSD N">PSD N</option>
                          <option value="PSD S">PSD S</option>
                          <option value="FSDRS">FSDRS</option>
                          <option value="PSC">PSC</option>
                          <option value="PW">PW</option> -->
                        </select>
	                </div>
	              </div>
	              <div class="form-group">
	                <label class="control-label col-lg-3" style="text-align : left;" for="content">AP initial</label>
	                <div class="col-lg-8">
	                  <input value="{{ $op->AP_init }}" type="number" step="0.01" class="form-control" id="AP_init" name="AP_init">
	                </div>
	              </div>
	              <div class="form-group">
	                <label class="control-label col-lg-3" style="text-align : left;" for="content">AP Actuelle</label>
	                <div class="col-lg-8">
	                  <input type="number" step="0.01" value="{{ $op->AP_act }}"  class="form-control" id="AP_act" name="AP_act">
	                </div>
	              </div>
	              <div class="form-group hidden">
	                <label class="control-label col-lg-3" style="text-align : left;" for="content">Engagements cumulés</label>
	                <div class="col-lg-8">
	                  <input  class="form-control" type="number" step="0.01" class="eng_cumul" id="eng_cumul" name="eng_cumul" value="{{ $op->eng_cumul }}">
	                </div>
	              </div>
	              <div class="form-group hidden">
	                <label class="control-label col-lg-3" style="text-align : left;" for="content">Payements cumulés</label>
	                <div class="col-lg-8">
	                  <input   class="form-control" type="number" step="0.01" class="pay_cumul" id="pay_cumul" name="pay_cumul" value="{{ $op->pay_cumul }}">
	                </div>
	              </div>
	               <div class="form-group">
	                <label class="control-label col-lg-3" style="text-align : left;" for="content">Taux physique des travaux</label>
	                <div class="col-lg-8">
	                  <input type="number"  max="100" min="0" step="0.01" class="form-control" id="taux" name="taux" value="{{ $op->taux*100 }}">
		              </div>
		          </div>
		           <div class="form-group">
	                <label class="control-label col-lg-3" style="text-align : left;" for="content">Observations</label>
	                <div class="col-lg-8">
	                  <input required="" type="text" class="form-control" id="observations" name="observations" value="{{ $op->observations }}">
		              </div>
		          </div>
	              <!-- Buttons -->
	              <div class="form-group" align="center">
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

@section('js_scripts')
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
@endsection

