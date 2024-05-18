<?php require 'connection.php';?>
<?php

if(!isset($_SESSION['status'])){
    echo '<script>alert ("Please login first") ; window.location.href = "index.php"; </script>';
    exit();
}

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Food Library</title>
</head>
<body>
<table border="1" class="table table-dark">
	<b>
		<th>Food ID</th>
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
			echo "<td>".$row["food_name"]."</td>";
			echo "<td>".$row["food_calories"]."</td>";
			echo "<td>".$row["food_carbohydrates"]."</td>";
			echo "<td><img src='".$row["food_picture"]."' width='100' height='100'></td>";
			echo "<td><a href='update.php?food_id=".$row["food_id"]."'  class='btn btn-info'>Edit</a> || <button class='btn btn-danger'>Delete</button></td>";
			echo "</tr>";
		}
	} else{
		echo "<tr><td colspan = '7'> No records found</td></tr>";
	}
?>
</table>
<a href="addfood.php">Add Food</a>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var deleteButtons = document.querySelectorAll('.btn-danger');

        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Remove the row from the table
                this.closest('tr').remove();
            });
        });
    });
</script>

<a href="dashboard.php" class="btn btn-danger" >Back</a>
</body>
</html>