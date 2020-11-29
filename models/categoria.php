<?php

class Categoria{
	private $id_categoria;
	private $nombre;
	private $descripcion;

	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getIdCategoria() {
		return $this->id_categoria;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getDescripcion() {
		return $this->descripcion;
	}

	function setIdCategoria($id_categoria) {
		$this->id_categoria = $id_categoria;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setDescripcion($descripcion) {
		$this->descripcion = $this->db->real_escape_string($descripcion);
	}

	public function getAll(){ //ME DEVUELVE TODAS LAS CATEGORÍAS
		$categorias = $this->db->query("SELECT * FROM categoria ORDER BY id_categoria DESC;");
		return $categorias;
	}
	
	public function getOne(){ //ME DEVUELVE UNA CATEGORÍA SEGÚN SU ID
		$categoria = $this->db->query("SELECT * FROM categoria WHERE id_categoria={$this->getIdCategoria()}");

		return $categoria->fetch_object();

	}
	
	public function save(){ //CREA UNA NUEVA CATEGORÍA
		$sql = "INSERT INTO categoria VALUES(NULL, '{$this->getNombre()}', '{$this->getDescripcion()}');";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	
}