<html>
<head>
</head>
<body>
<?php 
error_reporting(0);
include "koneksi.php";
$id=$_GET['id'];
$username=$_GET['username'];
$pass00=$_GET['pass00'];
$pass01=$_GET['pass01'];
$email=$_GET['email'];?>
<table border=0 align=center class="c" bgcolor=transparent width=100% cellpadding=0>
<tr>
	<td align=right><input type="image" onclick="window.location.href='index.php?p=home'" src="images/home.png" width=50 height=50></td>
</tr>
</table>
<table border=0 align=center bgcolor=orange width=100% style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" cellpadding=0 class="b">
<tr>
	<td><img src="images/logo.png" width=200 height=100px></td>			
</tr>
</table>
<br><br><br>
<table border=0 align=center width=100% cellpadding=70>
<tr>
	<td>
	<table border=0 style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" bgcolor=white align=center width=100% cellpadding=10>
	<tr>
		<td valign=top bgcolor=white>
		<form action="simpan.php" method="post">
		<table width=400 cellpadding=10 align=center>
		<tr>
			<td style="font-family:arial;font-size:24px;height:60px;color:#727376" align=center>Ketentuan Pembelian</td>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:14px;height:60px;color:#727376">1. Untuk melakukan pembelian, pengguna diharuskan untuk login terlebih dahulu.</td>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:14px;height:60px;color:#727376">2. Jika belum memiliki akun login, pengguna diharuskan untuk <a class="ubahwarnalink" href="index.php?p=daftar">mendaftar</a> terlebih dahulu.</td>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:14px;height:60px;color:#727376">3. Memilih jenis pembayaran yang diingini.(COD atau Bank Transfer)</td>
		</tr>	
		<tr>
			<td style="font-family:arial;font-size:14px;height:60px;color:#727376">4. Memilih jenis kurir pengiriman yang diingini (khusus jenis pembayaran melalui bank transfer).</td>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:14px;height:60px;color:#727376">5. Mengisi data pelanggan (khusus jenis pembayaran melalui Bank Transfer).</td>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:24px;height:60px;color:#727376" align=center>Ketentuan Pembayaran</td>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:14px;height:60px;color:#727376">1. Pelanggan diharuskan untuk mengupload bukti pembayaran melalui halaman 
			<?php 
			if ($id!="")
			{ ?>
				<a class="ubahwarnalink" href="index.php?p=konfirmasi_pembayaran">konfirmasi pembayaran</a>.</td>
			<?php } 
			else
			{ ?>
				<a class="ubahwarnalink" onclick="alert('Silahkan untuk melakukan login terlebih dahulu')" href="index.php?p=login">konfirmasi pembayaran</a>.</td>
			<?php } ?>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:14px;height:60px;color:#727376">2. Menunggu proses verifikasi bukti pembayaran yang telah diupload.</td>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:14px;height:60px;color:#727376">3. Setelah proses verifikasi selesai, barang akan segera dikirimkan kepada pelanggan.</td>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:24px;height:60px;color:#727376" align=center>Ketentuan Pengembalian Produk</td>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:14px;height:60px;color:#727376">1. Pelanggan diharuskan untuk mengisi form pengembalian produk melalui halaman 
			<?php 
			if ($id!="")
			{ ?>
				<a class="ubahwarnalink" href="index.php?p=pengembalian_produk">Pengembalian Produk</a>.</td>
			<?php } 
			else
			{ ?>
				<a class="ubahwarnalink" onclick="alert('Silahkan untuk melakukan login terlebih dahulu')" href="index.php?p=login">Pengembalian Produk</a>.</td>
			<?php } ?>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:14px;height:60px;color:#727376">2. Memilih jenis pengembalian produk (Refund atau Tukar barang).</td>
		</tr>
		<tr>
			<td style="font-family:arial;font-size:14px;height:60px;color:#727376">3. Pengembalian produk hanya diperuntukkan bagi pembeli yang memilih jenis pembayaran Bank Transfer.</td>
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