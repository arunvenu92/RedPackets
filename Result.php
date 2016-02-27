<html>
<head>
	<meta charset="UTF-8" />
	<title>Register -Red Packets</title>
	<link rel="stylesheet" type="text/css" href="bootstrap-3.3.6-dist/bootstrap-3.3.6-dist/css" />
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
	<style>
		#donor-panel
		{
			padding-left:-100px;
		}
	</style>
</head>
<body>
<header>
<div >
<img class="img-responsive" width="100%" src='img/blood_banner.jpg'></img>
</div>
</header>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title" align="center">Donor Profile</h3>
  </div>
 <div class="panel-body">
   <table class="table">
	<?php
	
   if(isset($_POST['BGroups']) && isset($_POST['pincode']) && isset($_POST['city']) && isset($_POST['acceptorname']))
	{
		include_once 'php/connect.php';
		$acceptorname = $_POST['acceptorname'];
	    $acceptoremail= $_POST['email'];
	    $acceptorphone= $_POST['phonenumber'];
		$bloodGroup=$_POST['BGroups'];
		$pinCode = $_POST['pincode'];
		$city=$_POST['city'];
		
		$sql = "select * from register where bloodgroup='$bloodGroup'";
		
		$result = $conn->query($sql);	
		if ($result->num_rows > 0) 
		{
			// output data of each row
			echo'<div class="table-responsive">          
				  <table class="table">
					<thead>
					  <tr>
						<th>Name</th>
						<th>Phone</th>
						<th>E-mail</th>
						<th>Connect with facebook</th>
					 </tr>
					</thead>';
			while($row = $result->fetch_assoc()) 
			{
				echo'<tr>';
				echo '<td>'.$row["name"].'</td>';
				echo '<td>'.$row["phone"].'</td>';
				echo '<td><form method="POST" action="Home.php"> <input type="text" name="mailcontent"><br><br><input type="hidden" name="hiddenbloodgroup" value='.$bloodGroup.'><input name="hiddenvalue" type="hidden" value='.$row["email"].'><button type="submit" class="btn btn-primary">Send mail to '.$row["email"].'</button></form></td>';
				echo '<td><a href="https://www.facebook.com/'.$row["facebook"].'"><button class="btn btn-primary">Connect with facebook</button></a></td>';
				echo '<td><form name="acdconnect" method="POST" action="Result.php"><input type="hidden" name="acceptormail" value='.$acceptoremail.'><input type="hidden" name="acceptorphone" value='.$acceptorphone.'><input type="hidden" name="acceptorname"  value='.$acceptorname.'><input type="hidden" name="donorname" value='.$row["name"].'><input type="hidden" name="blood" value='.$bloodGroup.'><button class="btn btn-danger" type="submit"> Request </button> </form></td>';
			}
			
			echo '</table>';
			echo '</div>';
			echo '</div>';
		} 
		else 
		{
			echo "0 results";
		}
	}

		if(isset($_POST['donorname']) && isset($_POST['acceptorphone']) && isset($_POST['acceptorname']) && isset($_POST['blood']))
		{
			include_once 'php/connect.php';
			//echo $_POST['blood'];
			//echo $_POST['acceptormail'];
			$donorname = $_POST['donorname'];
			$acceptoremail = $_POST['acceptormail'];
			$accname = $_POST['acceptorname'];
			$blood = $_POST['blood'];
			$acceptorphone = $_POST['acceptorphone'];
			$sql = "INSERT INTO connection VALUES('$accname',$acceptorphone,'$donorname','$blood',1)";

			if ($conn->query($sql) == TRUE) 
			{
				echo '<h3> Sent request Successfully </h3>';
			} 
			else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			}	

			$phoneNumber =$_POST['acceptorphone'];
			$sql = "INSERT INTO acceptor VALUES('$accname',$phoneNumber,'$acceptoremail')";

			if ($conn->query($sql) == TRUE) 
			{
			} 
			else 
			{
				echo "Error: " . $sql . "<br>" . $conn->error;
			}	
		}

?>	 
	</table>
  </div>
</div>
</body>
</html>
