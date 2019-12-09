<?php
include '../config/config.php';
include '../lib/Database.php';

$db = new Database();

$id = $_GET['varatia_id'];
$query = "SELECT * FROM `room` WHERE `varatia_id`='$id'";
$result = $db->select($query);
if($result){
    while($varatia = $result->fetch_assoc()){
        $fare = $varatia['fair'];
    }
}

echo $fare;