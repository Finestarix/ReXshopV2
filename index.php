<?php
    include_once './controllers/database/connection.php';
    session_start();

    $products = $connection->query("SELECT `id`, `name`, `description`, `price`, `rating` FROM `products`");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ReXshop | Programming for Penetration Testing</title>
        <link rel="icon" href="./assets/icons/favicon.ico">

        <link href="./assets/css/tailwind.css" rel="stylesheet">
        <link href="./assets/css/fontawesome.css" rel="stylesheet">

        <script defer src="assets/js/alpine.min.js"></script>

        <style>body::-webkit-scrollbar {display: none;}</style>
    </head>
    <body class="min-h-screen bg-gray-100">

        <nav x-data="{isMenuOpen: false}" class="bg-white shadow-sm">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">

                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <img class="h-8 w-auto" src="./assets/images/logo.png" alt="ReXshop">
                        </div>
                        <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                            <a class="border-red-500 text-red-500 inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium" aria-current="page">Products</a>
                        </div>
                    </div>

                    <div class="-mr-2 flex items-center sm:hidden">
                        <button @click="isMenuOpen = !isMenuOpen" type="button" class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" aria-controls="mobile-menu" aria-expanded="false">
                        <i x-show="!isMenuOpen" class="fas fa-bars"></i>
                        <i x-show="isMenuOpen" class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="hidden sm:flex flex items-center">
                        <?php if(!isset($_SESSION['user'])) { ?>
                            <a href="./login.php" class="ml-6 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Sign In</a>
                        <?php } else { ?>
                            <a href="./controllers/logout_controller.php" class="ml-6 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Sign Out</a>
                        <?php } ?>
                    </div>

                </div>
            </div>

            <div x-show="isMenuOpen" class="sm:hidden" id="mobile-menu">
                <div class="pt-2 pb-3 space-y-1">
                    <a class="bg-red-50 border-red-500 text-red-500 block pl-3 pr-4 py-2 border-l-4 text-base font-medium" aria-current="page">Products</a>
                    <?php if(!isset($_SESSION['user'])) { ?>
                        <a href="./login.php" class="border border-transparent rounded-md shadow-sm text-white bg-red-500 block mx-1 pl-3 pr-4 py-2 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 text-base font-medium" aria-current="page">Sign In</a>
                    <?php } else { ?>
                        <a href="./controllers/logout_controller.php" class="border border-transparent rounded-md shadow-sm text-white bg-red-500 block mx-1 pl-3 pr-4 py-2 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 text-base font-medium" aria-current="page">Sign Out</a>
                    <?php } ?>
                </div>
            </div>

        </nav>

        <div class="py-10">

            <header>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <h1 class="text-3xl font-bold leading-tight text-red-500">List Products</h1>
                </div>
            </header>

            <main>
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="px-4 py-8 sm:px-0">
                        <ul id="product-container" role="list" class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                            <?php while($product = $products->fetch_assoc()) { ?>
                                <li class="product-content relative">
                                    <div class="group block w-full rounded-lg bg-gray-100 overflow-hidden">
                                        <img src="./assets/images/products/<?= $product['id'] ?>.webp" alt="<?= $product['id'] ?>" class="product-image object-cover pointer-events-none group-hover:opacity-75">
                                    </div>
                                    <p class="product-name mt-2 block text-lg font-bold text-red-500 truncate pointer-events-none"><?= $product['name'] ?></p>
                                    <p class="product-description mt-1 block text-sm font-base text-gray-500 truncate pointer-events-none"><?= $product['description'] ?></p>
                                    <div class="flex justify-between items-center mt-1 block text-sm font-medium text-red-500 pointer-events-none">
                                        <div>
                                            <?php for($i = 0 ; $i < 5 ; $i++) { ?>
                                                <?php if ($i < (int) $product['rating']) { ?>
                                                    <i class="fas fa-star"></i> 
                                                <?php } else if ($i == (int) $product['rating']) { ?>
                                                    <i class="fas fa-star-half-alt"></i>
                                                <?php } else { ?>
                                                    <i class="far fa-star"></i> 
                                                <?php } ?>
                                            <?php } ?>
                                            <span class="product-rating"><?= $product['rating'] ?></span>
                                        </div>
                                        <div class="product-price text-lg">IDR<?= $product['price'] ?></div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </main>

        </div>

        <footer class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 md:flex md:items-center md:justify-between lg:px-8">
                <div class="md:mt-0 md:order-1">
                    <p class="text-center text-base text-gray-400">
                        &copy; 2021 Software Laboratory Center (SLC).
                    </p>
                </div>
            </div>
        </footer>

    </body>
</html>
