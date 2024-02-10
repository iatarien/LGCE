<!DOCTYPE html>
<html>
<head>
	<title> Ajouter Entreprise</title>
	@include('components.head')
</head>
<body style="background-color : white;" dir="ltr">
	<div id="main" class="main" style="width : 70%; marign-right : 15%; margin-left : 15%; margin-top : 15%;">
		<form class="form-horizontal" autocomplete="off" action="../add_e" method="POST">
		@csrf
			<div class="form-group">
				<label class="control-label col-sm-2" style="text-align : left; font-weight: bold;" for="title"> Nom de l'entreprise </label>
			
				<div class="col-sm-10">
				<textarea required=""  type="text" rows="5" style="resize: none; color: black;" dir="ltr" class="form-control" id="name" name="name"></textarea>
				</div>
				</div>
			<div class="form-group">
				<label class="control-label col-sm-2" style="text-align : left; font-weight: bold;" for="title">   Type  </label>
			
				<div class="col-sm-10">
				<select style="text-align : left" name="nature" class="form-control">
					<option value="company">Entreprise</option>
					<option value="bet"> Bureau d'Etude</option>
				</select>
				</div>
				</div>
			<div class="form-group" align="center">
				<button type="submit" class="btn btn-primary">Seuvegarder</button>
			</div>
		</form>
	</div>
</body>
</html>