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
date_default_timezone_set('Asia/Jakarta');
$d=date("d")."-".date("m").date("Y");
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
<script>
function nonaktifkan()
{
 document.onkeydown = function (e)
 {
  return false;
 }
}
function aktifkan()
{
 document.onkeydown = function (e)
 {
  return true;
 }
}
</script>
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
<br><br><br><br><br><br>
<table border=0 align=center width=100% cellpadding=70>
<tr>
	<td>
	<table border=0 style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" bgcolor=white align=center width=100% cellpadding=10>
	<tr>
		<td valign=top bgcolor=white>
		<table border=0 width=100% cellpadding=10 align=center>
		<tr>
			<td colspan=3 style="font-family:arial;font-size:24px;height:60px;color:gray" align=center>Form Pengembalian Produk</td>
		</tr>
		<form name="b" method="post">
		<?php
		$no_transaksi03=$_POST['no_transaksi'];
		?>
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<tr>
			<td style="font-family:arial;font-size:14px;color:gray;width:200px">No. Transaksi</td><td><input type="text" style="padding-left:10px" name="no_transaksi" onclick="aktifkan();" onkeypress="return angka(event)" placeholder="Wajib diisi" value="<?php echo $no_transaksi03;?>" required autofocus></td>
			<td width=100><input type="submit" name="tampil_produk" class="tombol04" value="Tampil Produk"></td>
		</tr>
		</form>
		<tr>
			<td colspan=3>
			<table border=1 style="border-collapse:collapse" width=100% cellpadding=10 align=center>
			<tr>
				<th style="font-family:arial;font-size:12px;background:black;color:white">Nama Produk</th>
				<th style="font-family:arial;font-size:12px;background:black;color:white">Harga</th>
				<th style="font-family:arial;font-size:12px;background:black;color:white">Jumlah</th>
				<th style="font-family:arial;font-size:12px;background:black;color:white">Total Harga</th>
				<th style="font-family:arial;font-size:12px;background:black;color:white">Jumlah Pengembalian Produk</th>
			</tr>	
		<?php
		$tampil_produk=$_POST['tampil_produk'];
		$no_transaksi=$_POST['no_transaksi'];
		$id=$_GET['id'];
		$id00=str_replace(" ", "+", "$id");
		$de_id=decrypt($id00);
		$cari=mysql_query("select* from tb_login where id='$de_id'");
		$baris=mysql_fetch_array($cari);
		$username=$baris['username'];
		$kd_plgn=$baris['kd_plgn'];

$cari=mysql_query("select* from tb_pengembalian_produk where no_transaksi='$no_transaksi'");
$baris=mysql_fetch_array($cari);
$no_transaksi01=$baris['no_transaksi'];


if ($no_transaksi01!=$no_transaksi)
{
		$cari00=mysql_query("select* from tb_login where username='$username'");
		while ($baris00=mysql_fetch_array($cari00))
		{
			$kd_plgn=$baris00['kd_plgn'];
			$cari01=mysql_query("select* from tb_transaksi where kd_plgn='$kd_plgn'");
			$baris01=mysql_fetch_array($cari01);
			$no_transaksi02=$baris01['no_transaksi'];
			if ($no_transaksi02==$no_transaksi)
			{
				$cari02=mysql_query("select* from tb_pengiriman where no_transaksi='$no_transaksi02' and keterangan='Selesai'");
				while ($baris01=mysql_fetch_array($cari02))
				{
					$no_transaksi03=$baris01['no_transaksi'];
					$cari03=mysql_query("select* from tb_pembayaran where no_transaksi='$no_transaksi03' and kd_jns_pembayaran='BT' and keterangan='Selesai'");
					while ($baris02=mysql_fetch_array($cari03))
					{
						$no_transaksi04=$baris02['no_transaksi'];

						$tampil_produk=mysql_query("select* from tb_detail where no_transaksi='$no_transaksi04'");
						while ($baris03=mysql_fetch_array($tampil_produk))
						{ 
							$kd_produk=$baris03['kd_produk'];
							$jumlah=$baris03['jumlah'];
			
							$tampil_produk00=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
							$baris04=mysql_fetch_array($tampil_produk00);
							$gambar=$baris04['gambar'];
							$nm_produk=$baris04['nm_produk'];
							$harga=$baris04['harga'];
							$diskon=$baris04['diskon'];

							$harga_stlh_diskon=$harga-($harga*$diskon);
							$harga_stlh_diskon00=number_format($harga_stlh_diskon);
							$harga_stlh_diskon01=str_replace(",",".","$harga_stlh_diskon00");

							$total_harga=$harga_stlh_diskon*$jumlah;
							$total_harga00=number_format($total_harga);
							$total_harga01=str_replace(",",".","$total_harga00");?>	
							<form name="b" method="post">
							<input type="hidden" name="kd_produk[]" value="<?php echo $kd_produk;?>">
							<input type="hidden" name="no_transaksi" value="<?php echo $no_transaksi;?>">
							<tr>
								<td style="font-family:arial;font-size:12px"><img src="images/<?php echo $gambar;?>" width=50 height=50>&nbsp;&nbsp;<?php echo $nm_produk;?></td>
								<td style="font-family:arial;font-size:12px" align=right><?php echo "IDR ".$harga_stlh_diskon01;?></td>
								<td style="font-family:arial;font-size:12px" align=right><?php echo $jumlah;?></td>
								<td style="font-family:arial;font-size:12px" align=right><?php echo "IDR ".$total_harga01;?></td>
								<td align=center><input type="number" name="jlh_retur[]" onclick="nonaktifkan();" min="0" max="<?php echo $jumlah;?>" value="0" required></td>
							</tr>
						<?php } 
					}
					
				}	
			}
		}		
	
}
else
{}?>
							</table>
							</td>
						</tr>
					<tr>	
					<input type="hidden" name="id" value="<?php echo $id;?>">
					<input type="hidden" name="no_transaksi" value="<?php echo $no_transaksi;?>">
					<tr>
						<td style="font-family:arial;font-size:14px;color:#727376" valign=top>Metode Pengembalian</td>
						<td colspan=2>
						<select name="kd_jns_pengembalian" style="width:100%;height:30px" required>
						<option value="">--Pilih (Wajib dipilih)--</option>
						<optgroup>
						<?php 
						$tampil=mysql_query("select* from tb_jns_pengembalian");
						while ($baris=mysql_fetch_array($tampil))
						{ 
							$kd_jns_pengembalian=$baris['kd_jns_pengembalian'];$nm_jns_pengembalian=$baris['nm_jns_pengembalian'];?>
							<option value="<?php echo $kd_jns_pengembalian;?>"><font color=red><?php echo $nm_jns_pengembalian;?></font></option>		
						<?php } ?>
						</optgroup>
						</select>
						</td>
					</tr>
					<tr>
						<td style="font-family:arial;font-size:14px;color:gray" valign=top>Alasan Pengembalian</td>
						<td colspan=2>
						<select name="alasan" style="width:100%">
						<option value="">--Pilih (Wajib dipilih)--</option>
						<optgroup>
						<option value="Barang rusak/cacat">Barang rusak/cacat</option>
						<option value="Barang tidak sesuai pesanan">Barang tidak sesuai pesanan</option>
						</optgroup>							
						</select>
						</td>
					</tr>
					<tr>
						<td colspan=3>
						<table width=100% align=center>
						<tr>
							<td align=center><input class="tombol00" type="submit" name="simpan" value="Simpan"></td>
						</tr>
						</table>
						</td>
					</tr>
					</form>
					<?php
					$d=date("d")."-".date("m")."-".date("Y");
					$simpan=$_POST['simpan'];
					$no_transaksi=$_POST['no_transaksi'];
					$no_transaksi00=encrypt($no_transaksi);
					$kd_jns_pengembalian=$_POST['kd_jns_pengembalian'];
					$kd_produk=$_POST['kd_produk'];
					$jlh_retur=$_POST['jlh_retur'];
					$jlh_retur00=count($jlh_retur);
					$alasan=$_POST['alasan'];
					$tampil00=mysql_query("select max(no_retur) from tb_pengembalian_produk");
					while ($baris00=mysql_fetch_array($tampil00))
					{
						$no_retur=$baris00['max(no_retur)'];
					}
					if ($no_retur=="")
					{
						$no_retur00="RET0001";
					}
					else
					{
						$s=(int) substr($no_retur,3,4);
	
					$s++;

						$no_retur00 = "RET".sprintf("%04s",$s);
					}
					if ($simpan)
					{ 
						for ($i=0;$i<=$jlh_retur00-1;$i++)
						{	
							if ($jlh_retur[$i]>0)
							{
							
								$simpan00=mysql_query("insert into tb_pengembalian_produk values('','$no_retur00','$d','$no_transaksi','$kd_produk[$i]','$jlh_retur[$i]','$kd_jns_pengembalian','$alasan','Proses Retur')");
								$simpan01=mysql_query("update tb_pembayaran set keterangan='Selesai' where no_transaksi='$no_transaksi'");?>					
							<?php }
						}
						if ($simpan00 and $simpan01)
						{ ?>
							<script>alert('Data berhasil disimpan')</script>
							<meta http-equiv="refresh" content="0;url='index.php?p=form_retur&id=<?php echo $id;?>&no_transaksi=<?php echo $no_transaksi00;?>'">						
						<?php }
					}  ?>		


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