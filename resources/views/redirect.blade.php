
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<body></body>
<script src="/js/sweetalert2.min.js"></script>
<script type="text/javascript">
    var type = "{{$type}}";
    if(type == "success"){
        var confirmButtonText = "OK";
    }else{
        var confirmButtonText = "Réessayer";
    }
    
  Swal.fire({
      title: "{{$message}}",
      icon: "{{$type}}",
      confirmButtonText : confirmButtonText,
    }).then(function() {
        if(type == "success"){
            window.location = "{{$redirect_to}}";
        }else{
            history.go(-1);
        }    
    });
</script>
</html>