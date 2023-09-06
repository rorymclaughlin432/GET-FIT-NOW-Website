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
    <title>GET FIT NOW</title>
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

        <!--start of maincontent-->
        <div id="maincontent">
            <div id="blogtext">
                <h1><b>Add New Client</b></h1>

                <form action='adduser.php' method='POST' enctype="multipart/form-data">
                    <fieldset>
                        <legend class="doc">Sign Up</legend>

                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="username" class="doc">UserName</label></div>
                            <div class="col-sm-12 col-md"><input type="text" placeholder="Username" name='usern' id="UserName" style="width:85%;" class="doc" required></div>
                        </div>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="password" class="doc">Password</label></div>
                            <div class="col-sm-12 col-md"><input type="password" placeholder="Password" name='passwo' id="password" style="width:85%;" class="doc" required></div>
                        </div>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="sf1-select" class="doc">Title (Mr, Mrs.)</label></div>
                            <div class="col-sm-12 col-md"><select id="sf1-select" name='title' style="width:85%;" class="doc"><option class="doc">Mr</option><option class="doc">Mrs.</option><option class="doc">Miss.</option></select></div>
                        </div>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="firstname" class="doc">FirstName</label></div>
                            <div class="col-sm-12 col-md"><input type="text" placeholder="Firstname" name='firstname' id="FirstName" style="width:85%;" class="doc" required></div>
                        </div>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="lastname" class="doc">LastName</label></div>
                            <div class="col-sm-12 col-md"><input type="text" placeholder="Lastname" name='lastname' id="LastName" style="width:85%;" class="doc" required></div>
                        </div>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="email" class="doc">Email</label></div>
                            <div class="col-sm-12 col-md"><input type="email" placeholder="Enter email..." name='useremail' id="useremail" style="width:85%;" class="doc" required></div>
                        </div>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="sf1-num" class="doc">Phone Number</label></div>
                            <div class="col-sm-12 col-md"><input type="number" value="phone" id="sf1-num" name='phonenum' style="width:85%;" class="doc" required></div>
                        </div>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="sf1-select" class="doc">Gender</label></div>
                            <div class="col-sm-12 col-md"><select id="sf1-select" name='gende' style="width:85%;" class="doc"><option class="doc">Male</option><option class="doc">Female</option><option class="doc">Prefer Not to Say</option></select></div>
                        </div>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="sf1-num" class="doc">Age</label></div>
                            <div class="col-sm-12 col-md"><input type="number" value="age" id="sf1-num" name='age' style="width:85%;" class="doc" min="16" max="100" required></div>
                        </div>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="addres" class="doc">Address</label></div>
                            <div class="col-sm-12 col-md"><input type="text" placeholder="Enter Address..." name='useraddress' id="address" style="width:85%;" class="doc" required></div>
                        </div>
                        <input type="submit" value="Submit" />
                    </fieldset>
                </form>
                    <?php

                        if(isset($_POST['usern'])){
                            
                                    $usernamedata = $_POST['usern'];
                                    $pwddata = $_POST['passwo'];
                                    $usertitle = $_POST['title'];
                                    $firstn = $_POST['firstname'];
                                    $lastn = $_POST['lastname'];
                                    $email=$_POST['useremail'];
                                    $phonenumber = $_POST['phonenum'];
                                    $gender = $_POST['gende'];
                                    $age = $_POST['age'];
                                    $address = $_POST['useraddress'];
                                        
                                    $insertuser = 
                                    "INSERT INTO userdetails (username, passw, title, firstname, lastname, email, phonenumber, gender, age, user_address, usertype_id, userpic)
                                    VALUES ('$usernamedata', '$pwddata', '$usertitle','$firstn','$lastn', '$email', '$phonenumber','$gender','$age','$address', 1,'userpichere.png')"; 
                                        
                                    $result = $conn->query($insertuser);
                                          
                                    if(!$result){
                                    echo $conn->error;
                                    echo $insertuser;
                                    } else {
                                        echo "<h1><b>$usernamedata has been added!</b></h1>";    
                                    }

                        }
                        ?>

            </div>
        </div>

    </div>
</body>



</html>