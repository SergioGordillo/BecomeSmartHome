<?php

class Localidad{

    private $id_localidad;
    private $id_provincia;
    private $nombre;

    private $db;

    public function __construct() {
		$this->db = Database::connect();
    }

    function getIdLocalidad() {
		return $this->id_localidad;
    }

    function getIdProvincia() {
		return $this->id_provincia;
    }

    function setIdLocalidad($id_localidad) {
		$this->id_localidad = $this->db->$id_localidad;
    }
    
    function setIdProvincia($id_provincia) {
		$this->id_provincia = $this->db->$id_provincia;
	}

    function getNombre(){
        return $this->nombre;
    }

    function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}
}

?>