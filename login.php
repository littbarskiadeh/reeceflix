<?php

    require_once("includes/config.php");
    require_once("includes/classes/FormSanitizer.php");
    require_once("includes/classes/Account.php");
    require_once("includes/classes/Constants.php");

    $account = new Account($con);

    if(isset($_POST["submitButton"])) {

        $userName = FormSanitizer::sanitizeFormuserName($_POST["userName"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

        $success = $account->login($userName, $password);

        // If login successful, redirect user to homepage (index.php)
        if($success) {
            // Store session, can use $_SESSION because of session_start() used in config
            $_SESSION["userLoggedIn"] = $userName;
            header("Location: index.php" );
        }
    }

    // use previous values entered by user
    function getInputValue($name) {
        if(isset($_POST[$name])) {
            echo $_POST[$name];
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="./assets/style/style.css" type="text/css" />
    </head>
    <body>
        
        <div class="signInContainer">

            <div class="column">

                <div class="header">
                    <img src="./assets/images/logo.png" title="Logo" alt="Site logo" />
                    
                    <h3>Sign in</h3>
                    <span>to continue to Reeceflix</span>
                </div>

                <form action="" method="POST">

                    <?php echo $account->getError(Constants::$loginFailed); ?>
                    <input type="text" name="userName" placeholder="Username" value="<?php getInputValue("userName"); ?>" required>

                    <input type="password" name="password" placeholder="Password" required>

                    <input type="submit" name="submitButton" value="SUBMIT">

                    <a href="register.php" class="signInMessage">Don't have an account? Sign up here!</a>

                </form>

            </div>

        </div>

    </body>
</html>