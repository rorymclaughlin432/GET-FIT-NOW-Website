<?php
session_start();

include('conn.php');

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GET FIT NOW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
    <link rel="stylesheet" href="gui.css">

    <style>

        #blogtext2{
            text-align:center;
        }

    @media only screen and (max-device-width: 480px) {
        
        #blogtext2{
            text-align:center;
            padding-top: 150px;
        }

    }
    </style>

</head>

<body class="home">
    <div id="container">
        <!--Start of Hamburger Menu-->
        <div class="hamburgermenu">
            <label for="demo-toggle" class="button drawer-toggle persistent doc"></label>
            <input type="checkbox" id="demo-toggle" class="drawer persistent">
            <div class="demo doc">
            <h3>Menu</h3>
            <label for="doc-drawer-checkbox" class="button drawer-close"></label>
            <label for="demo-toggle" class="button drawer-close"></label>
            <a id="present" href="index.php" class="myNavSideButton">Home</a>
                <a href="login.php" class="myNavSideButton">Login</a>
                <a href="useraccount.php" class="myNavSideButton">My Account</a>
                <a href="edituseraccount.php" class="myNavSideButton">Edit My Account</a>
                <a href="logout.php" class="myNavSideButton">Logout</a>
                <a href="whatwedo.php" class="myNavSideButton">What We Do</a>
                <a href="trainer.php" class="myNavSideButton">Your Trainer</a>
                <a href="contactus.php" class="myNavSideButton">Contact Us</a>
                <a href="signup.php" class="myNavSideButton">Sign Up Now!</a>
            </div>
        </div>
        <!--End of Hamburger Menu-->

        <!--Start of Header-->
        <div class="row">
            <header <div class="col" header id="header">
        </div>
        </header>
        <!--End of Header-->

        <!--start of maincontent-->
        <div id="maincontent">
                <div id="textbackground">

                </div>

                <div id="blogtext">

                    <h1>Welcome to Get Fit Now!</h1>
                    <p> Do you want to get fit and in shape? Do you want to make big changes in your life? Join Get Fit Now and we'll help you find your new self!
                    </p>
                    </div>

                    <div id="blogtext2">
                        
                        <div>
                        <a href="whatwedo.php" class="myButton">Click here to learn more!</a>
                        </div>

                        <div>
                        <a href="login.php" class="myButton">Login</a>
                        </div>
                        
                        <div>
                        <a href="signup.php" class="myButton">Sign Up!</a>
                        </div>

                    </div>

                

            </div>

    </div>
</body>



</html>