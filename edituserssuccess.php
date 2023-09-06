<?php
include('conn.php');

session_start();

if(!($_SESSION['user_id'] == 2)) {
    header("location: login.php");
} 

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>40022221 Web Project</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
    <link rel="stylesheet" href="gui.css">

</head>

<body class="altwallpaper">
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
            <?php
                        if(isset($_POST['edituser'])){

                            $usernam = $_POST['usernam'];
                            $pword = $_POST['pw'];
                            $tit = $_POST['tit'];
                            $firstname = $_POST['firstnam'];
                            $lastname = $_POST['lastnam'];
                            $useremail = $_POST['ema'];
                            $phonenum =$_POST['phone'];
                            $gend = $_POST['gende'];
                            $userage = $_POST['ageuser'];
                            $useraddress = $_POST['addre'];
                            $usermainid = $_POST['users_id'];
                            $usertypemainid = $_POST['userstype_id'];
                            

                            $updateaccount = "UPDATE userdetails 
                            
                            SET 
                            username = '$usernam', 
                            passw = '$pword', 
                            title = '$tit', 
                            firstname= '$firstname', 
                            lastname = '$lastname', 
                            email = '$useremail', 
                            phonenumber = '$phonenum', 
                            gender = '$gend', 
                            age = '$userage', 
                            user_address = '$useraddress' 

                            WHERE id = '$usermainid' AND usertype_id = '$usertypemainid'";

                            $resultedituser = $conn->query($updateaccount);
                                
                                if ($resultedituser) {
                                    echo "<p> echo $updateaccount </p>";
                                    //header('location: useraccount.php?id = $username');
                                } else {
                                    echo $conn->error;
                                    
                                }
                        }
                            
                    ?>

                <h1><b>You have updated a user's details!</b></h1>
                <a href="index.php" class="myButton">Return to Home</a></div>
                <a href="viewusers.php" class="myButton">Return to View Users</a></div>
                

            </div>
        </div>

    </div>
</body>



</html>