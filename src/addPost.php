<?php

$servername = "mysql";
$db = "cloud_computing";
$username = "php";
$password = "php";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

// Check the database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Hash the password (you should use a more secure hash function)
    // $hashedPassword = sha1($password); // Replace with a more secure hashing method
    
    // Query the database for the user's credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, redirect to the home page
        header("Location: home.php");
        exit;
    } else {
        // User not found or password doesn't match
        echo "<script>alert('Invalid User');</script>";
    }
}

// Close the database connection
$conn->close();
?>