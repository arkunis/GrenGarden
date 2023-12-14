<?php
session_start();
require_once('php/config/config.php');
$db = new db();
$db->connexion();
if(isset($_SESSION['login']) == true){
    header('Location: index.php');
}

$error = "";
// :id, :log, :pass

// :societe, :nom, :prenom, :mail, :tel, :commerce, :type, :delai, :num, :user

if (isset($_POST['loginBTN'])) {
    $login = htmlentities(stripcslashes($_POST['login']));
    $password = htmlentities(stripcslashes($_POST['password']));

$result = $db->getUser(["log"=>$login]);

if($result > 0){
    if(password_verify($password, $result['Password'])){
        $_SESSION['login'] = $login;
        $_SESSION['type'] = $result['Id_UserType'];
        header('Location: index.php');
    }else $error = "Mot de passe incorrect";
}else $error = "Le compte n'existe pas";


}

?>
<!DOCTYPE html>
<html lang="en">

<?php include('_pages/head.php'); ?>

<body>
    <?php include('_pages/header.php'); ?>
    <main class="min-h-[56vh]">
        <section class="">
            <?php if($error){
                print $error;
            } ?>
            <form class="max-w-md mx-auto" method="post">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="login" id="login" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Login</label>
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="password" name="password" id="password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                    <label for="password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                </div>
                <button type="submit" name="loginBTN" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </section>
    </main>
    <?php include('_pages/footer.php'); ?>

</body>

</html>