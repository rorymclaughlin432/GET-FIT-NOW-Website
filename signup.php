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
        
        <!--End of Header-->

        <!--start of maincontent-->
        <div id="maincontent">
            <div id="textbackground">

            </div>
            <div id="blogtext">
                <h1>Sign Up!</h1>
                <p> Do you want to get fit and in shape? Do you want to make big changes in your life? Join Get Fit Now and we'll help you find your new self!
                </p>
                <?php
                if (isset($_POST['usern'])) {

                                    $usernamedata = $conn -> real_escape_string($_POST['usern']);
                                    $pwddata = $conn -> real_escape_string($_POST['passwo']);
                                    $usertitle = $conn -> real_escape_string($_POST['title']);
                                    $firstn = $conn -> real_escape_string($_POST['firstname']);
                                    $lastn = $conn -> real_escape_string($_POST['lastname']);
                                    $email = $conn -> real_escape_string($_POST['useremail']);
                                    $phonenumber = $conn -> real_escape_string($_POST['phonenum']);
                                    $gender = $conn -> real_escape_string($_POST['gende']);
                                    $age = $conn -> real_escape_string($_POST['age']);
                                    $address = $conn -> real_escape_string($_POST['useraddress']);
                                        
                                    $insertuser = 
                                    "INSERT INTO userdetails (username, passw, title, firstname, lastname, email, phonenumber, gender, age, user_address, usertype_id)
                                    VALUES ('$usernamedata', SHA1('$pwddata'), '$usertitle','$firstn','$lastn', '$email', '$phonenumber','$gender','$age','$address', '1')"; 
                    
                    $result = $conn -> query($insertuser);

                    if (!$result) {
                        echo $conn -> error;
                    } else {
                        echo "<h1><b>$usernamedata has been added!</b></h1>";
                        $msg = "Thanks for signing up, $usernamedata. Enjoy and explore the Get Fit Now website!";

                        mail($email, "Welcome to Get Fit Now, $usernamedata!", $msg);
                    }
                }
                ?>

                <form action='signup.php' method='POST' enctype="multipart/form-data">
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

            </div>
        </div>

    </div>
</body>



</html>