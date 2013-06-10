<?php
require_once "../config.php";
session_start();
include isset($_SESSION['mo_login']) ? "control_panel.php" : "login.php";