<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link href="{{asset('backend/img/logo/logo.png')}}" rel="icon">
<title>@yield('title')</title>
<link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('backend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('backend/css/ruang-admin.min.css')}}" rel="stylesheet">
<style>
    .logout-btn{
        background:transparent;
        border:none;
        color: black;
    }
    .logout-btn:active{
        background: #6777ef;
        color:white;
        outline:none;
    }
    .logout-btn:focus{
        outline: none;
    }
</style>
@yield('extra_css')
