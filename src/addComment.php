<?php
session_start(); // Start the session

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
    // Check if the username session variable is set
    if (isset($_SESSION['username'])) {
        // Get the username from the session
        $username = $_SESSION['username'];
        $title = $_POST["title"];
        $content = $_POST["content"];
        $postId = $_POST["postId"]
        
        // Set time
        $timezone = 'Australia/Brisbane';
        $timestamp = time();
        $datetime = new \DateTime("now", new \DateTimeZone($timezone));
        $datetime->setTimestamp($timestamp);
        $datetime_str = $datetime->format('Y-m-d H:i:s');
        
        // Insert the post into the database
        $sql = "INSERT INTO comments (title, username, content, datetime, postId) VALUES ('$title', '$username', '$content', '$datetime_str', '$postId')";
        
        if ($conn->query($sql) === TRUE) {
            // Post successfully added, redirect to the home page
            header("Location: post?id=<?= $postId ?>.php");
            exit;
        } else {
            // Error occurred while adding the post
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Username is not set in the session
        echo "Username not found in the session.";
    }
}

// Close the database connection
$conn->close();
?>