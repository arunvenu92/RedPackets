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
    <a href="Home.php"><button class="btn btn-danger" align="right"> log out </button></a>
    <h3> <?php session_start();  echo 'Welcome '.$_SESSION['loginname'];?>
    <h3 class="panel-title" align="center">Donor Profile</h3>
  </div>
  <div class="panel-body">
    <table class="table">
   
   <?php
	include_once 'php/connect.php';
	$sql = "select * from register where phone=".$_SESSION['loginphone'];
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
		{
			 echo '<tr>';
			 echo '<td> Name </td>';
			 echo '<td>'.$row['name'].'</td>';
			 echo '</tr>';
			 echo '<tr>';
			 echo '<td> E-mail </td>';
			 echo '<td>'.$row['email'].'</td>';
			 echo '</tr>';
			 echo '<tr>';
			 echo '<td> Phone </td>';
			 echo '<td>'.$row['phone'].'</td>';
			 echo '</tr>';
			 echo '<tr>';
		}
	}
	
	 ?>	 
	</table>
  </div>
</div>
<div class="panel-body">
	    
		<?php
		include_once "php/connect.php";
		$mysqli = new mysqli("localhost", "", "", "redpackets");

		/* check connection */
		if (mysqli_connect_errno()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}

		if ($result = $mysqli->query("Select count(*) as donor from connection where donor='".$_SESSION['loginname']."'")) 
		{
			while ($row = $result->fetch_assoc()) {
				echo '<h3> Notifications '.$row['donor'].'</h3>';
			}
		}
		$mysqli->close();
		?>
		
		<div id="notification">
		<?php
		    echo $_SESSION['loginname'];
		    $mysqli = new mysqli("localhost", "", "", "redpackets");

			/* check connection */
			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			if ($result = $mysqli->query("select * from connection where donor='".$_SESSION['loginname']."'")); 
			{
				echo '<table class="table">';
				echo '<tr>';
				echo '<td> Request </td>';
				echo '<td> Click to Accept </td>';
				echo '<td> Click to Decline </td>';
				echo '<td> Click to Complete </td>';				
				echo '</tr>';
				while ($row = $result->fetch_assoc()) 
				{
					 echo '<tr>';
					 echo '<td>'.$row['acceptor'].' urgently need '.$row['bloodgroup'].'</td>';
					 echo '<td><form name="success-values" action="Profile.php" method="POST"><input type="hidden" name="acceptor" value='.$row['acceptor'].'><input type="hidden" name="AcceptedValue" value="7"><button class="btn btn-success"> Accept </button></form></td>';
					 echo '<td><form name="rejected-value" action="Profile.php" method="POST"><input type="hidden" name="acceptor" value='.$row['acceptor'].'><input type="hidden" name="RejectedValue" value="9"><button class="btn btn-danger"> Decline </button></form></td>';
					 echo '<td><form name="completed-value" action="Profile.php" method="POST"><input type="hidden" name="acceptor" value='.$row['acceptor'].'><input type="hidden" name="CompletedValue" value="100"><button class="btn btn-info"> Complete </button></form></td>';					 
					 echo '</tr>';
				}
			}
			$mysqli->close();
		?>
		<?php
		 if(isset($_POST['AcceptedValue']))
		 {
			 $acceptedvalue=$_POST['AcceptedValue']; 
			 $acceptor=$_POST['acceptor'];
			 include_once "php/connect.php";
			 $sql2 ="update connection set status='$acceptedvalue' where acceptor='$acceptor'";
			 if ($conn->query($sql2) === TRUE) 
			 {
			 echo '<h3> Accepted </h3>';
			 } 
			else 
			{
			echo "Error: " . $sql . "<br>" . $conn->error;
			}
		 }
		 if(isset($_POST['RejectedValue']))
		 {
			 include_once "php/connect.php";
			 $rejectedvalue=$_POST['RejectedValue']; 
			 $acceptor=$_POST['acceptor'];
			 include_once "php/connect.php";
			 $sql3 ="update connection set status='$rejectedvalue' where acceptor='$acceptor'";
			 if ($conn->query($sql3) === TRUE) 
			 {
			 echo '<h3> Rejected </h3>';
			 } 
			else 
			{
			echo "Error: " . $sql . "<br>" . $conn->error;
			}
		 }
		 if(isset($_POST['CompletedValue']))
		 {
			 include_once "php/connect.php";
			 $completedvalue=$_POST['CompletedValue']; 
			 $acceptor=$_POST['acceptor'];
			 include_once "php/connect.php";
			 $sql4 ="update connection set status='$completedvalue' where acceptor='$acceptor'";
			 if ($conn->query($sql4) === TRUE) 
			 {
			 echo '<h3> Completed </h3>';
			 } 
			else 
			{
			echo "Error: " . $sql . "<br>" . $conn->error;
			}
		 }
		?>
		
		</div>
	</div>
</body>
</html>