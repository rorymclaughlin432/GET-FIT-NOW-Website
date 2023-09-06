<?php
include('conn.php');

session_start();

if(!isset($_SESSION['user_id'])){
    
    header("location: login.php");
} 

$username = $_SESSION['user_id'];

//$pass_id = $_GET['rowid'];

$pw = "SELECT * FROM userdetails WHERE id = '$username'";

$result = $conn->query($pw);
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
            <div id="textbackground">

            </div>
            <div id="blogtext">
            <h2><b>Change Your Password</b></h2>
            <a href="useraccount.php" class="myButton">Return to Account</a>
            
            <form action='changepassword.php?rowid=$username' method='POST' enctype="multipart/form-data" display="grid" id="userform">
            
                                <?php
                                    $userpass = "SELECT * FROM userdetails WHERE id = '$username'";
                                    $resultpass = $conn->query($userpass);

                                            while($row=$resultpass->fetch_assoc()){

                                                $pwd = $row['passw'];
                                                $passid = $row['id'];
                                            }            
                                
                     echo "                   
                     <label><b>Password:</b></label> 
                     <input type='password' name='passwd' value='$pwd'/>
                     <input value='$passid' type='hidden' name='pwid'>
                     <input type='submit' name='update_password' value='Update Password'/>";
                    ?>
                    <?php
                            if(isset($_POST['update_password'])){
                                                                                
                                $pword = $conn -> real_escape_string($_POST['passwd']);
                                $pword_id = $conn -> real_escape_string($_POST['pwid']);
                                
                                $update_pw = "UPDATE userdetails SET passw = SHA1('$pword') WHERE userdetails.id = '$username'";
                                
                                $resultpassw = $conn->query($update_pw);
                                
                                if(!$resultpassw){
                                    echo $conn -> error;
                                    echo $update_pw;
                                } else {
                                //echo $update_pw;
                                echo "<h1><b>Password updated!</b></h1>";
                                }
                                
                            }
                            
                    ?>
                </form>

            </div>

            
        </div>

    </div>
</body>



</html>