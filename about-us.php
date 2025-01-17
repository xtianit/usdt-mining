<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>About T-Cloud</title>
    <?php
    require_once "./inc/header-links.php";
    ?>

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
            <h1 class="text-light display-1">About Us</h1>
        </section>

        <section>
            <div class="container p-5">
                <div class="row">
                    <div class="col-xl-12 p-5 card-panel" style="text-align: justify;">
                        <h1 class="text-center">About Us</h1>
                        <p>Our team is committed to achieve exceptional results, being one step ahead. We created a trading platform for the long-term, setting up the standard to change the fortune of future generations to come! We are uniting all key aspects of running an efficient cryptocurrency mining operation. From building highly efficient data centers to providing a streamlined mining system for our users.</p>
                        <p>To mine competitively today, you need to invest significant resources, time and effort into your setup. Our team has built the most efficient mining systems to do the job for you. This way you can fully focus on keeping track of the markets and remain competitive with your mining rewards.</p>
                        <p>Besides being the portal for interesting mining data, we are also actively contributing to the cryptocurrency ecosystem, from launching awareness campaigns to releasing open-source mining software. We are building mining data centers around the world that are able to support 6 mining algorithms for 10+ different cryptocurrencies. If that’s not enough, we’d be happy to also support the ones you want to mine!. </p>
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