<?php
//include('php\connect.php');
include_once 'connect.php';
$name=$_POST['donarname'];
$phone = $_POST['phonenumber'];
$email=$_POST['email'];
$address =$_POST['address'];
$city=$_POST['city'];
$pincode=$_POST['pincode'];
$fb=$_POST['facebookId'];
$twitterId=$_POST['twitterId'];
$bloodGroup = $_POST['bgroups'];
$sql = "INSERT INTO register VALUES('$name',$phone,'$email','$fb','$twitterId','$bloodGroup')";
	if ($conn->query($sql) === TRUE) {
		require('../Register.php');
		echo "<h3 style=\"padding-bottom:800px;\"color=\"green\" align=\"center\">New record created successfully </h3>";
	} 
	else {
    echo "Error: " . $sql . "<br>" . $conn->error;
	}
$sql2 ="INSERT INTO address VALUES($phone,'$address',$pincode,'$city')";
if ($conn->query($sql2) === TRUE) {
	    $_SESSION['success']="success";
	   
		//set_time_limit(5); 
		header("Location: ../Register.php");
	} 
	else {
    echo "Error: " . $sql . "<br>" . $conn->error;
	}
/*	$sql = "SELECT * FROM register where name='John'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) 
	{
    // output data of each row
		while($row = $result->fetch_assoc()) 
		{
        echo "Name: " . $row["name"]. " - phone: " . $row["phone"]. "-email " . $row["email"]. "<br>";
		}
	} 
	else {
    echo "0 results";
	}	*/
?>