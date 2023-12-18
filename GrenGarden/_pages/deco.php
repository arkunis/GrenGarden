<?php
session_start();
if(isset($_SESSION['panier']) == true){
$panier = $_SESSION['panier'];
session_destroy();
session_start();
$_SESSION['panier'] = $panier;
}else{
session_destroy();
}
header('Location:../login.php');
