@extends('comptabilite.master_compta')
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
table th {
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
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: right;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;

}
.tablinks {
    width : 50%;

}
</style>
@endsection
@section('content')

<div class="row">
	
	<div >
        <!-- Tab links -->
        <div class="tab">
        <button class="tablinks active" onclick="openCity(event, 'engs')">الاتزامـــــات</button>
        <button class="tablinks" onclick="openCity(event, 'pays')">الدفعـــــات</button>
        </div>


		<!--Project Activity start-->
		<section id="engs" class="tabcontent panel panel-info" style="display: table;" lang="ar" dir="rtl">
			<div class="panel-heading"></div>
				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody >
				      <tr>
                        <th>#</th>
                        <th>المحاسب</th>
                        <th>رقم البطاقة</th>
                        <th>تاريخ الأدخال</th>
                        <th>تاريخ أخر تعديل</th>
                        
                            
                      </tr>
                      <tr>
                        <?php $i = 0; ?>
                        @foreach($engs as $a)
                        <?php $i++; ?>

                            <tr style="font-weight : bold">

                                <td>
                                    <span><h5><strong>{{$i}}</strong></h5></span>
                                </td>
                                <td>
                                    <span><h5><strong>{{$a->full_name}}</strong></h5></span>
                                </td>
                                <td>
                                    <span><h5><strong>{{$a->numero_fiche}}</strong></h5></span>
                                </td>

                                <td>
                                    <span><h5><strong>{{$a->inserted_at}}</strong></h5></span>
                                </td>
                                <td>
                                    <span><h5><strong>{{$a->updated_at}}</strong></h5></span>
                                </td>
                                
                            </tr>
                        @endforeach
                      </tr>
				    </tbody>
				  </table>
		</section>
        <section id="pays" class="tabcontent panel panel-info" style="display: none;" lang="ar" dir="rtl">
			<div class="panel-heading"></div>
				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody >
				      <tr>
                        <th>#</th>
                        <th>المحاسب</th>
                        <th>رقم كشف الحساب</th>
                        <th>تاريخ الأدخال</th>
                        <th>تاريخ أخر تعديل</th>
                        
                            
                      </tr>
                      <tr>
                        <?php $i = 0; ?>
                        @foreach($pays as $a)
                        <?php $i++; ?>

                            <tr style="font-weight : bold">

                                <td>
                                    <span><h5><strong>{{$i}}</strong></h5></span>
                                </td>
                                <td>
                                    <span><h5><strong>{{$a->full_name}}</strong></h5></span>
                                </td>
                                <td>
                                    <span><h5><strong>{{$a->num}}</strong></h5></span>
                                </td>
                                <td>
                                    <span><h5><strong>{{$a->inserted_at}}</strong></h5></span>
                                </td>
                                <td>
                                    <span><h5><strong>{{$a->updated_at}}</strong></h5></span>
                                </td>
                                
                            </tr>
                        @endforeach
                      </tr>
				    </tbody>
				  </table>
		</section>
		<!--Project Activity end-->
	</div>
</div>
<div style="display: none;" id="filters-secteur"></div>
<div style="display: none;" id="filters-chapitre"></div>
<div style="display: none;" id="filters-numero"></div>

<div id="myModal" class="modal" style="display: block;">

  <!-- The Close Button -->

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01" src="{{ url('img/loading.gif') }}">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
@endsection

@section('js_scripts')
<script type="text/javascript">
window.onload = function(){
	document.getElementById('myModal').style.display = "none";
};
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
@endsection