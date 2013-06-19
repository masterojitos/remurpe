<?php
require_once "config.php";

if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $departamento = $_POST['departamento'];
    $provincia = $_POST['provincia'];
    $distrito = $_POST['distrito'];
    $recomendado_nombre = $_POST['recomendado_nombre'];
    $recomendado_email = $_POST['recomendado_email'];
    $recomendado_telefono = $_POST['recomendado_telefono'];
    $nivel_estudios = $_POST['nivel_estudios'];
    $profesion = $_POST['profesion'];
    $experiencia_3_ultimos_anos = $_POST['experiencia_3_ultimos_anos'];
    $experiencia_gobiernos_locales = $_POST['experiencia_gobiernos_locales'];
    $experiencia_gobiernos_regionales = $_POST['experiencia_gobiernos_regionales'];
    $referencia_nombre = $_POST['referencia_nombre'];
    $referencia_email = $_POST['referencia_email'];
    $referencia_telefono = $_POST['referencia_telefono'];
    $referencia_rpm = $_POST['referencia_rpm'];
    $especializacion = $cn->scape(serialize($_POST['especializacion']));
    $intervencion = $cn->scape(serialize($_POST['intervencion']));
    
//    $files = array('image' => 'fotografia', 'pdf' => 'curriculum');
    $fotografia = '';
    $files = array('pdf' => 'curriculum');
    $allowed_image_types = array('image/jpeg', 'image/jpg');
    $allowed_pdf_types = array('application/pdf', 'application/x-pdf', 'application/acrobat', 'applications/vnd.pdf', 'text/pdf', 'text/x-pdf');
    $userfiles_folder = './userfiles/';
    $file_unique = uniqid();
    foreach ($files as $file_type => $file) {
        ${$file} = "";
        if (!isset($_FILES[$file]) || empty($_FILES[$file])) continue;
        if ($_FILES[$file]['error'] !== 0) continue;
        if (!in_array($_FILES[$file]['type'], ${'allowed_' . $file_type . '_types'})) continue;
        $file_name = basename($_FILES[$file]['name']);
        $file_tmp = $_FILES[$file]['tmp_name'];
        do {
            $file_unique_name = $file_unique . '_' . $file_name;
            $file_path = $userfiles_folder . $file_unique_name;
        } while (file_exists($file_path));
        if (move_uploaded_file($file_tmp, $file_path)) {
            ${$file} = $file_unique_name;
        }
    }
    
    $query = 'INSERT INTO `postulante` (`nombre`, `apellido`, `dni`, `telefono`, `email`, `foto`, `departamento`, `provincia`, `distrito`, 
        `recomendado_nombre`, `recomendado_email`, `recomendado_telefono`, `nivel_estudios`, `profesion`, `experiencia_3_ultimos_anos`, `experiencia_gobiernos_locales`, `experiencia_gobiernos_regionales`, 
        `referencia_nombre`, `referencia_email`, `referencia_telefono`, `referencia_rpm`, `especializacion`, `intervencion`, `curriculum`) 
        VALUES ("' . $nombre . '", "' . $apellido . '", "' . $dni . '", "' . $telefono . '", "' . $email . '", "' . $fotografia . '", 
        "' . $departamento . '", "' . $provincia . '", "' . $distrito . '", "' . $recomendado_nombre . '", "' . $recomendado_email . '", "' . $recomendado_telefono . '", 
        "' . $nivel_estudios . '", "' . $profesion . '", "' . $experiencia_3_ultimos_anos . '", "' . $experiencia_gobiernos_locales . '", "' . $experiencia_gobiernos_regionales . '", 
        "' . $referencia_nombre . '", "' . $referencia_email . '", "' . $referencia_telefono . '", "' . $referencia_rpm . '", "' . $especializacion . '", "' . $intervencion . '", "' . $curriculum . '");';
    $cn->query($query);
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--[if ie]><meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1"><![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Postulación a Remurpe</title>
        <link rel="stylesheet" fonohref="css/normalize.css" />
        <link rel="stylesheet" href="css/MOStyles.css" />
        <link rel="stylesheet" href="css/social-icons.css" />
        <link rel="stylesheet" href="css/style.css" />
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <body>
        <form class="container-poll MOForm" method="POST" enctype="multipart/form-data">
            <div class="title-poll">
                <h2>Consultas / preguntas</h2>
                <ul class="social-icons color">
                    <li><a href="http://www.youtube.com/user/remurpe" class="youtube">Youtube</a></li>
                    <li><a href="skype:beltus20?chat" class="skype">Skype</a></li>
                    <li><a href="https://www.facebook.com/remurpe.prensa" class="facebook">Facebook</a></li>
                    <li><a href="https://twitter.com/remurpe" class="twitter">Twitter</a></li>
                </ul>
            </div>
            <?php if (isset($_POST['submit'])) { ?>
            <p class="alert alert-success">Gracias por inscribirte.</p>
            <a href="./">Volver al inicio.</a>
            <?php } else { ?>
            <section class="personal-data">
                <h3>Datos personales</h3>
                <p>
                    <label for="nombre">Nombre <small class="input-help">*</small></label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" required="required" maxlength="100" class="input-full" />
                </p>
                <p>
                    <label for="apellido">Apellidos <small class="input-help">*</small></label>
                    <input type="text" name="apellido" id="apellido" placeholder="Apellidos" required="required" maxlength="100" class="input-full" />
                </p>
                <p>
                    <label for="dni">DNI <small class="input-help">*</small></label>
                    <input type="text" name="dni" id="dni" placeholder="DNI" required="required" maxlength="8" class="input-large" />
                </p>
                <p>
                    <label for="telefono">Teléfono <small class="input-help">*</small></label>
                    <input type="tel" name="telefono" id="telefono" placeholder="Telefono" required="required" maxlength="11" class="input-large" />
                </p>
                <p>
                    <label for="email">Email <small class="input-help">*</small></label>
                    <input type="email" name="email" id="email" placeholder="Email" required="required" class="input-large" />
                </p>
                <p>
                    <label for="departamento">Departamento <small class="input-help">*</small></label>
                    <select name="departamento" id="departamento" required="required" class="input-full">
                        <option value="">Seleccione un departamento</option>
                        <?php
                        foreach ($departamentos as $departamento) {
                            echo '<option value="' . $departamento . '">' . $departamento . '</option>';
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="provincia">Provincia <small class="input-help">*</small></label>
                    <select name="provincia" id="provincia" required="required" class="input-full" disabled="disabled">
                        <option value="">Seleccione una provincia</option>
                    </select>
                </p>
                <p>
                    <label for="distrito">Distrito <small class="input-help">*</small></label>
                    <select name="distrito" id="distrito" required="required" class="input-full" disabled="disabled">
                        <option value="">Seleccione un distrito</option>
                    </select>
                </p>
                <p>
                    <label for="recomendado_nombre">Recomendado por el siguiente aliado de REMURPE <small class="input-help">*</small></label>
                    <span class="span-block">
                        <input type="text" name="recomendado_nombre" id="recomendado_nombre" placeholder="Recomendado por" required="required" maxlength="100" class="input-full" />
                        <label for="recomendado_email">Email <small class="input-help">*</small></label>
                        <input type="email" name="recomendado_email" id="recomendado_email" placeholder="Email del Recomendado" required="required" class="input-small" />
                        <label for="recomendado_telefono">Teléfono <small class="input-help">*</small></label>
                        <input type="tel" name="recomendado_telefono" id="recomendado_telefono" placeholder="Teléfono del Recomendado" required="required" maxlength="11" class="input-small" />
                    </span>
                </p>
            </section>
            <section class="formation-profession">
                <h3>Formación / Profesión</h3>
                <p>
                    <label for="nivel_estudios">Nivel de estudios</label>
                    <input type="text" name="nivel_estudios" id="nivel_estudios" placeholder="Nivel de estudios" maxlength="100" class="input-full" />
                </p>
                <p>
                    <label for="profesion">Profesión <small class="input-help">*</small></label>
                    <select name="profesion" id="profesion" required="required" class="input-full">
                        <option value="">Seleccione una profesión</option>
                        <?php
                        foreach ($profesiones as $profesion_categoria => $profesion_items) {
                            echo '<optgroup label="' . $profesion_categoria . '">';
                            foreach ($profesion_items as $profesion) {
                                echo '<option value="' . $profesion . '">' . $profesion . '</option>';
                            }
                            echo '</optgroup>';
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label>Experiencia laboral</label>
                </p>
                <p>
                    <span><label for="experiencia_3_ultimos_anos">3 Últimos años <small class="input-help">*</small></label></span>
                    <textarea name="experiencia_3_ultimos_anos" id="experiencia_3_ultimos_anos" placeholder="3 Últimos años" required="required" class="input-full"></textarea>
                </p>
                <p>
                    <span><label for="experiencia_gobiernos_locales">Gobiernos Locales</label></span>
                    <textarea name="experiencia_gobiernos_locales" id="experiencia_gobiernos_locales" placeholder="Gobiernos Locales" class="input-full"></textarea>
                </p>
                <p>
                    <span><label for="experiencia_gobiernos_regionales">Gobiernos Regionales</label></span>
                    <textarea name="experiencia_gobiernos_regionales" id="experiencia_gobiernos_regionales" placeholder="Gobiernos Regionales" class="input-full"></textarea>
                </p>
                <p>
                    <label for="referencia_nombre">Referencias <small class="input-help">*</small></label>
                    <input type="text" name="referencia_nombre" id="referencia_nombre" placeholder="Referencias" required="required" maxlength="100" class="input-full" />
                </p>
                <p>
                    <label></label>
                    <span>
                        <label for="referencia_email">Email <small class="input-help">*</small></label>
                        <input type="email" name="referencia_email" id="referencia_email" placeholder="Email" required="required" class="input-small" />
                        <label for="referencia_telefono">Teléfono <small class="input-help">*</small></label>
                        <input type="tel" name="referencia_telefono" id="referencia_telefono" placeholder="Teléfono" required="required" maxlength="11" class="input-small" />
                        <label for="referencia_rpm">RPM</label>
                        <input type="tel" name="referencia_rpm" id="referencia_rpm" placeholder="RPM" maxlength="11" class="input-small" />
                    </span>
                </p>
                <p>&nbsp;</p>
                <p>
                    <label class="normal-text">Acepto las condiciones</label>
                    <span class="input-options">
                        <input type="radio" name="condiciones" id="condiciones_si" value="Sí" checked="checked" />
                        <label for="condiciones_si" class="radio">Sí</label>
                        <input type="radio" name="condiciones" id="condiciones_no" value="No" />
                        <label for="condiciones_no" class="radio">No</label>
                        <a href="#" id="reglamento">Requisitos Necesarios</a>
                    </span>
                </p>
                <p>&nbsp;</p>
                <p>
                    <label class="label-full">Áreas de especialización <small class="input-help">*</small></label>
                </p>
                <?php
                $i = 0;
                foreach ($especializaciones as $espececializacion_categoria => $especializacion_items) {
                echo '<div class="column especializacion-' . ++$i . ' input-options" data-checkname="especializacion">
                    <label class="checkbox">
                        <input type="checkbox" class="checkall" data-trigger="especializacion-' . $i . '" />
                        <span><h4>' . $espececializacion_categoria . '</h4></span>
                    </label>
                    <ul>';
                    foreach ($especializacion_items as $especializacion) {
                        echo '<li>
                            <label class="checkbox">
                                <input type="checkbox" name="especializacion[' . $espececializacion_categoria . '][]" value="' . $especializacion . '" class="checkbox-checkall" data-trigger="especializacion-' . $i . '" />
                                <span>' . ucwords($especializacion) . '</span>
                            </label>
                        </li>';
                    }
                    echo '</ul>
                </div>';
                }
                ?>
                <p>
                    <label class="label-full">Zonas de intervención <small class="input-help">*</small></label>
                </p>
                <div class="column row zonas-intervencion input-options" data-checkname="intervencion">
                    <label class="checkbox">
                        <input type="checkbox" class="checkall" data-trigger="zonas-intervencion" />
                        <span><h4>Todas</h4></span>
                    </label>
                    <ul>
                    <?php
                    foreach ($departamentos as $departamento) {
                        $departamento = ucwords(strtolower($departamento));
                        echo '<li>
                            <label class="checkbox">
                                <input type="checkbox" name="intervencion[]" value="' . $departamento . '" class="checkbox-checkall" data-trigger="zonas-intervencion" />
                                <span>' . $departamento . '</span>
                            </label>
                        </li>';
                    }
                    ?>
                    </ul>
                </div>
                <p>
                    <label for="curriculum">Currículum Vitae</label>
                    <input type="text" id="curriculum" class="mo_file input-large" placeholder="Currículum Vitae" readonly="readonly" data-filename="curriculum" />
                    <input type="button" value="Examinar" data-filename="curriculum" />
                    <small class="input-help"> (Solo formato pdf)</small>
                </p>
                <p>&nbsp;</p>
                <p class="row-submit">
                    <input type="submit" name="submit" value="Enviar" />
                </p>
            </section>
            <input type="file" name="fotografia" class="mo_file_trigger">
            <input type="file" name="curriculum" class="mo_file_trigger">
            <span id="variables" data-provincias='<?php echo json_encode($provincias); ?>' data-distritos='<?php echo json_encode($distritos); ?>'></span>
            <?php } ?>
        </form>
        <script src="js/respond.min.js"></script>
        <script src="js/prefixfree.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>