<?php
if(!isset($_POST['username'])) exit();
require_once "../config.php";
if(($password = $cn->getField("SELECT password FROM configuration WHERE username = '".$cn->scape($_POST['username'])."'")) == "") 
    exit("El nombre de usuario no existe.<br />Por favor, ingrese otro.");
else{
	$subject = "Remurpe - Recuperar Contraseña";
	$body = "Your requested to recover password.<br />If this was a mistake, just ignore this message and nothing happen.<br />Your username: ".$cn->getField("SELECT username FROM configuration")."<br />Password: ".$cn->getField("SELECT password FROM configuration")."<br />Visit the following web address to access your account:<br /><a href='http://localhost/alex/admin/'>http://localhost/alex/admin/</a>";
	$body = "Solicitud para recuperar su contraseña.<br />
        Si usted no solicito esto, por favor, simplemente ignore este mensaje.<br />
        Su nombre de usuario es: " . $cn->getField("SELECT username FROM configuration") . "<br />
        Su Contraseña es: " . $cn->getField("SELECT password FROM configuration") . "<br />
        Visite la siguiente dirección web para acceder a su cuenta:<br />
        <a href='http://remurpe.org.pe/postulacion/mo-admin/'>http://remurpe.org.pe/postulacion/mo-admin/</a>";
	$headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=UTF-8\r\nFrom: no-reply@remurpe.org.pe\r\n";
	mail($cn->getField("SELECT email FROM configuration"), $subject, $body, $headers);
}