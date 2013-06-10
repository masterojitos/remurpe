<?php
$mod = isset($_REQUEST['mod']) ? $_REQUEST['mod'] : 0;
$nav = array(
    "0-Inicio",
    "10-Configuración", "10-Acceso", "11-Apariencia", "12-Empresa", "13-Aplicaciones",
    "20-Postulaciones"
);
$last_mod = $status = 0;
foreach ($nav as $k => $v) {
    $array = explode("-", $v);
    $class = $a_class = "";
    if ($mod == $array[0]) $class.= 'on ';
    if ($k == 0) echo '<ul><li class="' . $class . 'radiusTopLeft5 radiusTopRight5"><a href="./" class="radiusTopLeft5 radiusTopRight5">' . $array[1] . '</a></li>';
    else {
        if ($last_mod + 9 > $array[0]) {
            if ($array[0] == $last_mod) echo '<ul>';
            else echo '</li>';
            $status = 1;
        }else {
            if ($k > 0 and $array[0] != $last_mod) echo '</li>';
            if ($status) echo '</ul></li>';
            $status = 0;
            $last_mod = $array[0];
        }
        $class = $a_class = "";
        if (($last_mod == (intval($mod / 10) * 10) and $status != 1) or $mod == $array[0]) $class.= 'on ';
        if ($k + 1 == count($nav)) $class.= 'radiusBottomLeft5 radiusBottomRight5';
        if ($k + 1 == count($nav)) $a_class = ' class="radiusBottomLeft5 radiusBottomRight5"';
        echo '<li' . ($class != "" ? ' class="' . $class . '"' : '') . '><a href="./?mod=' . $array[0] . '"' . $a_class . '>' . $array[1] . '</a>';
    }
}
echo '</li></ul>';
if ($status) echo '</li></ul>';