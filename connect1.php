<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "userdb";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "INSERT INTO customer_info VALUES (" . $_POST['name'] . ",'" . $_POST['email'] . "','" . $_POST['contact'] . "','" . $_POST['address'] . "','" . $_POST['pincode'] . "','" . $_POST['date'] . "')";
mysqli_query($conn, $sql);
header('location:formlist.php');
?>