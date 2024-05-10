<?php include 'connection.php' ;?>

<?php
$food_id = isset($_GET['food_id']) ? $_GET['food_id'] : null;
    if(!$food_id){
        die('Invalid ID');
    }

    $sql = "DELETE FROM food_library WHERE food_id=$food_id";
    $conn->query($sql);

    header("Location: admin-dashboard.php");
    exit();
?>