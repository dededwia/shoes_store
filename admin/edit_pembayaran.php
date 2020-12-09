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
$no_transaksi=$_GET['no_transaksi'];
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
						<th height=100 colspan=6 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">Edit pembayaran</th>
					</tr>
					<tr>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">No. Transaksi</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:500px">Jenis Pembayaran</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:500px">Bukti Pembayaran</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Tanggal Pembayaran</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Keterangan</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
					</tr>
					<?php 
					$tampil=mysql_query("select* from tb_pembayaran where no_transaksi='$no_transaksi'");
					while ($baris=mysql_fetch_array($tampil))
					{
						$no_transaksi=$baris['no_transaksi'];
						$kd_jns_pembayaran=$baris['kd_jns_pembayaran'];
						$bukti_pembayaran=$baris['bukti_pembayaran'];
						$tampil0=mysql_query("select* from tb_jns_pembayaran where kd_jns_pembayaran='$kd_jns_pembayaran'");
						$baris0=mysql_fetch_array($tampil0);
						$nm_jns_pembayaran=$baris0['nm_jns_pembayaran'];
						$tgl_upload=$baris['tgl_upload'];
						$keterangan=$baris['keterangan'];
						?>
						<tr>
							<input type="hidden" name="keterangan" value="<?php echo $keterangan;?>">
							<td style="font-family:arial;font-size:14px"><?php echo $no_transaksi;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_jns_pembayaran;?></td>
							<td style="font-family:arial;font-size:14px"><img src="../upload/<?php echo $bukti_pembayaran;?>" width=80 height=80></td>
							<td style="font-family:arial;font-size:14px"><?php echo $tgl_upload;?></td>
							<td style="font-family:arial;font-size:14px">
							<select name="keterangan" autofocus>
							<option value="<?php echo $keterangan;?>"><?php echo $keterangan;?></option>
							<optgroup label="________________">
							<option value="Menunggu Pembayaran">Menunggu Pembayaran</option>
							<?php 
							if ($kd_jns_pembayaran=="BT")
							{ ?>
								<option value="Verifikasi">Verifikasi</option>
							<?php }
							else
							{} ?>
							<option value="Selesai">Selesai</option>
							</optgroup>							
							</select>
							</td>
							<td align=center><input type="submit" name="submit" style="cursor:pointer" value="Simpan"></td>
						</tr>
					<?php } ?>
					</table>
					</form>
					<?php
					$submit=$_POST['submit'];
					$keterangan0=$_POST['keterangan'];
					if ($_SERVER["REQUEST_METHOD"] == "POST") 
					{
  						if (empty($_POST["keterangan"])) 
						{
    							$name = test_input($_POST["keterangan"]);
						}
					}
					if ($submit)
					{
					
							if ($keterangan0=="$keterangan")
							{
								mysql_query("update tb_pembayaran set keterangan='$keterangan' where no_transaksi='$no_transaksi'");
								?>
								<script>alert('Tidak ada perubahan data yang dilakukan')</script>
								<meta http-equiv="refresh" content="0;url='index.php?p=pembayaran&id=<?php echo $id;?>'">
							<?php }	
							else
							{
								mysql_query("update tb_pembayaran set keterangan='$keterangan0' where no_transaksi='$no_transaksi'");
								?>
								<script>alert('Perubahan data berhasil')</script>
								<meta http-equiv="refresh" content="0;url='index.php?p=pembayaran&id=<?php echo $id;?>'">
							<?php }	
						
					} ?>
					
					
		
			</td>
			</tr>
			<tr>
				<td><input type="button" onclick="window.location.href='index.php?p=pembayaran&id=<?php echo $id;?>'" style="cursor:pointer" value="Kembali"></td>
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