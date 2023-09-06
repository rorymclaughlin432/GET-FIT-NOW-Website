<?php
//declare password
$pw="rk8fYd8mX8l3dr3F";

//declare MySQL username
$user = "rmclaughlin27";

//declare webserver
$webserver = "rmclaughlin27.lampt.eeecs.qub.ac.uk";

//declare DB  
$db = "rmclaughlin27";

//mysqli api library in PHP to connect to the DB
$conn = new mysqli($webserver, $user, $pw, $db);

if($conn->connect_error){
    echo "Connection failed: ".$conn->connect_error;
}

