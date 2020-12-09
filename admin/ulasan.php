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
						<th height=100 colspan=6 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">ulasan</th>
					</tr>
					<tr>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Nama Pelanggan</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:1000px">Nama Produk</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:1000px">Tanggal</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:1000px">Ulasan</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:1000px">Nilai</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
					</tr>
					<?php 
					$tampil=mysql_query("select* from tb_ulasan");
					while ($baris=mysql_fetch_array($tampil))
					{
						$id0=$baris['id'];
						$kd_plgn=$baris['kd_plgn'];
						$cari=mysql_query("select* from tb_pelanggan where kd_plgn='$kd_plgn'");
						$baris0=mysql_fetch_array($cari);
						$nm_plgn=$baris0['nm_plgn'];

						$kd_produk=$baris['kd_produk'];
						$cari0=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
						$baris1=mysql_fetch_array($cari0);
						$nm_produk=$baris0['nm_produk'];
						$tgl_ulasan=$baris['tgl_ulasan'];
						$ulasan=$baris['ulasan'];
						$nilai=$baris['nilai'];
						?>
						<tr>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_plgn;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_produk;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $tgl_ulasan;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $ulasan;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nilai;?></td>
							<td align=center><button style="cursor:pointer"><a style="text-decoration:none;color:black" onclick="return confirm('Apakah anda ingin menghapus data <?php echo $id0;?>?')" href="hapus_ulasan.php?id=<?php echo $id;?>&id0=<?php echo $id0;?>">Hapus</a></button></td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan=5 bgcolor=white></td><td bgcolor=white align=center><button style="cursor:pointer"><a style="text-decoration:none;color:black" onclick="return confirm('Apakah anda ingin menghapus semua data ulasan?')" href="hapus_semua_ulasan.php?id=<?php echo $id;?>">Hapus Semua</a></button></td>
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