 <!-- javascripts -->
  <script src="{{ url('js/sweetalert2.min.js') }}"></script>
  <script src="{{ url('js/jquery.js') }}"></script>
  <script src="{{ url('js/jquery-ui-1.10.4.min.js') }}"></script>
  <script src="{{ url('js/jquery-1.8.3.min.js') }}"></script>
  <script type="text/javascript" src="{{ url('js/jquery-ui-1.9.2.custom.min.js') }}"></script>
  <!-- bootstrap -->
  <script src="{{ url('js/bootstrap.min.js') }}"></script>
  <!-- nice scroll -->
  <script src="{{ url('js/jquery.scrollTo.min.js') }}"></script>
  <!--<script src="{{ url('js/jquery.nicescroll.js') }}" type="text/javascript"></script> !-->
  <!-- charts scripts -->
  <script src="{{ url('assets/jquery-knob/js/jquery.knob.js') }}"></script>
  <script src="{{ url('js/jquery.sparkline.js') }}" type="text/javascript"></script>
  <script src="{{ url('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js') }}"></script>
  <script src="{{ url('js/owl.carousel.js') }}"></script>
  <!-- jQuery full calendar -->
  <script src="{{ url('js/fullcalendar.min.js') }}"></script>
  <!-- Full Google Calendar - Calendar -->
  <script src="{{ url('assets/fullcalendar/fullcalendar/fullcalendar.js') }}"></script>
  <!--script for this page only-->
  <script src="{{ url('js/calendar-custom.js') }}"></script>
  <script src="{{ url('js/jquery.rateit.min.js') }}"></script>
  <!-- custom select -->
  <script src="{{ url('js/jquery.customSelect.min.js') }}"></script>
  <script src="{{ url('assets/chart-master/Chart.js') }}"></script>

  <!--custome script for all page-->
  <script src="{{ url('js/scripts.js') }}"></script>
  <!-- custom script for this page-->
  <script src="{{ url('js/sparkline-chart.js') }}"></script>
  <script src="{{ url('js/easy-pie-chart.js') }}"></script>
  <script src="{{ url('js/jquery-jvectormap-1.2.2.min.js') }}"></script>
  <script src="{{ url('js/jquery-jvectormap-world-mill-en.js') }}"></script>
  <script src="{{ url('js/xcharts.min.js') }}"></script>
  <script src="{{ url('js/jquery.autosize.min.js') }}"></script>
  <script src="{{ url('js/jquery.placeholder.min.js') }}"></script>
  <script src="{{ url('js/gdp-data.js') }}"></script>
  <script src="{{ url('js/morris.min.js') }}"></script>
  <script src="{{ url('js/sparklines.js') }}"></script>
  <script src="{{ url('js/charts.js') }}"></script>
  <script src="{{ url('js/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ url('js/jquery-ui.min.js') }}"></script>
  <script src="{{ url('js/tooltip.js') }}"></script>


  <script type="text/javascript">
  window.onbeforeunload = function () {
    window.close();
  };
  
  function convert_date(date) {
    var parts = date.split('-');
    var mydate = parts[0] +"/"+parts[1]+"/"+parts[2]; 
    return mydate;
  }
  </script>
  <script>
    //knob
    $(function() {
      $(".knob").knob({
        'draw': function() {
          $(this.i).val(this.cv + '%')
        }
      })
    });

    //carousel
    $(document).ready(function() {
      $("#owl-slider").owlCarousel({
        navigation: true,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true

      });
    });

    //custom select box

    $(function() {
      $('select.styled').customSelect();
    });

    /* ---------- Map ---------- */
    $(function() {
      $('#map').vectorMap({
        map: 'world_mill_en',
        series: {
          regions: [{
            values: gdpData,
            scale: ['#000', '#000'],
            normalizeFunction: 'polynomial'
          }]
        },
        backgroundColor: '#eef3f7',
        onLabelShow: function(e, el, code) {
          el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
        }
      });
    });
  </script>  