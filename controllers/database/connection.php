<?php
    $HOST = ${{ MYSQLHOST }};
    $USERNAME = ${{ MYSQLUSER }};
    $PASSWORD = ${{ MYSQLPASSWORD }};
    $DATABASE = ${{ MYSQLDATABASE }};
    $PORT = ${{ MYSQLPORT }};

    $connection = new mysqli($HOST, $USERNAME, $PASSWORD, $DATABASE, $PORT);
    if ($connection->connect_errno){
        echo "SQL Connection Error!";
        exit();
    }
?>