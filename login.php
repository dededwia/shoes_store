<html>
<head>
</head>
<body>
<?php 
error_reporting(0);
include "koneksi.php";
$id=$_GET['id'];?>
<table border=0 align=center class="c" bgcolor=transparent width=100% cellpadding=0>
<tr>
	<td align=right><input type="image" onclick="window.location.href='index.php?p=home'" src="images/home.png" width=50 height=50></td>
</tr>
</table>
<table border=0 align=center bgcolor=red width=100% style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" cellpadding=0 class="b">
<tr>
	<td><img src="images/logo.png" width=200 height=100px></td>			
</tr>
</table>
<br><br><br><br><br><br>
<table border=0 align=center width=100% cellpadding=70>
<tr>
	<td>
	<form action="proses_login.php" method="post">
	<table border=0 bgcolor=white style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" align=center width=100% cellpadding=10>
	<tr>
		<td valign=top bgcolor=white>
		<table border=0 width=400 cellpadding=10 align=center>
		<tr>
			<td colspan=2 style="font-family:arial;font-size:24px;height:60px;color:#727376" align=center>LOGIN</td>
		</tr>
		<tr>
			<td colspan=2 align=center><input class="icon_username" style="width:100%" type="text" name="username" placeholder="Username" autofocus required></td>
		</tr>
		<tr>
			<td colspan=2 align=center><input class="icon_password" style="width:100%" type="password" name="password" placeholder="Password" required></td>
		</tr>
		<tr>
			<td colspan=2>
			<table width=100% align=center>
			<tr>
				<td align=center><input class="tombol00" type="submit" value="Login"></td>
			</tr>
			</table>
			</td>
		</tr>	
		<tr>

				<td style="font-family:arial;font-size:14px"><i>Belum memliki akun? <a class="ubahwarnalink" style="text-decoration:none;font-family:arial;font-size:14px" href="index.php?p=daftar"><i>Daftar</i></a></td><td align=right><a class="ubahwarnalink" style="text-decoration:none;font-family:arial;font-size:14px" href="index.php?p=lupa_pass"><i>Lupa Password?</i></a></td>

		</tr>
		</table>			
		</td>
	</tr>
	</table>
	</form>
	</td>
</tr>
</table>

</body>