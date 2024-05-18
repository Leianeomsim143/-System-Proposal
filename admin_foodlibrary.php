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

		header("Location:logout.php");
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
    <title>Admin FoodLibrary</title>
</head>
<body>
<div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="admin-dashboard.php">
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
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Admin Dashboard</h1>
                </div>
<table border="1" class="table table-dark">
	<b>
	<h2>Food Library</h2>
		<th>Food ID</th>
		<th>User ID</th>
		<th>Food Name</th>
		<th>Food Calories</th>
		<th>Food Carbohydrates</th>
		<th>Food Picture</th>
		<th>Action</th>

        <?php
        $sql = "SELECT * FROM food_library";
        $result = $conn->query($sql);


	if($result->num_rows > 0){
		while($row = $result -> fetch_assoc()){
			echo "<tr>";
			echo "<td>".$row["food_id"]."</td>";
			echo "<td>".$row["user_id"]."</td>";
			echo "<td>".$row["food_name"]."</td>";
			echo "<td>".$row["food_calories"]."</td>";
			echo "<td>".$row["food_carbohydrates"]."</td>";
			echo "<td><img src='" .$row['food_picture'] . "' width='100' height='100'></td>";
			echo "<td><a href='update.php?food_id=".$row["food_id"]."'  class='btn btn-info'>Edit</a> || <a href='deleteadmin.php?food_id=".$row["food_id"]."'  class='btn btn-danger'>Delete</a></td>";
			echo "</tr>";
		}
	} else{
		echo "<tr><td colspan = '7'> No records found</td></tr>";
	}
?>
</table>
<br>
<form action="" method="POST"><br>
	<button type="submit" name="logout" value="logout" class="btn btn-danger"  onclick="return confirm('Are you sure you want to logout?')">Logout</button>
	<script src="bootstrap.js"></script>

</body>
</html>