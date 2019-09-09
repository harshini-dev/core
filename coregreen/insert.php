<?php

include("connection.php");

$row=$con->query("select * from student");

if(isset($_GET["student_id"])){
	$del_id=$_GET["student_id"];
	$delete="delete from student where id='$del_id' ";
	$con->query($delete);
	header("insert.php");
}

if(isset($_POST["submit"])){

	$name=$_POST["name"];
	$email=$_POST["email"];
	$address=$_POST["address"];
	$phone=$_POST["phone"];
	$gender=$_POST["gender"];
	@$hobby=implode(",",$_POST["hobby"]);
	$city=$_POST["city"];
	$file=$_FILES['fileimage']['name'];
	$explode=explode('.',$file);
	$extension=end($explode);
	//print_r($explode);exit;
	$move="uplode/$file";
	//print_r($move);
	if(strtoupper($extension)== "JPG" || strtoupper($extension)=="JPEG" || strtoupper($extension)=="PNG" || strtoupper($extension)=="GIF")  {
		move_uploaded_file($_FILES['fileimage']['tmp_name'], $move);
	}


	$insert="insert into student (name,email,address,phone,gender,hobby,city,file) values('$name','$email','$address','$phone','$gender','$hobby','$city','$file')";
	$run=$con->query($insert);
	if(!empty($run)){
		echo"<h1>Data Inserted Successfully</h1>";
	}else{
		echo"<h1>Something went wrong</h1>";
	}
	//print_r($run);
}


?>





<html>
<head><title>Form</title></head>
<body>
	<form method="post" enctype="multipart/form-data" action="insert.php">
		<table align="center" border="1" cellpadding="10" cellspacing="0">
			<tr>
				<td>Name</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" name="email"></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><textarea name="address" id="address"></textarea></td>
			</tr>
			<tr>
				<td>Phone Number</td>
				<td><input type="number" name="phone" id="phone"></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td>
					<input type="radio" name="gender" id="radio1" value="female">Female
					<input type="radio" name="gender" id="radio2" value="male">Male
				</td>
			</tr>
			<tr>
				<td>Hobby</td>
				<td>
					<input type="checkbox" name="hobby[]" id="check1" value="singing">Singing
					<input type="checkbox" name="hobby[]" id="check2" value="reading">Reading
				</td>
			</tr>
			<tr>
				<td>City</td>
				<td><select name="city" id="city">
					<option value="">Select City</option>
					<option value="ahm">Ahmedabad</option>
					<option value="surat">Surat</option>
					<option value="baroda">Baroda</option>
					<option value="junagath">Junagath</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="file" name="fileimage">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="submit" value="Submit">
			</td>
		</tr>
	</table>
</form>
<br/>
<br/>

<table border="1" align="center" cellspacing="0" cellpadding="10">
	<tr>
		<td>Id</td>
		<td>Name</td>
		<td>Email</td>
		<td>Address</td>
		<td>Phone Number</td>
		<td>Gender</td>
		<td>Hobby</td>
		<td>City</td>
		<td>Image</td>
		<td colspan="2" align="center">Action</td>
	</tr>
	<?php
	foreach($row as $rows){
	?>
	<tr>
		<?php 
		//echo "<pre>";
		//print_r($rows)?>
		<td><?php echo $rows['id'];?></td>
		<td><?php echo $rows['name'];?></td>
		<td><?php echo $rows['email'];?></td>
		<td><?php echo $rows['address'];?></td>
		<td><?php echo $rows['phone'];?></td>
		<td><?php echo $rows['gender'];?></td>
		<td><?php echo $rows['hobby'];?></td>
		<td><?php echo $rows['city'];?></td>
		<td><img src="uplode/<?php echo $rows['file'];?>" height="50" width="50"></td>
		<td><a href="edit.php?edit_student=<?php echo $rows['id'];?>">Edit</td>
		<td><a href="insert.php?student_id=<?php echo $rows['id'];?>">Delete</td>
	</tr>
	<?php }?>
</table>
</body>
</html>


