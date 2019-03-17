<?php
require_once("includes/config.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/FormSanitizer.php");

$account = new Account($con);

if(isset($_POST["submitButton"])){
    $username = FormSanitizer::sanitizeFormUsername($_POST["username"]);
    $password = FormSanitizer::sanitizeFormPassword($_POST["password"]);

    $wasSuccessful = $account->login($username, $password);

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

    <title>VideoTube - Sign In</title>
</head>

<body>
    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <img src="assets/images/icons/VideoTubeLogo.png" alt="Site logo" title="Logo">
                <h3>Sign In</h3>
                <span>to continue to VideoTube</span>
            </div>

            <div class="loginForm">
                <form action="signIn.php" method="POST">
                    <input type="text" name="username" placeholder="Username"
                           value="<?php getInputValue('username') ?>" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <?php echo $account->getError(Constants::$loginFailed); ?>
                    <input type="submit" name="submitButton" value="Sign In">
                </form>
            </div>

            <a class= "signUpMessage" href="signUp.php">Need an account? Sign up here!</a>
        </div>
    </div>
</body>
</html>