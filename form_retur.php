<html>
<head>
</head>
<body><?php 
error_reporting(0);
include "koneksi.php";
include "function.php";
date_default_timezone_set('Asia/Jakarta');
$d=date(d)."-".date(m)."-".date(Y);
$id=$_GET['id'];
$no_transaksi=$_GET['no_transaksi'];
$no_transaksi00=str_replace(" ", "+", "$no_transaksi");
$de_no_transaksi=decrypt($no_transaksi00);
$tampil04=mysql_query("select* from tb_transaksi where no_transaksi='$de_no_transaksi'");
$baris04=mysql_fetch_array($tampil04);
$kd_plgn=$baris04['kd_plgn'];
$nm_pemegang_kartu=$baris04['nm_pemegang_kartu'];
$kd_bank=$baris04['kd_bank'];
$no_rek_bank=$baris04['no_rek_bank'];

$tampil06=mysql_query("select* from tb_bank where kd_bank='$kd_bank'");
$baris06=mysql_fetch_array($tampil06);
$nm_bank=$baris06['nm_bank'];

$tampil00=mysql_query("select* from tb_pengembalian_produk where no_transaksi='$de_no_transaksi'");
$baris00=mysql_fetch_array($tampil00);
$no_retur=$baris00['no_retur'];
$tgl_pengajuan_retur=$baris00['tgl_pengajuan_retur'];
$no_transaksi=$baris00['no_transaksi'];
$kd_produk=$baris00['kd_produk'];
$jumlah_pengembalian=$baris00['jumlah'];
$kd_jns_pengembalian=$baris00['kd_jns_pengembalian'];
$alasan=$baris00['alasan'];

$tampil05=mysql_query("select* from tb_jns_pengembalian where kd_jns_pengembalian='$kd_jns_pengembalian'");
$baris05=mysql_fetch_array($tampil05);
$nm_jns_pengembalian=$baris05['nm_jns_pengembalian'];

$tampil03=mysql_query("select* from tb_pelanggan where kd_plgn='$kd_plgn'");
$baris03=mysql_fetch_array($tampil03);
$nm_plgn=$baris03['nm_plgn'];
$alamat00=$baris03['alamat'];
$no_telp=$baris03['no_telp'];		
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
	 <td align=right><input type="image" onclick="window.location.href='index.php?p=home'" src="images/home.png" width=50 height=50></td>
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
							<td style="font-family:arial;font-size:14px;width:100px;font-weight:bold">Tanggal Pengajuan Retur : <?php echo $tgl_pengajuan_retur;?></td><td style="font-family:arial;font-size:14px;width:100px;font-weight:bold" align=right>No. Retur : #<?php echo $no_retur;?></th>
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
						<?php
						if ($kd_jns_pengembalian=="RET001")
						{ ?>
							<tr>
								<td style="font-family:arial;font-size:12px;width:100px">Bank</td><td style="font-family:arial;font-size:12px;width:500px" valign=top><?php echo $nm_bank;?></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:12px" valign=top>No. Rekening</td><td style="font-family:arial;font-size:12px" valign=top><?php echo $no_rek_bank;?></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:12px">Rekening a/n.</td><td style="font-family:arial;font-size:12px" valign=top><?php echo $nm_pemegang_kartu;?></td>
							</tr>
						<?php }
						else
						{} ?>

						</table>
						</td>
						<td>
						
							<table border=0 width=100% align=center cellpadding=5>
							<tr>
								<td style="font-family:arial;font-size:12px;width:100px">Metode Pengembalian Produk</td><td style="font-family:arial;font-size:12px;width:500px" valign=top><?php echo $nm_jns_pengembalian;?></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:12px" valign=top>Alasan</td><td style="font-family:arial;font-size:12px" valign=top><?php echo $alasan;?></td>
							</tr>
							<tr>
								<td style="font-family:arial;font-size:12px" valign=top>Alamat Gudang</td><td><textarea style="font-family:arial;font-size:12px;resize:none;width:100%;height:100px;border:none;background:white" disabled>Komplek Industri Sentul Bogor, Jawa Barat Indonesia</textarea></td>
							</tr>
							</table>
					
						</td>
					</tr>
					<tr>
						<td width=100% align=center colspan=2>
						<table border=1 style="border-collapse:collapse;border-style:solid" width=100% cellpadding=10>
						<tr>
							<th style="font-family:arial;font-size:12px;background:black;color:white">Nama Produk</th>
							<th style="font-family:arial;font-size:12px;background:black;color:white">Harga</th>
							<th style="font-family:arial;font-size:12px;background:black;color:white;width:200px">Jumlah Pengembalian Produk</th>
						</tr>	
						<?php
						$tampil01=mysql_query("select* from tb_pengembalian_produk where no_transaksi='$de_no_transaksi'");
						while ($baris01=mysql_fetch_array($tampil01))
						{ 
							$kd_produk=$baris01['kd_produk'];
							$jumlah=$baris01['jumlah'];

							$tampil_produk00=mysql_query("select* from tb_produk where kd_produk='$kd_produk'");
							$baris03=mysql_fetch_array($tampil_produk00);
							$satuan=$baris03['satuan'];
							$harga=$baris03['harga'];
							$diskon=$baris03['diskon'];
							$harga_stlh_diskon=$harga-($harga*$diskon);
							$harga_stlh_diskon00=number_format($harga_stlh_diskon);
							$harga_stlh_diskon01=str_replace(",",".","$harga_stlh_diskon00");
							$gambar=$baris03['gambar'];
							$nm_produk=$baris03['nm_produk'];
							$total_harga=$harga_stlh_diskon*$jumlah;
							$total_harga00=number_format($total_harga);
							$total_harga01=str_replace(",",".","$total_harga00");
							?>
							<tr>
								<td style="font-family:arial;font-size:12px"><img src="images/<?php echo $gambar;?>" width=50 height=50><?php echo $nm_produk;?></td>
								<td style="font-family:arial;font-size:12px" align=right><?php echo "IDR ".$harga_stlh_diskon01;?></td>
								<td style="font-family:arial;font-size:12px" align=right><?php echo $jumlah." ".$satuan;?></td>
							</tr>
						<?php } ?>
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