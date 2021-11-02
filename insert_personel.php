<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="edit.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            margin-top: 0% ;
        }
        .txt{
            font-size: 120%;
        }
        .card-body{
            position: relative;
            margin-top: -5% ;
        }
    </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5"><img src="logo1.svg"></h5>
            <form action="loginsettings.php" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="adi" name="adi" placeholder="Adınız" required>
                <label for="floatingInput">Adınız</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="soyadi" name="soyadi" placeholder="Soyadınız" required> 
                <label for="floatingInput">Soyadınız</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="kadi" name="kadi" placeholder="Kullanıcı Adı" required>
                <label for="floatingInput">Kullanıcı Adı</label>
              </div>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="sifre" name="sifre" placeholder="Şifre" required>
                <label for="floatingInput">Şifre</label>
              </div>
              <div class="form-floating mb-3">
                <input type="password" class="form-control" id="resifre" name="resifre" placeholder="Şifre Kontrol" required>
                <label for="floatingInput">Şifre Kontrol</label>
              </div>
              <div class="form-group mb-3">
                  <label for="exampleFormControlFile1">Resminizi Yükleyiniz</label>
                  <input type="file" class="form-control-file" id="file" name="file" required>
              </div>
              </br>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="ekle">Sing Up</button>
              </div>
                </br>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" onclick="geri()">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
<script type="text/javascript">
    function geri(){
        history.back();
    }
</script>
</html>
