<?php require 'connection.php';

if(!isset($_SESSION['status'])){
    echo '<script>alert ("Please login first") ; window.location.href = "index.php"; </script>';
    exit();
}

$user_id = $_SESSION['user_id'];

    ?>
<?php 

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $food_name = $_POST['food_name'];
    $food_calories = $_POST['food_calories'];
    $food_carbohydrates = $_POST['food_carbohydrates'];

    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $photo_name = $_FILES['photo']['name'];
        $photo_tmp = $_FILES['photo']['tmp_name'];
        $photo_path = 'Foodpictures/' . $photo_name;

        if(move_uploaded_file($photo_tmp, $photo_path)){
            // Use the photo name after moving the file
            $sql = "INSERT INTO food_library (food_name, user_id, food_calories, food_carbohydrates, food_picture)
                    VALUES ('$food_name', '$user_id', '$food_calories', '$food_carbohydrates', '$photo_path')";
            
            
            if($conn->query($sql)){
                header("Location: foodlibrary.php");
                exit();
            } else {
                echo "Error: ". $sql. "<br>" .$conn->error;
            }
        } else {
            echo "Error uploading file";
        }
    } else {
        echo "No files uploaded or an error occurred.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Add Food</title>
</head>
<body class="bg-dark">
    <h1 style="text-align: center; color: white;">Add Food</h1><br><br>
    <div class="for-group" style="display: flex; justify-content: center; align-items: center;">
        <form action="" method="POST" enctype="multipart/form-data" style="color: white;">
            <label for="">Food Name: </label>
            <input type="text" name="food_name" required><br><br>
            <label for="">Food Calories: </label>
            <input type="text" name="food_calories" required><br><br>
            <label for="">Food Carbohydrates: </label>
            <input type="text" name="food_carbohydrates" required><br><br>
            <input type="file" name="photo" required><br><br>
            <input type="submit" value="Add Food">
        </form>
    </div>
    <br><br><br>
    <a href="foodlibrary.php" class="btn btn-outline-info">Back</a>
</body>
</html>
