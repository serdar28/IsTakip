<?php
include_once 'connection_settings.php';
session_start();

?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<?php
    $eposta=$_SESSION["eposta"];
    $sorgu=$db->prepare("SELECT * FROM personel WHERE eposta=:eposta");
	$sorgu->execute(array(
		'eposta'=>$eposta
	));
    $sql=$sorgu->fetch(PDO::FETCH_ASSOC);
    session_start();
    if (!$_SESSION["dil"]){
      $_SESSION["dil"]="tr";
      require("dil/tr.php");
    }else {
      require("dil/".$_SESSION["dil"].".php");
    }
?>
<style>
    .nav-link{
        color:black;
    }
    .nav-link:hover{
        color:black;
    }
    .nav-link:hover{
      background-color : gainsboro;
      border-radius: 10px 10px 10px 10px;
      font-size:16px;
    }
    .dil{
      margin-left : 2%;
    }
    .dropdown-menu img{
      width: 25px;
      height: 25px;
    }
    #saat{
      font-size:17px;
      margin-left : 45%;
    }
    <?php
      if($_SESSION["dil"]=="tr"){?>
          .tr{
            background-color: #ADD8E6;
          }
     <?php }else{ ?>
        .en{
            background-color: #ADD8E6;
        }
    <?php } ?>
</style>
<nav class="navbar navbar-white navbar-expand-sm">
  <a class="navbar-brand" href="https://zkportal.ziraatkatilim.local/">
    <img src="logo1.svg" width="150" alt="logo">
  </a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
          <?php
          if($sql["yetki"]=="admin"){ ?>
            <li class="nav-item active">
              <a class="nav-link" href="admin.php"><?php echo $dil[anasayfa]; ?><span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="kullanicilar.php"><?php echo $dil[user]; ?><span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="aylikrapor.php"><?php echo $dil[report]; ?><span class="sr-only">(current)</span></a>
            </li>
        <?php  }else{ ?>
        <li class="nav-item active">
              <a class="nav-link" href="index.php"><?php echo $dil[anasayfa]; ?><span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="kullanicirapor.php"><?php echo $dil[report]; ?><span class="sr-only">(current)</span></a>
            </li>
          </ul>
      <?php  } ?>
  </div>
  <div id="saat"></div>
  <div class="btn-group dil">
    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 12px;"><?php echo $dil[dilsecimi]; ?></button>
    <div class="dropdown-menu">
      <a style="font-size: 12px;" class="dropdown-item tr" href="dil.php?dil=tr"><img src="trlogo.png" alt="tr"> <?php echo $dil[tr]; ?></a>
      <a style="font-size: 12px;" class="dropdown-item en" href="dil.php?dil=en"><img src="enlogo.png" alt="en"> <?php echo $dil[en]; ?></a>
    </div>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbar-list-4">
      <ul class="navbar-nav ml-auto txt">
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="kullaniciResim/<?php echo $sql['images'] ?>" width="40" height="40" class="rounded-circle">
          <?php echo $sql["adi"]." ".$sql["soyadi"]; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item txt" href="editprofile.php?id=<?php echo $sql['id']; ?>"><?php echo $dil[EditProfile]; ?></a>
          <a class="dropdown-item txt" href="login.php"><?php echo $dil[LogOut]; ?></a>
        </div>
      </li>   
    </ul>
  </div>
</nav>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){setInterval(function(){ 
    $.ajax({
      type:'post',
      url: 'datesettings.php',
      success:function(x){
        $('#saat').html(x);
      }
    });
  },1000)
});

</script>
