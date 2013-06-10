<?php
require_once "../config.php";
$id = isset($_POST['id']) ? $_POST['id'] : "";
if(!empty($id)){
    $cn->query("SELECT * FROM postulante WHERE id = '" . $cn->scape($id) . "'");
	$row = $cn->fetch();
    $tab = '&nbsp;&nbsp;&nbsp;&nbsp;';
    $especializaciones = unserialize($row['especializacion']);
    $especializaciones_text = "";
    if (count($especializaciones)) {
        foreach ($especializaciones as $espececializacion_categoria => $especializacion_items) {
            if (is_array($especializacion_items) && count($especializacion_items)) {
                $especializaciones_text.= $espececializacion_categoria;
                $especializaciones_array = array();
                $especializaciones_text.= ":<br />";
                foreach ($especializacion_items as $especializacion) {
                    $especializaciones_array[] = $especializacion;
                }
                $especializaciones_text.= $tab . '- ' . implode('<br />' . $tab . '- ', $especializaciones_array) . '<br />';
            }
        }
    }
    $intervenciones = unserialize($row['intervencion']);
    $intervenciones_text = "";
    if (count($intervenciones)) {
        $intervenciones_text = '- ' . implode("<br />- ", $intervenciones);
    }
}else exit;
?>
<fieldset>
    <legend>Detalle del Postulante</legend>
    <table width="100%" class="table-detail">
        <tr><td width="180"><strong>Nombre:</strong></td><td><?php echo $row['nombre']; ?></td></tr>
        <tr><td><strong>Apellido:</strong></td><td><?php echo $row['apellido']; ?></td></tr>
        <tr><td><strong>DNI:</strong></td><td><?php echo $row['dni']; ?></td></tr>
        <tr><td><strong>Teléfono:</strong></td><td><?php echo $row['telefono']; ?></td></tr>
        <tr><td><strong>Email:</strong></td><td><?php echo $row['email']; ?></td></tr>
        <tr><td><strong>Fotografía:</strong></td><td><?php echo ($row['foto'] !== "" ? '<a href="../userfiles/' . $row['foto'] . '">Ver</a>' : ''); ?></td></tr>
        <tr><td><strong>Departamento:</strong></td><td><?php echo $row['departamento']; ?></td></tr>
        <tr><td><strong>Provincia:</strong></td><td><?php echo $row['provincia']; ?></td></tr>
        <tr><td><strong>Distrito:</strong></td><td><?php echo $row['distrito']; ?></td></tr>
        <tr><td><strong>Recomendado por:</strong></td><td><?php echo $row['recomendado_nombre']; ?></td></tr>
        <tr><td><?php echo $tab; ?><strong>Email:</strong></td><td><?php echo $row['recomendado_email']; ?></td></tr>
        <tr><td><?php echo $tab; ?><strong>Teléfono:</strong></td><td><?php echo $row['recomendado_telefono']; ?></td></tr>
        <tr><td><strong>Nivel de estudios:</strong></td><td><?php echo $row['nivel_estudios']; ?></td></tr>
        <tr><td><strong>Profesión:</strong></td><td><?php echo $row['profesion']; ?></td></tr>
        <tr><td colspan="2"><strong>Experiencia laboral:</strong></td></tr>
        <tr><td><?php echo $tab; ?><strong>3 Últimos años:</strong></td><td><?php echo nl2br($row['experiencia_3_ultimos_anos']); ?></td></tr>
        <tr><td><?php echo $tab; ?><strong>Gobiernos locales:</strong></td><td><?php echo nl2br($row['experiencia_gobiernos_locales']); ?></td></tr>
        <tr><td><?php echo $tab; ?><strong>Gobiernos regionales:</strong></td><td><?php echo nl2br($row['experiencia_gobiernos_regionales']); ?></td></tr>
        <tr><td><strong>Referenciado por:</strong></td><td><?php echo $row['referencia_nombre']; ?></td></tr>
        <tr><td><?php echo $tab; ?><strong>Email:</strong></td><td><?php echo $row['referencia_email']; ?></td></tr>
        <tr><td><?php echo $tab; ?><strong>Teléfono:</strong></td><td><?php echo $row['referencia_telefono']; ?></td></tr>
        <tr><td><?php echo $tab; ?><strong>RPM:</strong></td><td><?php echo $row['referencia_rpm']; ?></td></tr>
        <tr><td><strong>Áreas de especialización:</strong></td><td><?php echo $especializaciones_text; ?></td></tr>
        <tr><td><strong>Zonas de Intervención:</strong></td><td><?php echo $intervenciones_text; ?></td></tr>
        <tr><td><strong>Curriculum Vitae:</strong></td><td><?php echo ($row['curriculum'] !== "" ? '<a href="./userfiles/' . $row['curriculum'] . '">Ver</a>' : ''); ?></td></tr>
        <tr><td><strong>Fecha de Registro:</strong></td><td><?php echo date("d-m-Y H:i:s", strtotime($row['fecha_creacion'])); ?></td></tr>
        <tr><td colspan="2"><br /><input type="button" value="Retornar" class="list" /></td></tr>
    </table>
</fieldset>