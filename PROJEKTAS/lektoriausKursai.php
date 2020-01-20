<?php
// operacija1.php
// skirtapakeisti savo sudaryta operacija pratybose

session_start();
// cia sesijos kontrole
if (!isset($_SESSION['prev']) || ($_SESSION['prev'] != "index"))
{ header("Location:logout.php");exit;}
include("include/functions.php");
include("include/nustatymai.php");

?>

<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=9; text/html; charset=utf-8">
        <title>Demo projektas</title>
        <link href="include/styles.css" rel="stylesheet" type="text/css" >
        <style>
        .filterable {
    margin-top: 15px;
}
.filterable .panel-heading .pull-right {
    margin-top: -20px;
}
.filterable .filters input[disabled] {
    background-color: transparent;
    border: none;
    cursor: auto;
    box-shadow: none;
    padding: 0;
    height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
    color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
    color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
    color: #333;
}

        </style>
    </head>
    <body>
        <table class="center" >
        <tr>
        <td>
            <center><h1>KURSŲ SISTEMA</h1>
            <h3>Darbą atliko: Erikas Sniečkus IFC-7</h3></center>
        </td></tr><tr><td> 
        
<?php
           
    if (!empty($_SESSION['user']))     //Jei vartotojas prisijungęs, valom logino kintamuosius ir rodom meniu
    {                                  // Sesijoje nustatyti kintamieji su reiksmemis is DB
                                       // $_SESSION['user'],$_SESSION['ulevel'],$_SESSION['userid'],$_SESSION['umail']
		
		inisession("part");   //   pavalom prisijungimo etapo kintamuosius
		$_SESSION['prev']="index"; 
        
        include("include/meniu.php");
        ?><hr><center>
        <?php echo "<a href=\"adminLektoriai.php\">Grįžti</a> &nbsp;&nbsp;";?>
        </center>
<hr>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
/*
Please consider that the JS part isn't production ready at all, I just code it to show the concept of merging filters and titles together !
*/
$(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
        }
    });
});
</script>
<!------ Include the above in your HEAD tag ---------->
<?php
                    $naujasID=$_POST['lektoriausID'];
                    $_SESSION['pasirinktasLektorius']=$naujasID;
                    
                    $dbc=mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
                    if(!$dbc){
                        die ("Negaliu prisijungti prie MySQL:"	.mysqli_error($dbc));
                    }
                    $querisas = "SELECT * FROM usersmano WHERE usersmano.userid = '".$naujasID."' AND usersmano.userlevel='2'";
                    $resultas = mysqli_query($dbc, $querisas);
                    if(mysqli_num_rows($resultas) > 0)
                    {
                        while ($row = mysqli_fetch_array($resultas)) 
                        {
                            $vardas = $row['username'];
                            $id = $row['userid'];    
                        }
                        $_SESSION['pasirinktoLektoriausVardas'] = $vardas;  
                        $_SESSION['pasirinktoLektoriausID'] = $id;                  
                    }   
                    else
                    {
                        ?>
                        <h1 style="text-align:center"> Pasirinkto lektoriaus nėra!</h1>
                        <?php
                    }            
                     //  nuskaityti viska bei spausdinti            
                     $sql = "SELECT kursaimano.ID, kursaimano.name, kursaimano.notes, kursaimano.date, kursaimano.price, kursaimano.capacity, usersmano.username
                             FROM kursaimano
                             LEFT JOIN kursaikursantai ON kursaikursantai.coursesID = kursaimano.ID
                             LEFT JOIN usersmano ON usersmano.userid = kursaikursantai.usersID
                             WHERE usersmano.userid = '".$naujasID."' AND usersmano.userlevel = '2'"; 
                     $result = mysqli_query($dbc, $sql);
                        if (mysqli_num_rows($result) > 0)
                        {
                            ?>
<div class="container">
    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $naujasID?> lektoriaus kursai</h3>
                <div class="pull-right">
                    <button class="btn btn-success btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtras</button>
                </div>
            </div>
            
            <table class="table">
                <thead>
                    <tr class="filters">
                    <th><input type="text" class="form-control" placeholder="Numeris" disabled></th>
                    <th><input type="text" class="form-control" placeholder="Pavadinimas" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Užrašai" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Data" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Kaina" disabled></th>
                        <th><input type="text" class="form-control" placeholder="Vietų skaičius" disabled></th>
                    </tr>
                </thead>
                <tbody>
                       <?php
                            while($row = mysqli_fetch_assoc($result))
                         {
                         echo "<tr><td>" .$row['ID'].
                              "</td><td>".$row['name'].
                              "</td><td>".$row['notes'].   
                              "</td><td>".$row['date'].  
                              "</td><td>".$row['price'].
                              "</td><td>".$row['capacity'].                            
                              "</td></tr>";                         
                         }

                         
                        ?>
                        <br>
                        <form method="POST" action="pridetiKursaLektorius.php">
                        <input type="submit" value="Prideti" name="submit">     
                        <?php
                        $dabar = date("Y-m-d");
                        $sql = "SELECT * FROM kursaimano WHERE kursaimano.date > '".$dabar."'"; 
                        $result = mysqli_query($dbc, $sql);
                        ?>
                        <select name="ID">
                        <?php
                        while($row = mysqli_fetch_assoc($result))
                        {
                            echo "<option value=".$row['ID'].">".$row['name']."</option>";
                        }
                        ?>
                        </select>          
                        </form>
                        <?php
                        }
                        else
                        {                                             
                            if(isset($_SESSION['pasirinktoLektoriausVardas']))
                            {
                                ?>
                                <h1 style="text-align:center">Lektorius <?php echo "\"".$_SESSION['pasirinktoLektoriausVardas']."\"" ?> neturi kursų!</h1>

                                <form method="POST" action="pridetiKursaLektorius.php">
                                <input type="submit" value="Prideti" name="submit">     
                                <?php
                                $dabar = date("Y-m-d");
                                $sql = "SELECT * FROM kursaimano WHERE kursaimano.date > '".$dabar."'"; 
                                $result = mysqli_query($dbc, $sql);
                                ?>
                                <select name="ID">
                                <?php
                                while($row = mysqli_fetch_assoc($result))
                                {
                                    echo "<option value=".$row['ID'].">".$row['name']."</option>";
                                }
                                ?>
                                </select>          
                                </form>
                                <?php
                                }
                        }
                        
                     echo "</tbody>";                
                     echo "</table>";                  
                        ?>
        </div>

    </div>
</div>
      <?php
          }                
          else {   			 
              
              if (!isset($_SESSION['prev'])) inisession("full");             // nustatom sesijos kintamuju pradines reiksmes 
              else {if ($_SESSION['prev'] != "proclogin") inisession("part"); // nustatom pradines reiksmes formoms
                   }  
   			  // jei ankstesnis puslapis perdavė $_SESSION['message']
				echo "<div align=\"center\">";echo "<font size=\"4\" color=\"#ff0000\">".$_SESSION['message'] . "<br></font>";          
		
                echo "<table class=\"center\"><tr><td>";
          include("include/login.php");                    // prisijungimo forma
                echo "</td></tr></table></div><br>";
           
          }
?>
            </body>
</html>