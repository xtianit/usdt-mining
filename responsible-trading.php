<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Responsible Trading</title>

  <?php
  require_once "./inc/header-links.php"
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
      <h1 class="text-light display-1 text-center">Responsible Trading</h1>
    </section>

    <section>
      <div class="container p-5">
        <div class="row">
          <div class="col-xl-12 p-5 card-panel" style="text-align: justify;">
            <h1 class="text-center">Responsible Trading</h1>
            <p>When it comes to trading on T-Cloud or using its social trading features, we encourage responsible behaviour among all our users. Our “responsible trading policy” calls on traders to protect themselves from emotional decision making that can result in unnecessary losses.</p>
            <p>Novice traders, in particular, tend to rely more on “gut feelings,” because they don’t necessarily have a lot of experience in financial trading to make rational and informed choices.</p>
            <p>To help traders avoid making rash online trading decisions, T-Cloud, in accordance with local financial regulators, recommends the following:</p>
            <p>Maximum leverage according to the following list: <br>
              30:1 for major currency pairs;</p>
            <p>20:1 for non-major currency pairs, gold <br> and major indices;</p>
            <p>10:1 for commodities other than gold and non-major equity indices;</p>
            <p>5:1 for individual equities and other reference values;</p>
            <p>2:1 for cryptocurrencies;</p>
            <p>Place no more than 20% of your equity on one trade <br>
              The key factors of smart investing are low leverage and portfolio diversity, a fact attested to by the portfolios of T-Cloud’s top traders.</p>
            <p>Here are some tips for becoming a more responsible trader:</p>
            <p> Only invest in what you know: Don’t follow random tips or gut feelings. If you want to invest in a certain asset, familiarise yourself with its history and tendencies.
              Look at your Risk Score: Your unique Risk Score is a great way to see if you are a responsible trader. Keeping a Risk Score of 3 or lower on T-Cloud is recommended.
              Adjust your portfolio: Diversify your portfolio with assets across many classes. If you don’t want to monitor your portfolio frequently, opt for lower-involvement instruments, such as CopyPortfolios™ or our CopyTrader™ system.
              Copy other responsible traders: When you copy another trader, look at their Risk Score, history, and portfolio diversity.</p>
            <p>Human Psychology & Emotional Trading <br>
              Traders of all levels can rely too heavily on their emotions while trading. This is a mistake as fear, greed and excitement can play a hand in making bad decisions. Always have a trading plan, and stick to it no matter what happens. When creating your trading plan, incorporate the tips from the section above, paying specific attention to:</p>
            <p>Maximum leverage <br>
              Portfolio diversity <br>
              Risk scores and profiles of other traders</p>
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