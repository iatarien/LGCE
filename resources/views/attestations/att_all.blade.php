@extends('layouts.master')
@section('style')
<style>
table {
	table-layout: fixed;
  color : black;
  font-weight : bold;
}
#demo-table {
		width: 100%;
}
table th {
	width: 100px;
  text-align : right;
}
table td {
	width: 100px;
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

</style>
@endsection
@section('content')

<div id="main" class="row main">
  <div align="center">
    <br>
    @if($type=="att_commune")
    <a class="btn btn-primary" href="/select_att/att_commune"> 
          إضافة شهادة إدارية لتحرير إعتمادات الدفع 
    </a>
          <?php $title = "شهادات تحرير إعتمادات الدفع"; ?>
  
    @elseif($type=="att_retard")
    <a class="btn btn-primary" href="/select_att/att_retard"> 
        إضافة شهادة إدارية لتأخر الدفع   
    </a>
          
          <?php $title = "شهادات تأخر التسديد"; ?>
    @elseif($type=="att_error")
    <a class="btn btn-primary" href="/select_att/att_error"> 
           إضافة شهادة إدارية لتصحيح رقم الحساب 
    </a>
          <?php $title = "شهادات تصحيح رقم الحساب"; ?>
    @endif

    <br><br>
  </div>
	<div >
		<!--Project Activity start-->
		<section class="panel panel-info" style="display: table;" lang="ar" dir="rtl">
			<div class="panel-heading">   {{$title}} </div>
				  <table id="demo-table" class="table table-bordered personal-task resizable">
				    <tbody id="ops_place">
                        <tr>
                            <th style="width : 20%">العملية</th>
                            <th style="width : 40%">المقاول </th>
                            <th style="width : 20%">الحصة</th>
                            <th>معاينة</th>
                            <th>حذف</th>
                        </tr>
                        @foreach($attestations as $att)
                          <tr>
                            <td>{{$att->numero}}</td>
                            <td>{{$att->name}}</td>
                            <td>{{$att->lot}}</td>
                            <td><a href="/att_all/{{$type}}/{{$att->att_id}}" class="btn btn-default">معاينة</a></td>
                            <td><a onclick="return confirm('هل أنت متأكد من أنك تريد الحذف ؟')" href="/delete_att_all/{{$type}}/{{$att->att_id}}" class="btn btn-danger">حذف</a></td>
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
