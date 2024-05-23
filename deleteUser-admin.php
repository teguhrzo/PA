<?php
    require_once 'koneksiDb.php';
    session_start();
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        header('Location: Users.php');
        exit;
    } else {
        echo 'Gagal: ' . $stmt->error;
    }
    $conn->close();
?>