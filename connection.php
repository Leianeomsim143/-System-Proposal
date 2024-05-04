
<?php

session_start();


$servername='localhost';
$username='root';
$password='';
$dbname = "fitness_plan_db";

$conn=new mysqli($servername,$username,$password,"$dbname");
if($conn->connect_error){
   die('Could not Connect My Sql:' . $conn->connect_error);
}

?>