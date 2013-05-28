<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15">
        <!--[if ie]><meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Web TV - Dokeos</title>
        <link rel="shortcut icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="css/jquery-ui-1.10.2.min.css" />
        <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
        <link rel="stylesheet" href="css/jquery.tagit.min.css" />
        <link rel="stylesheet" href="css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/sprites.min.css" />
        <link rel="stylesheet" href="css/style.css" />
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <!--[if lt IE 7]><p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p><![endif]-->
    </head>
    <body>
        <header>
            <div class="container">
                <div class="bar-header"></div>
                <div class="row">
                    <div class="span12">
                        <?php echo returnIcon('dk-icon-global_home', $tool_header, '../../courses/' . $course_code . '/index.php'); echo "\n"; ?>
                    </div>
                </div>
            </div>
        </header>
        <div class="content">
            <div class="container bar-action">
                <div class="content-padding-small">
                    <div class="row-fluid">
                        <ul class="nav nav-pills nav-webtv pull-left">
                            <li><?php echo returnIcon('dk-icon-toolaction-web_tv', 'Web TV', 'index.php?'.  api_get_cidreq()); ?></li>
                            <?php
                            if (api_is_allowed_to_edit()) {
                                $current_channel_id = "";
                                if (isset($_GET['action']) && ($_GET['action'] == 'view_channel' || $_GET['action'] == 'edit_channel')) {
                                    $current_channel_id = "&channel_id=$channel_id";
                                }
                            ?>
                            <li><?php echo returnIcon('dk-icon-toolaction-import', get_lang('UploadVideo'), 'index.php?'.api_get_cidreq().'&action=upload' . $current_channel_id); ?></li>
                            <li><?php echo returnIcon('dk-icon-toolaction-channel_tv', get_lang('CreateChannel'), 'index.php?'.api_get_cidreq().'&action=add_channel'); ?></li>
                            <?php } ?>
                        </ul>
                        <?php if ($action == "index") { ?>
                        <div id="search_video" class="input-append pull-right">
                            <input class="input-large" type="text" />
                            <button class="btn" type="button"><?php echo get_lang('Search'); ?></button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="content-padding">
                    <div class="row-fluid">
<?php include $include_content; echo "\n"; ?>
                    </div>
                </div>
            </div>
            <div class="container bar-action">
                <div class="content-padding-small">
                    <div class="row-fluid"></div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="author span3">Manager: <a href="mailto:newportal@dokeos.com">John Doe</a></div>
                    <div class="author span3">Trainer: <a href="mailto:newportal@dokeos.com">John Doe</a></div>
                    <div class="users-online span6">
                        <span class="usersonlinetitle">Users online : </span>
                        <span class="usersonlinecontent">0</span>
                        <i class="usersonlineicon"></i>
                        <i class="chatstatus"></i>
                    </div>
                </div>
            </div>
        </footer>
        <?php
        $current_channel_id = "";
        if (isset($_GET['action']) && $_GET['action'] == 'upload') {
            $current_channel_id = "&action=view_channel&id=$channel_id";
        }
        ?>
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