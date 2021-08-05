<?php
include_once "class/Action.php";
$action = new Action();

// if(!$action->isSetSession())
// {
//     header("location:index.php");
// }
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>


    <title>Smart Irigation System </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/index.css" rel="stylesheet" />
    <link href="login.css" rel="stylesheet" />
    <script src="assets/js/Chart.js"> </script>
    <script src="assets/js/jquery.js"> </script>
    <script src="assets/js/bootstrap.min.js"> </script>
    <?php
    $lang = "or";
    if ($lang == "am") {
        echo '<script src="Language/lang-am.js"> </script>';
    } elseif ($lang == "or") {
        echo '<script src="Language/lang-or.js"> </script>';
    } else {
        echo '<script src="Language/lang-en.js"> </script>';
    }
    ?>

</head>

<body>
    <header>
        <div id="sis-header">
            <div>
                <div></div>
                <div>
                    <h2>SIS - LOGIN </h2>
                </div>
                <div></div>
            </div>

        </div>
    </header>

    <main class="container">
        <div class="row">

            <div class="col-md-3"></div>
            <div class="card col-md-6">
                <div class="card-header text-center sis-login-header">
                    <h3>Sign In</h3>
                </div>
                <div class="card-body ">
                    <span id="alert alert-info"></span>

                    <form name="sis-login-form" id="sis-login-form" data-parsley-validate>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input class="form-control" placeholder="your email..." type="email" name="email" id="email" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input class="form-control" placeholder="password" type="password" name="password" id="password" />
                            <span>
                                <i onclick="display();" class="fa fa-align-left fa-arrow-circle-right"></i></span>
                        </div>
                        <div class="form-group row">
                            <input type="hidden" name="page" value="login" />
                            <input type="hidden" name="action" value="login" />
                            <!-- <input class=" btn btn-danger  col-md-5 m-2 " type="reset" name="reset" value="Cancel"> -->
                            <input class=" btn col-md-12 col-lg-5 m-2" type="submit" id="login" value="Login">

                        </div>

                    </form>

                </div>

                <div class="card-footer">


                    <div class="bottom-text">
                        Forgot your password? =>
                        <span> <a class="sis-link" style="color:black" href="forgot.php">
                                Forgot Password
                            </a>
                        </span>
                    </div>
                </div>
            </div>

    </main>
</body>

<script>

    $(document).ready(function(){

        $("#sis-login-form").on("submit",function(event){
            event.preventDefault();

        $.ajax({
            url:"actions.php",
            data:$(this).serialize(),
            method:"POST",
            dataType:"json",
            beforeSend:function(){
                $("#login").text("Please wait...");
                $("#login").attr("disabled",true);
                
            },
            success:function(data)
            {
                $("#login").removeAttr("disabled");
                $("#login").text("Login");

                if(data.data)
                {
                    location="index.php";
                }

                console.log(data);
            },
            error:function(errorData)
            {
                console.log(errorData);
                $("#message").html("<p>We can't verify this input</p>");
            }
            
        })
        });
        
    });

    function loginRequest()
    {

    }

</script>

</html>