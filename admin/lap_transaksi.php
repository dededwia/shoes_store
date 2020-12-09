<html>
<head>
<meta name="viewport" content="width=device-width; initial-scale=0.38; maximum-scale=1.0;">
<link rel="stylesheet" type="text/css" href="theme.css">
<style>
#highlight tbody tr:nth-of-type(even)
{
	
	background:#EDECE4;

}
</style>
</head>
<body>
<?php 
error_reporting(0);
include "../koneksi.php";
include "../function.php";
$id=$_GET['id'];
$id00=str_replace(" ", "+", "$id");
$de_id=decrypt($id00);
$cari=mysql_query("select* from tb_login where id='$de_id'");
$baris=mysql_fetch_array($cari);
$username=$baris['username'];
$x=$_GET['x'];
$x0=str_replace(" ", "+", "$x");
$de_x=decrypt($x0);
session_start();
if ($id!="")
{
	if (empty($_SESSION['id'])) 
	{
 		header("location:index.php?p=login"); 
	}
}
?>
<table border=0 bgcolor=white align=center width=100% cellpadding=30>
<tr>
	<td colspan=2>

					<table border=1 id="highlight" style="border-collapse:collapse" align=center cellpadding=10>
					<tr>
						<th height=50 colspan=10 style="font-family:arial;font-size:20px;width:200px">Transaksi</th>
					</tr>
					<tr>
						<th style="background:black;color:white;font-family:arial;font-size:12px;width:200px">No.</th>
						<th style="background:black;color:white;font-family:arial;font-size:12px;width:400px">Tanggal</th>
						<th style="background:black;color:white;font-family:arial;font-size:12px;width:500px">Nama Pelanggan</th>
						<th style="background:black;color:white;font-family:arial;font-size:12px;width:200px">Bank</th>
						<th style="background:black;color:white;font-family:arial;font-size:12px;width:500px">Nama Pemegang rek.</th>
						<th style="background:black;color:white;font-family:arial;font-size:12px;width:300px">No. Rek. Bank</th>
						<th style="background:black;color:white;font-family:arial;font-size:12px;width:100px">Total Beli</th>
						<th style="background:black;color:white;font-family:arial;font-size:12px;width:100px">Total Berat</th>
						<th style="background:black;color:white;font-family:arial;font-size:12px;width:200px">Ongkir</th>
						<th style="background:black;color:white;font-family:arial;font-size:12px;width:200px">Total</th>
					</tr>
					<?php 
					$tampil=mysql_query("select* from tb_transaksi where tgl_transaksi like '%$de_x%'");
					while ($baris=mysql_fetch_array($tampil))
					{
						$no_transaksi=$baris['no_transaksi'];
						$tgl_transaksi=$baris['tgl_transaksi'];
						$kd_plgn=$baris['kd_plgn'];
						$nm_pemegang_kartu=$baris['nm_pemegang_kartu'];
						$no_rek_bank=$baris['no_rek_bank'];
						$total_beli=$baris['total_beli'];
						$total_berat=$baris['total_berat'];
						$ongkir=number_format($baris['ongkir']);
						$ongkir0=str_replace(",", ".","$ongkir");
						$total_bayar=number_format($baris['total_bayar']);
						$total_bayar0=str_replace(",",".","$total_bayar");

						$cari=mysql_query("select* from tb_pelanggan where kd_plgn='$kd_plgn'");
						$baris0=mysql_fetch_array($cari);
						$nm_plgn=$baris0['nm_plgn'];

						$kd_bank=$baris['kd_bank'];
						$cari0=mysql_query("select* from tb_bank where kd_bank='$kd_bank'");
						$baris1=mysql_fetch_array($cari0);
						$nm_bank=$baris1['nm_bank'];

						?>
						<tr>
							<td style="font-family:arial;font-size:12px"><?php echo $no_transaksi;?></td>
							<td style="font-family:arial;font-size:12px"><?php echo $tgl_transaksi;?></td>
							<td style="font-family:arial;font-size:12px"><?php echo $nm_plgn;?></td>
							<td style="font-family:arial;font-size:12px"><?php echo $nm_bank;?></td>
							<td style="font-family:arial;font-size:12px"><?php echo $nm_pemegang_kartu;?></td>						
							<td style="font-family:arial;font-size:12px"><?php echo $no_rek_bank;?></td>							
							<td style="font-family:arial;font-size:12px" align=right><?php echo $total_beli;?></td>		
							<td style="font-family:arial;font-size:12px" align=right><?php echo $total_berat;?></td>
							<td style="font-family:arial;font-size:12px" align=right><?php echo "IDR. ".$ongkir0;?></td>
							<td style="font-family:arial;font-size:12px" align=right><?php echo "IDR. ".$total_bayar0;?></td>
						</tr>
					<?php } 
					$tampil0=mysql_query("select sum(total_bayar) from tb_transaksi where tgl_transaksi like '%$de_x%'");
					$baris=mysql_fetch_array($tampil0);
					$total=number_format($baris['sum(total_bayar)']);
					$total0=str_replace(",",".","$total");?>
					<tr>
						<td bgcolor=white colspan=9 style="font-family:arial;font-size:12px" align=right><b>Subtotal</b></td><td bgcolor=white style="font-family:arial;font-size:12px" align=right><b><?php echo "IDR. ".$total0;?></b></td>
					</tr>
					</table>
					</td>
	</tr>
	<tr>
		<td align=right><input type="button" style="cursor:pointer" id="jangan_cetak" onclick="window.print();" value="Cetak"></td>
	</tr>
	</table>
	</td>
</tr>
</table>
</body>