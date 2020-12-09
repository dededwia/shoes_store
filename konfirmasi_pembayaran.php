<html>
<head>
</head>
<body>
<?php 
error_reporting(0);
include "koneksi.php";
include "function.php";
date_default_timezone_set('Asia/Jakarta');
$d=date(d)."-".date(m)."-".date(Y);
$id=$_GET['id'];
$id00=str_replace(" ", "+", "$id");
$de_id=decrypt($id00);
$cari=mysql_query("select* from tb_login where id='$de_id'");
$baris=mysql_fetch_array($cari);
$username=$baris['username'];
$kd_plgn=$baris['kd_plgn'];
$cari00=mysql_query("select* from tb_transaksi where kd_plgn='$kd_plgn'");
$baris00=mysql_fetch_array($cari00);
$no_transaksi=$baris00['no_transaksi'];
$cari01=mysql_query("select sum(jumlah),sum(total_harga) from tb_detail where no_transaksi='$no_transaksi'");
$baris01=mysql_fetch_array($cari01);
$total_beli01=$baris01['sum(jumlah)'];
$total_bayar=$baris01['sum(total_harga)'];
$total_bayar00=number_format($total_bayar);
$total_bayar01=str_replace(",", ".","$total_bayar00");
?>
<table border=0 align=center bgcolor=transparent width=100% cellpadding=0 class="c">
<?php 
if ($id=="")
{ ?>
<tr>
	<td align=right><input type="image" onclick="window.location.href='index.php?p=home'" src="images/home.png" width=50 height=50></td>
</tr>
<?php }
else
{ ?>
<tr>
	<td align=right><input type="image" onclick="window.location.href='index.php?p=home&id=<?php echo $id;?>'" src="images/home.png" width=50 height=50></td>
</tr>
<?php } ?>
<br><br><br><br><br><br>
<table border=0 align=center width=100% cellpadding=70>
<tr>
	<td>
	<table border=0 bgcolor=white style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" align=center width=100%>
	<tr>
		<td valign=top bgcolor=white>
				<table border=0 align=center width=100% cellpadding=5>
				<tr>
					<td style="color:white">
					<form enctype="multipart/form-data" method="post">
					<table border=1 style="border-collapse:collapse;border-color:black" width=100% align=center cellpadding=10>
					<?php 
					$tampil=mysql_query("select* from tb_login where username='$username'");
					while ($baris=mysql_fetch_array($tampil))	
					{
						$kd_plgn=$baris['kd_plgn'];
						$tampil00=mysql_query("select* from tb_transaksi where kd_plgn='$kd_plgn'");
						while ($baris00=mysql_fetch_array($tampil00))
						{
							$no_transaksi=$baris00['no_transaksi'];
							$tampil01=mysql_query("select* from tb_pembayaran where no_transaksi='$no_transaksi'");
							while ($baris01=mysql_fetch_array($tampil01))
							{
								$no_transaksi00=$baris01['no_transaksi'];
								$no_transaksi01=encrypt($no_transaksi00);
								$kd_jns_pembayaran=$baris01['kd_jns_pembayaran'];
								$tampil02=mysql_query("select* from tb_jns_pembayaran where kd_jns_pembayaran='$kd_jns_pembayaran'");
								$baris02=mysql_fetch_array($tampil02);
								$nm_jns_pembayaran=$baris02['nm_jns_pembayaran'];
								$bukti_pembayaran=$baris02['bukti_pembayaran'];
								$tgl_upload=$baris01['tgl_upload'];
								$keterangan=$baris01['keterangan'];

							}
							
						}
					}
					if ($kd_jns_pembayaran=="BT")
					{
						if ($keterangan=="Menunggu Pembayaran" or $keterangan=="Verifikasi")
						{ ?>
							<tr>
								<td colspan=2 align=center style="font-size:18px;font-family:arial;font-weight:bold;height:100px" valign=middle>Konfirmasi Pembayaran</td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:12px">No. Transaksi</td><td style="font-family:arial;font-size:12px"><?php echo $no_transaksi00;?></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:12px">Metode Pembayaran</td><td style="font-family:arial;font-size:12px"><?php echo $nm_jns_pembayaran;?></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:12px" valign=top>Upload Bukti Transfer</td><td style="font-family:arial;font-size:12px" valign=top><input type="file" accept="image/*" name="gambar"><br><br><img src="upload/<?php echo $no_transaksi00.'.jpg';?>" width=150 height=200></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:12px">Tanggal Upload</td><td style="font-family:arial;font-size:12px"><?php echo $tgl_upload;?></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:12px">Status</td><td style="font-family:arial;font-size:12px"><?php echo $keterangan;?></td>
							</tr>
							<tr>
								<td colspan=2>
								<table border=0 width=100% align=center>
								<tr>
									<td><input type="button" class="tombol00" onclick="window.location.href='index.php?p=invoice01&id=<?php echo $id;?>&no_transaksi=<?php echo $no_transaksi01;?>'" value="Lihat Invoice"></td>
									<td style="font-family:arial;font-size:12px;color:white" align=right><input type="submit" onclick="return confirm('Apakah anda ingin menyimpan data ini?')" class="tombol00" name="upload" value="Simpan"></td>
								</tr>
								</table>
								</td>
							</tr>
						<?php }
						else
						{ ?>
							<script>window.location.href="index.php?p=home&id=<?php echo $id;?>";alert('Tidak ada data')</script>
		 				<?php } ?>
						</table>
						</form>
						<?php
						$gambar=$_FILES['gambar']['name'];
						if (isset($_POST['upload']))
						{
							if (!empty($gambar))
							{
								move_uploaded_file($_FILES['gambar']['tmp_name'],"upload/".$no_transaksi00.'.jpg');
								$gambar00=$no_transaksi00.".jpg";
								mysql_query("update tb_pembayaran set bukti_pembayaran='$gambar00',tgl_upload='$d',keterangan='Verifikasi' where no_transaksi='$no_transaksi00'");?>
								<meta http-equiv="refresh" content="0;url='index.php?p=konfirmasi_pembayaran&id=<?php echo $id;?>'">
							<?php }
							else
							{ ?>
								<script>alert('Anda belum mengupload bukti pembayaran')</script>
								<meta http-equiv="refresh" content="0;url='index.php?p=konfirmasi_pembayaran&id=<?php echo $id;?>'">
							<?php }
						}
					}		
					else
					{ ?>
						<script>window.location.href="index.php?p=home&id=<?php echo $id;?>";alert('Tidak ada data')</script>
					<?php } ?>
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