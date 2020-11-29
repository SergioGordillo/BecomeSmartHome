<?php
require_once 'models/producto.php';

class carritoController{
	
	public function index(){ //CON ESTO MUESTRO EL CARRITO
		if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1){
			$carrito = $_SESSION['carrito'];
		}else{
			$carrito = array();
		}
		require_once 'views/carrito/index.php';
	}
	
	public function add(){ //AÑADE AL CARRITO UN PRODUCTO Y SI YA EXISTE LE METE MÁS UNIDADES
		if(isset($_GET['id_producto'])){ //SI ME LLEGA ID_PRODUCTO, LO RECOJO
			$id_producto = $_GET['id_producto'];
		}else{
			header('Location:'.base_url);
		}
		
		if(isset($_SESSION['carrito'])){ //CON ESTO AÑADO UNA UNIDAD MÁS A UN DETERMINADO PRODUCTO DEL CARRITO
			$counter = 0;
			foreach($_SESSION['carrito'] as $indice => $elemento){
				if($elemento['id_producto'] == $id_producto){
					$_SESSION['carrito'][$indice]['unidades']++;
					$counter++;
				}
			}	
		}
		
		if(!isset($counter) || $counter == 0){ //SI NO EXISTE EL PRODUCTO EN EL CARRITO, LO CREO
			// Conseguir producto
			$producto = new Producto();
			$producto->setIdProducto($id_producto); 
			$producto = $producto->getOne();

			// Añadir al carrito
			if(is_object($producto)){
				$_SESSION['carrito'][] = array(
					"id_producto" => $producto->id_producto,
					"precio" => $producto->precio,
					"unidades" => 1,
					"producto" => $producto //DE ESTA FORMA TENGO EL PRODUCTO EN LA SESIÓN YA
				);
			}
		}
		
		header("Location:".base_url."carrito/index");
	}
	
	public function delete(){ //ME BORRA UN DETERMINADO PRODUCTO DEL CARRITO
		if(isset($_GET['index'])){
			$index = $_GET['index'];
			unset($_SESSION['carrito'][$index]);
		}
		header("Location:".base_url."carrito/index");
	}
	
	public function up(){ //FUNCIÓN QUE ME AUMENTA UNA UNIDAD DE UN DETERMINADO PRODUCTO DEL CARRITO
		if(isset($_GET['index'])){
			$index = $_GET['index'];
			$_SESSION['carrito'][$index]['unidades']++;
		}
		header("Location:".base_url."carrito/index");
	}
	
	public function down(){ 
		//FUNCIÓN QUE ME ELIMINA UN DETERMINADO PRODUCTO DEL CARRITO
		if(isset($_GET['index'])){
			$index = $_GET['index'];
			$_SESSION['carrito'][$index]['unidades']--;
			
			if($_SESSION['carrito'][$index]['unidades'] == 0){
				unset($_SESSION['carrito'][$index]);
			}
		}
		header("Location:".base_url."carrito/index");
	}
	
	public function delete_all(){ //BORRA TODOS LOS PRODUCTOS DEL CARRITO
		unset($_SESSION['carrito']);
		header("Location:".base_url."carrito/index");
	}
	
}