<link href="../lib/DataTables/media/css/demo_table.css" rel="stylesheet" type="text/css" />
<?php require_once "../config.php"; ?>
<div class="special-filter">
    <h3>Filtro especial</h3>
    <p class="block-profesion">
        <label for="profesion">Profesión</label>
        <select name="profesion" id="profesion" multiple="multiple">
            <?php
            foreach ($profesiones as $profesion_categoria => $profesion_items) {
                echo '<optgroup label="' . $profesion_categoria . '" title="' . $profesion_categoria . '">';
                foreach ($profesion_items as $profesion) {
                    echo '<option value="' . $profesion . '" title="' . $profesion . '">' . $profesion . '</option>';
                }
                echo '</optgroup>';
            }
            ?>
        </select>
    </p>
    <p class="block-especializacion">
        <label for="especializacion">Áreas de especialización</label>
        <select name="especializacion" id="especializacion" multiple="multiple">
            <?php
            foreach ($especializaciones as $espececializacion_categoria => $especializacion_items) {
                echo '<optgroup label="' . $espececializacion_categoria . '" title="' . $espececializacion_categoria . '">';
                foreach ($especializacion_items as $especializacion) {
                    echo '<option value="' . $especializacion . '" title="' . $especializacion . '">' . ucwords($especializacion) . '</option>';
                }
                echo '</optgroup>';
            }
            ?>
        </select>
    </p>
    <p class="block-intervencion">
        <label for="intervencion">Zonas de intervención</label>
        <select name="intervencion" id="intervencion" multiple="multiple">
            <?php
            foreach ($departamentos as $departamento) {
                $departamento = ucwords(strtolower($departamento));
                echo '<option value="' . $departamento . '" title="' . $departamento . '">' . $departamento . '</option>';
            }
            ?>
        </select>
    </p>
    <div>
        <input type="button" id="special_filter" value="Filtrar" />
        <input type="button" id="clear_filter" value="Reinicializar" />
    </div>
</div>
<table id="approved-list" width="100%" class="listing datatable display">
    <thead>
        <tr>
            <th width="8%">N&deg;</th>
            <th width="22%">Nombre</th>
            <th width="23%">Apellidos</th>
            <th width="10%">DNI</th>
            <th width="25%">Email</th>
            <th width="12%">Fecha de Registro</th>
            <th>Profesión</th>
            <th>Área de Especialización</th>
            <th>Zonas de Intervención</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="6" class="dataTables_empty center"><p>Cargando datos...</p></td>
        </tr>
    </tbody>
</table>