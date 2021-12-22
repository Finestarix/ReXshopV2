<?php
    $HOST = getenv('MYSQLHOST');
    $USERNAME = getenv('MYSQLUSER');
    $PASSWORD = getenv('MYSQLPASSWORD');
    $DATABASE = getenv('MYSQLDATABASE');
    $PORT = getenv('MYSQLPORT');

    $connection = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE, $PORT);
    if ($connection->connect_errno){
        echo "SQL Connection Error!";
        exit();
    }
?>