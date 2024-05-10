<?php include 'connection.php' ;?>

<?php
$bmi_id = isset($_GET['bmi_id']) ? $_GET['bmi_id'] : null;
    if(!$bmi_id){
        die('Invalid ID');
    }

    $sql = "DELETE FROM bmi_users WHERE bmi_id=$bmi_id";
    $conn->query($sql);

    header("Location: admin-dashboard.php");
    exit();
?>