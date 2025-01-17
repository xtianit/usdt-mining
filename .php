<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>T-Cloud - Log In</title>

    <meta property="”og:title”" content="T-Cloud" />
    <meta property="”og:image”" content="”./assets/images/site/logo.png”" />

    <meta content="width=device-width, user-scalable=no" name="viewport" />
    <meta content="Trade Stocks, Forex, and Crypto Currencies, Start making profit today by trading over 150 Stocks, Forex and Crypto Currencies." property="og:description" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link href="./assets/css/site/reactapp-modules.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="./assets/css/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="./assets/images/pwa/favicon.ico" />
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon-16x16.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="48x48" href="./assets/images/favicon-48x48.png" />
    <link rel="manifest" href="./assets/images/pwa/manifest.json" />
    <meta name="mobile-web-app-capable" content="yes" />
    <meta name="theme-color" content="#fff" />
    <meta name="application-name" content="T-Cloud" />
    <link type="text/css" rel="stylesheet" charset="UTF-8" href="https://www.gstatic.com/_/translate_http/_/ss/k=translate_http.tr.vneFu3d_4ck.L.F4.O/d=0/rs=AN8SPfrNa1b9K5rCmaIpu9SqE3A5sBDBfg/m=el_main_css" />
    <script type="text/javascript" charset="UTF-8" src="https://translate.googleapis.com/_/translate_http/_/js/k=translate_http.tr.en_GB.c_zC7qUnTFY.O/d=1/exm=el_conf/ed=1/rs=AN8SPfoBlmfmYftMKBfrazMTdGZqwlOJOw/m=el_main"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <link rel="stylesheet" href="./assets/css/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <style>
        #navbar {
            background-color: black;
        }

        input,
        select {
            border-bottom: 1px solid black !important;
        }

        h6 {
            color: white;
        }
    </style>
</head>

<body style="background-color: white;">
    <div id="page-loader" class="page-loader">
        <div class="loader-spinner"></div>
    </div>


    <!-- Navbar -->

    <?php require_once "./inc/header.php" ?>

    <section class="mt-5">

        <div class="container mt-5">
            <div class="row">
                <div class="col-xl-4 p-5 m-5 mx-auto shadow-lg">


                    <center>
                        <img src="./assets/images/site/site-logo.png" style="max-height: 150px" class="responsive-img" />
                    </center>
                    <h1 class="h1 text-center">Sign In</h1>
                    <form id="login-form">
                        <input name="email" type="text" id="email" placeholder="Email" class="px-0 mb-3 form-control form-control-sm border-0 bg-transparent border-bottom" style="border-radius:0; outline: none;">
                        <input name="password" type="password" placeholder="Password" class="px-0 mb-3 form-control form-control-sm border-0 bg-transparent border-bottom" style="border-radius:0; outline: none;">
                        <div class="d-flex align-items-center justify-content-center"">
							<button class=" btn btn-sm btn-info w-100">Sign In</button>
                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                            <a href="./forgot-password.php">Forget Password?</a>
                        </div>

                        <p class="text-center mt-3">Don't have an account? <a href="./signup.php">Sign Up</a></p>
                    </form>

                </div>
            </div>
    </section>
    <div id="cover-spin"></div>







    <!--main -->

    <!--end of content-->




    <section class="p-5 text-light" style="background-color: black;">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 mb-3">
                    <h6>Contacts</h6>
                    <ul class="m-0 p-0 list-none">
                        <li><a class="site-text" target="_blank" href="mailto:info@T-Cloud.com">Email</a></li>
                        <li><a class="site-text" target="_blank" href="https://t.me/T-Cloud">Telegram</a></li>
                        <li><a class="site-text" target="_blank" href="https://www.instagram.com/prime_xbl/">Instagram</a></li>
                    </ul>
                </div>
                <div class="col-xl-2 mb-3">
                    <h6>Products </h6>
                    <ul class="m-0 p-0 list-none">
                        <li><a class="site-text" href="/buy-crypto.html">Buy Crypto</a></li>
                        <li><a class="site-text" href="/pages/copy-expert-traders">Copy Trading</a></li>
                        <li><a class="site-text" href="/pages/forex-trading">Forex Trading Guide</a></li>
                        <li><a class="site-text" href="/pages/crypto-trading">Crypto Trading Guide</a></li>
                    </ul>
                </div>
                <div class="col-xl-2 mb-3">
                    <h6>Resources</h6>
                    <ul class="m-0 p-0 list-none">
                        <li><a class="site-text" href="/pages/about-us">About Us</a></li>
                        <li><a class="site-text" href="/pages/cookie-policy">Cookie Policy</a></li>
                        <li><a class="site-text" href="/pages/privacy-policy">Privacy Policy</a></li>
                        <li><a class="site-text" href="/pages/general-risk-disclosure">Risk Disclosure</a></li>
                    </ul>
                </div>
                <div class="col-xl-2 mb-3">
                    <h6>Indices Trading</h6>
                    <ul class="m-0 p-0 list-none">
                        <li><a class="site-text" href="/chart.html?chart=US30USD">DE 30 Trading</a></li>
                        <li><a class="site-text" href="/chart.html?chart=DE30EUR">DE 30 Trading</a></li>
                        <li><a class="site-text" href="/chart.html?chart=UK100GBP">UK 100 Trading</a></li>
                        <li><a class="site-text" href="/chart.html?chart=SPX500USD">S&amp;P 500 Trading</a></li>
                    </ul>
                </div>
                <div class="col-xl-2 mb-3">
                    <h6>Forex Trading</h6>
                    <ul class="m-0 p-0 list-none">
                        <li><a class="site-text" href="/chart.html?chart=USDJPY">USD/JPY Chart</a></li>
                        <li><a class="site-text" href="/chart.html?chart=EURUSD">EUR/USD Chart</a></li>
                        <li><a class="site-text" href="/chart.html?chart=GBPUSD">GBP/USD Chart</a></li>
                        <li><a class="site-text" href="/chart.html?chart=USDCAD">USD/CAD Chart</a></li>
                        <li><a class="site-text" href="/chart.html?chart=AUDUSD">AUD/USD Chart</a></li>
                    </ul>
                </div>
                <div class="col-xl-2 mb-3">
                    <h6>Crypto Trading</h6>
                    <ul class="m-0 p-0 list-none">
                        <li><a class="site-text" href="/chart.html?chart=BTCUSD">Bitcoin Trading</a></li>
                        <li><a class="site-text" href="/chart.html?chart=LTCUSD">Litecoin Trading</a></li>
                        <li><a class="site-text" href="/chart.html?chart=ALGOUSD">Algorand Trading</a></li>
                        <li><a class="site-text" href="/chart.html?chart=ETHUSD">Ethereum Trading</a></li>
                        <li><a class="site-text" href="/chart.html?chart=COMPUSD">Compound Trading</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- JavaScript for the hidden side nav -->
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }


        window.addEventListener('scroll', function() {
            var navbar = document.getElementById('navbar');
            var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollPosition > 0) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });

        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en'
            }, 'google_translate_element');
        }
    </script>
    <script>
        window.addEventListener('load', function() {
            var loader = document.getElementById('page-loader');
            var content = document.getElementById('page-content');

            // Hide the loader
            loader.style.display = 'none';

            // Show the content
            content.classList.remove('hide-content');
        });
    </script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="./assets/js/T-Cloud.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
        // Initialize WOW when the page is loaded
        document.addEventListener('DOMContentLoaded', function() {
            new WOW().init();
        });

        // Trigger WOW animations when the page is scrolled
        window.addEventListener('scroll', function() {
            var content = document.querySelector('.content');
            var contentTop = content.getBoundingClientRect().top;
            var windowHeight = window.innerHeight;

            if (contentTop < windowHeight) {
                content.classList.add('wow');
            } else {
                content.classList.remove('wow');
            }
        });
    </script>

    <script src="./assets/js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="./assets/js/process.js"></script>
</body>

</html>