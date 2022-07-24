<?php

function access($rank){
    if(isset($_SESSION["ACCESS"]) && !$_SESSION["ACCESS"][$rank]){
        header("Location: denied.php");
        die;
    }
} 


$_SESSION["ACCESS"]["ADMIN"] =isset($_SESSION['myrank']) && trim($_SESSION['myrank']) =="admin";

$_SESSION["ACCESS"]["USER"] = isset($_SESSION['myrank']) && (trim($_SESSION['myrank']) =="user" || trim($_SESSION['myrank']) =="admin" || trim($_SESSION['myrank']) =="receptionist");

$_SESSION["ACCESS"]["RECEPTIONIST"] = isset($_SESSION['myrank']) && (trim($_SESSION['myrank']) =="receptionist" || trim($_SESSION['myrank']) =="admin");
// var_dump($receptionist);




 