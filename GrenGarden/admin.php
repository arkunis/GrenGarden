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

if (isset($_POST['produit'])) {

    $tva = htmlentities(stripcslashes($_POST['tva']));
    $nomc = htmlentities(stripcslashes($_POST['nom']));
    $noml = htmlentities(stripcslashes($_POST['nom2']));
    $ref = htmlentities(stripcslashes($_POST['ref']));
    $photo = htmlentities(stripcslashes($_POST['photo']));
    $prix = htmlentities(stripcslashes($_POST['prix']));
    $four = htmlentities(stripcslashes($_POST['fournisseur']));
    $cat = htmlentities(stripcslashes($_POST['cat']));

    $rFou = $db->getFour(["lib" => $four]);
    $rCat = $db->getCatProduit(["lib" => $cat]);

    $done = $db->insertProduit(["tva" => $tva, "noml" => $noml, "nomc" => $nomc, "refs" => $ref, "ph" => $photo, "prix" => $prix, "idFour" => $rFou['Id_Fournisseur'], "idCat" => $rCat['Id_Categorie']]);
    exit;
}

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

<?php include('_pages/sidebar_admin.php'); ?>

                <div class="h-full ml-14 mt-14 mb-10 md:ml-64">

<?php include('_pages/static_card.php'); ?>

                    <div class="grid grid-cols-1 lg:grid-cols-2 p-4 gap-4">

                        <!-- Social Traffic -->
                        <div class="relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
                            <div class="rounded-t mb-0 px-0 border-0">
                                <div class="flex flex-wrap items-center px-4 py-2">
                                    <div class="relative w-full max-w-full flex-grow flex-1">
                                        <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">5 Derniers produits ajouté</h3>
                                    </div>
                                    <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                                        <button data-modal-target="produit" data-modal-toggle="produit" class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="btn">Ajouter un produit</button>
                                    </div>
                                </div>
                                <div class="block w-full overflow-x-auto">
                                    <table class="items-center w-full bg-transparent border-collapse">
                                        <thead>
                                            <tr>
                                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Catégorie</th>
                                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Nom</th>
                                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">Référence</th>
                                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left min-w-140-px">Modifier/Supprimer</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $counter = 0;
                                            foreach ($db->getProductAll() as $row) {
                                                $nom_cat = $db->getCatNom(["cat" => $row['Id_Categorie']]);
                                                if ($counter == 5) {
                                                    break;
                                                }
                                                $counter++;
                                                if (isset($_POST['suppProduit_' . $row['Id_Produit']])) {
                                                    $db->suppProduct(["produit" => $row['Id_Produit']]);
                                                }
                                                $result_cat = $db->getCatNom(["cat" => $row['Id_Categorie']]);
                                                $result_for = $db->getFourUp(["four" => $row['Id_Fournisseur']]);


                                                if (isset($_POST['modifProduit_' . $row['Id_Produit']])) {

                                                    $tva = htmlentities(stripcslashes($_POST['tva_' . $row['Id_Produit']]));
                                                    $noml = htmlentities(stripcslashes($_POST['noml_' . $row['Id_Produit']]));
                                                    $nomc = htmlentities(stripcslashes($_POST['nomc_' . $row['Id_Produit']]));
                                                    $ref = htmlentities(stripcslashes($_POST['ref_' . $row['Id_Produit']]));
                                                    $photo = htmlentities(stripcslashes($_POST['photo_' . $row['Id_Produit']]));
                                                    $prix = htmlentities(stripcslashes($_POST['prix_' . $row['Id_Produit']]));
                                                    $fours = htmlentities(stripcslashes($_POST['fournisseur_' . $row['Id_Produit']]));
                                                    $cat_p = htmlentities(stripcslashes($_POST['cat_' . $row['Id_Produit']]));
                                                    $rFou = $db->getFour(["lib" => $fours]);
                                                    $rCat = $db->getCatProduit(["lib" => $cat_p]);
                                                    if (isset($rCat['Id_Categorie']) > 0) {
                                                        $db->updateProduit(["tva" => $tva, "nomL" => $noml, "nomC" => $nomc, "refs" => $ref, "img" => $photo, "prix" => $prix, "fours" => $rFou['Id_Fournisseur'], "cat" => $rCat['Id_Categorie'], "idProduit" => $row['Id_Produit']]);
                                                    } else {
                                                        $db->addCat(["lib" => $cat_p, "img" => "https://d2gg9evh47fn9z.cloudfront.net/1600px_COLOURBOX9214366.jpg"]);

                                                        $db->updateProduit(["tva" => $tva, "nomL" => $noml, "nomC" => $nomc, "refs" => $ref, "img" => $photo, "prix" => $prix, "fours" => $rFou['Id_Fournisseur'], "cat" => $db->getLastCat()['max(Id_Categorie)'], "idProduit" => $row['Id_Produit']]);
                                                    }
                                                }
                                            ?>
                                                <tr class="text-gray-700 dark:text-gray-100">
                                                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left"><?= $nom_cat['Libelle'] ?></th>
                                                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"><?= $row['Nom_court']; ?></td>
                                                    <td class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4"><?= $row['Ref_fournisseur']; ?></td>
                                                    <td class="flex flex-row border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                        <button type="btn" class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300" data-modal-target="produit_<?= $row['Id_Produit']; ?>" data-modal-toggle="produit_<?= $row['Id_Produit']; ?>">Modifier</button>
                                                        <form method="post">
                                                            <button type="submit" name="suppProduit_<?= $row['Id_Produit']; ?>" class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                <!-- Main modal -->
                                                <div id="produit_<?= $row['Id_Produit']; ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                        <!-- Modal content -->
                                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                            <!-- Modal header -->
                                                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                    Modification de produit
                                                                </h3>
                                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="produit_<?= $row['Id_Produit']; ?>">
                                                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                    </svg>
                                                                    <span class="sr-only">Close modal</span>
                                                                </button>
                                                            </div>
                                                            <!-- Modal body -->
                                                            <div class="p-4 md:p-5 space-y-4">
                                                                <form class="space-y-4" method="post">
                                                                    <div class="flex md:flex-row">
                                                                        <input type="text" name="nomc_<?= $row['Id_Produit']; ?>" value="<?= $row['Nom_court']; ?>" class=" mr-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Nom court">
                                                                        <input type="text" name="noml_<?= $row['Id_Produit']; ?>" value="<?= $row['Nom_Long']; ?>" placeholder="Description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                                    </div>
                                                                    <div class="flex flex-col gap-5 md:flex-row">
                                                                        <input type="text" name="ref_<?= $row['Id_Produit']; ?>" placeholder="Référence" value="<?= $row['Ref_fournisseur']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">

                                                                        <input type="text" name="photo_<?= $row['Id_Produit']; ?>" value="<?= $row['Photo']; ?>" placeholder="URL photo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                                    </div>
                                                                    <div class="flex justify-between gap-4">
                                                                        <select name="tva_<?= $row['Id_Produit']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                                            <!-- <option selected disabled value="<?= $row['Taux_TVA']; ?>"><?= $row['Taux_TVA']; ?></option>
                                                                         -->
                                                                            <?php if ($row['Taux_TVA'] == 19.60) { ?>
                                                                                <option selected value="<?= $row['Taux_TVA']; ?>"><?= $row['Taux_TVA']; ?></option>
                                                                                <option value="5.50">5.50</option>
                                                                            <?php } else { ?>
                                                                                <option selected value="<?= $row['Taux_TVA']; ?>"><?= $row['Taux_TVA']; ?></option>
                                                                                <option value="19.60">19.60</option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <input type="number" name="prix_<?= $row['Id_Produit']; ?>" value="<?= $row['Prix_Achat']; ?>" placeholder="Prix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                                    </div>
                                                                    <div class="flex justify-between gap-5">

                                                                        <input type="text" list="four_<?= $row['Id_Produit']; ?>" name="fournisseur_<?= $row['Id_Produit']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="<?= $result_for['Nom_Fournisseur'] ?>" value="<?= $result_for['Nom_Fournisseur'] ?>">
                                                                        <datalist id="four_<?= $row['Id_Produit']; ?>">
                                                                            <?php foreach ($db->forEarchFour() as $rows) { ?>
                                                                                <option value="<?= $rows['Nom_Fournisseur'] ?>"><?= $rows['Nom_Fournisseur'] ?></option>
                                                                            <?php } ?>
                                                                        </datalist>


                                                                        <input type="text" list="cat_<?= $row['Id_Produit']; ?>" name="cat_<?= $row['Id_Produit']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="<?= $result_cat['Libelle'] ?>" value="<?= $result_cat['Libelle'] ?>">
                                                                        <datalist id="cat_<?= $row['Id_Produit']; ?>">
                                                                            <?php foreach ($db->forEarchCat() as $rows) { ?>
                                                                                <option value="<?= $rows['Libelle'] ?>"><?= $rows['Libelle'] ?></option>
                                                                            <?php } ?>
                                                                        </datalist>
                                                                    </div>
                                                                    <button type="submit" name="modifProduit_<?= $row['Id_Produit']; ?>" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Modifier</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ./Social Traffic -->
                                                <!-- Social Traffic -->
                                                <div class="overflow-scroll h-96 relative flex flex-col min-w-0 mb-4 lg:mb-0 break-words bg-gray-50 dark:bg-gray-800 w-full shadow-lg rounded">
                            <div class="rounded-t mb-0 px-0 border-0">
                                <div class="flex flex-wrap items-center px-4 py-2">
                                    <div class="relative w-full max-w-full flex-grow flex-1">
                                        <h3 class="font-semibold text-base text-gray-900 dark:text-gray-50">Catégories</h3>
                                    </div>
                                    <!-- <div class="relative w-full max-w-full flex-grow flex-1 text-right">
                                        <button data-modal-target="produit" data-modal-toggle="produit" class="bg-blue-500 dark:bg-gray-100 text-white active:bg-blue-600 dark:text-gray-800 dark:active:text-gray-700 text-xs font-bold uppercase px-3 py-1 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="btn">Ajouter un produit</button>
                                    </div> -->
                                </div>
                                <div class="block w-full overflow-x-auto">
                                    <table class="items-center w-full bg-transparent border-collapse">
                                        <thead>
                                            <tr>
                                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Catégorie</th>
                                                <th class="px-4 bg-gray-100 dark:bg-gray-600 text-gray-500 dark:text-gray-100 align-middle border border-solid border-gray-200 dark:border-gray-500 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">Supprimer</th></tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($db->getCatAll() as $row) {   
                                                if(isset($_POST['suppCat_'.$row['Id_Categorie']])){
                                                    $db->suppCat(["cat_id"=>$row['Id_Categorie']]);
                                                    $db->suppCatProduit(["cat_id"=>$row['Id_Categorie']]);
                                                }
                                                ?>
                                                <tr class="text-gray-700 dark:text-gray-100">
                                                    <th class="border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left"><?= $row['Libelle'] ?></th>
                                                    <td class="flex flex-row border-t-0 px-4 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                        <form method="post">
                                                            <button type="submit" name="suppCat_<?= $row['Id_Categorie']; ?>" class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Supprimer</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ./Social Traffic -->
                    </div>
                    <!-- Client Table -->
                    <div class="mt-4 mx-4">
                        <div class="w-full overflow-hidden rounded-lg shadow-xs">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                            <th class="px-4 py-3">Client</th>
                                            <th class="px-4 py-3">Mail</th>
                                            <th class="px-4 py-3">Type</th>
                                            <th class="px-4 py-3">Num. Client</th>
                                            <th class="px-4 py-3">Modifier / SUpprimer</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                        <?php foreach ($users as $row) {
                                            if (isset($_POST['supp_' . $row['Id_Client']])) {
                                                $db->suppUser(["client" => $row['Id_Client']]);
                                            }
                                            if (isset($_POST['modifUser_' . $row['Id_Client']])) {
                                                $societe = htmlentities(stripcslashes($_POST['nom_' . $row['Id_Client']]));
                                                $nom = htmlentities(stripcslashes($_POST['nom2_' . $row['Id_Client']]));
                                                $prenom = htmlentities(stripcslashes($_POST['prenom_' . $row['Id_Client']]));
                                                $num = htmlentities(stripcslashes($_POST['num_' . $row['Id_Client']]));
                                                $mail = htmlentities(stripcslashes($_POST['mail_' . $row['Id_Client']]));
                                                $tel = htmlentities(stripcslashes($_POST['tel_' . $row['Id_Client']]));
                                                $delai = htmlentities(stripcslashes($_POST['delai_' . $row['Id_Client']]));
                                                // Nom_Societe_Client = :soc, Nom_Client = :nom, Prenom_Client = :prenom, Mail_Client = :mail, Tel_Client = :tel, DelaiPaiement_Client = :delai, Num_Client = :num where Id_Client = :idClient
                                                $db->updateClient(["soc" => $societe, "nom" => $nom, "prenom" => $prenom, "mail" => $mail, "tel" => $tel, "delai" => $delai, "num" => $num, "idClient" => $row['Id_Client']]);
                                            }
                                        ?>
                                            <tr class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center text-sm">
                                                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                                            <img class="object-cover w-full h-full rounded-full" src="https://voltpass.fr/img/profil.png" alt="" loading="lazy" />
                                                            <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                        </div>
                                                        <div>
                                                            <p class="font-semibold"><?= $row['Nom_Client']; ?> <?= $row['Prenom_Client']; ?></p>
                                                            <p class="text-xs text-gray-600 dark:text-gray-400"><?= $row['Nom_Societe_Client']; ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm"><?= $row['Mail_Client']; ?></td>
                                                <td class="px-4 py-3 text-xs">
                                                    <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"> <?= $row['Id_Type_Client']; ?> </span>
                                                </td>
                                                <td class="px-4 py-3 text-sm"><?= $row['Num_Client']; ?></td>
                                                <td class="px-4 py-3 text-sm flex flex-row">

                                                    <button type="btn" class="bg-blue-100 text-blue-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300" data-modal-target="client_<?= $row['Id_Client']; ?>" data-modal-toggle="client_<?= $row['Id_Client']; ?>">Modifier</button>

                                                    <form method="post">
                                                        <button type="submit" name="supp_<?= $row['Id_Client']; ?>" class="bg-red-100 text-red-800 text-sm font-medium me-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- Main modal -->
                                            <div id="client_<?= $row['Id_Client']; ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                                    <!-- Modal content -->
                                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                        <!-- Modal header -->
                                                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                                Modification d'utilisateurs
                                                            </h3>
                                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="client_<?= $row['Id_Client']; ?>">
                                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                </svg>
                                                                <span class="sr-only">Close modal</span>
                                                            </button>
                                                        </div>
                                                        <!-- Modal body -->
                                                        <div class="p-4 md:p-5 space-y-4">
                                                            <form class="space-y-4" method="post">
                                                                <div>
                                                                    <input type="nom" name="nom_<?= $row['Id_Client']; ?>" value="<?= $row['Nom_Societe_Client']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Société">
                                                                </div>
                                                                <div class="flex flex-col md:flex-row">
                                                                    <input type="text" name="nom2_<?= $row['Id_Client']; ?>" value="<?= $row['Nom_Client']; ?>" placeholder="Nom" class="mr-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                                    <input type="text" name="prenom_<?= $row['Id_Client']; ?>" value="<?= $row['Prenom_Client']; ?>" placeholder="Prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                                </div>
                                                                <div>
                                                                    <input type="text" name="num_<?= $row['Id_Client']; ?>" value="<?= $row['Num_Client']; ?>" placeholder="Prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                                </div>
                                                                <div class="flex flex-col md:flex-row">
                                                                    <input type="email" name="mail_<?= $row['Id_Client']; ?>" value="<?= $row['Mail_Client']; ?>" placeholder="email" class="mr-5 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">

                                                                    <input type="tel" name="tel_<?= $row['Id_Client']; ?>" placeholder="Téléphone" value="<?= $row['Tel_Client']; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                                </div>
                                                                <div>
                                                                    <input type="number" name="delai_<?= $row['Id_Client']; ?>" value="<?= $row['DelaiPaiement_Client']; ?>" placeholder="Prenom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                                                </div>
                                                                <button type="submit" name="modifUser_<?= $row['Id_Client']; ?>" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Modifier</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-2 dark:text-gray-400 dark:bg-gray-800">
                                <!-- Pagination -->
                                <p class="flex mt-2 items-center ">Vous êtes sur la page <?= $currentPage ?></p>
                                <span class="flex mt-2 sm:mt-auto sm:justify-end justify-between">
                                    <nav aria-label="Table navigation">
                                        <ul class="inline-flex items-center">
                                            <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                                                <a href="?page=<?= $currentPage - 1 ?>" class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                                                    <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                                        <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                            <?php for ($page = 1; $page <= $pages; $page++) : ?>
                                                <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                                    <a href="?page=<?= $page ?>" class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple text-white"><?= $page ?></a>
                                                </li>
                                            <?php endfor ?>
                                            <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                                                <a href="?page=<?= $currentPage + 1 ?>" class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
                                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                                        <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                                                    </svg>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- ./Client Table -->
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.0/dist/alpine.min.js" defer></script>
        <!-- Main modal -->
        <div id="produit" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Ajout de produit
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="produit">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <form class="space-y-4" method="post">
                            <div>
                                <input type="nom" name="nom" id="nom" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Nom court" required>
                            </div>
                            <div>
                                <input type="text" name="nom2" id="nom2" placeholder="Description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div class="flex flex-col gap-5 md:flex-row">
                                <input type="text" name="ref" id="ref" placeholder="Référence" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>

                                <input type="text" name="photo" id="photo" placeholder="URL photo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div class="flex justify-between gap-4">
                                <select name="tva" id="tva" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="19.60">19.60</option>
                                    <option value="5.50">5.50</option>
                                </select>
                                <input type="number" name="prix" id="prix" placeholder="Prix" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            </div>
                            <div class="flex justify-between gap-5">
                                <select name="fournisseur" id="fournisseur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <?php foreach ($db->forEarchFour() as $row) { ?>
                                        <option value="<?= $row['Nom_Fournisseur'] ?>"><?= $row['Nom_Fournisseur'] ?></option>
                                    <?php } ?>
                                </select>
                                <select name="cat" id="cat" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <?php foreach ($db->forEarchCat() as $row) { ?>
                                        <option value="<?= $row['Libelle'] ?>"><?= $row['Libelle'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" name="produit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>