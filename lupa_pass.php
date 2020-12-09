<html>
<head>
</head>
<body>
<?php 
error_reporting(0);
include "koneksi.php";
include "function.php";
$id=$_GET['id'];
$id00=str_replace(" ", "+", "$id");
$de_id=decrypt($id00);
$cari=mysql_query("select* from tb_login where id='$de_id'");
$baris=mysql_fetch_array($cari);
$username=$baris['username'];
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
	<table border=0 style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2)" align=center width=100% cellpadding=20>
	<tr>
		<td valign=top bgcolor=white>
		<table border=0 align=center width=100% cellpadding=30>
		<tr>
			<td>
			<form method="post">
			<table border=0 align=center width=100% cellpadding=20>
			<tr>
				<td valign=top bgcolor=white>
				<table border=0 width=400 cellpadding=10 align=center>
				<tr>
					<td colspan=2 style="font-family:arial;font-size:24px;height:60px;color:#727376" align=center>Pemulihan Password</td>
				</tr>
				<tr>
					<td colspan=2 style="font-family:arial;font-size:12px;color:#727376">Masukkan Username anda untuk melakukan pemulihan password</td>
				</tr>
				<tr>
					<td colspan=2 align=center><input class="icon_username" type="text" name="username" placeholder="Username" autofocus required></td>
				</tr>
				<tr>
					<td colspan=2>
					<table width=100% align=center>
					<tr>
						<td align=center><input class="tombol00" type="submit" name="proses" value="Lanjut"></td>
					</tr>
					</table>
					</td>
				</tr>	
				</table>			
				</td>
			</tr>

			</table>
			</form>
			<?php
			$proses=$_POST['proses'];
			$username=$_POST['username'];
			if ($proses)
			{
				$tampil=mysql_query("select* from tb_user where username='$username'");
				$baris=mysql_fetch_array($tampil);
				$username00=$baris['username'];
				$password00=$baris['password'];

				$tampil00=mysql_query("select max(id) from tb_login where username='$username'");
				$baris00=mysql_fetch_array($tampil00);
				$id=$baris00['max(id)'];
				
				$password01=md5($password00.$id);
				$password02=substr($password01,0,8);
				if ($username00!=$username)
				{ ?>
					<script>alert('Maaf, username tidak ditemukan')</script>
					<meta http-equiv="refresh" content="0;url='index.php?p=lupa_pass'">
				<?php }
				else
				{ 
					mysql_query("update tb_user set password='$password02' where username='$username'");?>
					<script>window.location.href="index.php?p=login";alert('Password baru anda adalah <?php echo $password02;?>')</script>			
				<?php }
			} ?>
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