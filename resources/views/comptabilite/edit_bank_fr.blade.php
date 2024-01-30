@extends('layouts.master')
@section('style')
<style type="text/css">
#engagement {
    border-collapse: collapse;
    border : 1px solid;
    table-layout: fixed;
}
#engagement th {
    border : 1px solid;
    width: 23%;
    text-align: center;
    color: black;
}
#engagement th:last-child {
    width: 31%;
}
#engagement td {
    border : 1px solid;
    font-weight: bold;
    padding: 0 3px 0 3px;
    text-align: center;
}
.input_num {
  color: black;
}
#engagement td:nth-last-child(2) {
    text-align: left;
}
#engagement td:first-child {
  padding : 0;
}
#engagement td:nth-last-child(4) {
    padding : 0;
}
#engagement td:last-child {
    display: none;
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
	<div class="col-sm-10 portlets " lang="ar" dir="ltr" style="margin-right: 10%;"  >
	    <div class="panel panel-default">
	      <div class="panel-heading">
            <div class="pull-left">
            Modifier compte bancaire du {{$e->name}} 
            </div>
	        <div class="clearfix"></div>
	      </div>
        <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
            <form class="form-horizontal" autocomplete="off" action="../update_bank" method="POST">
	            	@csrf
                <input type="hidden" name="id_deal" value="{{ $id_deal}}">
                <input type="hidden" name="id" value="{{$id}}">
                <div class="form-group">
                  <input type="hidden" name="bank_id" value="{{ $bank->id }}">
                  <label  class="control-label col-sm-2" style="text-align : left; font-weight: bold;" for="title">  N° compte bancaire </label>
                
                  <div class="col-sm-10">
                    <input value="{{ $bank->bank_acc }}" required="" type="text" style="color: black;" class="form-control" name="bank_acc">
                  </div>
                    </div>
                <div class="form-group">
                <label  class="control-label col-sm-2" style="text-align : left; font-weight: bold;" for="title"> Propriétaire du compte</label>
               
                  <div class="col-sm-10">
                    <input value="{{ $bank->bank_user }}" required="" readonly type="text" style="color: black;" class="form-control" name="bank_user">
                  </div>
                     </div>
                <div class="form-group">
                <label  class="control-label col-sm-2" style="text-align : left; font-weight: bold;" for="title">Banque</label>
               
                  <div class="col-sm-10">
                    <select required="" style="color: black;" class="form-control" name="bank">
                    <option selected style="visibility : hidden" value="{{ $bank->bank }}">{{ $bank->bank }}</option>
                    @foreach($banques as $banque)
                      <option value="{{ $banque->nom }}" >{{ $banque->nom }} - {{ $banque->abr }}</option>
                    @endforeach
                    </select>
                  </div>
                     </div>
                <div class="form-group">
                <label  class="control-label col-sm-2" style="text-align : left; font-weight: bold;" for="title">Agence</label>
                
                  <div class="col-sm-10">
                    <input value="{{ $bank->bank_agc }}" required="" type="text" style="color: black;" class="form-control" name="bank_agc">
                  </div>
                    </div>
                <div class="form-group" align="center">
	                <!-- Buttons -->
	                <div class="col-sm-offset-2 col-sm-9">
	                  <button type="submit" class="btn btn-primary">Sauvegarder</button>
	                </div>
	              </div>
              </form>
            </div>
	        </div>
        </div>
	    </div>
	</div>
</div>


@endsection

@section('js_scripts')

<script type="text/javascript">
  window.onload = function(){
    document.getElementById('loading').style.display = "none";
  };
  
</script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});




</script>
@endsection

