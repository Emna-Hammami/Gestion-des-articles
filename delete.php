<?php
$servername="localhost";
$username="root";
$password="";
$dbname="souk";

//create connection
$conn=mysqli_connect($servername,$username,$password,$dbname);
//check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());}

$sql= "DELETE FROM article WHERE id =".$_REQUEST["id"];

if ($conn->query($sql)===TRUE){
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
header('Location: ./index.php');
$conn->close();
?>

