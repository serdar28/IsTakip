<?php session_start(); include_once 'sessionTime.php'; ?>
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
            margin-top: 1% ;
        }
        .txt{
            font-size: 120%;
        }
        .card-title{
            position: relative;
            margin-top: -10% ;
        }
    </style>
</head>
<body>
<?php
    include_once 'connection_settings.php';
    $id=$_GET['id'];
    $sorgu=$db->prepare("SELECT * FROM personel WHERE id=:id");
    $sorgu->execute(array(
        ':id'=>$id
    ));
    $row = $sorgu -> fetch(PDO::FETCH_ASSOC);
    require "loginindex.php";
?>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h5 class="card-title text-center mb-5 fw-light fs-5"><img src="kullaniciResim/<?php echo $sql['images'] ?>" width="60" height="60" class="rounded-circle"></br><img src="logo1.svg"></h5>
            <form action="loginsettings.php" method="post" enctype="multipart/form-data">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="adi" name="adi" placeholder="Adınız" value="<?php echo $row["adi"] ?>">
                <label for="floatingInput">Adınız</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="soyadi" name="soyadi" placeholder="Soyadınız" value="<?php echo $row["soyadi"] ?>"> 
                <label for="floatingInput">Soyadınız</label>
              </div>
              <div class="form-floating mb-3">
                <input type="text" class="form-control" id="kadi" name="kadi" placeholder="Kullanıcı Adı" value="<?php echo $row["kadi"] ?>">
                <label for="floatingInput">Kullanıcı Adı</label>
              </div>
              <div class="form-floating mb-3">
                <input type="email" class="form-control" id="eposta" name="eposta" placeholder="name@example.com" value="<?php echo $row["eposta"] ?>">
                <label for="floatingInput">Email address</label>
              </div>
              <div class="form-floating mb-3">
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row["id"] ?>">
              </div>
              <div class="form-group mb-3">
                  <label for="exampleFormControlFile1">Resminizi Değiştiriniz</label>
                  <input type="file" class="form-control-file" id="file" name="file">
              </div>
              </br>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="update">Update</button>
              </div>
              </br>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="cancel">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>

</script>
</body>
</html>