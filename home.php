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


if ($id!="")
{
	$cari01=mysql_query("select* from tb_pengiriman where keterangan='Ulasan'");
	while ($baris01=mysql_fetch_array($cari01))
	{
		$no_transaksi01=$baris01['no_transaksi'];
		$no_transaksi02=encrypt($no_transaksi01);
		$cari02=mysql_query("select* from tb_transaksi where no_transaksi='$no_transaksi01'");
		while ($baris02=mysql_fetch_array($cari02))
		{
			$kd_plgn02=$baris02['kd_plgn'];
			$cari03=mysql_query("select* from tb_login where kd_plgn='$kd_plgn02'");
			while ($baris03=mysql_fetch_array($cari03))
			{
				$username00=$baris03['username'];
				if ($username00==$username)
				{ ?>
					<meta http-equiv="refresh" content="0;url='index.php?p=ulasan&id=<?php echo $id;?>&no_transaksi=<?php echo $no_transaksi02;?>'">		
				<?php }
			}				
		}
	}

} 
$cari00=mysql_query("select* from tb_transaksi where kd_plgn='$kd_plgn'");
$baris00=mysql_fetch_array($cari00);
$no_transaksi=$baris00['no_transaksi'];

$cari01=mysql_query("select sum(jumlah),sum(total_harga) from tb_detail where no_transaksi='$no_transaksi'");
$baris01=mysql_fetch_array($cari01);
$total_beli00=$baris01['sum(jumlah)'];
$total_beli01=str_replace(",", ".", "$total_beli00");
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
<br><br><br><br><br><br>
<table border=0 align=center width=100% cellpadding=30>
<tr>
	<td>
	<table border=0 style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)"  align=center width=100%>
	<tr>
		<td bgcolor=#F7F7F7 width=100%>
		<table border=0 cellpadding=50 width=100%>
		<tr>
			<td>
			<div class="slideshow-container">
  	
			<?php
			$tampil=mysql_query("select* from tb_produk where rak='highlight'");
			while ($baris=mysql_fetch_array($tampil))
			{ 
				$gambar=$baris['gambar'];
				$kd_produk=$baris['kd_produk'];
				$nm_produk=$baris['nm_produk'];?>	
				<div class="mySlides slide" align=left>
				<table bgcolor=white width=100% cellpadding=10>
				<?php 
				if ($id=="")
				{ ?>
				<tr>
					<td><input type="image" onclick="window.location.href='index.php?p=detail&kd_produk=<?php echo $kd_produk;?>'" src="images/<?php echo $gambar;?>" width=100% height=450></td>
				</tr>
				<tr>
					<td align=center style="font-family:arial;font-size:14px;font-weight:bold"><?php echo $nm_produk;?></td>
				</tr>
				<?php }
				else
				{ ?>
				<tr>
					<td><input type="image" onclick="window.location.href='index.php?p=detail&id=<?php echo $id;?>&kd_produk=<?php echo $kd_produk;?>'" src="images/<?php echo $gambar;?>" width=100% height=450></td>
				</tr>
				<tr>
					<td align=center style="font-family:arial;font-size:14px;font-weight:bold"><?php echo $nm_produk;?></td>
				</tr>
				<?php } ?>
				
				</table>
				</div>
		
			<?php } ?>
			<script>
			var slideIndex = 0;
		
			showSlides();	

		
			function showSlides() 
		
			{		
    			
				var i;
    			
				var slides = document.getElementsByClassName("mySlides");
    			
				for (i = 0; i < slides.length; i++) 
			
				{
        			
					slides[i].style.display = "none"; 
    			
				}		
    			
				slideIndex++;
    			
				if (slideIndex > slides.length) 
			
				{
				
					slideIndex = 1
			
				} 
    			
				slides[slideIndex-1].style.display = "block"; 
    			
				setTimeout(showSlides, 2000);
		
			}
		
			</script>
			</td>
		</tr>
		</table>			
		</td>
	</tr>
	</table><br>
	<table border=0   style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" width=100% bgcolor=white cellpadding=10 align=center>
	<tr>
		<th colspan=2 style="font-family:arial;font-size:19px;color:orange" width=50% align=left>Highlight</th>
		
	</tr>
	<tr>
		<td colspan=2 style="font-family:arial;font-size:14px" align=center><hr></td>
	</tr>
	<tr>
		<td align=center colspan=2>
		<table border=0 width=100% align=center>
		
		
	<?php 
	for ($i=0;$i<=30;$i+=4)
	{?>
		<tr>
		<?php 
		$tampil_produk=mysql_query("select* from tb_produk where rak='highlight' limit $i,4");
		while ($baris_produk=mysql_fetch_array($tampil_produk))
		{
			$kd_produk=$baris_produk['kd_produk'];
			$nm_produk=$baris_produk['nm_produk'];
			$harga=$baris_produk['harga'];
			$gambar=$baris_produk['gambar'];
			$diskon=$baris_produk['diskon'];
			if ($id=="")
			{ ?>	
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
					$harga01=str_replace(",", ".","$harga00");
					?>
					<tr>
						<td width=200 align=center style="font-family:arial;font-size:18px"><b><?php echo "IDR. ".$harga01;?></b></td>
					</tr>
				<?php } ?>
				</table>
				</td>
				</tr>
				</table>
				</td>
			<?php }
			else
			{ ?>	
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
					$harga01=str_replace(",", ".","$harga00");
					?>
					<tr>
						<td width=200 align=center style="font-family:arial;font-size:18px"><b><?php echo "IDR. ".$harga01;?></b></td>
					</tr>
				<?php } ?>
				</table>
				</td>
				</tr>
				</table>
				</td>
			<?php }
			
			
		} ?>
		</tr>
	<?php }?>
	
		
		</table>
		</td>
	</tr>

	<tr>
		<th colspan=2 style="font-family:arial;font-size:19px;color:#00AFEF" width=50% align=left>Kategori</th>
		
	</tr>
	<tr>
		<td colspan=2 style="font-family:arial;font-size:14px" align=center><hr></td>
	</tr>
	<tr>
		<td align=center colspan=2>
		<table border=0 width=100% align=center>
		<tr>
		
	<?php 
	
	for ($i=0;$i<=100;$i+=4)
	{
		$tampil_kategori=mysql_query("select* from tb_kategori limit $i,4");
		while ($baris_kategori=mysql_fetch_array($tampil_kategori))
		{
			$kd_kategori=$baris_kategori['kd_kategori'];
			$nm_kategori=$baris_kategori['nm_kategori'];
			$gambar00=$baris_kategori['gambar'];
			$tampil_produk00=mysql_query("select count(kd_kategori) from tb_produk where kd_kategori='$kd_kategori'");
			while ($baris_produk00=mysql_fetch_array($tampil_produk00))
			{
				$jumlah_produk=$baris_produk00['count(kd_kategori)'];
			}
			if ($id=="")
			{ ?>
				<td align=center><input type="image" src="images/<?php echo $gambar00;?>" onclick="window.location.href='index.php?p=konten&kd_kategori=<?php echo $kd_kategori;?>'" width=200 height=200><br>
				<table border=0>
				<tr>
					<td width=200 align=center><?php echo $nm_kategori."<br><font style='color:gray;font-size:12px'>".$jumlah_produk." produk";?></td>
				</tr>
				</table>
				</td>
			<?php }
			else
			{ ?>
				<td align=center><input type="image" src="images/<?php echo $gambar00;?>" onclick="window.location.href='index.php?p=konten&id=<?php echo $id;?>&kd_kategori=<?php echo $kd_kategori;?>'" width=200 height=200><br>
				<table border=0>
				<tr>
					<td width=200 align=center><?php echo $nm_kategori."<br><font style='color:gray;font-size:12px'>".$jumlah_produk." produk";?></td>
				</tr>
				</table>
				</td>
			<?php }
		}
	} ?>
		
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