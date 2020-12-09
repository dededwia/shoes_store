<?php 
include "koneksi.php";
$username=$_POST['username'];
$pass00=$_POST['pass00'];
$pass01=$_POST['pass01'];
$email=$_POST['email'];

$tampil=mysql_query("select* from tb_user where username='$username'");
$baris=mysql_fetch_array($tampil);
$username00=$baris['username'];

if ($username00!=$username)
{
	if ($pass01==$pass00)
	{ 
		if (strlen($pass01)>=8)
		{
			mysql_query("insert into tb_user values('$username','$pass00','$email')");?>
			<script>alert('Data berhasil disimpan')</script>
			<meta http-equiv="refresh" content="0;url='index.php?p=login">
		<?php }
		else
		{ ?>
			<script>alert('Maaf, password minimal 8 karakter')</script>
			<meta http-equiv="refresh" content="0;url='index.php?p=daftar'">			
		<?php }
	}
	else
	{ ?>
		<script>alert('Maaf proses pendaftaran tidak dapat dilanjutkan, konfirmasi password tidak sama')</script>
		<meta http-equiv="refresh" content="0;url='index.php?p=daftar&username=<?php echo $username;?>&pass00=<?php echo $pass00;?>&pass01=<?php echo $pass01;?>&email=<?php echo $email;?>">
	<?php }
}
else
{ ?>
	<script>alert('Maaf proses pendaftaran tidak dapat dilanjutkan, Username sudah ada, silahkan input dengan username lain')</script>
	<meta http-equiv="refresh" content="0;url='index.php?p=daftar&username=<?php echo $username;?>&pass00=<?php echo $pass00;?>&pass01=<?php echo $pass01;?>&email=<?php echo $email;?>">	
<?php } ?>