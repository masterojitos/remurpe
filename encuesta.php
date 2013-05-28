<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--[if ie]><meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Postulación a Remurpe</title>
        <link rel="stylesheet" fonohref="css/normalize.css" />
        <link rel="stylesheet" href="css/style.css" />
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <body>
        <div class="container-poll">
            <div class="title-poll">
                <h2>Consultas / Preguntas</h2>
                <button>Reglamento para postular</button>                
            </div>
            <section class="personal-data">
                <h3>Datos personales</h3>
                <label>Nombres<label>
                <label>Apellidos<label>
                <label>DNI<label>
                <label>Telefono<label>
                <label>Email<label>
                <label>Fotogragia<label>
            </section>
        </div>
        <span id="base_url" data-base-url="<?php echo 'index.php?'.  api_get_cidreq() . $current_channel_id; ?>" data-are-you-sure="<?php echo get_lang('langAreYouSureToDelete'); ?>" data-loading-the-player="<?php echo get_lang('LoadingThePlayer'); ?>" data-no-results="<?php echo get_lang('NoResultsForVideosWith'); ?>" data-allowed-to-edit="<?php echo api_is_allowed_to_edit(); ?>" data-client="<?php echo $client; ?>" data-copy-clipboard="<?php echo get_lang('CopyToClipboard'); ?>"></span>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui-1.10.2.min.js"></script>
        <script src="js/jquery.ui.touch-punch.min.js"></script>
        <script src="js/jquery.mousewheel.min.js"></script>
        <script src="js/jquery.mCustomScrollbar.min.js"></script>
        <script src="js/jquery.form.min.js"></script>
        <script src="js/jquery.browser.min.js"></script>
        <script src="js/jquery.tag-it.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootbox.min.js"></script>
        <script src="js/jwplayer.min.js"></script>
        <script src="js/jwplayer.html5.min.js"></script>
        <script src="js/respond.min.js"></script>
        <script src="js/prefixfree.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>