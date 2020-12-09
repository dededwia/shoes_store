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
$kd_bank=$_GET['kd_bank'];
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
						<th height=100 colspan=3 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">Edit bank</th>
					</tr>
					<tr>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Kode</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:1000px">Bank</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
					</tr>
					<?php 
					$tampil=mysql_query("select* from tb_bank where kd_bank='$kd_bank'");
					while ($baris=mysql_fetch_array($tampil))
					{
						$kd_bank0=$baris['kd_bank'];
						$nm_bank0=$baris['nm_bank'];
						?>
						<tr>
							<input type="hidden" name="id0" value="<?php echo $id;?>">
							<input type="hidden" name="kd_bank0" value="<?php echo $kd_bank0;?>">
							<input type="hidden" name="nm_bank0" value="<?php echo $nm_bank0;?>">
							<td style="font-family:arial;font-size:14px"><?php echo $kd_bank;?></td>
							<td style="font-family:arial;font-size:14px"><input type="text" name="nm_bank" style="width:100%" value="<?php echo $nm_bank0;?>" required autofocus></td>
							<td align=center><input type="submit" name="submit" style="cursor:pointer" value="Simpan"></td>
						</tr>
					<?php } ?>
					</table>
					</form>
					<?php
					$submit=$_POST['submit'];
					$kd_bank0=$_POST['kd_bank0'];
					$nm_bank0=$_POST['nm_bank0'];
					$nm_bank=$_POST['nm_bank'];
					if ($_SERVER["REQUEST_METHOD"] == "POST") 
					{
  						if (empty($_POST["nm_bank"])) 
						{
    							$name = test_input($_POST["nm_bank"]);
						}
					}
					if ($submit)
					{
						
							if ($nm_bank0=="$nm_bank")
							{
								mysql_query("update tb_bank set nm_bank='$nm_bank0' where kd_bank='$kd_bank0'");
								?>
								<script>alert('Tidak ada perubahan data yang dilakukan')</script>
								<meta http-equiv="refresh" content="0;url='index.php?p=bank&id=<?php echo $id;?>'">
							<?php }	
							else
							{
								mysql_query("update tb_bank set nm_bank='$nm_bank' where kd_bank='$kd_bank0'");
								?>
								<script>alert('Perubahan data berhasil')</script>
								<meta http-equiv="refresh" content="0;url='index.php?p=bank&id=<?php echo $id;?>'">
							<?php }	
						
					} ?>
					
					
		
			</td>
			</tr>
			<tr>
				<td><input type="button" onclick="window.location.href='index.php?p=bank&id=<?php echo $id;?>'" style="cursor:pointer" value="Kembali"></td>
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