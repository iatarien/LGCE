<!DOCTYPE html>
<html>
<head>
	<title>تعديل مقاول أو شركة</title>
	@include('components.head')
</head>
<body style="background-color : white;">
	<div style="width : 70%; marign-right : 15%; margin-left : 15%; margin-top : 15%;">
		<form class="form-horizontal" autocomplete="off" action="../update_e" method="POST">
		@csrf
        <input type="hidden" name="id" value="{{$e->id}}">
			<div class="form-group">
				<div class="col-sm-10">
				<textarea required=""  type="text" rows="5" style="resize: none; color: black;" dir="rtl" class="form-control" id="name" name="name">{{$e->name}}</textarea>
				</div>
				<label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> اسم  الشركة </label>
			</div>
			<div class="form-group">
				<div class="col-sm-10">
				<select style="text-align : right" name="nature" class="form-control">
					@if ($e->nature == "bet")
					<option style="visibility : hidden" value="{{$e->nature}}">Bureau d'etudes</option>
					@else
					<option style="visibility : hidden" value="{{$e->nature}}">Entreprise</option>
					@endif
					<option value="company">Entreprise</option>
					<option value="bet">Bureau d'etudes</option>
				</select>
				</div>
				<label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">  نوع الشركة  </label>
			</div>
			@if($ville_fr =="Mila")
			<div class="form-group">
				<div class="col-sm-10">
				<textarea type="text" rows="5" style="resize: none; color: black;" dir="rtl" class="form-control" id="adresse" name="adresse">{{$e->adresse}}</textarea>
				</div>
				<label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> العنوان</label>
			</div>
			@endif
			<div class="form-group" align="center">
				<button type="submit" class="btn btn-primary">حفظ</button>
			</div>
		</form>
	</div>
</body>
</html>