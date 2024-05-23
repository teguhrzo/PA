<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raja Gaming👑</title>
    <link rel="stylesheet" href="signUp.css">
</head>
<body>
    <div class="logo">
        <a href="index.php"><img src="assets\LogoFavicon.png" alt="" width="300px"></a>
    </div>
    <div class="container-signUp">
        <form method="post" action="signUp.php">
            <div class="signup-text">
                <h1 class="text">Sign Up</h1>
            </div>
            <div class="signup-input">
                <div class="kotak">
                    <input type="text" placeholder="Username" name="Username" pattern="[a-zA-Z0-9]{3,}" title="Minimal terdiri atas beberapa karakter dan tidak boleh mengandung spasi." required>
                    <input type="email" placeholder="Email" name="Email" required>
                    <input type="password" placeholder="Password" name="Password" pattern="[a-zA-Z0-9]{8,}" title="Minimal terdiri atas 8 karakter dan tidak boleh mengandung spasi." required>
                    <input type="password" placeholder="Confirm Password" name="confirm-password" required>
                    <p id="errorText" style="color: red; display: none; padding:5px; margin:0px">Password tidak sesuai.</p>
                    <input type="submit" class="tombol" value="Sign Up">
                </div>
                <div class="kotak">
                    <p>Sudah memiliki akun? <a href="signIn.php">Login disini</a></p> 
                </div> 
            </div>
        </form>
    </div>
    <script>
        function invalidPassword() {
            let errorText = document.getElementById('errorText');
            errorText.style.display = "block";
        }    
    </script>
    <?php
        session_start();
        require_once 'koneksiDb.php'; // Memasukkan file koneksi.php
            // Cek apakah ada permintaan POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($_POST['Password'] !== $_POST['confirm-password']){
                echo '<script type="text/javascript">';
                echo 'invalidPassword();';
                echo '</script>';
            } else {
                $username = trim(mysqli_real_escape_string($conn, $_POST['Username']));
                $password = trim(mysqli_real_escape_string($conn, password_hash($_POST['Password'], PASSWORD_BCRYPT)));
                $email = trim(mysqli_real_escape_string($conn, $_POST['Email']));
                $query = "SELECT * from users where email='$email';";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION['pesan'] = 'Email sudah terdaftar';
                    header('Location: signIn.php');
                } else {
                    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                    // Siapkan pernyataan SQL
                    $sql = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$password', '$email', 'user')";

                    // Jalankan pernyataan SQL
                    if ($conn->query($sql) === TRUE) {
                        // Pendaftaran akun berhasil, redirect ke halaman login
                        header('Location: signIn.php');
                        exit;
                    } else {
                        echo 'Sign up gagal: ' . $stmt->error;
                    }
                }
                $conn->close();
            }
        }
    ?>
</body>
</html>



