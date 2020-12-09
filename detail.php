<html>
<head>
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
$kd_produk=$_GET['kd_produk'];
$tampil=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
$baris=mysql_fetch_array($tampil);
$nm_produk=$baris['nm_produk'];
$kd_kategori=$baris['kd_kategori'];
$spesifikasi=$baris['spesifikasi'];
$berat=$baris['berat'];
$satuan=$baris['satuan'];
$harga=number_format($baris['harga']);
$gambar=$baris['gambar'];
$rating=$baris['rating'];

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
 		header("location:index.php?p=login"); 
	}
}
?>
<script>
function nonaktifkan()
{
 document.onkeydown = function (e)
 {
  return false;
 }
}
</script>
<table border=0 align=center class="c" bgcolor=transparent width=100% cellpadding=0>
<?php 
if ($id=="")
{ ?>
<tr>
	<td><input type="image" onclick="window.location.href='index.php?p=konten&kd_kategori=<?php echo $kd_kategori;?>'" src="images/kembali.png" width=50 height=50></td><td align=right><input type="image" onclick="window.location.href='index.php?p=home'" src="images/home.png" width=50 height=50></td>
</tr>
<?php }
else
{ ?>
<tr>
	<td></td><td><input type="image" src="images/kembali.png" onclick="window.location.href='index.php?p=konten&id=<?php echo $id;?>&kd_kategori=<?php echo $kd_kategori;?>'" width=50 height=50></td><td align=right><input type="image" onclick="window.location.href='index.php?p=home&id=<?php echo $id;?>'" src="images/home.png" width=50 height=50></td>
</tr>
<?php } ?>
</table>
<table border=0 align=center bgcolor=red width=100% style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" cellpadding=0 class="b">
<?php 
if ($id=="")
{ ?>
	<td><img src="images/logo.png" width=200 height=100px></td>
	<td width=500px>
	<form action="index.php?p=konten" method="post">
	<table border=0>
	<tr>
		<td width=100%><input type="text" name="cari" style="padding-left:10px" required placeholder="Masukkan nama produk"></td><td><input type="image" src="images/cari.png" width=35 height=35></td>
	</tr>
	</table>
	</form>
	</td>
	<td width=400>
	<table border=0 align=right>
	<tr>
		<td width=100 style="font-family:arial;font-size:12px;color:white">Selamat Datang</td><td><input type="image" src="images/login.png" onclick="window.location.href='index.php?p=login'" align=right width=60 height=60></td><td  width=100 style="font-family:arial;font-size:12px;color:white" align=right>Keranjang Belanja</td><td align=right><input type="image" src="images/keranjang.png" onclick="alert('Maaf, anda tidak bisa melanjutkan transaksi, silahkan untuk melakukan login')" width=60 height=60></td>
	</tr>
	</table>
	</td>			
</tr>
<?php }
else
{ ?>
	<td><img src="images/logo.png" width=200 height=100px></td>
	<td width=500px>
	<form action="index.php?p=konten&id=<?php echo $id;?>" method="post">
	<table border=0>
	<tr>
		<td width=100%><input type="text" name="cari" style="padding-left:10px" required placeholder="Masukkan nama produk"></td><td><input type="image" src="images/cari.png" width=35 height=35></td>
	</tr>
	</table>
	</form>
	</td>
	<td width=400>
	<table border=0 align=right>
	<tr>
		<script>
		function x()
		{
			var jawab=confirm("Apakah anda ingin keluar dari akun anda?");
			if (jawab)
			{
				window.location.href="logout.php?id=<?php echo $id;?>"
			}

		}
		</script>
		<?php
		if ($total_beli01>0)
		{ ?>
			<td width=100 style="font-family:arial;font-size:12px;color:white">Selamat Datang<br><br><?php echo $username;?></td><td><input type="image" src="images/login.png" onclick="x()" align=right width=60 height=60></td><td width=100 style="font-family:arial;font-size:12px;color:white" align=right>Keranjang Belanja<br><button style="border:none;border-radius:25px;background:white;color:red" disabled><?php echo $total_beli01;?></button><br><?php echo "IDR. ".$total_bayar01;?></td><td align=right><input type="image" src="images/keranjang01.png" onclick="window.location.href='index.php?p=keranjang&id=<?php echo $id;?>'" width=60 height=60></td>
		<?php }
		else
		{ ?>
			<td width=100 style="font-family:arial;font-size:12px;color:white">Selamat Datang<br><br><?php echo $username;?></td><td><input type="image" src="images/login.png" onclick="x()" align=right width=60 height=60></td><td width=100 style="font-family:arial;font-size:12px;color:white" align=right>Keranjang Belanja<br><button style="border:none;border-radius:25px;background:white;color:red" disabled>0</button><br><?php echo "IDR. ".number_format($total_bayar01);?></td><td align=right><input type="image" src="images/keranjang.png" onclick="window.location.href='index.php?p=keranjang&id=<?php echo $id;?>'" width=60 height=60></td>
		<?php } ?>
	</tr>
	</table>
	</td>	

<?php } ?>
</table>
<br><br><br><br><br><br>
<table align=center cellpadding=30 width=100%>
<tr>
	<td>
	<table border=0 bgcolor=white style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" align=center width=100%>
	<tr>
		<td colspan=2 bgcolor=white width=100% align=center>
		<table cellpadding=50 width=100%>
		<tr>
			<td align=center>
			<table align=center width=100% align=center>
			<tr>
				<td>
				<form action="index.php?p=keranjang&id=<?php echo $id;?>" method="post">
				<input type="hidden" name="kd_produk" value="<?php echo $kd_produk;?>">
				<input type="hidden" name="harga" value=<?php echo $harga;?>">
				<table border=1 style="border-collapse:collapse;border-color:gray" width=100% align=center>
				<tr>
					<td width=300>
					<table width=100% align=center>
					<tr>
						<td align=center><img src="images/<?php echo $gambar;?>" width=100% height=350></td>
					</tr>
					</table>
					</td>
					<td valign=top>
					<table border=0 height=100% width=100%>
					<?php
					$tampil_stok=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
					$baris=mysql_fetch_array($tampil_stok);
					$harga00=$baris['harga'];
					$stok=$baris['stok'];
					$satuan=$baris['satuan'];
					$diskon=$baris['diskon'];
					?>
					<tr>
						<td style="font-family:arial;font-size:24px;font-weight:bold"><?php echo $nm_produk;?></td>
					</tr>
					<tr>
						<td><hr></td>
					</tr>
					<?php 
					if ($stok>0)
					{ ?>
					<tr>
						<td style="font-family:arial;font-size:14px">Stok <?php echo $stok." ".$satuan;?></td>
					</tr>
					<?php }
					else
					{ ?>
					<tr>
						<td style="font-family:arial;font-size:14px">Stok habis</td>
					</tr>
					<?php }?>
					<tr>
						<td style="font-family:arial;font-size:14px">
						<?php
						$tampil=mysql_query("select count(kd_plgn),sum(nilai) from tb_ulasan where kd_produk='$kd_produk'");
						$baris=mysql_fetch_array($tampil);
						$jumlah_plgn=$baris['count(kd_plgn)'];
						$nilai=$baris['sum(nilai)']; 
						$hasil=round($nilai/$jumlah_plgn);
						if ($hasil<1)
						{
							echo "No Rating";
						}
						else
						{
							$rating00=$hasil-1;
							$rating01=(5-($hasil))-1;
							for ($i=0;$i<=$rating00;$i++)
							{ ?>
								<img src="images/bintang.png" width=25 height=25>
							<?php } 
							for ($i=0;$i<=$rating01;$i++)
							{ ?>
								<img src="images/bintang01.png" width=25 height=25>
							<?php } 
						}?>
						</td>
					</tr>
					<?php
if ($stok>0)
{
					if ($diskon>0)
					{ 
						$harga_stlh_diskon=$harga00-($harga00*$diskon);
						$harga_stlh_diskon00=number_format($harga_stlh_diskon);
						$harga_stlh_diskon01=str_replace(",", ".","$harga_stlh_diskon00");
						$harga00=number_format($harga);
						$harga01=str_replace(",", ".","$harga");
						$diskon00=$diskon*100;?>
					<tr>	
						<td style="font-family:arial;font-size:14px"><font style="text-decoration:line-through"><?php echo "IDR. ".$harga01;?></font>&nbsp;&nbsp<font style="font-size:16px">&nbsp;-<?php echo $diskon00."%";?></font></td>
					</tr>
					<tr>	
						<td><font style="font-family:arial;font-size:14px"><?php echo "IDR. ";?><font style="font-family:arial;font-size:36px"><?php echo $harga_stlh_diskon01;?></font><br><br></td>
					</tr>
					<tr>	
						<td style="font-family:arial;font-size:14px">Spesifikasi <br><br><?php echo $spesifikasi;?></td>
					</tr>
					<tr>	
						<td style="font-family:arial;font-size:14px"><label>Jumlah</label>&nbsp;&nbsp;<input type="number" style="width:50px" min="1" max="<?php echo $stok;?>" name="jumlah" onclick="nonaktifkan();" value="1"></td>
					</tr>
					<?php }
					else
					{ 
						$harga00=number_format($harga);
						$harga01=str_replace(",", ".","$harga");
						$diskon00=$diskon*100;?>
					<tr>	
						<td style="font-family:arial;font-size:14px"><?php echo "IDR. "."<font size=6>$harga01</font>";?><br><br></td>
					</tr>
					<tr>	
						<td style="font-family:arial;font-size:14px">Spesifikasi <br><br><?php echo $spesifikasi;?></td>
					</tr>
					<tr>	
						<td style="font-family:arial;font-size:14px"><label>Jumlah</label>&nbsp;&nbsp;<input type="number" style="width:50px" min="1" max="<?php echo $stok;?>" name="jumlah"  onclick="nonaktifkan();" value="1"></td>
					</tr>
					<?php } 
}
else
{ 
					if ($diskon>0)
					{ 
						$harga_stlh_diskon=$harga00-($harga00*$diskon);
						$harga_stlh_diskon00=number_format($harga_stlh_diskon);
						$harga_stlh_diskon01=str_replace(",", ".","$harga_stlh_diskon00");
						$harga00=number_format($harga);
						$harga01=str_replace(",", ".","$harga");
						$diskon00=$diskon*100;?>
					<tr>	
						<td style="font-family:arial;font-size:14px"><font style="text-decoration:line-through;color:gray"><?php echo "IDR. ".$harga01;?></font>&nbsp;&nbsp<font style="font-size:16px;color:gray">&nbsp;-<?php echo $diskon00."%";?></font></td>
					</tr>
					<tr>	
						<td><font style="font-family:arial;font-size:14px;color:gray"><?php echo "IDR. ";?><font style="font-family:arial;font-size:36px;color:gray"><?php echo $harga_stlh_diskon01;?></font><br><br></td>
					</tr>
					<tr>	
						<td style="font-family:arial;font-size:14px;color:gray">Spesifikasi <br><br><?php echo $spesifikasi;?></td>
					</tr>
					<tr>	
						<td style="font-family:arial;font-size:14px;color:gray"><label>Jumlah</label>&nbsp;&nbsp;<input type="number" style="width:50px" name="jumlah" value="0" disabled></td>
					</tr>
					<?php }
					else
					{ 
						$harga00=number_format($harga);
						$harga01=str_replace(",", ".","$harga");
						$diskon00=$diskon*100;?>
					<tr>	
						<td style="font-family:arial;font-size:14px;color:gray"><?php echo "IDR. "."<font size=6>$harga01</font>";?><br><br></td>
					</tr>
					<tr>	
						<td style="font-family:arial;font-size:14px;color:gray">Spesifikasi <br><br><?php echo $spesifikasi;?></td>
					</tr>
					<tr>	
						<td style="font-family:arial;font-size:14px;color:gray"><label>Jumlah</label>&nbsp;&nbsp;<input type="number" style="width:50px" name="jumlah" value="0" disabled></td>
					</tr>
					<?php }
} ?>
					</table>
					<table border=0 width=100% align=center height=150 cellpadding=10>
				<?php 
				if ($id!="")		
				{ 
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
								
								$keterangan=$baris01['keterangan'];
							}
						}
					}
					if ($kd_plgn!="" and $no_transaksi=="")
					{ ?>
						<tr>
							<td align=right><input type="submit" onclick="return confirm('Apakah anda ingin membeli produk <?php echo $nm_produk;?>?')"  class="tombol02" value="Beli"></td>
						</tr>
					<?php }
					else
					{ 
						if ($keterangan=="Selesai" or $keterangan=="")
						{
							if ($stok>0)
							{ ?>
								<tr>
									<td align=right><input type="submit" onclick="return confirm('Apakah anda ingin membeli produk <?php echo $nm_produk;?>?')" class="tombol02" value="Beli"></td>
								</tr>
							<?php }
							else
							{ ?>
								<tr>
									<td align=right><input type="submit" class="tombol05" value="Stok habis" disabled></td>
								</tr>
							<?php }
							
						}
						else 
						{ 
							if ($stok>0)
							{ ?>
								<tr>
									<td align=right><input type="button" class="tombol02" onclick="alert('Maaf, anda tidak dapat melanjutkan transaksi. Status invoive pada order sebelumnya adalah <?php echo $keterangan;?>');location='index.php?p=konfirmasi_pembayaran&id=<?php echo $id;?>'" value="Beli"></td>
								</tr>
							<?php }
							else
							{ ?>
								<tr>
									<td align=right><input type="button" class="tombol05" value="Stok habis" disabled></td>
								</tr>
							<?php }

						}
					}
				}
				else	
				{ 
					if ($stok>0)
					{ ?>
					<tr>
						<td align=right><input type="button" class="tombol02" onclick="alert('Maaf, anda tidak bisa melanjutkan transaksi, silahkan untuk melakukan login terlebih dahulu');window.location.href='index.php?p=login'" value="Beli"></td>
					</tr>
					<?php }
					else
					{ ?>
					<tr>
						<td align=right><input type="button" class="tombol02" value="Beli" disabled></td>
					</tr>
					<?php }				
				} ?>
					</table>
					</td>
				</tr>
				<tr>
					<td colspan=2>
					<table border=0 width=100% align=center cellpadding=10>
					<tr>
						<td align=center style="width:100%">Ulasan</td>
					</tr>
					<tr>
						<?php
						if ($nilai!="")
						{ ?>
						<td>
						<table border=0 width=100%>
						<tr>
							<td width=100px>
							<?php
							for ($i=0;$i<=0;$i++)
							{ ?>
								<img src='images/bintang.png' width=15 height=15>
							<?php } 
							for ($i=0;$i<=3;$i++)
							{ ?>
								<img src='images/bintang01.png' width=15 height=15>
							<?php } ?>
							</td>
							<td style="font-family:arial;font-size:12px">
							<?php
							$tampil=mysql_query("select count(kd_plgn) from tb_ulasan where kd_produk='$kd_produk' and nilai='1'");
							$baris=mysql_fetch_array($tampil);
							$jumlah=$baris['count(kd_plgn)'];
							echo $jumlah." ulasan";
							?>
							</td>
						</tr>
						<tr>
							<td width=100px>
							<?php
							for ($i=0;$i<=1;$i++)
							{ ?>
								<img src='images/bintang.png' width=15 height=15>
							<?php } 
							for ($i=0;$i<=2;$i++)
							{ ?>
								<img src='images/bintang01.png' width=15 height=15>
							<?php } ?>
							</td>
							<td style="font-family:arial;font-size:12px">
							<?php
							$tampil=mysql_query("select count(kd_plgn) from tb_ulasan where kd_produk='$kd_produk' and nilai='2'");
							$baris=mysql_fetch_array($tampil);
							$jumlah=$baris['count(kd_plgn)'];
							echo $jumlah." ulasan";
							?>
							</td>
						</tr>
						<tr>
							<td width=100px>
							<?php
							for ($i=0;$i<=2;$i++)
							{ ?>
								<img src='images/bintang.png' width=15 height=15>
							<?php } 
							for ($i=0;$i<=1;$i++)
							{ ?>
								<img src='images/bintang01.png' width=15 height=15>
							<?php } ?>
							</td>
							<td style="font-family:arial;font-size:12px">
							<?php
							$tampil=mysql_query("select count(kd_plgn) from tb_ulasan where kd_produk='$kd_produk' and nilai='3'");
							$baris=mysql_fetch_array($tampil);
							$jumlah=$baris['count(kd_plgn)'];
							echo $jumlah." ulasan";
							?>
							</td>
						</tr>
						<tr>
							<td width=100px>
							<?php
							for ($i=0;$i<=3;$i++)
							{ ?>
								<img src='images/bintang.png' width=15 height=15>
							<?php } 
							for ($i=0;$i<=0;$i++)
							{ ?>
								<img src='images/bintang01.png' width=15 height=15>
							<?php } ?>
							</td>
							<td style="font-family:arial;font-size:12px">
							<?php
							$tampil=mysql_query("select count(kd_plgn) from tb_ulasan where kd_produk='$kd_produk' and nilai='4'");
							$baris=mysql_fetch_array($tampil);
							$jumlah=$baris['count(kd_plgn)'];
							echo $jumlah." ulasan";
							?>
							</td>
						</tr>
						<tr>
							<td width=100px>
							<?php
							for ($i=0;$i<=4;$i++)
							{ ?>
								<img src='images/bintang.png' width=15 height=15>
							<?php } ?>
							</td>
							<td style="font-family:arial;font-size:12px">
							<?php
							$tampil=mysql_query("select count(kd_plgn) from tb_ulasan where kd_produk='$kd_produk' and nilai='5'");
							$baris=mysql_fetch_array($tampil);
							$jumlah=$baris['count(kd_plgn)'];
							echo $jumlah." ulasan";
							?>
							</td>
						</tr>
						</table>
						</td>
						<?php }
						else
						{ ?>
							<td style="font-family:arial;font-size:12px" align=center>Tidak ada ulasan</td>
						<?php } ?>
					</tr>
					<?php
					$cari=mysql_query("select* from tb_ulasan where kd_produk='$kd_produk'");
					while ($baris=mysql_fetch_array($cari))
					{
						$kd_plgn=$baris['kd_plgn'];
						$tgl_ulasan=$baris['tgl_ulasan'];
						$nilai=$baris['nilai'];
						$cari00=mysql_query("select* from tb_pelanggan where kd_plgn='$kd_plgn'");
						$baris00=mysql_fetch_array($cari00);
						$nm_plgn=$baris00['nm_plgn'];
						$ulasan=$baris['ulasan'];
						$nilai00=$nilai-1;
						$nilai01=(5-($nilai))-1;
						if ($kd_plgn!="")
						{ ?>
				
							<tr>
								<td style="font-family:arial;font-size:14px;font-weight:bold"><?php echo $nm_plgn." ".$tgl_ulasan;
								for ($i=0;$i<=$nilai00;$i++)
								{ ?>
									<img src='images/bintang.png' width=15 height=15>
								<?php } 
								for ($i=0;$i<=$nilai01;$i++)
								{ ?>
									<img src='images/bintang01.png' width=15 height=15>
								<?php } ?>
								</td>
							</tr>
							<tr>
								<td><textarea rows=4 style="resize:none;width:100%;font-family:arial;font-size:14px" readonly><?php echo $ulasan;?></textarea></td>
							</tr>
						<?php } 
						else
						{ ?>
							<tr>
								<td align=center>Tidak ada ulasan</td>
							</tr>

						<?php }
					} ?>
					</table>
					</td>
				</tr>	
				</table>
				</form>
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
	</td>
</tr>
</table>
</body>
</html>