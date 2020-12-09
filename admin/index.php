<html>
<head>
<meta name="viewport" content="width=device-width; initial-scale=0.38; maximum-scale=1.0;">
<link rel="stylesheet" type="text/css" href="theme.css">
<title>
Penjualan Kamera
</title>
</head>
<body style="background:gray" align=center>
<br><br>
<table border=0 bgcolor=red align=center width=100%>
<tr>
	<td><img src="../images/logo.png" width=200 height=100px></td>
</tr>
</table>
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
	elseif ($p=="pelanggan")
	{
		include "pelanggan.php";
	}
	elseif ($p=="hapus_pelanggan")
	{
		include "hapus_pelanggan.php";
	}
	elseif ($p=="kategori")
	{
		include "kategori.php";
	}
	elseif ($p=="edit_kategori")
	{
		include "edit_kategori.php";
	}
	elseif ($p=="tambah_kategori")
	{
		include "tambah_kategori.php";
	}
	elseif ($p=="produk")
	{
		include "produk.php";
	}
	elseif ($p=="edit_produk")
	{
		include "edit_produk.php";
	}
	elseif ($p=="tambah_produk")
	{
		include "tambah_produk.php";
	}
	elseif ($p=="kurir")
	{
		include "kurir.php";
	}
	elseif ($p=="edit_kurir")
	{
		include "edit_kurir.php";
	}
	elseif ($p=="tambah_kurir")
	{
		include "tambah_kurir.php";
	}
	elseif ($p=="bank")
	{
		include "bank.php";
	}
	elseif ($p=="edit_bank")
	{
		include "edit_bank.php";
	}
	elseif ($p=="tambah_bank")
	{
		include "tambah_bank.php";
	}
	elseif ($p=="transaksi")
	{
		include "transaksi.php";
	}
	elseif ($p=="pembayaran")
	{
		include "pembayaran.php";
	}
	elseif ($p=="edit_pembayaran")
	{
		include "edit_pembayaran.php";
	}
	elseif ($p=="pengiriman")
	{
		include "pengiriman.php";
	}
	elseif ($p=="edit_pengiriman")
	{
		include "edit_pengiriman.php";
	}
	elseif ($p=="pengembalian_produk")
	{
		include "pengembalian_produk.php";
	}
	elseif ($p=="edit_pengembalian_produk")
	{
		include "edit_pengembalian_produk.php";
	}
	elseif ($p=="ongkir")
	{
		include "ongkir.php";
	}
	elseif ($p=="edit_ongkir")
	{
		include "edit_ongkir.php";
	}
	elseif ($p=="tambah_ongkir")
	{
		include "tambah_ongkir.php";
	}
	elseif ($p=="ulasan")
	{
		include "ulasan.php";
	}
	elseif ($p=="logout")
	{
		include "logout.php";
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
if ($p!="detail_transaksi")
{?>
<div class="b">
<div class="topnav" id="myTopnav">
	<a href="index.php?p=home&id=<?php echo $id;?>">&nbsp;&nbsp;Home</a>
  	<div class="dropdown">
    		<button class="dropbtn">Data Master <i class="fa fa-caret-down"></i></button>
    	<div class="dropdown-content">
		<a href="index.php?p=pelanggan&id=<?php echo $id;?>">&nbsp;&nbsp;Pelanggan</a>
		<a href="index.php?p=kategori&id=<?php echo $id;?>">&nbsp;&nbsp;Kategori Produk</a>
		<a href="index.php?p=produk&id=<?php echo $id;?>">&nbsp;&nbsp;Produk</a>
		<a href="index.php?p=kurir&id=<?php echo $id;?>">&nbsp;&nbsp;Kurir</a>			
		<a href="index.php?p=bank&id=<?php echo $id;?>">&nbsp;&nbsp;Bank</a>
    	</div>
	</div>
  	<div class="dropdown">
    		<button class="dropbtn">Data Transaksi <i class="fa fa-caret-down"></i></button>
    	<div class="dropdown-content">
		<a href="index.php?p=transaksi&id=<?php echo $id;?>">&nbsp;&nbsp;Transaksi</a>
		<a href="index.php?p=pembayaran&id=<?php echo $id;?>">&nbsp;&nbsp;Pembayaran</a>
		<a href="index.php?p=pengiriman&id=<?php echo $id;?>">&nbsp;&nbsp;Pengiriman Produk</a>
		<a href="index.php?p=pengembalian_produk&id=<?php echo $id;?>">&nbsp;&nbsp;Pengembalian Produk</a>
		<a href="index.php?p=ongkir&id=<?php echo $id;?>">&nbsp;&nbsp;Ongkir</a>
		<a href="index.php?p=ulasan&id=<?php echo $id;?>">&nbsp;&nbsp;Ulasan</a>
    	</div>
	</div>
	<a onclick="return confirm('Apakah anda ingin keluar dari akun anda?')" href="index.php?p=logout&id=<?php echo $id;?>">&nbsp;Logout</a>
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
else
{}
?>
<table border=0 align=center width=100%>
<tr>
	<td colspan=2 height=70 align=center style="font-size:14px;color:white" align=center>&copy 2018 Penjualan Kamera. All right reserved</td>
</tr>
</table>
</body>
</html>