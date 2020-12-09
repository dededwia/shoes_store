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
<br><br><br>
<table border=0 align=center width=100% cellpadding=70>
<tr>
	<td>
	<table border=0 bgcolor=white style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);" align=center width=100% cellpadding=20>
	<tr>
		<td colspan=2 style="font-size:18px;font-family:arial;font-weight:bold" valign=top><img src="images/logo.png" width=150 height=70></td>
	</tr>
	<tr>
		<td valign=top bgcolor=white>
		<form action="simpan_pass.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<table width=400 cellpadding=10 align=center>
		<tr>
			<td style="font-family:arial;font-size:24px;height:60px;color:#727376" align=center>Ganti Password</td>
		</tr>
		<tr>
			<td align=center><input class="icon_username" type="text" name="username" placeholder="Username" value="<?php echo $username;?>" readonly></td>
		</tr>
		<tr>
			<td align=center><input class="icon_password" type="password" name="pass00" placeholder="Password Lama"  required autofocus></td>
		</tr>
		<tr>
			<td align=center><input class="icon_password" type="password" name="pass01" placeholder="Password Baru"  Password" required></td>
		</tr>
		<tr>
			<td colspan=2>
			<table width=100% align=center>
			<tr>
				<td align=center><input class="tombol00" type="submit" value="Lanjut"></td>
			</tr>
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

</body>