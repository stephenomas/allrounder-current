<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Allrounder | LOGIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">

</head>
@if (isset(Auth()->user()->email))


<script>
  location.replace('/dashboard');
</script>
@endif

<body>

    <!-- Begin page -->
    <div class="accountbg"></div>
    <div class="wrapper-page m-t-60">
        <div class="card card-pages ">

            <div class="card-body">
                <div class="text-center m-t-0 m-b-15">
                    <a href="./" class=" logo-admin"><img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="54"></a>
                </div>
                <h4 class="text-muted text-center m-t-0"><b>Sign In</b></h4>
                @if (session()->has('message'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>

                        {{session()->get('message')}} <br>

                </div>

                @endif
                <form class="form-horizontal m-t-20" action={{route('signin')}} id="loginform" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="col-12">
                            <input class="form-control" type="email" value="{{old('email')}}" required="" placeholder="Email" name="email">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-12">
                            <input class="form-control" id="myInput" type="password" required="" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-12">
                            <div class="d-flex flex-row-reverse ">
                                <input type="checkbox" onclick="myFunction()">Show Password
                            </div>

                        </div>
                    </div>




                    <div class="form-group text-center m-t-40">
                        <div class="col-12">
                            <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>


                </form>
            </div>

        </div>
    </div>

    <script>
        function myFunction() {
        var x = document.getElementById("myInput");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        }
    </script>


    <!-- jQuery  -->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/modernizr.min.js')}}"></script>
    <script src="{{asset('assets/js/detect.js')}}"></script>
    <script src="{{asset('assets/js/fastclick.js')}}"></script>
    <script src="{{asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('assets/js/jquery.blockUI.js')}}"></script>
    <script src="{{asset('assets/js/waves.js')}}"></script>
    <script src="{{asset('assets/js/wow.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('assets/js/jquery.scrollTo.min.js')}}"></script>

    <script src="{{asset('assets/js/app.js')}}"></script>

</body>

</html>
