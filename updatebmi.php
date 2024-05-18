<?php include 'connection.php' ;?>
<?php 

if(!isset($_SESSION['status'])){
    echo '<script>alert ("Please login first") ; window.location.href = "index.php"; </script>';
    exit();
}

$username = $_SESSION['username'];

    ?>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $bmi_id = $_POST['bmi_id'];
        $weight = $_POST['weight'];
        $height = $_POST['height'];
        $bmi = $_POST['bmi'];

            $sql = "UPDATE bmi_users SET weight='$weight', height='$height', bmi='$bmi' WHERE bmi_id='$bmi_id'";
        

        $conn->query($sql);
        header("Location: admin-dashboard.php");
        exit();
    }

    $bmi_id = isset($_GET['bmi_id']) ? $_GET['bmi_id'] : null;
    if(!$bmi_id){
        die('Invalid ID');
    }

    $sql = "SELECT * FROM bmi_users WHERE bmi_id=$bmi_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Update BMI</title>
</head>
<body>
<form action="" method="POST" enctype="multipart/form-data" class="form-group text-center">
    <h2>Update BMI</h2>
        <input type="hidden" name="bmi_id" value="<?php echo $row['bmi_id'];?>">
        <label for="">Weight:</label>
        <input type="float" name="weight" value="<?php echo $row['weight'];?>" required><br><br>
        <label for="">Height:</label>
        <input type="float" name="height" value="<?php echo $row['height'];?>"><br><br>
        <label for="">BMI:</label>
        <input type="float" name="bmi" value="<?php echo $row['bmi'];?>"><br><br>
        <input type="submit" value="Update BMI" class="btn btn-success">
    </form>
    <a href="admin-dashboard.php" class="btn btn-danger" >Back</a>
</body>
</html>