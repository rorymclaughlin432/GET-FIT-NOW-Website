<?php
include('conn.php');
session_start();

if(!($_SESSION['user_id'] == 2)) {
    header("location: login.php");
}

//$userid = $_GET['rowid'];

//$userinbox = "SELECT * FROM usermessage";

$userinbox = "SELECT admin_inbox.id, admin_inbox.usermessage_id, admin_inbox.usermessage, admin_inbox.messagesent, userdetails.username FROM `admin_inbox` INNER JOIN userdetails WHERE admin_inbox.usermessage_id = userdetails.id ORDER BY `admin_inbox`.`messagesent` DESC";

$result = $conn->query($userinbox);

if(!$result) {
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

    <style>
        
        form {
            background: none;
            border: none;
        }

        .card{
            display: inline-block;
        }

        table th {
            text-align:center;
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
                <h1><b>Admin Inbox</b></h1>
                <div class="column accountmenu">
                <a href='viewusers.php' class='myButton'>Return to View Clients</a>
                <a href='adminreplies.php' class='myButton'>Your Replies</a>
                
                    </div>
                                <?php
                                
                                echo "<table class='doc hoverable'>
                                    <thead class='doc'>
                                        <tr class='doc'>
                                        <th class='doc'>Client</th>
                                        <th class='doc'>Message</th>
                                        <th class='doc'>Date Sent</th>
                                        <th class='doc'>Reply</th>
                                        </tr>
                                    </thead>
                                    <tbody class='doc'>
                                    ";

                            while($row2=$result->fetch_assoc()){
                                $msgid = $row2['id'];
                                $user_id = $row2['usermessage_id'];
                                $u_name = $row2['username'];
                                $umsg = $row2['usermessage'];
                                $msgdate = $row2['messagesent'];
                                $newmsgdate = date('d-m-Y H:i:s', strtotime($msgdate));

                                echo "
                                        <tr class='doc'>
                                        <td data-label='Client' class='doc'>$u_name</td>
                                        <td data-label='Message' class='doc'>$umsg</td>
                                        <td data-label='Date Sent' class='doc'>$newmsgdate</td>
                                        <td data-label='Reply' class='doc'><a href='contactusers.php?rowid=$msgid&userid=$user_id' class='myButton'>Reply</a></td>
                                        </tr>
                                    

                                
                                
                                ";
                            }

                            echo "</tbody>
                            </table>";
                                            ?>

            </div>
                                                        
        </div>

    </div>

    
</body>

            

</html>