<?php
// meniu.php  rodomas meniu pagal vartotojo rolę

if (!isset($_SESSION)) { header("Location: logout.php");exit;}
include("include/nustatymai.php");
$user=$_SESSION['user'];
$name = $_SESSION['userid'];
$userlevel=$_SESSION['ulevel'];
$role="";
{foreach($user_roles as $x=>$x_value)
			      {if ($x_value == $userlevel) $role=$x;}
} 

     echo "<table style=\"text-align:center\"width=100% border=\"0\" cellspacing=\"1\" cellpadding=\"3\" class=\"meniu\">";
        echo "<tr><td>";
        echo "Prisijungęs vartotojas: <b>".$user." </b>";
        if($_SESSION['user'] != "guest")  
        {
            echo "Rolė: <b>".$role."</b> <br>";
        }          
        echo "</td></tr><tr><td>";
        if ($_SESSION['user'] == "guest")
        {
            echo "<a href=\"register.php\">Registruotis</a> &nbsp;&nbsp";
        } 

        if ($_SESSION['ulevel'] == "3") 
        {
            echo "<a href=\"index.php\">Kursai</a> &nbsp;&nbsp;";
            echo "<a href=\"useredit.php\">Redaguoti paskyrą</a> &nbsp;&nbsp;";
            echo "<a href=\"operacija1.php\">Mano kursai</a> &nbsp;&nbsp;";
        }  
        
        if ($_SESSION['ulevel'] == "2") 
        {
            echo "<a href=\"useredit.php\">Redaguoti paskyrą</a> &nbsp;&nbsp;";
        }  
     //Trečia operacija tik rodoma pasirinktu kategoriju vartotojams, pvz.:
        //Administratoriaus sąsaja rodoma tik administratoriui
        if ($userlevel == $user_roles[ADMIN_LEVEL] ) {
			echo "<a href=\"useredit.php\">Redaguoti paskyrą</a> &nbsp;&nbsp;";
            echo "<a href=\"index.php\">Kursai</a> &nbsp;&nbsp;";
            echo "<a href=\"adminStudentai.php\">Studentai</a> &nbsp;&nbsp;";
            echo "<a href=\"adminLektoriai.php\">Lektoriai</a> &nbsp;&nbsp;";
            echo "<a href=\"admin.php\">Administratoriaus sąsaja</a> &nbsp;&nbsp;";
        }
        echo "<a href=\"logout.php\">Atsijungti</a>";
      echo "</td></tr></table>";
?>       
    
 