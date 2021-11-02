<?php 
session_start();
$_SESSION["eposta"];
session_destroy(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="edit.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <title>Login Page</title>
    <style>
        body {
            background: #007bff;
            background: linear-gradient(to right, #995974, #959376);
        }
        .btn-login {
            font-size: 0.9rem;
            letter-spacing: 0.05rem;
            padding: 0.75rem 1rem;
        }
        .container{
            position: relative;
            margin-top: 10% ;
          
        }
    </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5"><img src="login.jpeg"></h5>
            <form action="loginsettings.php" method="post">
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="floatingInput" name="eposta" placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="floatingPassword" name="sifre" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
              </div>

              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="rememberPasswordCheck" name="hatirla">
                <label class="form-check-label" for="rememberPasswordCheck">
                  Beni Hatırla
                </label>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="login">Sign in</button>
                </br>
              </div>
            </form>
            <form action="loginsettings.php" method="post">
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="kayit">Sign up</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
