<?php
$host = "localhost:3307";
$username = "root";
$password = "";
$database = "userdb";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get all form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];
    $date = $_POST['date'];

    // All your existing validations remain the same...

    // First check if email already exists
    $checkEmail = "SELECT * FROM customer_info WHERE email = ?";
    $stmt = $conn->prepare($checkEmail);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<script>alert('This email is already registered');
        window.location.href='form1.html';</script>";
        exit();
    }

    // Then check if phone number already exists
    $checkPhone = "SELECT * FROM customer_info WHERE contact = ?";
    $stmt = $conn->prepare($checkPhone);
    $stmt->bind_param("s", $contact);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        echo "<script>alert('This phone number is already registered');
        window.location.href='form1.html';</script>";
        exit();
    }

    // If all checks pass, insert the data
    $sql = "INSERT INTO customer_info (name, email, contact, address, pincode, date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $email, $contact, $address, $pincode, $date);
    
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful');
        window.location.href='form1.html';</script>";
    } else {
        echo "<script>alert('Error occurred during registration');
        window.location.href='form1.html';</script>";
    }
    
    $stmt->close();
}
$conn->close();
?>