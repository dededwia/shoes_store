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
						<th height=100 colspan=12 style="background:black;color:white;font-family:arial;font-size:24px;width:100%">Produk</th>
					</tr>
					<tr>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Kd. Produk</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:300px">Kategori</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:300px">Nama Produk</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:300px">Spesifikasi</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Berat</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Satuan</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Harga</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Stok</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Rak</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Diskon</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Gambar</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
					</tr>
					<tr>
						<td colspan=12 align=right><input type="button" onclick="window.location.href='index.php?p=tambah_produk&id=<?php echo $id;?>'" style="cursor:pointer" value="+"></td>
					</tr>
					<?php 
					$tampil=mysql_query("select* from tb_produk");
					while ($baris=mysql_fetch_array($tampil))
					{
						$kd_produk=$baris['kd_produk'];
						$kd_kategori=$baris['kd_kategori'];
						$tampil1=mysql_query("select* from tb_kategori where kd_kategori='$kd_kategori'");
						$baris0=mysql_fetch_array($tampil1);
						$nm_kategori=$baris0['nm_kategori'];
						$nm_produk=$baris['nm_produk'];
						$spesifikasi=$baris['spesifikasi'];
						$berat=$baris['berat'];
						$satuan=$baris['satuan'];
						$harga=$baris['harga'];
						$stok=$baris['stok'];
						$rak=$baris['rak'];
						$diskon=$baris['diskon'];
						$diskon0=$diskon*100;
						$gambar=$baris['gambar'];
						?>
						<tr>
							<td valign=top style="font-family:arial;font-size:14px"><?php echo $kd_produk;?></td>
							<td valign=top style="font-family:arial;font-size:14px"><?php echo $nm_kategori;?></td>
							<td valign=top style="font-family:arial;font-size:14px"><?php echo $nm_produk;?></td>
							<td valign=top style="font-family:arial;font-size:14px"><?php echo $spesifikasi;?></td>
							<td valign=top style="font-family:arial;font-size:14px" align=right><?php echo $berat;?></td>
							<td valign=top style="font-family:arial;font-size:14px"><?php echo $satuan;?></td>
							<td valign=top style="font-family:arial;font-size:14px" align=right><?php echo $harga;?></td>
							<td valign=top style="font-family:arial;font-size:14px" align=right><?php echo $stok;?></td>
							<td valign=top style="font-family:arial;font-size:14px"><?php echo $rak;?></td>
							<td valign=top style="font-family:arial;font-size:14px" align=right><?php echo $diskon0."%";?></td>
							<td valign=top align=center style="font-family:arial;font-size:14px"><img src="../images/<?php echo $gambar;?>" width=70 height=70></td>
							<td align=center><button style="cursor:pointer"><a style="text-decoration:none;color:black" onclick="return confirm('Apakah anda ingin mengedit data <?php echo $kd_produk;?>?')" href="index.php?p=edit_produk&id=<?php echo $id;?>&kd_produk=<?php echo $kd_produk;?>">Edit</a></button> <button style="cursor:pointer"><a style="text-decoration:none;color:black" onclick="return confirm('Apakah anda ingin menghapus data <?php echo $kd_produk;?>?')" href="hapus_produk.php?id=<?php echo $id;?>&kd_produk=<?php echo $kd_produk;?>">Hapus</a></button></td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan=11 bgcolor=white></td><td bgcolor=white align=center><button style="cursor:pointer"><a style="text-decoration:none;color:black" onclick="return confirm('Apakah anda ingin menghapus semua data produk?')" href="hapus_semua_produk.php?id=<?php echo $id;?>">Hapus Semua</a></button></td>
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