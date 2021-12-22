<?php 
    session_abort();
    session_reset();

    session_start();
    unset($_SESSION['user']);
    header('Location: ../index.php');
?>