<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--[if ie]><meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Remurpe - Panel de Control</title>
        <link href="../css/normalize.css" rel="stylesheet" type="text/css" />
        <link href="../css/MOStyles.css" rel="stylesheet" type="text/css" />
        <link href="../css/mo-admin.css" rel="stylesheet" type="text/css" />
        <link href="../css/text.css" rel="stylesheet" type="text/css" />
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <body>
        <div id="overlay"></div>
        <div id="login">
            <h1>Remurpe</h1><a href="http://www.remurpe.org.pe/"><img src="../img/logo.png" alt="Remurpe" /></a>
            <div class="message">Por favor, ingrese su nobre de usuario.<br />Usted recibira su contraseña via email.</div>
            <form id="form_login" class="MOForm">
                <p><label for="username">Usuario </label><input type="text" name="username" id="username" /></p>
                <p><label for="password">Contraseña </label><input type="password" name="password" id="password" /></p>
                <p><a href="#" class="forgot_password">Olvido su contraseña ?</a><input type="submit" value="Enviar" /></p>
            </form>
            <form id="form_forgot_password" class="MOForm">
                <p><label for="username2">Usuario </label><input type="text" name="username" id="username2" /></p>
                <p><a href="#" class="login">Volver</a><input type="submit" value="Recuperar contraseña" /></p>
            </form>
        </div>
        <div id="footer">
            <p id="copyright">
                &copy; Remurpe. Todos los derechos reservados.
            </p>
            <p id="address">
                <strong>Red de Municipalidades Urbanas y Rurales del Perú</strong><br />
                Calle Mariano Carranza 527 - Santa Beatriz, Lima<br />
                <strong>Teléfono: </strong>265 4596 &nbsp;|&nbsp; <strong>RPM: </strong>#975-365283<br />
                <strong>Email: </strong><a href="mailto:remurpe@remurpe.org.pe">remurpe@remurpe.org.pe</a>
            </p>
        </div>
        <script src="../js/respond.min.js"></script>
        <script src="../js/prefixfree.min.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/mo-admin.js"></script>
    </body>
</html>