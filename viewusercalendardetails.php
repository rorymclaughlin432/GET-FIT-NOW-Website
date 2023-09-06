<?php
include('conn.php');
session_start();

if(!($_SESSION['user_id'] == 2)) {
    header("location: login.php");
}

$username = $_SESSION['user_id'];

$id = isset($_GET['rowid']) ? $_GET['rowid'] : '';

$userevent = "SELECT * FROM usercalendar WHERE id = '$id'";

//$userevent = $userevent = "SELECT userdetails.username, usercalendar.user_date, usercalendar.events FROM usercalendar INNER JOIN userdetails ON usercalendar.user_id = userdetails.id WHERE userdetails.id = $username"; 

$result = $conn->query($userevent);

if(!$result) {
    echo $conn->error;	
}

while($row = $result->fetch_assoc()){

    $cal_id = $row['id'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>40022221 Web Project</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
    
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link rel="stylesheet" href="theme2.css" />
    <link rel="stylesheet" href="demo.css" />
    <!--https://www.w3schools.com/howto/howto_css_column_cards.asp!-->
    <link rel="stylesheet" href="gui.css">
                <style>
                    table, th, td {
                    border: 1px solid black;
                    }

                    .column2 {
                    float: left;
                    width: 25%;
                    padding: 10px 10px 10px 10px;
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

            <div class="column accountmenu">
                <a href="index.php" class="myButton">Return to Home</a> 
                <a href="edituseraccount.php" class="myButton">Edit Your Account</a>
                <a href="usercalendar.php" class="myButton">Calendar</a>
                <a href="updatecalendar.php?rowid=$cal_id" class="myButton">Edit client Calendar</a>
                <a href="addtocalendar.php" class="myButton">Add Event to client's Calendar</a>
                <a href="usercalendardetails.php" class="myButton">View client's Calendar Events</a>
                        </div>

                            <h1><b>Your Events</b></h1>
    
                            <?php

                                    $usercal="SELECT * FROM usercalendar WHERE id = '$id'";

                                    //$userevent = $userevent = "SELECT userdetails.username, usercalendar.user_date, usercalendar.events FROM usercalendar INNER JOIN userdetails ON usercalendar.user_id = userdetails.id WHERE userdetails.id = $username"; 

                                    $resultcalendar = $conn->query($usercal);

                                    if(!$resultcalendar) {
                                        echo $conn->error;	
                                    }
                                    while($row2 = $resultcalendar->fetch_assoc()){

                                                    //$usernam =['username']; 
                                                    $calendar_id = $row2['id'];                                
                                                    $event = $row2['events'];
                                                    $daydata = $row2['user_date'];
                                                    $newday = date('d-m-Y', strtotime($daydata));
                                                
                                                    echo "
                                                        <div class='column2'>
                                                                <div class='card'>
                                                                    <div class='section'>
                                                                        <h3 class='doc'><b>Event:</b></h3> <p class='doc'>$event</p>
                                                                        <h3 class='doc'><b>Date:</b></h3> <p class='doc'>$newday</p>
                                                                        <a href='updatecal.php?rowid=$calendar_id' class='myButton'>edit</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                
                                                        
                                                ";

                                    }
                                ?>
        </div>

    </div>

</body>

</html>