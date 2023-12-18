<header class="mb-5">
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
            </a>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button type="button" class="flex text-sm bg-white rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <div class="relative">
                        <img class="w-10 h-10 object-cover rounded-full" src="img/cart.png" alt="">
                        <span class="top-0 left-7 absolute w-6 h-6 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full">
                            <?php

                            if (isset($_SESSION['panier']) == true) {
                                print(count($_SESSION['panier']));
                            } else print 0;
                            ?>
                        </span>
                    </div>
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                    <?php if (isset($_SESSION['login']) == true) { ?>
                        <div class="px-4 py-3">
                            <span class="block text-sm dark:text-white ">Bienvenue</span>
                            <span class="block text-sm text-gray-500 truncate dark:text-gray-400"><?= $_SESSION['login']; ?></span>
                        </div>
                    <?php } ?>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="panier.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Mon panier</a>
                        </li>
                        <?php if (isset($_SESSION['panier']) === true) {
                            if (isset($_POST['paniervide'])) {
                                unset($_SESSION['panier']);
                                $url = $_SERVER['REQUEST_URI'];
                                header("Location:$url");
                                header_remove("Location");
                                exit;
                            }
                            foreach ($_SESSION['panier'] as $row) {
                                $produit = $db->getProductInfo(["id_produit" => $row[0]]);
                        ?>
                                <li>
                                    <span class="block text-sm text-gray-500 truncate dark:text-white m-2"><?= $produit['Nom_court']; ?> : <?= $row[1]; ?></span>
                                </li>
                            <?php   } ?>

                            <form method="post">
                                <button type="sumbit" name="paniervide" class="m-2.5 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Vider le panier</button>
                            </form>

                        <?php } ?>


                        <?php if (isset($_SESSION['login']) == true) { ?>
                            <li>
                                <a href="_pages/deco.php" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
                <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul class="flex flex-col md:-ml-24 font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    <li>
                        <a href="index.php" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 md:dark:text-blue-500" aria-current="page">Home</a>
                    </li>
                    <?php if (isset($_SESSION['login']) == false) { ?>
                        <li>
                            <a href="register.php" class="block py-2 px-3 text-white text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0  md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Register</a>
                        </li>
                        <li>
                            <a href="login.php" class="block py-2 px-3 text-white text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0  md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Login</a>
                        </li>
                    <?php } ?>
                    <?php if (isset($_SESSION['login']) == true && $_SESSION['type'] == 2) { ?>
                        <li>
                            <a href="admin.php" class="block py-2 px-3 text-white text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0  md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Dashboard admin</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
</header>