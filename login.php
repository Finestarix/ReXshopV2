<?php
    include_once './controllers/csrf_controller.php';
    session_start();
    
    if (isset($_SESSION['user'])) {
        if (isset($_SERVER['HTTP_REFERER'])) header('Location: ' . $_SERVER['HTTP_REFERER']);
        else header('Location: ./index.php');
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ReXshop Login | Programming for Penetration Testing</title>
        <link rel="icon" href="./assets/icons/favicon.ico">

        <link href="./assets/css/tailwind.css" rel="stylesheet">
        <link href="./assets/css/fontawesome.css" rel="stylesheet">

        <script defer src="assets/js/alpine.min.js"></script>

        <style>
            body::-webkit-scrollbar {display: none;}
            body {background-image: url('./assets/images/login_background.jpg'); background-repeat: no-repeat; background-position: center; background-size: cover;}
            #form-container {background-color: rgba(255, 255, 255, 0.7); backdrop-filter: blur(2px); border: 1px solid rgba(255, 255, 255, 0.125);}
        </style>
    </head>
    <body class="min-h-screen">
        <div class="mx-auto absolute inset-0 flex items-center justify-center">
            <div class="w-96 bg-white py-6 px-8 shadow rounded-lg" id="form-container">
                <div class="px-4 py-4 sm:px-0">
                    <p class="mb-4 text-center text-3xl font-bold text-red-500">Sign In</p>

                    <form class="my-3 space-y-3" action="./controllers/login_controller.php" method="POST">

                        <input type="hidden" name="csrf_token" value="<?= get_token() ?>">

                        <div class="rounded-md shadow-sm -space-y-px">
                            <input id="username" name="username" type="text" autocomplete="username" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-red-300 placeholder-red-300 text-red-500 font-bold rounded-t-md focus:outline-none focus:ring-red-500 focus:border-red-500 focus:z-10 sm:text-sm" placeholder="Username">
                            <input id="password" name="password" type="password" autocomplete="current-password" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-red-300 placeholder-red-300 text-red-500 font-bold rounded-b-md focus:outline-none focus:ring-red-500 focus:border-red-500 focus:z-10 sm:text-sm" placeholder="Password">
                        </div>

                        <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">Sign in</button>
                    </form>

                    <?php if (isset($_SESSION['error_message'])) { ?>
                        <p class="text-center text-red-500 font-bold"><?= $_SESSION['error_message'] ?></p>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </body>
</html>