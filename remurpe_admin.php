<?php
require_once "config.php";
$cn->query("SELECT * FROM postulante");
$tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
echo '<h1>Postulantes</h1>';
while ($row = $cn->fetch()) {
    $especializaciones = unserialize($row['especializacion']);
    $especializaciones_text = "";
    if (count($especializaciones)) {
        foreach ($especializaciones as $espececializacion_categoria => $especializacion_items) {
            $especializaciones_text.= $tab . $espececializacion_categoria;
            if (count($especializacion_items)) {
                $especializaciones_array = array();
                $especializaciones_text.= ": ";
                foreach ($especializacion_items as $especializacion) {
                    $especializaciones_array[] = $especializacion;
                }
                $especializaciones_text.= implode(", ", $especializaciones_array) . '<br />';
            }
        }
    }
    $intervenciones = unserialize($row['intervencion']);
    $intervenciones_text = "";
    if (count($intervenciones)) {
        $intervenciones_text = implode(", ", $intervenciones);
    }
    echo '<strong>Nombre:</strong> ' . $row['nombre'] . '<br />
    <strong>Apellido:</strong> ' . $row['apellido'] . '<br />
    <strong>DNI:</strong> ' . $row['dni'] . '<br />
    <strong>Teléfono:</strong> ' . $row['telefono'] . '<br />
    <strong>Email:</strong> ' . $row['email'] . '<br />
    <strong>Fotografía:</strong> ' . ($row['foto'] !== "" ? '<a href="./userfiles/' . $row['foto'] . '">Ver</a>' : '') . '<br />
    <strong>Departamento:</strong> ' . $row['departamento'] . '<br />
    <strong>Provincia:</strong> ' . $row['provincia'] . '<br />
    <strong>Distrito:</strong> ' . $row['distrito'] . '<br />
    <strong>Recomendado por:</strong> ' . $row['recomendado_nombre'] . '<br />
    '. $tab . '<strong>Email:</strong> ' . $row['recomendado_email'] . '<br />
    '. $tab . '<strong>Teléfono:</strong> ' . $row['recomendado_telefono'] . '<br />
    <strong>Nivel de estudios:</strong> ' . $row['nivel_estudios'] . '<br />
    <strong>Profesión:</strong> ' . $row['profesion'] . '<br />
    <strong>Experiencia laboral:</strong> <br />
    '. $tab . '<strong>3 Últimos años:</strong> ' . $row['experiencia_3_ultimos_anos'] . '<br />
    '. $tab . '<strong>Gobiernos locales:</strong> ' . $row['experiencia_gobiernos_locales'] . '<br />
    '. $tab . '<strong>Gobiernos regionales:</strong> ' . $row['experiencia_gobiernos_regionales'] . '<br />
    <strong>Referenciado por:</strong> ' . $row['referencia_nombre'] . '<br />
    '. $tab . '<strong>Email:</strong> ' . $row['referencia_email'] . '<br />
    '. $tab . '<strong>Teléfono:</strong> ' . $row['referencia_telefono'] . '<br />
    '. $tab . '<strong>RPM:</strong> ' . $row['referencia_rpm'] . '<br />
    <strong>Áreas de especialización:</strong><br />' . $especializaciones_text . '
    <strong>Zonas de Intervención:</strong> ' . $intervenciones_text . '<br />
    <strong>Curriculum Vitae:</strong> ' . ($row['curriculum'] !== "" ? '<a href="./userfiles/' . $row['curriculum'] . '">Ver</a>' : '') . '<br />
    <strong>Fecha de Registro:</strong> ' . date("d-m-Y H:i:s", strtotime($row['fecha_creacion'])) . '<br />
    <br />---------------------------------------------------------------------------------------<br /><br />';
}