<?php
$aylar = array ("Ocak","Şubat","Mart","Nisan","Mayıs","Haziran","Temmuz","Ağustos","Eylül","Ekim","Kasım","Aralık");
$ay = (int)date(m);
$ayilkgün0 = date("Y-m-d",strtotime('first day of this month'));
$ayilkgün1 = date("Y-m-d",strtotime('first day of last month'));
$ayilkgün2 = date("Y-m-d",strtotime('first day of -2 month'));
$aysongun0 = date("Y-m-d");
$aysongun1 = date("Y-m-d",strtotime('last day of last month'));
$aysongun2 = date("Y-m-d",strtotime('last day of -2 month'));


$durum0="Devam Ediyor";
$durum1="Tamamlandı";
$durum2="İPTAL";
include_once 'connection_settings.php';
session_start();
$eposta=$_SESSION["eposta"];
$sorgu1=$db->prepare("SELECT * FROM personel WHERE eposta=:eposta");
$sorgu1->execute(array(
	'eposta'=>$eposta
));
$sql1=$sorgu1->fetch(PDO::FETCH_ASSOC);
$kayitA=$sql1["adi"]." ".$sql1["soyadi"];
 
  $cancel=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi>=:date0 and bildirimTarihi<=:date1 and durum=:durum and kayitAcan=:kayitAcan");
    $cancel->execute(array(
        'date0'=>$ayilkgün0,
        'date1'=>$aysongun0,
	    'durum'=>$durum0,
        'kayitAcan'=>$kayitA
    ));
  $ay10=$cancel->rowCount();

  $cancel=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi>=:date0 and bildirimTarihi<=:date1 and durum=:durum and kayitAcan=:kayitAcan");
    $cancel->execute(array(
      'date0'=>$ayilkgün0,
      'date1'=>$aysongun0,
      'durum'=>$durum1,
      'kayitAcan'=>$kayitA
    ));
$ay11=$cancel->rowCount();

$cancel=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi>=:date0 and bildirimTarihi<=:date1 and durum=:durum and kayitAcan=:kayitAcan");
  $cancel->execute(array(
    'date0'=>$ayilkgün0,
    'date1'=>$aysongun0,
    'durum'=>$durum2,
    'kayitAcan'=>$kayitA
  ));
$ay12=$cancel->rowCount();
  
$cancel=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi>=:date0 and bildirimTarihi<=:date1 and durum=:durum and kayitAcan=:kayitAcan");
$cancel->execute(array(
  'date0'=>$ayilkgün1,
  'date1'=>$aysongun1,
  'durum'=>$durum0,
  'kayitAcan'=>$kayitA
));
$ay20=$cancel->rowCount();

$cancel=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi>=:date0 and bildirimTarihi<=:date1 and durum=:durum and kayitAcan=:kayitAcan");
$cancel->execute(array(
  'date0'=>$ayilkgün1,
  'date1'=>$aysongun1,
  'durum'=>$durum1,
  'kayitAcan'=>$kayitA
));
$ay21=$cancel->rowCount();

$cancel=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi>=:date0 and bildirimTarihi<=:date1 and durum=:durum and kayitAcan=:kayitAcan");
$cancel->execute(array(
'date0'=>$ayilkgün1,
'date1'=>$aysongun1,
'durum'=>$durum2,
'kayitAcan'=>$kayitA
));
$ay22=$cancel->rowCount();

$cancel=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi>=:date0 and bildirimTarihi<=:date1 and durum=:durum and kayitAcan=:kayitAcan");
$cancel->execute(array(
  'date0'=>$ayilkgün2,
  'date1'=>$aysongun2,
  'durum'=>$durum0,
  'kayitAcan'=>$kayitA
));
$ay30=$cancel->rowCount();

$cancel=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi>=:date0 and bildirimTarihi<=:date1 and durum=:durum and kayitAcan=:kayitAcan");
$cancel->execute(array(
  'date0'=>$ayilkgün2,
  'date1'=>$aysongun2,
  'durum'=>$durum1,
  'kayitAcan'=>$kayitA
));
$ay31=$cancel->rowCount();

$cancel=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi>=:date0 and bildirimTarihi<=:date1 and durum=:durum and kayitAcan=:kayitAcan");
$cancel->execute(array(
'date0'=>$ayilkgün2,
'date1'=>$aysongun2,
'durum'=>$durum2,
'kayitAcan'=>$kayitA
));
$ay32=$cancel->rowCount();
?>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['', 'Devam Ediyor', 'Tamamlandı', 'İptal'],
          ['<?php echo $aylar[$ay-3]; ?>', <?php echo $ay30 ?>, <?php echo $ay31 ?>, <?php echo $ay32 ?>],
          ['<?php echo $aylar[$ay-2]; ?>', <?php echo $ay20 ?>, <?php echo $ay21 ?>, <?php echo $ay22 ?>],
          ['<?php echo $aylar[$ay-1]; ?>', <?php echo $ay10 ?>, <?php echo $ay11 ?>, <?php echo $ay12 ?>]
        ]);

        var options = {
          backgroundColor: 'none',
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
$(window).resize(function(){
	drawChart();
});
    </script>
  <style>
    #columnchart_material{
      margin:auto;
		  margin-top:5%
    }
    .div1{
      width: 20%;
      margin: auto;
		  margin-top:5%
    }
  </style>
  </head>
  <body>
  <?php require "loginindex.php"; ?>
  <div class="div1">
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <?php echo $aylar[$ay-1]; ?> Ayı Toplam Kayıt
          <span class="badge badge-primary badge-pill">
             <?php  $cancel=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi>=:date0 and bildirimTarihi<=:date1 and kayitAcan=:kayitAcan");
              $cancel->execute(array(
                'date0'=>$ayilkgün0,
                'date1'=>$aysongun0,
                'kayitAcan'=>$kayitA
                )); 
              echo $cancel->rowCount();?>
          </span>
        </li>
      </ul>
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
        <?php echo $aylar[$ay-2]; ?> Ayı Toplam Kayıt
        <span class="badge badge-primary badge-pill">
        <?php  $cancel=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi>=:date0 and bildirimTarihi<=:date1 and kayitAcan=:kayitAcan");
            $cancel->execute(array(
              'date0'=>$ayilkgün1,
              'date1'=>$aysongun1,
              'kayitAcan'=>$kayitA
            )); 
            echo $cancel->rowCount();
            ?>
            </span>
        </li>
      </ul>
      <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
        <?php echo $aylar[$ay-3]; ?> Ayı Toplam Kayıt
        <span class="badge badge-primary badge-pill">
        <?php  $cancel=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi>=:date0 and bildirimTarihi<=:date1 and kayitAcan=:kayitAcan");
            $cancel->execute(array(
              'date0'=>$ayilkgün3,
              'date1'=>$aysongun3,
              'kayitAcan'=>$kayitA
            )); 
            echo $cancel->rowCount();
            ?>
            </span>
        </li>
      </ul>
    </div>
    <div id="columnchart_material" style="width:30%; height: 20%;"></div>
    
  </body>
</html>
