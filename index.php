<?php require 'connection.php';?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.css">
    <title>Log In</title>
</head>
<body>
  <div class="log-forms">
    <form action="" method="post" class="form-group text-center" style="border: none; width:100%;">
    <h1>Client Log In</h1>
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
        $_SESSION['user_id'] = @$row['user_id'];
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

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `tbl_users` WHERE `user_id` = '$user_id'";
$result = mysqli_query($conn, $sql);
}
}
?>
    <label for="username">Username: </label>
    <input type="text" name="user"><br><br>
    <label for="password">Password: </label>
    <input type="password" name="pass"><br><br>
    <button type="submit" name="submit" class="btn btn-outline-success">Submit</button><br><br>
    <p>Not have an account? <a href="register.php" class="btn btn-outline-info">Register </a></p>
    <p>Log in as Admin? <a href="admin.php" class="btn btn-outline-success">Login </a></p>
    </form>
    </div>
    <div id="carouselExample" class="carousel slide">
  <div class="carousel-inner">
    <div class="carousel-item active c-item">
      <img src="notebooks-top-each-other-with-plan-goals_185193-146970.webp" class="d-block c-img" alt="...">
    </div>
    <div class="carousel-item c-item">
      <img src="premium_photo-1682435533755-273aec988f08.jpg" class="d-block c-img" alt="...">
    </div>
    <div class="carousel-item c-item">
      <img src="photo-1494597564530-871f2b93ac55.jpg" class="d-block c-img" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
    <script src="bootstrap.js"></script>
</body>
</html>

<style>
  .c-item{
    height: 480px;
  }

  .c-img{
    height: 100%;
    width: 100%;
    object-fit: cover;
    filter: brightness(0.6);
  }

  input{
		font-size: 18px;
		border: 1px solid;
		border-radius: 3px;
		padding: 3px 5px 3px 5px;
		transition: 1s;
	}

	input:hover{
		box-shadow: 3px 3px 5px 3px black;
	}

  
</style>