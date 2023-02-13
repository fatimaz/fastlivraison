<!DOCTYPE html>
<html lang="en">
    <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>Yawy</title>

    <!-- vendor css -->
    <link href="{{ asset('assets/admin/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/lib/rickshaw/rickshaw.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/lib/highlightjs/github.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/lib/jquery.steps/jquery.steps.css') }}" rel="stylesheet">

 
 <!-- Tags Input CDN CSS -->
    <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>

 <!-- chart -->
         <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

<!-- Datatable css -->
    <link href="{{ asset('assets/admin/lib/highlightjs/github.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/lib/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/starlight.css') }}">
   <link href="{{ asset('assets/admin/lib/summernote/summernote-bs4.css') }}" rel="stylesheet">

       <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/file-uploaders/dropzone.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css-rtl/plugins/file-uploaders/dropzone.css')}}">


    @yield('style')
  </head>
  <body>

  @guest

  @else
    @include('admin.includes.sidebar')
   @include('admin.includes.header')
   @include('admin.includes.tabs')

  @endguest

  @yield('content') 

   <script src="{{ asset('assets/admin/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>


    <script src="{{ asset('assets/admin/lib/highlightjs/highlight.pack.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/datatables-responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/select2/js/select2.min.js') }}"></script>



       <script src="{{ asset('assets/admin/lib/jquery.steps/jquery.steps.js') }}"></script>
     <script src="{{ asset('assets/admin/lib/parsleyjs/parsley.js') }}"></script>

<script>
      $(function(){
        'use strict';
        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });
        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });
        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });
      });
    </script>
    


    <script src="{{ asset('assets/admin/lib/jquery.sparkline.bower/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/d3/d3.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/rickshaw/rickshaw.min.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/chart.js/Chart.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/Flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/admin/lib/flot-spline/jquery.flot.spline.js') }}"></script>

     <script src="{{ asset('assets/admin/lib/medium-editor/medium-editor.js') }}"></script>
     <script src="{{ asset('assets/admin/lib/summernote/summernote-bs4.min.js') }}"></script>



    
    <script>
      $(function(){
        'use strict';
        // Inline editor
        var editor = new MediumEditor('.editable');
        // Summernote editor
        $('#summernote').summernote({
          height: 150,
          tooltip: false
        })
      });
    </script>

     <script>
      $(function(){
        'use strict';
        // Inline editor
        var editor = new MediumEditor('.editable');
        // Summernote editor
        $('#summernote1').summernote({
          height: 150,
          tooltip: false
        })
      });
    </script>

    <script src="{{ asset('assets/admin/js/starlight.js') }}"></script>
    <script src="{{ asset('assets/admin/js/ResizeSensor.js') }}"></script>
    <script src="{{ asset('assets/admin/js/dashboard.js') }}"></script>

 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>
<script src="{{asset('assets/admin/js/checkbox-radio.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/admin/js/dropzone.min.js')}}" type="text/javascript"></script>
 <script>
        @if(Session::has('message'))
          var type="{{Session::get('alert-type','info')}}"
          switch(type){
              case 'info':
                   toastr.info("{{ Session::get('message') }}");
                   break;
              case 'success':
                  toastr.success("{{ Session::get('message') }}");
                  break;
              case 'warning':
                 toastr.warning("{{ Session::get('message') }}");
                  break;
              case 'error':
                  toastr.error("{{ Session::get('message') }}");
                  break;
          }
        @endif
     </script>  

     <script>  
         $(document).on("click", "#delete", function(e){
             e.preventDefault();
             var link = $(this).attr("href");
                swal({
                  title: "Are you Want to delete?",
                  text: "Once Delete, This will be Permanently Delete!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                       window.location.href = link;
                  } else {
                    swal("Safe Data!");
                  }
                });
            });
          
    </script>
   @yield('script')

  </body>
</html>
