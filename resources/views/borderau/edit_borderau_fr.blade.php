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
    text-align: center;
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
<script type="text/javascript">
function subject(deal,deal_num,deal_date,annexe,sujet,e,travaux_type,travaux_num,id){
    console.log("deal_type "+ deal);
    console.log("deal_num "+ deal_num );
    console.log("deal_date "+ deal_date);
    console.log("annexe "+ annexe);
    console.log("sujet "+ sujet);
    console.log("e "+ e);
    console.log("travaux_type "+ travaux_type);
    console.log("travaux_num "+ travaux_num);
    
    var txt = "تسوية"+" ";
    if(travaux_type != "فاتورة" && travaux_num != null){
      txt +=travaux_type+" رقم"+" "+travaux_num+" ";
    }
    if(annexe !="" && annexe != null){
      txt +="في إطار الملحق " +" "+annexe+" ";
    }
    if(travaux_type !="فاتورة" && deal != null){
      txt += "ل"+deal+" ";
    }else{
      txt += deal+" ";
    }
    if(deal_num != null){
      txt+= " رقم "+deal_num;
    }
    if(deal_date != null){
      txt+=" بتاريخ "+deal_date+" ";
    }

    if(e != "" && e != null){
      txt +=" المقدمة من طرف "+" "+e+" ";
    }
    txt +="ل"+sujet;

    document.getElementById('real_sujet'+id).innerHTML= txt;
}
</script>
@endsection
@section('content')
<div id="main" class="row main">
	<div class="col-sm-12 portlets" lang="ar" dir="ltr" style="margin-right: 10%;"  >
	    <div class="panel panel-default">
	      <div class="panel-heading">
	        <div class="pull-left">
            Borderau d'envoi

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
	            <form class="form-horizontal" autocomplete="off" action="/update_borderau" method="POST">
                  <input type="hidden" value="{{$id}}" name="id" >
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
                        @if($type =="eng")
                          @foreach($engs as $eng)
                          <tr id="{{$eng->id_eng}}">
                          <td>
                              <bouton onclick='suprimer("{{$eng->id_eng}}")' class='btn btn-danger'>X</button></td>
                              <td dir="ltr" style="widtd : 15%;">{{number_format((float)$eng->montant, 2, '.', ',')}} DA</td>
                              <td style="widtd : 20%;">{{$eng->name}}</td>
                              <td style="widtd : 50%;">{{$eng->real_sujet}}</td>
                              <input type="hidden" value="{{$eng->id_eng}}" name="eng_bord_id_{{$eng->id_eng}}" >
                          </tr>
                          @endforeach
                        @else
                          @foreach($engs as $eng)
                          <tr id="{{$eng->id_eng}}">
                          <td>
                              <bouton onclick='suprimer("{{$eng->id_eng}}")' class='btn btn-danger'>X</button></td>
                              <td dir="ltr" style="widtd : 15%;">{{number_format((float)$eng->to_pay, 2, '.', ',')}} DA</td>
                              <td style="widtd : 20%;">{{$eng->name}}</td>
                              <td id="real_sujet{{$eng->id_eng}}" style="widtd : 50%;">
                              <script>
                                  subject("{{$eng->deal_type}}","{{$eng->deal_num}}","{{$eng->deal_date}}",
                                  "","{{$eng->lot}}","{{$eng->name}}","{{$eng->travaux_type}}",
                                  "{{$eng->travaux_num}}","{{$eng->id_eng}}");
                              </script>
                              </td>
                              <input type="hidden" value="{{$eng->id_eng}}" name="eng_bord_id_{{$eng->id_eng}}" >
                          </tr>
                          @endforeach
                        @endif
                      </tbody> 
                    </table>
                    <br><br><br>
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
    const type = "{{$type}}"
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
  function subject2(deal,deal_num,deal_date,annexe,sujet,e,travaux_type,travaux_num,id){
    console.log("deal_type "+ deal);
    console.log("deal_num "+ deal_num );
    console.log("deal_date "+ deal_date);
    console.log("annexe "+ annexe);
    console.log("sujet "+ sujet);
    console.log("e "+ e);
    console.log("travaux_type "+ travaux_type);
    console.log("travaux_num "+ travaux_num);
    
    var txt = "تسوية"+" ";
    if(travaux_type != "فاتورة" && travaux_num != null){
      txt +=travaux_type+" رقم"+" "+travaux_num+" ";
    }
    if(annexe !="" && annexe != null){
      txt +="في إطار الملحق " +" "+annexe+" ";
    }
    if(travaux_type !="فاتورة" && deal != null){
      txt += "ل"+deal+" ";
    }else{
      txt += deal+" ";
    }
    if(deal_num != null){
      txt+= " رقم "+deal_num;
    }
    if(deal_date != null){
      txt+=" بتاريخ "+deal_date+" ";
    }

    if(e != "" && e != null){
      txt +=" المقدمة من طرف "+" "+e+" ";
    }
    txt +="ل"+sujet;

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
  function numberWithCommas(x) {
    x =  x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(!x.includes('.')){
      x += ".00";
    }
    return x;
  }
  function set_all2(id_bord,data){
    //console.log(data[0]);
    var row = "<tr id='"+id_bord+"'><td>";
    row +="<bouton onclick='suprimer("+id_bord+")' class='btn btn-danger'>X</button></td><td>";
    row +=numberWithCommas(data[0].to_pay)+"</td><td>";
    row +=data[0].name+"</td><td>";
    var real_sujet = subject2(data[0].deal_type,data[0].deal_num,data[0].deal_date,
    data[0].annexe,data[0].sujet,data[0].name,data[0].travaux_type,data[0].travaux_num); 
    row +=real_sujet+"</td>";
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

