<nav class="navbar px-3 fixed-top" id="navbar">
    <div class="hamburger" onclick="openNav()">
        <div class="d-flex align-items-center justify-content-center">
            <div class="hamburger-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="logo">T-Cloud</div>
        </div>
    </div>
    <div class="left-section">

        <div class="navbar-links">
            <div class="logo">T-Cloud</div>
            <ul>
                <li>
                    <a href="#">Products</a>
                    <div class="dropdown-content">
                        <a href="./buy-crypto.php">Buy Crypto</a>
                        <a href="./copy-expert-traders.php">Copy Trading</a>
                    </div>
                </li>
                <li>
                    <a href="#">Markets</a>
                    <div class="dropdown-content">
                        <a href="./forex-trading.php">Forex</a>
                        <a href="./crypto-trading.php">Crypto</a>
                        <a href="./stocks-trading.php">Stocks</a>
                    </div>
                </li>
                <li>
                    <a href="#">Trading Tools</a>
                    <div class="dropdown-content">
                        <a href="./copy-expert-traders.php">Copy Trading</a>
                        <a href="./markets.php?tickers=forex">Forex Price</a>
                        <a href="./markets.php?tickers=index">Index Price Chart</a>
                        <a href="./markets.php?tickers=crypto">Cryptocurrency Price Chart</a>
                    </div>
                </li>
                <li>
                    <a href="#">About</a>
                    <div class="dropdown-content">
                        <a href="./about-us.php">About Us</a>
                        <a href="./contact.php">Contact Us</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="right-section">

        <a href="./signin.php" class="btn btn-sm btn-transparent text-light mr-3">Login</a>
        <a href="./signup.php" class="btn btn-sm site-btn w-50">Register</a>
    </div>
    <!-- Hamburger and Hidden side nav -->
    <div id="mySidenav" class="sidenav">
        <img src="/assets/images/site/site-logo.png" style="height: 9vh; padding-left: 2rem;" class="responsive-img">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <ul>
            <li><a class="sidenav-close" href="./signin.php"><span class="material-icons notranslate">person_outline</span><span style="padding-left: 10px;">Sign In</span></a></li>
            <li><a class="sidenav-close" href="./signup.php"><span class="material-icons notranslate">person_add</span><span style="padding-left: 10px;">Sign Up</span></a></li>
            <li><a class="sidenav-close" href="./copy-expert-traders.php"><span class="material-icons notranslate">content_copy</span><span style="padding-left: 10px;">Copy Trading</span></a></li>
            <li><a class="sidenav-close" href="./crypto-trading.php"><span class="material-icons notranslate">copyright</span><span style="padding-left: 10px;">Crypto Trading</span></a></li>
            <li><a class="sidenav-close" href="./forex-trading.php"><span class="material-icons notranslate">wysiwyg</span><span style="padding-left: 10px;">Forex Trading</span></a></li>
            <li><a class="sidenav-close" href="./stocks-trading.php"><span class="material-icons notranslate">insert_chart_outlined</span><span style="padding-left: 10px;">Stocks Trading</span></a></li>
            <li><a class="sidenav-close" href="./options-trading.php"><span class="material-icons notranslate">donut_large</span><span style="padding-left: 10px;">Options Trading</span></a></li>
            <li><a class="sidenav-close" href="./what-is-leverage.php"><span class="material-icons notranslate">people</span><span style="padding-left: 10px;">What is Leverage</span></a></li>
            <li><a class="sidenav-close" href="./responsible-trading.php"><span class="material-icons notranslate">people</span><span style="padding-left: 10px;">Responsible Trading</span></a></li>
            <li><a class="sidenav-close" href="./general-risk-disclosure.php"><span class="material-icons notranslate">folder_open</span><span style="padding-left: 10px;">General Risk Disclosure</span></a></li>
            <li><a class="sidenav-close" href="./about-us.php"><span class="material-icons notranslate">people</span><span style="padding-left: 10px;">About Us</span></a></li>
            <li><a class="sidenav-close" href="./pages/cookie-policy.php"><span class="material-icons notranslate">lock_open</span><span style="padding-left: 10px;">Cookie Policy</span></a></li>
            <li><a class="sidenav-close" href="./privacy-policy.php"><span class="material-icons notranslate">lock_open</span><span style="padding-left: 10px;">Privacy Policy</span></a></li>
            <li><a class="sidenav-close" href="./terms-of-service.php"><span class="material-icons notranslate">folder_open</span><span style="padding-left: 10px;">Terms of Service</span></a></li>
            <li><a class="sidenav-close" href="."><span class="material-icons notranslate">home</span><span style="padding-left: 10px;">Home Page</span></a></li>
            <li><a class="sidenav-close" href="./contact.php"><span class="material-icons notranslate">mail_outline</span><span style="padding-left: 10px;">Contact Us</span></a></li>
        </ul>
    </div>

</nav>