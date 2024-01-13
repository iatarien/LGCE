@extends('comptabilite.master_compta')
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
    text-align: right;
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
<div class="row">
	<div class="col-sm-10 portlets pull-right" lang="ar" dir="rtl" style="margin-right: 10%;"  >
	    <div class="panel panel-default">
	      <div class="panel-heading">
        <div class="pull-right">
                @if($type == "juridique")
                    التــــــزام قانوني
                @elseif($type =="comptable")
                     التــــــزام محاسب  
                @elseif($type =="decision")
                     تكفل بمقرر  
                @elseif($type =="inscription")
                     تسجيل عملية  
                @elseif($type =="fiche_eco")
                      بطاقة اقتصاد  
                @elseif($type =="FSDRS")
                      التزام صندوق الجنوب   
                @elseif($type =="mixte")
                       التــــــزام قانوني و محــــاسبي   
                @endif
            </div>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body">
	        <div class="padd">

	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" action="../update_eng" method="POST" onsubmit="event.preventDefault(); return change_nulls(this);">
	            	@csrf
                <input type="hidden" name="id" value="{{ $id}}">
                <input type="hidden" name="type" value="{{ $type}}">
                <input type="hidden" name="id_op" id="id_op" value="{{ $operation->id }}">
                
	              <!-- Title -->
                <?php if (strpos($eng->sujet, '1989raouf1989') !== false) {
                    $sujets = explode("1989raouf1989",$eng->sujet);
                    $eng->sujet = $sujets[1];
                    $txt = $sujets[0]; 
                    $txt = str_replace("بطافة سحب بطاقة ","",$txt);
                    $txt = str_replace(" المتعلقة ب","",$txt);
                    
                    ?>
                    <div class="form-group">
                      <div class="col-sm-10">
                        <input dir="rtl" onkeyup="subject()"  style="text-align : right" required="" value="{{$txt}}" type="text" class="form-control" id="retrait">
                      </div>
                      <label class="control-label col-sm-2" style="text-align : right; font-weight: bold; color : red;" for="title"> سحب بطاقة</label>
                    </div>';
                <?php } ?>
                
                <div class="form-group">
	                <div class="col-sm-10">
                    <input id="op_input" readonly list="ops" class="form-control" id="numero_op_txt" value="{{ $operation->numero }}" > 
	                </div>
                    <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">رقم العملية</label>
	              </div>
	              <div class="form-group">
	                <div class="col-sm-10">
	                  <input  dir="ltr" style="text-align : right" required="" value="{{ $eng->numero_fiche }}" type="text" class="form-control" id="numero_fiche" name="numero_fiche">
	                </div>
                    <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">رقم البطاقة</label>
	              </div>
                  <div class="form-group">
	                <div class="col-sm-10">
	                  <input readonly="" value="{{ $operation->intitule_ar }}" required="" type="text" class="form-control" id="intitule_ar" name="intitule_ar">
	                </div>
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> تعيين العملية</label>
	              </div>
                <div class="form-group">
                    <div class="col-sm-10">
                      <input onkeyup="subject()"  type="text" placeholder="الملحق" value="{{$eng->annexe}}" class="form-control" name="annexe" id="annexe" style="color: black;">
                    </div>
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> الملحق</label>
                  </div>
                @if($type !="fiche_eco")
                  <div class="form-group">
                    <div class="col-sm-3">
                      <input onchange="subject()" value="{{ $eng->deal_date }}" type="date" class="form-control" id="deal_date" name="deal_date" style="color: black;" >
                    </div>
                    
                    <div class="col-sm-4">
                      <input onkeyup="subject()"  type="text" value="{{ $eng->deal_num }}" placeholder="رقم" class="form-control" id="deal_num" name="deal_num" style="color: black;" required>
                    </div>
                    
                    <div class="col-sm-3">
                      <select onchange="subject()" required class="form-control"  id="deal" name="deal_type" style="color: black;" required>
                        <option style="visibility : hidden" value="{{ $eng->deal_type }}">{{ $eng->deal_type }} </option>
                        @if($type == "juridique" or $type == "comptable" or $type =="FSDRS" or $type =="mixte")
                        <option value="صفقة">صفقة</option>
                        <option value="عقد">عقد</option>
                        <option value="فــاتورة">فــاتورة</option>
                        <option value="كشف كمي و تقديري">كشف كمي و تقديري</option>
                        @else
                        <option value="مقرر">مقرر</option>
                        @endif
                      </select>
                    </div>
                     
                  </div>
                @endif
                @if($type == "juridique" or $type == "comptable" or $type == "FSDRS" or $type =="mixte")
                <div class="form-group">
                  <div class="col-sm-1">
                    <button onclick="add_e()" type="button" class="btn btn-sm btn-primary">+</button>
	                </div>
                
	                <div class="col-sm-9">
                    <input id="comp_input" class="form-control" id="comp_txt" value="{{ $eng->name }}" onclick="comp_like(event,this.value)" onkeyup="comp_like(event,this.value)" > 
                    <div id="myDropdown_comp" class="dropdown-content" style="display: none;">
                    <input type="hidden" id="entreprise" name="entreprise_id" value="{{ $eng->entreprise_id }}">
                      <div id="es">
                        @foreach ($entreprises as $e)
                        <span style="color: black; cursor: pointer;" class="comps_clss" style="cursor: pointer;" onclick="comps_changed('{{ $e->id }}1989raouf1989{{$e->name}}')">{{ $e->name  }}</span>
                        @endforeach
                      </div>
                    </div>
	                </div>
                    <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> المقاول</label>
	              </div>
                @endif
                <div class="form-group">
	                <div class="col-sm-10">
                    
	                  <textarea onkeyup="subject()" style="resize: none; color: black;" rows="5" required="" class="form-control" name="sujet" id="sujet" >{{$eng->sujet}}</textarea>
	                </div>
                    <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">  الموضوع </label>
	              </div>
                <div class="form-group">
	                <div class="col-sm-10">
                    
	                  <textarea style="resize: none; color: black;" rows="5" required="" class="form-control" name="real_sujet" id="real_sujet" >{{$eng->real_sujet}}</textarea>
	                </div>
                    <label class="control-label col-sm-2" style="text-align : right; font-weight: bold; color : red;" for="title">  موضوع الالتزام </label>
	              </div>
                
                
                @if($type == "juridique" or $type == "comptable" or $type == "FSDRS" or $type =="mixte")
                <div class="form-group">
                  <input type="hidden" name="bank_id" value="{{ $bank->id }}">
	                <div class="col-sm-10">
	                  <input value="{{ $bank->bank_acc }}" required="" type="text" style="color: black;" class="form-control" name="bank_acc">
	                </div>
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> الحساب البنكي </label>
	              </div>
                <div class="form-group">
	                <div class="col-sm-10">
	                  <input value="{{ $bank->bank_user }}" required="" type="text" style="color: black;" class="form-control" name="bank_user">
	                </div>
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">المفتوح بإسم</label>
	              </div>
                <div class="form-group">
	                <div class="col-sm-10">
	                  <select required="" style="color: black;" class="form-control" name="bank">
                    <option selected style="visibility : hidden" value="{{ $bank->bank }}">{{ $bank->bank }}</option>
                    @foreach($banques as $banque)
                      <option value="{{ $banque->nom }}" >{{ $banque->nom }} - {{ $banque->abr }}</option>
                    @endforeach
                    </select>
	                </div>
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">البنك</label>
	              </div>
                <div class="form-group">
	                <div class="col-sm-10">
	                  <input value="{{ $bank->bank_agc }}" required="" type="text" style="color: black;" class="form-control" name="bank_agc">
	                </div>
                    <label  class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">الوكالة</label>
	              </div>
            @endif
            <table id="engagement" class="col-sm-12" dir="ltr">
                <tr>
                    <th>الرصيد الجديد</th>
                    <th> المبلغ المقترح </th>
                    <th>   الرصيد القديم  </th>
                    <th>     العناوين    </th>
                </tr>  
                <tr>	
                    <td><input value="@if($eng->etude_2 != 0 and $eng->etude_2 != NULL){{number_format((float)$eng->etude_2, 2, '.', ',')}}@endif" name="etude_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->etude != 0 and $eng->etude != NULL){{number_format((float)$eng->etude, 2, '.', ',')}}@endif" name="etude"  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$"></td>
                    <td name="etude_0" >@if($eng0->etude != 0 and $eng0->etude != NULL){{number_format((float)$eng0->etude, 2, '.', ',')}}@endif</td>
                    <td>   الدراســــــات و/أو الهندســــــة  </td>
                    <td>01</td>
                </tr>
                <tr>	
                    <td><input value="@if($eng->genie_civil_2 != 0 and $eng->genie_civil_2 != NULL){{number_format((float)$eng->genie_civil_2, 2, '.', ',')}}@endif" name="genie_civil_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->genie_civil != 0 and $eng->genie_civil != NULL){{number_format((float)$eng->genie_civil, 2, '.', ',')}}@endif" name="genie_civil" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="genie_civil_0" >@if($eng0->genie_civil != 0 and $eng0->genie_civil != NULL){{number_format((float)$eng0->genie_civil, 2, '.', ',')}}@endif</td>
                    <td>    البناء و ما يربط به  هندسة مدنية    </td>
                    <td>02</td>
                </tr>
                <tr>	
                    <td><input value="@if($eng->travaux_publics_2 != 0 and $eng->travaux_publics_2 != NULL){{number_format((float)$eng->travaux_publics_2, 2, '.', ',')}}@endif" name="travaux_publics_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->travaux_publics != 0 and $eng->travaux_publics != NULL){{number_format((float)$eng->travaux_publics, 2, '.', ',')}}@endif" name="travaux_publics" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="travaux_publics_0">@if($eng0->travaux_publics != 0 and $eng0->travaux_publics != NULL){{number_format((float)$eng0->travaux_publics, 2, '.', ',')}}@endif</td>
                    <td>   الأشــــــغال العمــــــومية   </td>
                    <td>03</td>
                </tr>
                <tr>	
                    <td><input value="@if($eng->equipements_2 != 0 and $eng->equipements_2 != NULL){{number_format((float)$eng->equipements_2, 2, '.', ',')}}@endif" name="equipements_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->equipements != 0 and $eng->equipements != NULL){{number_format((float)$eng->equipements, 2, '.', ',')}}@endif" name="equipements" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="equipements_0" >@if($eng0->equipements != 0 and $eng0->equipements != NULL){{number_format((float)$eng0->equipements, 2, '.', ',')}}@endif</td>
                    <td>    ألات و تجهيـــــــــــــــــــــــزات   </td>
                    <td>04</td>
                </tr>
                <tr>	
                    <td><input value="@if($eng->materiel_transport_2 != 0 and $eng->materiel_transport_2 != NULL){{number_format((float)$eng->materiel_transport_2, 2, '.', ',')}}@endif"name="materiel_transport_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->materiel_transport != 0 and $eng->materiel_transport != NULL){{number_format((float)$eng->materiel_transport, 2, '.', ',')}}@endif" name="materiel_transport" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="materiel_transport_0" >@if($eng0->materiel_transport != 0 and $eng0->materiel_transport != NULL){{number_format((float)$eng0->materiel_transport, 2, '.', ',')}}@endif</td>
                    <td>  عتاد النقــــــل ا ولتفريـــــــغ  </td>
                    <td>05</td>
                </tr>
                <tr>	
                    <td><input value="@if($eng->formation_2 != 0 and $eng->formation_2 != NULL){{number_format((float)$eng->formation_2, 2, '.', ',')}}@endif" name="formation_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->formation != 0 and $eng->formation != NULL){{number_format((float)$eng->formation, 2, '.', ',')}}@endif" name="formation" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="formation_0" >@if($eng0->formation != 0 and $eng0->formation != NULL){{number_format((float)$eng0->formation, 2, '.', ',')}}@endif</td>
                    <td>    التكويــــــــــــــــــــــــــــــــن   </td>
                    <td>06</td>
                </tr>
                <tr>	
                    <td><input value="@if($eng->travaux_exterieurs_2 != 0 and $eng->travaux_exterieurs_2 != NULL){{number_format((float)$eng->travaux_exterieurs_2, 2, '.', ',')}}@endif" name="travaux_exterieurs_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->travaux_exterieurs != 0 and $eng->travaux_exterieurs != NULL){{number_format((float)$eng->travaux_exterieurs, 2, '.', ',')}}@endif" name="travaux_exterieurs" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="travaux_exterieurs_0" >@if($eng0->travaux_exterieurs != 0 and $eng0->travaux_exterieurs != NULL){{number_format((float)$eng0->travaux_exterieurs, 2, '.', ',')}}@endif</td>
                    <td>  تقديم الخدمـــــات الخارجيـــــة    </td>
                    <td>07</td>
                </tr>
                <tr>	
                    <td><input value="@if($eng->publicite_2 != 0 and $eng->publicite_2 != NULL){{number_format((float)$eng->publicite_2, 2, '.', ',')}}@endif" name="publicite_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->publicite != 0 and $eng->publicite != NULL){{number_format((float)$eng->publicite, 2, '.', ',')}}@endif" name="publicite" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="publicite_0" >@if($eng0->publicite != 0 and $eng0->publicite != NULL){{number_format((float)$eng0->publicite, 2, '.', ',')}}@endif</td>
                    <td>الإشهــــــــــــــــــــــــــــار </td>
                    <td>08</td>
                </tr>
                <tr>	
                  <td><input value="@if($eng->fonds_2 != 0 and $eng->fonds_2 != NULL){{number_format((float)$eng->fonds_2, 2, '.', ',')}}@endif" name="fonds_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->fonds != 0 and $eng->fonds != NULL){{number_format((float)$eng->fonds, 2, '.', ',')}}@endif" name="fonds" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="fonds_0" >@if($eng0->fonds != 0 and $eng0->fonds != NULL){{number_format((float)$eng0->fonds, 2, '.', ',')}}@endif</td>
                    <td> مال متداول إضافي </td>
                    <td>09</td>
                </tr>
                <tr>	
                  <td><input value="@if($eng->env_2 != 0 and $eng->env_2 != NULL){{number_format((float)$eng->env_2, 2, '.', ',')}}@endif" name="env_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                  <td><input value="@if($eng->env != 0 and $eng->env != NULL){{number_format((float)$eng->env, 2, '.', ',')}}@endif" name="env" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                  <td name="env_0" >@if($eng0->env != 0 and $eng0->env != NULL){{number_format((float)$eng0->env, 2, '.', ',')}}@endif</td>
                  <td> المنشات الأساسية المحيطة  </td>
                  <td>10</td>
                </tr>
                <tr>	
                  <td><input value="@if($eng->terrain_2 != 0 and $eng->terrain_2 != NULL){{number_format((float)$eng->terrain_2, 2, '.', ',')}}@endif" name="terrain_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                  <td><input value="@if($eng->terrain != 0 and $eng->terrain != NULL){{number_format((float)$eng->terrain, 2, '.', ',')}}@endif" name="terrain" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                  <td name="terrain_0" >@if($eng0->terrain != 0 and $eng0->terrain != NULL){{number_format((float)$eng0->terrain, 2, '.', ',')}}@endif</td>
                    <td>الأرضية </td>
                    <td>11</td>
                </tr>
                <tr>	
                  <td><input value="@if($eng->interets_2 != 0 and $eng->interets_2 != NULL){{number_format((float)$eng->interets_2, 2, '.', ',')}}@endif" name="interets_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                  <td><input value="@if($eng->interets != 0 and $eng->interets != NULL){{number_format((float)$eng->interets, 2, '.', ',')}}@endif" name="interets" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                  <td name="interets_0" >@if($eng0->interets != 0 and $eng0->interets != NULL){{number_format((float)$eng0->interets, 2, '.', ',')}}@endif</td> 
                    <td>الفوائد الاضافية </td>
                    <td>12</td>
                </tr><tr>	
                    <td><input value="@if($eng->douane_2 != 0 and $eng->douane_2 != NULL){{number_format((float)$eng->douane_2, 2, '.', ',')}}@endif" name="douane_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->douane != 0 and $eng->douane != NULL){{number_format((float)$eng->douane, 2, '.', ',')}}@endif" name="douane" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="douane_0" >@if($eng0->douane != 0 and $eng0->douane != NULL){{number_format((float)$eng0->douane, 2, '.', ',')}}@endif</td>
                    <td>حقوق الجمرك و الرسوم </td>
                    <td>13</td>
                </tr><tr>	
                    <td><input value="@if($eng->stock_2 != 0 and $eng->stock_2 != NULL){{number_format((float)$eng->stock_2, 2, '.', ',')}}@endif" name="stock_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->stock != 0 and $eng->stock != NULL){{number_format((float)$eng->stock, 2, '.', ',')}}@endif" name="stock" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="stock_0" >@if($eng0->stock != 0 and $eng0->stock != NULL){{number_format((float)$eng0->stock, 2, '.', ',')}}@endif</td>
                                        
                    <td>المخزون الأدنى </td>
                    <td>14</td>
                </tr>
                <tr>	
                  <td><input value="@if($eng->suiv_2 != 0 and $eng->suiv_2 != NULL){{number_format((float)$eng->suiv_2, 2, '.', ',')}}@endif" name="suiv_2" readOnly  class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->suiv != 0 and $eng->suiv != NULL){{number_format((float)$eng->suiv, 2, '.', ',')}}@endif" name="suiv" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="suiv_0" >@if($eng0->suiv != 0 and $eng0->suiv != NULL){{number_format((float)$eng0->suiv, 2, '.', ',')}}@endif</td>
                    <td> متـــــابعة </td>
                    <td>15</td>
                </tr>
                <tr>	
                  <td><input value="@if($eng->tech_2 != 0 and $eng->tech_2 != NULL){{number_format((float)$eng->tech_2, 2, '.', ',')}}@endif" name="tech_2" readOnly  class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->tech != 0 and $eng->tech != NULL){{number_format((float)$eng->tech, 2, '.', ',')}}@endif" name="tech" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="tech_0" >@if($eng0->tech != 0 and $eng0->tech != NULL){{number_format((float)$eng0->tech, 2, '.', ',')}}@endif</td>
                    <td> مراقبة تقنــية </td>
                    <td>16</td>
                </tr>
                <tr>	
                  <td><input value="@if($eng->labo_2 != 0 and $eng->labo_2 != NULL){{number_format((float)$eng->labo_2, 2, '.', ',')}}@endif" name="labo_2" readOnly  class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->labo != 0 and $eng->labo != NULL){{number_format((float)$eng->labo, 2, '.', ',')}}@endif" name="labo" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="labo_0" >@if($eng0->labo != 0 and $eng0->labo != NULL){{number_format((float)$eng0->labo, 2, '.', ',')}}@endif</td>
                    <td> مخبــــــر </td>
                    <td>17</td>
                </tr>
                <tr>	
                    <td><input value="@if($eng->montant_libre_2 != 0 and $eng->montant_libre_2 != NULL){{number_format((float)$eng->montant_libre_2, 2, '.', ',')}}@endif" name="montant_libre_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->montant_libre != 0 and $eng->montant_libre != NULL){{number_format((float)$eng->montant_libre, 2, '.', ',')}}@endif" name="montant_libre" style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="montant_libre_0" >@if($eng0->montant_libre != 0 and $eng0->montant_libre != NULL){{number_format((float)$eng0->montant_libre, 2, '.', ',')}}@endif</td>
                                        
                    <td>   مبلـــــــــــــــــــــــغ غير موزع  </td>
                    <td>18</td>
                </tr>
                <tr>	
                    <td><input value="@if($eng->total_2 != 0 and $eng->total_2 != NULL){{number_format((float)$eng->total_2, 2, '.', ',')}}@endif" name="total_2" readonly class="form-control" style="background-color: transparent; padding : 0; text-align : center; color : black;"></td>
                    <td><input value="@if($eng->total != 0 and $eng->total != NULL){{number_format((float)$eng->total, 2, '.', ',')}}@endif" name="total" id="total" readonly  style="padding : 0; text-align: center;" class="input_num form-control" type="text" pattern ="^(\s*-?\d+(\.\d+)?)(\s*,\s*-?\d+(\.\d{1,2})?)*$" ></td>
                    <td name="total_0" >@if($eng0->total != 0 and $eng0->total != NULL){{number_format((float)$eng0->total, 2, '.', ',')}}@endif</td>
                    <td style="border : none; text-align: right;" >المجمـــــــــــــــوع</td>
                    <td style="border : none;" ></td>
                </tr>
            </table>
            <br>
            <br>

              <div class="form-group">
                <div class="col-sm-10">
                  <input name="num_visa" value="{{ $eng->num_visa ?? '' }}" type="text" class="form-control" id="numero" name="num_visa">
                </div>
                  <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">   رقم تأشيرة المراقب المالي </label>
              </div>
              <div class="form-group">
                <div class="col-sm-10">
                  <input name="date_visa" value="{{ $eng->date_visa ?? '' }}" type="date" class="form-control" id="numero" name="date_visa">
                </div>
                  <label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> تاريخ تأشيرة المراقب المالي </label>
              </div>
	              <!-- Buttons -->
	              <div class="form-group" align="center">
	                <!-- Buttons -->
	                <div class="col-sm-offset-2 col-sm-9">
	                  <button type="submit" class="btn btn-primary">حفــــظ</button>
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


<div id="myModal" class="modal" style="display: block;">

  <!-- The Close Button -->

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01" src="{{ url('img/loading.gif')}}">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
@endsection

@section('js_scripts')

<script type="text/javascript">
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      var rebriques = ['etude','genie_civil','travaux_publics','equipements','materiel_transport','formation','travaux_exterieurs','publicite','fonds','env','terrain','interets','douane','stock','suiv','tech','labo','montant_libre','total'];
      var index = rebriques.indexOf(event.srcElement.name);
      if(index < rebriques.length-1){
        index += 1;
      }
      var ele = rebriques[index];
      document.getElementsByName(ele)[0].focus();
      document.getElementsByName(ele)[0].select();
      console.log(event.srcElement.name);
    }
  });
});

</script>
<script type="text/javascript">
  window.onload = function(){
    
    document.getElementById('myModal').style.display = "none";
    const real_sujet = "{{$eng->real_sujet}}";
    if(real_sujet != null){
      //subject();
    }
    
  };
  
</script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


function subject(){
  type = "{{$type}}";
  deal = null;
  deal_num = null;
  deal_date = null;
  if(document.getElementsByName('deal_type')[0] != null){
    deal = document.getElementsByName('deal_type')[0].value;
  }
  if(document.getElementsByName('deal_num')[0] != null){
    deal_num = document.getElementsByName('deal_num')[0].value;
  }
  if(document.getElementsByName('deal_date')[0] != null){
    deal_date = document.getElementsByName('deal_date')[0].value;
  }
  e = document.getElementById('comp_input');
  ret = document.getElementById('retrait');
  sujet = document.getElementById('sujet').value;
  intitule = document.getElementById('intitule_ar').value;
  if(sujet ==""){
    if(type == "juridique"){

      sujet = "مشروع "+intitule;
    }else if(type=="comptable"){

      sujet = "مشروع "+intitule;
    }else if(type=="fiche_eco"){

      var year = new Date().getFullYear();
      var new_num = year+"/"+"01";
      year -=1;
      sujet = "تكفل بالأرصدة الناتجة عن الفرق بين الالتزامات المحاسبية و الدفعات المعتمدة لسنة "+year;
    }else if(type=="FSDRS"){

      sujet = "مشروع "+intitule;
    }else if(type=="mixte"){

      sujet ="مشروع "+intitule;
    }

  }
  

  

  if(e != null){
    e  = e.value;
  }
  
  annexe = document.getElementsByName('annexe')[0].value;
  

  
  if (ret != null) {
    ret_val = "بطافة سحب بطاقة "+ret.value+" المتعلقة ب";
    txt = ret_val;
  }else{
    txt = "";
  }

  if(type == "juridique"){
    txt +="الالتزام القانوني ";

  }else if(type=="comptable"){
    txt +="الالتزام المحاسبي ";

  }else if(type=="fiche_eco"){
    txt +="بطاقة اقثصاد  ";

  }else if(type=="FSDRS"){
    txt +="الالتزام  ";

  }else if(type=="mixte"){
    txt +="الالتزام  ";

  }else {
    txt +="تكفل بمقرر ";
  } 
  if(annexe !="" && annexe != null){
    if(type =="juridique" || type =="FSDRS" || type=="mixte"){
      txt +="بالملحق " +" "+annexe+" ";
    }else{
      txt +="في إطار الملحق " +" "+annexe+" ";
    }
    
  }
  if(deal !="مقرر" && deal != null){
    txt += "ب"+deal+" ";
  }
  if(deal_num != null && deal_num!=""){
    txt+= " رقم "+deal_num;
  }
  if(deal_date != null && deal_date!=""){
    txt+=" بتاريخ "+deal_date+" ";
  }
  if(e != "" && e != null){
    txt +=" المقدمة من طرف "+" "+e+" ";
  }
  txt +=" ل"+sujet;

  sujet = sujet.replaceAll('  '," ");
  sujet = sujet.replaceAll('   '," ");
  sujet = sujet.replaceAll("    "," ");
  
  txt = txt.replaceAll('  '," ");
  txt = txt.replaceAll('   '," ");
  txt = txt.replaceAll("    "," ");

  document.getElementById('sujet').value = sujet;

  
  document.getElementById('real_sujet').value = txt;
  
  
  return txt;
}


function popupwindow(url, title, w, h) {
  var left = (screen.width/2)-(w/2);
  var top = (screen.height/2)-(h/2);
  return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 

function add_e(){
  var myWindow = popupwindow("/entreprise", "إضافة مقـــاول", "800","500");
  var loop = setInterval(function() {   
    if(myWindow.closed) {  
        clearInterval(loop);  
        var url = "/e_get";
        $.ajax({
            url: url,
            type:"GET", 
            cache: false,
            success:function(response) {
              console.log(response);
            url = "";
              for(var i =0; i< response.length; i++){
                var e = response[i];
                url +='<span style="color: black; cursor: pointer;" class="comps_clss" onclick="comps_changed(\''+e.id+'1989raouf1989'+e.name+'\')">'+e.name+'</span>';
                
              }
              document.getElementById('es').innerHTML = url;
            },
            error:function(response) {
            console.log(response);
            },

          });
        }  
  }, 1000); 
}

function op_like(value){
  document.getElementById("myDropdown").style.display ="block";
  var input, filter, ul, li, a, i;
  filter = value.toUpperCase();
  a = document.getElementsByClassName("ops_clss");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
function comp_like(e,value){
  
  document.getElementById("myDropdown_comp").style.display ="block";
  if(e.key === "Escape" || e.key === "Esc") {
    document.getElementById("myDropdown_comp").style.display ="none";
  }
  var input, filter, ul, li, a, i;
  filter = value.toUpperCase();
  a = document.getElementsByClassName("comps_clss");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
function comps_changed(value){
  document.getElementById("myDropdown_comp").style.display ="none";

  var id = value.split("1989raouf1989")[0];
  var name =  value.split('1989raouf1989')[1];
  document.getElementById("comp_input").value = name;
  document.getElementsByName("bank_user")[0].value = name;
  document.getElementById('entreprise').value = id;
  subject();

}

function ops_changed(value){
  document.getElementById("myDropdown").style.display ="none";

  var type = "{{ $type }}";
  var id = value.split("1989raouf1989")[0];
  var ar = value.split('1989raouf1989')[1];
  var numero =  value.split('1989raouf1989')[2];
  document.getElementById("op_input").value = numero;
  console.log(id+" "+ar);
  document.getElementById('id_op').value = id;
  document.getElementById('intitule_ar').value = ar;

  fiche_num(id);

  if(type != "juridique" && type !="inscription"){
    var url = "/get_last/"+id;
    console.log(url);
    $.ajax({
        url: url,
        type:"GET", 
        cache: false,
        success:function(response) {
        console.log(response);
        set_old(response);
        //fiche_num(response);
        },
        error:function(response) {
        console.log(response);
        },

      });
  }

}

function change_nulls(form){
  var type = "{{ $type }}";
  var sujet = document.getElementById('sujet').value;  

  var retrait = document.getElementById('retrait');
  if(retrait != null){
    var ret_sujet = "بطافة سحب بطاقة "+document.getElementById('retrait').value+" المتعلقة ب";
    sujet = ret_sujet + "1989raouf1989"+sujet;
    document.getElementById('sujet').value = sujet; 
  }

  

  var inputs = document.getElementsByClassName("input_num");
    for(var i = 0;  i < inputs.length; i++){
      if(inputs[i].value ==""){
        inputs[i].value = 0.00;
      }else{
        inputs[i].value = inputs[i].value.replaceAll(',','');
      }
    }
    var rebriques = ['etude','genie_civil','travaux_publics','equipements','materiel_transport','formation','travaux_exterieurs','publicite','fonds','env','terrain','interets','douane','stock','suiv','tech','labo','montant_libre','total'];
    for(var i = 0;i< rebriques.length; i++){
      var val = document.getElementsByName(rebriques[i]+"_2")[0];
      if(val.value != null){
        val.value = val.value.replaceAll(",","");
      }
      
    }
    form.submit();
    return true;

}
function fiche_num(id){
  var type = "{{$type}}";
  if(type == "fiche_eco"){
    var year = new Date().getFullYear();
    var new_num = year+"/"+"01";
    year -=1;
    document.getElementsByName('numero_fiche')[0].value = new_num;
    document.getElementById('sujet').value = "تكفل بالأرصدة الناتجة عن الفرق بين الالتزامات المحاسبية و الدفعات المعتمدة لسنة "+year;
  }else{
    var url = "/get_last_fiche/"+id;
    console.log(url);
    $.ajax({
        url: url,
        type:"GET", 
        cache: false,
        success:function(response) {
          var value = response;
          if(value[0] != null){
            var old = value[0].numero_fiche;
            old = old.split("/")[1];
          }else{
            var old = "0";
          }
          
          var nv = ""+(parseInt(old) + 1);
          if(nv.length == 1){
            nv = "0"+nv;
          }
          var new_num = new Date().getFullYear()+"/"+nv;
          console.log(new_num);
          document.getElementsByName('numero_fiche')[0].value = new_num;
        },
        error:function(response) {
        console.log(response);
        },

      });
  }
  
}
function set_old(last){
  if(last[0] != null){
    var rebriques = ['etude','genie_civil','travaux_publics','equipements','materiel_transport','formation','travaux_exterieurs','publicite','fonds','env','terrain','interets','douane','stock','suiv','tech','labo','montant_libre','total'];
    for(var i = 0;i< rebriques.length; i++){
      if(last[0][rebriques[i]+"_2"] != null){
        document.getElementsByName(rebriques[i]+"_0")[0].innerHTML = numberWithCommas(last[0][rebriques[i]+"_2"]);
      }
      
    }
  }
  
}
function numberWithCommas(x) {
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(!x.includes('.')){
      x += ".00";
    }
    else{
      xs = x.split(".");
      x = xs[0] +"."+ xs[1].substring(0,2).replaceAll(',','0');
    }

    return x;
}

function somme(){
  var type = "{{ $type }}";
  var rebriques = ['etude','genie_civil','travaux_publics','equipements','materiel_transport','formation','travaux_exterieurs','publicite','fonds','env','terrain','interets','douane','stock','suiv','tech','labo','montant_libre','total'];
    
  var S = 0;
  var S_old = 0;
    for(var i = 0;  i < rebriques.length -1; i++){
      var l = null;
      var input = document.getElementsByName(rebriques[i])[0];
      var old = document.getElementsByName(rebriques[i]+"_0")[0];
      //console.log("old "+old.innerHTML);
      var num = 0;
      
      if(input.value !="" && input.value !="-"){
        var clean = input.value.replaceAll(",","");
        num = parseFloat(clean);
        if(type=="decision" || type=="fiche_eco"){
          l= l + num;
        }else{
          l= l - num;
        }
        
        S = S + num;
        //console.log("num " +num+", clean "+clean+", S "+S );
        var txt = S.toLocaleString("en");
        if(!txt.includes(".")){
          txt += ".00";
        }
        document.getElementById('total').value = txt;
      }
      
      if(old.innerHTML != ""){
        var clean = old.innerHTML.replaceAll(",","");
        
        var num_old = parseFloat(clean);
        
        l= l + num_old;
        S_old = S_old + num_old;
        var txt_old = S_old.toLocaleString("en");
        if(!txt_old.includes(".")){
          txt_old += ".00";
        }
        document.getElementsByName('total_0')[0].innerHTML = txt_old;
        //console.log("num " +num_old+", clean "+clean+", l "+l );
      }
      if((type == "comptable" || type == "decision" || type=="fiche_eco" || type=="FSDRS" || type=="mixte") && l!=null ){
        if(l <0){
            alert('حذار ! الرصيد المقترح اكبر من الرصيد القديم')
          }
        var txt = l.toLocaleString("en");
        if(!txt.includes(".")){
          txt += ".00";
        }
        document.getElementsByName(rebriques[i]+"_2")[0].value = txt;
        //console.log(rebriques[i]);
      }else if(type =="juridique"){

      }else{
        if(l != null){
          if(l <0 && type !="inscription"){
            alert('حذار ! الرصيد المقترح اكبر من الرصيد القديم')
          }
          l = num;
          var txt = l.toLocaleString("en");
          if(!txt.includes(".")){
            txt += ".00";
          }
          document.getElementsByName(rebriques[i]+"_2")[0].value = txt;
        }
        
      }
    }
    
    if(type != "juridique" ){
        var total_0 = document.getElementsByName('total_0')[0].innerHTML;
        var total = document.getElementsByName('total')[0].value;
        var total_2 = document.getElementsByName('total_2')[0];
        var t = 0;
        if(total_0 != ""){
          var clean = total_0.replaceAll(",","");
          
          var num = parseFloat(clean);
          
          t= t + num;
        }
        if(total != ""){
          var clean = total.replaceAll(",","");
          
          var num = parseFloat(clean);
          if(type == "comptable" || type=="FSDRS" || type=="mixte"){
            t= t - num;
          }else if(type == "decision" || type=="fiche_eco"){
            t =t +num;
          }else{
            t = num;
          }
        
        }
      }
      
      var txt = t.toLocaleString("en");
        if(!txt.includes(".")){
          txt += ".00";
        }
        total_2.value = txt;
    
}
$( ".input_num" ).on('keyup', function () {
    
    if(this.value !="" && !this.value.includes(".") && !this.value == "-"){
        var clean = this.value.replaceAll(",","");

        //console.log("num " +num+", clean "+clean+", txt "+txt );
        this.value = txt;
    }
    somme();
    
});



</script>
@endsection

