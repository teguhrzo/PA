<?php
    require_once 'koneksiDb.php';
    session_start();
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        session_unset();
        $_SESSION['pesan'] = "Akun berhasil dihapus, seluruh data anda sudah terhapus dan tidak bisa dikembalikan.";
        header('Location: index.php');
        exit;
    } else {
        echo 'Gagal: ' . $stmt->error;
    }
    $conn->close();
?>