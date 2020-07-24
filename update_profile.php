<?php
require('connection.inc.php');
require('functions.inc.php');
if(!isset($_SESSION['USER_LOGIN'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}
$name=get_safe_value($con,$_POST['name']);
$uid=$_SESSION['USER_ID'];
$mobile=$_SESSION['MOBILE'];
$email=$_SESSION['EMAIL'];

mysqli_query($con,"update users set name='$name', mobile='$mobile', email='$email' where id='$uid'");
$_SESSION['USER_NAME']=$name;
$_SESSION['MOBILE']=$mobile;
$_SESSION['EMAIL']=$email;
echo "Your name updated";
?>