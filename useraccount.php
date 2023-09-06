<?php
include('conn.php');
session_start();

if(!isset($_SESSION['user_id'])){
	header("location: login.php");
}
$username = $_SESSION['user_id'];

$useraccount = "SELECT * FROM userdetails WHERE id = '$username'";

$result = $conn->query($useraccount);

if(!$result){
    echo $conn->error;
    }

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>40022221 Web Project</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
    <link rel="stylesheet" href="gui.css">
    <style>
        .row2{
            justify-content: center;
            padding: 10px;
            width: 50%;
            margin: auto;
        }

        @media only screen and (max-device-width: 480px) {
            .row2{
            justify-content: center;
            padding: 10px;
            width: 90%;
            margin: auto;
        }
    </style>


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
                <a href="usertodolist.php?rowid=$usertodoid" class="myNavSideButton">Your To Do List</a>
                <a href="whatwedo.php" class="myNavSideButton">What We Do</a>
                <a href="trainer.php" class="myNavSideButton">Your Trainer</a>
                <a href="contactus.php" class="myNavSideButton">Contact Us</a>
                <a href="signup.php" class="myNavSideButton">Sign Up Now!</a>
            </div>
        </div>
        <!--End of Hamburger Menu-->

        <!--start of maincontent-->
        <div id="maincontent">
            <div id="textbackground">

            </div>
            <div id="blogtext">
            <h1><b>Your Profile</b></h1>
            <?php

                while($row=$result->fetch_assoc()){
                    $uid = $row['id'];
                    $usern = $row['username'];
                    $title = $row['title'];
                    $firstn = $row['firstname']; 
                    $lastn = $row['lastname']; 
                    $email = $row['email'];
                    $phonenumber = $row['phonenumber'];
                    $gender = $row['gender'];
                    $age = $row['age'];
                    $address = $row['user_address'];
                    $imgname = $row["userpic"];

            echo "
            <div class='column accountmenu'>
                <a href='index.php' class='myButton'>Return to Home</a> 
                <a href='edituseraccount.php' class='myButton'>Edit Your Account</a>
                <a href='usertodolist.php' class='myButton'>Your To Do List</a>
                <a href='usercalendar.php?rowid=$uid' class='myButton'>Calendar</a>
                <a href='changepassword.php?rowid=$uid' class='myButton'>Change Your Password</a>
                <a href='changeprofilepic.php?rowid=$uid' class='myButton'>Change Your Profile Pic</a>
                <a href='userinbox.php?rowid=$uid' class='myButton'> $usern's Inbox</a>
                <a href='sendmessagetoadmin.php?rowid=$uid' class='myButton'> Messsage Trainer</a>
                <a href='logout.php?rowid=$uid' class='myButton'> Logout</a>
                        </div>

                  ";      

                        
                            

                                    echo "

                                    <div class='row2'>
                                        <h2><b>Welcome $usern!</b></h2>
                                                <div class='column'>
                                                    <img src='img/$imgname' width='100%' align='right'>
                                                    </div>
                                                <div class='section'>
                                                    <p class='doc'><b>Username:</b> $usern</p>
                                                    <p class='doc'><b>First Name:</b> $firstn</p>
                                                    <p class='doc'><b>Last Name:</b> $lastn</p>
                                                    <p class='doc'><b>Email:</b> $email</p>
                                                    <p class='doc'><b>Phone Number:</b> $phonenumber</p>
                                                    <p class='doc'><b>Gender:</b> $gender</p>
                                                    <p class='doc'><b>Age:</b> $age</p>
                                                    <p class='doc'><b>Address:</b> $address</p>
                                                </div>
                                        </div>


                                    ";
                                    
                            }

                        ?>
                
            </div>
                

            </div>
        </div>

    </div>
</body>



</html>