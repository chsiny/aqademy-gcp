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

    // Check if the username already exists in the database
    $checkUserQuery = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($checkUserQuery);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Username already exists. Please choose a different one.";
        header("Location: register.php");
        exit;
    }

    // If the username and email are unique, insert the new user into the database
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful, redirect to the login page
        $_SESSION['success'] = "Registration successful! You can now log in.";
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }
} else {
    // Invalid request method, redirect to the registration page
    header("Location: register.php");
    exit;
}

// Close the database connection
$conn->close();
?>