<?php

class Utils{
	
	public static function deleteSession($nombre){ //CON ESTO BORRO SESIÓN
		if(isset($_SESSION[$nombre])){
			$_SESSION[$nombre] = null; 
			unset($_SESSION[$nombre]);
		}
		
		return $nombre;
	}
	
	public static function isAdmin(){ //ME COMPRUEBA SI EL USUARIO ES ADMINISTRADOR O NO
		if(!isset($_SESSION['admin'])){
			header("Location:".base_url);
		}else{
			return true;
		}
	}
	
	public static function isIdentity(){ //COMPRUEBO QUE UN USUARIO ESTÁ IDENTIFICADO
		if(!isset($_SESSION['identity'])){
			header("Location:".base_url);
		}else{
			return true;
		}
	}
	
	public static function showCategorias(){ //FUNCIÓN QUE TE DEVUELVE TODOS LOS OBJETOS DE TIPO CATEGORÍA
		require_once 'models/categoria.php';
		$categoria = new Categoria();
		$categorias = $categoria->getAll();
		return $categorias;
	}
	
	public static function statsCarrito(){ //ME DEVUELVE LAS ESTADÍSTICAS DEL CARRITO, ES DECIR, EL TOTAL DE PRODUCTOS Y EL PRECIO TOTAL
		$stats = array(
			'count' => 0,
			'total' => 0
		);
		
		if(isset($_SESSION['carrito'])){
			$stats['count'] = count($_SESSION['carrito']);
			
			foreach($_SESSION['carrito'] as $producto){
				$stats['total'] += $producto['precio']*$producto['unidades'];
			}
		}
		
		return $stats;
	}
	
	public static function showStatus($estado){  //FUNCIÓN QUE ME MUESTRA EL ESTADO DEL PEDIDO
		$value = 'Pendiente';
		
		if($estado == 'confirm'){
			$value = 'Pendiente';
		}elseif($estado == 'preparation'){
			$value = 'En preparación';
		}elseif($estado == 'ready'){
			$value = 'Preparado para enviar';
		}elseif($estado = 'sent'){
			$value = 'Enviado';
		}
		
		return $value;
	}

	
	public static function listarPaises(){ //PARA LISTAR PAÍSES
		
		$db = Database::connect();

		$sql = "SELECT * FROM pais";
		$result = $db->query($sql);
		
		return $result;
	}

	
	public static function listarProvincias($id_pais){ //PARA LISTAR PROVINCIAS
		 
		$db = Database::connect();

		

		$sql = "SELECT * FROM provincia where id_pais = " . $id_pais;
		
		$result = $db->query($sql);
		
		$data = array();
		
		while ($fila = $result->fetch_object()) {
			array_push($data, $fila);
		}

		return $data;
	}

	public function getLocalidad($id_localidad){ //COJO EL NOMBRE DE LA LOCALIDAD A PARTIR DEL ID
		
		$db = Database::connect();

		$sql = "SELECT nombre as localidad FROM localidad "
				. "WHERE id_localidad = {$id_localidad}";
		
		$registro = $db->query($sql)->fetch_row();
	
		return $registro[0];
	}
	
	public function getProvincia($id_localidad){ 


		$db = Database::connect();

		$sql = "SELECT p.nombre as provincia FROM provincia p, localidad l "
				. "WHERE p.id_provincia = l.id_provincia and l.id_localidad = {$id_localidad}";
		
		$registro = $db->query($sql)->fetch_row();
			
		return $registro[0];
		
	}
	
	public static function listarLocalidades($id_provincia){ //LISTO LOCALIDADES
		
		$db = Database::connect();

		$sql = "SELECT * FROM localidad WHERE id_provincia=" . $id_provincia;
		$result = $db->query($sql);
				
		$data = array();
		
		while ($fila = $result->fetch_object()) {
			array_push($data, $fila);
		}

		return $data;
	
	}
	
}
