<html>
<head>
</head>
<body><?php 
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

$no_transaksi01=$_GET['no_transaksi'];
$no_transaksi00=str_replace(" ", "+", "$no_transaksi01");
$no_transaksi=decrypt($no_transaksi00);

$tampil=mysql_query("select* from tb_transaksi where no_transaksi='$no_transaksi'");
$baris=mysql_fetch_array($tampil);
$tgl_transaksi=$baris['tgl_transaksi'];
$nm_pemegang_kartu=$baris['nm_pemegang_kartu'];
$bank=$baris['kd_bank'];
$no_rekening=$baris['no_rek_bank'];
$ongkir=$baris['ongkir'];
$ongkir01=number_format($ongkir);
$ongkir02=str_replace(",", ".","$ongkir01");
$total_beli=$baris['total_beli'];
$total_berat=$baris['total_berat'];
$total_berat1=$total_berat/1000;
$total_bayar=$baris['total_bayar'];
$total_bayar02=number_format($total_bayar);
$total_bayar03=str_replace(",", ".","$total_bayar02");	

$tampil06=mysql_query("select* from tb_pengiriman where no_transaksi='$no_transaksi'");
$baris06=mysql_fetch_array($tampil06);
$kd_kurir=$baris06['kd_kurir'];

$tampil00=mysql_query("select* from tb_pembayaran where no_transaksi='$no_transaksi'");
$baris00=mysql_fetch_array($tampil00);
$kd_jns_pembayaran=$baris00['kd_jns_pembayaran'];
$kota=$_POST['kota'];
$tampil01=mysql_query("select* from tb_jns_pembayaran where kd_jns_pembayaran='$kd_jns_pembayaran'");
$baris01=mysql_fetch_array($tampil01);
$nm_jns_pembayaran=$baris01['nm_jns_pembayaran'];

$tampil02=mysql_query("select* from tb_bank where kd_bank='$bank'");
$baris02=mysql_fetch_array($tampil02);
$nm_bank=$baris02['nm_bank'];

$tampil03=mysql_query("select* from tb_pelanggan where kd_plgn='$kd_plgn'");
$baris03=mysql_fetch_array($tampil03);
$nm_plgn=$baris03['nm_plgn'];
$alamat00=$baris03['alamat'];
$no_telp=$baris03['no_telp'];

$tampil04=mysql_query("select* from tb_ongkir where kd_ongkir='$kota'");
$baris04=mysql_fetch_array($tampil04);
$nm_kota=$baris04['nm_kota'];

$tampil05=mysql_query("select* from tb_kurir where kd_kurir='$kd_kurir'");
$baris05=mysql_fetch_array($tampil05);
$nm_kurir=$baris05['nm_kurir'];
		
session_start();
if ($id!="")
{
	if (empty($_SESSION['id'])) 
	{
 		header("location:index.php?p=home"); 
	}
}
?>
<table border=0 id="jangan_cetak" align=center bgcolor=transparent width=100% cellpadding=0 class="c">
<tr>
	 <td align=right><input type="image" onclick="window.location.href='index.php?p=home';alert('Pemesanan selesai dilakukan, silahkan untuk melakukan pembayaran')" src="images/home.png" width=50 height=50></td>
</tr>
</table>

<table align=center cellpadding=10 width=100%>
<tr>
	<td>
	<table border=0 bgcolor=white style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" align=center width=100%>
	<tr>
		<td width=100% align=center>
		<table border=0 style="border-color:white" cellpadding=5 width=100%>
		<tr>
			<td>
			<?php
			$id=$_GET['id'];
			?>
			<table border=1 style="border-color:white;border-collapse:collapse" width=100% cellpadding=5>
			<tr>
				<td colspan=2 align=center style="font-size:18px;font-family:arial;font-weight:bold" valign=top><img src="images/logo.png" width=150 height=70></td>
			</tr>
			<tr>
				<td colspan=2>
				<table border=0 width=100% align=center>
				<tr>
					<td>
					<table border=1 style="border-collapse:collapse" width=100% align=center cellpadding=5>
					<tr>
						<td colspan=2>
						<table width=100% align=center>
						<tr>
							<td style="font-family:arial;font-size:14px;width:100px;font-weight:bold">Tanggal : <?php echo $tgl_transaksi;?></td><td style="font-family:arial;font-size:14px;width:100px;font-weight:bold" align=right>Invoice #<?php echo $no_transaksi;?></th>
						</tr>
						</table>
						</td>
					</tr>
					<tr>
						<td valign=top>
						<table border=0 width=100% align=center cellpadding=5>
						<tr>
							<td style="font-family:arial;font-size:12px;width:100px">Nama Lengkap</td><td style="font-family:arial;font-size:12px;width:500px" valign=top><?php echo $nm_plgn;?></td>
						</tr>
						<tr>
							<td style="font-family:arial;font-size:12px" valign=top>Alamat</td><td style="font-family:arial;font-size:12px" valign=top><?php echo $alamat00;?></td>
						</tr>
						<tr>
							<td style="font-family:arial;font-size:12px">No. Telp.</td><td style="font-family:arial;font-size:12px" valign=top><?php echo $no_telp;?></td>
						</tr>
						</table>
						</td>
						<td valign=top>
						<?php 
						if ($kd_jns_pembayaran=="BT")
						{ ?>
							<table border=0 width=100% align=center cellpadding=5>
							<tr>
								<td style="font-family:arial;font-size:12px;width:100px" valign=top>Metode Pembayaran</td><td style="font-family:arial;font-size:12px;width:500px" valign=top><?php echo $nm_jns_pembayaran;?></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:12px" valign=top>Bank</td><td style="font-family:arial;font-size:12px" valign=top><?php echo $nm_bank;?></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:12px">No. Rekening</td><td style="font-family:arial;font-size:12px" valign=top><?php echo $no_rekening;?></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:12px">Jasa Pengiriman</td><td style="font-family:arial;font-size:12px" valign=top><?php echo $nm_kurir;?></td>
							</tr>
							</table>
						<?php } 
						else
						{ ?>
							<table border=0 width=100% align=center cellpadding=10>
							<tr>
								<td style="font-family:arial;font-size:12px;width:100px" valign=top>Metode Pembayaran</td><td style="font-family:arial;font-size:12px;width:500px" valign=top><?php echo $nm_jns_pembayaran;?></td>
							</tr>
							</table>
						<?php } ?>
						</td>
					</tr>
					<tr>
						<td width=100% align=center colspan=2>
						<table border=1 style="border-collapse:collapse;border-style:solid" width=100% cellpadding=10>
						<tr>
							<th style="font-family:arial;font-size:12px;background:black;color:white">Nama Produk</th>
							<th style="font-family:arial;font-size:12px;background:black;color:white">Jumlah</th>
							<th style="font-family:arial;font-size:12px;background:black;color:white">Harga</th>
							<th style="font-family:arial;font-size:12px;background:black;color:white">Total</th>
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
								<td style="font-family:arial;font-size:12px"><img src="images/<?php echo $gambar;?>" width=50 height=50><?php echo $nm_produk;?></td>
								<td style="font-family:arial;font-size:12px" align=right><?php echo $jumlah." ".$satuan;?></td>
								<td style="font-family:arial;font-size:12px" align=right><?php echo "IDR ".$harga02;?></td>
								<td style="font-family:arial;font-size:12px" align=right><?php echo "IDR ".$total_harga02;?></td>
							</tr>
						<?php } ?>
						</table>
						</td>
					</tr>
					<tr>
						<td colspan=2 valign=top>
						<table border=0 width=100% align=center cellpadding=10>
						<?php 
						if ($kd_jns_pembayaran=="BT")
						{ ?>
						<tr>	
							<td width=800></td><td style="font-family:arial;font-size:12px">Total Berat</td><td style="font-family:arial;font-size:12px" align=right><?php echo $total_berat1." ".Kg;?></td>
						</tr>
						<tr>	
							<td width=800></td><td style="font-family:arial;font-size:12px">Ongkir</td><td style="font-family:arial;font-size:12px" align=right><?php echo "IDR ".$ongkir02;?></td>
						</tr>
						<?php }
						else
						{ ?>
						<tr>	
							<td width=800></td><td style="font-family:arial;font-size:12px">Total Berat</td><td style="font-family:arial;font-size:12px" align=right><?php echo $total_berat1." ".Kg;?></td>
						</tr>
						<tr>	
							<td width=800></td><td style="font-family:arial;font-size:12px">Ongkir</td><td style="font-family:arial;font-size:12px" align=right>FREE</td>
						</tr>		
						<?php } ?>
						<tr>
							<td width=800><td style="font-family:arial;font-size:12px">Jumlah item</td><td style="font-family:arial;font-size:12px" align=right><?php echo $total_beli;?></td>
						</tr>
						<tr>
							<td width=800><td style="font-family:arial;font-size:12px">Total Bayar</td><td style="font-family:arial;font-size:12px" align=right><?php echo "IDR ".$total_bayar03;?></td>
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
				<td bgcolor=yellow style="font-family:arial;font-size:12px;font-style:italic">Pembayaran dilakukan melalui <b>No. Rek. BCA 1234512345 a/n. Made Aryo</b></td>
			</tr>
			</table>
			
			</td>
		</tr>
		<tr>
			<td align=right><input type="button" id="jangan_cetak" class="tombol00" onclick="window.print()" value="Cetak"></td>
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