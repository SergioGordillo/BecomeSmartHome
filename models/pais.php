<?php

class Pais{

    private $id_pais;
    private $nombre;

    private $db;

    public function __construct() {
		$this->db = Database::connect();
    }
    
    function getIdPais() {
		return $this->id_pais;
	}

	function getNombre() {
		return $this->nombre;
    }

    function setIdPais($id_pais) {
		$this->id_pais = $this->db->$id_pais;
    }
    
    function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}
}





?>