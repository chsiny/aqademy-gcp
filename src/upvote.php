<?php
session_start(); // Start the session

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['post_id'])) {
        $postId = $_POST['post_id'];

        // Establish a database connection (similar to other PHP files)
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

        // Update the upvotes count in the database
        $sql = "UPDATE posts SET upvotes = upvotes + 1 WHERE postId = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $postId); // "i" indicates an integer
        
        if ($stmt->execute()) {
            // Return a JSON response indicating success
            $response = [
                'status' => 'success',
                'message' => 'Upvote successful!',
            ];
        } else {
            // Return a JSON response indicating an error
            $response = [
                'status' => 'error',
                'message' => 'Upvote failed.',
            ];
        }

        // Close the database connection (similar to other PHP files)

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Invalid request, handle accordingly
        $response = [
            'status' => 'error',
            'message' => 'Invalid request.',
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
} else {
    // Invalid request method, handle accordingly
    $response = [
        'status' => 'error',
        'message' => 'Invalid request method.',
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>