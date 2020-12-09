<html>
<head>
</head>
<body>
<?php 
error_reporting(0);
include "koneksi.php";
$id=$_GET['id'];
$username=$_GET['username'];
$pass00=$_GET['pass00'];
$pass01=$_GET['pass01'];
$email=$_GET['email'];?>
<table border=0 align=center class="c" bgcolor=transparent width=100% cellpadding=0>
<tr>
	<td align=right><input type="image" onclick="window.location.href='index.php?p=home'" src="images/home.png" width=50 height=50></td>
</tr>
</table>
<table border=0 align=center style="background:red" width=100% style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" cellpadding=0 class="b">
<tr>
	<td><img src="images/logo.png" width=200 height=100px></td>			
</tr>
</table>
<br><br><br>
<table border=0 align=center width=100% cellpadding=70>
<tr>
	<td>
	<table border=0 style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" bgcolor=white align=center width=100% cellpadding=10>
	<tr>
		<td valign=top bgcolor=white>
		<form action="simpan.php" method="post">
		<table width=400 cellpadding=10 align=center>
		<tr>
			<td style="font-family:arial;font-size:24px;height:60px;color:#727376" align=center>Buat akun Anda</td>
		</tr>
		<tr>
			<td align=center><input class="icon_username" type="text" name="username" placeholder="Username" value="<?php echo $username;?>" required autofocus></td>
		</tr>
		<tr>
			<td align=center><input class="icon_password" type="password" name="pass00" placeholder="Password" value="<?php echo $pass00;?>" maxlength="15" required></td>
		</tr>
		<tr>
			<td align=center><input class="icon_password" type="password" name="pass01" placeholder="Konfirmasi Password" value="<?php echo $pass01;?>" maxlength="15" required></td>
		</tr>
		<tr>
			<td align=center><input class="icon_email" type="email" name="email" placeholder="Email" value="<?php echo $email;?>" maxlength="50" required></td>
		</tr>
		<tr>
			<td colspan=2>
			<table width=100% align=center>
			<tr>
				<td align=center><input class="tombol00" type="submit" value="Daftar"></td>
			</tr>
			</table>
			</td>
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