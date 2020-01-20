<?php
session_start();
include_once("include/duombaze.php");
if(isset($_POST['submit']))
        {           
            $idedamasID = $_POST['ID'];
            $sql = "SELECT * FROM kursaimano 
            LEFT JOIN kursaikursantai ON kursaikursantai.coursesID = kursaimano.ID 
            LEFT JOIN usersmano on usersmano.userid = kursaikursantai.usersID 
            WHERE usersmano.userid = '".$_SESSION['pasirinktasStudentasID']."' AND kursaimano.ID = '".$idedamasID."'";
            $result = mysqli_query($dbc, $sql);
                if(mysqli_num_rows($result) > 0)
                {
                    $_SESSION['message_error'] = "Šis studentas jau turi šį kursą.";
                    header("Location: adminStudentai.php");exit;
                }
                else
                {
                    $query = "INSERT INTO kursaikursantai (coursesID, usersID) VALUES ('".$idedamasID."', '".$_SESSION['pasirinktasStudentasID']."')";
                    if (mysqli_query($dbc, $query))
                    {
                        {$_SESSION['message_success']="Atnaujinimas sėkmingas";}
                    }
                    
                    else 
                    {
                        $_SESSION['message_error']="DB atnaujinimo klaida:" . $query . "<br>" . mysqli_error($dbc);
                    }
                    header("Location: adminStudentai.php");exit;
                }         
        }
        else
        {
            $_SESSION['message_error']="Neisgauti duomenys";
            header("Location: adminStudentai.php");exit;    
        }
   
?>
