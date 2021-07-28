<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Stopy</title>

  <!-- Bootstrap core CSS -->
  
    <link href="{{asset('assets/front/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template -->

   <link href="{{asset('assets/front/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
   <link href="{{asset('assets/front/assets/vendor/simple-line-icons/css/simple-line-icons.css')}}" rel="stylesheet">
 

  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

  <!-- Plugin CSS -->
 <link href="{{asset('assets/front/assets/device-mockups/device-mockups.min.css')}}" rel="stylesheet">

  <!-- Custom styles for this template -->
   <link href="{{asset('assets/front/assets/css/new-age.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
   @include('front.includes.header-top')

    @yield('content')

    @include('front.includes.footer')

  <!-- Bootstrap core JavaScript -->

  <script src="{{asset('assets/front/assets/vendor/jquery/jquery.min.js')}}"></script>


  <script src="{{asset('assets/front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Plugin JavaScript -->
   
  <script src="{{asset('assets/front/assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for this template -->
    <script src="{{asset('assets/front/assets/js/new-age.min.js')}}"></script>

</body>

</html>
