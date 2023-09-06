<?php
include('conn.php');
session_start();

if(!($_SESSION['user_id'] == 2)) {
    header("location: login.php");
}

//$username = $_SESSION['user_id'];

$userid = $_GET['rowid'];
$user_type = $_GET['typeid'];

$userevents = "SELECT * FROM usercalendar WHERE user_id = '$userid' ";

$result = $conn->query($userevents);

	if(!$result){
     echo $conn->error;
     echo $userevents;
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>40022221 Web Project</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mini.css/3.0.1/mini-default.min.css">
    <link rel="stylesheet" href="gui.css">
    <link rel="stylesheet" href="demo.css">
    <link rel="stylesheet" href="theme2.css">
    

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

            <?php 
            $userna = "SELECT * FROM userdetails WHERE id = '$userid'";

            $resultname = $conn->query($userna);

            if(!$resultname) {
                echo $conn->error;
            }



            while($rowname=$resultname->fetch_assoc()){
                $u_name = $rowname['username'];
                $usertype = $rowname['usertype_id'];

            echo "
            <div class='column accountmenu'>
                <a href='index.php' class='myButton'>Return to Home</a> 
                <a href='viewusersdetails.php?typeid=$usertype&rowid=$userid' class='myButton'>View $u_name's Details</a>
                <a href='editusers.php?typeid=$usertype&rowid=$userid' class='myButton'>Edit $u_name's Details</a>
                <a href='viewusercalendar.php?typeid=$usertype&rowid=$userid' class='myButton'>View $u_name's Calendar</a>
                <a href='viewuserstodolist.php?typeid=$usertype&rowid=$userid' class='myButton'>View $u_name's To Do List</a>
                <a href='deleteusers.php?typeid=$usertype&rowid=$userid' class='myButton'>Delete $u_name's Account</a>
                        </div>

                <h1>$u_name Calendar</h1>

                ";
            }
                ?>
                
                <div id="caleandar"></div>

                    <script type="text/javascript" src="caleandar.js"></script>

                    <script>
                    
                    <?php 
                    
                    echo "var eventsarray = ["; 

                    while($row = $result->fetch_assoc()){
                   
                        $event = $row['events'];
                        $daydata = $row['user_date'];
                        $calid = $row['id'];
                        //$userid = $_SESSION['user_id'];
            
                       // echo "date: $daydata, title: $titledata, link: diarydetails.php?rowid=$calid <br>";
                        $daydatamodify = new DateTime($daydata);
                        $daydatamodify -> modify('-1 month');
                        $newdaydata = $daydatamodify -> format('Y, m, d');
                        
                        //$newday = date('Y,m,d', strtotime($daydata));
                        
                        echo "{
                            'Date': new Date($newdaydata),
                            'Title': '$event',
                            'ID': '$calid',
                            'Link': 'usercalendardetails.php?rowid=$calid&date=$daydata'
                        },";
                    }
                
                    echo "];";
                    ?>

                    var settings = {
                        NavShow: true,
                        EventTargetWholeDay: false
                    };
            
                    var cal_element = document.getElementById('caleandar');
            
                    caleandar(cal_element, eventsarray, settings);
                </script>
            

                
                

            </div>
        </div>

    </div>

</body>



</html>