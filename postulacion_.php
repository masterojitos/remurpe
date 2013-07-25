<?php
require_once "config.php";

if (isset($_POST['submit'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $departamento = $_POST['departamento'];
    $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : '';
    $distrito = isset($_POST['distrito']) ? $_POST['distrito'] : '';
    $aliados = isset($_POST['aliados']) && is_array($_POST['aliados']) ? implode(",", $_POST['aliados']) : '';
    $nivel_estudios = $_POST['nivel_estudios'];
    $profesion = $_POST['profesion'];
    $experiencia_3_ultimos_anos = $_POST['experiencia_3_ultimos_anos'];
    $experiencia_gobiernos_locales = $_POST['experiencia_gobiernos_locales'];
    $experiencia_gobiernos_regionales = $_POST['experiencia_gobiernos_regionales'];
    $referencia_nombre = isset($_POST['referencia_nombre']) ? $cn->scape(serialize($_POST['referencia_nombre'])) : '';
    $referencia_lugar_trabajo = isset($_POST['referencia_lugar_trabajo']) ? $cn->scape(serialize($_POST['referencia_lugar_trabajo'])) : '';
    $referencia_cargo = isset($_POST['referencia_cargo']) ? $cn->scape(serialize($_POST['referencia_cargo'])) : '';
    $referencia_email = isset($_POST['referencia_email']) ? $cn->scape(serialize($_POST['referencia_email'])) : '';
    $referencia_telefono = isset($_POST['referencia_telefono']) ? $cn->scape(serialize($_POST['referencia_telefono'])) : '';
    $referencia_rpm = isset($_POST['referencia_rpm']) ? $cn->scape(serialize($_POST['referencia_rpm'])) : '';
    $especializacion = isset($_POST['especializacion']) ? $cn->scape(serialize($_POST['especializacion'])) : '';
    $intervencion = isset($_POST['intervencion']) ? $cn->scape(serialize($_POST['intervencion'])) : '';
    
//    $files = array('image' => 'fotografia', 'pdf' => 'curriculum');
    $fotografia = '';
    $files = array('pdf' => 'curriculum');
    $allowed_image_types = array('image/jpeg', 'image/jpg');
    $allowed_image_exts = array('jpeg', 'jpg');
    $allowed_pdf_types = array('application/pdf', 'application/x-pdf', 'application/acrobat', 'applications/vnd.pdf', 'text/pdf', 'text/x-pdf');
    $allowed_pdf_exts = array('pdf');
    $userfiles_folder = './userfiles/';
    $file_unique = uniqid();
    foreach ($files as $file_type => $file) {
        ${$file} = "";
        if (!isset($_FILES[$file]) || empty($_FILES[$file])) continue;
        if ($_FILES[$file]['error'] !== 0) continue;
        if (function_exists("finfo_open")) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            if (!in_array(finfo_file($finfo, $_FILES[$file]['tmp_name']), ${'allowed_' . $file_type . '_types'})) continue;
            finfo_close($finfo);
        } else {
            if (!in_array(end(explode(".", $_FILES[$file]['name'])), ${'allowed_' . $file_type . '_exts'})) continue;
        }
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
        `aliados`, `nivel_estudios`, `profesion`, `experiencia_3_ultimos_anos`, `experiencia_gobiernos_locales`, `experiencia_gobiernos_regionales`, 
        `referencia_nombre`, `referencia_lugar_trabajo`, `referencia_cargo`, `referencia_email`, `referencia_telefono`, `referencia_rpm`, `especializacion`, `intervencion`, `curriculum`) 
        VALUES ("' . $nombre . '", "' . $apellido . '", "' . $dni . '", "' . $telefono . '", "' . $email . '", "' . $fotografia . '", 
        "' . $departamento . '", "' . $provincia . '", "' . $distrito . '", "' . $aliados . '", "' . $nivel_estudios . '", 
        "' . $profesion . '", "' . $experiencia_3_ultimos_anos . '", "' . $experiencia_gobiernos_locales . '", "' . $experiencia_gobiernos_regionales . '", 
        "' . $referencia_nombre . '", "' . $referencia_lugar_trabajo . '", "' . $referencia_cargo . '", "' . $referencia_email . '", "' . $referencia_telefono . '", "' . $referencia_rpm . '", "' . $especializacion . '", "' . $intervencion . '", "' . $curriculum . '");';
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
            <section class="header-poll">
                <header>
                    <img src="img/logo.png" alt="Remurpe" />
                    <h1>Red Nacional de Expertos en<br /> Gestión Pública Descentralizada</h1>
                </header>
                <footer class="title-poll">
                    <a href="http://www.remurpe.org.pe/component/rsform/?formId=1" target="_blank">Consultas</a>
                    <ul class="social-icons color">
                        <li><a href="http://www.youtube.com/user/remurpe" class="youtube">Youtube</a></li>
                        <li><a href="skype:beltus20?chat" class="skype">Skype</a></li>
                        <li><a href="https://www.facebook.com/remurpe.prensa" class="facebook">Facebook</a></li>
                        <li><a href="https://twitter.com/remurpe" class="twitter">Twitter</a></li>
                    </ul>
                </footer>
            </section>
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
                <div>
                    <label>Recomendado por los siguientes aliados de REMURPE <small class="input-help">*</small></label>
                    <table id="aliados">
                        <thead>
                            <th>Nombres</th>
                            <th>Correo Electrónico</th>
                            <th>Región</th>
                            <th></th>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($aliados as $indice => $aliado) {
                            echo '<tr>
                                <td>' . $aliado[0] . '</td>
                                <td>' . $aliado[1] . '</td>
                                <td>' . $aliado[2] . '</td>
                                <td><input type="checkbox" name="aliados[]" value="' . $indice . '" /></td>
                            </tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </section>
            <section class="formation-profession">
                <h3>Formación / Profesión</h3>
                <p>
                    <label for="nivel_estudios">Nivel de estudios</label>
                    <select name="nivel_estudios" id="nivel_estudios" class="input-full">
                        <option value="">Seleccione un Nivel de estudios</option>
                        <option value="Bachiller">Bachiller</option>
                        <option value="Post Grado">Post Grado</option>
                        <option value="Doctorado">Doctorado</option>
                    </select>
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
                        <option value="Otra">Otra</option>
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
                    <label>Referencias</label>
                </p>
                <div class="bloque">
                    <p>
                        <label for="referencia_nombre_1" class="normal-text">Nombre <small class="input-help">*</small></label>
                        <input type="text" name="referencia_nombre[]" id="referencia_nombre_1" placeholder="Nombre" required="required" maxlength="100" class="input-full" />
                    </p>
                    <p>
                        <label for="referencia_lugar_trabajo_1" class="normal-text">Lugar de Trabajo <small class="input-help">*</small></label>
                        <input type="text" name="referencia_lugar_trabajo[]" id="referencia_lugar_trabajo_1" placeholder="Lugar de Trabajo" required="required" class="input-full" />
                    </p>
                    <p>
                        <label for="referencia_cargo_1" class="normal-text">Cargo <small class="input-help">*</small></label>
                        <input type="text" name="referencia_cargo[]" id="referencia_cargo_1" placeholder="Cargo" required="required" class="input-full" />
                    </p>
                    <p>
                        <label for="referencia_email_1" class="normal-text normal-width">Email <small class="input-help">*</small></label>
                        <input type="email" name="referencia_email[]" id="referencia_email_1" placeholder="Email" required="required" class="input-small" />
                        <label for="referencia_telefono_1" class="normal-text normal-width">Teléfono <small class="input-help">*</small></label>
                        <input type="tel" name="referencia_telefono[]" id="referencia_telefono_1" placeholder="Teléfono" required="required" maxlength="11" class="input-small" />
                        <label for="referencia_rpm_1" class="normal-text normal-width">RPM</label>
                        <input type="tel" name="referencia_rpm[]" id="referencia_rpm_1" placeholder="RPM" maxlength="11" class="input-small" />
                    </p>
                </div>
                <p>
                    <button type="button" id="agregar_referencia">Agregar Referencia</button>
                </p>
                <p>&nbsp;</p>
                <p>
                    <label class="normal-text">Acepto las condiciones</label>
                    <span class="input-options">
                        <input type="radio" name="condiciones" id="condiciones_si" value="Sí" checked="checked" />
                        <label for="condiciones_si" class="radio">Sí</label>
                        <input type="radio" name="condiciones" id="condiciones_no" value="No" />
                        <label for="condiciones_no" class="radio">No</label>
                        <a href="#terms-conditions-modal" id="reglamento">Requisitos Necesarios</a>
                    </span>
                </p>
                <p>&nbsp;</p>
                <p>
                    <label class="label-full">Áreas de especialización <small class="input-help">*</small></label>
                </p>
                <?php
                $i = 0;
                foreach ($especializaciones as $espececializacion_categoria => $especializacion_items) {
                echo '<div class="column especializacion input-options">
                    <label class="checkbox">
                        <input type="checkbox" name="especializacion[' . $espececializacion_categoria . '][]" value="' . $espececializacion_categoria . '" />
                        <span><strong class="criterio-especializacion">' . $letras[$i++] . '</strong> <h4>' . $espececializacion_categoria . '</h4></span>
                    </label>
                    <ul>';
                    foreach ($especializacion_items as $number => $especializacion) {
                        echo '<li>
                            <label class="checkbox">
                                <input type="checkbox" name="especializacion[' . $espececializacion_categoria . '][]" value="' . $especializacion . '" />
                                <span><strong class="criterio-especializacion">' . str_pad(++$number, 2, 0, STR_PAD_LEFT) . '</strong> ' . ucwords($especializacion) . '</span>
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
        <div id="terms-conditions-modal">
            <header>
                <h2>Requisitos Necesarios</h2>
                <a href="#" class="MOButton">Cerrar</a>
            </header>
            <section>
                <p class="title1">RED DE MUNICIPALIDADES URBANAS Y RURALES DEL PERU - REMURPE</p>
                <p class="title1">RED NACIONAL DE EXPERTOS EN GESTION PUBLICA DESCENTRALIZADA RNE-GPD</p>
                <p class="title2">REGLAMENTO INTERNO</p>
                <p><strong>PRINCIPIOS, OBJETIVOS Y FINES</strong></p>
                <p><strong>Art&iacute;culo 1.- </strong>La Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD, es una plataforma en red creado para el soporte t&eacute;cnico, pol&iacute;tico-institucional especializado de la REMURPE con competencia exclusiva. La RNE-GPD, est&aacute; integrado por profesionales expertos en temas de alta especializaci&oacute;n en administraci&oacute;n, asesoramiento, desarrollo de capacidades, ejecuci&oacute;n, de acciones, proyectos y pol&iacute;ticas p&uacute;blicas Municipales y de Gobiernos Regionales. Su funci&oacute;n es el soporte t&eacute;cnico a la REMURPE para el cumplimiento de su Plan Institucional y a Gobiernos Locales asociados de REMURPE .</p>
                <p><strong>Articulo 2.-</strong> La Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD estar&aacute; integrado por profesionales de todas las disciplinas que tengan la m&aacute;s amplia trayectoria profesional, humana, pol&iacute;tica, institucional y acad&eacute;mica ligada a la Gesti&oacute;n P&uacute;blica Municipal y de Gobiernos Regionales, que han acreditado formaci&oacute;n, dominio y experiencia laboral m&iacute;nima de cinco a&ntilde;os.</p>
                <p><strong>Art&iacute;culo 3&deg;.- </strong>Los integrantes de la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD, ser&aacute;n seleccionados previa evaluaci&oacute;n de su respectiva experiencia y especializaci&oacute;n basado en su Curriculum Viate detallado y recomendado por cualquiera de 02 representantes acreditados por REMURPE consignados en un cuadro adjunto; y se revisar&aacute; los antecedentes en condiciones objetivas, transparentes y no discriminatorias, cuya convocatoria ser&aacute; publicada, en la pagina web de la REMURPE. La aceptaci&oacute;n y la acreditaci&oacute;n para formar parte e integrante de la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD ser&aacute; comunicado mediante un documento rubricado por el Secretario Ejecutivo Nacional de la REMURPE</p>
                <p><strong>Art&iacute;culo 4&deg;.- </strong>Los Expertos ejercer&aacute;n su funci&oacute;n dentro de la REMURPE por el periodo que &eacute;stos lo decidan as&iacute; como tambi&eacute;n los informes de evaluaci&oacute;n de cumplimiento de los fines y objetivos de REMURPE, pudiendo la REMURPE o el Experto rescindir o cerrar las relaciones dentro de la Red.</p>
                <p><strong>Art&iacute;culo 5&deg;.- </strong>La funci&oacute;n de los integrantes de la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD no es incompatible con la condici&oacute;n de funcionario de REMURPE, as&iacute; como Director, gerente, trabajador dependiente, asesor, consultor independiente de cualquier instituci&oacute;n descentralizada, gobierno regional o local.</p>
                <p><strong>Art&iacute;culo 6&deg;.- </strong>La Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD es una organizaci&oacute;n perteneciente a REMURPE, todos sus acciones que emprendan ser&aacute; gestionada, administrada por el Secretaria Ejecutiva Nacional de&nbsp; REMURPE, y estar&aacute; sujeto al Plan Institucional y Estatutos de REMURPE.</p>
                <p><strong>Art&iacute;culo 7&deg;.- </strong>La Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD como organizaci&oacute;n en Red de Expertos estar&aacute; estructurada en 03 niveles:</p>
                <ol style="list-style-type:decimal">
                    <li><strong>Especialista Tem&aacute;ticos Nacionales:</strong> Profesionales con formaci&oacute;n acad&eacute;mica y experiencia probada en temas espec&iacute;ficos concretos de Gesti&oacute;n P&uacute;blica Local o Regional (SNIP, OSCE, SIAF, entre otros).</li>
                    <li><strong>Expertos Nacionales en Gesti&oacute;n P&uacute;blico Descentralizada</strong>: Profesionales con formaci&oacute;n profesional y post grado en Gesti&oacute;n P&uacute;blica Local o Regional, experiencia en Gerencia P&uacute;blica y en implementaci&oacute;n de pol&iacute;ticas p&uacute;blicas.</li>
                    <li><strong>Expertos Internacionales en Gesti&oacute;n P&uacute;blica</strong>: Profesionales con formaci&oacute;n acad&eacute;mica y especializaci&oacute;n en Gesti&oacute;n P&uacute;blica, con amplia experiencia en Gerencia Pol&iacute;tica, en elaboraci&oacute;n, implementaci&oacute;n y monitoreo de pol&iacute;ticas p&uacute;blicas y descentralizaci&oacute;n.</li>
                </ol>
                <p>Las especialidades consideradas para la Red RNE-GPD son:</p>
                <table class="especialidades">
                    <tbody>
                        <tr>
                            <td class="none">&nbsp;</td>
                            <th>
                                <p><strong>Gesti&oacute;n del territorio y Recursos Naturales</strong></p>
                            </th>
                        </tr>
                        <tr>
                            <td class="none">&nbsp;</td>
                            <td>
                                <p>Ordenamiento Territorial</p>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <p><strong>Pol&iacute;ticas P&uacute;blicas Descentralizadas</strong></p>
                            </th>
                            <td>
                                <p>Desarrollo Econ&oacute;mico Territorial</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Dise&ntilde;os de Pol&iacute;ticas P&uacute;blicas</p>
                            </td>
                            <td>
                                <p>Gesti&oacute;n de Obras</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Planeamiento territorial e Institucional</p>
                            </td>
                            <td>
                                <p>Gesti&oacute;n Ambiental y Residuos S&oacute;lidos</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Gesti&oacute;n Financiera y presupuestal</p>
                            </td>
                            <td>
                                <p>Gesti&oacute;n Integrada de Recursos H&iacute;dricos</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Contrataciones y adquisiciones</p>
                            </td>
                            <td>
                                <p>Catastro y Desarrollo Urbano</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Servicios P&uacute;blicos</p>
                            </td>
                            <td>
                                <p>Mancomunidad / Asociativismo</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Administraci&oacute;n Tributaria</p>
                            </td>
                            <td>
                                <p>&nbsp;</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Proyectos de preinversi&oacute;n e inversi&oacute;n</p>
                            </td>
                            <th>
                                <p><strong>Pol&iacute;ticas Sociales Descentralizadas</strong></p>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <p>Recursos Humanos</p>
                            </td>
                            <td>
                                <p>Educaci&oacute;n Rural</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Participaci&oacute;n Ciudadana</p>
                            </td>
                            <td>
                                <p>Programas Alimentarios y Sociales</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Soporte Jur&iacute;dico Municipal</p>
                            </td>
                            <td>
                                <p>Saneamiento B&aacute;sico</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="none">&nbsp;</td>
                            <td>
                                <p>Discapacidad e Inclusi&oacute;n</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="none">&nbsp;</td>
                            <td>
                                <p>Generaci&oacute;n de Empleo</p>
                            </td>
                        </tr>
                        <tr>
                            <td class="none">&nbsp;</td>
                            <td>
                                <p>J&oacute;venes y G&eacute;nero</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p><strong>DE LA ORGANIZACI&Oacute;N Y FUNCIONAMIENTO</strong></p>
                <p><strong>Art&iacute;culo 8&deg;.- </strong>La Coordinaci&oacute;n de la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD estar&aacute; integrada por el Secretario Ejecutivo Nacional&nbsp; de REMURPE, Un miembro del Equipo T&eacute;cnico; Un Coordinador Regional en las regiones donde REMURPE acredite una Organizaci&oacute;n de Municipalidades y Un coordinador Tem&aacute;tico de Gesti&oacute;n del Territorio y de Recursos Naturales, Un Coordinador Tem&aacute;tico de Gesti&oacute;n P&uacute;blica Descentralizada y Un coordinador de Gesti&oacute;n de Pol&iacute;ticas Sociales Descentralizada.</p>
                <p><strong>Art&iacute;culo 9.-</strong> El Coordinador ser&aacute; ejercido por el Secretario Ejecutivo de la REMURPE. El Coordinador ser&aacute; un Experto Nacional que representar&aacute; y coordinar&aacute; la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD y ejercer&aacute; las funciones previstas en este Reglamento y en su normativa interna, la que tambi&eacute;n definir&aacute; su r&eacute;gimen.</p>
                <p><strong>Art&iacute;culo 10.- </strong>La Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD, tendr&aacute; sesiones de trabajo previa convocatoria formal a nivel de REMURPE Nacional o en la REDES Regionales de REMURPE, generalmente un d&iacute;a antes de las Conferencias Anuales de Municipalidades &ndash; CAMUR Nacional y Regionales, donde se discutir&aacute;n una agenda previamente consensuada durante la convocatoria y adoptar&aacute; sus acuerdos compromisos, metodolog&iacute;as, documentaci&oacute;n y otros que considere importante para beneficio de los integrantes de la Red, la institucionalidad de REMURPE y el Pa&iacute;s.</p>
                <p><strong>Art&iacute;culo 11.- </strong>La Coordinaci&oacute;n de la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD, sesionar&aacute; al menos una cada semestre para efectos analizar, evaluar y programar avances del plan y cumplimiento de metas.</p>
                <p><strong>Art&iacute;culo 12.- </strong>La sede de la Coordinaci&oacute;n de la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD est&aacute; ubicada en las oficinas de REMURPE&nbsp; Nacional y en las Redes Regionales u organizaciones de municipalidades acreditadas por REMURPE.</p>
                <p><strong>Art&iacute;culo 13.- </strong>El Coordinador de la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD tendr&aacute; las siguientes funciones:</p>
                <ol style="list-style-type:lower-alpha">
                    <li>Llevar el registro de Actas y dem&aacute;s presentaciones que se formulen a la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD.</li>
                    <li>Efectuar el examen de admisibilidad formal de los nuevos integrantes que se presenten a conocimiento de la Coordinaci&oacute;n de la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD</li>
                    <li>Poner en conocimiento del consejo directivo la nomina de los expertos nacionales registrados en el sistema inform&aacute;tico de REMURPE.</li>
                    <li>Informar de los acuerdos tomados en las sesiones de trabajo.</li>
                    <li>Certificar las actuaciones de la Coordinaci&oacute;n y ejercer la custodia de sus archivos.</li>
                    <li>Levantar acta fiel e &iacute;ntegra de las sesiones de la Coordinaci&oacute;n de la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD.</li>
                    <li>Asistir a la Coordinaci&oacute;n de la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD en sus actividades.</li>
                </ol>
                <p><strong>DE LAS RESPONSABILIDADES, BENEFICIOS Y SANCIONES</strong></p>
                <p><strong>Art&iacute;culo 14.- </strong>Los integrantes de la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD son responsables de los documentos adjuntos en Curriculum Vitae, de los datos consignado en el registro electr&oacute;nico de la Pagina Web de REMURPE, lo cual tiene el valor de Declaraci&oacute;n Jurada.</p>
                <p><strong>Art&iacute;culo 15.- </strong>Corresponder&aacute; a la Secretaria Ejecutiva Nacional de REMURPE en calidad de Coordinador de la RNE-GPD y de los integrantes de la Coordinaci&oacute;n evaluar permanentemente&nbsp; el desempe&ntilde;o y cumplimiento de las actividades de cada Asociado a la Red.</p>
                <p><strong>Art&iacute;culo 16.- </strong>Los beneficios para el Asociado a la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD, son los siguientes.</p>
                <ol style="list-style-type:lower-alpha">
                    <li>Especializaci&oacute;n profesional en temas que el Experto crea de su inter&eacute;s a nivel de talleres, diplomados, post grados, implementados directamente por REMURPE, con instituciones nacionales y extranjeras; p&uacute;blicas o privadas con las que REMURPE tiene convenios de formaci&oacute;n de capacidades, O con Universidades de prestigio nacional e internacional aliadas de REMURPE.</li>
                    <li>Elecci&oacute;n preferente en los servicios de consultor&iacute;a especializados que los Asociados de REMURPE requieran.</li>
                    <li>Elecci&oacute;n preferente en los servicios de consultor&iacute;a especializados que la REMURPE y sus instituciones aliadas requieran.</li>
                    <li>Acceso a oportunidades laborales afines la especialidad del Experto.</li>
                    <li>Acceso a informaci&oacute;n exclusiva de REMURPE, sobre temas de especializaci&oacute;n y de inter&eacute;s.</li>
                </ol>
                <p><strong>DEL INGRESO AL RNE-GPD</strong></p>
                <p><strong>Art&iacute;culo 17.- </strong>La actualizaci&oacute;n de la RNE-GPD es libre y voluntaria y est&aacute; dirigido a todas las personas que deseen pertenecer al Equipo Nacional de expertos de REMURPE, quienes deber&aacute;n cumplir con los siguientes requisitos:</p>
                <ol style="list-style-type:lower-alpha">
                    <li>Llenar la ficha de datos que se encuentra en la p&aacute;gina WEB de la REMURPE.</li>
                    <li>Consignar el nombre y la autorizaci&oacute;n de 02 miembros responsables de REMURPE que garantizan conocer su experiencia laboral.</li>
                    <li>Presentar su Curriculum Vitae en f&iacute;sico con documentaci&oacute;n detallada, que ser&aacute; entregado a una persona responsable que se consigna en el cuadro adjunto.</li>
                </ol>
                <p>Cuadro: Miembros de REMURPE Nacional acreditados para autorizaci&oacute;n.</p>
                <table>
                    <thead>
                        <th>Nombres</th>
                        <th>Correo Electrónico</th>
                        <th>Región</th>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($aliados as $aliado) {
                        echo '<tr>
                            <td>' . $aliado[0] . '</td>
                            <td>' . $aliado[1] . '</td>
                            <td>' . $aliado[2] . '</td>
                        </tr>';
                    }
                    ?>
                    </tbody>
                </table>
                <p><strong>Art&iacute;culo 18.- </strong>El responsable del manejo de la Pagina WEB de REMURPE recibir&aacute; la ficha la misma que tiene car&aacute;cter de declaraci&oacute;n jurada, y la derivar&aacute; al correo correspondiente para su evaluaci&oacute;n y posterior otorgamiento del CERTIFICADO que lo habilita como experto de REMURPE, previo cumplimiento de los 3 requisitos mencionados.</p>
                <p><strong>Art&iacute;culo 19</strong>.- Cumplido los 03 requisitos fundamentales y aceptados las condiciones del presente reglamento los Expertos se sujetan a estas condiciones.</p>
                <p><strong>Art&iacute;culo 20</strong>.- El Experto puede renunciar a ser parte del equipo de REMURPE, mediante Carta Simple dirigido a la Secretar&iacute;a Ejecutiva Nacional, la misma que deber&aacute; de ser presentada en un plazo m&aacute;ximo de 30 d&iacute;as debiendo de entregar el informe final de sus permanencia como socio de la RNE-GPD.</p>
                <p><strong>Art&iacute;culo 21.-</strong> EL Consejo Directivo previa informaci&oacute;n documentada y sustentada por el Director Ejecutivo, otorgar&aacute; el reconocimiento de los miembros de REMURPE Nacional acreditados para autorizaci&oacute;n.</p>
                <p>EL Consejo directivo deber&aacute; de aprobar en su primera sesi&oacute;n pr&oacute;xima que el Director Ejecutivo Nacional de REMURPE es el coordinador de la Red Nacional de Expertos en Gesti&oacute;n P&uacute;blica Descentralizada RNE-GPD, y es este quien deber&aacute; de informar semestralmente al consejo directivo de los avances, e ingresos generados por la red a favor de REMURPE.</p>
            </section>
        </div>
        <script src="js/respond.min.js"></script>
        <script src="js/prefixfree.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>