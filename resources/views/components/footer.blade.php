  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>LGCE</span></strong>. Touts droits reservés
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <div id="loading" class="loading-overlay">
    <img src="/assets/img/loading.gif" alt="LOGO">
    
  </div>

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/chart.js/chart.min.js"></script>
  <script src="/assets/vendor/echarts/echarts.min.js"></script>
  <script src="/assets/vendor/quill/quill.min.js"></script>
  <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="/assets/vendor/php-email-form/validate.js"></script>
  <script src="/assets/js/main1.js"></script>
  <script src="/assets/js/jquery-1.8.3.min.js"></script>
  <script src="{{ url('js/sweetalert2.min.js') }}"></script>
  <script type="text/javascript">
  function css( element, property ) {
    return window.getComputedStyle( element, null ).getPropertyValue( property );
  }

  function facture(){
    Swal.fire({
      title: 'ما هو عدد الفاتورات ؟',
      input: 'number',
      confirmButtonText : 'موافق',
      cancelButtonText : "إلغاء",
      showCancelButton : true,
      closeOnCancel: false
      }).then((result) => {
        if (result.value) {
             document.location.href="/ajouter_deal/facture/"+result.value;
          }
      });
  }

  function multiple_pay(){
    Swal.fire({
      title: 'ما هو عدد الوضعيات ؟',
      input: 'number',
      confirmButtonText : 'موافق',
      cancelButtonText : "إلغاء",
      showCancelButton : true,
      closeOnCancel: false
      }).then((result) => {
        if (result.value) {
              document.location.href="/select/ajouter_pay/"+result.value;

          }
      });
  }
  
  </script>
  <script type="text/javascript">
    
    window.onload = function(){
        document.getElementById('loading').style.display = "none";
      //loop();
    };

    function loop(){
      console.log("loop");
    //   get_msgs();
    //   new_msgs();
      setTimeout(loop, 5000);
    }

    function get_msgs(){
      $.ajax({
          url: "/admin/get_msgs/",
          type:"GET", 
          cache: false,
          success:function(response) {
            display(response);
          },
          error:function(response) {
            console.log(response);
          },
        });
    }
    function new_msgs(){
      $.ajax({
          url: "/admin/new_msgs/",
          type:"GET", 
          cache: false,
          success:function(response) {
            display1(response);
            document.getElementById('new_msgs_dropdown').innerHTML = "Vous avez  "+response+" nouveaux messages";
            document.getElementById('loading').style.display ="none";
          },
          error:function(response) {
            console.log(response);
          },
        });
    }

    function display(msgs){
      var str ="";
      for (var i = 0; i < msgs.length; i++) {
        if(msgs[i].seen == 1){
          str +='<li class="message-item">'+
               '<a href="/admin/view_msg/'+msgs[i].id+'">'+
                '<img src="/assets/img/msg.jpg" alt="" class="rounded-circle">'+
                '<div>'+
                  '<h4 style="color :  lightgray">'+msgs[i].name+'</h4>'+
                  '<p style="color :  lightgray">'+msgs[i].subject+'</p>'+
                '</div>'+
              '</a>'+
            '</li>';
        }else{
          str +='<li class="message-item" style="font-weight :  bold">'+
               '<a href="/admin/view_msg/'+msgs[i].id+'">'+
                '<img src="/assets/img/msg.jpg" alt="" class="rounded-circle">'+
                '<div>'+
                  '<h4>'+msgs[i].name+'</h4>'+
                  '<p>'+msgs[i].subject+'</p>'+
                '</div>'+
              '</a>'+
            '</li>';
        }
        
      }
      document.getElementById('msgs').innerHTML = str;
    }
    function display1(val){
      var str =""; 
      if (val == 0){
        str ='<span class="badge bg-info badge-number">'+val+'</span>';
      }else{
        str ='<span class="badge bg-danger badge-number">'+val+'</span>';
      }
      document.getElementById('new_msgs').innerHTML = str;
    }
  </script>
  <!-- Template Main JS File -->