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
    <meta name="Author" content="www.tecperu.com">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta name="robots" content="index, follow">
  <meta name="keywords" content="Remurpe,municipalidades,remu,ong,regidores,muni,peru,lima,cusco,alcaldes">
  <meta name="title" content="CONVOCATORIA">
  <meta name="author" content="Administrator">
  <meta name="description" content="Remurpe Red de municipalidades rurales del Peru">
  <meta name="generator" content="Joomla! 1.5 - Open Source Content Management">
  <title>CONVOCATORIA</title>
  <link href="/templates/remurpe/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link rel="stylesheet" href="joomla/CONVOCATORIA_files/inow.htm" type="text/css">
  <link rel="stylesheet" href="joomla/CONVOCATORIA_files/menu_002.css" type="text/css">
  <link rel="stylesheet" href="joomla/CONVOCATORIA_files/menu.css" type="text/css">
  <style type="text/css">
    <!--
UL#ariext126 LI A{font-size:12px;font-weight:normal;text-transform:none;text-align:left;}
    -->
  </style>
  <script src="joomla/CONVOCATORIA_files/ga.js" async="" type="text/javascript"></script><script type="text/javascript" src="joomla/CONVOCATORIA_files/mootools.js"></script>
  <script type="text/javascript" src="joomla/CONVOCATORIA_files/caption.js"></script>
  <script type="text/javascript" src="joomla/CONVOCATORIA_files/ext-core.js"></script>
  <script type="text/javascript" src="joomla/CONVOCATORIA_files/menu.js"></script>
  <script type="text/javascript">
Ext.onReady(function() { new Ext.ux.Menu("ariext126", {"transitionDuration":0.2}); Ext.get("ariext126").select(".ux-menu-sub").removeClass("ux-menu-init-hidden"); });
  </script>
  <!--[if IE]><link rel="stylesheet" type="text/css" href="/modules/mod_ariextmenu/mod_ariextmenu/js/css/menu.ie.min.css" /><![endif]-->
  <!--[if lt IE 8]><script type="text/javascript" src="/modules/mod_ariextmenu/mod_ariextmenu/js/fix.js"></script><![endif]-->

<meta name="Designer" content="Liliana Castillo (lili1500@hotmail.com)">

<link rel="stylesheet" type="text/css" href="joomla/CONVOCATORIA_files/template.css">

<script src="joomla/CONVOCATORIA_files/AC_RunActiveContent.js" type="text/javascript">
</script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-5499278-2']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
        <link rel="stylesheet" fonohref="css/normalize.css" />
        <link rel="stylesheet" href="css/MOStyles.css" />
        <link rel="stylesheet" href="css/social-icons.css" />
        <link rel="stylesheet" href="css/style.css" />
        <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>

<body class="  ext-gecko ext-gecko3" onload="carga">
	
	<div id="contenedor">
    	<div id="cuerpo">
        		<div id="header"><a href="/">
                  <script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0','width','998','height','136','src','/v3/images/banner','quality','high','pluginspage','http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash','wmode','transparent','movie','/v3/images/banner' ); //end AC code
</script><embed src="joomla/CONVOCATORIA_files/banner.htm" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" wmode="transparent" type="application/x-shockwave-flash" height="136" width="998"> <noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,28,0" width="998" height="136">
                    <param name="movie" value="/v3/images/banner.swf" />
                    <param name="quality" value="high" />
                    <param name="wmode" value="transparent" />
                    <embed src="/v3/images/banner.swf" width="998" height="136" quality="high" pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" wmode="transparent"></embed>
                  </object>
</noscript></a>       
        			
              <div id="buscar">

                        <div id="caja">
                        	                        			<div class="moduletableanuncio">
					<form action="index.php" method="post">
	<div class="searchanuncio">
		<input name="searchword" id="mod_search_searchword" maxlength="20" alt="Buscar" class="inputboxanuncio" size="20" value="buscar..." onblur="if(this.value=='') this.value='buscar...';" onfocus="if(this.value=='buscar...') this.value='';" type="text">	</div>
	<input name="task" value="search" type="hidden">
	<input name="option" value="com_search" type="hidden">
	<input name="Itemid" value="162" type="hidden">
</form>		</div>
	
                                                    </div>
                        <div id="icon">
                        </div>
                    </div>
       			</div>
                <div id="menu">
                	<div id="enlaces">
                    		                    			<div class="moduletable">
					
<div style="z-index: 9999;" id="ariext126_container" class="ux-menu-container ux-menu-clearfix">

	<ul id="ariext126" class="ux-menu ux-menu-horizontal">
					<li id="ext-gen6" class="ux-menu-item-main ux-menu-item-level-0 ux-menu-item-parent ux-menu-item132 ux-menu-item-parent-pos0">
				<a id="ext-gen2" href="javascript:void(0);" class=" ux-menu-link-level-0 ux-menu-link-first ux-menu-link-parent">
					Quienes Somos										<span class="ux-menu-arrow"></span>
									</a>
			
	<ul style="width: 134px;" class="ux-menu-sub ux-menu-hidden">
					<li style="width: 134px;" class=" ux-menu-item-level-1 ux-menu-item142">
				<a href="/quienes-somos/mision-y-vision" class=" ux-menu-link-level-1 ux-menu-link-first">
					Misión y Vision									</a>
						</li>
					<li style="width: 134px;" class=" ux-menu-item-level-1 ux-menu-item143">
				<a href="/quienes-somos/historia" class=" ux-menu-link-level-1">
					Historia									</a>
						</li>
					<li style="width: 134px;" class=" ux-menu-item-level-1 ux-menu-item144">
				<a href="/quienes-somos/principios" class=" ux-menu-link-level-1">
					Principios									</a>
						</li>
					<li style="width: 134px;" class=" ux-menu-item-level-1 ux-menu-item145">
				<a href="/quienes-somos/junta-directiva" class=" ux-menu-link-level-1">
					Junta Directiva									</a>
						</li>
					<li style="width: 134px;" class=" ux-menu-item-level-1 ux-menu-item146">
				<a href="/quienes-somos/secretaria-tecnica" class=" ux-menu-link-level-1">
					Secretaría Técnica									</a>
						</li>
					<li style="width: 134px;" class=" ux-menu-item-level-1 ux-menu-item147">
				<a href="/quienes-somos/nuestros-socios" class=" ux-menu-link-level-1 ux-menu-link-last">
					Nuestros Socios									</a>
						</li>
			</ul>
			</li>
					<li id="ext-gen7" class="ux-menu-item-main ux-menu-item-level-0 ux-menu-item-parent ux-menu-item133 ux-menu-item-parent-pos1">
				<a id="ext-gen3" href="#" class=" ux-menu-link-level-0 ux-menu-link-first ux-menu-link-parent ux-menu-link-hover">
					Areas										<span class="ux-menu-arrow"></span>
									</a>
			
	<ul id="ext-gen10" style="width: 188px; left: 0px; top: 33px; opacity: 0; visibility: visible;" class="ux-menu-sub ">
					<li style="width: 188px;" class=" ux-menu-item-level-1 ux-menu-item148">
				<a href="/areas/incidencia" class=" ux-menu-link-level-1 ux-menu-link-first">
					Incidencia									</a>
						</li>
					<li style="width: 188px;" class=" ux-menu-item-level-1 ux-menu-item149">
				<a href="/areas/gestion-alternativa" class=" ux-menu-link-level-1">
					Gestión Alternativa									</a>
						</li>
					<li style="width: 188px;" class=" ux-menu-item-level-1 ux-menu-item163">
				<a href="/areas/unidad-de-gestion-territorial-" class=" ux-menu-link-level-1">
					Unidad de Gestión Territorial									</a>
						</li>
					<li style="width: 188px;" class=" ux-menu-item-level-1 ux-menu-item151">
				<a href="/areas/comunicaciones" class=" ux-menu-link-level-1 ux-menu-link-last">
					Comunicaciones									</a>
						</li>
			</ul>
			</li>
					<li id="ext-gen8" class="ux-menu-item-main ux-menu-item-level-0 ux-menu-item-parent ux-menu-item134 ux-menu-item-parent-pos2">
				<a id="ext-gen4" href="javascript:void(0);" class=" ux-menu-link-level-0 ux-menu-link-first ux-menu-link-parent">
					Asociate										<span class="ux-menu-arrow"></span>
									</a>
			
	<ul style="width: 126px;" class="ux-menu-sub ux-menu-hidden">
					<li style="width: 126px;" class=" ux-menu-item-level-1 ux-menu-item152">
				<a href="/asociate/como-asociarse" class=" ux-menu-link-level-1 ux-menu-link-first">
					Cómo Asociarse									</a>
						</li>
					<li style="width: 126px;" class=" ux-menu-item-level-1 ux-menu-item153">
				<a href="http://remurpe.org.pe/biblioteca-virtual/otras-publicaciones/doc_details/305-descarga-el-formulario-de-como-asociarse" class=" ux-menu-link-level-1">
					Formularios									</a>
						</li>
					<li style="width: 126px;" class=" ux-menu-item-level-1 ux-menu-item154">
				<a href="/asociate/envio-solicitudes" class=" ux-menu-link-level-1 ux-menu-link-last">
					Envio Solicitudes									</a>
						</li>
			</ul>
			</li>
					<li id="ext-gen9" class="ux-menu-item-main ux-menu-item-level-0 ux-menu-item-parent ux-menu-item135 ux-menu-item-parent-pos3">
				<a id="ext-gen5" href="#" class=" ux-menu-link-level-0 ux-menu-link-first ux-menu-link-last ux-menu-link-parent">
					Prensa										<span class="ux-menu-arrow"></span>
									</a>
			
	<ul style="width: 73px;" class="ux-menu-sub ux-menu-hidden">
					<li style="width: 73px;" class=" ux-menu-item-level-1 ux-menu-item155">
				<a href="/prensa/noticias" class=" ux-menu-link-level-1 ux-menu-link-first">
					Archivo									</a>
						</li>
					<li style="width: 73px;" class=" ux-menu-item-level-1 ux-menu-item156">
				<a href="/prensa/fotos" class=" ux-menu-link-level-1">
					Fotos									</a>
						</li>
					<li style="width: 73px;" class=" ux-menu-item-level-1 ux-menu-item157">
				<a href="/prensa/videos" class=" ux-menu-link-level-1">
					Videos									</a>
						</li>
					<li style="width: 73px;" class=" ux-menu-item-level-1 ux-menu-item160">
				<a href="/prensa/audios" class=" ux-menu-link-level-1 ux-menu-link-last">
					Audios									</a>
						</li>
			</ul>
			</li>
			</ul>
</div>		</div>
	
                                      		</div>
                    <div id="botones">
                    			<div class="moduletable">
					<table style="width: 100px;" border="0" cellpadding="3" cellspacing="3">
<tbody>
<tr>
<td><a href="http://remurpe.org.pe/"><img src="joomla/CONVOCATORIA_files/home.png" alt="Home" title="Home" style="border: 0pt none;" border="0"></a></td>
<td><a href="mailto:remurpe@remurpe.org.pe"><img src="joomla/CONVOCATORIA_files/phono.png" alt="Telefono" title="Telefono" style="border: 0pt none;" border="0"></a></td>
<td><a href="/inicio/mapa-del-sitio" title="Mapa del Sitio"><img src="joomla/CONVOCATORIA_files/m.png" border="0"></a></td>
<td><a href="http://webmail.remurpe.org.pe/imp/login.php" target="_blank"><img src="joomla/CONVOCATORIA_files/correo.png" alt="Correo" title="Correo" style="border: 0pt none;" border="0"></a></td>
</tr>
</tbody>
</table>		</div>
	
                    </div>
                </div>
        		<div id="contenido">

                        <!--Validacion de la anchura si no hay o no hay modulos-->
					                    	                        	<!--Fin de la validacion-->
                        <div id="center" style="width:750px">
                        

        <form class="container-poll MOForm" method="POST" enctype="multipart/form-data">
            <section class="header-poll">
                <header>
                    <img src="img/logo.png" alt="Remurpe" />
                    <h1>Red Nacional de Expertos en<br /> Gestión Pública Descentralizada</h1>
                </header>
                <footer class="title-poll">
                    <a href="/component/rsform/?formId=1" target="_blank">Consultas</a>
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

<span class="article_separator">&nbsp;</span>

  								  
                        </div>
                                            <div id="right" style="text-align: center;">
			<div class="moduletable_right">
<iframe scrolling="no" frameborder="0" allowtransparency="true" style="border:1px solid #a4b562; margin-bottom:3px; padding:none;box-shadow: 2px 2px 2px #333;-webkit-box-shadow: 2px 2px 2px #333; -moz-box-shadow: 2px 2px 2px #333; overflow:hidden; width:205px; height:310px; background:#FFFFFF;" src="http://www.facebook.com/plugins/likebox.php?id=103470616393192&amp;width=205&amp;connections=6&amp;stream=false&amp;header=false&amp;height=310">
</iframe>
            </div>
                           		<div class="moduletable_right">
					<p><a href="/component/rsform/?formId=1"><img src="joomla/CONVOCATORIA_files/boton.png" border="0" height="29" width="187"></a></p>		</div>
			<div class="moduletable_right">
					<p><a href="/biblioteca-virtual/otras-publicaciones/cat_view/43-legislacion"><img src="joomla/CONVOCATORIA_files/enlace4.gif" border="0" height="60" width="190"></a></p>		</div>
			<div class="moduletable_right">
					<p><a href="/biblioteca-virtual/publicaciones-remurpe"><img src="joomla/CONVOCATORIA_files/enlace5.gif" border="0" height="60" width="190"></a></p>		</div>
			<div class="moduletable_right">
					<p><a href="/categoria-noticias/540"><img src="joomla/CONVOCATORIA_files/enlace7.gif" border="0" height="60" width="190"></a></p>		</div>
			<div class="moduletable_right">
					<p><a href="/categoria-noticias/571-cambio-climatico-y-gestion-de-riesgos"><img src="joomla/CONVOCATORIA_files/willy%2520-%2520banner.png" border="0" height="62" width="182"></a></p>
<p><a href="/biblioteca-virtual/otras-publicaciones/cat_view/16-observatorio-fiscal"><img src="joomla/CONVOCATORIA_files/enlace8.gif" border="0" height="60" width="190"></a></p>
<p><a href="/boletines"><img src="joomla/CONVOCATORIA_files/enlace9.gif" border="0" height="60" width="190"></a></p>
<p><a href="http://generalo.uimunicipalistas.org/" target="_blank"><img src="joomla/CONVOCATORIA_files/generalo%2520logo.png" border="0" height="51" width="185"></a></p>		</div>
			<div class="moduletable_right">
					<p>
<object style="width: 180px; height: 100px;" data="joomla/CONVOCATORIA_files/amigos.swf" type="application/x-shockwave-flash" height="100" width="180">
<param name="src" value="/images/amigos.swf">
</object>
</p>		</div>
	
                        </div>
                    
        		</div>
               
            
        </div>   
        <div id="footer">
        	<div id="anuncio">
            	 		<div class="moduletableanuncio">
					<table style="min-width: 800px;" align="center" border="0">
<tbody>
<tr>
<td><a href="http://www.madrid.org/" target="_blank"><img src="joomla/CONVOCATORIA_files/l1.jpg" border="0" height="76" width="80"></a></td>
<td><a href="http://www.intermonoxfam.org/" target="_blank">
<p style="text-align: center;"><img src="joomla/CONVOCATORIA_files/l2.jpg" border="0" height="76" width="80"></p>
</a><br></td>
<td><a href="http://www.iaf.gov/" target="_blank">
<p style="text-align: center;"><img src="joomla/CONVOCATORIA_files/l3.jpg" border="0" height="76" width="80"></p>
</a></td>
<td><a href="http://www.giz.de/" target="_blank"><img src="joomla/CONVOCATORIA_files/l4.jpg" border="0" height="76" width="80"><img src="joomla/CONVOCATORIA_files/l5.jpg" border="0" height="76" width="80"></a></td>
<td><a href="http://www.aecid.pe/" target="_blank">
<p style="text-align: center;"><img src="joomla/CONVOCATORIA_files/l7.jpg" border="0" height="76" width="80"></p>
</a></td>
<td></td>
<td><br></td>
<td><a href="http://www.soros.org/" target="_blank">
<p style="text-align: center;"><img src="joomla/CONVOCATORIA_files/i11.jpg" border="0" height="64" width="91"></p>
</a></td>
</tr>
</tbody>
</table>
<table style="min-width: 400px; width: 573px; height: 104px;" align="center" border="0">
<tbody>
<tr>
<td style="text-align: center;"><a href="http://www.fordfoundation.org/" target="_blank"><img src="joomla/CONVOCATORIA_files/fundacion%2520ford.jpg" border="0" height="23" width="191"></a></td>
<td>
<p style="text-align: center;"><br><a href="http://www.idrc.ca/EN/Pages/default.aspx" target="_blank"><img src="joomla/CONVOCATORIA_files/idcr.png" border="0" height="29" width="134"></a></p>
<p style="text-align: center;"><img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD/4QCyRXhpZgAATU0AKgAAAAgABVEAAAQAAAABAAAAAFEBAAMAAAABAAEAAFECAAEAAABgAAAASlEDAAEAAAABAAAAAFEEAAEAAAABHwAAAAAAAAAAAAD////+Fw/+FxD+GBD+Hxf+Ixv+JR3+LSb+ODH+OjT+OzX+QDn+Qzz+Tkf/Ukv+XVf+YFr+Z2L+bmn+eXX+hoH9GBN/f39vb29fX19PT08/Pz8vLy8fHx8PDw//////4QypaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjAtYzA2MCA2MS4xMzQ3NzcsIDIwMTAvMDIvMTItMTc6MzI6MDAgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdEV2dD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlRXZlbnQjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6MDIwNTNDNDM5OEI0RTExMUFDMkU5MkE5Mzc2OEZEQzQiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6MDAwNTNDNDM5OEI0RTExMUFDMkU5MkE5Mzc2OEZEQzQiIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDowMDA1M0M0Mzk4QjRFMTExQUMyRTkyQTkzNzY4RkRDNCIgeG1wOk1ldGFkYXRhRGF0ZT0iMjAxMi0wNi0xMlQwOTowOTo1NS0wNTowMCI+IDx4bXBNTTpIaXN0b3J5PiA8cmRmOlNlcT4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjAxMDUzQzQzOThCNEUxMTFBQzJFOTJBOTM3NjhGREM0IiBzdEV2dDp3aGVuPSIyMDEyLTA2LTEyVDA5OjA5OjQ1LTA1OjAwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQcmVtaWVyZSBQcm8gNS4wIiBzdEV2dDpjaGFuZ2VkPSIvbWV0YWRhdGEiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjAyMDUzQzQzOThCNEUxMTFBQzJFOTJBOTM3NjhGREM0IiBzdEV2dDp3aGVuPSIyMDEyLTA2LTEyVDA5OjA5OjU1LTA1OjAwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQcmVtaWVyZSBQcm8gNS4wIiBzdEV2dDpjaGFuZ2VkPSIvbWV0YWRhdGEiLz4gPC9yZGY6U2VxPiA8L3htcE1NOkhpc3Rvcnk+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIDw/eHBhY2tldCBlbmQ9InciPz7/7QA6UGhvdG9zaG9wIDMuMAA4QklNBAoAAAAAAAEAADhCSU0EJQAAAAAAENQdjNmPALIE6YAJmOz4Qn7/2wBDAAgGBgcGBQgHBwcJCQgKDBQNDAsLDBkSEw8UHRofHh0aHBwgJC4nICIsIxwcKDcpLDAxNDQ0Hyc5PTgyPC4zNDL/2wBDAQkJCQwLDBgNDRgyIRwhMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjL/wAARCAAlAJgDASIAAhEBAxEB/8QAHwAAAQUBAQEBAQEAAAAAAAAAAAECAwQFBgcICQoL/8QAtRAAAgEDAwIEAwUFBAQAAAF9AQIDAAQRBRIhMUEGE1FhByJxFDKBkaEII0KxwRVS0fAkM2JyggkKFhcYGRolJicoKSo0NTY3ODk6Q0RFRkdISUpTVFVWV1hZWmNkZWZnaGlqc3R1dnd4eXqDhIWGh4iJipKTlJWWl5iZmqKjpKWmp6ipqrKztLW2t7i5usLDxMXGx8jJytLT1NXW19jZ2uHi4+Tl5ufo6erx8vP09fb3+Pn6/8QAHwEAAwEBAQEBAQEBAQAAAAAAAAECAwQFBgcICQoL/8QAtREAAgECBAQDBAcFBAQAAQJ3AAECAxEEBSExBhJBUQdhcRMiMoEIFEKRobHBCSMzUvAVYnLRChYkNOEl8RcYGRomJygpKjU2Nzg5OkNERUZHSElKU1RVVldYWVpjZGVmZ2hpanN0dXZ3eHl6goOEhYaHiImKkpOUlZaXmJmaoqOkpaanqKmqsrO0tba3uLm6wsPExcbHyMnK0tPU1dbX2Nna4uPk5ebn6Onq8vP09fb3+Pn6/9oADAMBAAIRAxEAPwD0T4l/Euw8AaWFAS51m4Um1tM8AdPMkxyEB/FiMDuV5DwV4O1n4i6cniLx/qmoXNldEvbaQsjQQMmMJIVQjHU4wASMEkg4rx7VrtviL8XGLTOIdT1NLeJwoykG8IhxnGQgB68nNfZEMMdvDHDDGkcUahERFAVVAwAAOgFAHn198FvCTw79GiutE1BBmG9sbqQOhHTgsQRnBPQ8dRXF+CLnxXoXxwPh3xJql3qCiymjtZbhmIkiJDrIoycE+Xg8nkEZyK94rmNZ8Lyaj468M+IoGgT+yxcpcbsh5EkjKqAQOcMc4JGMmgDp6K4/Uvib4bsNZk0WCa61PVo3KPZabbPPIpA55A28dxnI79DUdl8U/C1xqo0q9urjSdTLbfsuqW7W7DjIJYjaMjplue3UUAdpRVDWdb0zw9pz6hq15FaWqEAySHqT0AA5J9hWDpHxP8Ga7cXMNhrsLNbQmeZpY3hRIwwUsXdQuMso696AOtorgr74yeCtPMBk1C5eGZtonSyl8se+4qNw/wB3PSur0LxBpXibTF1HRr6K8tGYrvTIKsOqsDgqeQcEA8j1oA0qK57xD458N+Fbm3tdZ1RLe5uBmKBY3lkYZwDtQEgE5AJHJBx0rN/4Wn4Wgu4bTVJ7zR7mc4ji1Sxlt9w6btzLtC5yMkjpQB2dFNiljmiSWJ1kjdQyOhyGB5BB7isjX/FmgeF4PN1rVrWz+Xcscj5kcZxlUGWbn0BoAZ4p0GfXtJkhs9VvtMvURjbz2lw0YDkcbwOGXIHbPXBGa8C+D3ivxFqmteIItQ13U7uOPQ7iZFnu3kCOGQBlyeCMnkete7W3jzw3cPbq2oNafaU327X9tLaLOOP9W0qqHPzDhSTzXz18ALX7d4x1m037PP0SeLfjO3dJEM479aUtU7GlJpVIuW10dz4O8ValBrpn1C+1K8toYJJHhErSEgDrtJxx19q6jw58SJtV8TS2M9q721zMVtBFF86DIA3/ADdAAWJ5wc9qzIrLw38MPENrd614qjE8kbCO1Fo5kYN8ucIWIGc845wa17LxL8PPDGtCMzSaTe3a4T7fZXFsNh2j70qKAuVzknrnmuGjSrxSu7an0uZY/LKk5uEOZuKSa0s7vul9/XY5fwFrmr3njXT4LrVb6eF/M3Ry3DspxGxGQTjqBRXV+F/h1Ho2s2esxa0t3GisyKkGA4ZCAQ288fNmitcJCcINT3ucGe4nDYjExnhn7vKltbW78kfN3w1ItPil4fW4Gxlv1jIPZidoH5mvtGvlf4ueFtT8EfEL/hKbBGFnd3gvba5xvEdzneyNkYB3AsAeCPXBx9IeFvElj4s8O2es2DqYp0BdA2TE+PmRvcHj36jgiuo8U2KKK8+8d+LJrXU4tK0mZ2l02F9Z1byJArJbwL5iwk9jK4VeOQuSQVNADfAPwmsPAevajq0OpXF7LcoYYhKgUxxlgxDEH52yq/NgdOnNeW/tG3OkXXiPSfsd3FNqUMEkN4kbBvKUMCgbHQ5aTjOenAzyeALXXvjJruozeJPEd9/Zdn5bTWdvKY1kZtwRVUfKoAVsnGT9SSJP2gfD+keHrXwtbaRptrZRbblWEMYUvtEIBY9WPXkknk0Ae6eFJW1XwHoct/8A6S93pkDT+b83mFolLbs9c5Oc18y/C/w3p+p/GFNOvIEnsrSWeTyZRlX2ZCg+uDg4PBxzX0v4E/5J54Z/7BVr/wCilr5/+D5H/C8rvkc/a8e/JoA+j9e0a28Q6Bf6RdqrQXcLREsgbaSOGAPcHBHoQK+f/wBmu8nTxJrVkH/0eW0WVlx1ZXAU/k7fn7V9I18z/s3H/is9WH/UPP8A6MSgD1EfCS2f4qN42uNWluB5vnJZSRfdcIFX95u6KRkDHGAM8c4H7R0unnwbp8Mk0A1Fb5XhjJHmmMo4YgdduduT0yF9q5M+K/F/xL+KUvh7T9eutH0yO4lCfZG8pkiTgklSCzHA4JIBPGBW18YvBWgeFPhlEdNsl+1vfxCW9nPmXEp2MCWkPPO0HAwuegFAHTfDnX4/D37P1nrd3mVbK3uXCs5G8rNIETODjJ2qOOM1w/wS01/G3jbWPF/iGT7dd2ZjMXmrkCVycOOcDYEwoxgbgRgqK6TwtpE2u/svf2fbh2nktbp4kjTczulxI4UDuWKgfjWL+zTqcQOv6U8gEp8q5jTuyjcrn8CU/OgD23xFoVr4l8PX2jXozBdxFCcZ2nqrD3DAEe4r5z/ZyBX4iagrAgjSpAQe372Kvp+vmP8AZ3lM3xK1SUjBfTJWIHbM0RoA9Wl+E9vdfFb/AITe71Z51EiypZNABtdYwq/OGGQCAQNvYZzznC/aO+xHwRpwlaIXovwYAcbyuxt+O+3lc9s7c9q5W58YeMPiN8T7jwtpGvSaTpSXUipJaAxssURYbyww5LAfdyBkjgYzWn8YvBGi+GPhyLm1iludRlv4xPqN7IZrmXKuTuc9O3AwDgcUAdl8Crya7+Fdgkpz9nmmhQ5JO3eWGc+m7H0Aoqv8Af8Akl8H/X3N/MUUAeiarpVjrel3Gm6lax3NncJslikHDDr+BBwQRyCARyK8U1/wRqXwmt5dZ8IeKbu2tbqZIXsp7dJgcgnJJ4P3cA7c4PX1KKAOg8H6/wCNfHmnXKLr2n6S1o8Yaa30vzJJAQc/fkKDp/d/Ku20TwVo2haRe6dFFJdDUN3264u38ya7LAgmR+/BPTA5PqaKKAPMJPBV78J/EI1DwvrjfY79WV7G9t/NTCgY3FXXcQWJBABHTJyc7Hiv4Kv4yuH1LVvFNy2rE7VkS1UW8UQzhEi3bh16lz3zRRQBd8D2fiq78IQ2sPiW2tk0+I2VsV0wMThVCtJl/m2qcALt5wW3DIOB4d+A2oeF/ENprmneMU+2Wzll83S9ysCCGDDzehBI7Hngg80UUAeqa7p+q6noMtjp+rJpt5MmxrxbcuUBGCUXeNp9Dk4+vNea+DPgpqHgjxFFrGneLY3cI0UsMmmnbLGeqnE2eoBHuB16UUUAZXjfwN/wr/xHF488Nam1vNJeEPZTQB4y0gcuAQRhCONuMjOQw4xs3fhDUvjB4Vs9Q1nX/scLKzW1nZWuIo5Q5UySbnJkOAQOVxnjvkooAo/Cwa9peqX3giDWIDYaVdSS+c9oTK6LMA0a5fagY5OcMRubHOCJvF3w8i8GapcfEDwrf/2dPa/vJLBoPMhl3MFZR8w2qdxyOcdtuBgooAb4V+IepfF1Lnw7HFHoafZc3tzCfOklQlVdYs4ERIZhuO/GeORmuC+F2iaho/xgvNP0zVY4nsp7myd5bYuk6IWB3KHUjJUEc8EDrjBKKAOj+IfhB/hjrf8AwsTw7qISR77H2CWANHmQMXG4MPkPI24yM8EYFa8Wial8c/CkWoarrA0y3ici3s7S33IsoAzJIWbL/KzAAbcZ69clFAGR8EdV1oX974Otby2is7GX7a87WxeSRd6Bol+cBQ3qQxGTjsQUUUAf/9k=" border="0" height="20" width="83"></p>
<br></td>
<td>
<p style="text-align: center;"><a href="http://www.diplomatie.gouv.fr/es/" target="_blank"></a></p>
<p style="text-align: center;"><a href="http://www.diplomatie.gouv.fr/es/" target="_blank"><img src="joomla/CONVOCATORIA_files/logo_maee.jpg" border="0" height="60" width="60"></a></p>
</td>
<td><a href="http://apoder.org.pe/webapp/" target="_blank"></a>
<p style="text-align: center;"><a href="http://www.cg65.fr/" target="_blank"><img src="joomla/CONVOCATORIA_files/logo_cg65_noir_5x3%25202011.jpg" border="0" height="70" width="113"></a></p>
</td>
</tr>
</tbody>
</table>		</div>
	
            </div>
			<div id="pie">
			Red de Municipalidades Urbanas y Rurales del Perú. REMURPE<br>
			Calle Mariano Carranza 527 - Santa Beatriz, Lima<br>
			Tel: 265 4596 |  RPM #975-365283 <br>
			correo electrónico <a href="mailto:remurpe@remurpe.org.pe">remurpe@remurpe.org.pe</a><br>
			
			</div>
		</div>

    </div>
	
        <script src="js/respond.min.js"></script>
        <script src="js/prefixfree.min.js"></script>
        <script src="js/jquery.min.js"></script>
        <script src="js/scripts.js"></script>

</body></html>