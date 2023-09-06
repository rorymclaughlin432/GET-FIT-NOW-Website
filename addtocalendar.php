<?php
include('conn.php');

session_start();

if(!isset($_SESSION['user_id'])) {
    
    header("location: login.php");
}

$username = $_SESSION['user_id'];

$userevents = "SELECT * FROM usercalendar WHERE user_id=$username";

//$userevent = "SELECT userdetails.username, usercalendar.user_date, usercalendar.events FROM usercalendar INNER JOIN userdetails ON usercalendar.user_id = userdetails.id WHERE userdetails.id = $username"; 

$result = $conn->query($userevents);

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

                <h1>Add New Event to Your Calendar</h1>
                <a href="usercalendar.php" class="myButton">Calendar</a>
                <a href="useraccount.php" class="myButton">Your Account</a>
            
            <form action="addtocalendar.php" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <legend class="doc">Add Event</legend>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="event" class="doc">Event:</label></div>
                            <div class="col-sm-12 col-md"><input type="text" placeholder="Enter Event..." name="event" id="event" style="width:85%;" class="doc" required=""></div>
                        </div>
                        <div class="row responsive-label">
                            <div class="col-sm-12 col-md-3"><label for="eventdate" class="doc">Date:</label></div>
                            <div class="col-sm-12 col-md"><input type="date" id="eventdate" name="eventdate" style="width:85%;" class="doc" required=""></div>
                        </div>
                        <input type="submit" value="Submit">
                    </fieldset>
                </form>
            </div>
                                    <?php
                                                if(isset($_POST['event'])){

                                                    $eventdate = $conn -> real_escape_string($_POST['eventdate']);
                                                    $eventdata = $conn -> real_escape_string($_POST['event']);
                                                    $userid = $conn -> real_escape_string($_SESSION['user_id']);
                                                    
                                                    $insertevent = "INSERT INTO `usercalendar` (`user_id`,`user_date`, `events`) 
                                                    VALUES ($userid,'$eventdate', '$eventdata')"; 

                                                    $result = $conn -> query($insertevent);

                                                    if(!$result){
                                                        echo $conn -> error;
                                                    } else {
                                                    
                                                    echo "<h1><b>You added your event to your calendar</p></b></h1>";
                                                    }
                                                }

                                    ?>          
        </div>

    </div>

    
</body>



</html>