<?php

    require_once("includes/config.php");
    require_once("includes/classes/FormSanitizer.php");
    require_once("includes/classes/Account.php");
    require_once("includes/classes/Constants.php");

    $account = new Account($con);

    if(isset($_POST["submitButton"])) {

        $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
        $userName = FormSanitizer::sanitizeFormuserName($_POST["userName"]);
        $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
        $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);
        $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
        $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

        // register() returns a boolean (True/False)
        $success = $account->register($firstName, $lastName, $userName, $email, $email2, $password, $password2);

        if($success) {
            // Store session, can use $_SESSION because of session_start() used in config
            $_SESSION["userLoggedIn"] = $userName;
            header("Location: index.php" );
        }
    }

    // TODO: Refactor this and add to its own class
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
        <title>Welcome to Reeceflix</title>
        <link rel="stylesheet" href="./assets/style/style.css" type="text/css" />
    </head>
    <body>
        
        <div class="signInContainer">

            <div class="column">

                <div class="header">
                    <img src="./assets/images/logo.png" title="Logo" alt="Site logo" />
                    
                    <h3>Sign Up</h3>
                    <span>to continue to Reeceflix</span>
                </div>

                <form action="" method="POST">

                    <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                    <input type="text" name="firstName" placeholder="First name" value="<?php getInputValue("firstName"); ?>" required>
                    
                    <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                    <input type="text" name="lastName" placeholder="Last name" value="<?php getInputValue("lastName"); ?>" required>

                    <?php echo $account->getError(Constants::$userNameCharacters); ?>
                    <?php echo $account->getError(Constants::$userNameTaken); ?>
                    <input type="text" name="userName" placeholder="Username" value="<?php getInputValue("userName"); ?>" required>

                    <input type="email" name="email" placeholder="Email" value="<?php getInputValue("email"); ?>" required>

                    <?php echo $account->getError(Constants::$emailsDontMatch); ?>
                    <?php echo $account->getError(Constants::$emailInvalid); ?>
                    <?php echo $account->getError(Constants::$emailTaken); ?>
                    <input type="email" name="email2" placeholder="Confirm email" value="<?php getInputValue("email2"); ?>" required>

                    <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                    <?php echo $account->getError(Constants::$passwordLength); ?>
                    <input type="password" name="password" placeholder="Password" required>

                    <input type="password" name="password2" placeholder="Confirm password" required>

                    <input type="submit" name="submitButton" value="SUBMIT">

                    <a href="login.php" class="signInMessage">Already have an account? Sign in here!</a>

                </form>

            </div>

        </div>

    </body>
</html>