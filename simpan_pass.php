<?php 
error_reporting(0);
include "koneksi.php";
$id=$_POST['id'];
$usr=$_POST['username'];
$pass00=$_POST['pass00'];
$pass01=$_POST['pass01'];
$tampil=mysql_query("select* from tb_user where username='$usr' and password='$pass00'");
$baris=mysql_fetch_array($tampil);
if (!empty($usr) and !empty($pass00) and !empty($pass01))
{
	if (strlen($pass01)>=8)
	{
		if ($baris['username']==$usr && $baris['password']==$pass00)
		{
			mysql_query("update tb_user set password='$pass01' where username='$usr'");?>
			<meta http-equiv="refresh" content="0;url=index.php?p=home&id=<?php echo $id;?>">
			<script>alert('Password baru telah disimpan')</script>
		<?php }
		else
		{ ?>
			<script>alert('Username dan password lama tidak cocok')</script>
			<meta http-equiv="refresh" content="0;url=index.php?p=ganti_pass&id=<?php echo $id;?>">
		<?php }
	}
	else
	{ ?>
		<script>alert('Password minimal 8 karakter')</script>
		<meta http-equiv="refresh" content="0;url=index.php?p=pass&id=<?php echo $id;?>">
	<?php } 
} 
else
{ ?>
	<script>alert('Silahkan masukkan username, password lama dan password baru anda')</script>
	<meta http-equiv="refresh" content="0;url=index.php?p=pass&id=<?php echo $id;?>">
<?php }?>