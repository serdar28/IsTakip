
<?php
include_once 'connection_settings.php';
$table = "isler";
$id=$_GET["id"];
	$sorgu=$db->prepare("SELECT * FROM $table WHERE id=:id");
	$sorgu->execute(array(
		'id'=>$id
	));
	$row=$sorgu->fetch(PDO::FETCH_ASSOC);
	$sorgu1=$db->prepare("SELECT * FROM altoge WHERE parentId=:parentId");
	$sorgu1->execute(array(
		'parentId'=>$row["id"]
	))
?>

<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"> <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>
@import url("http://bootswatch.com/simplex/bootstrap.min.css");
table .collapse.in {
	display:table-row;
}
.div1{
	width:80%;
	margin:auto;
}
.div2{
	text-align:center;
	margin-top:2%;
}
h2{
	margin-top:2%;
}
table{
	margin-top:3%;
}
</style>

<body>
<center><h2><?php echo $row["kayitNo"] ?> Nolu İş Takibinin Alt Öğeleri</h2></center>

<div class="div1">
<i class="fa fa-arrow-circle-left" style='font-size:36px' onClick="geri()"></i>
<table class="table table-responsive table-hover"  style="width:800%">
  <thead>
        <tr style="text-align:center">
        	<th>KAYIT NO</th>
			<th></th>
			<th>BİLDİRİM TARİHİ</th>
			<th>KAYDI AÇAN</th>
			<th>KONU</th>
			<th>SORUMLU</th>
			<th>PLANLANAN BİTİŞ TARİHİ</th>
			<th>TAMAMLANMA TARİHİ</th>
			<th>DURUM</th>
			<th>NOT</th>
        	<th style="text-align:center">ÖĞE EKLE</th>
		</tr>
    </thead>
    <tbody>
        <tr class="clickable" data-toggle="collapse" id="row1" data-target=".row1">
					<td colspan="2"> <?php echo $row['kayitNo']; ?></td>
		            <td> <?php echo $row['bildirimTarihi']; ?> </td>
		            <td> <?php echo $row['kayitAcan']; ?> </td>
		            <td> <?php echo $row['konu']; ?> </td>
		            <td> <?php echo $row['sorumlu']; ?> </td>
		            <td> <?php echo $row['planlananBitisTarihi']; ?> </td>
		            <td><?php echo $row['ttarihi']; ?></td>
		            <td><?php echo $row['durum']; ?></td>
		            <td><?php echo $row['notlar']; ?></td>
                    <td style="text-align:center"> <a href="altogeedit.php?id=<?php echo $id; ?>"><i class='fa fa-plus' style='font-size:36px'></i><a></td>
        </tr>
		<?php $i=1;
            foreach($sorgu1 as $row1) { ?>
				<tr class="collapse row1">
					<td style="text-align:center"><i class="fa fa-long-arrow-right" style='font-size:24px'></i></td>
					<td> <?php echo $i ?></td>
		            <td> <?php echo $row1['bildirimt']; ?> </td>
		            <td> <?php echo $row1['kayitAcanP']; ?> </td>
		            <td> <?php echo $row1['konu']; ?> </td>
		            <td> <?php echo $row1['sorumluP']; ?> </td>
		            <td> <?php echo $row1['pbtarihi']; ?> </td>
		            <td> <?php echo $row1['ttarihi']; ?></td>
		            <td> <?php echo $row1['durum']; ?></td>
		            <td> <?php echo $row1['note']; ?></td>
                    <td style="text-align:center"> <a href="updateoge.php?id=<?php echo $row1['id']; ?>"><i class='fa fa-edit' style='font-size:36px'></i><a></td>
				</tr>
            <?php $i++;} ?>
    </tbody>
</table>
</div>
<div class="div2">	
 	<i><p id="id1">Alt Ögeleri Görmek İçin Ana Kaydın Üstüne TIklayınız</p></i>
</div>
</body>
</html>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
<script type="text/javascript">

		function geri(){

			window.location.assign("admin.php")

		}
		$("#row1").click(function(){
			$("#id1").toggle(1000);
		});

	</script>

