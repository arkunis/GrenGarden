<?php
session_start();
require_once('php/config/config.php');
$db = new db();
$db->connexion();


?>
<!DOCTYPE html>
<html lang="en">

<?php include('_pages/head.php'); ?>

<body>
    <?php include('_pages/header.php'); ?>
    <main class="min-h-[56vh] mb-5">
        <section class="w-[70%] mx-auto flex flex-row flex-wrap gap-5 justify-center">
            <?php foreach ($db->getCat() as $row) { ?>
                <article>
                    <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="product_sous.php?categorie=<?= $row['Id_Categorie']; ?>" class="rounded-lg">
                            <img class="rounded-lg p-8 w-full min-h-[400px] object-cover" src="<?= $row['img']; ?>" alt="categorie image" />
                        </a>
                        <div class="px-5 pb-5">

                            <div class="flex items-center mt-2.5 mb-5 justify-between">

                                <a href="#" class="">
                                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white"><?= $row['Libelle']; ?></h5>
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
            <?php } ?>
        </section>
    </main>

    <?php include('_pages/footer.php'); ?>
</body>

</html>