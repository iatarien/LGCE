@extends('layouts.master')
@section('style')
<style type="text/css">
	label {
		font-weight: bold;
	}
	.form-control {
		display: initial;
		width: auto;
	}
	body {
		font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-weight: 500;
    line-height: 1.1;
    color: inherit;

	}
	

</style>
@endsection
@section('content')
<div id="main" class="row main">
<div class="col-lg-3"></div>
<div class="col-lg-9">
	<br><br><br>
	<h1>Logiciel de calcul de date</h1>
	<br><br>
	<form id="myForm" autocomplete="off">
		<div>
			<div class="form-group">
				<label for="start_date">Date de demarrage : </label> &emsp;
				<input class="form-control" type="text" autocomplete="off"  placeholder="jj/mm/aaaa"  pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d" id="start_date" name="start_date" required=""> &emsp;
				<label style="opacity: 0.5" for="start_date">exemple : 03/05/2012</label> &emsp;<br> <br> 
			</div>
			<div class="form-group">
			<label>Delai : </label> &emsp;
				<select id="years" required="" class="form-control">
					<option value="0" selected="" disabled="">Années</option>
					<option value = "0">0</option>
					<option value = "1">1</option>
					<option value = "2">2</option>
					<option value = "3">3</option>
					<option value = "4">4</option>
					<option value = "5">5</option>
					<option value = "6">6</option>
					<option value = "7">7</option>
					<option value = "8">8</option>
					<option value = "9">9</option>
					<option value = "10">10</option>
					<option value = "11">11</option>
				</select>&emsp;
				<select id="months" required="" class="form-control">
					<option value="0" selected disabled="">Mois</option>
					<option value = "0">0 mois</option>
					<option value = "1">1 mois</option>
					<option value = "2">2 mois</option>
					<option value = "3">3 mois</option>
					<option value = "4">4 mois</option>
					<option value = "5">5 mois</option>
					<option value = "6">6 mois</option>
					<option value = "7">7 mois</option>
					<option value = "8">8 mois</option>
					<option value = "9">9 mois</option>
					<option value = "10">10 mois</option>
					<option value = "11">11 mois</option>
					<option value = "12">12 mois</option>
				</select>&emsp;
				<input type="number" name="days" id="days" placeholder="0 jours" class="form-control" value=""><br><br><br>
			</div>
			<div align="">
				<button class="btn btn-warning" type="button" onclick="add_ods()">Ajouter ODS</button>
			</div>
			
			<input type="hidden"id="ods_counter" value="0">
			<div id="ODS_space"></div><br><br>

			
			<div class="form-group">
				<button class="btn btn-primary" type="submit">Calculer</button> &emsp;
				<label>Date de fin : </label> &emsp;
				<input class="form-control" placeholder="jj/mm/aaaa" readonly type="text" id="end_date" name="end_date"> <br> <br> 
			</div>
			
		</div>
	</form>
	<br><br><br><br><br><br>
	
</div>
@if($lang =="fr")
<div align="center">
		<button id="bouton_2" style="
		background-color: skyblue; /* Green */
		border: none;
		color: black;
		cursor: pointer;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;" 
		onclick=history.back()> Retour </button>
	</div>	
</div>
@else
<div align="center">
		<button id="bouton_2" style="
		background-color: skyblue; /* Green */
		border: none;
		color: black;
		cursor: pointer;
		padding: 15px 32px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 16px;" 
		onclick=history.back()> رجوع </button>
	</div>	
</div>
@endif

@endsection
@section('js_scripts')
<script type="text/javascript">
	document.getElementById("myForm").addEventListener("submit", function(event){
	  event.preventDefault()
	  calculer();
	});
	function calculer_ods(){
		var n = parseInt(document.getElementById('ods_counter').value);
		var diff = 0;
		for (var i = 1 ; i <= n; i++) {
			var date1 =document.getElementById('ods_stop'+i).value.split("/");
			for(var k=0;k< date1.length; k++){ date1[k] = parseInt(date1[k]);}
			var date2 = document.getElementById('ods_reprise'+i).value.split("/");
			for(var k=0;k< date2.length; k++){ date2[k] = parseInt(date2[k]);}
			diff += soustraire(date1,date2);
			console.log(diff);
		}
		console.log(diff);
		return diff
	}
	function soustraire(date1,date2){
		var date =[0,0,0]
		for (var i = 0; i <3; i++) {
			date[i] = date2[i] - date1[i];
		}
		if(date[0] <0){
			date[0] += 30;
			date[1] -=1;
		}
		if(date[1]<0){
			date[1] += 12;
			date[2] -= 1;
		}
		return date[0] + date[1]*30 + date[2]*360;
	}
	function calculer(){

		var start_date = document.getElementById('start_date').value;
		var years = parseInt(document.getElementById('years').value);
		var months = parseInt(document.getElementById('months').value); 
		var days = document.getElementById('days').value;
		if(days == ""){
			days = 0;
		}else{
			days = parseInt(days);
		}
		days += calculer_ods();
		var dd = parseInt(start_date.split("/")[0]);
		var mm = parseInt(start_date.split("/")[1]);
		var yy = parseInt(start_date.split('/')[2]);

		if (dd + days > 30) {
			var div = parseInt(days / 30);
			dd += days % 30;
			months += div; 
		}else{
			dd += days;
		}
		if(dd > 30){
			months +=1;
			dd -= 30;
		}
		if (mm + months > 12) {
			var m_div = parseInt(months / 12);
			mm += months % 12;
			years+= m_div;
		}else{
			mm+= months;
		}
		if(mm > 12){
			years +=1;
			mm -= 12;
		}
		yy+= years;
		mm = mm.toString();
		dd = dd.toString();
		if (mm.length == 1){
			mm  = "0"+mm;
		}
		if(dd.length == 1){
			dd = "0"+dd;
		}
		var end_date = dd+"/"+mm+"/"+yy;

		document.getElementById('end_date').value = end_date;
		calculer_ods();
	}

	function format_date(value){
		var n = value.length;
		if (n == 2) {
			document.getElementById('start_date').value +="/";
		}
		if (n == 5) {
			document.getElementById('start_date').value +="/";
		}
	}
	function add_ods(){
		var n = parseInt(document.getElementById('ods_counter').value);
		var dates = []
		var j = parseInt(document.getElementById('ods_counter').value);
		
		var vals = [];
		for(var i=1; i< j+1; i++){
			vals.push([document.getElementById('ods_stop'+i).value,document.getElementById('ods_reprise'+i).value]);

		}
		console.log(vals);
		j++;

		document.getElementById('ODS_space').innerHTML += 
		'<div id="ods_'+j+'">'+
		'<h3 style= "font-weight : bold;" >Interval d\'ODS</h3>'+
		'<div class="form-group">'+
		'<label>Date Arret : </label> &emsp;&emsp;'+
		'<input class="form-control" type="text" autocomplete="off" placeholder="jj/mm/aaaa"  pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\\d\\d" id="ods_stop'+j+'"  required=""> <br> <br>'+
		'<label >Date Reprise : </label> &emsp;'+ 
		'<input class="form-control" type="text" autocomplete="off" placeholder="jj/mm/aaaa"  pattern="(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\\d\\d" id="ods_reprise'+j+'"  required=""> <br><br> '+
		'<button type="button" onclick="delete_ods(\'ods_'+j+'\')" style="margin-left : 25%;" class="btn btn-danger">X</button>'+
		'</div>'+
		'</div><br>';
		for(var i=0; i< vals.length; i++){
			document.getElementById('ods_stop'+(i+1)).value = vals[i][0];
			document.getElementById('ods_reprise'+(i+1)).value = vals[i][1];
		}
		document.getElementById('ods_counter').value = j;
	}
	function delete_ods(id){
		var elem = document.getElementById(id);
 		elem.parentElement.removeChild(elem);
 		var n = parseInt(document.getElementById('ods_counter').value);
 		n--;
 		document.getElementById('ods_counter').value = n;
	}
</script>
@endsection