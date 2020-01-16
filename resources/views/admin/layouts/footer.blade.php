<!-- jQuery 3 -->
<script src="{{url('')}}/design/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('/')}}/design/adminlte/bower_components/jquery-ui/jquery-ui.min.js"></script>

<link rel="stylesheet" href=" {{url('')}}/design/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="{{url('')}}/design/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{url('')}}/design/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="{{url('')}}/design/adminlte/bower_components/datatables.net-bs/js/buttons.js"></script>

<script src="{{url('')}}/vendor/datatables/buttons.server-side.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('/design/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{url('/design/adminlte/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{url('/design/adminlte/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{url('/design/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{url('/design/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{url('/design/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{url('/design/adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{url('/design/adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{url('/design/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{url('/design/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{url('/design/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{url('/design/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{url('/design/adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('/design/adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{url('/design/adminlte/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('/design/adminlte/dist/js/demo.js')}}"></script>

<script>
    function applySearch(routeName){
        alert('search');
        $('#search_form').attr('action',routeName);
        $('#search_form').attr('method',"GET");
        $('#search_form').submit();
    }

    function excel(routeName){
        $('#search_form').attr('action',routeName);
        $('#search_form').attr('method',"GET");
        $('#search_form').submit();

    }

</script>
<script src="{{asset('js/app.js')}}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.0/js/lightbox.js"></script>
<script>
    $('.fromdete').datepicker({ dateFormat: 'dd/mm/yy' });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

@yield('script')
@stack('js')
@stack('css')
<footer class="text-center p-b-30" style="background:#575757; text-align:center; padding-bottom:30px; color:#fff !important; padding-top:30px; width:100%">
    <div class="container" style=" margin-right: auto; margin-left: auto; width:100%;">
        <div class="row" style="width: 100%;text-align: right ">


        </div>
    </div>

</footer>
@include('sweetalert::alert')
</body>
</html>
