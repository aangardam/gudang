@include('layouts.admin_head')
  <body class="app sidebar-mini rtl">
    @guest

    @else
        @include("layouts.admin_header");
        @include("layouts.admin_slider");
    @endguest

     @yield('content')
    
    @guest
        
    @else
        {{--Checkbox --}}
        <!-- Essential javascripts for application to work-->
        <script src="{{asset('admin/js/jquery-3.2.1.min.js')}}"></script>
        <script src="{{asset('admin/js/popper.min.js')}}"></script>
        <script src="{{asset('admin/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admin/js/main.js')}}"></script>
        
        <script src="{{asset('admin/js/jquery-ui.js')}}" type="text/javascript"></script>
        <script src="{{asset('admin/js/select2.min.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

        <!-- The javascript plugin to display page loading on top-->
        <script src="{{asset('admin/js/plugins/pace.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/jquery.dataTables.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('admin/js/plugins/dataTables.bootstrap.min.js')}}"></script>
        <script type="text/javascript">$('#sampleTable').DataTable();</script>
        <!-- Page specific javascripts-->
        <!-- Google analytics script-->
        {{--  <script type="text/javascript">
        if(document.location.hostname == 'pratikborsadiya.in') {
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
        }
        </script>  --}}
        <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
        <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
        {{--  <script>
            $('textarea').ckeditor();
        </script>  --}}
        <script type="text/javascript">
            $(document).ready(function() {
                $("input.datepicker" ).datepicker({
                    dateFormat:'yy-mm-dd',
                    changeMonth: true,
                    changeYear: true
                });
                $('.js-example-basic-single').select2();
            });

            $(document).ready(function() {
                $('#dataTables').DataTable();
            } );
            $('select').select2();
        </script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/sweetalert/1.0.1/sweetalert.min.js"></script>
        @include('sweet::alert')
    @endguest
    @yield('script')
  </body>
</html>