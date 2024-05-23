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
            <a href="transaction.php" class="menu-item" id="transaction">Transaction</a>
            <?php 
                if ($_SESSION['user_role'] === 'admin') {
                    echo '<a href="users.php" class="menu-item">Users</a>';
                } else {
                    echo '<a href="editProfile.php" class="menu-item" id="user">Edit Profile</a>';
                }
            ?>
            <a href="signOut.php" class="menu-item">Logout</a>
        </div>
    </div>
    <div class="content">
        <div class="transaksi">
            <table> 
                <?php
                    if ($_SESSION['user_role'] !== 'admin') {
                        $query = "SELECT * from penjualan where user_id = '$user_id'";
                        $result = mysqli_query($conn, $query);
                        $service_type = '';
                        if (mysqli_num_rows($result) > 0) {
                            echo '<tr>
                                            <td>Account ID</td>
                                            <td>Service type</td>
                                            <td>From</td>
                                            <td>To</td>
                                            <td>Order Date</td>
                                            <td>Status</td>
                                    </tr>';
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['transaction_id'] === '1') {
                                    $service_type = 'Rank Boosting';
                                    $target = $row['target'];
                                } else if ($row['transaction_id'] == '2') {
                                    $service_type = 'Winrate Improvement';
                                    $target = $row['target'];
                                    $target = $target . " Matches";
                                }
                                echo '<tr>';
                                echo "<td>" . $row['account_id'] . '</td>';
                                echo '<td>' . $service_type . '</td>';
                                echo '<td>' . $row['current'] . '</td>';
                                echo '<td>' . $target . '</td>';
                                echo '<td>' . $row['order_date'] . '</td>';
                                echo '<td>' . $row['status'] . '</td>';
                            }        
                        } else {
                            echo '<h2>Anda belum pernah melakukan transaksi.</h2>';
                        }
                    } else {
                        $query = "SELECT * from penjualan";
                        $result = mysqli_query($conn, $query);
                        $service_type = '';
                        $target = '';
                        if (mysqli_num_rows($result) > 0) {
                            echo '<tr>
                                    <td>Account ID</td>
                                    <td>Account Password</td>
                                    <td>Service type</td>
                                    <td>From</td>
                                    <td>To</td>
                                    <td>Order Date</td>
                                    <td>Status</td>
                                    <td>Edit Status</td>
                                </tr>';
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['transaction_id'] === '1') {
                                    $service_type = 'Rank Boosting';
                                    $target = $row['target'];
                                } else if ($row['transaction_id'] == '2') {
                                    $service_type = 'Winrate Improvement';
                                    $target = $row['target'] . " Matches";   
                                }
                                echo '<tr>';
                                echo '<td>' . $row['account_id'] . '</td>';
                                echo '<td>' . $row['account_password'] . '</td>';
                                echo '<td>' . $service_type . '</td>';
                                echo '<td>' . $row['current'] . '</td>';
                                echo '<td>' . $target . '</td>';
                                echo '<td>' . $row['order_date'] . '</td>';
                                echo '<td>' . $row['status'] . '</td>';
                                $id = $row['id'];
                                if ($row['status'] === 'Selesai'){
                                    echo '<td><button class="square-button">Done</button></td>';
                                } else {
                                    echo '<td><button class="square-button" onclick="prosesDone(\''. $id . '\')">Done</button></td>';
                                }
                            }        
                        } else {
                            echo '<h2>Belum ada pesanan.</h2>';
                        }
                    }
                ?>
            </table>
        </div>
    </div>
    <script>
        function prosesDone(id) {
            window.location.href = 'prosesDone.php?id=' + id;
        }
    </script>

    
</body>
</html>