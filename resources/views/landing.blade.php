<!DOCTYPE HTML>

<html>

<head>
    <title>SmartMaps Trans Jogja</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="storage/css/main.css" />
    <noscript>
        <link rel="stylesheet" href="storage/css/noscript.css" />
    </noscript>
</head>
<!-- Menambahkan Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .icons {
            list-style: none;
            padding: 0;
        }
        .icons li {
            display: inline;
            margin: 0 10px;
        }
        .icons a {
            text-decoration: none;
            color: inherit;
        }
    </style>

<body class="homepage is-preload">
    <div id="page-wrapper">

        <!-- Header -->
        <div id="header">

            <!-- Inner -->
            <div class="inner">
                <header>
                    <h1><a href="#kab" id="logo">SmartMaps Trans Jogja</a></h1>
                    <hr />
                    <p>Mulai mencari Rute ??</p>
                </header>
                <footer>
                    <a href="{{ route('index-public') }}" class="button circled scrolly">Ayo!!!</a>
                </footer>
            </div>

            <!-- Nav -->
            <nav id="nav">
                <ul>
                    </li>
                    <li><a href="index_public.blade.php">Profile</a></li>
                    <li><a href="tabel-point.blade.php">Data</a></li>
                </ul>
            </nav>

        </div>


        <!-- Footer -->
        <div id="footer">
            <div class="container">
                <!-- <div class="row"> -->

                 <!-- Contact -->
                 <section class="contact">
                    <header>
                        <h3>Informasi Kontak</h3>
                    </header>
                    <p>Taragan, Sidorejo, Godean, Sleman, Daerah Istimewa Yogyakarta</p>
                    <ul class="icons">
                        <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a>
                        </li>
                        <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                        </li>
                        <li><a href="#" class="icon brands fa-linkedin-in"><span class="label">Linkedin</span></a></li>
                    </ul>
                </section>


                <!-- Copyright -->
                <div class="copyright">
                    <ul class="menu">
                        <li>&copy; 2023 Faiz Hamdan Zulfa - SIG22. All rights reserved.</li>
                    </ul>
                </div>

            </div>

            <!-- </div> -->
        </div>
    </div>

    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.dropotron.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Add smooth scrolling to all links
            $("a").on('click', function (event) {

                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    var hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function () {

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                } // End if
            });
        });
    </script>
</body>

</html>