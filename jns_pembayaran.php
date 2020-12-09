<html>
<head>
</head>
<body>
<script>
function angka(event)
{
	var charcode=(event.which)?event.which:event.keycode
	if (charcode>31 && (charcode<48 || charcode>57))
	return false;return true;
}
</script>
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
	<table border=0 style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" align=center width=100%>
	<tr>
		<td bgcolor=white width=100% align=center>
		<table border=0 width=100%>
		<tr>
			<td align=center>
			<table align=center width=100% align=center>
			<tr>
				<td style="color:white">

			<table border=0 cellpadding=10 bgcolor=white width=100%>

		<tr>
			<td>
			<?php
			$jns_pembayaran=$_POST['jns_pembayaran'];
			$tampil00=mysql_query("select* from tb_jns_pembayaran where kd_jns_pembayaran='$jns_pembayaran'");
			$baris00=mysql_fetch_array($tampil00);
			$kd_jns_pembayaran00=$baris00['kd_jns_pembayaran'];
			$nm_jns_pembayaran00=$baris00['nm_jns_pembayaran'];
			?>
			<form method="post">
			<input type="hidden" name="no_transaksi" value="<?php echo $no_transaksi;?>">
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<input type="hidden" name="kd_jns_pembayaran" value="<?php echo $jns_pembayaran;?>">
			<table border=1 style="border-collapse:collapse" width=100% cellpadding=30>
			<tr>
				<td colspan=2 align=center valign=top>
				<font style="font-family:arial;font-size:14px;color:#727376">Pilih Jenis Pembayaran</font><br><br>
				<select name="jns_pembayaran" style="width:200px;height:30px">
				<?php
				if (!empty($jns_pembayaran))
				{ ?>
					<option value="<?php echo $kd_jns_pembayaran00;?>"><?php echo $nm_jns_pembayaran00;?></option>
				<?php }
				else
				{ ?>
					<option value="" style="color:#ccc">--Pilih (Wajib dipilih)--</option>
				<?php } ?>
				<optgroup>
				<?php 
				$tampil=mysql_query("select* from tb_jns_pembayaran");
				while ($baris=mysql_fetch_array($tampil))
				{ 
					$kd_jns_pembayaran=$baris['kd_jns_pembayaran'];
					$nm_jns_pembayaran=$baris['nm_jns_pembayaran'];?>
					<option value="<?php echo $kd_jns_pembayaran;?>"><?php echo $nm_jns_pembayaran;?></option>	
				
				<?php } ?>
				</optgroup>
				</select>
				<input type="submit" class="tombol04" value="Proses">
				</td>
			</tr>
			</form>
			<?php
			$jns_pembayaran=$_POST['jns_pembayaran'];
			?>
			<tr>
				<td align=center>
				<table border=0 align=center width=100% cellpadding=5>
				<?php
				
					if (!empty($jns_pembayaran))
					{	
						if ($jns_pembayaran=="BT")
						{ 
							?>	
							<form action="index.php?p=kurir&id=<?php echo $id;?>" method="post">
							<input type="hidden" name="no_transaksi" value="<?php echo $no_transaksi;?>">
							<input type="hidden" name="id" value="<?php echo $id;?>">
							<input type="hidden" name="kd_jns_pembayaran" value="<?php echo $jns_pembayaran;?>">
							<input type="hidden" name="total_beli" value="<?php echo $total_beli;?>">
							<input type="hidden" name="total_harga" value="<?php echo $total_harga;?>">
							<input type="hidden" name="total_berat" value="<?php echo $total_berat;?>">
							<tr>
								<td style="font-family:arial;font-size:14px;color:#727376">Nama Lengkap <font style="font-size:12px;color:red"><i></i></font></td><td><input type="text" style="padding-left:10px" name="nm_pemegang_kartu" placeholder="Wajib diisi" autofocus required></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:14px;color:#727376">Bank</td>
								<td>
								<select name="bank" style="width:100%;height:30px" required>
								<option value="" style="color:#ccc">--Pilih (Wajib dipilih)--</option>
								<optgroup>
								<?php 
								$tampil=mysql_query("select* from tb_bank");
								while ($baris=mysql_fetch_array($tampil))
								{ 
									$kd_bank=$baris['kd_bank'];
									$nm_bank=$baris['nm_bank'];?>
									<option value="<?php echo $kd_bank;?>"><?php echo $nm_bank;?></option>		
								<?php } ?>
								</optgroup>
								</select>
								</td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:14px;color:#727376">No. Rekening</td><td><input type="text" onkeypress="return angka(event)" style="padding-left:10px" placeholder="Wajib diisi" name="no_rekening" required></td>
							</tr>	
							<tr>
								<td colspan=2 align=right><input type="submit" name="a" class="tombol04" value="Lanjut"></td>
							</tr>	
							</form>
							
						<?php } 
						else
						{ ?>
							<form action="index.php?p=pelanggan&id=<?php echo $id;?>" method="post">
							<input type="hidden" name="no_transaksi" value="<?php echo $no_transaksi;?>">
							<input type="hidden" name="id" value="<?php echo $id;?>">
							<input type="hidden" name="kd_jns_pembayaran" value="<?php echo $jns_pembayaran;?>">
							<input type="hidden" name="total_beli" value="<?php echo $total_beli;?>">
							<input type="hidden" name="total_harga" value="<?php echo $total_harga;?>">
							<input type="hidden" name="total_berat" value="<?php echo $total_berat;?>">
							<tr>
								<td colspan=2 style="font-family:arial;font-size:12px;color:#727376" align=center>*COD hanya khusus wilayah JABODETABEK</td>
							</tr>
							<tr>
								<td colspan=2 align=center><input type="submit" name="b" class="tombol00" value="Lanjut"></td>
							</tr>
							</form>	
						<?php }
					}
					else
					{ ?>
						
					<?php }

					?>
		
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
	</td>
</tr>
</table>
</body>
</html>