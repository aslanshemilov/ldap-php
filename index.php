<?php
    /* ***********************************
     *                                  *
     * done by Aslan Shemilov           *
     * aslanshemilov@gmail.com          *
     * Computer Programmer Analyst      *
     *                                  *
     * **********************************
     */

    // Report all PHP errors
    error_reporting(-1);
    ini_set('display_errors', 1);
    // Same as error_reporting(E_ALL);
    ini_set('error_reporting', E_ALL);
    // Turn off all error reporting
    //error_reporting(0);

    // initialize session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>LDAP</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/skeleton.css">

    <link rel="icon" type="image/png" href="images/favicon.png">

</head>
<body>
<?php
    include("./authenticate.php");

// check to see if user is logging out
if(isset($_GET['out'])) {
    // destroy session
    session_unset();
    $_SESSION = array();
    unset($_SESSION['user'],$_SESSION['access']);
    session_destroy();
}

// check to see if login form has been submitted
if(isset($_POST['uname'])){
    // run information through authenticator
    if(authenticate($_POST['uname'], $_POST['psw'])){
        // authentication passed
        header("Location: ./protected.php");
        die();
    } else {
        // authentication failed
        $error = 1;
    }
}

// output error to user
if(isset($error)){
     echo "Login failed: Incorrect user name, password, or rights<br />";
}

// output logout success
if(isset($_GET['out'])){
    echo "Logout successful";
}
?>
    <div class="container">
        <div class="row">
            <div class="one-half column" style="margin-top: 25%">
                <form method="post" action="./index.php">
                    <div class="container">
                        <label for="uname"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="uname" required>

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required>

                        <input type="submit" name="submit" value="submit" ></input>
                        <label>
                            <input type="checkbox" checked="checked" name="remember"> Remember me
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
