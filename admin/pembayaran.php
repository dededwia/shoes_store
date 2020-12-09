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
		
					<td align=center>
					<table border=1 id="highlight" style="border-collapse:collapse" align=center cellpadding=10>
					<tr>
						<th height=100 colspan=6 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">Pembayaran</th>
					</tr>
					<tr>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">No. Transaksi</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:500px">Jenis Pembayaran</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:500px">Bukti Pembayaran</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Tanggal Pembayaran</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:100px">Keterangan</th>
						<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
					</tr>
					<?php 
					$tampil=mysql_query("select* from tb_pembayaran");
					while ($baris=mysql_fetch_array($tampil))
					{
						$no_transaksi=$baris['no_transaksi'];
						$kd_jns_pembayaran=$baris['kd_jns_pembayaran'];
						$bukti_pembayaran=$baris['bukti_pembayaran'];
						$tampil0=mysql_query("select* from tb_jns_pembayaran where kd_jns_pembayaran='$kd_jns_pembayaran'");
						$baris0=mysql_fetch_array($tampil0);
						$nm_jns_pembayaran=$baris0['nm_jns_pembayaran'];
						$tgl_upload=$baris['tgl_upload'];
						$keterangan=$baris['keterangan'];
						?>
						<tr>
							<td style="font-family:arial;font-size:14px"><?php echo $no_transaksi;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $nm_jns_pembayaran;?></td>
							<td style="font-family:arial;font-size:14px"><img src="../upload/<?php echo $bukti_pembayaran;?>" width=80 height=80></td>
							<td style="font-family:arial;font-size:14px"><?php echo $tgl_upload;?></td>
							<td style="font-family:arial;font-size:14px"><?php echo $keterangan;?></td>
							<td align=center><button style="cursor:pointer"><a style="text-decoration:none;color:black" onclick="return confirm('Apakah anda ingin mengedit data <?php echo $no_transaksi;?>?')" href="index.php?p=edit_pembayaran&id=<?php echo $id;?>&no_transaksi=<?php echo $no_transaksi;?>">Edit</a></button> <button style="cursor:pointer"><a style="text-decoration:none;color:black" onclick="return confirm('Apakah anda ingin menghapus data <?php echo $no_transaksi;?>?')" href="hapus_pembayaran.php?id=<?php echo $id;?>&no_transaksi=<?php echo $no_transaksi;?>">Hapus</a></button></td>
						</tr>
					<?php } ?>
					<tr>
						<td colspan=5 bgcolor=white></td><td bgcolor=white align=center><button style="cursor:pointer"><a style="text-decoration:none;color:black" onclick="return confirm('Apakah anda ingin menghapus semua data pembayaran?')" href="hapus_semua_pembayaran.php?id=<?php echo $id;?>">Hapus Semua</a></button></td>
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