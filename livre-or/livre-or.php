<!DOCTYPE html>
<html>
    <head>
        <title>livre-or </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="livre-or.css">

    </head>
    <body>
        <h1>My SQL</h1>
        <?php
            $bdd= mysqli_connect("localhost:3306","root","","livreor");
            $req= mysqli_query($bdd,"SELECT * FROM commentaires");  
            $res= mysqli_fetch_all($req); 
 ?>

        <h2>Afficher les commentaires</h2>
        <table>
            <head>
                <?php
                echo '<tr>';                        
                foreach($res[0] as $key => $value){        
                echo "<th>$key</th>"; }
                    echo '</tr>';
                    ?>
            </head>
            <body>
                <tr>
            <?php

              foreach($res as $key => $value){ 
                echo '<tr>';
                foreach ($value as $key1 => $value1) 
                {
                echo "<td>$value1</td>";  
                }
                 echo '</tr>'; 
                }
                ?>

            </body>
        </table>
    </body>
</html>