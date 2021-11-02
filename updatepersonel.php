<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
	h2, h6{
	  margin:auto;
    margin-top:2%;
    font-family: "Lucida Console", "Courier New", monospace;
    text-align:center;
	}
	.was-validated{
	  width:50%;
	  margin:auto;
	  margin-top:2%;
	}
  #navbarSupportedContent{
    visibility: hidden;
  }
  </style>
</head>
<body>
<?php require "loginindex.php"; ?>
<?php
    include_once 'connection_settings.php';
    $id=$_GET['id'];
    $sorgu=$db->prepare("SELECT * FROM personel WHERE id=:id");
    $sorgu->execute(array(
        ':id'=>$id
    ));
    $row = $sorgu -> fetch(PDO::FETCH_ASSOC);
?>
<div class="container">
  <h2>İŞ TAKİBİ</h2>
  <h6>UPDATE</h6>
  <i class="fa fa-arrow-circle-left" style='font-size:36px' onClick="geri()"></i>
  <form action="loginsettings.php" method="post" class="was-validated" enctype="multipart/form-data">
    <div class="form-group">
      <label for="uname">Kullanıcı Adı</label>
      <input type="text" class="form-control" id="kadi" name="kadi" value="<?php echo $row['kadi']; ?>">
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="uname">Adı</label>
      <input type="text" class="form-control" id="adi" placeholder="Adınız" name="adi" value="<?php echo $row['adi']; ?>" required>
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="uname">Soyadı</label>
      <input type="text" class="form-control" id="soyadi" placeholder="Soyadınız" name="soyadi" value="<?php echo $row['soyadi']; ?>" required>
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="uname">Mail</label>
      <input type="mail" class="form-control" id="eposta" name="eposta" value="<?php echo $row['eposta']; ?>" required disabled>
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="uname">Fotoğraf</label>
      <input type="file" class="form-control" id="file" name="file">
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="uname">Yetki</label>
      <select name="yetki" class="form-control" >
            <?php
                $yetki=$row['yetki']; 
                if($yetki=="admin"){?>
                    <option selected value="<?php echo $row['yetki'] ?>" > <?php echo $row['yetki'] ?> </option>
                    <option value="kullanici">Kullanici</option>
        <?php   } 
                else if($yetki=="kullanici"){ ?>
                    <option value="admin">admin</option>
                    <option selected value="<?php echo $row['yetki'] ?>" > <?php echo $row['yetki'] ?> </option>
        <?php   }   ?>
        </select>
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['id']; ?>">
      <div class="valid-feedback"></div>
     </div>
    <button type="submit" class="btn btn-primary" name="updateprofile">UPDATE PERSONEL</button>
  </form>
</div>

</body>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script> 
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script type="text/javascript">

		function geri(){

			window.location.assign("kullanicilar.php")

		}

	</script>

</html>
