<?php
session_start();
error_reporting(0);
include "koneksi.php";
include "function.php";
date_default_timezone_set('Asia/Jakarta');
$d1=date("Y-m-d h:i:sa");
$username=$_POST['username'];
$password=$_POST['password'];
$cari00=mysql_query("select* from tb_user where username='$username' and password='$password'");
$baris00=mysql_fetch_array($cari00);
$username00=$baris00['username'];
$password00=$baris00['password'];
$cari01=mysql_query("select* from tb_admin where username='$username' and password='$password'");
$baris01=mysql_fetch_array($cari01);
$username01=$baris01['username'];
$password01=$baris01['password'];
if ($username00==$username and $password00==$password)
{ ?>
	<script>alert('Login berhasil')</script>
	<?php
	$tampil=mysql_query("select max(kd_plgn) from tb_login");
	while ($baris=mysql_fetch_array($tampil))
	{
		$kd_plgn=$baris['kd_plgn'];
		$x=$baris['max(kd_plgn)'];

	}
	if ($x=="")
	{
		$y="C00000001";
	}
	else
	{
		$s=(int) substr($x,1,8);
		
$s++;

		$y = "C".sprintf("%08s",$s);
	}
	$d=date(d).date(m).date(y);

	$tampil00=mysql_query("select max(no_transaksi) from tb_transaksi");
	while ($baris00=mysql_fetch_array($tampil00))
	{
		$x1=$baris['max(no_transaksi)'];
	}
	if ($x=="")
	{
		$y1=$d."00000001";
	}
	else
	{
		$s=(int) substr($x,1,8);
	
	$s++;

		$y1 = $d.sprintf("%08s",$s);
	}
	mysql_query("insert into tb_pelanggan values('$y','','','','')");
	mysql_query("insert into tb_transaksi values('$y1','','$y','','-','','','','','')");
	mysql_query("insert into tb_login values('','$username','$y','$d1','user')");
	$tampil00=mysql_query("select max(id) from tb_login");
	$baris02=mysql_fetch_array($tampil00);
	$id=$baris02['max(id)'];
	$id00=encrypt($id);
	$_SESSION['id'] = $id00;
	header("location:index.php?p=home&id=$id00");	
}
elseif ($username01==$username and $password01==$password)
{ ?>
	<script>alert('Login berhasil')</script>
	<?php
	mysql_query("insert into tb_login values('','$username','','$d','admin')");
	$tampil00=mysql_query("select max(id) from tb_login");
	$baris02=mysql_fetch_array($tampil00);
	$id=$baris02['max(id)'];
	$id00=encrypt($id);
	$_SESSION['id'] = $id00;
	header("location:../kamera/admin/index.php?p=home&id=$id00");
}
else
{ ?>
	<script>alert('Login gagal, silahkan periksa kembali username dan password anda')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=login'">
<?php } 
?>
