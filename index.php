<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raja Gaming👑</title>
    <link rel="icon" href="assets\LogoFavicon.png">
    <link rel="stylesheet" href="style.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scroll.js"></script>
</head>
<body>
    <?php
        session_start();
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
            $loginText = '<a href="signOut.php" class="menu-item">Logout</a>';
        } else {
            $loginText = '<a href="signIn.php" class="menu-item">Login</a>';
        }
        if (isset($_SESSION['login_time'])) {
            // Periksa apakah sudah melebihi 24 jam (24 * 60 * 60 detik)
            if (time() - $_SESSION['login_time'] > 24 * 60 * 60) {
                // Redirect ke halaman login atau tindakan lain yang sesuai
                header('Location: signOut.php');
                exit();
            }
        }
        if (isset($_SESSION['payment_success'])) {
            echo '<div style="padding: 20px; background-color: rgba(0, 255, 0, 0.5); color: white; width: 50%; height: 1vw; border-radius: 10px; z-index: 9999; position: absolute; top: 10%; left:25%; margin: 20 auto">
            <span style="margin-left: 15px; color: white; font-weight: bold; float: right; font-size: 22px; line-height: 20px; cursor: pointer; transition: 0.3s;" onclick="this.parentElement.style.display=\'none\';">&times;</span>'
            . $_SESSION["payment_success"]
            . '</div>';
            unset($_SESSION['payment_success']);
        }
        if (isset($_SESSION['pesan'])) {
            echo '<div style="padding: 20px; background-color: rgba(255, 0, 0, 0.5); color: white; width: 50%; height: 1vw; border-radius: 10px; z-index: 9999; position: absolute; top: 10%; left:25%; margin: 20 auto">
            <span style="margin-left: 15px; color: white; font-weight: bold; float: right; font-size: 22px; line-height: 20px; cursor: pointer; transition: 0.3s;" onclick="this.parentElement.style.display=\'none\';">&times;</span>'
            . $_SESSION["pesan"]
            . '</div>';
            unset($_SESSION['pesan']);
        }
    ?>
    <div class="topnav" >
    <a href="index.php"><img src="assets\LogoFavicon.png" alt="" height="60px"></a>
    <div class="menu">
        <a href="#home" class="menu-item">Home</a>
        <a href="#services" class="menu-item">Service</a>
        <a href="#testimonials" class="menu-item">Testimonials</a>
        <a href="#about-us" class="menu-item">About</a>
        <a href="#contacts" class="menu-item">Contacts</a>
        <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
                echo '<a href="transaction.php" class="menu-item">Transaction</a>';
                if ($_SESSION['user_role'] !== 'admin') {
                    echo '<a href="editProfile.php" class="menu-item" id="user">Edit Profile</a>';
                } else {
                    echo '<a href="Users.php" class="menu-item">Users</a>';
                }
            }
        ?>
        <?php echo $loginText; ?>
    </div>
    </div>
    <div id="home"></div>
    
    <div class="top-text">
        <p class="ijo-biru">Your Journey to Glory Starts Here</p>
        <h1>Level Up Your Game, <br> Conquer the Battlefield!</h1>
        <button class="getting-start" onclick="redirectGettingStart()">Getting Started</button>
    </div>
    <img src="assets\Logo-Mobile-Legends.png" alt="MLBB-Logo.png" class="Logo-ML">
    <div class="box-flex">
        <div class="box-container1">
            <h3 class="judul">Professional</h3>
            <hr class="ijo-biru-line">
            <br>
            <p>Assisting customers in improving their ranks in Mobile Legends by helping them climb to higher tiers.</p>
        </div>
        <div class="box-container1">
            <h3 class="judul">Trustworthy</h3>
            <hr class="ijo-biru-line">
            <br>
            <p>Conveying that customers can trust you to keep their accounts safe and deliver the desired results.</p>
        </div>
        <div class="box-container1">
            <h3 class="judul">Experience</h3>
            <hr class="ijo-biru-line">
            <br>
            <p>Highlighting expertise and experience in assisting customers to achieve their goals.</p>
        </div>
        <div class="box-container1">
            <h3 class="judul">Guarantee</h3>
            <hr class="ijo-biru-line">
            <br>
            <p>Providing a guarantee that customers will get the desired outcome or receive a refund.</p>
        </div>
    </div>

    <br><br><br>    
    <div class="vl" id="services">
        <div class="garis-vertical"></div>
    </div>

    <br style="clear:both">

    <!-- Services -->
    <div class="services">
        <hr class="ijo-biru-line">
        <h1 id="services" >Services</h1>
    </div>
    <p class="sub-headline-text">Our Service for Customers</p>
    <br>
    <div class="frame-container">
        <div class="box-container2">
            <h3 class="judul">Rank Boosting</h3>
            <hr class="ijo-biru-line">
            <p>Assisting customers in improving their ranks in Mobile Legends by helping them climb to higher tiers.</p>
            <a href="rank_boosting.php" class="square-button">Order Now</a>
        </div>
        <div class="box-container2">
            <h3 id="last-child-container2" class="judul">Win Rate Improvement</h3>
            <hr class="ijo-biru-line">
            <p>Assisting customers in improving their ranks in Mobile Legends by helping them climb to higher tiers.</p>
            <a href="winrate.php" class="square-button">Order Now</a>
        </div>
    </div>
    
    <br style="clear:both">
    <br style="clear:both">
    <br style="clear:both">
    <br style="clear:both">

    <div class="vl" id="testimonials">
        <div class="garis-vertical"></div>
    </div>

    <br style="clear:both">
    
    <!-- Testimonials -->
    <div class="testimonials">
        <hr class="ijo-biru-line">
        <h1>Testimonials</h1>
    </div>
    <p class="sub-headline-text">Honest Reviews From Customers</p>
    <br><br>
    <div class="frame-container">
        <div class="box-container3">
            <!-- <i class="fa fa-sharp fa-solid fa-quote-right fa-3x" style="color: #5df5fe;"></i> -->
            <img src="assets\Petik.png" alt="" width="50px">
            <p>"I was struggling to climb the ranks in Mobile Legends, but thanks to their rank boosting service, I managed to reach my desired rank in no time. Highly recommended!" 
                - Sarah</p>
                <div class="rating">
                    <table>
                        <i class="fa fa-sharp fa-solid fa-star" style="color: #fffb00;"></i>
                        <i class="fa fa-sharp fa-solid fa-star" style="color: #fffb00;"></i>
                        <i class="fa fa-sharp fa-solid fa-star" style="color: #fffb00;"></i>
                        <i class="fa fa-sharp fa-solid fa-star" style="color: #fffb00;"></i>
                        <i class="fa fa-sharp fa-solid fa-star" style="color: #fffb00;"></i>
                    </table>
                </div>
                
        </div>
        <div class="box-container3">
            <!-- <i class="fa fa-sharp fa-solid fa-quote-right fa-3x" style="color: #5df5fe;"></i> -->
            <img src="assets\Petik.png" alt="" width="50px">
            <p>"I can't thank them enough for their win rate improvement service. Their expert guidance and strategies turned my losing streak into a winning spree. My win rate has significantly improved."
            <br>-Lisa</p>
            <div class="rating">
                <table>
                    <i class="fa fa-sharp fa-solid fa-star" style="color: #fffb00;"></i>
                    <i class="fa fa-sharp fa-solid fa-star" style="color: #fffb00;"></i>
                    <i class="fa fa-sharp fa-solid fa-star" style="color: #fffb00;"></i>
                    <i class="fa fa-sharp fa-solid fa-star" style="color: #fffb00;"></i>
                    <i class="fa fa-sharp fa-solid fa-star" style="color: #fffb00;"></i>
                </table>
            </div>
        </div>
    </div>

    <br style="clear:both">
    <br style="clear:both">
    <br style="clear:both">
    <br style="clear:both">

    <div class="vl" id="about-us">
        <div class="garis-vertical"></div>
    </div>

    <br style="clear:both">
    

    <!-- About Us -->
    <div class="about-us">
        <hr class="ijo-biru-line">
        <h1 id="about-us">About Us</h1>
    </div>
    <p class="sub-headline-text">We are More Than Gamers</p>
    <br><br><br>
    <div class="img-about-us">
        <div class="left-frame-about-us">
            <img src="assets\1.jpg" alt="">
        </div>
        <div class="right-frame-about-us">
            <img src="assets\3.jpg" alt="assets\300X519.jpg">
            <img src="assets\2.jpg" alt="assets\225X530.jpg" width="98%">
        </div>
    </div>

    <br>
    <div class="text-about-us">
        <div class="about-us-text-frame">
            <h3 class="judul">Who We Are</h3>
            <p>We are a team of dedicated professionals specializing in providing high-quality Mobile Legends rank boosting services.</p>
        </div>
        <div class="vl">
            <div class="garis-vertical-about-us"></div>
        </div>
        <div class="about-us-text-frame">
            <h3 class="judul">Our Philosophy</h3>
            <p>Customer satisfaction is our top priority, and we provide an unparalleled customer experience.</p>
        </div>
        <div class="vl">
            <div class="garis-vertical-about-us"></div>
        </div>
        <div class="about-us-text-frame">
            <h3 class="judul">Our Commit</h3>
            <p>We are committed to maintaining the confidentiality and security of your information.</p>
        </div>
    </div>

    <div class="vl" id="contacts">
        <div class="garis-vertical"></div>
    </div>
   
    <div class="social-media">
        <a href="https://www.facebook.com" class="fa fa-facebook-f fa-3x"></a>
        <a href="https://www.twitter.com" class="fa fa-twitter fa-3x"></a>
        <a href="https://www.youtube.com" class="fa fa-youtube-play fa-3x"></a>
        <a href="https://www.instagram.com" class="fa fa-instagram fa-3x"></a>
    </div>
    <div class="contact-us">
        <h1>Have Any Question?</h1>
        <a href="https://wa.me/6285156271326?text=Hello%20there!%20I%20wanted%20to%20chat%20with%20you." class="square-button" target=”_blank” >Contact Us</a>
    </div>

   
    <script src="script.js"></script>
    <br><br><br>
</body>
</html>