<html>
<head>
<meta name="viewport" content="width=device-width; initial-scale=0.38; maximum-scale=1.0;">
<link rel="stylesheet" type="text/css" href="theme.css">
<link rel="stylesheet" type="text/css" href="topnav.css">
<style>
.b
{
	top:0;
	width:100%;
	position:fixed;
	box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}
.c
{
	position:fixed;
	top:600;
	left:-10;
}
</style>
<title>
Penjualan Kamera
</title>
</head>
<body style="background:gray" align=center>
<?php
error_reporting(0);
$id=$_GET['id'];
$p=$_GET['p'];
if (!empty($p))
{
	if ($p=="login")
	{
		include "login.php";
	}
	elseif ($p=="home")
	{
		include "home.php";
	}
	elseif ($p=="daftar")
	{
		include "daftar.php";
	}
	elseif ($p=="ganti_pass")
	{
		include "ganti_pass.php";
	}
	elseif ($p=="lupa_pass")
	{
		include "lupa_pass.php";
	}
	elseif ($p=="konten")
	{
		include "konten.php";
	}
	elseif ($p=="detail")
	{
		include "detail.php";
	}
	elseif ($p=="keranjang")
	{
		include "keranjang.php";
	}
	elseif ($p=="jns_pembayaran")
	{
		include "jns_pembayaran.php";
	}
	elseif ($p=="kurir")
	{
		include "kurir.php";
	}
	elseif ($p=="pelanggan")
	{
		include "pelanggan.php";
	}
	elseif ($p=="detail_pembelian")
	{
		include "detail_pembelian.php";
	}
	elseif ($p=="invoice")
	{
		include "invoice.php";
	}
	elseif ($p=="invoice01")
	{
		include "invoice01.php";
	}
	elseif ($p=="konfirmasi_pembayaran")
	{
		include "konfirmasi_pembayaran.php";
	}
	elseif ($p=="pembatalan_transaksi")
	{
		include "pembatalan_transaksi.php";
	}
	elseif ($p=="pengembalian_produk")
	{
		include "pengembalian_produk.php";
	}
	elseif ($p=="cek_status_pengiriman")
	{
		include "cek_status_pengiriman.php";
	}
	elseif ($p=="ulasan")
	{
		include "ulasan.php";
	}
	elseif ($p=="panduan")
	{
		include "panduan.php";
	}
	elseif ($p=="form_retur")
	{
		include "form_retur.php";
	}
	elseif ($p=="form_retur00")
	{
		include "form_retur00.php";
	}
	else
	{ ?>
		<table align=center width=100% cellpadding=30>
		<tr>
			<td style="font-family:arial;font-size:14px;font-weight:bold">Maaf, halaman tidak tersedia</td>
		</tr>
		</table>	
	<?php }
}
else
{
	include "home.php";
} 
if ($p!="daftar" and $p!="lupa_pass" and $p!="invoice" and $p!="invoice01" and $p!="form_retur" and $p!="form_retur00" and $p!="ulasan")
{ ?>

<div class="b">
<div class="topnav" id="myTopnav">
	<a href="index.php?p=home&id=<?php echo $id;?>">&nbsp;&nbsp;Home</a>
  	<div class="dropdown">
    		<button class="dropbtn">Kategori <i class="fa fa-caret-down"></i></button>
    	<div class="dropdown-content">
<form method="post">
<?php
$tampil=mysql_query("select* from tb_kategori");
while ($baris=mysql_fetch_array($tampil))
{ 
	$kd_kategori=$baris['kd_kategori'];
	$tampil00=mysql_query("select* from tb_kategori where kd_kategori='$kd_kategori'");
	$baris00=mysql_fetch_array($tampil00);
	$nm_kategori=$baris00['nm_kategori'];
	if ($id!="")
	{ ?>
		<a href="index.php?p=konten&id=<?php echo $id;?>&kd_kategori=<?php echo $kd_kategori;?>">&nbsp;&nbsp;<?php echo $nm_kategori;?></a>
	<?php }
	else
	{ ?>
		<a href="index.php?p=konten&kd_kategori=<?php echo $kd_kategori;?>">&nbsp;&nbsp;<?php echo $nm_kategori;?></a>
	<?php }	
} 
if ($id!="")
{?>
	<a href="index.php?p=konten&id=<?php echo $id;?>&kd_kategori=semua_produk">&nbsp;&nbsp;Semua Produk</a>
<?php } 
else
{ ?>
	<a href="index.php?p=konten&kd_kategori=semua_produk">&nbsp;&nbsp;Semua Produk</a>
<?php } ?>

</form>
    	</div>
	</div>
<?php 
if ($id=="")
{ ?>
  	<div class="dropdown">
    		<button class="dropbtn">Bantuan <i class="fa fa-caret-down"></i></button>
    	<div class="dropdown-content">
		<a href="index.php?p=panduan">Panduan Cara Pembelian</a>	
		<a href="#" onclick="alert('Silahkan login terlebih dahulu');window.location.href='index.php?p=login&id=<?php echo $id;?>'">Konfirmasi Pembayaran</a>
		<a href="#" onclick="alert('Silahkan login terlebih dahulu');window.location.href='index.php?p=login&id=<?php echo $id;?>'">Pembatalan Transaksi</a>
		<a href="#" onclick="alert('Silahkan login terlebih dahulu');window.location.href='index.php?p=login&id=<?php echo $id;?>'">Pengembalian Produk</a>
    	</div>
	</div>
	<a href="index.php?p=login">Login</a>
	<a href="index.php?p=daftar">Daftar</a>		
<?php }
else
{ ?>
  	<div class="dropdown">
    		<button class="dropbtn">Bantuan <i class="fa fa-caret-down"></i></button>
    	<div class="dropdown-content">	
		<a href="index.php?p=panduan&id=<?php echo $id;?>">Panduan Cara Pembelian</a>			
		<a href="index.php?p=konfirmasi_pembayaran&id=<?php echo $id;?>">Konfirmasi Pembayaran</a>
		<a href="index.php?p=pembatalan_transaksi&id=<?php echo $id;?>">Pembatalan Transaksi</a>
		<a href="index.php?p=pengembalian_produk&id=<?php echo $id;?>">Pengembalian Produk</a>
		<a href="index.php?p=cek_status_pengiriman&id=<?php echo $id;?>">Cek Status Pengiriman</a>
		<a href="index.php?p=ganti_pass&id=<?php echo $id;?>">Ganti Password</a>	
    	</div>
	</div>
	<a style="cursor:pointer" onclick="x()">&nbsp;&nbsp;Logout</a>
<?php }?>			

<table border=0 align=center style="background:red" width=100% style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" cellpadding=0>
<?php 
if ($id=="")
{ ?>
	<td><img src="images/logo.png" width=200 height=100></td>
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
		<td width=100 style="font-family:arial;font-size:12px;color:white">Selamat Datang</td><td><input type="image" src="images/login.png" onclick="window.location.href='index.php?p=login'" align=right width=60 height=60></td><td  width=100 style="font-family:arial;font-size:12px;color:white" align=right>Keranjang Belanja</td><td align=right><input type="image" src="images/keranjang.png" onclick="alert('Maaf, anda tidak bisa melihat keranjang belanja, silahkan untuk melakukan login');window.location.href='index.php?p=login'" width=60 height=60></td>
	</tr>
	</table>
	</td>			
</tr>
<?php }
else
{ ?>
	<td><img src="images/logo.png" width=200 height=100></td>
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
			<td width=100 style="font-family:arial;font-size:12px;color:white">Selamat Datang<br><br><?php echo $username;?></td><td><input type="image" src="images/login.png" onclick="x()" align=right width=60 height=60></td><td width=100 style="font-family:arial;font-size:12px;color:white" align=right>Keranjang Belanja<br><button style="border:none;border-radius:25px;background:white;color:orange" disabled><?php echo $total_beli01;?></button><br><?php echo "IDR. ".$total_bayar01;?></td><td align=right><input type="image" src="images/keranjang01.png" onclick="window.location.href='index.php?p=keranjang&id=<?php echo $id;?>'" width=60 height=60></td>
		<?php }
		else
		{ ?>
			<td width=100 style="font-family:arial;font-size:12px;color:white">Selamat Datang<br><br><?php echo $username;?></td><td><input type="image" src="images/login.png" onclick="x()" align=right width=60 height=60></td><td width=100 style="font-family:arial;font-size:12px;color:white" align=right>Keranjang Belanja<br><button style="border:none;border-radius:25px;background:white;color:orange" disabled>0</button><br><?php echo "IDR. ".number_format($total_bayar01);?></td><td align=right><input type="image" src="images/keranjang.png" onclick="window.location.href='index.php?p=keranjang&id=<?php echo $id;?>'" width=60 height=60></td>
		<?php } ?>
	</tr>
	</table>
	</td>	

<?php } ?>
</table>
</div>	
</div>	
<script>
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
<?php } 
elseif ($p=="daftar" and $p=="lupa_pass")
{ ?>
<table border=0 align=center style="background:red" width=100% style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" cellpadding=0 class="b">
<tr>
	<td><img src="images/logo.png" width=200 height=100px></td>
</tr>
</table>

<?php } 
else
{}?>

<table border=0 align=center width=100%>
<tr>
	<td colspan=2 align=center style="font-size:14px;color:gray" align=center>&copy 2018 Penjualan Kamera. All right reserved</td>
</tr>
</table>
</body>
</html>



