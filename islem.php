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
$user = "newuser";
$password = "";
$database = "phptest";
$table = "isler";
$db = new PDO("mysql:host=localhost;dbname=$database", $user, $password);

if(isset($_POST["save"]))
{
	
    $kayit = $db->query("SELECT * FROM $table ORDER BY id DESC LIMIT 1");
    foreach($kayit as $row) { 
        $kayitNo = $row['kayitNo'];
    }
	$kayitNo++;
	$kytNo = sprintf("%06s", $kayitNo);
	$bildirimTarihi=date("Y-m-d");
	$kayitAcan=$_POST["uname"];
	$konu=$_POST["konu"];
	$sorumlu=$_POST["sorumlu"];
	$pbtarih=$_POST["pbtarih"];
	$not=$_POST["text"];
	$sql="INSERT INTO isler (bildirimTarihi,kayitAcan,konu,sorumlu,planlananBitisTarihi,notlar,KayitNo) VALUES (:bildirimTarihi, :kayitAcan, :konu, :sorumlu, :pbtarih, :not, :kayitNo)";
	$stmt=$db->prepare($sql);
	$stmt->execute([
		':bildirimTarihi' => $bildirimTarihi,
		':kayitAcan' => $kayitAcan,
		':konu' => $konu,
		':sorumlu' => $sorumlu,
		':pbtarih' =>  $pbtarih,
		':not' => $not,
		':kayitNo'=>$kytNo
	]);

	if($sql){
		?>
			<div class="div1">
			<div class="alert w3-container w3-center w3-animate-top">
			  Kaydınız Alınmıştır...
			</div>
			<div class="yukle"><p>YÖNLENDİRİLİYORSUNUZ<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
			</div>
		<?php
		$url=$_POST["url"];
		header("refresh:3;url=$url");
	}
	else{
		echo "Eklenemedi...";
	}

}
if(isset($_POST["savealtoge"]))
{
	$parentId=$_POST["parentId"];
	$bildirimTarihi=date("Y-m-d");
	$kayitAcan=$_POST["uname"];
	$konu=$_POST["konu"];
	$sorumlu=$_POST["sorumlu"];
	$pbtarih=$_POST["pbtarih"];
	$not=$_POST["text"];
	$sql="INSERT INTO altoge (parentId,bildirimt,kayitAcanP,konu,sorumluP,pbtarihi,note) VALUES (:parentId, :bildirimt, :kayitAcanP, :konu, :sorumluP, :pbtarihi, :note)";
	$stmt=$db->prepare($sql);
	$stmt->execute([
		':parentId' => $parentId,
		':bildirimt' => $bildirimTarihi,
		':kayitAcanP' => $kayitAcan,
		':konu' => $konu,
		':sorumluP' =>  $sorumlu,
		':pbtarihi' => $pbtarih,
		':note'=>$not
	]);

	if($sql){
		?>
			<div class="div1">
			<div class="alert w3-container w3-center w3-animate-top">
			  Kaydınız Alınmıştır...
			</div>
			<div class="yukle"><p>YÖNLENDİRİLİYORSUNUZ<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
			</div>
		<?php
		$url=$_POST["url"];
		header("refresh:3;url=$url");
	}
	else{
		echo "Eklenemedi...";
	}

}
if(isset($_POST['update'])){
	$id=$_POST["id"];
	$isturu = $_POST["isturu"];
	$btarihi=$_POST['btarihi'];
	$kayitAcan=$_POST["uname"];
	$konu=$_POST["konu"];
	$sorumlu=$_POST["sorumlu"];
	$pbtarih=$_POST["pbtarih"];
	$not=$_POST["text"];
	$durum=$_POST["durum"];
	if($durum=="Tamamlandı"){
		$ttarihi=date("Y-m-d");
	}
	$sql=$db->prepare("UPDATE isler SET isturu=:isturu, bildirimTarihi=:bildirimTarihi, kayitAcan=:kayitAcan, konu=:konu, sorumlu=:sorumlu, notlar=:notlar, durum=:durum, planlananBitisTarihi=:planlananBitisTarihi, ttarihi=:ttarihi WHERE id=:id");
	$sql->execute(array(
		'isturu'=>$isturu,
		"bildirimTarihi"=>$btarihi,
		"kayitAcan"=>$kayitAcan,
		'konu'=>$konu,
		'sorumlu'=>$sorumlu,
		'notlar'=>$not,
		'durum'=>$durum,
		'planlananBitisTarihi'=>$pbtarih,
		'ttarihi' => $ttarihi,
		'id'=>$id
	));
	if($sql){
		?>
			<div class="div1">
			<div class="alert w3-container w3-center w3-animate-top">
			  Güncelleme Başarılı...
			</div>
			<div class="yukle"><p>İşlem Devam Ediyor.<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
			</div>
		<?php
		header("refresh:1;url=admin.php");
	}
	else{
		echo "Güncelleme Başarılı Değil...";
	}
}
if(isset($_POST['updatealtoge'])){
	$id=$_POST["id"];
	$parentId=$_POST["parentId"];
	echo $parentId;
	$btarihi=$_POST['btarihi'];
	$kayitAcan=$_POST["uname"];
	$konu=$_POST["konu"];
	$sorumlu=$_POST["sorumlu"];
	$pbtarih=$_POST["pbtarih"];
	$not=$_POST["text"];
	$durum=$_POST["durum"];
	if($durum=="Tamamlandı"){
		$ttarihi=date("Y-m-d");
	}
	$sql=$db->prepare("UPDATE altoge SET bildirimt=:bildirimt, kayitAcanP=:kayitAcanP, konu=:konu, sorumluP=:sorumluP, note=:note, durum=:durum, pbtarihi=:pbtarihi, ttarihi=:ttarihi WHERE id=:id");
	$sql->execute(array(
		"bildirimt"=>$btarihi,
		"kayitAcanP"=>$kayitAcan,
		'konu'=>$konu,
		'sorumluP'=>$sorumlu,
		'note'=>$not,
		'durum'=>$durum,
		'pbtarihi'=>$pbtarih,
		'ttarihi' => $ttarihi,
		'id'=>$id
	));
	if($sql){
		?>
			<div class="div1">
			<div class="alert w3-container w3-center w3-animate-top">
			  Alt Öge Güncelleme Başarılı...
			</div>
			<div class="yukle"><p>İşlem Devam Ediyor.<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
			</div>
		<?php
		header("refresh:3;url=altogeler.php?id=$parentId");
	}
	else{
		echo "Güncelleme Başarılı Değil...";
	}
}

?>
</body>
</html>
