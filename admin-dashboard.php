<?php require 'connection.php';?>
<?php 

if(!isset($_SESSION['status'])){
    echo '<script>alert ("Please login first") ; window.location.href = "index.php"; </script>';
    exit();
}

$username = $_SESSION['username'];

if(isset($_POST['logout'])){
	if(isset($_SESSION['username'])){
		$username=$_SESSION['username'];
		$sql = "UPDATE `tbl_users` SET `Status` = '0' WHERE `Username` = '$username'";
		$result = mysqli_query($conn, $sql);

		header("Location:logoutadmin.php");
		exit();
	}
}


    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="bootstrap.css">
    <title>Admin Dashboard</title>
</head>
<body>
<div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                BMI Records
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_foodlibrary.php">
                                Food Library
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                Settings
                            </a>
                        </li>
						<form action="" method="POST"><br>
	<button type="submit" name="logout" value="logout" class="btn btn-danger"  onclick="return confirm('Are you sure you want to logout?')">Logout</button>
</form>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Admin Dashboard</h1>
                </div>
				<h2>BMI Records</h2>
<table border="1" class="table table-dark">
		<th>Bmi ID</th>
		<th>User ID</th>
		<th>Weight</th>
		<th>Height</th>
		<th>Overall BMI</th>
		<th>Action</th>
<?php
	        $sql = "SELECT * FROM bmi_users";
			$result = $conn->query($sql);

			if($result->num_rows > 0){
				while($row = $result -> fetch_assoc()){
			echo "<tr>";
			echo "<td>".$row["bmi_id"]."</td>";
			echo "<td>".$row["user_id"]."</td>";
			echo "<td>".$row["weight"]."</td>";
			echo "<td>".$row["height"]."</td>";
			echo "<td>".$row["bmi"]."</td>";
			echo "<td><a href='updatebmi.php?bmi_id=".$row["bmi_id"]."'  class='btn btn-info'>Edit</a> || <a href='deletebmi.php?bmi_id=".$row["bmi_id"]."'  class='btn btn-danger'>Delete</a></td>";
			echo "</tr>";
				}
			}else{
				echo "<tr><td colspan = '7'> No records found</td></tr>";
			}
?>
		</table>

		<br>
<script src="bootstrap.js"></script>
</body>
</html>