<nav class="navbar px-3 fixed-top" id="navbar" style="background-color: navy!important;">
    <div class="hamburger" onclick="openNav()">
        <div class="d-flex align-items-center justify-content-center">
            <div class="hamburger-icon">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="logo" style="margin-left:50px">T-Cloud</div>
        </div>
    </div>
    <div class="left-section">
        <div class="navbar-links">
            <div class="logo">T-Cloud</div>
            <ul>
                <li>
                    <a href="#">About</a>
                    <div class="dropdown-content">
                        <a href="./about-us">About Us</a>
                        <a href="./contact">Contact Us</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="right-section">
        <div class="lang lang_fixed">
            <div id="ytWidget" style="display: none;"></div>
            <div class="lang__link lang__link_select" data-lang-active>
                <img class="lang__img lang__img_select" src="./assets/images/lang/lang__ru.png" alt="Ru">
            </div>
            <div class="lang__list" data-lang-list>
                <a class="lang__link lang__link_sub" data-ya-lang="ru">
                    <img class="lang__img" src="./assets/images/lang/lang__ru.png" alt="ru">
                </a>
                <a class="lang__link lang__link_sub" data-ya-lang="en">
                    <img class="lang__img" src="./assets/images/lang/lang__en.png" alt="en">
                </a>
                <a class="lang__link lang__link_sub" data-ya-lang="de">
                    <img class="lang__img" src="./assets/images/lang/lang__de.png" alt="de">
                </a>
                <a class="lang__link lang__link_sub" data-ya-lang="zh">
                    <img class="lang__img" src="./assets/images/lang/lang__zh.png" alt="zh">
                </a>
                <a class="lang__link lang__link_sub" data-ya-lang="fr">
                    <img class="lang__img" src="./assets/images/lang/lang__fr.png" alt="fr">
                </a>
            </div>
        </div>

        <a href="./signup.php" class="btn btn-sm site-btn w-100">Register</a>
    </div>
    <!-- Hamburger and Hidden side nav -->
    <div id="mySidenav" class="sidenav">
        <img src="" style="height: 9vh; padding-left: 2rem;" alt="T-CLOUD" class="responsive-img">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <ul>
            <li><a class="sidenav-close" href="./signin"><span class="material-icons notranslate">person_outline</span><span style="padding-left: 10px;">Sign In</span></a></li>
            <li><a class="sidenav-close" href="./signup"><span class="material-icons notranslate">person_add</span><span style="padding-left: 10px;">Sign Up</span></a></li>

            <li><a class="sidenav-close" href="./responsible-trading"><span class="material-icons notranslate">people</span><span style="padding-left: 10px;">Responsible Trading</span></a></li>
            <li><a class="sidenav-close" href="./general-risk-disclosure"><span class="material-icons notranslate">folder_open</span><span style="padding-left: 10px;">General Risk Disclosure</span></a></li>
            <li><a class="sidenav-close" href="./about-us"><span class="material-icons notranslate">people</span><span style="padding-left: 10px;">About Us</span></a></li>
            <li><a class="sidenav-close" href="./pages/cookie-policy"><span class="material-icons notranslate">lock_open</span><span style="padding-left: 10px;">Cookie Policy</span></a></li>
            <li><a class="sidenav-close" href="./privacy-policy"><span class="material-icons notranslate">lock_open</span><span style="padding-left: 10px;">Privacy Policy</span></a></li>
            <li><a class="sidenav-close" href="./terms-of-service"><span class="material-icons notranslate">folder_open</span><span style="padding-left: 10px;">Terms of Service</span></a></li>
            <li><a class="sidenav-close" href="."><span class="material-icons notranslate">home</span><span style="padding-left: 10px;">Home Page</span></a></li>
            <li><a class="sidenav-close" href="./contact.php"><span class="material-icons notranslate">mail_outline</span><span style="padding-left: 10px;">Contact Us</span></a></li>
        </ul>
    </div>

</nav>