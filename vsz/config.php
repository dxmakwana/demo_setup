<?php
    global $conn;
    global $servername;
    global $username;
    global $password;
    global $dbname;

    $servername = "localhost";
    $dbname = "yuglogix_vszcrm";
    $username = "yuglogix_vszcrm";
    $password = "L0c*ZhO+oucv";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }else {
        //echo 'database connection sucessfulllyyyy'; 
    }
    // $conn -> set_charset("utf8");
    // session_start();
?>
