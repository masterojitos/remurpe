<?php

/**
 * Prints a linkable icon
 * 
 * @author Ricardo Garcia Rodriguez <master.ojitos@gmail.com>
 * 
 * @param string $icon_class Class of icon to be printed
 * @param string $text Text to be printed on right of the icon
 * @param string $href Link to be followed by the clicked icon
 * @param string $title Title of the link
 * @param string $class Class of link to be printed
 * @param array $datas Array of data attributes to the link
 */
function returnIcon($icon_class, $text = '', $href = '', $title = '', $class = '', $datas = array()) {
    $icon = '<i class="' . $icon_class . '"></i>' . $text;
    if ($href != '' || $title != '') {
        if ($href != '') $href = ' href="' . $href . '"';
        if ($title != '') $title = ' title="' . $title . '"';
        if ($class != '') $class = ' class="' . $class . '"';
        if (count($datas)) {
            $data_text = "";
            foreach ($datas as $key => $value) {
                $data_text.= ' data-' . $key . '="' . $value . '"';
            }
        }
        $icon = '<a' . $href . $title . $class . $data_text . '>' . $icon . '</a>';
    }
    return $icon;
}

/**
 * Returns the course code and session id for make a shared url.
 * This will be used to extract data from course database
 * with no need to create a conflict with active system course
 * 
 * @author Ricardo Garcia Rodriguez <master.ojitos@gmail.com>
 * 
 * @return string Contains the course code and session id parameters
 */
function shared_url() {
    return empty($GLOBALS['_cid']) ? '' : htmlspecialchars($GLOBALS['_cid']) . (api_get_session_id() == 0 ? '' : ',' . api_get_session_id());
}

/**
 * Writes in a file created dynamiclly by a token the progress form value.
 * You need to create at the beginning of submit form the $progress_token 
 * from the html form by the display_progressbar function.
 * 
 * @author Ricardo Garcia Rodriguez <master.ojitos@gmail.com>
 * 
 * @param integer $value The progress value
 */
function progress_form($value) {
    global $progress_token;
    $filename  = dirname(__FILE__) . '/../../upload/webtv/' . $progress_token . '.txt';
    file_put_contents($filename, intval($value));
    usleep(500000);
    if ($value == 100) {
        unlink($filename);
    }
}

/**
 * Prints a html progressbar for the submit form and optionally
 * for upload file. Also a hidden input with a token generator for
 * the current form.
 * 
 * @author Ricardo Garcia Rodriguez <master.ojitos@gmail.com>
 * 
 * @param boolean $show_upload_file Option to print a progressbar for upload file form. Default: false
 * 
 * @return string Contains the html progressbar
 */
function display_progressbar($show_upload_file = false) {
    $tabs = str_repeat("\t", 10);
    $html_upload_file = '<div id="upload_progress" class="progress progress-striped active">' . "\n\t$tabs";
    $html_upload_file.= '<div class="progress-label">' . get_lang('Loading') . '...</div>' . "\n\t$tabs";
    $html_upload_file.= '<div class="bar"></div>' . "\n$tabs";
    $html_upload_file.= '</div>' . "\n$tabs";
    $html_submit_form = '<div id="all_progress" class="progress progress-success progress-striped active">' . "\n\t$tabs";
    $html_submit_form.= '<div class="progress-label">' . get_lang('Loading') . '...</div>' . "\n\t$tabs";
    $html_submit_form.= '<div class="bar"></div>' . "\n$tabs";
    $html_submit_form.= '</div>' . "\n$tabs";
    $html_progress_token = '<input type="hidden" name="progress_token" id="progress_token" value="' . uniqid(mt_rand()) . '" />' . "\n";
    return ($show_upload_file ? $html_upload_file : '') . $html_submit_form . $html_progress_token;
}