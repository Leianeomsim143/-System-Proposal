<?php include 'connection.php' ?>
<?php 

  if(isset($_POST['submit'])){
    $users = $_POST['user'];
    $passs = $_POST['pass'];
    $lnames = $_POST['lname'];
    $fnames = $_POST['fname'];
    $mnames = $_POST['mname'];
    $user_type = $_POST['user_type'];

    $query = "SELECT * FROM `tbl_users` WHERE `username` = '$users'";
    $stmts = $conn->prepare($query);
    $stmts->execute();
    $result = $stmts->get_result();
    $row = $result->fetch_assoc();

    if($users == @$row['username']){

      echo '<p class="text-danger">User already exist! Please try another username!</p>';


    }else{

    $sql = "INSERT INTO `tbl_users`( `username`, `password`, `lastname`, `firstname`, `middlename`, `user_type`) VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt -> bind_param("ssssss",$users,$passs,$lnames,$fnames,$mnames,$user_type);
    $stmt->execute();
    
    if($user_type == 'user'){
      echo '<script>alert ("Register Successfully!") ; window.location.href = "index.php"; </script>';
    }elseif($user_type == 'admin'){
      echo '<script>alert ("Register Successfully!") ; window.location.href = "admin.php"; </script>';
    }else{
      echo '<script>alert ("Error") ; window.location.href = "register.php"; </script>';
    }

  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="post" class="form-group">
<h2>SIGN UP!</h2>
      <label for="user">Username: <span class="required-indicator">
      <input type="text" name="user" id="user" placeholder="Username" required><br><br>

      <label for="pass">Password: <span class="required-indicator">
      <input type="password" name="pass" id="pass" placeholder="Password" required><br><br>

      <label for="fname">Firstname: <span class="required-indicator">
      <input type="text" name="fname" id="fname" placeholder="Firstname" required><br><br>

      <label for="mname">Midname: <span class="required-indicator">
      <input type="text" name="mname" id="mname" placeholder="Midname" required><br><br>

      <label for="lname">Lastname: <span class="required-indicator">
      <input type="text" name="lname" id="lname" placeholder="Lastname" required><br><br>

      <select name="user_type" id="">
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select>

      <br><br>

      <input type="checkbox" onclick="myFunction()">Show Password<br><br>

        <button type="submit" name="submit" class="btn btn-success">REGISTER</button><br><br>
        <p>Already have an account? <a href="index.php" class="btn btn-outline-info">Login Here</a></p>
    </form>

    <script>
function myFunction() {
  var x = document.getElementById("pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

</body>
</html>
