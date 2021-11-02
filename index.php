<?php
include_once 'connection_settings.php';
$table = "isler";
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
else if($_SESSION["eposta"]!=null && $sql1["yetki"]=="kullanici"){
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
#test {
    	font-family: "Lucida Console", "Courier New", monospace;
		font-size:350%;
}
#btn{
	margin-left:0.5%;
    margin-top:0.25%;
	font-size: 130%;
}
#select, #dt ,#dt1, #select1, #sorumlu{
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
.selectpicker{
	width:50px;
}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>

</head>
<body> 
<?php require "loginindex.php"; ?>
<p id="test"><em> <?php echo $dil[JOBFOLLOW]; ?> </em></p>
	<div id="test1"> 
		<button id="btn1"><a href="insertdata.php" ><?php echo $dil[add] ?></a></button>
    </div>
    <div id="test2">
	    <form method="post" action=""> 
	        <select id="select" class="form-select" name="secili" aria-label="Disabled select example" onchange="tarih()">
		        <option value="0" selected>Tüm Veriler</option>
		        <option value="1">Bildirim Tarihi</option>
		        <option value="2">Durum</option>
				<option value="3">Sorumlu</option>
	        </select>
            <?php
                $dt=date("Y-m-d");
            ?>
            <input type="date" id="dt" value="<?php echo $dt; ?>" name="dt">
            <select id="dt1" class="form-select" name="dt1" aria-label="Disabled select example">
		        <option value="Eşittir" selected>Eşittir</option>
		        <option value="Önce">Önce</option>
		        <option value="Sonra">Sonra</option>
	        </select>
            <select id="select1" class="form-select" name="durum" aria-label="Disabled select example">
		        <option value="Devam Ediyor" selected>Devam Ediyor</option>
		        <option value="Tamamlandı">Tamamlandı</option>
		        <option value="İPTAL">İPTAL</option>
	        </select>
			<select id="sorumlu" class="form-select" name="sorumlu" aria-label="Disabled select example">
            	<option selected >Sorumlu Seçiniz...</option>
            	<?php 
            	$sql=$db->query("SELECT * FROM personel");
            	foreach($sql as $row1) { ?>
                    <option value="<?php echo $row1['adi']." ".$row1['soyadi']; ?>" > <?php echo $row1['adi']." ".$row1['soyadi']; ?> </option>
          <?php } ?>
        </select>
	        <button type="submit" class="btn btn-primary" id="btn" name="getir">GETİR</button>
        </form>
    </div>		
    <div class="div1">
	    <table id="table_id" class="display">
		    <thead>
                <tr>
					<th>#</th>
                    <th style="text-align:center"><?php echo $dil[ViewSubRecord]; ?></th>
                    <th><?php echo $dil[kayitno]; ?></th>
		            <th><?php echo $dil[bildirimt]; ?></th>
		            <th><?php echo $dil[kayitacan]; ?></th>
		            <th><?php echo $dil[konu]; ?></th>
		            <th><?php echo $dil[sorumlu]; ?></th>
		            <th><?php echo $dil[planlananbt]; ?></th>
		            <th><?php echo $dil[tamamlanmat]; ?></th>
		            <th><?php echo $dil[status]; ?></th>
		            <th><?php echo $dil[operation]; ?></th>
                </tr>
            </thead>
            <tbody>
            <?php
            $tarih=$_POST["dt"];
            $secili=$_POST['secili'];
            $durum=$_POST["durum"];
            $sorgu=$_POST["dt1"];
			$sorumlu=$_POST["sorumlu"];
					
			if($_POST){
				echo "<script> 
				document.getElementById('dt').value='".$tarih."';
				document.getElementById('select1').value='".$durum."';
				document.getElementById('dt1').value='".$sorgu."';
				document.getElementById('sorumlu').value='".$sorumlu."';
				val=document.getElementById('select').value='".$secili."';
				if(val==1){
					document.getElementById('dt').style.display = 'block';
					document.getElementById('dt1').style.display = 'block';
					document.getElementById('select1').style.display = 'none';
					document.getElementById('sorumlu').style.display = 'none';
					document.getElementById('dt').style.top = '10%';
					document.getElementById('dt1').style.top = '10%';
				}
				else if(val==2){
					document.getElementById('select1').style.display = 'block';
					document.getElementById('dt').style.display = 'none';
					document.getElementById('dt1').style.display = 'none';
					document.getElementById('sorumlu').style.display = 'none';
					document.getElementById('select1').style.top = '1%';
				}
				else if(val==3){
					document.getElementById('sorumlu').style.display = 'block';
					document.getElementById('select1').style.display = 'none';
    				document.getElementById('dt').style.display = 'none';
    				document.getElementById('dt1').style.display = 'none';
    				document.getElementById('select1').style.top = '1%';
				}
				else{
					document.getElementById('dt').style.display = 'none';
					document.getElementById('dt1').style.display = 'none';
					document.getElementById('select1').style.display = 'none';
					document.getElementById('sorumlu').style.display = 'none';
				}
			
				</script>";
			}
			else{
				echo "<script>
					document.getElementById('dt').style.display = 'none';
					document.getElementById('dt1').style.display = 'none';
					document.getElementById('select1').style.display = 'none';
					document.getElementById('sorumlu').style.display = 'none';
				</script>";
			}
			$as=$sql1['adi']." ".$sql1['soyadi'];
            if($secili==1){
		        if($sorgu=="Önce"){
			        $sorgu=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi<:btarihi and kayitAcan=:kayitAcan");
			        $sorgu->execute(array(
				        'btarihi'=>$tarih,
						'kayitAcan'=>$as
			        ));
		        }
		        else if($sorgu=="Sonra"){
			        $sorgu=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi>:btarihi and kayitAcan=:kayitAcan");
			        $sorgu->execute(array(
				        'btarihi'=>$tarih,
						'kayitAcan'=>$as
			        ));
		        }
		        else{
			        $sorgu=$db->prepare("SELECT * FROM $table WHERE bildirimTarihi=:btarihi and kayitAcan=:kayitAcan");
			        $sorgu->execute(array(
				        'btarihi'=>$tarih,
						'kayitAcan'=>$as
			        ));
		        }
            }
            else if($secili==2){
	            $sorgu=$db->prepare("SELECT * FROM $table WHERE durum=:drm and kayitAcan=:kayitAcan");
	            $sorgu->execute(array(
		            'drm'=>$durum,
					'kayitAcan'=>$as
	            ));
            }
			else if($secili==3){
	            $sorgu=$db->prepare("SELECT * FROM $table WHERE sorumlu=:sorumlu and kayitAcan=:kayitAcan");
	            $sorgu->execute(array(
		            'sorumlu'=>$sorumlu,
					'kayitAcan'=>$as
	            ));
            }
            else{
	            $sorgu=$db->prepare("SELECT * FROM $table WHERE kayitAcan=:kayitAcan");
				$sorgu->execute(array(
					'kayitAcan'=>$as
	            ));
            }
            $i=1;
            foreach($sorgu as $row) { ?>
	            <tr>
					<td> <?php echo $i ?> </td>
					<td style="text-align:center"><a href="altogeler.php?id=<?php echo $row['id']; ?>"><i class='fa fa-bars' style='font-size:24px'></i><a</td>
					<td> <?php echo $row['kayitNo']; ?></td>
		            <td> <?php echo $row['bildirimTarihi']; ?> </td>
		            <td> <?php echo $row['kayitAcan']; ?> </td>
		            <td> <?php echo $row['konu']; ?> </td>
		            <td> <?php echo $row['sorumlu']; ?> </td>
		            <td> <?php echo $row['planlananBitisTarihi']; ?> </td>
		            <td><?php echo $row['ttarihi']; ?></td>
		            <td><?php echo $row['durum']; ?></td>
		            <td><?php echo $row['notlar']; ?></td>
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
        var table=$('#table_id').DataTable({
			language: {
                info: " <?php echo $dil[info]; ?> ",
                infoEmpty:      "<?php echo $dil[infoEmpty]; ?>",
                loadingRecords: "<?php echo $dil[loadingRecords]; ?>",
                lengthMenu: "<?php echo $dil[lengthMenu]; ?>",
                zeroRecords: "<?php echo $dil[zeroRecords]; ?>",
                search: "<?php echo $dil[search]; ?>",
                infoFiltered:   "<?php echo $dil[infoFiltered]; ?>",									
                paginate: {
                    first: "<?php echo $dil[first]; ?>",
                    previous: "<?php echo $dil[previous]; ?>",
                    next: "<?php echo $dil[next]; ?>",
                    last: "<?php echo $dil[last]; ?>"
                }
            },
			dom: 'lfrtip',
        	buttons: [
				{
					extend:'copy',className: 'copyButton',text:'<i class="fa fa-clone" style="font-size:20px"></i> Copy'		
				},
				{
					extend:'excel', text:'<i class="fa fa-file-excel-o" style="font-size:20px"></i> Excel'		
				},
				{
					extend:'pdf' ,
					text:'<i class="fa fa-file-pdf-o" style="font-size:20px"></i> PDF',
					orientation: 'landscape',
                	pageSize: 'LEGAL',
					download:'open',
					exportOptions: {
                    	columns: [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                	}
				},
				{
					extend:'csv' ,text:'<i class="fa fa-file-excel-o" style="font-size:20px"></i> CSV' 		
				},
				{
					extend:'print' ,
					text:'<i class="fa fa-print" style="font-size:20px"></i> Print',
        		       		 customize: function ( win ) {
        		            		$(win.document.body)
        		                		.css( 'font-size', '10pt' )
        		                		.prepend(
        		                		    '<img src="https://logowik.com/content/uploads/images/ziraat-katilim-bankasi3774.jpg" style="position:absolute; top:35%; left:10%;" />'
        		               			 );
							$(win.document.body).find( 'table' )
        		                			.addClass( 'compact' )
        		                			.css( 'font-size', 'inherit' );
        		        	}
				},
				{
					extend:'colvis' ,text:'<i class="fa fa-wrench" style="font-size:20px; width:25px;"></i> ' 		
				},
        	]
		});
		table.buttons().container().appendTo($('#rapor'));
    });
	<?php if($_POST) {?>
	
    function tarih(){
	    val=document.getElementById("select").value;
                    
        if(val==1){
            document.getElementById("dt").style.display = "block";
            document.getElementById("dt1").style.display = "block";
            document.getElementById("select1").style.display = "none";
            document.getElementById("sorumlu").style.display = "none";
			document.getElementById("dt").style.top = "10%";
            document.getElementById("dt1").style.top = "10%";
        }
        else if(val==2){
            document.getElementById("select1").style.display = "block";
            document.getElementById("dt").style.display = "none";
            document.getElementById("dt1").style.display = "none";
			document.getElementById("sorumlu").style.display = "none";
            document.getElementById("select1").style.top = "1%";
        }
		else if(val==3){
    		document.getElementById("select1").style.display = "none";
    		document.getElementById("dt").style.display = "none";
    		document.getElementById("dt1").style.display = "none";
			document.getElementById("sorumlu").style.display = "block";
    		document.getElementById("select1").style.top = "1%";
		}
        else{
            document.getElementById("dt").style.display = "none";
            document.getElementById("dt1").style.display = "none";
            document.getElementById("select1").style.display = "none";
			document.getElementById("sorumlu").style.display = "none";
        }
	}
<?php }else{?>
	function tarih(){
	    val=document.getElementById("select").value;
                    
        if(val==1){
            document.getElementById("dt").style.display = "block";
            document.getElementById("dt1").style.display = "block";
            document.getElementById("select1").style.display = "none";
			document.getElementById("sorumlu").style.display = "none";
            document.getElementById("dt").style.top = "10%";
            document.getElementById("dt1").style.top = "10%";
        }
        else if(val==2){
            document.getElementById("select1").style.display = "block";
            document.getElementById("dt").style.display = "none";
            document.getElementById("dt1").style.display = "none";
			document.getElementById("sorumlu").style.display = "none";
            document.getElementById("select1").style.top = "1%";
        }
		else if(val==3){
    		document.getElementById("select1").style.display = "none";
    		document.getElementById("dt").style.display = "none";
    		document.getElementById("dt1").style.display = "none";
			document.getElementById("sorumlu").style.display = "block";
    		document.getElementById("select1").style.top = "1%";
		}
        else{
            document.getElementById("dt").style.display = "none";
            document.getElementById("dt1").style.display = "none";
            document.getElementById("select1").style.display = "none";
			document.getElementById("sorumlu").style.display = "none";
        }
	}
	<?php } ?>
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
	header("refresh:3;url=admin.php");
} ?>
