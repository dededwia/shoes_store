<html>
<head>
<meta name="viewport" content="width=device-width; initial-scale=0.38; maximum-scale=1.0;">
<link rel="stylesheet" type="text/css" href="theme.css">
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
$kd_bank=$_GET['kd_bank'];
session_start();
if ($id!="")
{
	if (empty($_SESSION['id'])) 
	{
 		header("location:index.php?p=login"); 
	}
}
?>
<script>

function angka(event)

{
	
	var charcode=(event.which)?event.which:event.keycode
	
	if (charcode>31 && (charcode<48 || charcode>57))
	
	return false;
	return true;

}

</script>
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
				<form enctype="multipart/form-data" method="post">
				<?php
				$tampil0=mysql_query("select max(kd_ongkir) from tb_ongkir");
				while ($baris=mysql_fetch_array($tampil0))
				{
					$kd_ongkir=$baris['kd_ongkir'];
					$x=$baris['max(kd_ongkir)'];
				}
				if ($x=="")
				{
					$y="ONK001";
				}
				else
				{
					$s=(int) substr($x,3,3);
					
$s++;

					$y = "ONK".sprintf("%03s",$s);
				}
				?>
				<table border=1 id="highlight" style="border-collapse:collapse" align=center cellpadding=10>
				<tr>
					<th height=100 colspan=5 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">Tambah ongkir</th>
				</tr>
				<tr>
					<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Kode Ongkir</th>
					<th style="background:black;color:white;font-family:arial;font-size:14px;width:1000px">Nama kota</th>
					<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Ongkir</th>
					<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Kurir</th>
					<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
				</tr>
				<tr>

					<td style="font-family:arial;font-size:14px"><input type="text" name="kd_ongkir" value="<?php echo $y;?>" style="width:100%" readonly></td>
					<td style="font-family:arial;font-size:14px"><input type="text" name="nm_kota" style="width:100%" required autofocus></td>
					<td style="font-family:arial;font-size:14px"><input type="text" name="ongkir" onkeypress="return angka(event)" style="width:100%" required></td>
					<td style="font-family:arial;font-size:14px">
					<select name="kurir" style="width:100%">
					<?php
					$tampil0=mysql_query("select* from tb_kurir");
					while ($baris0=mysql_fetch_array($tampil0))
					{ 
						$kd_kurir=$baris0['kd_kurir'];
						$nm_kurir=$baris0['nm_kurir'];?>
						<option value="<?php echo $kd_kurir;?>"><?php echo $nm_kurir;?></option>
					<?php } ?>
					</select>
					</td>
					<td align=center><input type="submit" onclick="return confirm('Apakah anda ingin menyimpan data ini?')" name="submit" style="cursor:pointer" value="Simpan"></td>
				</tr>
				</table>
				</form>
				<?php
				$submit=$_POST['submit'];
				$kd_ongkir=$_POST['kd_ongkir'];
				$nm_kota=$_POST['nm_kota'];
				$ongkir=$_POST['ongkir'];
				$kd_kurir=$_POST['kurir'];
				if ($_SERVER["REQUEST_METHOD"] == "POST") 
				{
  					if (empty($_POST['nm_kota'])) 
					{
    						$name = test_input($_POST['nm_kota']);
					}
  					elseif (empty($_POST['ongkir'])) 
					{
    						$name = test_input($_POST['ongkir']);
					}
				}
				if ($submit)
				{
					mysql_query("insert into tb_ongkir values('$kd_ongkir','$nm_kota','$ongkir','$kd_kurir')");
					?>
					<script>alert('Data berhasil disimpan')</script>
					<meta http-equiv="refresh" content="0;url='index.php?p=ongkir&id=<?php echo $id;?>'">	
				<?php } ?>
			</td>
			</tr>
			<tr>
				<td><input type="button" onclick="window.location.href='index.php?p=ongkir&id=<?php echo $id;?>'" style="cursor:pointer" value="Kembali"></td>
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