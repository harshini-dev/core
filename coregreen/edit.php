<?php

include("connection.php");

$cities=$con->query("select city from student");

$row=$con->query("select * from student");

if(isset($_GET["student_id"])){
	$del_id=$_GET["student_id"];
	$delete="delete from student where id='$del_id' ";
	$con->query($delete);
	header("insert.php");
}

if(isset($_GET["edit_student"])){
	$edit_id=$_GET["edit_student"];
	$edit="select * from student where id='$edit_id' ";
	$user=$con->query($edit);
	$user_info=$user->fetch_object();
	//print_r($user_info);exit;
	$hobby=explode(',',$user_info->hobby);
	//print_r($hobby);exit;
}


if(isset($_POST["update"])){
	$edit_id = $_GET["edit_student"];
	$name    = $_POST["name"];
	$email   = $_POST["email"];
	$address = $_POST["address"];
	$phone   = $_POST["phone"];
	$gender  = $_POST["gender"];
	@$hobby1 = implode(",",$_POST["hobby"]);
	$city    = $_POST["city"];
	$file    = $_FILES["fileimage"]["name"];
	//print_r($file);
	$explode =explode(".","$file");
	$extension=end($explode);
	$move="uplode/$file";

	//implode(",",$_POST['hobby']);

	if(strtoupper($extension)== "JPG" || strtoupper($extension)=="JPEG" || strtoupper($extension)=="PNG" || strtoupper($extension)=="GIF")  {
		move_uploaded_file($_FILES['fileimage']['tmp_name'], $move);
	}

	 $update="update student set name='$name',email='$email',address='$address',phone='$phone',gender='$gender',hobby='$hobby1',file='$file' where id='$edit_id' ";
	
	$run=$con->query($update);
	if(!empty($run)){
		echo"<h1>Data Updated Successfully</h1>";
		//header("location:edit.php");
	}else{
		echo"<h1>Something went wrong</h1>";
	}
	//print_r($run);
}


?>





<html>
<head><title>Form</title></head>
<body>
	<form method="post" enctype="multipart/form-data">
		<table align="center" border="1" cellpadding="10" cellspacing="0">
			<tr>
				<td>Name</td>
				<td><input type="text" name="name" value="<?php echo $user_info->name;?>"></td>
			</tr>
			<tr>
				<td>Email</td>
				<td><input type="email" name="email" value="<?php echo $user_info->email;?>"></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><textarea name="address" id="address"><?php echo $user_info->address;?></textarea></td>
			</tr>
			<tr>
				<td>Phone Number</td>
				<td><input type="number" name="phone" id="phone" value="<?php echo $user_info->phone;?>"></td>
			</tr>
			<tr>
				<td>Gender</td>
				<td>
					<?php
					$check_m='';
					$check_f='';
					if($user_info->gender == 'male'){
						$check_m='checked';
					}
					if($user_info->gender == 'female'){
						$check_f='checked';
					}

					?>
					<input type="radio" <?php echo $check_f;?> name="gender" id="radio1" value="female">Female
					<input type="radio" <?php echo $check_m;?> name="gender" id="radio2" value="male">Male
				</td>
			</tr>
			<tr>
				<td>Hobby</td>
				<td>
					<input type="checkbox" name="hobby[]" value="singing"
					<?php 
					if(in_array('singing',$hobby)){
						?>
						checked
						<?php
					}
					?>>Singing
					<input type="checkbox" name="hobby[]" value="reading"
					<?php 
					if(in_array('reading',$hobby)){
						?>
						checked
						<?php
					}

					?>>Reading
				</td>
			</tr>
			<tr>
				<td>City</td>
				<td><select name="city" id="city">
					<option value="">Select City</option>
					<option value="ahm" <?php if($user_info->city=='ahm'){echo 'selected';}?>>Ahmedabad</option>
					<option value="surat" <?php if($user_info->city=='surat'){echo 'selected';}?>>Surat</option>
					<option value="baroda" <?php if($user_info->city=='baroda'){echo 'selected';}?>>Baroda</option>
					<option value="junagath" <?php if($user_info->city=='junagath'){echo 'selected';}?>>Junagath</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="file" name="fileimage">
				<img src="uplode/<?php echo $user_info->file;?>" height="50" width="50">
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" name="update" value="Update">
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
		<td><img src="uplode/<?php echo $rows['file'];?>" height="100" width="100"></td>
		<td><a href="edit.php?edit_student=<?php echo $rows['id'];?>">Edit</td>
		<td><a href="edit.php?student_id=<?php echo $rows['id'];?>">Delete</td>
	</tr>
	<?php }?>
</table>
</body>
</html>


