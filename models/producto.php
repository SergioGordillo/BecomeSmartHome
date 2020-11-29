<?php

class Producto{

    private $id_producto;
    private $id_categoria;
	private $nombre;
	private $descripcion;
	private $imagen;
	private $precio;
    private $oferta;
    private $stock;
    private $popular;
    private $fecha;

	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getId_producto() {
		return $this->id_producto;
	}

	function getId_categoria() {
		return $this->id_categoria;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getDescripcion() {
		return $this->descripcion;
	}

	function getPrecio() {
		return $this->precio;
	}

	function getStock() {
		return $this->stock;
	}

	function getOferta() {
		return $this->oferta;
	}


	function getImagen() {
		return $this->imagen;
	}

	function getFecha() {
		return $this->fecha;
	}

	
	function getPopular() {
		return $this->popular;
	}

	function setIdProducto($id_producto) {
		$this->id_producto = $id_producto;
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

	function setPrecio($precio) {
		$this->precio = $this->db->real_escape_string($precio);
	}

	function setStock($stock) {
		$this->stock = $this->db->real_escape_string($stock);
	}

	function setOferta($oferta) {
		$this->oferta = $this->db->real_escape_string($oferta);
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	function setPopular($popular) {
		$this->popular = $popular;
	}

	public function getAllOferta(){ //SELECCIONA TODOS LOS PRODUCTOS ORDENADOS POR ID PRODUCTO
		$productos = $this->db->query("SELECT * FROM producto WHERE oferta = 1 ORDER BY id_producto DESC");
		return $productos;
	}
	
	public function getAllPopulares(){ //SELECCIONA TODOS LOS PRODUCTOS ORDENADOS POR ID PRODUCTO
		$productos = $this->db->query("SELECT * FROM producto WHERE popular = 1 ORDER BY id_producto DESC");
		return $productos;
	}

	public function getAll(){ //SELECCIONA TODOS LOS PRODUCTOS ORDENADOS POR ID PRODUCTO
		$productos = $this->db->query("SELECT * FROM producto ORDER BY id_producto DESC");
		return $productos;
	}
	
	public function getAllCategory(){ //ESTE MÉTODO DEVUELVE TODOS LOS PRODUCTOS DE UNA DETERMINADA CATEGORÍA
		$sql = "SELECT p.*, c.nombre AS 'catnombre' FROM producto p "
				. "INNER JOIN categoria c ON c.id_categoria = p.id_categoria "
				. "WHERE p.id_categoria = {$this->getId_categoria()} "
				. "ORDER BY id_producto DESC";


		$productos = $this->db->query($sql);
		return $productos;
	}
	
	public function getRandom($limit){ //DEVUELVE TODOS LOS PRODUCTOS ORDENADOS DE FORMA ALEATORIA
		$productos = $this->db->query("SELECT * FROM producto ORDER BY RAND() LIMIT $limit");
		return $productos;
	}
	
	public function getOne(){ //DEVUELVE UN PRODUCTO QUE TIENE UN DETERMINADO ID PRODUCTO
		$producto = $this->db->query("SELECT * FROM producto WHERE id_producto = {$this->getId_producto()}");
		return $producto->fetch_object();
	}
	
	public function save(){ //CREAR UN PRODUCTO
		$sql = "INSERT INTO producto VALUES(NULL, {$this->getId_categoria()}, '{$this->getNombre()}', '{$this->getDescripcion()}', '{$this->getImagen()}', {$this->getPrecio()}, {$this->getOferta()}, {$this->getStock()}, {$this->getPopular()}, CURDATE());";
		$save = $this->db->query($sql);


		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function edit(){ //EDITO LOS PRODUCTOS
		$sql = "UPDATE producto SET nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, oferta={$this->getOferta()}, stock={$this->getStock()}, popular={$this->getPopular()}, id_categoria={$this->getId_categoria()}  ";
		
		if($this->getImagen() != null){
			$sql .= ", imagen='{$this->getImagen()}'";
		}
		
		$sql .= " WHERE id_producto={$this->id_producto};";
		
		
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function delete(){ //ELIMINAR PRODUCTO
		$sql = "DELETE FROM producto WHERE id_producto={$this->id_producto}";
		$delete = $this->db->query($sql);
		

		$result = false;
		if($delete){
			$result = true;
		}
		return $result;
	}

	public function buscar($buscar){ //LA FUNCIÓN DE FILTRAR PRODUCTOS

		$productos = $this->db->query("SELECT * FROM producto WHERE nombre LIKE '%{$buscar}%' ORDER BY id_producto DESC");

		return $productos;

	}
	
}