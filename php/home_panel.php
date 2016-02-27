<?php
include_once 'connect.php';
$bloodGroup=$_POST['BGroups'];
$pinCode = $_POST['pincode'];
$city=$_POST['city'];
$sql = "select * from register where bloodgroup='$bloodGroup'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		Redirect('../Home.php', false);
        echo "Name: " . $row["name"]. " - Phone: " . $row["phone"]. " " . $row["email"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>