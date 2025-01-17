<?php

date_default_timezone_set('Africa/Lagos');
session_start();
require_once "./vendor/autoload.php";
require_once "./controllers/account/access.php";
require_once "./config/config.php";

// Usage example:
if (isset($_GET['ref'])) {
    $reference = $_GET['ref'];
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>T-Cloud - Create Account</title>

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
    <link rel="stylesheet" href="./css/yatranslate.css">
    <script src="./js/yatranslate.js"></script>
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

    <section class=" mt-5">
        <style>
            select option:checked {
                color: white !important;
                /* Replace "red" with your desired color */
            }

            input::placeholder {
                color: navy !important;
                /* Replace "red" with your desired color */
            }



            input[type="text"]:focus {
                color: navy;
                /* Set text color when input is focused */
            }

            input[type="password"]:focus {
                color: navy;
                /* Set text color when input is focused */
            }
        </style>
        <div class="container-fluid p-5">
            <div class="row">
                <div class="col-xl-5 p-3 mx-auto border">
                    <center>
                        <img src="./assets/images/site/tcloud-logo.png" style="max-height: 150px" class="responsive-img" />
                    </center>
                    <h3 class="text-center" style="color: navy;">Create Account</h3>
                    <form id="create-account">
                        <input type="hidden" name="referral" value="<?php
                                                                    if (isset($_GET['ref'])) {
                                                                        echo $reference;
                                                                    }
                                                                    ?>">
                        <input type="text" name="email" id="email" placeholder="Email" autocomplete="off" class="px-0 mt-3 form-control form-control-sm border-0 border-bottom " style="border-radius:0; outline: none;">
                        <input type="password" id="password" name="password" autocomplete="off" placeholder="Password" class="px-0 mt-3 form-control form-control-sm border-0 border-bottom " style="border-radius:0; outline: none;">
                        <input type="password" name="cpassword" autocomplete="off" placeholder="Confirm password" class="px-0 mt-3 form-control form-control-sm border-0 border-bottom " style="border-radius:0; outline: none;">
                        <input type="text" name="firstName" autocomplete="off" placeholder="First name" class="px-0 mt-3 form-control form-control-sm border-0 border-bottom " style="border-radius:0; outline: none;">
                        <input type="text" name="lastName" autocomplete="off" placeholder="Last name" class="px-0 mt-3 form-control form-control-sm border-0 border-bottom " style="border-radius:0; outline: none;">

                        <select name="country" class="mt-3 form-select form-select-sm border-0 border-bottom  px-0" id="name-select" style="border-radius:0; outline: none;">
                            <option class="" value="" selected>Select Country</option>
                        </select>
                        <select name="state" class="mt-3 form-select form-select-sm border-0 border-bottom   px-0" id="state-select" style="border-radius:0; outline: none;">
                            <option class="" value="" selected>Select State</option>
                        </select>
                        <select class="mt-3 form-select form-select-sm border-0 border-bottom   px-0" name="gender" id="">
                            <option value="" selected>Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Male">Female</option>
                            <option value="Others">Others</option>
                        </select>
                        <input name="phone" autocomplete="off" type="text" placeholder="Phone number" class=" px-0 mt-3 form-control form-control-sm border-0 border-bottom" style="border-radius:0; outline: none;">

                        <div class="container">
                            <div class="row">
                                <div class="col-xl-6 mb-3 mx-auto">
                                    <div class="mt-3">
                                        <input class="mr-1" type="checkbox" name="accept" id="">
                                        <span class="text-navy">Accept all terms of service</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-center">
                            <button class="btn btn-sm btn-info">Sign Up</button>
                        </div>
                        <p class="text-center mt-3">Already have an account? <a href="./signin">Login</a></p>
                    </form>
                </div>
            </div>
    </section>
    <div id="cover-spin"></div>







    <!--main -->

    <!--end of content-->







    <script src="./assets/js/jquery-3.7.0.min.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

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

    <script src="./assets/js/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script src="./assets/js/custom.js"></script>
    <script src="./assets/js/process.js"></script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/64c0fa22cc26a871b02b54d8/1h68t26ne';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
</body>

</html>