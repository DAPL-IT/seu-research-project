<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
<link href="{{asset('backend/img/logo/logo.png')}}" rel="icon">
<title>{{ucwords(Auth::user()->role)}} | @yield('title')</title>
<link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('backend/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('backend/css/ruang-admin.min.css')}}" rel="stylesheet">
<!-- Plugins -->
<link rel="stylesheet" href="{{asset('backend/vendor/toastr/toastr.css')}}">
<link rel="stylesheet" href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('backend/vendor/datatables/responsive.bootstrap4.min.css')}}">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
    .table-image{
        width: 50px;
        height: 50px;
        border: 2px solid rgba(128, 128, 128, 0.5);
        border-radius: 50%;
    }

    .profile-image-container{
        width: 150px;
        height: 150px;
    }

    .profile-image{
        border: 2px solid rgba(128, 128, 128, 0.5);
        border-radius: 50%;
    }

</style>
@yield('extra_css')
