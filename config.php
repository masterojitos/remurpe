<?php
require_once "includes/Connection.class.php";
$cn = Connection::getInstance();

require "includes/functions.php";

require "includes/ubigeo.php";

$aliados = array(
    array("Carlos López", "clopez@remurpe.org.pe", "Lima"), 
    array("Wilbert Rozas", "wilbertrozas@yahoo.es", "Cusco"), 
    array("Rómulo Antúnez", "rantunez@remurpe.org.pe", "Lima"), 
    array("Carlos Arana", "carana@remurpe.org.pe", "Lima"), 
    array("Mayra Asmat", "kasmat@remurpe.org.pe", "Lima"), 
    array("Federico Fernández", "ffernandez@remurpe.org.pe", "Lima"), 
    array("Marivel Ccala", "mccala@remurpe.org.pe", "Lima"), 
    array("Leonardo Montes", "lemontca@hotmail.com", "Huancavelica"), 
    array("Alex Rojas", "alexrojas40@gmail.com", "Piura"), 
    array("Cristina Chambizea", "xtinachr@hotmail.com", "Cajamarca"), 
    array("César Vigo", "vigoreli@hotmail.com", "Cajamarca"), 
    array("Genaro Sánchez", "gesara2004@yahoo.es", "San Martín"), 
    array("Fidel Rodríguez", "fidelrori@hotmail.com", "Ancash"), 
    array("Gianina Vargas", "janina22_6@hotmail.com", "Huanuco"), 
    array("Alicia Carrasco", "alicg2501@hotmail.com", "Ayacucho"), 
    array("Ernesto Vizacardo", "jesusevv@hotmail.com", "Cusco"), 
    array("Lourdes Betancur", "lubeth9@hotmail.com", "Puno"), 
    array("Flor Herrera", "fherrera@remurpe.org.pe", "Apurimac"), 
    array("Jorge Aparcana", "jaaparcana1@gmail.com", "Ica")
);

$profesiones = array();
$profesiones["Medicina Humana"] = array("Obstetricia", "Enfermería", "Tecnología Médica", "Laboratorio Clínico y Anatomía Patológica", "Terapia Física y Rehabilitación", "Radiología", "Terapia Ocupacional", "Nutrición", "Farmacia y Bioquímica", "Ciencias de los Alimentos", "Toxicología", "Odontología", "Medicina Veterinaria", "Psicología");
$profesiones["HUMANIDADES"] = array("Literatura", "Filosofía", "Lingüística", "Comunicación Social", "Periodismo", "Arte", "Bibliotecología y Ciencias de la Información", "Danza", "Conservación y Restauración", "Educación", "Educación Inicial", "Educación Primaria", "Educación Secundaría", "Educación Física");
$profesiones["CIENCIAS SOCIALES"] = array("Derecho", "Ciencia Política", "Historia", "Sociología", "Antropología", "Arqueología", "Trabajo Social", "Geografía", "Politología");
$profesiones["CIENCIAS BÁSICAS"] = array("Química", "Ciencias Biológicas", "Genética y Biotecnología", "Microbiología y Parasitología", "Física", "Matemática", "Estadística", "Investigación Operativa", "Computación Científica");
$profesiones["INGENIERÍAS"] = array("Ingeniería Química", "Ingeniería Agroindustrial", "Ingeniería Mecánica de Fluidos", "Ingeniería Mecatrónica", "Ingeniería Geológica", "Ingeniería Geográfica", "Ingeniería de Minas", "Ingeniería Metalúrgica", "Ingeniería Civil", "Ingeniería Industrial", "Ingeniería Textil y Confecciones", "Ingeniería Electrónica", "Ingeniería Eléctrica", "Ingeniería de Telecomunicaciones", "Ingeniería de Sistemas", "Ingeniería de Software", "Ingeniería Sanitaria y Ambiental", "Ingeniería Naval", "Ingeniería Económica");
$profesiones["ECONÓMICO-EMPRESARIALES"] = array("Administración", "Administración de Turismo", "Administración de Negocios Internacionales", "Contabilidad", "Gestión Tributaria", "Auditoria Empresarial y del Sector Público", "Economía", "Economía Pública", "Economía Internacional", "Economía y Gestión Ambiental", "Arquitectura");

$letras = array("A", "B", "C");
$especializaciones = array();
$especializaciones["POLÍTICAS PÚBLICAS DESCENTRALIZADAS"] = array("diseño de políticas públicas", "planeamiento territorial e institucional", "gestión financiera y presupuestal", "contrataciones y adquisiciones", "servicios públicos", "administración tributaria", "proyectos de preinversión e inversión", "recursos humanos", "participación ciudadana", "soporte jurídico municipal");
$especializaciones["POLÍTICAS SOCIALES DESCENTRALIZADAS"] = array("educación rural", "programas alimentarios y sociales", "saneamiento básico", "discapacidad e inclusión", "generación de empleo", "jóvenes y género");
$especializaciones["GESTIÓN DEL TERRITORIO Y RECURSOS NATURALES"] = array("ordenamiento territorial", "desarrollo económico territorial", "gestión de obras", "gestión ambiental y residuos sólidos", "gestión integrada de recursos hídricos", "catastro y desarrollo urbano", "mancomunidades / asociativismo");