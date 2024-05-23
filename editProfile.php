<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Raja Gaming👑</title>
        <link rel="stylesheet" href="editprofile.css">
    </head>

    <body>
        <?php
            require_once "koneksiDb.php";
            session_start();
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                $loginText = '<a href="signOut.php" class="menu-item">Logout</a>';
            } else {
                $_SESSION['pesan'] = "Mohon untuk login terlebih dahulu.";
                header('Location: signIn.php');
                exit;
            }
            if (isset($_SESSION['login_time'])) {
                // Periksa apakah sudah melebihi 24 jam (24 * 60 * 60 detik)
                if (time() - $_SESSION['login_time'] > 24 * 60 * 60) {
                    // Redirect ke halaman login atau tindakan lain yang sesuai
                    header('Location: signOut.php');
                    exit();
                }
            }
            if (isset($_SESSION['message'])) {
                echo '<div style="padding: 20px; background-color: rgba(0, 255, 0, 0.5); color: white; width: 50%; height: 1vw; border-radius: 10px; z-index: 9999; position: absolute; top: 10%; left:25%; margin: 20 auto">
                <span style="margin-left: 15px; color: white; font-weight: bold; float: right; font-size: 22px; line-height: 20px; cursor: pointer; transition: 0.3s;" onclick="this.parentElement.style.display=\'none\';">&times;</span>'
                . $_SESSION["message"]
                . '</div>';
                unset($_SESSION['message']);
            }
            if (isset($_SESSION['pesan'])) {
                echo '<div style="padding: 20px; background-color: rgba(255, 0, 0, 0.5); color: white; width: 50%; height: 1vw; border-radius: 10px; z-index: 9999; position: absolute; top: 10%; left:25%; margin: 20 auto">
                <span style="margin-left: 15px; color: white; font-weight: bold; float: right; font-size: 22px; line-height: 20px; cursor: pointer; transition: 0.3s;" onclick="this.parentElement.style.display=\'none\';">&times;</span>'
                . $_SESSION["pesan"]
                . '</div>';
                unset($_SESSION['pesan']);
            }
            $id = $_SESSION['user_id'];
            $query = "SELECT * FROM users WHERE id = '$id'";
            $result = mysqli_query($conn, $query);
            $row = $result->fetch_assoc();
        ?>

        <div class="topnav" >
            <a href="index.php"><img src="assets\LogoFavicon.png" alt="" height="60px"></a>
            <div class="menu">
                <a href="index.php#home" class="menu-item">Home</a>
                <a href="index.php#services" class="menu-item">Service</a>
                <a href="index.php#testimonials" class="menu-item">Testimonials</a>
                <a href="index.php#about-us" class="menu-item">About</a>
                <a href="index.php#contacts" class="menu-item">Contacts</a>
                <a href="transaction.php" class="menu-item">Transaction</a>
                <a href="editProfile.php" class="menu-item" id="user">Edit Profile</a>
                <?php echo $loginText; ?>
            </div>
        </div>

        <div class="container-signin">
            <form method="post" action="prosesEdit.php" id="form-edit">
                <div class="signin-text">
                    <h1 class="text">Edit Account</h1>
                </div>
                <div class="signin-input">
                    <div class="kotak">
                        <h3>Username</h3>
                        <input type="text" id="Username" name="Username" value=<?= $row['username']?> required>
                        <h3>Email</h3>
                        <input type="email" id="Email" name="Email" value=<?= $row['email']?> required>
                        <h3>New Password</h3>
                        <input type="password" id="change-password" name="change-password" pattern="[a-zA-Z0-9]{8,}" title="Minimal terdiri atas 8 karakter">
                        <h3>Confirm New Password</h3>
                        <input type="password" id="confirm-new-password" name="confirm-new-password">
                        <h3>Confirm Password</h3>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                <div class="del-save">
                    <div><button class="delete-button" onclick="deleteAccount(<?= $id ?>)">Delete Account</button></div>
                    <div><button class="save-button" id="saveButton">Save Changes</button></div> 
                </div>
                    
                </div>
            </form>
        </div>        
        <script>
            function deleteAccount(id) {
                window.location.href = "deleteUser.php?id=" + id;
            }
            document.getElementById("saveButton").addEventListener("click", function(){
                document.getElementById("form-edit").action = "prosesEdit.php";
                document.getElementById("form-edit").submit();
            })
        </script>
        
    </body>
    </html>



