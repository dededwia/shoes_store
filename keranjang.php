<html>
<head>
</head>
<body>
<?php 
error_reporting(0);
include "koneksi.php";
include "function.php";
$id=$_GET['id'];
$id00=str_replace(" ", "+", "$id");
$de_id=decrypt($id00);
$cari=mysql_query("select* from tb_login where id='$de_id'");
$baris=mysql_fetch_array($cari);
$username=$baris['username'];
$kd_plgn=$baris['kd_plgn'];
$kd_produk=$_POST['kd_produk'];
$jumlah=$_POST['jumlah'];
$cari00=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
$baris00=mysql_fetch_array($cari00);
$harga=$baris00['harga'];
$berat=$baris00['berat'];
$diskon=$baris00['diskon'];
$diskon00=($diskon*100)."%";
$harga00=$harga-($harga*$diskon);
$cari00=mysql_query("select* from tb_transaksi where kd_plgn='$kd_plgn'");
$baris01=mysql_fetch_array($cari00);
$no_transaksi01=$baris01['no_transaksi'];
$cari02=mysql_query("select* from tb_detail where kd_produk='$kd_produk' and no_transaksi='$no_transaksi01'");
while ($baris02=mysql_fetch_array($cari02))
{
	$kd_produk00=$baris02['kd_produk'];
	$id03=$baris02['id'];
}
if ($kd_produk00==$kd_produk)
{
	$cari03=mysql_query("select* from tb_detail where id='$id03' and no_transaksi='$no_transaksi01'");
	$baris03=mysql_fetch_array($cari03);
	$jumlah00=$baris03['jumlah'];
	$jumlah02=$jumlah00+$jumlah;
	$total_harga01=$harga00*$jumlah02;
	$total_berat=$berat*$jumlah02;
	mysql_query("update tb_detail set jumlah='$jumlah02',total_berat='$total_berat',total_harga='$total_harga01' where id='$id03'");
	$tampil_produk=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
	$baris04=mysql_fetch_array($tampil_produk);
	$stok=$baris04['stok'];
	$stok_akhir=$stok-$jumlah;
	mysql_query("update tb_produk set stok='$stok_akhir' where kd_produk='$kd_produk'");
}
else
{
	$cari04=mysql_query("select* from tb_detail where kd_produk='$kd_produk' and no_transaksi='$no_transaksi01'");
	$baris04=mysql_fetch_array($cari04);
	$jumlah00=$baris04['jumlah'];
	$jumlah01=$jumlah00+$jumlah;
	$total_harga01=$harga00*$jumlah01;
	$total_berat=$berat*$jumlah01;
	mysql_query("insert into tb_detail values('','$no_transaksi01','$kd_produk','$berat','$harga00','$jumlah','$total_berat','$total_harga01')");
	$tampil_produk=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
	$baris05=mysql_fetch_array($tampil_produk);
	$stok=$baris05['stok'];
	$stok_akhir=$stok-$jumlah;
	mysql_query("update tb_produk set stok='$stok_akhir' where kd_produk='$kd_produk'");
}

$cari01=mysql_query("select sum(jumlah),sum(total_harga) from tb_detail where no_transaksi='$no_transaksi01'");
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
<br><br><br>
<table align=center cellpadding=70 width=100%>
<tr>
	<td>
	<table border=0 bgcolor=white style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)"  align=center width=100%>
	<tr>
		<td bgcolor=white width=100% align=center>
		<table cellpadding=50 width=100%>
		<tr>
			<td align=center>
			<table align=center width=100% align=center>
			<tr>
				<td style="color:white">
				<table border=1 style="border-collapse:collapse" align=center width=100% cellpadding=10>
				<tr>
					<th colspan=4 style="font-family:arial;font-size:18px;height:80px" align=center>Keranjang Belanja</td>
				</tr>
				<tr>	
					<th colspan=4 style="font-family:arial;font-size:14px" align=right>No. Transaksi : <?php echo $no_transaksi01;?></th>
				</tr>
				<tr>	
					<th style="font-family:arial;font-size:14px">Nama Produk</th>
					<th style="font-family:arial;font-size:14px">Jumlah</th>
					<th style="font-family:arial;font-size:14px">Harga</th>
					<th style="font-family:arial;font-size:14px">Action</th>
				</tr>
				<?php
				$cari=mysql_query("select* from tb_detail where no_transaksi='$no_transaksi01'");
				while ($baris=mysql_fetch_array($cari))
				{ 
					$id00=$baris['id'];
					$kd_produk=$baris['kd_produk'];
					$cari00=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
					$baris00=mysql_fetch_array($cari00);
					$nm_produk=$baris00['nm_produk'];
					$satuan=$baris00['satuan'];
					$diskon=$baris00['diskon'];
					$berat=$baris00['berat'];
					$gambar=$baris00['gambar'];
					$jumlah=$baris['jumlah'];
					$total_harga00=$baris['total_harga'];
					$total_harga01=number_format($total_harga00);
					$total_harga02=str_replace(",", ".","$total_harga01");
					
					?>
					<tr>	
						<td style="font-family:arial;font-size:14px" valign=middle><img src="images/<?php echo $gambar;?>" width=100 height=100><?php echo $nm_produk;?></td>
						<td style="font-family:arial;font-size:14px" valign=middle align=right><?php echo $jumlah." ".$satuan;?></td>
						<td style="font-family:arial;font-size:14px" valign=middle align=right><?php echo "IDR ".$total_harga02;?></td>
						<td style="font-family:arial;font-size:14px" valign=middle align=center><button onclick="return confirm('Apakah anda ingin menghapus produk <?php echo $nm_produk;?> dari keranjang belanja anda?')" name="a" class="tombol03"><a style="text-decoration:none;color:white" href="hapus_produk.php?id=<?php echo $id;?>&id00=<?php echo $id00;?>">Hapus</a></td>
					</tr>
				<?php 
				} 
				$cari01=mysql_query("select sum(jumlah),sum(total_harga),sum(total_berat) from tb_detail where no_transaksi='$no_transaksi01'");
				$baris01=mysql_fetch_array($cari01);
				$total_beli=$baris01['sum(jumlah)'];
				$total_harga=$baris01['sum(total_harga)'];
				$total_harga03=number_format($total_harga);
				$total_harga04=str_replace(",", ".","$total_harga03");?>
				<?php
				if ($kd_produk=="")
				{  ?>
					<tr>
						<td colspan=4>
						<table border=0 style="background:white" width=100% align=center cellpadding=10>
						<tr>
							<td colspan=4 align=center style="background:white"><img src="images/keranjang_kosong.png" width=250 height=250></td>
						</tr>
						<tr>
							<td colspan=4 align=center style="background:white;color:black;font-weight:bold;font-size:18px">Keranjang Kosong</td>
						</tr>
						</table>
						</td>
					</tr>
				<?php } 
				else
				{ ?>			
					<tr>
						<td></td>
						<td style="font-family:arial;font-size:14px" valign=middle align=right><b><?php echo $total_beli;?></td>
						<td style="font-family:arial;font-size:14px" valign=middle align=right><b><?php echo "IDR. ".$total_harga04;?></td>	
						<td style="font-family:arial;font-size:14px" valign=middle align=center><button onclick="return confirm('Apakah anda ingin menghapus semua produk dari keranjang belanja anda?')" name="b" class="tombol03"><a style="text-decoration:none;color:white" href="hapus_semua_produk.php?id=<?php echo $id;?>">Hapus Semua</a></td>
					</tr>
					<form action="index.php?p=jns_pembayaran&id=<?php echo $id;?>" method="post">
					<input type="hidden" name="no_transaksi" value="<?php echo $no_transaksi01;?>">
					<tr>
						<td colspan=4 align=center><input type="submit" name="submit" class="tombol00" value="Lanjut"></td>
					</tr>
					</form>		
				<?php } ?>		
				</table>
				
				</td>
			</tr>
			</table>
			</td>
		</tr>
		</table>
		</td>
	</tr>

	<tr>
		<td bgcolor=white colspan=2>
		<table bgcolor=gray width=100% align=center>
		<tr>
			<th width=400 style="font-family:arial;font-size:18px;color:white;height:50px">Tentang Kami</th>
			<th width=400 style="font-family:arial;font-size:18px;color:white">Bantuan</th>
			<th style="font-family:arial;font-size:18px;color:white">Hubungi Kami</th>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:14px;color:white" valign=top align=center>
			Kami adalah toko online yang menjual berbagai <br>jenis kamera dengan berbagai ukuran<br>cocok bagi kamu yang menyukai fotografi.<br>baik pemula ataupun profesional<br>
			</td>
			<td style="font-family:arial;font-size:14px;color:white" valign=top>
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
<table border=0 align=center bgcolor=transparent width=100% cellpadding=0 class="c">
<?php 
if ($id=="")
{ ?>
<tr>
	<td align=left><input type="image" onclick="window.location.href='index.php?p=konten&kd_kategori=<?php echo $kd_kategori;?>'" src="images/kembali.png" width=50 height=50></td><td align=right><input type="image" onclick="window.location.href='index.php?p=home'" src="images/home.png" width=50 height=50></td>
</tr>
<?php }
else
{ ?>
<tr>
	<td align=left><input type="image" src="images/kembali.png" onclick="window.location.href='index.php?p=home&id=<?php echo $id;?>'" width=50 height=50></td><td align=right><input type="image" onclick="window.location.href='index.php?p=home&id=<?php echo $id;?>'" src="images/home.png" width=50 height=50></td>
</tr>
<?php } ?>
</table>
</body>
</html>