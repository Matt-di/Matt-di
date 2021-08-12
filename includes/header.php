<?php include "constants.php" ?>

<head>
    <title>Smart Irigation System </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo ASSET_URL ?>/css/index.css" rel="stylesheet" />
    <link href="<?php echo ASSET_URL ?>/css/bootstrap.min.css" rel="stylesheet" />
    <script src="<?php echo ASSET_URL ?>/js/Chart.js"> </script>
    <script src="<?php echo ASSET_URL ?>/js/jquery.js"> </script>
    <script src="<?php echo ASSET_URL ?>/js/bootstrap.min.js"> </script>


</head>

<body>
    <header>
        <div id="containerr">
            <div id="sis-brand-name" class="jumbotron">
                <h2 ><?php echo $language['title'] ?></h2>
            </div>
        </div>

    </header>
    <nav id="sis-navbar" class="navbar navbar-expand-md">
        <a class="navbar-brand" href=<?php echo BASE_URL ?>>SIS</a>
 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href=<?php echo BASE_URL ?>>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="userprofile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="weathercondition">Weather Forecast</a>
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