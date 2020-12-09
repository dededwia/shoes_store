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
$kurir=$_POST['kurir'];
$no_transaksi=$_POST['no_transaksi'];
$nm_pemegang_kartu=$_POST['nm_pemegang_kartu'];
$kd_jns_pembayaran=$_POST['kd_jns_pembayaran'];
$cari00=mysql_query("select* from tb_jns_pembayaran where kd_jns_pembayaran='$kd_jns_pembayaran'");
$baris00=mysql_fetch_array($cari00);
$nm_jns_pembayaran=$baris00['nm_jns_pembayaran'];

$bank=$_POST['bank'];
$no_rekening=$_POST['no_rekening'];
$no_kartu=$_POST['no_kartu'];

$kota=$_POST['kota'];

$nm_plgn=$_POST['nm_plgn'];
$alamat00=$_POST['alamat'];
$no_telp=$_POST['no_telp'];
$cari01=mysql_query("select* from tb_bank where kd_bank='$bank'");
$baris01=mysql_fetch_array($cari01);
$nm_bank=$baris01['nm_bank'];

$cari02=mysql_query("select* from tb_kurir where kd_kurir='$kurir'");
$baris02=mysql_fetch_array($cari02);
$nm_kurir=$baris02['nm_kurir'];

$cari03=mysql_query("select sum(jumlah),sum(total_berat),sum(total_harga) from tb_detail where no_transaksi='$no_transaksi'");
$baris03=mysql_fetch_array($cari03);
$total_beli=$baris03['sum(jumlah)'];
$total_berat=$baris03['sum(total_berat)'];
$total_berat1=$total_berat/1000;
$total_harga=$baris03['sum(total_harga)'];

$tampil00=mysql_query("select* from tb_ongkir where kd_ongkir='$kota'");
$baris00=mysql_fetch_array($tampil00);
$nm_kota=$baris00['nm_kota'];
$ongkir=$baris00['ongkir'];

if ($total_berat>4000)
{
	$ongkir00=$ongkir*5;
	$ongkir01=number_format($ongkir00);
	$ongkir02=str_replace(",", ".","$ongkir01");
}
elseif ($total_berat>3000)
{
	$ongkir00=$ongkir*4;
	$ongkir01=number_format($ongkir00);
	$ongkir02=str_replace(",", ".","$ongkir01");
}
elseif ($total_berat>2000)
{
	$ongkir00=$ongkir*3;
	$ongkir01=number_format($ongkir00);
	$ongkir02=str_replace(",", ".","$ongkir01");
}
elseif ($total_berat>1000)
{
	$ongkir00=$ongkir*2;
	$ongkir01=number_format($ongkir00);
	$ongkir02=str_replace(",", ".","$ongkir01");
}
else
{
	$ongkir00=$ongkir*1;
	$ongkir01=number_format($ongkir00);
	$ongkir02=str_replace(",", ".","$ongkir01");
}
$total_bayar=$total_harga+$ongkir00;
$cari01=mysql_query("select sum(jumlah),sum(total_harga) from tb_detail where no_transaksi='$no_transaksi'");
$baris01=mysql_fetch_array($cari01);
$total_beli01=$baris01['sum(jumlah)'];
$total_bayar01=$baris01['sum(total_harga)']+$ongkir00;
$total_bayar02=number_format($total_bayar01);
$total_bayar03=str_replace(",", ".","$total_bayar02");
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
			<td width=100 style="font-family:arial;font-size:12px;color:white">Selamat Datang<br><br><?php echo $username;?></td><td><input type="image" src="images/login.png" onclick="x()" align=right width=60 height=60></td><td width=100 style="font-family:arial;font-size:12px;color:white" align=right>Keranjang Belanja<br><button style="border:none;border-radius:25px;background:white;color:red" disabled><?php echo $total_beli01;?></button><br><?php echo "IDR. ".$total_bayar03;?></td><td align=right><input type="image" src="images/keranjang01.png" onclick="window.location.href='index.php?p=keranjang&id=<?php echo $id;?>'" width=60 height=60></td>
		<?php }
		else
		{ ?>
			<td width=100 style="font-family:arial;font-size:12px;color:white">Selamat Datang<br><br><?php echo $username;?></td><td><input type="image" src="images/login.png" onclick="x()" align=right width=60 height=60></td><td width=100 style="font-family:arial;font-size:12px;color:white" align=right>Keranjang Belanja<br><button style="border:none;border-radius:25px;background:white;color:red" disabled>0</button><br><?php echo "IDR. ".$total_bayar03;?></td><td align=right><input type="image" src="images/keranjang.png" onclick="window.location.href='index.php?p=keranjang&id=<?php echo $id;?>'" width=60 height=60></td>
		<?php } ?>
	</tr>
	</table>
	</td>	

<?php } ?>
</table>
<br><br><br>

<table align=center cellpadding=70 width=100%>
<tr>
	<td>
	<table border=0 bgcolor=white style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" align=center width=100%>
	<tr>
		<td width=100% align=center>
		<form action="simpan_data.php?id=<?php echo $id;?>" method="post">
		<table border=0 cellpadding=10 bgcolor=white width=100%>
		<tr>
			<td>
			<?php
			$id=$_GET['id'];
			?>
			
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<input type="hidden" name="no_transaksi" value="<?php echo $no_transaksi;?>">
			<input type="hidden" name="tgl_transaksi" value="<?php echo $d;?>">
			<input type="hidden" name="kd_jns_pembayaran" value="<?php echo $kd_jns_pembayaran;?>">
			<input type="hidden" name="nm_pemegang_kartu" value="<?php echo $nm_pemegang_kartu;?>">
			<input type="hidden" name="bank" value="<?php echo $bank;?>">
			<input type="hidden" name="no_kartu" value="<?php echo $no_kartu;?>">
			<input type="hidden" name="no_rekening" value="<?php echo $no_rekening;?>">
			<input type="hidden" name="masa_berlaku_kartu" value="<?php echo $masa_berlaku_kartu;?>">
			<input type="hidden" name="total_harga" value="<?php echo $total_harga;?>">
			<input type="hidden" name="total_beli" value="<?php echo $total_beli;?>">
			<input type="hidden" name="total_berat" value="<?php echo $total_berat;?>">
			<input type="hidden" name="total_bayar" value="<?php echo $total_bayar;?>">		
			<input type="hidden" name="kurir" value="<?php echo $kurir;?>">
			<input type="hidden" name="kota" value="<?php echo $kota;?>">
			<input type="hidden" name="ongkir00" value="<?php echo $ongkir00;?>">
			<input type="hidden" name="nm_plgn" value="<?php echo $nm_plgn;?>">
			<input type="hidden" name="alamat" value="<?php echo $alamat00;?>">
			<input type="hidden" name="no_telp" value="<?php echo $no_telp;?>">

			<table border=1 style="border-color:white;border-collapse:collapse" width=100% cellpadding=30>
			<tr>
				<td colspan=2 align=center style="font-size:18px;font-family:arial;font-weight:bold" valign=top><img src="images/logo.png" width=150 height=70></td>
			</tr>
			<tr>
				<td colspan=2>
				<table border=0 width=100% align=center>
				<tr>
					<td>
					<table border=1 style="border-collapse:collapse" width=100% align=center cellpadding=10>
					<tr>
						<td colspan=2>
						<table width=100% align=center>
						<tr>
							<td style="font-family:arial;font-size:14px;width:100px;font-weight:bold">Tanggal : <?php echo $d;?></td><td style="font-family:arial;font-size:14px;width:100px;font-weight:bold" align=right>Invoice #<?php echo $no_transaksi;?></th>
						</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td valign=top>
						<table border=0 width=100% align=center cellpadding=10>
						<tr>
							<td style="font-family:arial;font-size:14px;width:100px">Nama Lengkap</td><td style="font-family:arial;font-size:14px;width:500px" valign=top><?php echo $nm_plgn;?></td>
						</tr>
						<tr>
							<td style="font-family:arial;font-size:14px" valign=top>Alamat</td><td style="font-family:arial;font-size:14px" valign=top><?php echo $alamat00;?></td>
						</tr>
						<tr>
							<td style="font-family:arial;font-size:14px">No. Telp.</td><td style="font-family:arial;font-size:14px" valign=top><?php echo $no_telp;?></td>
						</tr>
						</table>
						</td>
						<td valign=top>
						<?php 
						if ($kd_jns_pembayaran=="BT")
						{ ?>
							<table border=0 width=100% align=center cellpadding=10>
							<tr>
								<td style="font-family:arial;font-size:14px;width:100px">Metode Pembayaran</td><td style="font-family:arial;font-size:14px;width:500px" valign=top><?php echo $nm_jns_pembayaran;?></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:14px" valign=top>Bank</td><td style="font-family:arial;font-size:14px" valign=top><?php echo $nm_bank;?></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:14px">No. Rekening</td><td style="font-family:arial;font-size:14px" valign=top><?php echo $no_rekening;?></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:14px">Jasa Pengiriman</td><td style="font-family:arial;font-size:14px" valign=top><?php echo $nm_kurir;?></td>
							</tr>
							</table>
						<?php } 
						else
						{ ?>
							<table border=0 width=100% align=center cellpadding=10>
							<tr>
								<td style="font-family:arial;font-size:14px;width:100px" valign=top>Metode Pembayaran</td><td style="font-family:arial;font-size:14px;width:500px" valign=top><?php echo $nm_jns_pembayaran;?></td>
							</tr>
							</table>
						<?php } ?>
						</td>
					</tr>
					<tr>
						<td width=100% align=center colspan=2>
						<table border=1 style="border-collapse:collapse;border-style:solid" width=100% cellpadding=10>
						<tr>
							<th style="font-family:arial;font-size:14px;background:white;color:black">Nama Produk</th>
							<th style="font-family:arial;font-size:14px;background:white;color:black">Jumlah</th>
							<th style="font-family:arial;font-size:14px;background:white;color:black">Harga</th>
							<th style="font-family:arial;font-size:14px;background:white;color:black">Total</th>
						</tr>
						<?php
						$tampil01=mysql_query("select* from tb_detail where no_transaksi='$no_transaksi'");
						while ($baris01=mysql_fetch_array($tampil01))
						{ 
							$kd_produk=$baris01['kd_produk'];
							$harga=$baris01['harga'];
							$harga01=number_format($harga);
							$harga02=str_replace(",", ".","$harga01");
							$tampil02=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
							$baris02=mysql_fetch_array($tampil02);
							$nm_produk=$baris02['nm_produk'];
							$gambar=$baris02['gambar'];
							$satuan=$baris02['satuan'];
							$jumlah=$baris01['jumlah'];
							$total_harga00=$baris01['total_harga'];
							$total_harga01=number_format($total_harga00);
							$total_harga02=str_replace(",", ".","$total_harga01");
							
							?>
							<input type="hidden" name="total_bayar" value="<?php echo $total_bayar;?>">
							<tr>
								<td style="font-family:arial;font-size:14px"><img src="images/<?php echo $gambar;?>" width=50 height=50><?php echo $nm_produk;?></td>
								<td style="font-family:arial;font-size:14px" align=right><?php echo $jumlah." ".$satuan;?></td>
								<td style="font-family:arial;font-size:14px" align=right><?php echo "IDR ".$harga02;?></td>
								<td style="font-family:arial;font-size:14px" align=right><?php echo "IDR ".$total_harga02;?></td>
							</tr>
						<?php } ?>
						</table>
						</td>
					</tr>
					<tr>
						<td colspan=2 valign=top>
						<table border=0 width=100% align=center cellpadding=10>
						<tr>	
							<td width=800></td><td style="font-family:arial;font-size:14px">Total Berat</td><td style="font-family:arial;font-size:14px" align=right><?php echo $total_berat1." ".Kg;?></td>
						</tr>
						<?php 
						if ($kd_jns_pembayaran=="BT")
						{ ?>
						<tr>	
							<td width=800></td><td style="font-family:arial;font-size:14px">Ongkir</td><td style="font-family:arial;font-size:14px" align=right><?php echo "IDR ".$ongkir02;?></td>
						</tr>
						<?php }
						else
						{ ?>
						<tr>	
							<td width=800></td><td style="font-family:arial;font-size:14px">Ongkir</td><td style="font-family:arial;font-size:14px" align=right>FREE</td>
						</tr>		
						<?php } ?>
						<tr>
							<td width=800><td style="font-family:arial;font-size:14px">Jumlah item</td><td style="font-family:arial;font-size:14px" align=right><?php echo $total_beli;?></td>
						</tr>
						<tr>
							<td width=800><td style="font-family:arial;font-size:14px">Total Bayar</td><td style="font-family:arial;font-size:14px" align=right><?php echo "IDR ".$total_bayar03;?></td>
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
		<tr>
			<td align=right><input type="submit" class="tombol04" onclick="return confirm('Apakah anda setuju untuk melanjutkan transaksi ini?')" value="Selesai"></td>
		</tr>	
		</table>
		</form>
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>
</body>
</html>