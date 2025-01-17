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
</body>

</html>