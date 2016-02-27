<!DOCTYPE html>
<!-- Website template by freewebsitetemplates.com -->
<html>
<head>
	<meta charset="UTF-8" />
	<title>Red Packets</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
	<style>
		.styled-select select {
		   background: transparent;
		   width: 268px;
		   padding: 5px;
		   font-size: 16px;
		   line-height: 1;
		   border: 0;
		   border-radius: 0;
		   height: 34px;
		   -webkit-appearance: none;
		 }
	#panel-format
	{
		float:left;
		padding-left:100px;
		padding-right:100px;
		padding-top:20px;
	}
	#button-format{
		padding-left:50px;
		padding-bottom:50px;
	}
	#donor-panel{
		float:right;
		padding-left:100px;
		padding-right:100px;
		padding-top:20px;
	}
	</style>
</head>
<div>
    <header>
	   <img class="img-responsive" src='img/blood_banner.jpg'></img>
	   <h3 align="center" color="red"> Welcome to RedPackets </h3> 
	</header>
</div>
<div align="right">
    <a href="Register.php">
	 <button class="btn btn-danger"> Register to Red Packet </button>
	</a>
</div>
<div id="parent-format">
<div id="panel-format" align="left">
		<form name="query-data-form" method="POST" action="Result.php">
			<!--<div class="panel panel-default">
					<div class="panel-body">-->
						<legend><h3>Search for a donor</h3></legend>
						<input type="text" name="acceptorname" placeholder="Enter your name" required>
						<br>
						<br>
						<input type="text" name="phonenumber" placeholder="Phone Number" required>
						<br>
						<br>
						<input type="text" name="email" placeholder="Enter e-mail" required>
						<br>
						<br>
						<select class="styled-select" name="BGroups">
						<option value="A+">A+</option>
						<option value="A-">A-</option>
						<option value="B+">B+</option>
						<option value="B-">B-</option>
						<option value="AB+">AB+</option>
						<option value="AB-">AB-</option>
						<option value="O+">O+</option>
						<option value="O-">O-</option>
						<option value="hh">hh</option>			    			
					</select><br>
					<br>
					<input type="text" name="pincode" placeholder="Enter the pincode"><br>
					<br>
					<input type="text" name="city" placeholder="Enter the city">
					<br>
					<br>
					<button class="btn btn-primary" type="submit"> Submit </button>
				    <button class="btn btn-primary" type="reset">Reset </button>
		  </form>
	</div>
	 <div id="donor-panel" align="right" >
	 <legend align="center"><h3>Login as blood donor</h3></legend>
			<form name="donor-login" action="Home.php" method="POST">
				<input type="text" name="donarphone" placeholder="Phone number"value="" required><br>
				<br>
				<input type="text" name="donarmail" placeholder="E-mail" required><br>
				<br>			
				<button class="btn btn-primary" type="submit"> Login </button>
				<button class="btn btn-primary" type="reset"> Reset </button> 
			</form>
    </div>
</div>

</html>
<?php
session_start();
if(isset($_POST['hiddenvalue']) && isset($_POST['mailcontent']) && isset($_POST['hiddenbloodgroup']))
{
	$bloodGroup = $_POST['hiddenbloodgroup'];
	$to = $_POST['hiddenvalue'];
	$subject = "Urgently needed".$bloodGroup."Blood Group-Sent from Red Packet";
	$txt = $_POST['mailcontent'];
	$headers = "From: webmaster@example.com" . "\r\n" .
		"CC: somebodyelse@example.com";

	//$sentmail = mail($to,$subject,$txt,$headers);
	//$mail=$_POST['hiddenvalue'];
	//echo $mail;	
	//echo $bloodGroup;
	//if($sentmail)
	//{
	//	echo 'Successfully sent mail to  '.$to;
	//}
}

if(isset($_POST['donarmail']) && isset($_POST['donarphone']))
{
	include_once 'php/connect.php';
	$donarmail = $_POST['donarmail'];
	$donarphone = $_POST['donarphone'];
	$sql = "select * from register where phone=".$donarphone;
	$result = $conn->query($sql);
	echo $result->num_rows;
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
			if($row['phone'] == $donarphone && $row['email']== $donarmail)
			{
				$_SESSION['loginname'] =$row['name'];
				$_SESSION['loginphone'] =$row['phone'];
				header('Location:Profile.php');
				echo '<h1>Login success</h1>';
			}
			else
			{
				echo 'Authentication failed';
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
			echo 'success';
		}
	
	}	
}



?>