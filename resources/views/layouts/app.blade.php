<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        nav:has(.pagination) {
            width: 100%;
        }

        .pagination {
            display: flex !important;
            justify-content: center !important;
        }

        #image-preview-container {
            gap: 5vh !important;
        }

        .image-preview {
            display: inline-block;
            margin-right: 5vh;
        }

        body {
            position: relative;
        }

        .chat-box {
            height: 10vh;
            width: 400px;
            position: absolute;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            z-index: 15;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.005);
            right: 15px; /* Adjusted to position it correctly */
            top: 15px; /* Added to position it correctly */
            background: #fff;
            border-radius: 15px;
            visibility: hidden;
        }

        .chat-box-header {
            height: 8%;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            display: flex;
            font-size: 14px;
            padding: 0.5em 0;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2), 0 -1px 10px rgba(172, 54, 195, 0.3), 0 1px 10px rgba(0, 0, 0, 0.025);
        }

        .chat-box-header h3 {
            font-family: ubuntu;
            font-weight: 400;
            float: left;
            position: absolute;
            left: 25px;
        }

        .chat-box-header p {
            float: right;
            position: absolute;
            right: 16px;
            cursor: pointer;
            height: 50px;
            width: 50px;
            text-align: center;
            line-height: 3.25;
            margin: 0;
        }

        .chat-box-body {
            height: 75%;
            background: #f8f8f8;
            overflow-y: scroll;
            padding: 12px;
        }

        .chat-box-body-send,
        .chat-box-body-receive {
            width: 250px;
            background: white;
            padding: 10px 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.015);
            margin-bottom: 14px;
        }

        .chat-box-body-send {
            float: right;
        }

        .chat-box-body-receive {
            float: left;
        }

        .chat-box-body-send p,
        .chat-box-body-receive p {
            margin: 0;
            color: #444;
            font-size: 14px;
            margin-bottom: 0.25rem;
        }

        .chat-box-body-send span,
        .chat-box-body-receive span {
            float: right;
            color: #777;
            font-size: 10px;
        }

        .chat-box-footer {
            position: relative;
            display: flex;
        }

        .chat-box-footer button {
            border: none;
            padding: 16px;
            font-size: 14px;
            background: white;
            cursor: pointer;
        }

        .chat-box-footer input {
            padding: 10px;
            border: none;
            border-radius: 50px;
            background: whitesmoke;
            margin: 10px;
            font-family: ubuntu;
            font-weight: 600;
            color: #444;
            width: 280px;
        }

        .chat-box-footer .send {
            vertical-align: middle;
            align-items: center;
            justify-content: center;
            transform: translate(0px, 20px);
            cursor: pointer;
        }

        .chat-button {
            padding: 25px 16px;
            background: #2C50EF;
            width: 120px;
            position: absolute;
            top: 8vh;
            right: 0;
            margin: 15px;
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
            border-bottom-left-radius: 25px;
            box-shadow: 0 2px 15px rgba(44, 80, 239, 0.21);
            /* Changed from rgba(#2C50EF, 0.21) */
            cursor: pointer;
        }

        .chat-button span::before {
            content: '';
            height: 15px;
            width: 15px;
            background: #47cf73;
            position: absolute;
            transform: translate(0, -7px);
            border-radius: 15px;
        }

        .chat-button span::after {
            content: "Message Us";
            font-size: 14px;
            color: white;
            position: absolute;
            left: 50px;
            top: 18px;
        }

        .modal {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            opacity: 0;
            visibility: hidden;
            transform: scale(1.1);
            transition: visibility 0s linear 0.25s, opacity 0.25s 0s, transform 0.25s;
        }

        .modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 1rem 1.5rem;
            width: 24rem;
            border-radius: 0.5rem;
        }

        .modal-close-button {
            float: right;
            width: 1.5rem;
            line-height: 1.5rem;
            text-align: center;
            cursor: pointer;
            border-radius: 0.25rem;
            background-color: lightgray;
        }

        .close-button:hover {
            background-color: darkgray;
        }

        .show-modal {
            opacity: 1;
            visibility: visible;
            transform: scale(1);
            transition: visibility 0s linear 0s, opacity 0.25s 0s, transform 0.25s;
            z-index: 30;
        }

        @media screen only and (max-width: 450px) {
            .chat-box {
                min-width: 100% !important;
            }
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/jquery-3.3.1.min.js', 'resources/js/jquery.validate.min.js', 'resources/js/scripts.js', 'resources/js/modernizr-3.6.0.min.js', 'resources/js/bootstrap.min.js', 'resources/js/map-cluster/infobox.min.js', 'resources/js/map-cluster/markerclusterer.js', 'resources/js/map-cluster/maps.js'])
</head>

<body>

    <div class="wrapper">

        <header>

            <div class="top-header">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xl-6 col-md-7 col-sm-12">
                            <div class="header-address">
                                <a href="#">
                                    <i class="la la-phone-square"></i>
                                    <span>(647) 346-0855</span>
                                </a>
                                <a href="#">
                                    <i class="la la-map-marker"></i>
                                    <span>CF Fairview Mall, Toronto, ON</span>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-5 col-sm-12">
                            <div class="header-social">
                                <a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-instagram"></i>
                                </a>
                                <a href="#">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <a class="navbar-brand" href="01_Home.html">
                                    <img src="assets/images/logo.png" alt="">
                                </a>
                                <button class="menu-button" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
                                    <span class="icon-spar"></span>
                                    <span class="icon-spar"></span>
                                    <span class="icon-spar"></span>
                                </button>

                                <div class="navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav mr-auto">
                                        <li class="nav-item dropdown active">
                                            <a class="nav-link dropdown-toggle" href="/" data-toggle="dropdown">
                                                Home
                                            </a>
                                        </li>
                                        <form style="display: flex" action="{{ route('items.filter') }}" method="GET">
                                            <li class="nav-item dropdown">
                                                <button name="type" value="2" type="submit"
                                                    style="
                                                            border: none;
                                                            background: none;"
                                                    class="nav-link dropdown-toggle" href="#"
                                                    data-toggle="dropdown">
                                                    Features
                                                </button>
                                            </li>
                                            <li class="nav-item dropdown">
                                                <button name="type" value="1" type="submit"
                                                    style="
                                                            border: none;
                                                            background: none;"
                                                    class="nav-link dropdown-toggle" href="#"
                                                    data-toggle="dropdown">
                                                    Event
                                                </button>
                                            </li>
                                        </form>
                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="/user-transactions"
                                                data-toggle="dropdown">
                                                History
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="d-inline my-2 my-lg-0">
                                        <ul class="navbar-nav">
                                            @guest
                                                <li class="nav-item signin-btn">
                                                    <a href="#" class="nav-link">
                                                        <i class="la la-sign-in"></i>
                                                        <span><b class="signin-op">Sign in</b> or <b
                                                                class="reg-op">Register</b></span>
                                                    </a>

                                                </li>
                                            @endguest
                                            @auth
                                                <li class="nav-item submit-btn">
                                                    <a href="/create-listing" class="my-2 my-sm-0 nav-link sbmt-btn">
                                                        <i class="icon-plus"></i>
                                                        <span>Submit Listing</span>
                                                    </a>
                                                </li>
                                            @endauth
                                        </ul>
                                    </div>
                                    <a href="#" title="" class="close-menu"><i class="la la-close"></i></a>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        </header><!--header end-->



        @guest
            <div class="popup" id="sign-popup">
                <h3>Sign In to your Account</h3>
                <div class="popup-form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-field">
                            <input id="email" type="email" name="email" placeholder="Email Address"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-field">
                            <input id="password" type="password" name="password" placeholder="Password"
                                class="form-control @error('password') is-invalid @enderror" required
                                autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-cp">
                            <div class="form-field">
                                <div class="input-field">
                                    <input type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">
                                        <span></span>
                                        <small>Remember me</small>
                                    </label>
                                </div>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" title="">Forgot Password?</a>
                            @endif
                        </div><!--form-cp end-->
                        <button type="submit" class="btn2">Sign In</button>
                    </form>
                </div>
            </div><!--popup end-->

            <div class="popup" id="register-popup">
                <h3>Register</h3>
                <div class="popup-form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-field">
                            <input id="name" type="text" name="name" placeholder="Name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-field">
                            <input id="email" type="email" name="email" placeholder="Email Address"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required autocomplete="email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-field">
                            <input id="password" type="password" name="password" placeholder="Password"
                                class="form-control @error('password') is-invalid @enderror" required
                                autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-field">
                            <input id="password-confirm" type="password" name="password_confirmation"
                                placeholder="Confirm Password" class="form-control" required autocomplete="new-password">
                        </div>
                        <div class="form-cp">
                            <div class="form-field">
                                <div class="input-field">
                                    <input type="checkbox" name="ccc" id="cc2">
                                    <label for="cc2">
                                        <span></span>
                                        <small>I agree with terms</small>
                                    </label>
                                </div>
                            </div>
                            <a href="#" title="" class="signin-op">Have an account?</a>
                        </div><!--form-cp end-->
                        <button type="submit" class="btn2">Register</button>
                    </form>
                </div>
            </div><!--popup end-->
        @endguest
        <div class="chat-box">
            <div class="chat-box-header">
                <h3>Message Us</h3>
                <p><i class="fa fa-times"></i></p>
            </div>
            <div class="chat-box-body">
                <div class="chat-box-body-send">
                    <p>This is my message.</p>
                    <span>12:00</span>
                </div>
                <div class="chat-box-body-receive">
                    <p>This is my message.</p>
                    <span>12:00</span>
                </div>
                <!-- Add more messages as needed -->
            </div>
            <div class="chat-box-footer">
                <button id="addExtra"><i class="fa fa-plus"></i></button>
                <input placeholder="Enter Your Message" type="text" />
                <i class="send far fa-paper-plane"></i>
            </div>
        </div>
        <div class="chat-button"><span></span></div>
        <div class="modal">
            <div class="modal-content">
                <span class="modal-close-button">&times;</span>
                <h1>Add What you want here.</h1>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @yield('content')
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="footer-content">
                            <div class="row justify-content-between">
                                <div class="col-xl-6 col-md-6">
                                    <div class="copyright">
                                        <p>&copy; Selio theme made in EU. All Rights Reserved.</p>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="footer-social">
                                        <a href="#">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fa fa-linkedin"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer><!--footer end-->


    </div><!--wrapper end-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('.chat-button').on('click', function() {
            $('.chat-button').css({
                "display": "none"
            });
            $('.chat-box').css({
                "visibility": "visible"
            });
        });
        $('.chat-box .chat-box-header p').on('click', function() {
            $('.chat-button').css({
                "display": "block"
            });
            $('.chat-box').css({
                "visibility": "hidden"
            });
        });
        $("#addExtra").on("click", function() {
            $(".modal").toggleClass("show-modal");
        });
        $(".modal-close-button").on("click", function() {
            $(".modal").toggleClass("show-modal");
        });
    </script>
</body>

</html>
