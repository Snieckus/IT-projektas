<?php
include("include/nustatymai.php");
$dbc=mysqli_connect('localhost','erisni1', 'Rahnaixopha1aelu','erisni1');
                         if(!$dbc){
                             die ("Negaliu prisijungti prie MySQL:"	.mysqli_error($dbc));
                         }
                         ?>