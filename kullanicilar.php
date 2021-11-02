<?php
include_once 'connection_settings.php';
session_start();
$eposta=$_SESSION["eposta"];
    $sorgu1=$db->prepare("SELECT * FROM personel WHERE eposta=:eposta");
	$sorgu1->execute(array(
		'eposta'=>$eposta
	));
    $sql1=$sorgu1->fetch(PDO::FETCH_ASSOC);
if($_SESSION["eposta"]==null){
	header("refresh:0;url=login.php");       
}
else if($_SESSION["eposta"]!=null && $sql1["yetki"]=="admin"){
        include_once 'sessionTime.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>İş Takibi</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.div1{
	width:90%;
	margin:auto;
    margin-top:2%;
	font-size: 130%;
	box-shadow: 6px 6px 8px #000;
}
#test{
    width:90%;
	margin:auto;
	text-align:center;
}
#test1{
    width:90%;
	margin:auto;
	pasition:visibility;
}
#test2{
    width:90%;
	margin:auto;
}
#test h1 {
    	font-family: "Lucida Console", "Courier New", monospace;
}
#btn{
	margin-left:0.5%;
    margin-top:0.25%;
	font-size: 130%;
}
#select, #dt ,#dt1, #select1{
    position: relative;
    float:left;
    margin-left:0.5%;
    margin-top:0.5%;
    height:20px;
	font-size: 130%;
}
#btn1{
    float:right;
	font-size: 130%;
}
.txt{
        font-size: 150%;
}
#navbarSupportedContent{
    font-size: 150%;
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body> 
<?php require "loginindex.php"; ?>
<div id="test">
	<h1><p>İŞ TAKİBİ </p></h1>
</div>
    <div class="div1">
	    <table id="table_id" class="display">
		    <thead>
                <tr>
                    <th></th>
                    <th>Kullanıcı Adı</th>
		    <th>ADI</th>
		    <th>SOYADI</th>
		    <th>E MAİL</th>
		    <th>FOTOĞRAF</th>
                    <th>YETKİ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php
            $tarih=$_POST["dt"];
            $secili=$_POST['secili'];
            $durum=$_POST["durum"];
            $sorgu=$_POST["dt1"];

	        $sorgu=$db->query("SELECT * FROM personel");
            
            $i=1;
            foreach($sorgu as $row) { ?>
	            <tr>
		            <td> <?php echo $i ?> </td>
                    <td> <?php echo $row['kadi']; ?></td>
		            <td> <?php echo $row['adi']; ?> </td>
		            <td> <?php echo $row['soyadi']; ?> </td>
		            <td> <?php echo $row['eposta']; ?> </td>
                    <td> <img src="kullaniciResim/<?php echo $row['images'] ?>" width="40" height="40"> </td>
		            <td> <?php echo $row['yetki']; ?> </td>
                    <td><a href="updatepersonel.php?id=<?php echo $row['id']; ?>"><i class='fa fa-edit' style='font-size:36px'></i><a</td>
	            </tr>
            <?php $i++;} ?>
            </tbody>
        </table> 
    </diV>
</div>
</body> 
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script> <script
src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script> <script
src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> <script
src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script> <script
src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#table_id').DataTable();
    });
</script>
</html>
<?php }else{ ?>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
	.div2{
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
	<div class="div2">
			<div class="alert w3-container w3-center w3-animate-top">
			  Bu Sayfada Yetkiniz Bulunmamaktadır...
			</div>
			<div class="yukle"><p>YÖNLENDİRİLİYORSUNUZ<br><i class="fa fa-spinner w3-spin" style="font-size:64px"></i></p></div>
	</div>
<?php
	header("refresh:3;url=index.php");
} ?>
