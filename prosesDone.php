<?php
    require_once 'koneksiDb.php';
    session_start();
    $id = $_GET['id'];
    $sql = "UPDATE penjualan SET status = 'Selesai', account_password = '-' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        header('Location: transaction.php');
        exit;
    } else {
        echo 'Gagal: ' . $stmt->error;
    }
    $conn->close();
?>