<?php
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Smart Irrigation System</title>
</head>
<body>
    <header>
        <div>
            <h2>SIS - LOGIN </h2>
        </div>
    </header>

    <main>
        <section id="login_section"> 
            <div class="si-login-wrapper">
                <div class="si-login-header">
                <h4>Login to the System</h4>
                </div>
                <div class="si-login-body">
                    <div class="si-form">
                        <form id="sis-loginform" name="sis-loginform" method="POST" action="actions.php">
                            <div class="sis-formgroup">
                                <label for="sis-username">User Name</label>
                                <input placeholder="Username" id="sis-username" name="sis-username" type="text" minlength="5"/>
                            </div>
                            <div class="sis-formgroup">
                                <label for="sis-password">Password</label>
                                <input placeholder="Password" id="sis-password" name="sis-password" type="password" minlength="5"/>
                            </div>
                            <div class="sis-formactions">
                                <input type="hidden" name="page" value="login"/>
                                <input type="hidden" name="action" value="login"/>
                                <input type="submit" name="sis-submit" value="Login"/>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>