
<!-- Footer -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                © {{date('Y')}} Tech Cloud Limited .
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->


<!-- jQuery  -->
<script src="{{url('public/assets/js/jquery.min.js')}}"></script>
<script src="{{url('public/assets/js/popper.min.js')}}"></script>
<script src="{{url('public/assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('public/assets/js/modernizr.min.js')}}"></script>
<script src="{{url('public/assets/js/waves.js')}}"></script>
<script src="{{url('public/assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{url('public/assets/js/jquery.nicescroll.js')}}"></script>
<script src="{{url('public/assets/js/jquery.scrollTo.min.js')}}"></script>

<!--Morris Chart-->

{{--<script src="{{url('public/assets/plugins/morris/morris.min.js')}}"></script>--}}

{{--<script src="{{url('public/assets/plugins/raphael/raphael-min.js')}}"></script>--}}

{{--<!-- App js -->--}}
{{--<script src="{{url('public/assets/pages/dashborad.js')}}"></script>--}}
<script src="{{url('public/assets/js/app.js')}}"></script>

    @yield('foot-js')

</body>


</html>