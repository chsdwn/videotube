<?php
require_once("includes/config.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/FormSanitizer.php");

$account = new Account($con);

if(isset($_POST["submitButton"])){
    $firstName = FormSanitizer::sanitizeFormString($_POST["firstName"]);
    $lastName = FormSanitizer::sanitizeFormString($_POST["lastName"]);
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);

    $email = FormSanitizer::sanitizeFormEmail($_POST["email"]);
    $email2 = FormSanitizer::sanitizeFormEmail($_POST["email2"]);

    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);
    $password2 = FormSanitizer::sanitizeFormPassword($_POST["password2"]);

    $wasSuccessful = $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);

    if($wasSuccessful){
        $_SESSION["userLoggedIn"] = $username;
        header("Location: index.php");
    }
}

function getInputValue($input){
    if(isset($_POST[$input])){
        echo $_POST[$input];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <title>VideoTube - Sign Up</title>
</head>

<body>
<div class="signUpContainer">
    <div class="column">
        <div class="header">
            <img src="assets/images/icons/VideoTubeLogo.png" alt="Site logo" title="Logo">
            <h3>Sign Up</h3>
            <span>to continue to VideoTube</span>
        </div>

        <div class="loginForm">
            <form action="signUp.php" method="POST">
                <input type="text" name="firstName" placeholder="First Name"
                       value="<?php getInputValue('firstName') ?>" autocomplete="off" required>
                <?php echo $account->getError(Constants::$firstNameCharacters); ?>

                <input type="text" name="lastName" placeholder="Last Name"
                       value="<?php getInputValue('lastName') ?>" autocomplete="off" required>
                <?php echo $account->getError(Constants::$lastNameCharacters); ?>

                <input type="text" name="username" placeholder="Username"
                       value="<?php getInputValue('username') ?>" autocomplete="off" required>
                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <?php echo $account->getError(Constants::$usernameTaken); ?>

                <input type="email" name="email" placeholder="Email"
                       value="<?php getInputValue('email') ?>" autocomplete="off" required>
                <input type="email" name="email2" placeholder="Confirm Email"
                       value="<?php getInputValue('email2') ?>" autocomplete="off" required>
                <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>

                <input type="password" name="password" placeholder="Password" autocomplete="off" required>
                <input type="password" name="password2" placeholder="Confirm Password" autocomplete="off" required>
                <?php echo $account->getError(Constants::$passwordsDoNotMatch); ?>
                <?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
                <?php echo $account->getError(Constants::$passwordCharacters); ?>

                <input type="submit" name="submitButton" value="Sign Up">
            </form>
        </div>

        <a class="signInMessage" href="signIn.php">Already have an accound? Sign in here.</a>
    </div>
</div>
</body>
</html>