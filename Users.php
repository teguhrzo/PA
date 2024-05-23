<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raja Gaming👑</title>
    <link rel="stylesheet" href="transaction.css">
</head>
<body>
    <?php
        require_once 'koneksiDb.php';
        session_start();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            // Pengguna belum login, alihkan ke halaman login
            $_SESSION['pesan'] = "Mohon untuk login terlebih dahulu untuk melihat daftar transaksi anda.";
            header('Location: signIn.php');
            exit();
        }
        if (isset($_SESSION['login_time'])) {
            // Periksa apakah sudah melebihi 24 jam (24 * 60 * 60 detik)
            if (time() - $_SESSION['login_time'] > 24 * 60 * 60) {
                // Redirect ke halaman login atau tindakan lain yang sesuai
                header('Location: signOut.php');
                exit();
            }
        }
        if ($_SESSION['user_role'] !== 'admin') {
            $_SESSION['pesan'] = "Anda tidak memiliki akses ke halaman ini!";
            header('Location: index.php');
            exit();
        }
        $user_id = $_SESSION['user_id'];
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
            <a href="editUsers.php" class="menu-item" id="user-page">Users</a>
            <a href="signOut.php" class="menu-item">Logout</a>
        </div>
    </div>
    <div class="content">
        <div class="transaksi">
            <?php
                $query = "SELECT * from users";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 1) {
                    echo '<table> 
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Delete</th>
                        </tr>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['role'] !== 'admin'){
                            echo '<tr>';
                            echo "<td>" . $row['username'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            $id = $row['id'];
                            echo '<td><button class="delete-button" onclick="deleteUser(\''. $id . '\')">Delete</button></td>';
                        }
                    }        
                } else {
                    echo '<h2>Tidak ada user yang terdaftar.</h2>';
                }
            ?>
            </table>
        </div>
    </div>
    <script>
        function deleteUser(id) {
            window.location.href = "deleteUser-admin.php?id=" + id;
        }
    </script>

    
</body>
</html>