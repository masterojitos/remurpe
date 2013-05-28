<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15">
        <!--[if ie]><meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Web TV - Dokeos</title>
        <link rel="shortcut icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/sprites.min.css" />
        <link rel="stylesheet" href="css/shared_style.css" />
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!--[if lt IE 7]><p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p><![endif]-->
    </head>
    <body>
        <header>
            <div class="container">
                <div class="bar-header"></div>
                <div class="row">
                    <div class="span12">
                        <?php echo returnIcon('dk-icon-global_home', 'Web TV', 'http://new.dokeos.net/en/7dokeosproducts/tv'); echo "\n"; ?>
                    </div>
                </div>
            </div>
        </header>
        <div class="content">
            <div class="container">
                <div class="content-padding">
                    <div class="row-fluid">
                        <div class="row-fluid channel-playlist">
                            <section class="channel-player">
                                <h1><?php echo $video['title']; ?></h1>
                                <div id="video-player" data-video="<?php echo $video['file']; ?>"></div>
                                <p class="lead"><?php echo nl2br($video['description']); ?></p>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container bar-action">
                <div class="content-padding-small">
                    <div class="row-fluid"></div>
                </div>
            </div>
        </div>
        <span id="base_url" data-client="<?php echo $client; ?>"></span>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.browser.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jwplayer.min.js"></script>
        <script src="js/jwplayer.html5.min.js"></script>
        <script src="js/respond.min.js"></script>
        <script src="js/prefixfree.min.js"></script>
        <script src="js/shared_scripts.js"></script>
    </body>
</html>