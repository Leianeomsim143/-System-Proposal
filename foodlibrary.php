<?php require 'connection.php';?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
			echo "<td><img src='".$row["food_picture"] . "' width='100' height='100'></td>";
			echo "<td><a href='update.php?food_id=".$row["food_id"]."'  class='btn btn-info'>Edit</a> || <button class='btn-delete'>Delete</button></td>";
			echo "</tr>";
		}
	} else{
		echo "<tr><td colspan = '7'> No records found</td></tr>";
	}
?>
</table>
<a href="addfood.php">Add Food</a>
<script>
    // JavaScript to handle deletion
    document.addEventListener('DOMContentLoaded', function () {
        // Get all delete buttons
        var deleteButtons = document.querySelectorAll('.btn-delete');

        // Add click event listener to each delete button
        deleteButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var foodId = this.getAttribute('data-food-id');

                // Remove the row from the table
                this.closest('tr').remove();
            });
        });
    });
</script>
</body>
</html>