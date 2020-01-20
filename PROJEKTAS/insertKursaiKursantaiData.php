<?php
session_start();
include_once("include/duombaze.php");
$naujasID=$_POST['kursoIDIvestas'];
$query2 = "SELECT * FROM kursaikursantai WHERE coursesID = '" .$naujasID. "' AND usersID = '" .$_SESSION['userid']. "'";
$query3 = "SELECT * FROM kursaimano WHERE kursaimano.ID = '" .$naujasID. "'";
//$query4 = "SELECT "
$resultas = mysqli_query($dbc, $query3);  
while ($row = mysqli_fetch_array($resultas)) 
{
    $capacity = $row['capacity'];  
}
if($capacity > 0)
{
    $result = mysqli_query($dbc, $query2);
    if(mysqli_num_rows($result) > 0)
    {
        $_SESSION['message_error'] = "Jūs jau turite šį kursą savo sąraše.";
        header("Location: index.php");exit;
    }
    
        $query = "INSERT INTO kursaikursantai (coursesID, usersID) VALUES ('".$naujasID."', '".$_SESSION['userid']."')";
        $query1 = "UPDATE kursaimano SET capacity = capacity-1  WHERE  kursaimano.ID ='$naujasID'";
                                          if (mysqli_query($dbc, $query))
                                          {
                                              {$_SESSION['message_success']="Sėkmingai užsiregistravote";}
                                          } 
                                             
                                          else 
                                          {
                                               $_SESSION['message_error']="DB iterpimo klaida:" . $query . "<br>" . mysqli_error($dbc);
                                          }
                                          if (mysqli_query($dbc, $query1))
                                          {
                                              {$_SESSION['message_success']="Sėkmingai užsiregistravote";}
                                          } 
                                             
                                          else 
                                          {
                                               $_SESSION['message_error']="DB iterpimo klaida:" . $query1 . "<br>" . mysqli_error($dbc);
                                          }
}
else
{
    $_SESSION['message_error']="Nebėra laisvų vietų į šį kursą";
}

                                      

                                      header("Location: index.php");exit;
                                      ?>          