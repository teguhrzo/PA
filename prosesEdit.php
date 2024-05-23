<?php
        require_once 'koneksiDb.php';
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['Username'];
            $email = $_POST['Email'];
            $new_password = $_POST['change-password'];
            $confirm_new_password = $_POST['confirm-new-password'];
            $confirm_password = $_POST['confirm-password'];
            $id = $_SESSION['user_id'];
            $changed_password = trim(mysqli_real_escape_string($conn, $new_password));
            $query = "SELECT * from users where id='$id'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $hashedPassword = $row['password'];

            if ($new_password !== $confirm_new_password) {
                $_SESSION['pesan'] = 'Password baru tidak sesuai.';
            }
            if (!password_verify($confirm_password, $hashedPassword)) {
                $_SESSION['pesan'] = 'Password akun anda salah.';
            }
            if (isset($_SESSION['pesan'])) {
                header('Location: editProfile.php');
                exit;
            } else {
                if (!empty($changed_password)){
                    $hashedPassword = password_hash($changed_password, PASSWORD_BCRYPT);
                    $sql = "UPDATE users SET username='$username', email='$email', password='$hashedPassword' where id='$id'";
                    if ($conn->query($sql) === TRUE) {
                        $_SESSION['message'] = 'Perubahan telah tersimpan.';
                        header('Location: editProfile.php');
                        exit;
                    } else {
                        echo 'Edit profile gagal: ' . $stmt->error;
                    }
                } else {
                    $sql = "ALTER TABLE users SET username='$username', email='$email' where id='$id'";
                    if ($conn->query($sql) === TRUE) {
                        $_SESSION['message'] = 'Perubahan telah tersimpan.';
                        header('Location: editProfile.php');
                        exit;
                    } else {
                        echo 'Edit profile gagal: ' . $stmt->error;
                    }
                }
                $conn->close();
            }
        }
    ?>