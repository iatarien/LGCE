<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  @include('components.head')

<body class="login-img3-body">

  <div class="container">

    <form class="login-form" autocomplete="off" method="POST" action="{{ route('login') }}">
        @csrf
      <div class="login-wrap">
        <p class="login-img"><img style="width : 150px;" src="img/lock.png"></p>
        <div class="input-group">
          <span class="input-group-addon"><img class="img-icon" src="img/user_avatar.png"></span>
          <input type="text" required="" onkeyup="this.value = this.value.toLowerCase();" class="form-control" autocomplete="off" name="username" placeholder="Username" autofocus>
        </div>
        <div class="input-group">
          <span class="input-group-addon"><img class="img-icon" src="img/eye.png"></span>
          <input type="password" required="" name="password" autocomplete="off" class="form-control" placeholder="Mot de Passe">
        </div>
        <button class="btn btn-primary btn-lg btn-block" type="submit">Se connecter</button>
        
      </div>
    </form>
  </div>
@isset($error)
<script src="{{ url('js/sweetalert2.min.js') }}"></script>
<script type="text/javascript">
  Swal.fire({
      title: 'Username ot mot de passe incorrecte',
      icon: 'error',
      confirmButtonText : 'Réessayer'
    });
</script>
@endisset

</body>

</html>
