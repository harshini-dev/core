<?php
session_start();
if(isset($_POST["submit"]))
{
	$_SESSION["user"]     = $_POST["user"];              //for session
	$_SESSION["password"] = $_POST["password"];			//for session

	$user = $_POST["user"];						//for cookie
	$password = $_POST["password"];						//for cookie

	

	if($_SESSION["user"] == "naresh" && $_SESSION["password"] == 123)
	{
		if(isset($_POST["keep_login"]))
		{
			setcookie("user",$user,time()+86400);
			setcookie("password",$password,time()+86400);
	    }
		header("location:profile.php");
	}
	else
	{
		echo"<h2>Invalid username or Password </h2>";
	}
}
?>

<html>
<head>
	<title>Log-in</title>
</head>
	<body>
		<form method="POST">
			<fieldset>
			<table border="2" align="center" cellpadding="10">
				<tr>
				<th>Username:</th>
				<td><input type="text" name="user" value="<?php echo @$_COOKIE["user"];?>"></td>
				</tr>
				<tr>
					<th>Password:</th>
					<td><input type="password"  name="password" value="<?php echo @$_COOKIE["password"]; ?>"></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="checkbox"  name="keep_login" value="chk1">Keep Me Login</td>            <!-- for Cookie-->
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" id="submit" name="submit" value="Login">   </td>
				</tr>
				<tr>
					<td colspan="2" align="center"> <a href="reg.php">Create a new Account ?</a></td>
				</tr>
			</table>
		</fieldset>
		</form>
	</body>
</html>
