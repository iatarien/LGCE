<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="DEP - Logiciel de Gestion de la Direction des Equipements Publics Ouargla">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="author" content="Iatarien Abderraouf">
  <link rel="icon" href="{{ url('img/favicon.png') }}">
  <title>DEP - Logiciel de Gestion de la Direction des Equipements Publics Ouargla</title>
  
  <!-- Bootstrap CSS -->
  <link href="{{ url('css/bootstrap.min.css')}}" rel="stylesheet">
  <!-- bootstrap theme -->
  <link href="{{ url('css/bootstrap-theme.css')}}" rel="stylesheet">
  <!--external css-->
  <!-- font icon -->

  <!-- full calendar css-->
  <link href="{{ url('assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css')}}" rel="stylesheet" />
  <link href="{{ url('assets/fullcalendar/fullcalendar/fullcalendar.css')}}" rel="stylesheet" />
  <!-- easy pie chart-->
  <link href="{{ url('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css')}}" rel="stylesheet" type="text/css" media="screen" />
  <!-- owl carousel -->
  <link rel="stylesheet" href="{{ url('css/owl.carousel.css') }}" type="text/css">
  <link href="{{ url('css/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet">
  <!-- Custom styles -->
  <link rel="stylesheet" href="{{ url('css/fullcalendar.css') }}">
  <link href="{{ url('css/widgets.css')}}" rel="stylesheet">

  <link href="{{ url('css/style.css')}}" rel="stylesheet">

  <link href="{{ url('css/style-responsive.css')}}" rel="stylesheet" />
  <link href="{{ url('css/xcharts.min.css')}}" rel=" stylesheet">
  <link href="{{ url('css/jquery-ui-1.10.4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ url('css/jquery-ui.css') }}">
  <style type="text/css">
  /* The Modal (background) */
  .modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
  }

  /* Modal Content (Image) */
  .modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
  }

  /* Caption of Modal Image (Image Text) - Same Width as the Image */
  #caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
  }

  /* Add Animation - Zoom in the Modal */
  .modal-content, #caption {
    animation-name: zoom;
    animation-duration: 0.6s;
  }

  @keyframes zoom {
    from {transform:scale(0)}
    to {transform:scale(1)}
  }

  /* The Close Button */
  .close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
  }

  .close:hover,
  .close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
  }

  /* 100% Image Width on Smaller Screens */
  @media only screen and (max-width: 700px){
    .modal-content {
      width: 100%;
    }
  }

  </style>
</head>