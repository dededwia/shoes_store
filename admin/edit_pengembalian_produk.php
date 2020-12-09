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
						<th height=100 colspan=9 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">Edit pengembalian produk</th>
					</tr>
					<tr>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">No. Retur</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Tanggal Pengajuan Retur</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">No. Transaksi</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:400px">Produk</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Jumlah</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Jenis Retur</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Alasan</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Keterangan</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
					</tr>
					<?php
					$tampil=mysql_query("select* from tb_pengembalian_produk where no_transaksi='$no_transaksi'");
					while ($baris=mysql_fetch_array($tampil))
					{
						$id0=$baris['id'];
						$no_retur=$baris['no_retur'];
						$tgl_pengajuan_retur=$baris['tgl_pengajuan_retur'];
						$no_transaksi=$baris['no_transaksi'];
						$kd_produk=$baris['kd_produk'];
						$tampil0=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
						$baris0=mysql_fetch_array($tampil0);
						$nm_produk=$baris0['nm_produk'];


						$jumlah=$baris['jumlah'];
						$kd_jns_pengembalian=$baris['kd_jns_pengembalian'];

						$tampil1=mysql_query("select* from tb_jns_pengembalian where kd_jns_pengembalian='$kd_jns_pengembalian'");
						$baris1=mysql_fetch_array($tampil1);
						$nm_jns_pengembalian=$baris1['nm_jns_pengembalian'];

						$alasan=$baris['alasan'];
						$keterangan0=$baris['keterangan'];
						?>
						<tr>
							<input type="hidden" name="keterangan0" value="<?php echo $keterangan0;?>">
							<td style="font-family:arial;font-size:14px"><?php echo $no_retur;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $tgl_pengajuan_retur;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $no_transaksi;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_produk;?></td>
							<td style="font-family:arial;font-size:14px" align=right><?php echo $jumlah;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_jns_pengembalian;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $alasan;?></td>
							<td style="font-family:arial;font-size:14px">
							<select name="keterangan" autofocus>
							<option value="<?php echo $keterangan0;?>"><?php echo $keterangan0;?></option>
							<optgroup label="________________">
							<option value="Proses Retur">Proses Retur</option>
							<?php 
							if ($kd_jns_pengembalian=="RET001")
							{ ?>
								<option value="Proses Refund">Proses Refund</option>
							<?php }
							else
							{ ?>
								<option value="Proses Tukar Barang">Proses Tukar Barang</option>
							<?php } ?>					
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
					$keterangan=$_POST['keterangan'];
					$keterangan0=$_POST['keterangan0'];
					if ($submit)
					{
					
							if ($keterangan0==$keterangan)
							{
								mysql_query("update tb_pengembalian_produk set keterangan='$keterangan' where no_transaksi='$no_transaksi'");
								?>
								<script>alert('Tidak ada perubahan data yang dilakukan')</script>
								<meta http-equiv="refresh" content="0;url='index.php?p=pengembalian_produk&id=<?php echo $id;?>'">
							<?php }	
							else
							{
								mysql_query("update tb_pengembalian_produk set keterangan='$keterangan' where no_transaksi='$no_transaksi'");
								?>
								<script>alert('Perubahan data berhasil')</script>
								<meta http-equiv="refresh" content="0;url='index.php?p=pengembalian_produk&id=<?php echo $id;?>'">
							<?php }	
						
					} ?>
					
					
		
			</td>
			</tr>
			<tr>
				<td><input type="button" onclick="window.location.href='index.php?p=pengembalian_produk&id=<?php echo $id;?>'" style="cursor:pointer" value="Kembali"></td>
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