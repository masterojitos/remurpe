<?php
include "includes/ubigeo.php";
$profesiones = array();
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
        <link rel="stylesheet" href="css/style.css" />
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    </head>
    <body>
        <form class="container-poll MOForm">
            <div class="title-poll">
                <h2>Consultas / Preguntas</h2>
                <button>Reglamento para postular</button>                
            </div>
            <section class="personal-data">
                <h3>Datos personales</h3>
                <p>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre" required="required" class="input-full" />
                </p>
                <p>
                    <label for="apellidos">Apellidos</label>
                    <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" required="required" class="input-full" />
                </p>
                <p>
                    <label for="dni">DNI</label>
                    <input type="text" name="dni" id="dni" placeholder="DNI" required="required" class="input-large" />
                </p>
                <p>
                    <label for="telefono">Teléfono</label>
                    <input type="tel" name="telefono" id="telefono" placeholder="Telefono" class="input-large" />
                </p>
                <p>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" class="input-large" />
                </p>
                <p>
                    <label for="fotografia"">Fotografia</label>
                    <input type="text" id="fotografia" class="mo_file input-large" placeholder="Fotografia" readonly="readonly" data-filename="fotografia" />
                    <input type="button" value="Explorar" data-filename="fotografia" />
                    <small class="input-help"> (Solo formatos jpg)</small>
                </p>
                <p>
                    <label for="departamento">Departamento</label>
                    <select name="departamento" id="departamento" class="input-full">
                        <option value="">Seleccione un departamento</option>
                        <?php
                        foreach ($departamentos as $departamento) {
                            echo '<option value="' . $departamento . '">' . $departamento . '</option>';
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="provincia">Provincia</label>
                    <select name="provincia" id="provincia" class="input-full" disabled="disabled">
                        <option value="">Seleccione una provincia</option>
                    </select>
                </p>
                <p>
                    <label for="distrito">Distrito</label>
                    <select name="distrito" id="distrito" class="input-full" disabled="disabled">
                        <option value="">Seleccione un distrito</option>
                    </select>
                </p>
                <p>
                    <label for="recomendado_nombre">Recomendado por</label>
                    <input type="text" name="recomendado_nombre" id="recomendado_nombre" placeholder="Recomendado por" class="input-full" />
                </p>
                <p>
                    <label></label>
                    <span>
                        <label for="recomendado_email">Email</label>
                        <input type="email" name="recomendado_email" id="recomendado_email" placeholder="Email del Recomendado" class="input-small" />
                        <label for="recomendado_telefono">Teléfono</label>
                        <input type="tel" name="recomendado_telefono" id="recomendado_telefono" placeholder="Teléfono del Recomendado" class="input-small" />
                    </span>
                </p>
            </section>
            <section class="formation-profession">
                <h3>Formación / Profesión</h3>
                <p>
                    <label for="nivel_estudios">Nivel de estudios</label>
                    <input type="text" name="nivel_estudios" id="nivel_estudios" placeholder="Nivel de estudios" class="input-full" />
                </p>
                <p>
                    <label for="profesion">Profesión</label>
                    <select name="profesion" id="profesion" class="input-full">
                        <option value="">Seleccione una profesión</option>
                        <?php
                        foreach ($profesiones as $profesion) {
                            echo '<option value="' . $profesion . '">' . $profesion . '</option>';
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label>Experiencia laboral</label>
                </p>
                <p>
                    <span><label for="experiencia_3_ultimos_anos">3 Últimos años</label></span>
                    <textarea name="experiencia_3_ultimos_anos" id="experiencia_3_ultimos_anos" placeholder="3 Últimos años" class="input-full"></textarea>
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
                    <label for="referencias">Referencias</label>
                    <input type="text" name="referencias" id="referencias" placeholder="Referencias" class="input-full" />
                </p>
                <p>
                    <label></label>
                    <span>
                        <label for="referencia_email">Email</label>
                        <input type="email" name="referencia_email" id="referencia_email" placeholder="Email de la referencia" class="input-small" />
                        <label for="referencia_telefono">Teléfono</label>
                        <input type="tel" name="referencia_telefono" id="referencia_telefono" placeholder="Teléfono de la referencia" class="input-small" />
                        <label for="referencia_rpm">RPM</label>
                        <input type="tel" name="referencia_rpm" id="referencia_rpm" placeholder="RPM de la referencia" class="input-small" />
                    </span>
                </p>
            </section>
            <input type="file" name="fotografia" class="mo_file_trigger">
            <span id="variables" data-provincias='<?php echo json_encode($provincias); ?>' data-distritos='<?php echo json_encode($distritos); ?>'></span>
        </form>
        <script src="js/respond.min.js"></script>
        <script src="js/prefixfree.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>