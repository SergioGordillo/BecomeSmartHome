<?php


class Pedido{
    private $id_pedido;
    private $id_usuario;
	private $direccion;
	private $id_localidad;
	private $coste;
    private $estado;
    private $agencia_transporte;
    private $fecha;

	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getIdPedido() {
		return $this->id_pedido;
	}

	function getIdUsuario() {
		return $this->id_usuario;
	}

	function getDireccion() {
		return $this->direccion;
	}

	function getIdLocalidad() {
		return $this->id_localidad;
	}

	function getCoste() {
		return $this->coste;
	}

	function getEstado() {
		return $this->estado;
	}

	function getAgenciaTransporte() {
		return $this->agencia_transporte;
	}

	function getFecha() {
		return $this->fecha;
	}

	function setIdPedido($id_pedido) {
		$this->id_pedido = $id_pedido;
	}
	
	function setIdUsuario($id_usuario) {
		$this->id_usuario = $id_usuario;
    }

	function setDireccion($direccion) {
		$this->direccion = $this->db->real_escape_string($direccion);
	}

	function setIdLocalidad($id_localidad) {
		$this->id_localidad = $id_localidad;
    }

	function setCoste($coste) {
		$this->coste = $coste;
	}

	function setEstado($estado) {
		$this->estado = $this->db->real_escape_string($estado);
	}

	function setAgenciaTransporte($agencia_transporte) {
		$this->agencia_transporte = $this->db->real_escape_string($agencia_transporte);
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}


	public function getAll(){ //ME DEVUELVE TODOS LOS PEDIDOS
		$pedidos = $this->db->query("SELECT * FROM pedido ORDER BY id_pedido DESC");
		return $pedidos;
	}
	
	public function getOne(){ //ME DEVUELVE UN PEDIDO POR IDPEDIDO
		$pedido = $this->db->query("SELECT * FROM pedido WHERE id_pedido = {$this->getIdPedido()}");
		return $pedido->fetch_object();
	}
	
	public function getOneByUser(){ //ME DEVUELVE UN PEDIDO DE UN USUARIO
		$sql = "SELECT p.id_pedido, p.coste FROM pedido p "
				. "WHERE p.id_usuario = {$this->getIdUsuario()} ORDER BY id_pedido DESC LIMIT 1";
				
		$pedido = $this->db->query($sql);
			
		return $pedido->fetch_object();
	}
	
	public function getAllByUser(){  //ME DEVUELVE TODOS LOS PEDIDOS REALIZADOS POR UN USUARIO
		$sql = "SELECT p.* FROM pedido p "
				. "WHERE p.id_usuario = {$this->getIdUsuario()} ORDER BY id_pedido DESC";
			

				
		$pedidos = $this->db->query($sql);
			
		return $pedidos;
	}
	
	
	public function getProductosByPedido($id_pedido){ //ME DEVUELVE TODOS LOS PRODUCTOS DE UN PEDIDO DETERMINADO
	
		$sql = "SELECT pr.*, pp.unidades FROM producto pr "
				. "INNER JOIN productopedido pp ON pr.id_producto = pp.id_producto "
				. "WHERE pp.id_pedido={$id_pedido}";
				
		$productos = $this->db->query($sql);
			
		return $productos;
	}
	
	public function save(){ //CREA UN PEDIDO
	  
		$sql = "INSERT INTO pedido VALUES(NULL, {$this->getIdUsuario()}, '{$this->getDireccion()}', '{$this->getIdLocalidad()}', {$this->getCoste()}, 'confirm', '{$this->getAgenciaTransporte()}', CURDATE());";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function save_linea(){ //AQUÍ YA TENGO LA INFORMACIÓN DE PRODUCTO_PEDIDO
		$sql = "SELECT LAST_INSERT_ID() as 'pedido';";
		$query = $this->db->query($sql);
		$id_pedido = $query->fetch_object()->pedido;
		
		foreach($_SESSION['carrito'] as $elemento){
			$producto = $elemento['producto'];
			
			$insert = "INSERT INTO productopedido VALUES(NULL, {$id_pedido}, {$producto->id_producto}, {$elemento['unidades']})";
	
			$save = $this->db->query($insert);
			
		}
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function edit(){ //ACTUALIZACIÓN DE ESTADO DE UN DETERMINADO PEDIDO
		$sql = "UPDATE pedido SET estado='{$this->getEstado()}' ";
		$sql .= " WHERE id_pedido={$this->getIdPedido()};";
		
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	

}