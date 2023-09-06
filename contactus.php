<?php
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

                <h1><b>Contact Us</b></h1>

                <p>Send us a message and we'll do our best to get back to you within three working days</p>

                <?php
                                            if(isset($_POST['name'])){

                                                $namedata = $conn -> real_escape_string($_POST['name']);
                                                $emaildata = $conn -> real_escape_string($_POST['email']);
                                                $messagedata = $conn -> real_escape_string($_POST['usermessage']);
                                            
                                            $insertuserdata = "INSERT INTO `userscontactus` (id, usercontactname, email, usermessage, contactsent) 
                                                                    VALUES (NULL, '$namedata', '$emaildata', '$messagedata', NOW())"; 

                                            $result = $conn -> query($insertuserdata);

                                            if(!$result){
                                                echo $conn -> error;
                                            } else {
                                                echo "<h1><b>Thanks for messaging us. We'll get back to you very soon!</b></h1>";
                                               // $time = date("l jS F Y h:i:s A");
                                                $msg = "Thanks for messaging us. We'll get back to you very soon!
                                                
                                                        Your Message Details:
                                                        Name: $namedata
                                                        Email: $emaildata
                                                        Message: $messagedata";

                                                mail($emaildata,"Thanks for contacting Get Fit Now!",$msg);
                                                //echo "<p>An email has been sent to $myemail</p>";
                                            }

                                            
                                            } 

                                    ?>          
            
            <div class="sideimage"><img class="" src="img/yoga-3053487_1280.jpg" width="170%" max-width="95%"></div><form action="contactus.php" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="doc">Contact Us</legend>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="name" class="doc">Name</label></div>
                            <div class="col-sm-12 col-md"><input type="text" placeholder="Enter Name" name="name" id="name" style="width:85%;" class="doc" required=""></div>
                        </div>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="mail" class="doc">Email</label></div>
                            <div class="col-sm-12 col-md"><input type="email" id="mail" name="email" placeholder="Enter Email" style="width:85%;" class="doc" required=""></div>
                        </div>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="addres" class="doc">Message</label></div>
                            <div class="col-sm-12 col-md">
                                <textarea id="msg" name="usermessage" placeholder="Enter Message" style="width:85%;" class="doc" type="text"></textarea></div>
                        </div>
                        <input type="submit" value="Submit">
                    </fieldset>
                </form>

    </div>
                                    
        </div>

    </div>

    
</body>

            

</html>