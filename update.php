<?php include 'connection.php' ;?>
<?php 

if(!isset($_SESSION['status'])){
    echo '<script>alert ("Please login first") ; window.location.href = "index.php"; </script>';
    exit();
}

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

    ?>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $food_id = $_POST['food_id'];
        $food_name = $_POST['food_name'];
        $food_calories = $_POST['food_calories'];
        $food_carbohydrates = $_POST['food_carbohydrates'];
    
        if($_FILES['photo']['size'] > 0){
            $old_photo_path = $row['food_picture'];
            unlink($old_photo_path);

            $photo_path = 'Foodpictures/' . $_FILES['photo']['name'];
            move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path);

            $sql = "UPDATE food_library SET food_name ='$food_name', food_calories='$food_calories', food_carbohydrates='$food_carbohydrates', food_picture='$photo_path' WHERE food_id='$food_id'";
        } else{
            $sql = "UPDATE food_library SET food_name ='$food_name', food_calories='$food_calories', food_carbohydrates='$food_carbohydrates' WHERE food_id='$food_id'";
        }

        $conn->query($sql);
        header("Location: foodlibrary.php");
        exit();
    }

    $food_id = isset($_GET['food_id']) ? $_GET['food_id'] : null;
    if(!$food_id){
        die('Invalid ID');
    }

    $sql = "SELECT * FROM food_library WHERE food_id=$food_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="food_id" value="<?php echo $row['food_id'];?>">
        <label for="">Food Name:</label>
        <input type="text" name="food_name" value="<?php echo $row['food_name'];?>" required><br><br>
        <label for="">Food Calories:</label>
        <input type="text" name="food_calories" value="<?php echo $row['food_calories'];?>"><br><br>
        <label for="">Food Carbohydrates:</label>
        <input type="text" name="food_carbohydrates" value="<?php echo $row['food_carbohydrates'];?>"><br><br>
        <label for="">Food Photo:</label>
        <input type="file" name="photo"><br><br>
        <input type="submit" value="Update Food">
    </form>
</body>
</html>