<?php
session_start();
include_once("include/duombaze.php");
echo $_SESSION['kursoID'];
$naujasName=$_POST['name'];
$naujasNotes=$_POST['notes'];
$naujasDate=$_POST['data'];
$naujasPrice=$_POST['price'];
$naujasCapacity=$_POST['capacity'];
    $updateQuery = "UPDATE kursaimano SET name = '".$naujasName."', notes = '".$naujasNotes."', date = '".$naujasDate."', price = '".$naujasPrice."', capacity = '".$naujasCapacity."' WHERE kursaimano.ID = '".$_SESSION['kursoID']."'";
    if (mysqli_query($dbc, $updateQuery))
    {
        {$_SESSION['message_success']="Atnaujinimas sėkmingas";}
    } 
       
    else 
    {
         $_SESSION['message_error']="DB atnaujinimo klaida:" . $updateQuery . "<br>" . mysqli_error($dbc);
    }
    header("Location: index.php");exit;         
?>
