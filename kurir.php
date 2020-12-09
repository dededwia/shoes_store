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
$no_transaksi=$_POST['no_transaksi'];
$nm_pemegang_kartu=$_POST['nm_pemegang_kartu'];
$kd_jns_pembayaran=$_POST['kd_jns_pembayaran'];
$bank=$_POST['bank'];
$no_rekening=$_POST['no_rekening'];
$no_kartu=$_POST['no_kartu'];
$masa_berlaku_kartu=$_POST['masa_berlaku_kartu'];
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
<br><br><br><br><br><br>
<table align=center cellpadding=70 width=100%>
<tr>
	<td>
	<table border=0 bgcolor=white style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" align=center width=100%>
	<tr>
		<td bgcolor=white width=100% align=center>
		<table width=100%>
		<tr>
			<td align=center>
			<table align=center width=100% align=center>
			<tr>
				<td style="color:white">
				<table cellpadding=10 bgcolor=white width=100%>
				<tr>
					<td>
					<form action="index.php?p=pelanggan&id=<?php echo $id;?>" method="post">
					<input type="hidden" name="id" value="<?php echo $id;?>">
					<input type="hidden" name="no_transaksi" value="<?php echo $no_transaksi;?>">
					<input type="hidden" name="kd_jns_pembayaran" value="<?php echo $kd_jns_pembayaran;?>">
					<input type="hidden" name="nm_pemegang_kartu" value="<?php echo $nm_pemegang_kartu;?>">
					<input type="hidden" name="masa_berlaku_kartu" value="<?php echo $masa_berlaku_kartu;?>">
					<input type="hidden" name="bank" value="<?php echo $bank;?>">
					<input type="hidden" name="no_kartu" value="<?php echo $no_kartu;?>">
					<input type="hidden" name="no_rekening" value="<?php echo $no_rekening;?>">
					<table border=1 style="border-color:white;border-collapse:collapse" width=100% cellpadding=30>
					<tr>
						<td colspan=2 align=center valign=top>
						<font style="font-family:arial;font-size:14px;color:#727376">Pilih Kurir</font><br><br>
						<select name="x" style="width:200px;height:30px" required>
						<option value="" style="color:#ccc">--Pilih (Wajib dipilih)--</option>
						<optgroup>
						<?php 
						$tampil=mysql_query("select* from tb_kurir where not kd_kurir='-'");
						while ($baris=mysql_fetch_array($tampil))
						{ 
							$kd_kurir=$baris['kd_kurir'];
							$nm_kurir=$baris['nm_kurir'];?>
							<option value="<?php echo $kd_kurir;?>"><?php echo $nm_kurir;?></option>		
						<?php } ?>
						</optgroup>
						</select>
						<input type="submit" class="tombol04" value="Pilih Kurir">
						</td>
					</tr>
					</form>
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
	</table>
	</td>
</tr>
</table>
</body>
</html>