<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        {{ 'System title'}}
    </title>
    @include('partials.head')
</head>

<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-2">
                                <div class="card-header pb-0 text-left bg-transparent">
                                    <h3 class="font-weight-black text-dark display-6">Sign up</h3>
                                    <p class="mb-0">Nice to meet you! Please enter your details.</p>
                                </div>
                                <div class="card-body">

                                    <form role="form" id="admin_form">
                                        <label>Name</label>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="name" placeholder="Enter your name" aria-label="Name" aria-describedby="name-addon">
                                            <span class="error_name label_error text-danger"></span>
                                        </div>
                                        @csrf
                                        <label>Email Address</label>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" name="email" placeholder="Enter your email address" aria-label="Email" aria-describedby="email-addon">
                                            <span class="error_email label_error text-danger"></span>

                                        </div>
                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password" placeholder="Create a password" aria-label="Password" aria-describedby="password-addon">
                                            <span class="error_password label_error text-danger"></span>

                                        </div>

                                        <label>Password Confirmation</label>
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Create a password" aria-label="Password" aria-describedby="password-addon">
                                        </div>
                                        <div class="form-check form-check-info text-left mb-0">
                                            <input class="form-check-input" type="checkbox" value="Y" name="terms" id="flexCheckDefault">
                                            <label class="font-weight-normal text-dark mb-0" for="flexCheckDefault">
                                                I agree the <a href="javascript:;" class="text-dark font-weight-bold">Terms and Conditions</a>.
                                            </label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-dark w-100 mt-4 mb-3" class="btn-submit" id="btn-submit">Sign up</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-xs mx-auto">
                                        Already have an account?
                                        <a href="javascript:;" class="text-dark font-weight-bold">Sign in</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    @include('partials.core_js')

    <script>
        $(document).ready(function() {

            $('#admin_form').on('submit', function(e) {
                e.preventDefault()
                var formData = $(this).serialize();

                const url = "{{ route('admin.register') }}"

                function beforeSend() {
                    $('.label_error').text('')
                    $('#btn-submit').text('Loading...')
                    $('#btn-submit').attr('disabled','disabled')

                }

                function successCallback(response) {

                    if (response.status === 400) {
                        $.each(response.errors, function(field, messages) {

                            $('.error_' + field).text(messages[0])
                        });
                    }

                    if (response.status === 200) {
                       
                        showToast(response.message, 1)

                        setTimeout(function() {
                            window.location.assign("{{ route('admin.login') }}")
                        }, 3000)
                    }

                    $('#btn-submit').text('Sign up')

                    $('#btn-submit').removeAttr('disabled')

                }

                function errorCallback(response) {
                    showToast(response.responseText, 2)
                    $('#btn-submit').removeAttr('disabled')
                    $('#btn-submit').text('Sign up')

                }

                sendPostRequest(url, formData, beforeSend, successCallback, errorCallback)
            })
        });
    </script>
</body>

</html>