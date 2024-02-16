<!DOCTYPE html>
<html>
<head>
	<title>إضافة مقاول أو شركة</title>
	@include('components.head')
</head>
<body style="background-color : white;">
	<div id="main" class="main" style="width : 70%; marign-right : 15%; margin-left : 15%; margin-top : 15%;">
		<form class="form-horizontal" autocomplete="off" action="../add_e" method="POST">
		@csrf
			<div class="form-group">
				<div class="col-sm-10">
				<textarea required=""  type="text" rows="5" style="resize: none; color: black;" dir="rtl" class="form-control" id="name" name="name"></textarea>
				</div>
				<label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title"> اسم  المقاول </label>
			</div>
			<div class="form-group">
				<div class="col-sm-10">
				<select style="text-align : right" name="nature" class="form-control">
					<option value="company">شركة</option>
					<option value="bet"> مكتب دراسات</option>
				</select>
				</div>
				<label class="control-label col-sm-2" style="text-align : right; font-weight: bold;" for="title">  نوع الشركة  </label>
			</div>
			<div class="form-group" align="center">
				<button type="submit" class="btn btn-primary">حفظ</button>
			</div>
		</form>
	</div>
</body>
</html>