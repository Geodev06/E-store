<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Email Verification Notice</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      max-width: 500px;
      margin: 50px auto;
    }
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }
    .card-header {
      background-color: #007bff;
      color: #fff;
      border-radius: 10px 10px 0 0;
    }
    .card-body {
      padding: 30px;
    }
    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
    }
    .btn-primary:hover {
      background-color: #0056b3;
      border-color: #0056b3;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="card">
    <div class="card-header">
      Email Verification Notice
    </div>
    <div class="card-body">
      <p>Thank you for signing up! An email has been sent to your email address for verification.</p>
      <p>If you haven't received the email, please check your spam folder or <a href="#">resend verification email</a>.</p>
    </div>
    <div class="card-footer text-muted">
      <button type="button" class="btn btn-primary">Go to Homepage</button>
    </div>
  </div>
</div>

</body>
</html>
