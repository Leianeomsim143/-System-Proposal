<?php require 'connection.php';

if(!isset($_SESSION['username'])){
    echo '<script>alert ("Please login first") ; window.location.href = "index.php"; </script>';
    exit();
}

$username = $_SESSION['username'];
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

    echo '<h1>Welcome ' .$username. '</h1>';

    ?>
    <form action="" method="post">
    <h1>Enter your BMI</h1>
    <label for="kilo">Weight (Kilogram): </label>
    <input type="number" name="weight"><br><br>
    <label for="cm">Height (Meter <sup>2</sup>): </label>
    <input type="float" name="height"><br><br>
    <button type="submit" name="submit">Submit</button><br><br>
    <?php
        if(isset($_POST['submit'])){
            $weight = $_POST['weight'];
            $height = $_POST['height'];

            if(empty($weight) || empty($height)){
                echo '<p class="text-danger" >Please enter weight and height.</p>';
            }else{
                $sql = "SELECT * FROM `bmi_users` WHERE `weight` = ? AND `height` = ?";
                $stmt = $conn->prepare($sql);
                $stmt -> bind_param("ss",$weight,$height);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
        }
        $sql = "INSERT INTO `bmi_users`( `weight`, `height`) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt -> bind_param("ss",$weight,$height);
        $stmt->execute();

          $division = $weight / $height;
          $format = number_format ($division, 2);
          echo '<script>alert ("Proceed to see your BMI and classification") ; window.location.href = "foodlibrary.php"; </script>';
    }
    ?>
    </form>
</body>
</html>