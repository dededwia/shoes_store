<html>
<head>
<meta name="viewport" content="width=device-width; initial-scale=0.38; maximum-scale=1.0;">
<link rel="stylesheet" type="text/css" href="theme.css">
</head>
<body>
<?php 
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
include "../koneksi.php";
include "../function.php";
$id=$_GET['id'];
$id00=str_replace(" ", "+", "$id");
$de_id=decrypt($id00);
$cari=mysql_query("select* from tb_login where id='$de_id'");
$baris=mysql_fetch_array($cari);
$username=$baris['username'];
$no_transaksi=$_GET['no_transaksi'];
$d=date(d)."-".date(m)."-".date(Y);
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
						<th height=100 colspan=6 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">Edit pengiriman produk</th>
					</tr>
					<tr>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">No. Transaksi</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:500px">Tanggal Pengiriman</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:500px">Kurir</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">No. Resi</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Keterangan</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
					</tr>
					<?php 
					$tampil=mysql_query("select* from tb_pengiriman where no_transaksi='$no_transaksi'");
					while ($baris=mysql_fetch_array($tampil))
					{
						$no_transaksi=$baris['no_transaksi'];
						$tgl_pengiriman0=$baris['tgl_pengiriman'];
						$kd_kurir=$baris['kd_kurir'];
						$tampil0=mysql_query("select* from tb_kurir where kd_kurir='$kd_kurir'");
						$baris0=mysql_fetch_array($tampil0);
						$nm_kurir=$baris0['nm_kurir'];
						$no_resi0=$baris['no_resi'];
						$keterangan0=$baris['keterangan'];
						?>
						<tr>
							<input type="hidden" name="no_transaksi0" value="<?php echo $no_transaksi;?>">
							<input type="hidden" name="keterangan0" value="<?php echo $keterangan0;?>">
							<input type="hidden" name="no_resi0" value="<?php echo $no_resi0;?>">
							<input type="hidden" name="tgl_pengiriman1" value="<?php echo $tgl_pengiriman0;?>">
							<td style="font-family:arial;font-size:14px"><?php echo $no_transaksi;?></td>
							<td style="font-family:arial;font-size:14px"><input type="date" name="tgl_pengiriman2" value="<?php echo $tgl_pengiriman0;?>"></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_kurir;?></td>
							<td style="font-family:arial;font-size:14px"><input type="text" name="no_resi" value="<?php echo $no_resi0;?>" autofocus required></td>
							<td style="font-family:arial;font-size:14px">
							<select name="keterangan">
							<option value="<?php echo $keterangan0;?>"><?php echo $keterangan0;?></option>
							<optgroup label="________________">
							<option value="Pengiriman">Pengiriman</option>
							<option value="ulasan">ulasan</option>
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
					$no_transaksi0=$_POST['no_transaksi0'];
					$keterangan=$_POST['keterangan'];
					$keterangan0=$_POST['keterangan0'];
					$tgl_pengiriman1=$_POST['tgl_pengiriman0'];
					$tgl_pengiriman2=$_POST['tgl_pengiriman2'];
					$tgl_pengiriman3=ubahtgl($_POST['tgl_pengiriman2']);
					$no_resi0=$_POST['no_resi0'];
					$no_resi=$_POST['no_resi'];
					if ($_SERVER["REQUEST_METHOD"] == "POST") 
					{
  						if (empty($_POST["no_resi"])) 
						{
    							$name = test_input($_POST["no_resi"]);
						}

					}
					if ($submit)
					{
						if (!empty($no_resi))
						{
							if ($no_resi0=="$no_resi" and $tgl_pengiriman2=="$tgl_pengiriman1" and $keterangan0=="$keterangan")
							{
								mysql_query("update tb_pengiriman set tgl_pengiriman='$tgl_pengiriman0',no_resi='$no_resi0',keterangan='$keterangan0' where no_transaksi='$no_transaksi0'");
								?>
								<script>alert('Tidak ada perubahan data yang dilakukan')</script>
								<meta http-equiv="refresh" content="0;url='index.php?p=pengiriman&id=<?php echo $id;?>'">
							<?php }	
							else
							{
								mysql_query("update tb_pengiriman set tgl_pengiriman='$tgl_pengiriman3',no_resi='$no_resi',keterangan='$keterangan' where no_transaksi='$no_transaksi0'");
								?>
								<script>alert('Perubahan data berhasil')</script>
								<meta http-equiv="refresh" content="0;url='index.php?p=pengiriman&id=<?php echo $id;?>'">
							<?php }	
						}
						
					} ?>
					
					
		
			</td>
			</tr>
			<tr>
				<td><input type="button" onclick="window.location.href='index.php?p=pengiriman&id=<?php echo $id;?>'" style="cursor:pointer" value="Kembali"></td>
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