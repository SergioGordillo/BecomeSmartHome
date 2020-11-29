<?php

class Provincia{

    private $id_pais;
    private $id_provincia;
    private $nombre;

    private $db;

    public function __construct() {
		$this->db = Database::connect();
    }

    function getIdPais() {
		return $this->id_pais;
    }

    function getIdProvincia() {
		return $this->id_provincia;
    }

    function getNombre(){
        return $this->nombre;
    }

    function setIdPais($id_pais) {
		$this->id_pais = $this->db->$id_pais;
    }

    function setIdProvincia($id_provincia) {
		$this->id_provincia = $this->db->$id_provincia;
    }

    function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}
}

?>