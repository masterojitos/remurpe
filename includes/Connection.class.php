<?php
/**
 * MySQL Connection with Singleton Design Pattern
 *
 * @author Ricardo Garcia Rodriguez <master.ojitos@gmail.com>
 */
class Connection {

    static private $instance = NULL;
    public $Link = NULL;
    public $resultSet = NULL;

    private function __construct()
    {
        $this->Link = @mysql_pconnect("localhost", "root", "");
        if (!$this->Link) throw new Exception("No se pudo conectar con el servidor: " . $this->error());
        if (!mysql_select_db("remurpe", $this->Link)) throw new Exception("No se pudo conectar a la base de datos: " . $this->error());
        $this->query("SET NAMES utf8");
    }

    static public function getInstance()
    {
        if (self::$instance === NULL) self::$instance = new Connection();
        return self::$instance;
    }

    function error()
    {
        return mysql_error();
    }

    function scape($string)
    {
        return mysql_real_escape_string($string);
    }

    function query($query, $save = true)
    {
        $resultSet = mysql_query($query, $this->Link) or die("Invalid Query: " . $this->error());
        if ($save) $this->resultSet = $resultSet;
        return $resultSet;
    }

    function insert_id()
    {
        return mysql_insert_id($this->Link);
    }

    function fetch($resultSet = "")
    {
        if (empty($resultSet)) $resultSet = $this->resultSet;
        return mysql_fetch_array($resultSet);
    }

    function result($field)
    {
        if ($this->numrows()) return mysql_result($this->resultSet, 0, $field);
    }

    function numrows()
    {
        return mysql_num_rows($this->resultSet);
    }

    function getField($query)
    {
        $resultSet = $this->query($query, false);
        return ($row = $this->fetch($resultSet)) ? $row[0] : '';
    }

    function __destruct()
    {
        mysql_close($this->Link);
    }

}