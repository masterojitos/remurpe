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
$especializaciones["POLITICAS PUBLICAS DESCENTRALIZADAS"] = array("GESTION DE POLITICAS PUBLICAS", "PLANEAMIENTO TERRITORIAL", "PLANEAMIENTO INSTITUCIONAL", "GESTION FINANCIERA", "GESTION ADMINISTRATIVA", "CONTRATACIONES Y ADQUISICIONES", "SERVICIOS PUBLICOS", "ADMINISTRACION TRIBUTARIA", "PROYECTOS DE PREINVERSION E INVERSION", "RECURSOS HUMANOS", "PARTICIPACION CIUDADANA", "CONFLICTOS Y CONTROVERSIAS", "ORDENAMIENTO JURIDICO MUNICIPAL", "ESTRUCTURA ORGANIZACIONAL", "SEGUIMIENTO, EVALUACION Y FISCALIZACION", "MANCOMUNIDADES / ASOCIATIVISMO");
$especializaciones["POLITICAS SOCIALES DESCENTRALIZADAS"] = array("EDUCACION", "SALUD", "PROGRAMAS ALIMENTARIOS", "SANIEAMIENTO", "DISCAPACIDAD", "EMPLEO TEMPORAL");
$especializaciones["GESTION DEL TERRITORIO Y AMBIENTAL"] = array("ORDENAMIENTO TERRITORIAL", "DESARRLLO ECONOMICO LOCAL", "ACONDICIONAMIENTO TERRITORIAL", "INFRAESTRUCTURA PARA EL TERRITORIO", "GESION AMBIENTAL", "GESTION INTEGRADA DE RECURSOS HIDRICOS", "ORDENAMIENTO URBANO", "CATASTRO URBANO");