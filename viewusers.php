<?php
include('conn.php');
session_start();

if(!($_SESSION['user_id'] == 2)) {
    header("location: login.php");
} 
    $username_admin = $_SESSION['user_id'];

        //$viewusers = "SELECT * FROM useradmin WHERE usertype = 'user'";
        $viewusers = "SELECT * FROM `userdetails` WHERE usertype_id = '1'";
        //SELECT userdetails.username, useradmin.usertype FROM useradmin INNER JOIN userdetails ON useradmin.id = userdetails.id WHERE usertype = 'user'

        $result = $conn->query($viewusers);
        if(!$result){
        echo $conn->error;
        }
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GET FIT NOW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
    <link rel="stylesheet" href="gui.css">
    
    <style>
        .row2{
            justify-content: center;
            padding: 10px;
            width: 50%;
            margin: auto;
        }

        .card {
            padding: 0px;
        }

        .column2 {
                float: left;
                width: 30%;
                padding: 10px;
                text-align: center;
        }

        @media screen and (max-width: 600px) {
            .column2 {
            width: 100%;
            display: block;
            margin-bottom: 20px;
            }
        }
    </style>

</head>

<body class="altwallpaper">
    <div id="container">
        <!--Start of Hamburger Menu-->
        <div class="hamburgermenu">
        <label for="demo-toggle" class="button drawer-toggle persistent doc"><br><b>Menu</b></label>
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

        <!--start of maincontent-->
        <div id="maincontent">
            <div id="textbackground">

            </div>
            <div id="blogtext">
            <h1> <b>Your Clients</b> </h1>

            <div class="column accountmenu">
                <a href="index.php" class="myButton">Return to Home</a> 
                <a href="useraccount.php" class="myButton">Return to Account</a>
                <a href='adduser.php' class='myButton'>Add a New Client</a>
                <a href='admininbox.php' class='myButton'>View Inbox</a>
                        </div>

                        <?php

                            while($row=$result->fetch_assoc()){

                                $user_name = $row['username'];
                                $userid = $row['id'];
                                $usertype=$row['usertype_id'];

                                    echo "
                                    
                                    <div class='column2'>
                                        <div class='card'>
                                                <div class='section'>
                                                    <p class='doc'><b>Client:</b> $user_name</p> 
                                                    <a href='viewusersdetails.php?typeid=$usertype&rowid=$userid' class='myButton'>View $user_name's Details</a>
                                                    <a href='editusers.php?typeid=$usertype&rowid=$userid' class='myButton'>Edit $user_name's Details</a>
                                                    <a href='viewusercalendar.php?typeid=$usertype&rowid=$userid' class='myButton'>View $user_name's Calendar</a>
                                                    <a href='viewuserstodolist.php?typeid=$usertype&rowid=$userid' class='myButton'>View $user_name's To Do List</a>
                                                    <a href='deleteusers.php?typeid=$usertype&rowid=$userid' class='myButton'>Delete $user_name's Account</a>
                                                    <a href='changeuserspassword.php?rowid=$userid' class='myButton'>Change $user_name's Password</a>
                                                    <a href='sendmessagetousers.php?rowid=$userid' class='myButton'>Message $user_name</a>
                                                    
                                                </div>
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