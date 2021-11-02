<?php
    include_once 'connection_settings.php';
    session_start();
    $eposta=$_SESSION["eposta"];
    $sorgu1=$db->prepare("SELECT * FROM personel WHERE eposta=:eposta");
	$sorgu1->execute(array(
		'eposta'=>$eposta
	));
    $sql1=$sorgu1->fetch(PDO::FETCH_ASSOC);
    echo $sql1["adi"];
    $dil	=strip_tags($_GET["dil"]);
    if ($dil =="tr" || $dil == "en" || $dil == "ar"){
    	$_SESSION["dil"] = $dil;
        if($dil =="tr"){
            $_SESSION["selected"]=$dil;
        }
        else if($dil=="en"){
            $_SESSION["selected"]=$dil;
        }
        else{
            $_SESSION["selected"]=$dil;
        }
    	if($sql1["yetki"]=="admin"){
            header("Location:admin.php");
        }
        else{
            header("Location:index.php");
        }
    }else {
    	if($sql1["yetki"]=="admin"){
            header("Location:admin.php");
        }
        else{
            header("Location:index.php");
        }
    }

?>