<?php
include_once 'connection_settings.php';
session_start();
$id=$_GET["id"];
$eposta=$_SESSION["eposta"];
    $sorgu1=$db->prepare("SELECT * FROM personel WHERE eposta=:eposta");
	$sorgu1->execute(array(
		'eposta'=>$eposta
	));
  $sql1=$sorgu1->fetch(PDO::FETCH_ASSOC);
  $sql=$db->query("SELECT * FROM personel");
if($_SESSION["eposta"]==null){
	header("refresh:0;url=login.php");       
}
else if($_SESSION["eposta"]!=null){
        include_once 'sessionTime.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>İş Takibi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
  <style>
	h2, h3{
	  margin:auto;
    margin-top:2%;
    font-family: "Lucida Console", "Courier New", monospace;
    text-align:center;
	}
	.was-validated{
	  width:50%;
	  margin:auto;
	  margin-top:5%;
	}
  </style>
</head>
<?php  include_once 'sessionTime.php'; ?>
<body>
<div class="container">

  <h2>İŞ TAKİBİ</h2>
  <h3>INSERT</h3>
  <i class="fa fa-arrow-circle-left" style='font-size:36px' onClick="geri()"></i>
  <form action="islem.php" method="post" class="was-validated">
    <div class="form-group">
      <label for="uname">Kayıt Açan:</label>
      <select name="uname" class="selectpicker form-control" data-live-search="true" required>
            <option value="<?php echo $sql1['adi']." ".$sql1['soyadi']; ?>" selected> <?php echo $sql1['adi']." ".$sql1['soyadi']; ?> </option>
            <li class="divider"></li>
            <?php foreach($sql as $row) { 
                if($sql1["adi"]!=$row["adi"]){
                  ?>
                    <option value="<?php echo $row['adi']." ".$row['soyadi']; ?>" > <?php echo $row['adi']." ".$row['soyadi']; ?> </option>
          <?php } } ?>
        </select>
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="konu">Konu:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Konu" name="konu" required>
      <div class="valid-feedback"></div>
     </div>
     <div class="form-group">
      <label for="sorumlu">Sorumlu:</label>
      <select name="sorumlu" class="selectpicker form-control" data-live-search="true" required>
            <option selected disabled >Sorumlu Seçiniz...</option>
            <li class="divider"></li>
            <?php 
            $sql=$db->query("SELECT * FROM personel");
            foreach($sql as $row1) { ?>
                    <option value="<?php echo $row1['adi']." ".$row1['soyadi']; ?>" > <?php echo $row1['adi']." ".$row1['soyadi']; ?> </option>
          <?php } ?>
        </select>
      <div class="valid-feedback"></div>
    </div>    
    <div class="form-group">
      <label for="uname">Planlanan Bitiş Tarihi:</label>
      <input type="date" class="form-control" id="uname" name="pbtarih" required>
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="comment">Not:</label>
      <textarea class="form-control" rows="5" id="comment" name="text" required></textarea>
    </div>
    <input type="hidden" class="form-control" id="uname" name="url" value="<?php echo $_SERVER['HTTP_REFERER']; ?>">
    <div class="form-group">
      <input type="hidden" class="form-control" id="id" name="parentId" value="<?php echo $id; ?>">
      <div class="valid-feedback"></div>

    <button type="submit" class="btn btn-primary" name="savealtoge">ADD</button>
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

			history.back()

		}
    
	</script>
</html>
<?php } ?>
