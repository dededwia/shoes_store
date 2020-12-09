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
$kd_produk=$_GET['kd_produk'];
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
					<?php
					$tampil0=mysql_query("select max(kd_produk) from tb_produk");
					while ($baris=mysql_fetch_array($tampil0))
					{
						$kd_produk=$baris['kd_produk'];
						$x=$baris['max(kd_produk)'];
					}
					if ($x=="")
					{
						$y="P00001";
					}
					else
					{
						$s=(int) substr($x,1,5);
						
$s++;

						$y = "P".sprintf("%05s",$s);
					}
					?>
					<table border=1 id="highlight" style="border-collapse:collapse" align=center cellpadding=10 width=100%>
					<tr>
						<th height=100 colspan=12 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">Tambah produk</th>
					</tr>
					<tr>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:50px">Kd. Produk</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px">Kategori</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px">Nama Produk</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px">Spesifikasi</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px">Berat</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px">Satuan</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px">Harga</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px">Stok</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px">Rak</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px">Diskon</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px">Gambar</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px">Action</th>
					</tr>
						<tr>
							<input type="hidden" name="id0" value="<?php echo $id;?>">
							<td valign=top style="font-family:arial;font-size:14px"><input type="text" name="kd_produk" style="width:100px" value="<?php echo $y;?>" readonly></td>
							<td valign=top style="font-family:arial;font-size:14px">
							<select name="kategori">
							<?php
							$tampil2=mysql_query("select* from tb_kategori");
							while ($baris1=mysql_fetch_array($tampil2))
							{ 
								$kd_kategori1=$baris1['kd_kategori'];
								$nm_kategori1=$baris1['nm_kategori'];?>
								<option value="<?php echo $kd_kategori1;?>"><?php echo $nm_kategori1;?></option>
							<?php } ?>
							</select>
							</td>
							<td valign=top style="font-family:arial;font-size:14px"><input type="text" name="nm_produk" style="width:100px" required></td>
							<td valign=top><textarea rows=5 style="font-family:arial;font-size:14px;resize:none" name="spesifikasi" required></textarea></td>
							<td valign=top style="font-family:arial;font-size:14px"><input type="text" name="berat" style="width:50px" required></td>
							<td valign=top style="font-family:arial;font-size:14px"><input type="text" name="satuan" style="width:50px" required></td>
							<td valign=top style="font-family:arial;font-size:14px"><input type="text" name="harga" style="width:80px" onkeypress="return angka(event)" required></td>
							<td valign=top style="font-family:arial;font-size:14px"><input type="text" name="stok" style="width:50px" onkeypress="return angka(event)" required></td>
							<td valign=top style="font-family:arial;font-size:14px"><input type="text" name="rak" style="width:80px"></td>
							<td valign=top style="font-family:arial;font-size:14px"><input type="text" name="diskon" style="width:50px"></td>
							<td valign=top align=center style="font-family:arial;font-size:14px"><img src="../images/<?php echo $gambar0;?>" width=70 height=70><br><input type="file" name="gambar" accept="image/*"></td>
							<td align=center><input type="submit" name="submit" style="cursor:pointer" value="Simpan"></td>
						</tr>
					
					</table>
					</form>
					<?php
					if ($_SERVER['REQUEST_METHOD']=="POST") 
					{
  						if (empty($_POST['nm_produk'])) 
						{
    							test_input($_POST['nm_produk']);
						}
						elseif (empty($_POST['spesifikasi'])) 
						{
    							test_input($_POST['spesifikasi']);
						}
						elseif (empty($_POST['berat'])) 
						{
    							test_input($_POST['berat']);
						}
						elseif (empty($_POST['satuan'])) 
						{
    							test_input($_POST['satuan']);
						}
						elseif (empty($_POST['harga'])) 
						{
    							test_input($_POST['harga']);
						}
						elseif (empty($_POST['stok'])) 
						{
    							test_input($_POST['stok']);
						}					
					}
					$submit=$_POST['submit'];
					$kd_produk=$_POST['kd_produk'];
					$nm_produk=$_POST['nm_produk'];
					$kd_kategori2=$_POST['kategori'];
					$spesifikasi=$_POST['spesifikasi'];
					$berat=$_POST['berat'];
					$satuan=$_POST['satuan'];
					$harga=$_POST['harga'];
					$stok=$_POST['stok'];
					$rak=$_POST['rak'];
					$diskon=$_POST['diskon'];
					$gambar=$_FILES['gambar']['name'];

					if ($submit)
					{
						mysql_query("insert into tb_produk values('$kd_produk','$kd_kategori2','$nm_produk','$spesifikasi','$berat','$satuan','$harga','$stok','$rak','$diskon','$gambar','')");
						move_uploaded_file($_FILES['gambar']['tmp_name'], "../images/{$_FILES['gambar']['name']}"); ?>
						<script>alert('Data berhasil disimpan')</script>
						<meta http-equiv="refresh" content="0;url='index.php?p=produk&id=<?php echo $id;?>'">
					<?php } ?>	
			</td>
			</tr>
			<tr>
				<td><input type="button" onclick="window.location.href='index.php?p=produk&id=<?php echo $id;?>'" style="cursor:pointer" value="Kembali"></td>
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