<?php

class productoPedido{

    private $id_pedido;
    private $id_usuario;
	  private $id_producto;
    private $unidades;

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
    
    function getIdProducto() {
		return $this->id_producto;
    }
    
    function getUnidades(){
        return $this->unidades;
    }

    function setIdPedido($id_pedido) {
		$this->id_pedido = $this->db->$id_pedido;
    }
    
    function setIdUsuario($id_usuario) {
		$this->id_usuario = $this->db->$id_usuario;
	}

    function setIdProducto($id_producto) {
		$this->$id_producto = $this->db->$id_producto;
	}

    function setUnidades($unidades) {
		$this->unidades = $unidades;
	}


    

}





?>