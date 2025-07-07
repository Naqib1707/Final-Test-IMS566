<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $app_id = $_POST['application_id'];
    $name = trim($_POST['name']);
    $comment = trim($_POST['comment']);
    $rating = $_POST['rating'];
    $now = date("Y-m-d H:i:s");
    $status = 'approved';

    // Semak sama ada user ini dah komen sebelum ni
    $check = $conn->query("SELECT id FROM comments WHERE application_id='$app_id' AND name='$name' LIMIT 1");

    if ($check->num_rows > 0) {
        // ✅ UPDATE komen sedia ada
        $existing = $check->fetch_assoc();
        $comment_id = $existing['id'];

        $sql = "UPDATE comments 
                SET comment='$comment', rating='$rating', modified='$now' 
                WHERE id='$comment_id'";
    } else {
        // ✅ INSERT komen baru
        $sql = "INSERT INTO comments (application_id, name, comment, rating, status, created, modified) 
                VALUES ('$app_id', '$name', '$comment', '$rating', '$status', '$now', '$now')";
    }

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
