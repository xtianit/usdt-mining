<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Cookie Policy</title>

    <?php
    require_once "./inc/header-links.php";
    ?>

    </style>
</head>

<body style="background-color: #dbdcdf; position: relative; min-height: 100%; top: 0px;">
    <div id="loader" class="loader">
        <div class="loader-line"></div>
        <div class="loader-running-line"></div>
    </div>

    <div id="page-content" class="page-content">
        <!-- Navbar -->

        <?php require_once "./inc/header.php" ?>
        <div class="overlay1"></div>
        <section class="container-fluid privacy-bg  text-light d-flex align-items-center justify-content-center flex-column">
            <h1 class="text-light display-1">Cookie Policy</h1>
        </section>

        <section>
            <div class="container p-5">
                <div class="row">
                    <div class="col-xl-12 p-5 card-panel" style="text-align: justify;">
                        <h1 class="text-center">Cookie Policy</h1>
                        <p> International Market (OPTIMAR) Limited uses cookies to: Optimize your trading experience, including remembering your preferences, location, preferred language, browser and other details;</p>
                        <p>Authenticate your identity for security purposes;</p>
                        <p>Maintain our website and certain functions available on it;</p>
                        <p>Analyze and track the use of our services;</p>
                        <p>Adjust our platform according to your trading habits and our regulatory requirements.</p>
                        <p>WHAT ARE COOKIES</p>
                        <p>Cookies are tiny pieces of data that are sent to your computer by a website and stored on your computer. Cookies are non-executable and cannot be used to install malware. They allow websites to recognize visitors when they return and include basic information about them that is checked and updated every time you visit the website. For more information see: http://www.allaboutcookies.org/.</p>
                        <p>MANAGING COOKIES</p>
                        <p>At OPTIMAR, we respect your right to privacy and are therefore happy to provide you with tools to manage the cookies you receive from our web services. Some cookies are essential to the performance of our platform (you cannot opt out from these cookies if you wish to use our platform). Below you will find a list of some of the third party cookies used by OPTIMAR. For those users who would prefer not to receive non-essential cookies, we have provided an “opt out” option for you to select.</p>
                        <p>Your browser may also allow you to block the storage of cookies on your computer; please refer to your browser’s “Help” menu or website for more information. If you use our web services without blocking cookies you are actually consenting to the cookies</p>
                    </div>
                </div>
            </div>
        </section>







        <!--main -->

        <!--end of content-->

        <style>
            @media screen and (max-width:600px) {
                .footer-content {
                    text-align: center;
                }
            }
        </style>



        <section class="p-5 text-light footer-content" style="background-color: black;">
            <?php require_once "./inc/footer.php" ?>
        </section>
    </div>














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
    <script src="./assets/js/primexbl.js"></script>
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

    <script>
        window.addEventListener('load', function() {
            var loader = document.getElementById('loader');
            var pageContent = document.getElementById('page-content');

            function hideLoader() {
                loader.style.display = 'none';
                pageContent.style.display = 'block';
            }

            if (document.readyState === 'complete') {
                hideLoader();
            } else {
                window.addEventListener('load', hideLoader);
            }
        });
    </script>
</body>

</html>