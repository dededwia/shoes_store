<html>
<head>
<meta name="viewport" content="width=device-width; initial-scale=0.38; maximum-scale=1.0;">
<link rel="stylesheet" type="text/css" href="theme.css">
</head>
<body>
<?php 
error_reporting(0);
include "../koneksi.php";
include "../function.php";
$id=$_GET['id'];
$id00=str_replace(" ", "+", "$id");
$de_id=decrypt($id00);
$cari=mysql_query("select* from tb_login where id='$de_id'");
$baris=mysql_fetch_array($cari);
$username=$baris['username'];
$kd_ongkir=$_GET['kd_ongkir'];
session_start();
if ($id!="")
{
	if (empty($_SESSION['id'])) 
	{
 		header("location:index.php?p=login"); 
	}
}
?>
<script>

function angka(event)

{
	
	var charcode=(event.which)?event.which:event.keycode
	
	if (charcode>31 && (charcode<48 || charcode>57))
	
	return false;
	return true;

}

</script>
<table border=0 align=center width=100% cellpadding=30>
<tr>
	<td>
	<table border=0 align=center width=100%>
	<tr>
		<td valign=top>
		<table bgcolor=white style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" height=100%>
		<tr>
			<td width=100% valign=top>
			<table width=100% cellpadding=10>
			<tr>
		
					<td align=center>
					<form enctype="multipart/form-data" method="post">
					<table border=1 id="highlight" style="border-collapse:collapse" align=center cellpadding=10>
					<tr>
						<th height=100 colspan=5 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">Edit ongkir</th>
					</tr>
					<tr>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Kode Kota</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:1000px">Nama kota</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Ongkir</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Kurir</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
					</tr>
					<?php 
					$tampil=mysql_query("select* from tb_ongkir where kd_ongkir='$kd_ongkir'");
					while ($baris=mysql_fetch_array($tampil))
					{
						$kd_kota0=$baris['kd_kota'];
						$nm_kota=$baris['nm_kota'];
						$ongkir0=$baris['ongkir'];
						$kd_kurir=$baris['kd_kurir'];
						$tampil0=mysql_query("select* from tb_kurir where kd_kurir='$kd_kurir'");
						$baris0=mysql_fetch_array($tampil0);
						$nm_kurir=$baris0['nm_kurir'];
						?>
						<tr>
							<input type="hidden" name="kd_ongkir0" value="<?php echo $kd_ongkir0;?>">
							<input type="hidden" name="ongkir0" value="<?php echo $ongkir0;?>">
							<td style="font-family:arial;font-size:14px"><?php echo $kd_kota;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_kota;?></td>
							<td style="font-family:arial;font-size:14px" align=right><input type="text" name="ongkir" onkeypress="return angka(event)" value="<?php echo $ongkir0;?>" autofocus></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_kurir;?></td>
							<td align=center><input type="submit" name="submit" style="cursor:pointer" value="Simpan"></td>
						</tr>
					<?php } ?>
					</table>
					</form>
					<?php
					$submit=$_POST['submit'];
					$ongkir0=$_POST['ongkir0'];
					$ongkir=$_POST['ongkir'];
					if ($_SERVER["REQUEST_METHOD"] == "POST") 
					{
  						if (empty($_POST["ongkir"])) 
						{
    							$name = test_input($_POST["ongkir"]);
						}
					}
					if ($submit)
					{
						
							if ($ongkir0=="$ongkir")
							{
								mysql_query("update tb_ongkir set ongkir='$ongkir0' where kd_ongkir='$kd_ongkir0'");
								?>
								<script>alert('Tidak ada perubahan data yang dilakukan')</script>
								<meta http-equiv="refresh" content="0;url='index.php?p=ongkir&id=<?php echo $id;?>'">
							<?php }	
							else
							{
								mysql_query("update tb_ongkir set ongkir='$ongkir' where kd_ongkir='$kd_ongkir0'");
								?>
								<script>alert('Perubahan data berhasil')</script>
								<meta http-equiv="refresh" content="0;url='index.php?p=ongkir&id=<?php echo $id;?>'">
							<?php }	
						
					} ?>
					
					
		
			</td>
			</tr>
			<tr>
				<td><input type="button" onclick="window.location.href='index.php?p=ongkir&id=<?php echo $id;?>'" style="cursor:pointer" value="Kembali"></td>
			</tr>
			</table>
			</td>
		</tr>
		</table>
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>

</body>