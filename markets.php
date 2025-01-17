<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<title>T-Cloud - Plans</title>

	<meta property="”og:title”" content="PrimeXBL" />
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<meta name="theme-color" content="#fff" />
	<meta name="application-name" content="PrimeXBL" />
	<link type="text/css" rel="stylesheet" charset="UTF-8" href="https://www.gstatic.com/_/translate_http/_/ss/k=translate_http.tr.vneFu3d_4ck.L.F4.O/d=0/rs=AN8SPfrNa1b9K5rCmaIpu9SqE3A5sBDBfg/m=el_main_css" />
	<script type="text/javascript" charset="UTF-8" src="https://translate.googleapis.com/_/translate_http/_/js/k=translate_http.tr.en_GB.c_zC7qUnTFY.O/d=1/exm=el_conf/ed=1/rs=AN8SPfoBlmfmYftMKBfrazMTdGZqwlOJOw/m=el_main"></script>
	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<link rel="stylesheet" href="./assets/css/libs/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="./assets/css/style.css">
</head>

<body class="bg-dark">
	<div id="page-loader" class="page-loader">
		<div class="loader-spinner"></div>
	</div>


	<!-- Navbar -->

	<?php require_once "./inc/header.php" ?>


	<section class="bg-dark text-light mt-5">

		<div class="col-xl-10 mx-auto mt-5">
			<select class="form-select form-select-sm bg-dark text-light" style="width:20%" onChange="loadChart()" name="" id="pairs">

			</select>



		</div>
		<div class="col-xl-10 mx-auto">
			<div class="tradingview-widget-container" id="tvchart"></div>
		</div>


		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

		<script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
		<script type="text/javascript">
			loadChart();

			function loadChart() {
				let symbol = document.getElementById('pairs').value;
				new TradingView.widget({
					"autosize": true,
					"symbol": symbol,
					"interval": "D",
					"timezone": "Etc/UTC",
					"theme": "dark",
					"style": "1",
					"locale": "en",
					"toolbar_bg": "#f1f3f6",
					"enable_publishing": true,
					"enable_publishing": false,
					"allow_symbol_change": true,
					"studies": [
						"STD;Awesome_Oscillator"
					],
					"container_id": "tvchart"
				});
			}
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
			function getExchangeInfo() {
				const url = 'https://api.binance.com/api/v3/exchangeInfo';

				return fetch(url)
					.then(response => {
						if (response.ok) {
							return response.json();
						} else {
							throw new Error('Failed to retrieve exchange information');
						}
					})
					.then(data => data.symbols)
					.catch(error => {
						console.error(error);
						return null;
					});
			}

			// Call the function to retrieve exchange information
			getExchangeInfo()
				.then(symbols => {
					if (symbols !== null) {
						const symbolSelect = document.getElementById('pairs');
						symbols.forEach(symbol => {
							const option = document.createElement('option');
							option.value = symbol.symbol;
							option.textContent = symbol.symbol;
							symbolSelect.appendChild(option);
						});
					}
				});
		</script>
		
</body>

</html>