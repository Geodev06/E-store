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
                  <h3 class="font-weight-black text-dark display-6">Sign in</h3>
                  <p class="mb-0">Nice to meet you! Please enter your details.</p>
                </div>
                <div class="card-body">
                  <form role="form" id="sign_in_form">
                    <label>Email Address</label>
                    @csrf
                    <div class="mb-3">
                      <input type="email" class="form-control" name="email" placeholder="Enter your email address" aria-label="Email" aria-describedby="email-addon">
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" class="form-control" name="password" placeholder="Create a password" aria-label="Password" aria-describedby="password-addon">
                    </div>
                    <div class="form-check form-check-info text-left mb-0">
                      <input class="form-check-input" type="checkbox" value="" name="remember" id="flexCheckDefault">
                      <label class="font-weight-normal text-dark mb-0" for="flexCheckDefault">
                        Remember me
                      </label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-dark w-100 mt-4 mb-3" id="btn-signin">Sign up</button>

                    </div>
                  </form>
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
</body>
<script>
  $(document).ready(function() {

    $('#sign_in_form').on('submit', function(e) {
      e.preventDefault()
      var formData = $(this).serialize();

      const url = "{{ route('admin.signin') }}"

      function beforeSend() {
        $('.label_error').text('')
        $('#btn-signin').text('Signing in...')
        $('#btn-signin').attr('disabled', 'disabled')

      }

      function successCallback(response) {


        if (response.email_sent === 'ok') {
          showToast(response.msg, 3)
        }

        if (response.sign_in_status === 200) {
         window.location.assign("{{ route('admin.dashboard') }}")
        }

        $('#btn-signin').text('Sign in')

        $('#btn-signin').removeAttr('disabled')

      }

      function errorCallback(response) {
        showToast(response.responseText, 2)
        $('#btn-signin').removeAttr('disabled')
        $('#btn-signin').text('Sign up')

      }

      sendPostRequest(url, formData, beforeSend, successCallback, errorCallback)
    })
  });
</script>

</html>