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
session_start();
if ($id!="")
{
	if (empty($_SESSION['id'])) 
	{
 		header("location:index.php?p=login"); 
	}
}
?>

<table border=0 align=center width=100% cellpadding=100>
<tr>
	<td>
	<table border=0 align=center width=100%>
	<tr>
		<td valign=top>
		<table bgcolor=white style="box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2)" height=100% width=100% align=center cellpadding=100>
		<tr>
			<td width=100% valign=top align=center>
			Anda berada pada halaman admin
			
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