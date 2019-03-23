<link rel="stylesheet" href="{{asset('css/vendors/bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/vendors/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/vendors/toastr.min.css')}}">
<link rel="stylesheet" href="{{asset('css/vendors/owl.carousel.min.css')}}">
<link rel="stylesheet" href="{{asset('css/b/layouts.css')}}">
<link rel="stylesheet" href="{{asset('css/b/styles.css')}}">
<!-- Extra CSS -->
<style>
    body{
        /* background-color: #DCEBF9; */
        background-image: url({{asset('storage/images/bg/sand.jpg')}});
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        background-attachment: fixed;
    }
    body::after{

    }
.scrollable{
    max-height: 80vh;
    overflow: auto;
}
</style>
@yield('styles')
