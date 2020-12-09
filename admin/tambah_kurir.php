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
				<form method="post">
				<?php
				$tampil=mysql_query("select* from tb_kurir");
				while ($baris=mysql_fetch_array($tampil))
				{
					$nm_kurir0=$baris['nm_kurir'];
				}
				$tampil0=mysql_query("select max(kd_kurir) from tb_kurir");
				while ($baris=mysql_fetch_array($tampil0))
				{
					$kd_kurir=$baris['kd_kurir'];
					$x=$baris['max(kd_kurir)'];
				}
				if ($x=="")
				{
					$y="KUR01";
				}
				else
				{
					$s=(int) substr($x,3,2);
					
$s++;

					$y = "KUR".sprintf("%02s",$s);
				}
				?>
				<table border=1 id="highlight" style="border-collapse:collapse" align=center cellpadding=10>
				<tr>
					<th height=100 colspan=4 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">Tambah kurir</th>
				</tr>
				<tr>
					<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Kode</th>
					<th style="background:black;color:white;font-family:arial;font-size:14px;width:1000px">Kurir</th>
					<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
				</tr>
				<tr>

					<td style="font-family:arial;font-size:14px"><input type="text" name="kd_kurir" value="<?php echo $y;?>" style="width:100%" readonly></td>
					<td style="font-family:arial;font-size:14px"><input type="text" name="nm_kurir" style="width:100%" required autofocus></td>
					<td align=center><input type="submit" onclick="return confirm('Apakah anda ingin menyimpan data ini?')" name="submit" style="cursor:pointer" value="Simpan"></td>
				</tr>
				</table>
				</form>
				<?php
				$submit=$_POST['submit'];
				$kd_kurir=$_POST['kd_kurir'];
				$nm_kurir=$_POST['nm_kurir'];
				if ($_SERVER["REQUEST_METHOD"] == "POST") 
				{
  					if (empty($_POST['nm_kurir'])) 
					{
    						$name = test_input($_POST['nm_kurir']);
					}
				}
				if ($submit)
				{
					mysql_query("insert into tb_kurir values('$kd_kurir','$nm_kurir')");
					?>
					<script>alert('Data berhasil disimpan')</script>
					<meta http-equiv="refresh" content="0;url='index.php?p=kurir&id=<?php echo $id;?>'">	
				<?php } ?>
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