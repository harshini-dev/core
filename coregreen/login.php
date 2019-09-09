<?php

if(isset($_POST["login"])){

	$email    = $_POST["email"];
	$password = $_POST["password"];
	$login    = "select * from student where email='$email' and password='$password' ";
	$run      = $con->query($login);
	$user     = $run->fetch_object();

	if(!empty($user)){
		$_SESSION['id']       = $user->id;
		$_SESSION['email']    = $user->email;
		$_SESSION['password'] = $user->password;
	}
	if($run->num_rows > 0){
		header("location:insert.php");
	}else{

		echo"<h1>Email Or Password Are Not Match</h1>";
	}
}

?>
<html>
<head><title>Login Greencubes</title></head>
<body>
	<form>
		<table border="1" align="center" cellpadding="10" cellspacing="0">
			<tr>
				<td>
					<input type="Email" name="email" placeholder="Email">
				</td>
			</tr>
			<tr>
				<td>
					<input type="password" name="password" placeholder="Password">
				</td>
			</tr>
			<tr>
				<td align="center">
					<input type="submit" name="login">
				</td>
			</tr>
		</table>

	</form>
</body>
</html>