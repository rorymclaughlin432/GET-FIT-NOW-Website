<?php
  session_start();

  include('conn.php');
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
            <div id="textbackground"></div>
            <div id="blogtext">

                <form class="has-text-centered" method='POST' action='login.php' enctype='multipart/form-data'>
                    <fieldset>
                           <legend class="doc">Login</legend>

                            <div class="row responsive-label">
                                <div class="col-sm-12 col-md-3"><label for="username" class="doc">UserName</label></div>
                                <div class="col-sm-12 col-md"><input type="text" placeholder="Username" name='usernameit' id="UserName" style="width:85%;" class="doc"></div>
                            </div>
                            <div class="row responsive-label">
                                <div class="col-sm-12 col-md-3"><label for="password" class="doc">Password</label></div>
                                <div class="col-sm-12 col-md"><input type="password" placeholder="Password" name='passwordit' id="password" style="width:85%;" class="doc" required></div>
                            </div>
                            <input type="submit" value="Login" />
                    </fieldset>
                </form>

                    <?php

                        if(isset($_POST['usernameit'])){

                                include('conn.php');

                            $usern = $conn->real_escape_string($_POST['usernameit']);
                            $pwd = $conn->real_escape_string($_POST['passwordit']);

                            // echo "<p>$username $pwd </p>";

                            $auth = "SELECT * FROM userdetails WHERE username='$usern' AND passw = SHA1('$pwd')";
                                    
                            $resultlogin = $conn -> query($auth);

                            if(!$resultlogin){
                                echo $conn->error;
                                
                            }

                            $numrows = $resultlogin->num_rows;
                            
                            /*
                            if(!$row=$resultlogin->fetch_assoc()) {
                                echo "<p> <b>You haven't registered yet. Please sign up</b></p>
                                <div><a href='signup.php' class='myButton'>Sign Up!</a></div>
                                ";
                            }
                            */
                            
                            if($numrows >= 1) {
                               
                                while($row=$resultlogin->fetch_array()){
                                    
                                    //find authors here
                                    $userid = $row['id'];
                                    $usertype=$row['usertype_id'];

                                    //success of login
                                    $_SESSION['user_id'] = $userid;

                                    if($usertype == '2' && $usern = 'admin'){
                                        header('location:viewusers.php');
                                    } else {
                                        header('location:useraccount.php');
                                    }
                                }

                            } else {
                                echo "<p> <b> Incorrect Username or Password </b> </p>";
                            }
                        }
                        
                    ?>

            </div>
        </div>

    </div>
</body>
</html>