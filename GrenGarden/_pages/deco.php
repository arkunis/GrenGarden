<?php
session_start();
$panier = $_SESSION['panier'];
session_destroy();
session_start();
$_SESSION['panier'] = $panier;
header('Location:../login.php');