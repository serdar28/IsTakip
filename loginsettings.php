<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
	.div1{
		width:20%;
		height:100%;
		pasiton:absolute;
		margin:auto;
		margin-top:20%;
		text-align:center;
		font-family:  Georgia, "Times New Roman", serif;
	}
	.alert{
		pasiton:absolute;
        margin:auto;
		background-color:lightblue;
		font-size:40px;
	}
  </style>
</head>
<body>

<?php
include_once 'connection_settings.php';
if(isset($_POST["login"])){
    session_start();
    $eposta = $_POST["eposta"];
    $sifre = $_POST["sifre"];
    $sorgu=$db->prepare("SELECT * FROM personel WHERE eposta=:eposta and sifre=:sifre");
    $sorgu->execute(array(
	    'eposta'=>$eposta,
        'sifre'=>$sifre  
    ));
    $sql=$sorgu->fetch(PDO::FETCH_ASSOC);
    $_SESSION["timeout"]=time();
    $_SESSION["eposta"]=$sql['eposta'];
    if($sql){
        if($sql["yetki"]=="admin"){
            if(isset($_POST["hatirla"])){
                setcookie("eposta",$eposta,strtotime("+1 day"));
                setcookie("sifre",$sifre,strtotime("+1 day"));
            }
            header("refresh:1;url=admin.php");
        }
        else if($sql["yetki"]=="kullanici"){
            header("refresh:1;url=index.php");
        }
        
    }
    else{
        echo "<script>alert('E-mail ya da şifre yanlış girilmiştir...')</script>";
        header("refresh:0;url=login.php");
    }
}
else if(isset($_POST["cancel"])){
    $kadi = $_POST["kadi"];
    $cancel=$db->prepare("SELECT * FROM personel WHERE kadi=:kadi");
    $cancel->execute(array(
	    'kadi'=>$kadi
    ));
    $sqlc=$cancel->fetch(PDO::FETCH_ASSOC);
    if($sqlc["yetki"]=="admin"){
        header("refresh:0;url=admin.php");
    }
    else if($sqlc["yetki"]=="kullanici"){
        header("refresh:0;url=index.php");
    }
    else{
		header("refresh:0;url=login.php");
    }
}
else if(isset($_POST["update"])){
    $Dturu = array("image/jpeg","image/jpg","image/x-png","image/png");
    $Duzanti = array("jpeg","jpg","png");
    $kaynak = $_FILES['file']['tmp_name'];
    $resim = $_FILES['file']['name'];
    $boyut = $_FILES['file']['size'];
    $turu = $_FILES['file']['type'];
    $uzanti = substr($resim,strpos($resim,'.')+1);
    $yeniAd = substr(uniqid(md5(rand())),0,35).'.'.$uzanti;
    $hedef = "kullaniciResim/";
    $adi = $_POST["adi"];
    $soyadi = $_POST["soyadi"];
    $kadi = $_POST["kadi"];
    $id=$_POST["id"];
    if($kaynak){
        if(!in_array($turu,$Dturu) && !in_array($uzanti,$Duzanti)){
            echo "Lütfen Bir Resim DOsyası Seçiniz!!!";
        }
        else if($boyut>1024*1024){
            echo "Dosya Boyutu 1MB Yüksel Olmamalı!!!";
        }
        else{
            if(move_uploaded_file($kaynak,$hedef.$yeniAd)){
                $update = $db->prepare("UPDATE personel SET kadi=:kadi, adi=:adi, soyadi=:soyadi, images=:images WHERE id=:id");
                $update->execute(array(
                    'kadi'=>$kadi,
                    'adi'=>$adi,
                    'soyadi'=>$soyadi,
                    'images'=>$yeniAd,
                    'id'=>$id
                ));
                if($update){
                    ?>
			            <div class="div1">
			                <div class="alert w3-container w3-center w3-animate-top">Resim Yükleme İşlemi Başarılıdır...</div>
			                <div class="yukle"><p>YÖNLENDİRİLİYORSUNUZ<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
			            </div>
		            <?php
		            $url=$_SERVER['HTTP_REFERER'];
		            header("refresh:2;url=$url");
                }
                else{
                    echo "Resim VeriTabanına Yüklenirken Hata oluştu...";
                }
            }
            else{
                echo "Dosya Yükleme İşlemi Başarısız Olmuştur!!!";
            }
        }
    }

}
else if(isset($_POST["updateprofile"])){
    $Dturu = array("image/jpeg","image/jpg","image/x-png","image/png");
    $Duzanti = array("jpeg","jpg","png");
    $kaynak = $_FILES['file']['tmp_name'];
    $resim = $_FILES['file']['name'];
    $boyut = $_FILES['file']['size'];
    $turu = $_FILES['file']['type'];
    $uzanti = substr($resim,strpos($resim,'.')+1);
    $yeniAd = substr(uniqid(md5(rand())),0,35).'.'.$uzanti;
    $hedef = "kullaniciResim/";
    $adi = $_POST["adi"];
    $soyadi = $_POST["soyadi"];
    $kadi = $_POST["kadi"];
    $yetki=$_POST["yetki"];
    $id=$_POST["id"];
    if($kaynak){
        if(!in_array($turu,$Dturu) && !in_array($uzanti,$Duzanti)){
            echo "Lütfen Bir Resim DOsyası Seçiniz!!!";
        }
        else if($boyut>1024*1024){
            echo "Dosya Boyutu 1MB Yüksel Olmamalı!!!";
        }
        else{
            if(move_uploaded_file($kaynak,$hedef.$yeniAd)){
                $update = $db->prepare("UPDATE personel SET kadi=:kadi, adi=:adi, soyadi=:soyadi, images=:images, yetki=:yetki WHERE id=:id");
                $update->execute(array(
                    'kadi'=>$kadi,
                    'adi'=>$adi,
                    'soyadi'=>$soyadi,
                    'images'=>$yeniAd,
                    'yetki'=>$yetki,
                    'id'=>$id
                ));
                if($update){
                    ?>
			            <div class="div1">
			                <div class="alert w3-container w3-center w3-animate-top">Kullanıcı Güncelleme İşlemi Başarılıdır...</div>
			                <div class="yukle"><p>YÖNLENDİRİLİYORSUNUZ<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
			            </div>
		            <?php
		            $url=$_SERVER['HTTP_REFERER'];
		            header("refresh:2;url=$url");
                }
                else{
                    echo "Resim VeriTabanına Yüklenirken Hata oluştu...";
                }
            }
            else{
                echo "Dosya Yükleme İşlemi Başarısız Olmuştur!!!";
            }
        }
    }
    else{
        $update = $db->prepare("UPDATE personel SET kadi=:kadi, adi=:adi, soyadi=:soyadi, yetki=:yetki WHERE id=:id");
        $update->execute(array(
            'kadi'=>$kadi,
            'adi'=>$adi,
            'soyadi'=>$soyadi,
            'yetki'=>$yetki,
            'id'=>$id
        ));
        if($update){
            ?>
                <div class="div1">
                    <div class="alert w3-container w3-center w3-animate-top">Kullanıcı Güncelleme İşlemi Başarılıdır...</div>
                    <div class="yukle"><p>YÖNLENDİRİLİYORSUNUZ<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
                </div>
            <?php
            $url=$_SERVER['HTTP_REFERER'];
            header("refresh:2;url=$url");
        }
    }

}
else if(isset($_POST["kayit"])){
    header("refresh:0;url=insert_personel.php");
}
else if(isset($_POST["ekle"])){
    $sorgu=$db->query("SELECT * FROM personel");
    $adi = $_POST["adi"];
    $soyadi = $_POST["soyadi"];
    $kadi = $_POST["kadi"];
    $eposta = $_POST["email"];
    $sifre = $_POST["sifre"];
    $resifre = $_POST["resifre"];
    
    $Dturu = array("image/jpeg","image/jpg","image/x-png","image/png");
    $Duzanti = array("jpeg","jpg","png");
    $kaynak = $_FILES['file']['tmp_name'];
    $resim = $_FILES['file']['name'];
    $boyut = $_FILES['file']['size'];
    $turu = $_FILES['file']['type'];
    $uzanti = substr($resim,strpos($resim,'.')+1);
    $yeniAd = substr(uniqid(md5(rand())),0,35).'.'.$uzanti;
    $hedef = "kullaniciResim/";

    foreach($sorgu as $row){
        if($row["kadi"]==$kadi){
            ?>
                <div class="div1">
                    <div class="alert w3-container w3-center w3-animate-top">Kullanıcı Adı Sistemde Kayıtlıdır</div>
                    <div class="yukle"><p>YÖNLENDİRİLİYORSUNUZ<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
                </div>
            <?php
            header("refresh:2;url=insert_personel.php");
        }
        else if($row["eposta"]==$eposta){
            ?>
                <div class="div1">
                    <div class="alert w3-container w3-center w3-animate-top">Mail Adresiniz Sistemde Kayıtlıdır</div>
                    <div class="yukle"><p>YÖNLENDİRİLİYORSUNUZ<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
                </div>
            <?php
            header("refresh:2;url=insert_personel.php");
        }
    }
    if($sifre == $resifre){
        if($kaynak){
            if(!in_array($turu,$Dturu) && !in_array($uzanti,$Duzanti)){
                echo "Lütfen Bir Resim DOsyası Seçiniz!!!";
            }
            else if($boyut>1024*1024){
                echo "Dosya Boyutu 1MB Yüksel Olmamalı!!!";
            }
            else{
                if(move_uploaded_file($kaynak,$hedef.$yeniAd)){
                    $sql1=$db->prepare("SELECT * FROM personel WHERE kadi=:kadi");
                    $sql1->execute(array(
                        'kadi'=>$kadi
                    ));
                    if($sql1->rowCount()!=0){
                        ?>
                            <div class="div1">
                                <div class="alert w3-container w3-center w3-animate-top">Kullanıcı Adı Kullanılmıştır...</div>
                                <div class="yukle"><p>YÖNLENDİRİLİYORSUNUZ<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
                            </div>
                        <?php
                        header("refresh:2;url=insert_personel.php");
                    }
                    $sql2=$db->prepare("SELECT * FROM personel WHERE eposta=:eposta");
                    $sql2->execute(array(
                        'eposta'=>$eposta
                    ));
                    if($sql2->rowCount()!=0){
                        ?>
                            <div class="div1">
                                <div class="alert w3-container w3-center w3-animate-top">Mail Adresi Kayıtlıdır..</div>
                                <div class="yukle"><p>YÖNLENDİRİLİYORSUNUZ<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
                            </div>
                        <?php
                        header("refresh:2;url=insert_personel.php");
                    }
                    if($sql1->rowCount()==0 and $sql2->rowCount()==0){
                            $sql="INSERT INTO personel (kadi,sifre,eposta,adi,soyadi,images,yetki) VALUES (:kadi, :sifre, :eposta, :adi, :soyadi, :images, :yetki)";
                            $stmt=$db->prepare($sql);
                            $stmt->execute([
                                ':kadi' => $kadi,
                                ':sifre' => $sifre,
                                ':eposta' => $eposta,
                                ':adi' => $adi,
                                ':soyadi' =>  $soyadi,
                                ':images' => $yeniAd,
                                ':yetki'=>"kullanici"
                            ]);
                            if($stmt){
                            ?>
                                <div class="div1">
                                    <div class="alert w3-container w3-center w3-animate-top">Kayıt İşlemi Başarılıdır...</div>
                                    <div class="yukle"><p>YÖNLENDİRİLİYORSUNUZ<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
                                </div>
                            <?php
                            header("refresh:2;url=login.php");
                        }
                        else{
                            ?>
                                <div class="div1">
                                    <div class="alert w3-container w3-center w3-animate-top">Kayıt İşlemi Yapılırken Hata Oluştu...</div>
                                    <div class="yukle"><p>YÖNLENDİRİLİYORSUNUZ<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
                                </div>
                            <?php
                            header("refresh:2;url=insert_personel.php");
                        }
                    }
                }
                else{
                    echo "Dosya Yükleme İşlemi Başarısız Olmuştur!!!";
                }
            }
        }
    }
    else{
        echo "<script>alert('Şifreler Uyuşmamaktadır...')</script>";
        header("refresh:0;url=insert_personel.php");
    }

}
?>