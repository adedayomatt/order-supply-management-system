<link rel="stylesheet" href="{{asset('css/vendors/bootstrap-4.min.css')}}">
<link rel="stylesheet" href="{{asset('css/vendors/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('css/vendors/toastr.min.css')}}">
<link rel="stylesheet" href="{{asset('css/b/layouts.css')}}">
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
.hidden-action{
    display: none;
}
.has-hidden-action:hover .hidden-action{
    display: block
}
.content-box{
    background-color: rgba(255,255,255,.8);
    padding: 10px;
    box-shadow: 0px 10px 10px rgba(0,0,0,.3);
    border-radius: 4px;
    margin: 10px 0;
}
.avatar-sm{
    width: 100px;
}
</style>
@yield('styles')
