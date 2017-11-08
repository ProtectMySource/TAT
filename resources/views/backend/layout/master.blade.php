<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>TA-BOOK || ADMIN</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="{{asset('backend/css/bootstrap.min.css')}}" rel="stylesheet" />
    <!--  Material Dashboard CSS    -->
    <link href="{{asset('backend/css/material-dashboard.css?v=1.2.0')}}" rel="stylesheet" />
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{asset('backend/css/demo.css')}}" rel="stylesheet" />
    <link href="{{asset('backend/css/master.css')}}" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('backend/css/datepicker.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/main.css')}}">
    <link href="{{asset('backend/css/select2.min.css')}}" rel="stylesheet" />
</head>

<body>
    <div class="wrapper">
        @yield('sidebar')
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <!-- <li>
                                <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">dashboard</i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li> -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="material-icons">person</i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                      <a href="{{ route('logout') }}"
                                          onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                          Đăng xuất
                                      </a>

                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          {{ csrf_field() }}
                                      </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            @yield('content')
            @yield('footer')
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="{{ asset('backend/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{asset('backend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('backend/js/material.min.js')}}"></script>
<!--  Charts Plugin -->
<script src="{{asset('backend/js/chartist.min.js')}}"></script>
<!--  Dynamic Elements plugin -->
<script src="{{asset('backend/js/arrive.min.js')}}"></script>
<!--  PerfectScrollbar Library -->
<script src="{{asset('backend/js/perfect-scrollbar.jquery.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('backend/js/bootstrap-notify.js')}}"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Material Dashboard javascript methods -->
<script src="{{asset('backend/js/material-dashboard.js?v=1.2.0')}}"></script>
<script src="{{asset('backend/js/demo.js')}}"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script> -->
<script src="https://fengyuanchen.github.io/js/common.js"></script>
<script src="{{asset('backend/js/datepicker.js')}}"></script>
<script src="{{asset('backend/js/datepicker.ca-ES.js')}}"></script>
<script src="{{asset('backend/js/main.js')}}"></script>
<script src="{{asset('backend/js/master.js')}}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/1.0.0-alpha.1/classic/ckeditor.js"></script>
<script src="{{asset('backend/js/select2.min.js')}}"></script>
<script type="text/javascript">
$('#myModal').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget)
var recipient = button.data('whatever')
var modal = $(this);
var url =  window.location.href;
var res = url.split("/");
<?php $url =$_SERVER['REQUEST_URI'];
$res = explode("/",$url); ?>
modal.find('.modal-footer a').attr('href','{{route($res[5].'.delete', ['customer' =>""]) }}'+'/'+recipient)
}
);
ClassicEditor
        .create( document.querySelector( '#editor1' ) )
        .catch( error => {
            console.error( error );
        } );
        ClassicEditor
                .create( document.querySelector( '#editor2' ) )
                .catch( error2 => {
                    console.error( error2 );
                } );
                $(document).ready(function() {
                    $('.js-example-basic-single').select2();
                });
                $(document).ready(function() {
    $('.js-example-basic-multiple').select2();

});
@yield('js')
</script>
</html>
