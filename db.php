<?php
    $host_name  = "db606994136.db.1and1.com";
    $database   = "db606994136";
    $user_name  = "dbo606994136";
    $password   = "1-1a76forme";


    $connect = mysqli_connect($host_name, $user_name, $password, $database);

    if(mysqli_connect_errno())
    {
    echo '<p>Verbindung zum MySQL Server fehlgeschlagen: '.mysqli_connect_error().'</p>';
    }
    else
    {
    echo '<p>Verbindung zum MySQL Server erfolgreich aufgebaut.</p>';
    }
?>
