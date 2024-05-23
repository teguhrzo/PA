<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raja Gaming👑</title>
    <link rel="stylesheet" href="signIn.css">
</head>

<body>
    <?php
        session_start();
        if (isset($_SESSION['pesan'])) {
            echo '<div class="alert">
            <span style="margin-left: 15px; color: white; font-weight: bold; float: right; font-size: 22px; line-height: 20px; cursor: pointer; transition: 0.3s;" onclick="this.parentElement.style.display=\'none\';">&times;</span>'
            . $_SESSION["pesan"]
            . '</div>';
            unset($_SESSION['pesan']);
        }
    ?>
    <div class="logo">
        <a href="index.php"><img src="assets\LogoFavicon.png" alt="" width="300px"></a>
    </div>
    <div class="container-signin">
        <form method="post" action="signIn.php">
            <div class="signin-text">
                <h1 class="text">Sign In</h1>
            </div>
            <div class="signin-input">
                <div class="kotak">
                    <input type="email" placeholder="Email" name="Email" required>
                    <input type="password" placeholder="Password" name="Password" required>
                    <input type="submit" class="tombol" value="Sign In">
                </div>
                <div class="kotak">
                    <p>Belum memiliki akun? <a href="signUp.php">Buat disini</a></p> 
                </div> 
            </div>
        </form>
    </div>
    <?php
        require_once 'koneksiDb.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['Email'];
            $password = $_POST['Password'];
            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $query);

            if ($row = mysqli_fetch_assoc($result)) {
                $userId = $row['id'];
                $hashedPassword = $row['password'];
                $userRole = $row['role'];
                if ($userRole === 'admin'){
                    if ($password === $hashedPassword){
                        $_SESSION['logged_in'] = true;
                        $_SESSION['user_id'] = $userId; 
                        $_SESSION['login_time'] = time();
                        $_SESSION['user_role'] = $userRole;

                        header('Location: index.php');
                        exit;
                    }
                }
                if (password_verify($password, $hashedPassword)) {
                    $_SESSION['logged_in'] = true;  
                    $_SESSION['user_id'] = $userId; 
                    $_SESSION['login_time'] = time();
                    $_SESSION['user_role'] = $userRole;

                    header('Location: index.php');
                    exit;
                } else {
                    $_SESSION['pesan'] = 'Password Salah';
                    header('Location: signIn.php');
                    exit;
                }
            } else {
                $_SESSION['pesan'] = 'Email belum terdaftar';
                header('Location: signIn.php');
                exit;
            }
        }
    ?>
</body>
</html>



