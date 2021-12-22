<?php 
    include_once './database/connection.php';
    include_once './csrf_controller.php';
    session_start();

    $csrf_token = $_POST['csrf_token'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (get_token() !== $csrf_token) $_SESSION['error_message'] = 'Invalid request!';
    else if ($username === '') $_SESSION['error_message'] = 'Username must be filled!';
    else if ($password === '') $_SESSION['error_message'] = 'Password must be filled!';
    
    if (!isset($_SESSION['error_message'])) {
        $users = $connection->query("SELECT `username`, `password` FROM `users` WHERE `username` = '$username'");
        if ($users->num_rows == 1) {
            $user = $users->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                session_regenerate_id(true);
                die(header('Location: ../index.php'));
            } 
            else $_SESSION['error_message'] = 'Invalid credentials!';
        } 
        else if ($users->num_rows > 1) $_SESSION['error_message'] = 'Invalid request!';
        else $_SESSION['error_message'] = 'Invalid credentials!';
        
    }

    die(header('Location: ../login.php'));
?>
