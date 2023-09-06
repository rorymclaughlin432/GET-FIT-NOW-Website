<?php
include('conn.php');
session_start();

if(!($_SESSION['user_id'] == 2)) {
    header("location: login.php");
}

$userid = isset($_GET['rowid']) ? $_GET['rowid'] : '';

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>40022221 Web Project</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
    <link rel="stylesheet" href="gui.css">

    <style>

        form {
            background: none;
            border: none;
        }

        .card{
            display: inline-block;
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
        
            <?php 
                        $username = "SELECT * FROM userdetails WHERE id = '$userid'";

                        $resultname = $conn->query($username);

                        if(!$resultname) {
                            echo $conn->error;
                        }
                        $u_name = NULL;
                        while($rowname=$resultname->fetch_assoc()){
                            $u_name = $rowname['username'];
                        }

                        echo "
                        <h1><b> Contact $u_name </b></h1>";
                        ?>
                        <div class='column accountmenu'>
                        <a href='viewusers.php' class='myButton'>Return to View Clients</a>
                        <a href='admininbox.php' class='myButton'>Return to Inbox</a>
                        </div> 
                    
            
            
                 <form action='sendmessagetousers.php?rowid=$userid' method='POST' enctype='multipart/form-data'>
                    
                        <div class='col-sm-4 card'>
                            <div class='section'>
                                <h3 class='doc'>Your Message</h3>
                                <input value='<?php echo $userid ?>' type='hidden' name='usermid'>
                                <textarea id=' msg' name='adminmessa' placeholder='Enter Message' style='width:85%;' class='doc' type='text'></textarea>
                            </div>
                        </div>

                    <input type='submit' value='Submit' name='submitadminmessage'>
                    </form>
            
                <?php
                    if(isset($_POST['submitadminmessage'])){

                            $messagedata = $conn -> real_escape_string($_POST['adminmessa']);
                            $uid = $conn -> real_escape_string($_POST['usermid']);
                                                
                    $adminmsg = "INSERT INTO `user_inbox` (`id`, `usermessage_id`, `adminmessage`, `datesent`)VALUES (NULL, '$uid', '$messagedata', NOW())";  

                            $result = $conn -> query($adminmsg);

                            if(!$result){
                                echo $conn -> error;
                                echo $adminmsg;
                                                    
                            } else {
                                echo "<h1><b> Message sent!</b></h1>";
                            }
                        } 

                ?>
            </div>         
        </div>

    </div>

    
</body>

            

</html>