<?php
include('conn.php');
session_start();

if(!($_SESSION['user_id'] == 2)) {
    header("location: login.php");
} 

$username = $_SESSION['user_id'];

$userid = $_GET['rowid'];
$user_type = $_GET['typeid'];
//$userid = isset($_GET['rowid']) ? $_GET['rowid'] : '';


$useraccount = "SELECT * FROM userdetails WHERE usertype_id = '$user_type' AND id = '$userid'";

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
            <?php 
                            while($row=$result->fetch_assoc()){

                                    $usern = $row['username'];
                                    $title = $row['title'];
                                    $firstn = $row['firstname']; 
                                    $lastn = $row['lastname']; 
                                    $email = $row['email'];
                                    $phonenumber = $row['phonenumber'];
                                    $gender = $row['gender'];
                                    $age = $row['age'];
                                    $address = $row['user_address'];
                                    $imgname = $row['userpic'];

            echo "<div class='column accountmenu'>
                <a href='index.php' class='myButton'>Return to Home</a> 
                <a href='viewusers.php' class='myButton'>Return to View Clients</a>
                <a href='viewusersdetails.php?rowid=$userid' class='myButton'>View $usern's Details</a>
                <a href='editusers.php?rowid=$userid' class='myButton'>Edit $usern's Details</a>
                <a href='viewusercalendar.php?rowid=$userid' class='myButton'>View $usern's Calendar</a>
                <a href='viewuserstodolist.php?rowid=$userid' class='myButton'>View $usern's To Do List</a>
                <a href='deleteusers.php?rowid=$userid' class='myButton'>Delete $usern's Account</a>
                        </div>
                        

                            


                                    <div class='row2'>
                                        <h2><b>$usern's Profile</b></h2>
                                                    <div class='column'>
                                                        <img src='img/$imgname' width='100%' align='right'>
                                                    </div>
                                                <div class='section'>
                                                    <h3 class='doc'>$usern</h3>
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