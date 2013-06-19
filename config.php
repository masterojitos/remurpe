<?php
require_once "includes/Connection.class.php";
$cn = Connection::getInstance();

require "includes/functions.php";

require "includes/ubigeo.php";

$profesiones = array();
$profesiones["Medicina Humana"] = array("Obstetricia", "Enfermería", "Tecnología Médica", "Laboratorio Clínico y Anatomía Patológica", "Terapia Física y Rehabilitación", "Radiología", "Terapia Ocupacional", "Nutrición", "Farmacia y Bioquímica", "Ciencias de los Alimentos", "Toxicología", "Odontología", "Medicina Veterinaria", "Psicología");
$profesiones["HUMANIDADES"] = array("Literatura", "Filosofía", "Lingüística", "Comunicación Social", "Periodismo", "Arte", "Bibliotecología y Ciencias de la Información", "Danza", "Conservación y Restauración", "Educación", "Educación Inicial", "Educación Primaria", "Educación Secundaría", "Educación Física");
$profesiones["CIENCIAS SOCIALES"] = array("Derecho", "Ciencia Política", "Historia", "Sociología", "Antropología", "Arqueología", "Trabajo Social", "Geografía", "Politología");
$profesiones["CIENCIAS BÁSICAS"] = array("Química", "Ciencias Biológicas", "Genética y Biotecnología", "Microbiología y Parasitología", "Física", "Matemática", "Estadística", "Investigación Operativa", "Computación Científica");
$profesiones["INGENIERÍAS"] = array("Ingeniería Química", "Ingeniería Agroindustrial", "Ingeniería Mecánica de Fluidos", "Ingeniería Mecatrónica", "Ingeniería Geológica", "Ingeniería Geográfica", "Ingeniería de Minas", "Ingeniería Metalúrgica", "Ingeniería Civil", "Ingeniería Industrial", "Ingeniería Textil y Confecciones", "Ingeniería Electrónica", "Ingeniería Eléctrica", "Ingeniería de Telecomunicaciones", "Ingeniería de Sistemas", "Ingeniería de Software", "Ingeniería Sanitaria y Ambiental", "Ingeniería Naval", "Ingeniería Económica");
$profesiones["ECONÓMICO-EMPRESARIALES"] = array("Administración", "Administración de Turismo", "Administración de Negocios Internacionales", "Contabilidad", "Gestión Tributaria", "Auditoria Empresarial y del Sector Público", "Economía", "Economía Pública", "Economía Internacional", "Economía y Gestión Ambiental", "Arquitectura");

$especializaciones = array();
$especializaciones["POLÍTICAS PÚBLICAS DESCENTRALIZADAS"] = array("diseño de políticas públicas", "planeamiento territorial e institucional", "gestión financiera y presupuestal", "contrataciones y adquisiciones", "servicios públicos", "administración tributaria", "proyectos de preinversión e inversión", "recursos humanos", "participación ciudadana", "soporte jurídico municipal");
$especializaciones["POLÍTICAS SOCIALES DESCENTRALIZADAS"] = array("educación rural", "programas alimentarios y sociales", "saneamiento básico", "discapacidad e inclusión", "generación de empleo", "jóvenes y género");
$especializaciones["GESTIÓN DEL TERRITORIO Y RECURSOS NATURALES"] = array("ordenamiento territorial", "desarrollo económico territorial", "gestión de obras", "gestión ambiental y residuos sólidos", "gestión integrada de recursos hídricos", "catastro y desarrollo urbano", "mancomunidades / asociativismo");