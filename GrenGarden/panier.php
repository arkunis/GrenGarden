<?php
session_start();
ob_start();
require_once('php/config/config.php');
$db = new db();
$db->connexion();

// if (isset($_COOKIE['produit']) == true) {
//     print($_COOKIE['produit']);
// }
if (isset($_SESSION['login']) == true) {
    $client = $db->getUser(["log" => $_SESSION['login']]);
    $result = $db->getClients(["log" => $client['Id_User']]);
    $add = $db->getAdresse(["log" => $result['Id_Client']]);
}

if (isset($_POST['pay_btn'])) {
    $today = date("Y-m-d H:i:s"); 
    if ($add > 0) {
        $ad1 = htmlentities(stripcslashes($_POST['adresse']));
        $ad2 = htmlentities(stripcslashes($_POST['adresse1']));
        $postal = htmlentities(stripcslashes($_POST['postal']));
        $ville = htmlentities(stripcslashes($_POST['ville']));
        $paiement = htmlentities(stripcslashes($_POST['paiements']));
        $getIDPay = $db->getIdPay(["lib" => $_POST['paiements']]);
        $db->updateAdresse(["ad1" => $ad1, "ad2" => $ad2, "cp" => $postal, "ville" => $ville, "client" => $result['Id_Client']]);
        $db->addCommande(["ids" => 1, "idc" => $result['Id_Client'], "types" => $getIDPay['Id_TypePaiement'], "dates"=>$today, "remise"=>0.00]);
        $lastCom =  $db->getLastCommande();
        $db->addFacture(["dates"=>$today, "idC"=>$lastCom['max(Id_Commande)']]);
        unset($_SESSION['panier']);
    } else {
        $ad1 = htmlentities(stripcslashes($_POST['adresse']));
        $ad2 = htmlentities(stripcslashes($_POST['adresse1']));
        $postal = htmlentities(stripcslashes($_POST['postal']));
        $ville = htmlentities(stripcslashes($_POST['ville']));
        $paiement = htmlentities(stripcslashes($_POST['paiements']));
        $getIDPay = $db->getIdPay(["lib" => $_POST['paiements']]);
        $db->setAdresse(["ad1" => $ad1, "ad2" => $ad2, "cp" => $postal, "ville" => $ville, "client" => $result['Id_Client']]);
        $db->addCommande(["ids" => 1, "idc" => $result['Id_Client'], "types" => $getIDPay['Id_TypePaiement'], "dates"=>$today, "remise"=>0.00]);
        $lastCom =  $db->getLastCommande();
        $db->addFacture(["dates"=>$today, "idC"=>$lastCom['max(Id_Commande)']]);
        unset($_SESSION['panier']);
    }
}

$total = [];
?>
<!DOCTYPE html>
<html lang="en">

<?php include('_pages/head.php'); ?>

<body>
    <?php include('_pages/header.php'); ?>
    <main class="min-h-[56vh] mb-5">
        <section class="w-[90%] md:w-[80%] lg:w-[45%] mx-auto flex flex-row flex-wrap gap-5 justify-center">
            <article class="w-full">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg mx-auto">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Nom du produit
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantité
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Prix (total)
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($_SESSION['panier']) == true) {
                                foreach ($_SESSION['panier'] as $row) {
                                    $produit = $db->getProductInfo(["id_produit" => $row[0]]);
                            ?>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <?= $produit['Nom_court']; ?>
                                        </th>
                                        <td class="px-6 py-4">
                                            <?= $row[1]; ?>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <?php
                                            $total[$row[0]] = $row[1] * $produit['Prix_Achat'];
                                            print $total[$row[0]] . '€'; ?>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
                <span class="flex justify-end m-5 text-2xl">Total : <?php print array_sum($total); ?>€</span>

            </article>
            <article class="w-full">
                <?php if (isset($_SESSION['login']) == true && isset($_SESSION['panier']) != "") { ?>

                    <form method="post">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="email" name="floating_email" value="<?= $result['Mail_Client']; ?>" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                        </div>

                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="nom" value="<?= $result['Nom_Client']; ?>" id="nom" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="nom" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nom</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="prenom" value="<?= $result['Prenom_Client']; ?>" id="prenom" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="prenom" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Prénom</label>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="adresse" value="<?php if ($add > 0) {
                                                                                print $add['Ligne1_Adresse'];
                                                                            }; ?>" id="adresse" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="adresse" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Adresse</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="adresse1" value="<?php if ($add > 0) {
                                                                                print $add['Ligne2_Adresse'];
                                                                            }; ?>" id="adresse1" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="adresse1" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Complément d'adresse</label>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="postal" value="<?php if ($add > 0) {
                                                                            print $add['CP_Adresse'];
                                                                        }; ?>" id="postal" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="postal" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Code postal</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="ville" value="<?php if ($add > 0) {
                                                                            print $add['Ville_Adresse'];
                                                                        }; ?>" id="ville" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="ville" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Ville</label>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 md:gap-6">
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="tel" pattern="[0-9]{10}" name="tel" id="tel" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " value="<?= $result['Tel_Client']; ?>" required />
                                <label for="tel" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Téléphone</label>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" value="<?= $result['Nom_Societe_Client']; ?>" name="societe" id="societe" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
                                <label for="societe" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Société (Ex. Google)</label>
                            </div>
                        </div>
                        <div class="mb-5">
                            <select name="paiements">
                                <?php foreach ($db->getPaiement() as $row) { ?>
                                    <option value="<?= $row['Libelle_TypePaiement']; ?>"><?= $row['Libelle_TypePaiement']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" name="pay_btn" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Valider mon paiement</button>
                    </form>

                <?php } else { ?>

                    <?php if(isset($_SESSION['login'])==false ){ ?>
                    <p class="text-xl">Veuillez vous connecter pour finaliser votre commande !</p>
                    <?php }else{ ?>
                        <p class="text-xl">Votre panier est vide !</p>
                        <?php } ?>

                <?php } ?>
            </article>
        </section>
    </main>

    <?php include('_pages/footer.php'); ?>
</body>

</html>