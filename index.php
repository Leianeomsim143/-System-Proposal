<?php require 'connection.php';?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <h1>Log In</h1>
    <?php


if(isset($_POST['submit'])){
    $users = $_POST['user'];
    $passs = $_POST['pass'];

if(empty($users) || empty($passs)){
    echo '<p class="text-danger" >Please enter username and password.</p>';
}else{
$sql = "SELECT * FROM `tbl_users` WHERE `username` = ? AND `password` = ?";
$stmt = $conn->prepare($sql);
$stmt -> bind_param("ss",$users,$passs);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();


if ($passs != @$row['password'] && $users != @$row['username']) {
    
  echo '<p class="text-danger" >Incorrect Credentials, Please try again!</p>';
}else{
    

    if($row['status'] == 0){
        $query = "UPDATE `tbl_users` SET `status` = '1' WHERE `username` = '$users'";
        $stmts=$conn->prepare($query);
        $stmts->execute();
        $_SESSION['username'] = @$row['username'];
        $_SESSION["status"] = @$row["status"];
        header ("Location: Dashboard.php");
    }else{

        $username = $_SESSION['username'];
        $sql = "SELECT * FROM `tbl_users` WHERE `username` = '$username'";
        $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
            if($row['status'] == 1){
        echo '<script>alert ("This account is already logged in. Please create or log in another account.") ; window.location.href = "index.php"; </script>';
            exit();
}
}
    }
header("Location:Dashboard.php");
exit();
}
}
}
?>
    <label for="username">Username: </label>
    <input type="text" name="user"><br><br>
    <label for="password">Password: </label>
    <input type="password" name="pass"><br><br>
    <button type="submit" name="submit">submit</button>
    <a href="register.php">Register</a>
    </form>
</body>
</html>