<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--[if ie]><meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Remurpe - Panel de Control</title>
        <link href="../css/normalize.css" rel="stylesheet" type="text/css" />
        <link href="../css/MOStyles.css" rel="stylesheet" type="text/css" />
        <link href="../lib/confirm/css/confirm.css" rel="stylesheet" type="text/css" />
        <link href="../css/mo-admin.css" rel="stylesheet" type="text/css" />
        <link href="../css/text.css" rel="stylesheet" type="text/css" />
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <body>
        <div id="overlay"></div>
        <div id="container">
            <div id="header">
                <a href="./" class="logo"><img src="../img/logo.png" alt="Remurpe" height="92" /></a>
                <ul>
                    <li class="radius10"><a href="./" class="home">Inicio</a></li>
                    <li><a href="./?mod=10" class="access">Acceso</a></li>
                    <li><a href="#" class="logout" id="logout">Salir</a></li>
                </ul>
                <div class="clear"></div>
            </div>
            <div id="body">
                <div id="nav"><?php include "nav.php"; ?></div>
                <div id="content"><?php include "directory.php"; ?></div>
            </div>
        </div>
        <div id="footer_admin">
            <div class="container">
                <p class="left">
                    &copy; Remurpe. Todos los derechos reservados.
                </p>
                <p class="right">
                    <strong>Red de Municipalidades Urbanas y Rurales del Perú</strong><br />
                    Calle Mariano Carranza 527 - Santa Beatriz, Lima<br />
                    <strong>Teléfono: </strong>265 4596 &nbsp;|&nbsp; <strong>RPM: </strong>#975-365283<br />
                    <strong>Email: </strong><a href="mailto:remurpe@remurpe.org.pe">remurpe@remurpe.org.pe</a>
                </p>
            </div>
        </div>
        <div id="confirm">
            <div class="header"><span>Confirmación</span></div>
            <p class="message"></p>
            <div class="buttons">
                <div class="no simplemodal-close">No</div><div class="yes">Si</div>
            </div>
        </div>
        <script src="../js/respond.min.js"></script>
        <script src="../js/prefixfree.min.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../lib/confirm/js/confirm.js"></script>
        <script src="../lib/confirm/js/jquery.simplemodal.js"></script>
        <script src="../lib/DataTables/media/js/jquery.dataTables.min.js"></script>
        <script src="../js/mo-admin.js"></script>
    </body>
</html>