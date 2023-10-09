<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    
    if ($password === "usertest") {
        header("Location: home.php");
        exit;
    } else {
        echo "<script>alert('Invalid User');</script>";
        exit;
    }
}
?>