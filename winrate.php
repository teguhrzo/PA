<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raja Gaming👑</title>
    <link rel="icon" href="assets\LogoFavicon.png">
    <link rel="stylesheet" href="services.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scroll.js"></script>
</head>
<body>
    <?php
        require_once 'koneksiDb.php';
        session_start();
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            // Pengguna belum login, alihkan ke halaman login
            $_SESSION['pesan'] = "Mohon untuk login terlebih dahulu sebelum memesan jasa kami.";
            header('Location: signIn.php');
            exit;
        }
        if (isset($_SESSION['pesan'])) {
            echo '<div style="padding: 20px; background-color: rgba(255, 0, 0, 0.5); color: white; width: 50%; height: 1vw; border-radius: 10px; z-index: 9999; position: absolute; top: 10%; left:25%; margin: 20 auto">
            <span style="margin-left: 15px; color: white; font-weight: bold; float: right; font-size: 22px; line-height: 20px; cursor: pointer; transition: 0.3s;" onclick="this.parentElement.style.display=\'none\';">&times;</span>'
            . $_SESSION["pesan"]
            . '</div>';
            unset($_SESSION['pesan']);
        }
        if (isset($_SESSION['login_time'])) {
            // Periksa apakah sudah melebihi 24 jam (24 * 60 * 60 detik)
            if (time() - $_SESSION['login_time'] > 24 * 60 * 60) {
                // Redirect ke halaman login atau tindakan lain yang sesuai
                header('Location: signOut.php');
                exit();
            }
        }
    ?>
     <!-- Bagian Navbar -->
     <div class="topnav" >
        <a href="index.php"><img src="assets\LogoFavicon.png" alt="" height="60px"></a>
        <div class="menu">
            <a href="#service-details" class="menu-item">Service Details</a>
            <a href="#acc-info" class="menu-item">Account Information</a>
            <a href="#payment" class="menu-item">Payment</a>
        </div>
      </div>

      <div id="home"></div>
      <div class="container">
        <form method="post" name="form-transaksi" id="form-transaksi">
            <div class="top-content" id="service-details">
                <div class="Logo-subpart">
                    <img src="assets\Logo-Mobile-Legends.png" alt="LogoML.png" class="Logo-ML">
                    <div class="subpart">
                    <hr class="ijo-biru-line">
                    <h1>Win Rate Improvement</h1>
                </div>
                </div>

            <div class="kanan">
                <div class="service-details">
                    <div class="service-details-num">
                        <h2>1</h2>
                    </div>
                    <div class="service-details-content" id="matches-container">
                        <h2>Service Details</h2>
                        <table>
                            <tr>
                                <td>Total Matches</td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="matches" id="matches">
                                        <option value="not-selected">Select total matches</option>
                                        <option value="10">10 Match - Rp30.000</option>
                                        <option value="20">20 Match - Rp55.000</option>
                                        <option value="30">30 Match - Rp70.000</option>
                                        <option value="50">50 Match - Rp125.000</option>
                                    </select>
                                    <p id="errorText-matches" style="color: red; display: none; padding:5px; margin:0px;">Pilih jenis layanan yang ingin anda pesan.</p>
                                </td>
     
                            </tr>
                            <tr>
                                <td>Duration</td>
                            </tr>
                            <tr>
                                <td>
                                    <select name="duration" id="duration">
                                        <option value="14">2 Week</option>
                                        <option value="3">3 Days (+Rp20.000)</option>
                                        <option value="7">1 Week (+Rp10.000)</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Additional Notes
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <textarea name="notes" id="notes" cols="55" rows="5"></textarea>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="service-details-account-frame" id="acc-info">
                    <div class="service-details-account">
                        <div class="service-details-num">
                            <h2>2</h2>
                        </div>
                        <div class="service-details-content">
                            <h2>Account Information</h2>
                            <table>
                                <tr>
                                    <td>Mobile Legends User ID</td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="text" id="user-id" name="user-id" required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="password" id="user-password" name="user-password" required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="tel" id="user-phone" name="user-phone" pattern="^[0-9]{10,12}" title="Nomor telepon invalid." required>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Terms and Condition</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="terms-condition">
                                            <p>By transferring your Mobile Legends account to our boosting services team, you acknowledge that you have read, 
                                                understood, and agreed to the applicable terms and conditions. <br>
                                                <a onclick="openTerms();" style="color: #5DF5FE;;">Learn More</a></p>                                    
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="checkbox-container">
                                            <input type="checkbox" id="myCheckbox">
                                            <span class="checkmark" onclick="agreementChecked();"></span>
                                            <b>I Agree to the Terms of Use and Privacy Statement</b>
                                        </label>
                                        <p id="errorText-agreement" style="color: red; display: none; padding:5px; margin:0px">Anda harus menyetujui persyaratan dan ketentuan.</p>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- bottom content -->
                
                <div class="bottom-content" id="payment">
                    <div class="service-details2">
                        <div class="service-details-num">
                            <h2>3</h2>
                        </div>
                        <div class="service-details-content">
                            <h2>Payment</h2>
                            <table>
                                <tr>
                                    <td>Service Price</td>
                                    <td align="right"><span id="harga">Rp.-</span></td>
                                </tr>
                                <tr>
                                    <td>Tax 10%</td>
                                    <td align="right"><span id="pajak">Rp.-</span></td>
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td align="right"><span id="total-harga">Rp.-</span></td>
                                </tr>
                                <tr>
                                    <td>Payment Menthod</td>
                                </tr>
                                <tr>
                                    <td>
                                        <select name="payment-method" id="payment-method">
                                            <option value="not-selected">Select your payment</option>
                                            <option value="gopay">Gopay</option>
                                            <option value="ovo">Ovo</option>
                                        </select>
                                        <p id="errorText-payment" style="color: red; display: none; padding:5px; margin:0px">Pilih metode pembayaran anda.</p>
                                    </td>
                                    <td align="right"><button type="submit" class="square-button" id="payButton">Pay Now</button></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

     <!-- Pop up payment success -->
    <div id="popup-success-container" class="popup">
        <div class="popup-success" id="popup-success">
            <h2 align="center">Payment Confirmation</h2>
            <p>Before proceeding with the payment, we want to make sure that you indeed wish to proceed with this transaction.
                Please take a moment to review your order details to ensure everything is accurate and in order before proceeding with the transaction.
            <br><br>
            <b>Order Details:</b>
            <br>
            - Service: Winrate Improvement
            <br>
            - Matches: <span id="popup-matches"></span>
            <br>
            - Duration: <span id="popup-duration"></span>
            <br>
            - Total Price: <span id="popup-total-price"></span>
            <br><br>
            We are ready to process your payment. Before proceeding, we kindly ask you to reconfirm if you wish to proceed with this payment.
            Please respond with <span class="emphasize">Pay Now</span> to continue or  <span class="emphasize">Cancel</span> to abort the transaction.
            <br><br>
            By clicking <span class="emphasize">Pay Now</span> button, you will complete the payment process and finalize your transaction.

            <div class="popup-option">
                <button onclick="closePopup()" class="close-btn">Cancel</button>
                <button type="submit" class="square-button-popup" id="popupButton">Pay Now</button>
            </div>
            </p>
        </div>
    </div>
    
    <div id="popup-term-container" class="popup">
        <!-- Pop Up Terms and Conditions Agreement -->
        <div class="popup-terms" id="popup-terms">
            <h2 align="center">Account Transfer Terms and Conditions Agreement</h2>
            <p>By transferring your Mobile Legends account to our joki team, you acknowledge that you have read, understood, 
                and agreed to the applicable terms and conditions. Please carefully review the following before proceeding with the account transfer:
            <ol>
                <li>Account Security:</li>
                <ul style="list-style-type:disc;">
                    <li>We will make every effort to maintain the security and confidentiality of your account during the transfer process.</li>
                    <li>However, we are not liable for any loss or security issues that may occur after the account has been transferred to us.</li>
                </ul>
                <li>User Responsibility:</li>
                <ul style="list-style-type:disc;">
                    <li>You are solely responsible for any risks associated with transferring your account.</li>
                    <li>Please ensure that you do not disclose your account information to any third parties other than our joki team.
                    </li>
                </ul>
                <li>Potential Changes:</li>
                <ul style="list-style-type:disc;">
                    <li> During the account transfer process, changes to your profile, skins, or account settings may occur.</li>
                </ul>
                <li>Unethical Usage:</li>
                <ul style="list-style-type:disc;" >
                    <li>The use of cheats, hacks, or any other illegal methods during the account transfer process is strictly prohibited.</li>
                    <li>In case of any violations, we reserve the right to terminate the service without refund.</li>
                </ul>
                <li>Personal Information:</li>
                <ul style="list-style-type:disc;" > 
                    <li>In order to maintain your privacy, we will not disclose your personal information to third parties without your consent.</li>
                </ul>
            </ol>
            <p>By proceeding with the account transfer, you acknowledge that you understand and agree to these terms. Please carefully consider before proceeding with the transfer of your Mobile Legends account to our joki team.</p>
            <center><button class="close-btn" onclick="closePopup();">Close</button>
            </p></center>
        </div>
    </div>
    <div id="overlay" class="overlay"></div>
     
    <script src="script.js"></script>
    <script>
    var popup_success = document.getElementById("popup-success");
    var popup_terms = document.getElementById("popup-terms");
    var popupTerm = document.getElementById("popup-term-container");
    var popupPayment = document.getElementById("popup-success-container");
    var matches = document.getElementById('matches');
    var serviceSelector = document.getElementById('harga');
    var totalHargaSelector = document.getElementById('total-harga');
    var pajakSelector = document.getElementById('pajak');
    var duration = document.getElementById('duration');
    var payButton = document.getElementById('payButton');
    var paymentSelector = document.getElementById('payment-method');
    var durationChanged = false;
    var matchesChanged = false;
    var total = 0;
    var paymentSelected = false;
    var agreed = false;
    var form = document.getElementById('form-transaksi');

    matches.addEventListener('change', function() {
        if (matches.value !== 'not-selected'){
            matchesChanged = true;
        } else {
            matchesChanged = false;
        }
        updateHarga();
    })

    duration.addEventListener('change', function() {
        durationChanged = true;
        updateHarga();
    })

    paymentSelector.addEventListener('change', function() {
        console.log(paymentSelector.value);
        if (paymentSelector.value !== 'not-selected') {
            paymentSelected = true;    
        } else {
            paymentSelected = false;
        }
    })

    var priceList = {
        '10': 30000,
        '20': 55000,
        '30': 70000,
        '50': 125000
    };

    function agreementChecked(){
        agreed = !agreed;
    }

    function updateHarga() {
        let durasi = duration.value;
        let match = matches.value;
        let harga = priceList[match];
        if (durationChanged) {
            if (durasi === '3') {
                harga += 20000;
            } else if (durasi === '7') {
                harga += 10000;
            }
        }
        serviceSelector.textContent = 'Rp' + harga.toLocaleString('id-ID') + ",00";
        let pajak = harga * 0.1;
        pajakSelector.textContent = 'Rp' + pajak.toLocaleString('id-ID') + ",00";
        total = harga + pajak;
        totalHargaSelector.textContent = 'Rp' + total.toLocaleString('id-ID') + "00";
    }

    function checkForm() {
        if (matchesChanged && paymentSelected && agreed) {
            return true;
        }
        if (!matchesChanged) {
            let section = document.getElementById('matches-container');
            section.scrollIntoView({});
            let errorText = document.getElementById('errorText-matches');
            errorText.style.display = "block";
        } 
        if (!paymentSelected) {
            let errorText = document.getElementById('errorText-payment');
            errorText.style.display = "block";
        }  
        if (!agreed) {
            let errorText = document.getElementById("errorText-agreement");
            errorText.style.display = "block";
        } 
    }

    function openPopup(){
        if (checkForm()){
            let durasi = duration.value;
            if (durasi === '7') {
                durasi = '1 Minggu';
            } else if (durasi === '14') {
                durasi = '2 Minggu';
            } else {
                durasi = '3 Hari';
            }
            document.getElementById('popup-matches').textContent = matches.value + " Matches";
            document.getElementById('popup-duration').textContent = durasi;
            document.getElementById('popup-total-price').textContent = 'Rp' + total.toLocaleString('id-ID') + ",00";
            popup_success.classList.add("open-popup");
            overlay.style.display = "block";
            popupPayment.style.display = "block";
        }
    }

    function openTerms(){
        popup_terms.classList.add("open-popupTerms");
        overlay.style.display = "block";
        popupTerm.style.display = "block";
    }

    function closePopup(){
        popup_terms.classList.remove("open-popupTerms");
        popup_success.classList.remove("open-popup");
        overlay.style.display = "none";
        popupTerm.style.display = "none";
        popupPayment.style.display = "none";
    }

    form.addEventListener("submit", e => {
        openPopup();
        e.preventDefault();
    })

    document.getElementById("popupButton").addEventListener("click", function(){
        document.getElementById("form-transaksi").action = "proses_winrate.php";
        document.getElementById("form-transaksi").submit();
    })
    </script>
    <script src="script.js"></script>
</body>
</html>
