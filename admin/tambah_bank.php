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
				$tampil=mysql_query("select* from tb_bank");
				while ($baris=mysql_fetch_array($tampil))
				{
					$nm_bank0=$baris['nm_bank'];
				}
				$tampil0=mysql_query("select max(kd_bank) from tb_bank");
				while ($baris=mysql_fetch_array($tampil0))
				{
					$kd_bank=$baris['kd_bank'];
					$x=$baris['max(kd_bank)'];
				}
				if ($x=="")
				{
					$y="B001";
				}
				else
				{
					$s=(int) substr($x,1,3);
					
$s++;

					$y = "B".sprintf("%03s",$s);
				}
				?>
				<table border=1 id="highlight" style="border-collapse:collapse" align=center cellpadding=10>
				<tr>
					<th height=100 colspan=3 style="background:black;color:white;font-family:arial;font-size:24px;width:200px">Tambah bank</th>
				</tr>
				<tr>
					<th style="background:black;color:white;font-family:arial;font-size:14px;width:200px">Kode</th>
					<th style="background:black;color:white;font-family:arial;font-size:14px;width:1000px">Bank</th>
					<th style="background:black;color:white;font-family:arial;font-size:14px;width:150px">Action</th>
				</tr>
				<tr>

					<td style="font-family:arial;font-size:14px"><input type="text" name="kd_bank" value="<?php echo $y;?>" style="width:100%" readonly></td>
					<td style="font-family:arial;font-size:14px"><input type="text" name="nm_bank" style="width:100%" required autofocus></td>
					<td align=center><input type="submit" onclick="return confirm('Apakah anda ingin menyimpan data ini?')" name="submit" style="cursor:pointer" value="Simpan"></td>
				</tr>
				</table>
				</form>
				<?php
				$submit=$_POST['submit'];
				$kd_bank=$_POST['kd_bank'];
				$nm_bank=$_POST['nm_bank'];
				if ($_SERVER["REQUEST_METHOD"] == "POST") 
				{
  					if (empty($_POST['nm_bank'])) 
					{
    						$name = test_input($_POST['nm_bank']);
					}
				}
				if ($submit)
				{
					mysql_query("insert into tb_bank values('$kd_bank','$nm_bank','BT')");
					move_uploaded_file($_FILES['gambar']['tmp_name'], "../images/{$_FILES['gambar']['name']}"); ?>
					<script>alert('Data berhasil disimpan')</script>
					<meta http-equiv="refresh" content="0;url='index.php?p=bank&id=<?php echo $id;?>'">	
				<?php } ?>
			</td>
			</tr>
			<tr>
				<td><input type="button" onclick="window.location.href='index.php?p=bank&id=<?php echo $id;?>'" style="cursor:pointer" value="Kembali"></td>
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