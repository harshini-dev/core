<?php 
include_once("connection.php");
session_start();

if(isset($_POST['sbmt']))
{
	$email 	  = $_POST['email'];
	$password = $_POST['password'];	
	$sele = ("SELECT * FROM student where email='$email' and password='$password' ");
	$run  = $con->query($sele);
	//echo "<pre>"; print_r($run); exit;          
	$user = $run->fetch_object();
	
		if(!empty($user))
		{
			$_SESSION['id']       = $user->id;
			$_SESSION['name']     = $user->name;
			$_SESSION['email']    = $user->email;
			$_SESSION['password'] = $user->password;
			$_SESSION['profile']  = $user->profile;

		}
		if(isset($_POST['chk'])){
			setcookie('email',$email,time()+120);
			setcookie('pwd',$password,time()+120);
		}
		if($run->num_rows > 0)
	{
		//header("location:profile1.php");
		header("location:index.php");
	}
	else
	{
		echo "<h1>Invalid User Email and Password.</h1>";		
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN With DB</title>
</head>
<body>
	<fieldset>
		<form method="POST">
		<table border="1" align="center">
			<tr>
				<td>Email</td>
				<td><input type="email" name="email" value="<?php echo @$_COOKIE['email'];?>"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="password" value="<?php echo @$_COOKIE['pwd'];?>"></td>
			</tr>
			<tr>
				<tr>
					<td colspan="2" align="center"><input type="checkbox" name="chk">keep me login ? </td>
				</tr>
				<td align="center" colspan="2">
					<button type="submit" name="sbmt">SignIn</button>
				</td>
			</tr>
		</table>
	</form>
	</fieldset>
</body>
</html>