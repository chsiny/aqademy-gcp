<?php
session_start(); // Start the session

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// Check if a post ID is provided in the request
if (isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];

    // Connect to your database (similar to what you did in other PHP files)

    // Update the upvotes count in the database
    $sql = "UPDATE posts SET upvotes = upvotes + 1 WHERE postId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId); // "i" indicates an integer
    $stmt->execute();

    // Fetch the updated upvotes count from the database
    $updatedUpvotes = fetchUpdatedUpvotes($conn, $postId);

    if ($updatedUpvotes !== false) {
        // Return a response with the updated upvotes count
        $response = [
            'status' => 'success',
            'upvotes' => $updatedUpvotes,
        ];
        echo json_encode($response);
    } else {
        // Handle the case where fetching the updated upvotes failed
        $response = [
            'status' => 'error',
            'message' => 'Error updating upvotes count.',
        ];
        echo json_encode($response);
    }
} else {
    // Invalid request, handle accordingly
    $response = [
        'status' => 'error',
        'message' => 'Invalid request.',
    ];
    echo json_encode($response);
}

// Function to fetch the updated upvotes count
function fetchUpdatedUpvotes($conn, $postId) {
    $sql = "SELECT upvotes FROM posts WHERE postId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId); // "i" indicates an integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['upvotes'];
    } else {
        return false;
    }
}
?>