<script>
        $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip({
                        //options here
                });
                $('[data-toggle="popover"]').popover({
                        //options here
                });

                $('.businesses-carousel,.products-carousel').owlCarousel({
                        'margin': 10,
                });
        });
</script>
<script src="{{asset('js/vendors/toastr.min.js')}}"></script>
<script>
toastr.options = {
                "closeButton": true,
                "debug": true,
                "newestOnTop": true,
                "progressBar": true,
                "escapeHtml": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "0",
                "extendedTimeOut": "0",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
			}	

    @if(session('success'))
            toastr.success("{!!session('success')!!}");
    @endif
    @if(session('info'))
            toastr.info("{!!session('info')!!}");
    @endif

    @if(session('warning'))
            toastr.warning("{!!session('warning')!!}");
    @endif

    @if(session('error'))
            toastr.error("{!!session('error')!!}");
    @endif

    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
                toastr.error('{{$error}}');
        @endforeach      
    @endif

</script>

@yield('b-scripts')
