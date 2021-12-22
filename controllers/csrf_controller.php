<?php
    function check_token(){
        return isset($_SESSION['csrf_token']);
    }

    function regenerate_token() {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(64));
    }

    function get_token() {
        if(!check_token()) regenerate_token();
        return $_SESSION['csrf_token'];
    }

    if(!check_token()) regenerate_token();
?>