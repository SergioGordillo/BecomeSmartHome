<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController{
	
	public function index(){ //SI EL USUARIO ES ADMINISTRADOR, ME DEVUELVE TODAS LAS CATEGORÍAS
		Utils::isAdmin();
		$categoria = new Categoria();
		$categorias = $categoria->getAll();
		
		require_once 'views/categoria/index.php';
	}
	
	public function ver(){ //SACA TODOS LOS PRODUCTOS DE UNA DETERMINADA CATEGORÍA
		if(isset($_GET['id_categoria'])){ //SI TENEMOS EL PARÁMETRO POR GET LO RECOGEMOS
			$id_categoria = $_GET['id_categoria'];
			
			// CREO LA CLASE, LE PASO EL PARÁMETRO Y LLAMO AL MÉTODO
			$categoria = new Categoria();
			$categoria->setIdCategoria($id_categoria); 
			$categoria = $categoria->getOne();
			
			
			// CREO UNA CLASE PRODUCTO, LE PASO ID CATEGORÍA Y LLAMO A TODOS LOS PRODUCTOS DE UNA DETERMINADA CATEGORÍA
			$producto = new Producto();
			$producto->setIdCategoria($id_categoria);
			$productos = $producto->getAllCategory();
		}
		
		require_once 'views/categoria/ver.php';
	}

	public function ver_ofertas(){ //SACA TODOS LOS PRODUCTOS DE UNA DETERMINADA CATEGORÍA
		
		$categoria = new Categoria();
		$categoria->setNombre("OFERTAS"); 
		// CREO UNA CLASE PRODUCTO, LE PASO ID CATEGORÍA Y LLAMO A TODOS LOS PRODUCTOS DE UNA DETERMINADA CATEGORÍA
		$producto = new Producto();
		$productos = $producto->getAllOferta();
		
		require_once 'views/categoria/ver.php';
	}
	public function ver_populares(){ //SACA TODOS LOS PRODUCTOS DE UNA DETERMINADA CATEGORÍA
		
		
		$categoria = new Categoria();
		$categoria->setNombre("POPULARES");
		// CREO UNA CLASE PRODUCTO, LE PASO ID CATEGORÍA Y LLAMO A TODOS LOS PRODUCTOS DE UNA DETERMINADA CATEGORÍA
		$producto = new Producto();
		$productos = $producto->getAllPopulares();
		
		require_once 'views/categoria/ver.php';
	}

	
	public function crear(){ //FUNCIÓN QUE ME LLEVA A LA VISTA PARA CREAR UNA CATEGORÍA, SI EL USUARIO ES ADMINISTRADOR
		Utils::isAdmin();
		require_once 'views/categoria/crear.php';
	}
	
	public function save(){ //FUNCIÓN QUE ME PERMITE CREAR UNA CATEGORÍA
		Utils::isAdmin(); //COMPRUEBO SI EL USUARIO ES ADMINISTRADOR
		//CREO UNA NUEVA CATEGORÍA Y LA GUARDO EN LA BBDD
	    if(isset($_POST) && isset($_POST['nombre']) && isset($_POST['descripcion'])){
			$categoria = new Categoria();
			$categoria->setNombre($_POST['nombre']);
			$categoria->setDescripcion($_POST['descripcion']);
			$save = $categoria->save();
		}
		header("Location:".base_url."categoria/index");
	}


}