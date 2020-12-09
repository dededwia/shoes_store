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
//error_reporting(0);
include "../koneksi.php";
include "../function.php";
$id=$_GET['id'];
$id00=str_replace(" ", "+", "$id");
$de_id=decrypt($id00);
$cari=mysql_query("select* from tb_login where id='$de_id'");
$baris=mysql_fetch_array($cari);
$username=$baris['username'];
$tahun1=$_POST['tahun'];
$bulan1=$_POST['bulan'];
if ($bulan1=="01")
{
	$bulan0="Januari";
}
elseif ($bulan1=="02")
{
	$bulan0="Februari";
}
elseif ($bulan1=="03")
{
	$bulan0="Maret";
}
elseif ($bulan1=="04")
{
	$bulan0="April";
}
elseif ($bulan1=="05")
{
	$bulan0="Mei";
}
elseif ($bulan1=="06")
{
	$bulan0="Juni";
}
elseif ($bulan1=="07")
{
	$bulan0="Juli";
}
elseif ($bulan1=="08")
{
	$bulan0="Agustus";
}
elseif ($bulan1=="09")
{
	$bulan0="September";
}
elseif ($bulan1=="10")
{
	$bulan0="Oktober";
}
elseif ($bulan1=="11")
{
	$bulan0="November";
}
elseif ($bulan1=="12")
{
	$bulan0="Desember";
}



session_start();
if ($id!="")
{
	if (empty($_SESSION['id'])) 
	{
 		header("location:index.php?p=login"); 
	}
}
?>
<table border=0 align=center width=100% cellpadding=30>
<tr>
	<td>
	<table border=0 align=center width=100%>
	<tr>
		<td valign=top>
		<table bgcolor=white style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" height=100%>
		<tr>
			<td width=100% valign=top>
			<table width=100% cellpadding=10>
			<tr>
				<td align=right>
				<form method="post">
				<select name="bulan">
				<option value="<?php echo $bulan1;?>"><?php echo $bulan0;?></option>
				<optgroup label="____________">
				<option value="">-</option>
				<option value="01">Januari</option>
				<option value="02">Februari</option>
				<option value="03">Maret</option>
				<option value="04">April</option>
				<option value="05">Mei</option>
				<option value="06">Juni</option>
				<option value="07">Juli</option>
				<option value="08">Agustus</option>
				<option value="09">September</option>
				<option value="10">Oktober</option>
				<option value="11">November</option>
				<option value="12">Desember</option>
				</optgroup>
				</select>
				<select name="tahun">
				<option value="<?php echo $tahun1;?>"><?php echo $tahun1;?></option>
				<optgroup label="____________">
				<option value="2018">2018</option>
				<option value="2019">2019</option>
				<option value="2020">2020</option>
				<option value="2021">2021</option>
				<option value="2022">2022</option>
				</select>
				<input type="submit" style="cursor:pointer" value="Cari">
				</form>
				<?php 
				$bulan=$_POST['bulan'];
				$tahun=$_POST['tahun'];
				$x=$bulan."-".$tahun;
				?>
				</td>
			</tr>
			<tr>
		
					<td align=center>
					<table border=1 id="highlight" style="border-collapse:collapse" align=center cellpadding=10>
					<tr>
						<th height=100 colspan=11 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">Transaksi</th>
					</tr>
					<tr>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">No.</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:400px">Tanggal</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:500px">Nama Pelanggan</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Bank</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:500px">Nama Pemegang rek.</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:300px">No. Rek. Bank</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Total Beli</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Total Berat</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Ongkir</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Total Bayar</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
					</tr>
					<?php 
					$tampil=mysql_query("select* from tb_transaksi where tgl_transaksi like '%$x%'");
					while ($baris=mysql_fetch_array($tampil))
					{
						$no_transaksi=$baris['no_transaksi'];
						$tgl_transaksi=$baris['tgl_transaksi'];
						$kd_plgn=$baris['kd_plgn'];
						$nm_pemegang_kartu=$baris['nm_pemegang_kartu'];
						$no_rek_bank=$baris['no_rek_bank'];
						$total_beli=$baris['total_beli'];
						$total_berat=$baris['total_berat'];
						$ongkir=$baris['ongkir'];
						$total_bayar=$baris['total_bayar'];

						$cari=mysql_query("select* from tb_pelanggan where kd_plgn='$kd_plgn'");
						$baris0=mysql_fetch_array($cari);
						$nm_plgn=$baris0['nm_plgn'];

						$kd_bank=$baris['kd_bank'];
						$cari0=mysql_query("select* from tb_bank where kd_bank='$kd_bank'");
						$baris1=mysql_fetch_array($cari0);
						$nm_bank=$baris1['nm_bank'];

						?>
						<tr>
							<td style="font-family:arial;font-size:14px"><a href="detail_transaksi.php?id=<?php echo $id;?>&no_transaksi=<?php echo encrypt($no_transaksi);?>" target="_blank"><?php echo $no_transaksi;?></a></td>
							<td style="font-family:arial;font-size:14px"><?php echo $tgl_transaksi;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_plgn;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_bank;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_pemegang_kartu;?></td>						
							<td style="font-family:arial;font-size:14px"><?php echo $no_rek_bank;?></td>							
							<td style="font-family:arial;font-size:14px" align=right><?php echo $total_beli;?></td>		
							<td style="font-family:arial;font-size:14px" align=right><?php echo $total_berat/1000;?></td>
							<td style="font-family:arial;font-size:14px" align=right><?php echo $ongkir;?></td>
							<td style="font-family:arial;font-size:14px" align=right><?php echo $total_bayar;?></td>
							<td align=center><button style="cursor:pointer"><a style="text-decoration:none;color:black" onclick="return confirm('Apakah anda ingin menghapus data <?php echo $no_transaksi;?>?')" href="hapus_transaksi.php?id=<?php echo $id;?>&no_transaksi=<?php echo $no_transaksi;?>">Hapus</a></button></td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan=10 bgcolor=white></td><td bgcolor=white align=center><button style="cursor:pointer"><a style="text-decoration:none;color:black" onclick="return confirm('Apakah anda ingin menghapus semua data transaksi?')" href="hapus_semua_transaksi.php?id=<?php echo $id;?>">Hapus Semua</a></button></td>
					</tr>
					</table>
					</td>
			</tr>
			<tr>
				<td align=center><button><a href='lap_transaksi.php?id=<?php echo $id;?>&x=<?php echo encrypt($x);?>'" target="_blank" style="text-decoration:none;color:black">Lihat Versi Cetak</a></button></td>
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