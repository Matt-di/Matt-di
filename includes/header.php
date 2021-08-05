<head>


    <title>Smart Irigation System </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/index.css" rel="stylesheet" />
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <script src="assets/js/Chart.js"> </script>
    <script src="assets/js/jquery.js"> </script>
    <script src="assets/js/bootstrap.min.js"> </script>


</head>

<body>
    <header>
        <div id="containerr">
            <div>
                <h2 id="sis-brand-name"><?php echo $language['title'] ?></h2>
            </div>
        </div>

    </header>
    <nav id="sis-navbar" class="navbar navbar-expand-md">
        <!-- Brand -->
        <a class="navbar-brand" href="#">SIS</a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userprofile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="weathercondition">Profile</a>
                </li>
                <li class="nav-item">
                    <div class="btn-group">
                        <a class="btn dropdown-toggle" data-toggle="dropdown">
                            <?php echo $language['language'] ?>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="?lang=en">English</a>
                            <a class="dropdown-item" href="?lang=am">አማርኛ</a>
                            <a class="dropdown-item" href="?lang=or">Afaan Oromoo</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>