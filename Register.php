<?php
include_once 'php/connect.php';
session_start();
?>
<html>
<head>
	<meta charset="UTF-8" />
	<title>Register -Red Packets</title>
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.6-dist/bootstrap-3.3.6-dist/css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
	<style>
		#register-panel
		{
			padding-left:-100px;
		}
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
	</style>
	<script>
	function isChecked()
	{
	 if(document.getElementById("agreementcheckBox").checked)
	 {
	 document.getElementById("submitbutton").disabled = false;
	 }
	 else
	 {
	 document.getElementById("submitbutton").disabled = true;	 
	 }
	}
	</script>
</head>
<div class="img-responsive">
<header>
<img class="img-responsive" src='img/blood_banner.jpg'></img>
</header>
<div align="left">
    <a href="Home.php">
	 <button class="btn btn-danger"> Search Blood Donor</button>
	</a>
</div>
	<legend align="center"><h3>Register as Blood donor</h3></legend>
	<?php

	 if(isset($_SESSION['success']))
	 {
		 echo "<h3 style=\"padding-bottom:800px;\"color=\"green\" align=\"center\">New record created successfully </h3>";
		 unset($_SESSION['success']);
	 }
	 ?>
	<div align="center" id="register-panel">
		<form name="registerForm" method="POST" action="php/register_panel.php">
			<input type="text" type="text" name="donarname"  placeholder="Name" value=""><br>
			<br>
			<input type="text" name="phonenumber" placeholder="Phone number"value=""><br>
			<br>
			<input type="text" name="email" placeholder="E-mail" ><br>
			<br>
			<input type="text" name="address" placeholder="Address"><br>
			<br>
			<input type="text" name="city" placeholder="City"><br>			
			<br>
			<input type="text" name="pincode" placeholder="pincode"><br>
			<br>
			<input type="text" name="facebookId" placeholder="Facebook username"value=""><br>				
			<br>
			<input type="text" name="twitterId" placeholder="Twitter handle" value=""><br>
			<br>	
		    <select class="styled-select"name="bgroups">
    			<option value="A+">A+</option>
    			<option value="A-">A-</option>
    			<option value="B+">B+</option>
    			<option value="B-">B-</option>
 				<option value="AB+">AB+</option>
 				<option value="AB-">AB-</option>
				<option value="O+">O+</option>	
				<option value="O-">O-</option>	
 				<option value="hh">hh</option>			    			
  			</select>
			<br>
			<br>
			<input id="agreementcheckBox" onchange="isChecked()" type="checkbox" checked> <label>I am eligible to be a blood donar through Red packet. I agree to Terms and conditions liable to the Organization</label>  
			<br>
			<br>
			<button id="submitbutton" class="btn btn-primary" type="submit"> Register </button>
			<button class="btn btn-primary" type="reset"> Reset </button> 
			</form>
	</div>
</div>