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
	<div class="col-sm-12 portlets" lang="" dir="ltr" style="margin-right: 10%;"  >
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-left">
                     Borderau

            </div>
	        <div class="clearfix"></div>
	      </div>
	      <div class="panel-body">
	        <div class="padd">
                <!-- Buttons -->
            <div class="form-group" align="center">
                    <!-- Buttons -->
                    <div class="col-sm-offset-2 col-sm-9">
                    <button type="button" onclick="borderau()" class="btn btn-success">Ajouter</button>
                    </div>
                </div>
                <br><br>
	          <div class="form quick-post">
	            <!-- Edit profile form (not working)-->
	            <form class="form-horizontal" autocomplete="off" action="/insert_borderau" method="POST">
                  <input type="hidden" value="{{$type}}" name="type" >
                  @csrf
                    <table id="" class="col-sm-12" dir="rtl">
                      <tbody id="engagement">
                        <tr>
                            <th>     Supprimer    </th>
                            <th>Montant  </th>
                            <th> Entreprise </th>
                            @if($type =="eng")
                            <th>    Objet d'engagement  </th>
                            @else
                            <th>   Objet de paiement </th>
                            @endif
                            
                        </tr>  
                      </tbody> 
                    </table>
                    <br><br><br>
                    <!-- Buttons -->
                    <div class="form-group" align="center">
                        <!-- Buttons -->
                        <div class="col-sm-offset-2 col-sm-9">
                        <button type="submit" class="btn btn-primary">Sauvegarder</button>
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

<div id="the_op" style="display: none;"></div>

@endsection

@section('js_scripts')

<script type="text/javascript">
  window.onload = function(){
    document.getElementById('loading').style.display = "none";
  };
  function suprimer(id){
    document.getElementById(id).remove();
  }
  function borderau(){
    const type = "{{$type}}";
    var myWindow = window.open('/select_bord/'+type);

    var loop = setInterval(function() {   
    if(myWindow.closed) {  
        clearInterval(loop);  
        const type = "{{$type}}";
        //var id_bord = "{{ Session::get('id_av')}}";
        var id_bord = myWindow.id_bord;
        var url ='';
        console.log("av : "+id_bord);
        if(type=="eng"){
           url = "/get_eng/"+id_bord;
        }else{
           url = "/get_pay/"+id_bord;
        }

        console.log("url : "+url);
        $.ajax({
            url: url,
            type:"GET", 
            cache: false,
            success:function(response) {
              //console.log(response);
              if(type =="eng"){
                set_all(id_bord,response);
              }else{
                set_all2(id_bord,response);
              }
              

            },
            error:function(response) {
              console.log(response);
            },

          });
      }  
    }, 1000);
  }

  function set_all(id_bord,data){
    console.log(data[0]);
    var row = "<tr id='"+id_bord+"'><td>";
    row +="<bouton onclick='suprimer("+id_bord+")' class='btn btn-danger'>X</button></td><td>";
    row +=numberWithCommas(data[0].montant)+"</td><td>";
    row +=data[0].name+"</td><td>";
    row +=data[0].real_sujet+"</td>";
    row +='<input type="hidden" value="'+id_bord+'" name="eng_bord_id_'+id_bord+'" >';
    row += "</tr>";
    //console.log(row);
    var tab = document.getElementById('engagement');
    tab.innerHTML += row;
  }
  function set_all2(id_bord,data){
    console.log(data[0]);
    var row = "<tr id='"+id_bord+"'><td>";
    row +="<bouton onclick='suprimer("+id_bord+")' class='btn btn-danger'>X</button></td><td>";
    row +=numberWithCommas(data[0].to_pay)+"</td><td>";
    row +=data[0].name+"</td><td>";
    var real_sujet = subject2(data[0].deal_type,data[0].deal_num,data[0].deal_date,
    data[0].lot,data[0].name,data[0].travaux_type,data[0].travaux_num); 
    row +=real_sujet+"</td>";
    row +='<input type="hidden" value="'+id_bord+'" name="eng_bord_id_'+id_bord+'" >';
    row += "</tr>";
    //console.log(row);
    var tab = document.getElementById('engagement');
    tab.innerHTML += row;
  }
  function numberWithCommas(x) {
    if(x == null){
      return "0.00";
    }
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(!x.includes('.')){
      x += ".00";
    }
    return x;
  }
  function subject2(deal,deal_num,deal_date,sujet,e,travaux_type,travaux_num){

    
    var txt = "";
    if(travaux_type != "فاتورة" && travaux_num != null){
      txt +=travaux_type+" "+travaux_num+" ";
    }

    if(travaux_type !="facture" && deal != null){
      txt += " "+deal+" ";
    }
    if(travaux_type !="facture" && deal_num != null){
      txt+= " N° "+deal_num;
    }
    if(travaux_type !="facture" && deal_date != null){
      txt+=" Du "+deal_date+" ";
    }

    if(e != "" && e != null){
      txt +=" De "+" "+e+" ";
    }
    txt +=" pour "+sujet;

    return txt;
}
  function set_all(id_bord,data){
    console.log(data[0]);
    var row = "<tr id='"+id_bord+"'><td>";
    row +="<bouton onclick='suprimer("+id_bord+")' class='btn btn-danger'>X</button></td><td>";
    row +=numberWithCommas(data[0].montant_eng)+"</td><td>";
    row +=data[0].name+"</td><td>";
    row +=data[0].real_sujet+"</td>";
    row +='<input type="hidden" value="'+id_bord+'" name="eng_bord_id_'+id_bord+'" >';
    row += "</tr>";
    //console.log(row);
    var tab = document.getElementById('engagement');
    tab.innerHTML += row;
  }

</script>
<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
@endsection

