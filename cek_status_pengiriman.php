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
			<td colspan=3 style="font-family:arial;font-size:24px;height:60px;color:gray" align=center>Status Pengiriman</td>
		</tr>
		<form name="b" method="post">
		<?php
		$no_transaksi03=$_POST['no_transaksi'];
		?>
		<input type="hidden" name="id" value="<?php echo $id;?>">
		<tr>
			<td style="font-family:arial;font-size:14px;color:gray;width:200px">No. Transaksi</td><td><input type="text" style="padding-left:10px" name="no_transaksi" onclick="aktifkan();" onkeypress="return angka(event)" placeholder="Wajib diisi" value="<?php echo $no_transaksi03;?>" required autofocus></td>
			<td width=100><input type="submit" name="cek_status" class="tombol04" value="Cek Status"></td>
		</tr>
		</form>
		<?php
		$cek_status=$_POST['cek_status'];
		$no_transaksi=$_POST['no_transaksi'];
		$cari00=mysql_query("select* from tb_login where username='$username'");
		while ($baris00=mysql_fetch_array($cari00))
		{
			$kd_plgn=$baris00['kd_plgn'];
			$cari01=mysql_query("select* from tb_transaksi where kd_plgn='$kd_plgn'");
			while ($baris01=mysql_fetch_array($cari01))
			{ 
				$no_transaksi01=$baris01['no_transaksi'];
				if ($cek_status)
				{ 
					$cari02=mysql_query("select* from tb_pengiriman where no_transaksi='$no_transaksi01'");
					while ($baris02=mysql_fetch_array($cari02))
					{
						
						if ($baris02['no_transaksi']==$no_transaksi)
						{ ?>
							<tr>
								<td style="font-family:arial;font-size:14px;color:gray">Status</td>
								<td style="font-family:arial;font-size:14px;color:gray"><?php echo $baris02['keterangan'];?></td>					
							</tr>
							<tr>
								<td style="font-family:arial;font-size:14px;color:gray">Tanggal Pengiriman</td>
								<td style="font-family:arial;font-size:14px;color:gray"><?php echo $baris02['tgl_pengiriman'];?></td>					
							</tr>
							<tr>
								<td style="font-family:arial;font-size:14px;color:gray">Kurir</td>
								<?php 
								$kd_kurir=$baris02['kd_kurir'];
								$cari03=mysql_query("select* from tb_kurir where kd_kurir='$kd_kurir'");
								$baris03=mysql_fetch_array($cari03);
								?>
								<td style="font-family:arial;font-size:14px;color:gray"><?php echo $baris03['nm_kurir'];?></td>					
							</tr>
							<tr>
								<td style="font-family:arial;font-size:14px;color:gray">No. Resi Pengiriman</td>
								<td style="font-family:arial;font-size:14px;color:gray"><?php echo $baris02['no_resi'];?></td>					
							</tr>
						<?php }

					}
			
					?>
					
				<?php }
				else
				{}
			}
		}
?>
		</table>
		
		</td>
	</tr>
	</table>
	</td>
</tr>
</table>

</body>