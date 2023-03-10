<script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
<script src="{{asset('backend/js/ruang-admin.js')}}"></script>
{{-- <script src="{{asset('backend/vendor/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('backend/js/demo/chart-area-demo.js')}}"></script> --}}

<!-- Plugins -->
<script src="{{asset('backend/vendor/toastr/toastr.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/vendor/datatables/responsive.bootstrap4.min.js
')}}"></script>

<script>
$(document).ready(()=>{
    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }

    @if($alert = session()->get('alert'))
        @if($alert['type'] == 'success')
        toastr.success("{{$alert['message']}}")
        @elseif($alert['type'] == 'error')
        toastr.error("{{$alert['message']}}")
        @elseif($alert['type'] == 'warning')
        toastr.warning("{{$alert['message']}}")
        @elseif($alert['type'] == 'info')
        toastr.info("{{$alert['message']}}")
        @endif
    @endif

    @if($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{$error}}')
        @endforeach
    @endif

});
</script>
@yield('extra_scripts')
