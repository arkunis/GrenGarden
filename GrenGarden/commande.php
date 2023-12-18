<?php
session_start();
require_once('php/config/config.php');
$db = new db();
$db->connexion();
if (isset($_SESSION['login']) == false && $_SESSION['type'] != 2) {
    header('Location: index.php');
}

// On détermine sur quelle page on se trouve
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
} else {
    $currentPage = 1;
}
$nombre = 4;
$pages = $db->getPage($nombre);
$users = $db->getPremier($currentPage, $nombre);

?>
<!DOCTYPE html>
<html lang="en">

<?php include('_pages/head.php'); ?>

<body>
    <main class="min-h-[56vh]">
        <!-- component -->
        <style>
            /* Custom style */
            .header-right {
                width: calc(100% - 3.5rem);
            }

            .sidebar:hover {
                width: 16rem;
            }

            @media only screen and (min-width: 768px) {
                .header-right {
                    width: calc(100% - 16rem);
                }
            }
        </style>
        <div>
            <div class="min-h-screen flex flex-col flex-auto flex-shrink-0 antialiased bg-white dark:bg-gray-700 text-black dark:text-white">

                <!-- Header -->
                <div class="fixed w-full flex items-center justify-between h-14 text-white z-10">
                    <div class="flex items-center justify-start md:justify-center pl-3 w-14 md:w-64 h-14 bg-blue-800 dark:bg-gray-800 border-none">
                        <img class="w-7 h-7 md:w-10 md:h-10 mr-2 rounded-md overflow-hidden" src="https://therminic2018.eu/wp-content/uploads/2018/07/dummy-avatar.jpg" />
                        <span class="hidden md:block"><?= $_SESSION['login']; ?></span>
                    </div>
                    <div class="flex justify-between items-center h-14 bg-blue-800 dark:bg-gray-800 header-right">
                        <div class="rounded flex items-center w-full max-w-xl mr-4 p-2">

                        </div>
                        <ul class="flex items-center">
                            <li>
                                <div class="block w-px h-6 mx-3 bg-gray-400 dark:bg-gray-700"></div>
                            </li>
                            <li>
                                <a href="_pages/deco.php" class="flex items-center mr-4 hover:text-blue-100">
                                    <span class="inline-flex mr-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                    </span>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ./Header -->

                <!-- Sidebar -->
                <?php include('_pages/sidebar_admin.php'); ?>


                <div class="h-full ml-14 mt-14 mb-10 md:ml-64">

                    <?php include('_pages/static_card.php'); ?>

                    <div class="grid grid-cols-1 lg:grid-cols-1 p-4 gap-4">

                        <!-- Social Traffic -->
                        <div class="overflow-scroll h-96 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
                            <div class="rounded-t mb-0 px-0 border-0">
                                <div class="flex flex-wrap items-center px-4 py-2">
                                    <div class="relative w-full max-w-full flex-grow flex-1">
                                        <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Commandes effectuées</h3>
                                    </div>

                                </div>
                                <div class="block w-full overflow-x-auto">
                                    <table class="items-center w-full bg-transparent border-collapse">
                                        <thead>
                                            <tr>
                                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Num. commande</th>
                                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Date</th>
                                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">Statut</th>
                                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">Client</th>
                                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">Type de paiement</th>
                                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">Remise</th>
                                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">Modifier/Supprimer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($db->getCommandeAll() as $row) {
                                                $result = $db->getClientId(['ids' => $row['Id_Client']]);
                                                $facture = $db->getFacture(["ids" => $row['Id_Commande']]);

                                                if (isset($_POST['suppCommande_' . $row['Id_Commande']])) {
                                                    $db->suppCommande(["com_id" => $row['Id_Commande']]);
                                                    $db->suppFacture(["fac_id" => $facture['Id_Facture']]);
                                                }
                                                if (isset($_POST['updateCommande_' . $row['Id_Commande']])) {
                                                    $db->UpdateCommande(["stat" => $_POST['statut'], "idC" => $row['Id_Commande']]);
                                                }
                                                $nomPaiement = $db->getNomPay(["ids" => $row['Id_TypePaiement']]);
                                            ?>
                                                <tr class="text-gray-700 dark:text-gray-100">
                                                    <form method="post">
                                                        <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left"><?= $row['Num_Commande']; ?></th>
                                                        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"><?= $row['Date_Commande']; ?></td>
                                                        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 dark:text-black"><input value="<?= $row['Id_Statut']; ?>" type="number" name="statut" maxlength="1"></td>
                                                        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"><?= $result['Nom_Client'] ?> <?= $result['Prenom_Client'] ?></td>
                                                        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"><?= $nomPaiement['Libelle_TypePaiement']; ?></td>
                                                        <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"><?= $row['Remise_Commande']; ?></td>
                                                        <td class="flex flex-row border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">

                                                            <button type="sumbit" name="updateCommande_<?= $row['Id_Commande']; ?>" class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">Modifier</button>
                                                    </form>
                                                    <form method="post">
                                                        <button type="submit" name="suppCommande_<?= $row['Id_Commande']; ?>" class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Supprimer</button>
                                                    </form>
                                                    </td>
                                                </tr>
                                                <!-- Main modal -->

                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ./Social Traffic -->
                        <div class="flex flex-col md:flex-row gap-5 items-center md:justify-center">
                            <?php foreach ($db->getStatutCommande() as $row) { ?>
                                <p><?= $row['Id_Statut']; ?> : <?= $row['Libelle_Statut']; ?></p>
                            <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
    </main>
</body>

</html>