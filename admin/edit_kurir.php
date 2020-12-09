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
$kd_kurir=$_GET['kd_kurir'];
session_start();
if ($id!="")
{
	if (empty($_SESSION['id'])) 
	{
 		header("location:index.php?p=login"); 
	}
}
?>
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
						<th height=100 colspan=3 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">Edit kurir</th>
					</tr>
					<tr>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Kode</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:1000px">Kurir</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
					</tr>
					<?php 
					$tampil=mysql_query("select* from tb_kurir where kd_kurir='$kd_kurir'");
					while ($baris=mysql_fetch_array($tampil))
					{
						$kd_kurir0=$baris['kd_kurir'];
						$nm_kurir0=$baris['nm_kurir'];
						?>
						<tr>
							<input type="hidden" name="id0" value="<?php echo $id;?>">
							<input type="hidden" name="kd_kurir0" value="<?php echo $kd_kurir0;?>">
							<input type="hidden" name="nm_kurir0" value="<?php echo $nm_kurir0;?>">
							<input type="hidden" name="gambar0" value="<?php echo $gambar0;?>">
							<td style="font-family:arial;font-size:14px"><?php echo $kd_kurir;?></td>
							<td style="font-family:arial;font-size:14px"><input type="text" name="nm_kurir" style="width:100%" value="<?php echo $nm_kurir0;?>" required autofocus></td>
							<td align=center><input type="submit" name="submit" style="cursor:pointer" value="Simpan"></td>
						</tr>
					<?php } ?>
					</table>
					</form>
					<?php
					$submit=$_POST['submit'];
					$kd_kurir0=$_POST['kd_kurir0'];
					$nm_kurir0=$_POST['nm_kurir0'];
					$nm_kurir=$_POST['nm_kurir'];
					if ($_SERVER["REQUEST_METHOD"] == "POST") 
					{
  						if (empty($_POST["nm_kurir"])) 
						{
    							$name = test_input($_POST["nm_kurir"]);
						}
					}
					if ($submit)
					{
						
							if ($nm_kurir0=="$nm_kurir" and $gambar0=="$gambar")
							{
								mysql_query("update tb_kurir set nm_kurir='$nm_kurir0',gambar='$gambar' where kd_kurir='$kd_kurir0'");
								?>
								<script>alert('Tidak ada perubahan data yang dilakukan')</script>
								<meta http-equiv="refresh" content="0;url='index.php?p=kurir&id=<?php echo $id;?>'">
							<?php }	
							else
							{
								mysql_query("update tb_kurir set nm_kurir='$nm_kurir' where kd_kurir='$kd_kurir0'");
								?>
								<script>alert('Perubahan data berhasil')</script>
								<meta http-equiv="refresh" content="0;url='index.php?p=kurir&id=<?php echo $id;?>'">
							<?php }	
						
					} ?>
					
					
		
			</td>
			</tr>
			<tr>
				<td><input type="button" onclick="window.location.href='index.php?p=kurir&id=<?php echo $id;?>'" style="cursor:pointer" value="Kembali"></td>
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