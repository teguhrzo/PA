<?php
        require_once 'koneksiDb.php';
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['matches'])){
                $curRank = $_POST['matches'];
            }
            if (isset($_POST['duration'])){
                $duration = $_POST['duration'];
            }
            $notes = $_POST['notes'];
            $account_id = trim(mysqli_real_escape_string($conn, $_POST['user-id']));
            $account_password = trim(mysqli_real_escape_string($conn, $_POST['user-password']));
            $user_phone = trim(mysqli_real_escape_string($conn, $_POST['user-phone']));
            $matches = $_POST['matches'];
            $user_id = $_SESSION['user_id'];
            $duration = $_POST['duration'];
            $tanggal = date('Y-m-d');
            $from = '-';

            if (empty($account_id)){
                $_SESSION['pesan'] = 'Id Akun tidak boleh kosong';
            }
            else if (empty($account_password)){
                $_SESSION['pesan'] = 'Password Akun tidak boleh kosong';
            }
            else if (empty($user_phone)){
                $_SESSION['pesan'] = 'Nomor telepon tidak boleh kosong';
            }
            if (isset($_SESSION['pesan'])) {
                header('Location: winrate.php');
                exit;
            } else {
                $sql = "INSERT INTO penjualan (notes, account_id, account_password, nomor_telepon, user_id, transaction_id, current, target, duration, order_date, status)
                VALUES ('$notes', '$account_id', '$account_password', '$user_phone', '$user_id', 2, '$from', '$matches', '$duration', '$tanggal', 'Diproses');";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION["payment_success"] = "Pemesanan Berhasil!";
                    header('Location: index.php');
                    exit;
                } else {
                    echo 'Transaksi Gagal: ' . $stmt->error;
                }
                $conn->close();
            }
        }
    ?>