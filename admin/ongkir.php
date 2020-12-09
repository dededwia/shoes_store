<html>
<head>
<meta name="viewport" content="width=device-width; initial-scale=0.38; maximum-scale=1.0;">
<link rel="stylesheet" type="text/css" href="theme.css">
<style>
#highlight tbody tr:nth-of-type(even)
{
	
	background:#EDECE4;

}
</style>
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
					<table border=1 id="highlight" style="border-collapse:collapse" align=center cellpadding=10>
					<tr>
						<th height=100 colspan=5 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">Ongkir</th>
					</tr>
					<tr>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Kode Ongkir</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:1000px">Nama kota</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Ongkir</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Kurir</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
					</tr>
					<tr>
						<td colspan=5 align=right><input type="button" onclick="window.location.href='index.php?p=tambah_ongkir&id=<?php echo $id;?>'" style="cursor:pointer" value="+"></td>
					</tr>
					<?php 
					$tampil=mysql_query("select* from tb_ongkir");
					while ($baris=mysql_fetch_array($tampil))
					{
						$kd_ongkir=$baris['kd_ongkir'];
						$nm_kota=$baris['nm_kota'];
						$ongkir=$baris['ongkir'];
						$kd_kurir=$baris['kd_kurir'];
						$tampil0=mysql_query("select* from tb_kurir where kd_kurir='$kd_kurir'");
						$baris0=mysql_fetch_array($tampil0);
						$nm_kurir=$baris0['nm_kurir'];
						?>
						<tr>
							<td style="font-family:arial;font-size:14px"><?php echo $kd_ongkir;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_kota;?></td>
							<td style="font-family:arial;font-size:14px" align=right><?php echo $ongkir;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_kurir;?></td>
							<td align=center><button style="cursor:pointer"><a style="text-decoration:none;color:black" onclick="return confirm('Apakah anda ingin mengedit data <?php echo $kd_ongkir;?>?')" href="index.php?p=edit_ongkir&id=<?php echo $id;?>&kd_ongkir=<?php echo $kd_ongkir;?>">Edit</a></button> <button style="cursor:pointer"><a style="text-decoration:none;color:black" onclick="return confirm('Apakah anda ingin menghapus data <?php echo $kd_ongkir;?>?')" href="hapus_ongkir.php?id=<?php echo $id;?>&kd_ongkir=<?php echo $kd_ongkir;?>">Hapus</a></button></td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan=4 bgcolor=white></td><td bgcolor=white align=center><button style="cursor:pointer"><a style="text-decoration:none;color:black" onclick="return confirm('Apakah anda ingin menghapus semua data ongkir?')" href="hapus_semua_ongkir.php?id=<?php echo $id;?>">Hapus Semua</a></button></td>
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
	</td>
</tr>
</table>

</body>