<html>
<head>
<style>
input[type=image]:hover
{ 
	box-shadow: 0px 8px 8px 0px rgba(0,0,0,0.2);
}
</style>
</head>
<body>
<?php 
//error_reporting(0);
include "koneksi.php";
include "function.php";
$id=$_GET['id'];
$id00=str_replace(" ", "+", "$id");
$de_id=decrypt($id00);
$cari=mysql_query("select* from tb_login where id='$de_id'");
$baris=mysql_fetch_array($cari);
$username=$baris['username'];
$kd_plgn=$baris['kd_plgn'];
$cari_produk=$_POST['cari'];

$cari00=mysql_query("select* from tb_transaksi where kd_plgn='$kd_plgn'");
$baris00=mysql_fetch_array($cari00);
$no_transaksi=$baris00['no_transaksi'];

$cari01=mysql_query("select sum(jumlah),sum(total_harga) from tb_detail where no_transaksi='$no_transaksi'");
$baris01=mysql_fetch_array($cari01);
$total_beli01=$baris01['sum(jumlah)'];
$total_bayar=$baris01['sum(total_harga)'];
$total_bayar00=number_format($total_bayar);
$total_bayar01=str_replace(",", ".", "$total_bayar00");
session_start();
if ($id!="")
{
	if (empty($_SESSION['id'])) 
	{
 		header("location:index.php?p=home"); 
	}
}
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
</table>
<br><br><br>
<table border=0 align=center cellpadding=50 width=100%>
<tr>
	<td>
	<table border=0 bgcolor=white  style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" align=center width=100% cellpadding=10>
	<tr>
		<td colspan=2 bgcolor=white width=100% align=center>
		<table cellpadding=50 width=100%>
		<tr>
			<td align=center>
			<table align=center width=100% align=center>
			<?php
			if (!empty($cari_produk))
			{ ?>
			<tr>
				<td colspan=4 align=center><font style="color:white;font-family:arial;font-size:18px;font-weight:bold">Hasil pencarian:</font></td>
			</tr>
			</table>
			<table border=0 width=100% align=center cellpadding=20 align=center>
			<tr>
				<td colspan=4 style="font-family:arial;font-size:18px;font-weight:bold" align=center>	
					<?php
					$tampil_produk00=mysql_query("select count(kd_produk) from tb_produk where nm_produk like '%$cari_produk%'");
					while($baris00=mysql_fetch_array($tampil_produk00))
					{
						$jumlah_produk=$baris00['count(kd_produk)'];
						echo "Hasil pencarian: ".$jumlah_produk." produk";
					} ?>
				</td>
			</tr>	
			<?php
			for ($i=0;$i<=100;$i+=4)
			{ ?>
			<tr>
				<?php
				$tampil=mysql_query("select* from tb_produk where nm_produk like '%$cari_produk%' limit $i,4");
				while ($baris=mysql_fetch_array($tampil))
				{
					$kd_produk=$baris['kd_produk'];
					$nm_produk=$baris['nm_produk'];
					$harga=$baris['harga'];
					$gambar=$baris['gambar'];
					$diskon=$baris['diskon'];
					?>
					<td align=center>
					<table border=1 style="border-collapse:collapse;border-color:gray">
					<tr>
					<td>
					<table border=0>
					<tr>
						<td><input type="image" src="images/<?php echo $gambar;?>" onclick="window.location.href='index.php?p=detail&id=<?php echo $id;?>&kd_produk=<?php echo $kd_produk;?>'" width=200 height=200><br></td>
					</tr>
					<tr>
						<td width=200 align=center><?php echo $nm_produk;?></td>
					</tr>
					<?php 
					if ($diskon>0)
					{ 
						$harga_stlh_diskon=$harga-($harga*$diskon);
						$harga_stlh_diskon00=number_format($harga_stlh_diskon);
						$harga_stlh_diskon01=str_replace(",", ".","$harga_stlh_diskon00");
						$diskon00=$diskon*100;?>
					<tr>
						<td width=200 align=center><font style="color:gray;font-size:12px;text-decoration:line-through"><?php echo "IDR. ".number_format($harga);?></font><font style="font-size:14px;font-family:arial">&nbsp;&nbsp;<?php echo "-".$diskon00."%";?></font><br><font style="font-family:arial;font-size:18px"><b><?php echo "IDR. ".$harga_stlh_diskon01;?></b></font></td>
					</tr>
					<?php }
					else
					{ ?>
					<tr>
						<td width=200 align=center style="font-family:arial;font-size:18px"><b><?php echo "IDR. ".number_format($harga);?></b></td>
					</tr>
					<?php } ?>
					</table>
					</td>
					</tr>
					</table>
					</td>
				<?php } ?>
			</tr>
			<?php }
			}
			$kd_kategori=$_GET['kd_kategori'];
			if ($kd_kategori=="semua_produk")
			{ ?>
				<tr>
					<td align=center><font style="color:black;font-family:arial;font-size:18px;font-weight:bold"><?php echo "Semua Produk";?></font></td>
				</tr>
				</table>
				<table border=0 width=100% align=center cellpadding=20 align=center>
				<?php
				for ($i=0;$i<=100;$i+=4)
				{ ?>
				<tr>
				<?php
					$tampil=mysql_query("select* from tb_produk limit $i,4");
					while ($baris=mysql_fetch_array($tampil))
					{
						$kd_produk=$baris['kd_produk'];
						$nm_produk=$baris['nm_produk'];
						$harga=$baris['harga'];
						$gambar=$baris['gambar'];
						$diskon=$baris['diskon'];?>
						<td align=center>
						<table border=1 style="border-collapse:collapse;border-color:gray">
						<tr>
							<td>
							<table border=0>
							<tr>
								<td><input type="image" src="images/<?php echo $gambar;?>" onclick="window.location.href='index.php?p=detail&id=<?php echo $id;?>&kd_produk=<?php echo $kd_produk;?>'" width=200 height=200><br></td>
							</tr>
							<tr>
								<td width=200 align=center><?php echo $nm_produk;?></td>
							</tr>
							<?php 
							if ($diskon>0)
							{ 
								$harga_stlh_diskon=$harga-($harga*$diskon);
								$harga_stlh_diskon00=number_format($harga_stlh_diskon);
								$harga_stlh_diskon01=str_replace(",", ".","$harga_stlh_diskon00");
								$harga00=number_format($harga);
								$harga01=str_replace(",", ".","$harga00");
								$diskon00=$diskon*100;?>
								<tr>
									<td width=200 align=center><font style="color:gray;font-size:12px;text-decoration:line-through"><?php echo "IDR. ".$harga01;?></font><font style="font-size:14px;font-family:arial">&nbsp;&nbsp;<?php echo "-".$diskon00."%";?></font><br><font style="font-family:arial;font-size:18px"><b><?php echo "IDR. ".$harga_stlh_diskon01;?></b></font></td>
								</tr>
							<?php }
							else
					{ 
						$harga00=number_format($harga);
						$harga01=str_replace(",", ".","$harga00");?>
						<tr>
							<td width=200 align=center style="font-family:arial;font-size:18px"><b><?php echo "IDR. ".$harga01;?></b></td>
						</tr>
					<?php } ?>
					</table>
					</td>
					</tr>
					</table>
					</td>					
				<?php } ?>
			</tr>
			<?php }
			} 
			else
			{ ?>
			<tr>
				<td colspan=4 align=center>
				<?php
				$kd_kategori=$_GET['kd_kategori'];
				$tampil00=mysql_query("select* from tb_kategori where kd_kategori='$kd_kategori'");
				$baris00=mysql_fetch_array($tampil00);?>
				<font style="font-family:arial;font-size:18px;font-weight:bold"><?php echo $baris00['nm_kategori'];?></font>
				</td>
			</tr>

			</table>
			<table border=0 width=100% align=center cellpadding=20 align=center>		
			<?php
			if ($id=="")
			{
				for ($i=0;$i<=100;$i+=4)
				{ ?>
					<tr>
					<?php
					$tampil=mysql_query("select* from tb_produk where kd_kategori='$kd_kategori' limit $i,4");
					while ($baris=mysql_fetch_array($tampil))
					{
						$kd_produk=$baris['kd_produk'];
						$nm_produk=$baris['nm_produk'];
						$harga=$baris['harga'];
						$gambar=$baris['gambar'];
						$diskon=$baris['diskon'];?>
						<td align=center>
						<table border=1 style="border-collapse:collapse;border-color:gray">
						<tr>
						<td>
						<table border=0>
						<tr>
							<td><input type="image" src="images/<?php echo $gambar;?>" onclick="window.location.href='index.php?p=detail&kd_produk=<?php echo $kd_produk;?>'" width=200 height=200><br></td>
						</tr>
						<tr>
							<td width=200 align=center><?php echo $nm_produk;?></td>
						</tr>
						<?php 
						if ($diskon>0)
						{ 
							$harga_stlh_diskon=$harga-($harga*$diskon);
							$harga_stlh_diskon00=number_format($harga_stlh_diskon);
							$harga_stlh_diskon01=str_replace(",", ".","$harga_stlh_diskon00");
							$harga00=number_format($harga);
							$harga01=str_replace(",", ".","$harga00");
							$diskon00=$diskon*100;?>
							<tr>
								<td width=200 align=center><font style="color:gray;font-size:12px;text-decoration:line-through"><?php echo "IDR. ".$harga01;?></font><font style="font-size:14px;font-family:arial">&nbsp;&nbsp;<?php echo "-".$diskon00."%";?></font><br><font style="font-family:arial;font-size:18px"><b><?php echo "IDR. ".$harga_stlh_diskon01;?></b></font></td>
							</tr>
						<?php }
						else
						{ 
							$harga00=number_format($harga);
							$harga01=str_replace(",", ".","$harga00");?>
							<tr>
								<td width=200 align=center style="font-family:arial;font-size:18px"><b><?php echo "IDR. ".$harga01;?></b></td>
							</tr>
						<?php } ?>
						</table>
						</td>
						</tr>
						</table>
						</td>							
					<?php } ?>
					</tr>
				<?php }
			}
			else
			{
				for ($i=0;$i<=100;$i+=4)
				{ ?>
					<tr>
					<?php
					$tampil=mysql_query("select* from tb_produk where kd_kategori='$kd_kategori' limit $i,4");
					while ($baris=mysql_fetch_array($tampil))
					{
						$kd_produk=$baris['kd_produk'];
						$nm_produk=$baris['nm_produk'];
						$harga=$baris['harga'];
						$gambar=$baris['gambar'];
						$diskon=$baris['diskon'];?>
						<td align=center>
						<table border=1 style="border-collapse:collapse;border-color:gray">
						<tr>
						<td>
						<table border=0>
						<tr>
							<td><input type="image" src="images/<?php echo $gambar;?>" onclick="window.location.href='index.php?p=detail&id=<?php echo $id;?>&kd_produk=<?php echo $kd_produk;?>'" width=200 height=200><br></td>
						</tr>
						<tr>
							<td width=200 align=center><?php echo $nm_produk;?></td>
						</tr>
						<?php 
						if ($diskon>0)
						{ 
							$harga_stlh_diskon=$harga-($harga*$diskon);
							$harga_stlh_diskon00=number_format($harga_stlh_diskon);
							$harga_stlh_diskon01=str_replace(",", ".","$harga_stlh_diskon00");
							$diskon00=$diskon*100;?>
							<tr>
								<td width=200 align=center><font style="color:gray;font-size:12px;text-decoration:line-through"><?php echo "IDR. ".number_format($harga);?></font><font style="font-size:14px;font-family:arial">&nbsp;&nbsp;<?php echo "-".$diskon00."%";?></font><br><font style="font-family:arial;font-size:18px"><b><?php echo "IDR. ".$harga_stlh_diskon01;?></b></font></td>
							</tr>
						<?php }
						else
						{ 
							$harga00=number_format($harga);
							$harga01=str_replace(",", ".","$harga00");?>
							<tr>
								<td width=200 align=center style="font-family:arial;font-size:18px"><b><?php echo "IDR. ".$harga01;?></b></td>
							</tr>
						<?php } ?>
						</table>
						</td>
						</tr>
						</table>
						</td>
					<?php } ?>
					</tr>

				<?php }
			}
		} ?>
		</tr>
		</table>
		</td>
	</tr>
	</table>	
	</td>
</tr>
	<tr>
		<td bgcolor=gray colspan=2>
		<table border=0 width=100% align=center>
		<tr>
			<th width=400 style="font-family:arial;font-size:18px;color:white;height:50px">Tentang Kami</th>
			<th width=400 style="font-family:arial;font-size:18px;color:white">Bantuan</th>
			<th style="font-family:arial;font-size:18px;color:white">Hubungi Kami</th>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:14px;color:white" valign=top align=center>
			Kami adalah toko online yang menjual berbagai <br>jenis kamera dengan berbagai ukuran<br>cocok bagi kamu yang menyukai fotografi.<br>baik pemula ataupun profesional<br>
			</td>
			<td style="font-family:arial;font-size:14px;color:white" bgcolor=gray valign=top>
			<table border=0 bgcolor=gray align=center>
			<?php 
			if ($id=="")
			{ ?>
			<tr>
				<td><a  class="ubahwarnalink00" href="index.php?p=panduan&id=<?php echo $id;?>">Panduan Cara Pembelian</a></td>
			</tr>
			<tr>
				<td><a  class="ubahwarnalink00" href="#" onclick="alert('Silahkan login terlebih dahulu');window.location.href='index.php?p=login&id=<?php echo $id;?>'">Konfirmasi Pembayaran</a></td>
			</tr>
			<tr>
				<td><a  class="ubahwarnalink00" href="#" onclick="alert('Silahkan login terlebih dahulu');window.location.href='index.php?p=login&id=<?php echo $id;?>'">Pembatalan Transaksi</a></td>
			</tr>
			<tr>
				<td><a class="ubahwarnalink00" href="#" onclick="alert('Silahkan login terlebih dahulu');window.location.href='index.php?p=login&id=<?php echo $id;?>'">Pengembalian Produk</a></td>
			</tr>
			<?php }
			else
			{ ?>
			<tr>
				<td><a  class="ubahwarnalink00" href="index.php?p=panduan&id=<?php echo $id;?>">Panduan Cara Pembelian</a></td>
			</tr>
			<tr>
				<td><a class="ubahwarnalink00" href="index.php?p=konfirmasi_pembayaran&id=<?php echo $id;?>">Konfirmasi Pembayaran</a></td>
			</tr>
			<tr>
				<td><a class="ubahwarnalink00" href="index.php?p=pembatalan_transaksi&id=<?php echo $id;?>">Pembatalan Transaksi</a></td>
			</tr>
			<?php 
			$cari00=mysql_query("select* from tb_login where username='$username'");
			while ($baris00=mysql_fetch_array($cari00))
			{
				$kd_plgn00=$baris00['kd_plgn'];
				$cari01=mysql_query("select* from tb_transaksi where kd_plgn='$kd_plgn00'");
				while ($baris01=mysql_fetch_array($cari01))
				{
					$no_transaksi01=$baris01['no_transaksi'];
					$cari02=mysql_query("select* from tb_pengembalian_produk where no_transaksi='$no_transaksi01'");	
					while ($baris02=mysql_fetch_array($cari02))
					{
						$keterangan=$baris02['keterangan'];
						
					}
					$cari03=mysql_query("select* from tb_pengembalian_produk where no_transaksi='$no_transaksi01' and keterangan='Proses Retur'");	
					while ($baris03=mysql_fetch_array($cari03))
					{
						$no_transaksi03=$baris03['no_transaksi'];
						$no_transaksi04=encrypt($no_transaksi03);
					}		

				}

			}
			if ($keterangan=="Proses Retur")
			{ ?>
				<tr>
					<td><a class="ubahwarnalink00" href="#" onclick="alert('Permintaan untuk pengembalian produk sedang dalam proses');window.location.href='index.php?p=form_retur00&id=<?php echo $id;?>&no_transaksi=<?php echo $no_transaksi04;?>'">Pengembalian Produk</a></td>
				</tr>
			<?php }	
			else
			{ ?>
				<tr>
					<td><a class="ubahwarnalink00" href="index.php?p=pengembalian_produk&id=<?php echo $id;?>">Pengembalian Produk</a></td>
				</tr>
			<?php }	?>
			<tr>
				<td><a class="ubahwarnalink00" href="index.php?p=cek_status_pengiriman&id=<?php echo $id;?>">Cek Status Pengiriman</a></td>
			</tr>
			<tr>
				<td><a class="ubahwarnalink00" href="index.php?p=ganti_pass&id=<?php echo $id;?>">Ganti Password</a></td>
			</tr>
			<?php }?>
			</table>
			</td>
			<td align=center bgcolor=gray width=400>
			<table border=0 bgcolor=gray align=center>
			<tr>
				<td width=30><img src="images/tlp.png" width=30 height=30></td><td width=100 valign=middle><font style="font-family:arial;font-size:14px;color:white">0899-4777-4777</font></td>
			</tr>
			<tr>
				<td width=30><img src="images/wa.png" width=30 height=30></td><td><font style="font-family:arial;font-size:14px;color:white">0899-4777-4777</font></td>
			</tr>
			<tr>
				<td width=30><img src="images/email.png" width=30 height=30></td><td><font style="font-family:arial;font-size:14px;color:white">madearyo@gmail.com</font></td>
			</tr>
			</table>
			</td>
		</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td bgcolor=#F7F7F7 colspan=2>
		<table width=100% align=center>
		<tr>
			<th style="font-family:arial;font-size:18px;color:gray;background:#F7F7F7;height:50px">Metode Pembayaran</th>
			<th style="font-family:arial;font-size:18px;color:gray;background:#F7F7F7">Jasa Pengiriman</th>
		</tr>
		<tr>
			<td align=center><img src="images/MasterCard-logo-1990.png" width=70 height=40>&nbsp;&nbsp;&nbsp;<img src="images/visa.jpg" width=80 height=40></td>
			<td align=center><img src="images/jne.jpg" width=70 height=40>&nbsp;&nbsp;&nbsp;<img src="images/jet.png" width=70 height=40></td>
		</tr>
		</table>
		</td>	
	</tr>
	</table>
	</td>
</tr>
</table>
</body>
</html>