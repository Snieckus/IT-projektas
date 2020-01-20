<?php
session_start();
include_once("include/duombaze.php");
echo $_SESSION['kursoID'];
$naujasCapacity=$_POST['capacity'];
    $updateQuery = "UPDATE kursaimano SET capacity = 0 WHERE kursaimano.ID = '".$_SESSION['kursoID']."'";
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
