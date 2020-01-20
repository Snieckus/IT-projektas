<?php
session_start();
include_once("include/duombaze.php");
$naujasName=$_POST['name'];
$naujasNotes=$_POST['notes'];
$naujasDate=$_POST['data'];
$naujasPrice=$_POST['price'];
$naujasCapacity=$_POST['capacity'];
    $Query = "INSERT INTO kursaimano (name, notes, date, price, capacity) 
                    VALUES ('".$naujasName."', '".$naujasNotes."', '".$naujasDate."', '".$naujasPrice."', '".$naujasCapacity."')";

    if (mysqli_query($dbc, $Query))
    {
        {$_SESSION['message_success']="Atnaujinimas sėkmingas";}
    } 
       
    else 
    {
         $_SESSION['message_error']="DB atnaujinimo klaida:" . $Query . "<br>" . mysqli_error($dbc);
    }
    header("Location: index.php");exit;         
?>
