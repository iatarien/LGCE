@extends('comptabilite.master_compta')

@section('content')
<div class="row">
	<div class="col-lg-offset-2 col-lg-8 portlets">
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-right">تعديل </div>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" dir="rtl" action="../update_op_ar" method="POST">
	            	@csrf
	            	<input type="hidden" name="id" value="{{ $op->id }}">
	              <!-- Title -->
	              <div class="form-group">
	                <div class="col-lg-9">
	                  <input required="" dir="ltr" style="text-align : right" value="{{ $op->numero }}" type="text" class="form-control" id="numero" name="numero">
	                </div>
                    <label readonly class="control-label col-lg-3" style="text-align : left;" for="title">رقم العملية</label>
	                
	              </div>
	              <!-- Content -->

                <div class="form-group">
	                <div class="col-lg-9">
	                  <input dir="rtl" required="" type="text" value="{{ $op->intitule_ar }}" class="form-control" id="intitule_ar" name="intitule_ar">
		            </div>
                    <label readonly class="control-label col-lg-3" style="text-align : left;" for="content">تعيين العملية</label>
	            </div>
				<div class="form-group">
	                <div class="col-lg-9">
	                  <input dir="ltr"  type="text" value="{{ $op->intitule }}" class="form-control" id="intitule" name="intitule">
		            </div>
                    <label readonly class="control-label col-lg-3" style="text-align : left;" for="content"> Intitutlé</label>
	            </div>
				<div class="form-group">
	                <div class="col-lg-9">
	                  <input dir="rtl" required="" type="text" value="{{ $op->chapitre }}" class="form-control" id="chapitre" name="chapitre">
		            </div>
                    <label readonly class="control-label col-lg-3" style="text-align : left;" for="content"> الباب</label>
	            </div>
				<input type="hidden" name="secteur" value="{{$op->secteur}}" />
				<div class="form-group">
                    <div class="col-lg-9">
                        <select required="" class="form-control" name="secteur">
							<option value="{{$op->secteur}}" style="visibility : hidden" >{{strtoupper($op->secteur)}}</option>
                            <option value="education" >التعلبم</option>
                            <option value="ens_sup"> التعلبم العالي</option>
                            <option value="dgsn">الأمن </option>
                            <option value="sante">الصحة</option>
                            <option value="finances">المالية</option>
                            <option value="justice">العدل</option>
                        </select>
                    </div>
                    <label readonly class="control-label col-lg-3" style="text-align : left;" for="content"> الفطاع</label>
	            </div>
				<div class="form-group">
	                <div class="col-lg-9">
                        <select required="" class="form-control" name="source">
							<option style="visibility : hidden" selected value="{{$op->source}}">{{$op->source}}</option>
                          	
                          <option value="PSD">PSD</option>
                          <option value="FSDRS">FSDRS</option>
                          <option value="PSC">PSC</option>
                          <option value="BW">BW</option>
                        </select>
		            </div>
                    <label  class="control-label col-lg-3" style="text-align : left;" for="content"> مصدر التمويل</label>
	              </div>
				  <div class="form-group">
                    <div class="col-lg-9">
	                  <input dir="rtl" required="" step="0.01" type="number" value="{{$op->AP_act}}" class="form-control" id="AP" name="AP_act">
		            </div>
                  <label readonly class="control-label col-lg-3" style="text-align : left;" for="content"> AP </label>
				  </div> 
				  <div class="form-group">
                    <div class="col-lg-9">
	                  <input dir="rtl" required="" step="0.01" type="number" value="{{$op->montant_cp}}" class="form-control" id="CP" name="CP">
		            </div>
                  <label readonly class="control-label col-lg-3" style="text-align : left;" for="content"> CP </label>
	              </div>
				  <div class="form-group" >
                    <div class="col-lg-9">
	                  <input dir="rtl" value="{{$op->num_cloture}}" type="number" value="" class="form-control" id="num_cloture" name="num_cloture">
		            </div>
                  <label readonly class="control-label col-lg-3" style="text-align : left;" for="content"> رقم مقرر غلق العملية </label>
	              </div>
				  <div class="form-group">
                    <div class="col-lg-9">
	                  <input dir="rtl" value="{{$op->date_cloture}}" type="date" value="" class="form-control" id="date_cloture" name="date_cloture">
		            </div>
                  <label readonly class="control-label col-lg-3" style="text-align : left;" for="content"> تاريخ الغلق </label>
	              </div>
	              <!-- Buttons -->
	              <div class="form-group" align="center">
	                <!-- Buttons -->
	                <div class="col-lg-offset-2 col-lg-9">
	                  <button type="submit" class="btn btn-primary">حقظ</button>
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

