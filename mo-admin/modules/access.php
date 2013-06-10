<?php
if (!isset($_POST['username']) and !isset($_POST['password'])) exit();
require_once "../config.php";
if (($password = $cn->getField("SELECT password FROM configuration WHERE username = '" . $cn->scape($_POST['username']) . "'")) == "")
    exit("El nombre de usuario no existe.<br />Por favor, ingrese otro.");
elseif ($password != $cn->scape($_POST['password']))
    exit("La contraseña para el usuario <strong>" . $cn->scape($_POST['username']) . "</strong> es incorrecta. <a href='#' class='forgot_password'>Olvido su contraseña ?</a>");
else {
    session_start();
    $_SESSION['mo_login'] = true;
}