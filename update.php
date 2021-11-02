<?php 
include_once 'connection_settings.php';
session_start();
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
  </style>
</head>
<body>
<?php
    include_once 'connection_settings.php';
    $table = "isler";
    $id=$_GET['id'];
    $sorgu=$db->prepare("SELECT * FROM $table WHERE id=:id");
    $sorgu->execute(array(
        ':id'=>$id
    ));
    $row = $sorgu -> fetch(PDO::FETCH_ASSOC);
?>
<div class="container">
  <h2>İŞ TAKİBİ</h2>
  <h6>UPDATE</h6>
  <i class="fa fa-arrow-circle-left" style='font-size:36px' onClick="geri()"></i>
  <form action="islem.php" method="post" class="was-validated">
  <div class="form-group">
      <label for="uname">Kayıt Türü:</label>
      <select name="isturu" class="form-control" >
            <option selected disabled >Kayıt Türü Seçiniz...</option>
            <?php
                $tur=$row['isturu']; 
                if($tur=="İstek"){?>
                    <option selected value="<?php echo $row['isturu'] ?>" > <?php echo $row['isturu'] ?> </option>
                    <option value="Hata">Hata</option>
        <?php   } 
                else if($tur=="Hata"){ ?>
                    <option value="İstek">İstek</option>
                    <option selected value="<?php echo $row['isturu'] ?>" > <?php echo $row['isturu'] ?> </option>
        <?php   }
                else{ ?>
                    <option value="İstek">İstek</option>
                    <option value="Hata">Hata</option>
             <?php   } ?>
        </select>
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="uname">Bildirim Tarihi:</label>
      <input type="date" class="form-control" id="btarihi" name="btarihi" value="<?php echo $row['bildirimTarihi']; ?>">
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="uname">Kayıt Açan:</label>
      <select name="uname" class="selectpicker form-control" data-live-search="true" >
      <option value="<?php echo $row['kayitAcan']; ?>" selected> <?php echo $row['kayitAcan']; ?> </option>
            <li class="divider"></li>
            <?php foreach($sql as $row1) { 
                if($row["kayitAcan"]!=($row1['adi']." ".$row1['soyadi'])){
                  ?>
                    <option value="<?php echo $row1['adi']." ".$row1['soyadi']; ?>" > <?php echo $row1['adi']." ".$row1['soyadi']; ?> </option>
          <?php } } ?>
      </select>
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="konu">Konu:</label>
      <input type="text" class="form-control" id="pwd" placeholder="Konu" name="konu" value="<?php echo $row['konu']; ?>" required>
      <div class="valid-feedback"></div>
     </div>
    <div class="form-group">
      <label for="uname">Sorumlu:</label>
      <input type="text" class="form-control" id="uname" placeholder="Sorumlu Olan Kullanıcı" name="sorumlu" value="<?php echo $row['sorumlu']; ?>" required>
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="uname">Planlanan Bitiş Tarihi:</label>
      <input type="date" class="form-control" id="uname" name="pbtarih" value="<?php echo $row['planlananBitisTarihi']; ?>" required>
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="uname">Durum</label>
      <select name="durum" class="form-control" >
            <option selected disabled >Durum Seçiniz...</option>
            <?php
                $durum=$row['durum']; 
                if($durum=="Devam Ediyor"){?>
                    <option selected value="<?php echo $row['durum'] ?>" > <?php echo $row['durum'] ?> </option>
                    <option value="Tamamlandı">Tamamlandı</option>
                    <option value="İPTAL">İPTAL</option>
        <?php   } 
                else if($durum=="Tamamlandı"){ ?>
                    <option value="Devam Ediyor">Devam Ediyor</option>
                    <option selected value="<?php echo $row['durum'] ?>" > <?php echo $row['durum'] ?> </option>
                    <option value="İPTAL">İPTAL</option>
        <?php   }
                else if($durum=="İPTAL"){ ?>                    
                    <option value="Devam Ediyor">Devam Ediyor</option>
                    <option value="Tamamlandı">Tamamlandı</option>
                    <option selected value="<?php echo $row['durum'] ?>" > <?php echo $row['durum'] ?> </option>
        <?php   }
                else{ ?>
                    <option value="Devam Ediyor">Devam Ediyor</option>
                    <option value="Tamamlandı">Tamamlandı</option>
                    <option value="İPTAL">İPTAL</option>
             <?php   } ?>
        </select>
      <div class="valid-feedback"></div>
    </div>
    <div class="form-group">
      <label for="comment">Not:</label>
      <textarea class="form-control" rows="5" id="comment" name="text"><?php echo $row['notlar']; ?> </textarea>
    </div>
    <div class="form-group">
      <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $row['id']; ?>">
      <div class="valid-feedback"></div>
     </div>
     <div class="form-group">
      <input type="hidden" class="form-control" id="ttarihi" name="ttarihi" value="<?php echo $row['ttarihi']; ?>">
      <div class="valid-feedback"></div>
     </div>
    <button type="submit" class="btn btn-primary" name="update">UPDATE</button>
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
