<?php
$user="root";
$pass="";
try {
    $dbh = new PDO("mysql:host=localhost;dbname=pv121;port=3308",$user,$pass);
}catch(Exception $ex) {
    print "Error! ".$ex->getMessage(). "<br/>";
    exit();
}