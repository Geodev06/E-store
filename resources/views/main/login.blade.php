<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $settings['sys_name']}}</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');

        * {
            box-sizing: border-box;
        }

        body {
            background: #f6f5f7;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Montserrat', sans-serif;
            height: 100vh;
            margin: -20px 0 50px;
        }

        h1 {
            font-weight: bold;
            margin: 0;
        }

        h2 {
            text-align: center;
        }

        p {
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }

        span {
            font-size: 12px;
        }

        a {
            color: #333;
            font-size: 14px;
            text-decoration: none;
            margin: 15px 0;
        }

        button {
            border-radius: 20px;
            border: 1px solid #e22152;
            background-color: #e22152;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }

        button:active {
            transform: scale(0.95);
        }

        button:focus {
            outline: none;
        }

        button.ghost {
            background-color: transparent;
            border-color: #FFFFFF;
        }

        form {
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 50px;
            height: 100%;
            text-align: center;
        }

        input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            transition: all 0.6s ease-in-out;
        }

        .sign-in-container {
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .container.right-panel-active .sign-in-container {
            transform: translateX(100%);
        }

        .sign-up-container {
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .container.right-panel-active .sign-up-container {
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: show 0.6s;
        }

        @keyframes show {

            0%,
            49.99% {
                opacity: 0;
                z-index: 1;
            }

            50%,
            100% {
                opacity: 1;
                z-index: 5;
            }
        }

        .overlay-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: transform 0.6s ease-in-out;
            z-index: 100;
        }

        .container.right-panel-active .overlay-container {
            transform: translateX(-100%);
        }

        .overlay {
            background: #FF416C;
            background: -webkit-linear-gradient(to right, #e22152, #FF416C);
            background: linear-gradient(to right, #e22152, #FF416C);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: 0 0;
            color: #FFFFFF;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .container.right-panel-active .overlay {
            transform: translateX(50%);
        }

        .overlay-panel {
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 40px;
            text-align: center;
            top: 0;
            height: 100%;
            width: 50%;
            transform: translateX(0);
            transition: transform 0.6s ease-in-out;
        }

        .overlay-left {
            transform: translateX(-20%);
        }

        .container.right-panel-active .overlay-left {
            transform: translateX(0);
        }

        .overlay-right {
            right: 0;
            transform: translateX(0);
        }

        .container.right-panel-active .overlay-right {
            transform: translateX(20%);
        }

        .social-container {
            margin: 20px 0;
        }

        .social-container a {
            border: 1px solid #DDDDDD;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin: 0 5px;
            height: 40px;
            width: 40px;
        }

        footer {
            background-color: #222;
            color: #fff;
            font-size: 14px;
            bottom: 0;
            position: fixed;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 999;
        }

        footer p {
            margin: 10px 0;
        }

        footer i {
            color: red;
        }

        footer a {
            color: #3c97bf;
            text-decoration: none;
        }
    </style>

    <style>
        .text-error {
            color: #e22152;
            font-size: 11px;
            margin: 0px;
            text-align: left;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <h1 style="margin-bottom: 20px;">{{ $settings['sys_name']}}</h1>
    <div class="container" id="container">

        <div class="form-container sign-up-container">
            <form action="#" id="form_signup" method="post">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fa-brands fa-google"></i></i></a>
                </div>
                @csrf
                <span style="margin-bottom: 20px;">or use your email for registration</span>
                <div style="width:100%">
                    <p class="text-error error_name"></p>

                    <input type="text" placeholder="Name" name="name" />
                </div>
                <div style="width:100%">
                    <p class="text-error error_email"></p>

                    <input type="email" placeholder="Email" name="email" />

                </div>
                <div style="width:100%">
                    <p class="text-error error_password"></p>

                    <input type="password" placeholder="Password" name="password" />

                </div>
                <button type="submit">Sign Up</button>
            </form>
        </div>



        <div class="form-container sign-in-container">
            <form action="#" method="post">
                <h1>Sign in</h1>
                @csrf
                <div class="social-container">
                    <a href="#" class="social"><i class="fa-brands fa-google"></i></i></a>
                    <!-- <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a> -->
                </div>
                <span>or use your account</span>
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Password" />
                <a href="#">Forgot your password?</a>
                <button>Sign In</button>
            </form>
        </div>


        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{ asset('iztoast/css/iziToast.min.css') }}">
    <script src="{{ asset('iztoast/js/iziToast.min.js') }}"></script>
    <script>
        function showToast(msg, type) {

            var Bg = ''
            var Title = ''
            var Icon = ''
            var progressColor = ''
            var msgColor = ''
            var titleColor = ''
            var iconColor = ''

            switch (type) {
                case 1: // success

                    Bg = '#5cb85c'
                    Title = 'Success'
                    Icon = 'mdi mdi-check-bold'
                    progressColor = 'white'
                    msgColor = 'white'
                    titleColor = 'white'
                    iconColor = 'white'

                    break;
                case 2: // error

                    Bg = '#f25a57'
                    Title = 'Error'
                    Icon = 'mdi mdi-alert-circle'
                    progressColor = 'white'
                    msgColor = 'white'
                    titleColor = 'white'
                    iconColor = 'white'
                    break;
                case 3: // info
                    Bg = 'rgb(150, 213, 232)'
                    Title = 'Info'
                    Icon = 'mdi mdi-check-circle-outline'
                    progressColor = 'white'
                    msgColor = 'white'
                    titleColor = 'white'
                    iconColor = 'white'
                    break;
                default:
                    break;
            }

            iziToast.show({
                theme: 'light',
                icon: Icon,
                titleColor: titleColor,
                iconColor: iconColor,
                titleSize: '17px',
                title: Title,
                message: msg,
                backgroundColor: Bg,
                messageColor: msgColor,
                maxWidth: 500,
                position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                progressBarColor: progressColor,
                onOpening: function(instance, toast) {
                    console.info('callback abriu!');
                },
                onClosing: function(instance, toast, closedBy) {
                    console.info('closedBy: ' + closedBy); // tells if it was closed by 'drag' or 'button'
                }
            })
        }
    </script>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });


        $(document).ready(function() {

            $('#form_signup').on('submit', function(e) {
                e.preventDefault()
                var formData = $(this).serialize();

                const url = "{{ route('user.store') }}"

                $.ajax({
                    type: "POST",
                    url: url,
                    data: formData,
                    success: function(response) {
                        if (response.status == 400) {
                            $.each(response.errors, function(field, message) {

                                $('.error_' + field).text(message[0])
                            });
                        }

                        if (response.status == 200) {
                            showToast(response.message, 1)
                            setTimeout(function() {
                                window.location.assign(response.redirect)
                            }, 300)
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.error(xhr.responseText);
                    }
                });

            })
        });
    </script>
</body>

</html>