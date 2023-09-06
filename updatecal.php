<?php
include('conn.php');

session_start();

if(!isset($_SESSION['user_id'])){
    
    header("location: login.php");
} 

$username = $_SESSION['user_id'];

$calendar_id = $_GET['rowid'];

$calendar = "SELECT * FROM usercalendar WHERE id = '$calendar_id' AND user_id = '$username'";

$result = $conn->query($calendar);
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
            <h2> Edit Your Calendar Event Name </h2>
            <a href="usercalendar.php" class="myButton">Return to Calendar</a>
            
            <form action='updatecal.php?rowid=$calendar_id' method='POST' enctype="multipart/form-data" display="grid" id="userform">
            
                                <?php
                                    $userevents = "SELECT  * FROM usercalendar WHERE id = '$calendar_id' AND user_id = '$username'";
                                    $resultevents = $conn->query($userevents);

                                                    $eventname = "";
                                                    $eventnameid = "";
                                            while($rowevent=$resultevents->fetch_assoc()){

                                                $eventname = $rowevent['events'];
                                                $eventnameid = $rowevent['id'];
                                            }            
                                
                     echo "                   
                     <label><b>Calendar Event Name:</b></label> 
                     <input type='text' name='event' value='$eventname'/>
                     <input value='$eventnameid' type='hidden' name='calid'>
                     <input type='submit' name='update_calendar_name' value='Update Task'/>";
                    ?>
                    <?php
                            if(isset($_POST['update_calendar_name'])){
                                                                                
                                $eventdata = $conn -> real_escape_string($_POST['event']);
                                $event_id = $conn -> real_escape_string($_POST['calid']);
                                
                                $update_event = "UPDATE usercalendar SET events = '$eventdata' WHERE id = '$event_id' AND user_id = '$username'";
                                
                                $resultcalname = $conn->query($update_event);
                                
                                if(!$resultcalname){
                                    echo $conn -> error;
                                } else {
                                //echo $update_event;
                                echo "<p><b>The name of your event has been updated!</b></p>";
                                }
                                
                            }
                            
                    ?>
                </form>

            </div>

            </div>
            <div id="blogtext">
            <h2> Edit Your Calendar Date </h2>
            <a href="usercalendar.php" class="myButton">Return to Calendar</a>
            <form action='updatecal.php?rowid=$task_id' method='POST' enctype="multipart/form-data" display="grid" id="userform">
                                
                                <?php
                                    $userevents = "SELECT  * FROM usercalendar WHERE id = '$calendar_id' AND user_id = '$username'";
                                    $resultevents = $conn->query($userevents);

                                            $eventdateid = "";
                                            $daydata = "";
                                            while($rowdate=$resultevents->fetch_assoc()){

                                                $eventdateid = $rowdate['id'];
                                                $daydata = $rowdate['user_date'];
                                                $newday = date('d-m-Y', strtotime($daydata));

                                            }            
                                
                    echo "
                     <label><b>Calendar Event Date:</b></label> 
                     <input type='date' name='eventdaydate' value='$daydata'/>
                     <input value='$eventdateid' type='hidden' name='cal_date_id'>
                     <input type='submit' name='update_calendar_date' value='Update Task'/>";

                     ?>

                    <?php
                        if(isset($_POST['update_calendar_date'])){
                                                    
                            $event_date_id = $_POST['cal_date_id'];
                            $eventdate = date('Y-m-d', strtotime($_POST['eventdaydate']));
                            $userday = $_POST['eventdaydate'];
                            
                            
                            $update_event_date = "UPDATE usercalendar SET user_date = '$userday' WHERE id = '$event_date_id' AND user_id = '$username'";

                            $resultcaldate = $conn->query($update_event_date);
                                 
                            if(!$resultcaldate){
                                echo $conn -> error;
                            } else {
                                //echo $update_event_date;
                                echo "<p><b>The date of your event has been updated!</b></p>";
                            }
                        }
                    ?>
                </form>

            </div>
        </div>

    </div>
</body>



</html>