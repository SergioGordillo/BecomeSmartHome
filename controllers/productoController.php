<?php
require_once 'models/producto.php';

class productoController{ 
	
	public function index(){ //RENDERIZO LA PANTALLA GENERAL DE PRODUCTOS
		$producto = new Producto();
		$productos = $producto->getRandom(6); 
	
		// renderizar vista
		require_once 'views/producto/destacados.php';
	}
	
	public function ver(){ //CON ESTO VEO EL DETALLE DE UN PRODUCTO
		if(isset($_GET['id_producto'])){
			$id_producto = $_GET['id_producto'];
		
			$producto = new Producto();
			$producto->setIdProducto($id_producto); 
			
			$product = $producto->getOne();
			
		}
		require_once 'views/producto/ver.php';
	}
	
	public function gestion(){ //ME LISTA TODOS LOS PRODUCTOS
		Utils::isAdmin(); //COMPRUEBO SI EL USUARIO ES ADMINISTRADOR
		
		$producto = new Producto();
		$productos = $producto->getAll();
		
		require_once 'views/producto/gestion.php';
	}
	
	public function crear(){ //ME RENDERIZA LA VISTA DE CREAR PRODUCTOS
		Utils::isAdmin(); //CHECKEO SI EL USUARIO ES ADMINISTRADOR
		require_once 'views/producto/crear.php'; //RENDERIZO LA VISTA
	}
	
	public function save(){ //CREO PRODUCTOS
		Utils::isAdmin(); //CHECKEO SI EL USUARIO ES ADMINISTRADOR
		if(isset($_POST)){
			$categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false; 
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
			$imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
			$precio = isset($_POST['precio']) ? $_POST['precio'] : false;
			$oferta = $_POST['oferta'];
			$stock = isset($_POST['stock']) ? $_POST['stock'] : false;
			$popular = $_POST['popular'];
	
			if($categoria && $nombre && $descripcion && $precio && $stock){
				$producto = new Producto();
				$producto->setIdCategoria($categoria);
				$producto->setNombre($nombre);
				$producto->setDescripcion($descripcion);
				$producto->setPrecio($precio);
				$producto->setOferta($oferta);
				$producto->setStock($stock);
				$producto->setPopular($popular);
				
				// GUARDO LA IMAGEN SI ESTÁ SETEADA
				if(isset($_FILES['imagen'])){
					$file = $_FILES['imagen'];
					$filename = $file['name'];
					$mimetype = $file['type'];

					if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){ //COMPRUEBO QUE SEA DE UN DETERMINADO TIPO IMAGEN

						if(!is_dir('uploads/images')){ //SI NO EXISTE UN DIRECTORIO DE IMÁGENES LO CREO
							mkdir('uploads/images', 0777, true);
						}

						$producto->setImagen($filename); 
						move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
					}
				}
				
				if(isset($_GET['id_producto'])){
					$id_producto = $_GET['id_producto'];
					$producto->setIdProducto($id_producto);
					
					$save = $producto->edit(); //ACTUALIZO PRODUCTO
				}else{
					$save = $producto->save(); //CREO PRODUCTO
				}

				if($save){ //GENERO SESIÓN INFORMANDO DE SI EL PRODUCTO SE HA CREADO DE FORMA CORRECTA O NO
					if(isset($_GET['id_producto'])){
						$_SESSION['producto_edit'] = "complete";
					}else{
						$_SESSION['producto'] = "complete";
					}
				}else{
					if(isset($_GET['id_producto'])){
						$_SESSION['producto_edit'] = "failed";
					}else{
						$_SESSION['producto'] = "failed";
					}
				}
			}else{
				$_SESSION['producto'] = "failed";
			}
		}else{
			$_SESSION['producto'] = "failed";
		}
		header('Location:'.base_url.'producto/gestion');
	}
	
	public function editar(){
		Utils::isAdmin(); //CHECKEO SI EL USUARIO ES ADMINISTRADOR
		if(isset($_GET['id_producto'])){ //RECOJO EL ID DEL PRODUCTO SI ESTÁ SETEADO
			$id_producto = $_GET['id_producto'];
			$edit = true;
			
			$producto = new Producto();
			$producto->setIdProducto($id_producto);
			
			$pro = $producto->getOne();


			
			require_once 'views/producto/crear.php'; //RENDERIZO LA VISTA
			
		}else{
			header('Location:'.base_url.'producto/gestion');
		}
	}
	
	public function eliminar(){ //ME PERMITE ELIMINAR PRODUCTOS
		Utils::isAdmin(); //CHECKEO SI EL USUARIO ES ADMINISTRADOR
		
		if(isset($_GET['id_producto'])){ //RECOJO EL ID DEL PRODUCTO SI ESTÁ SETEADO
			$id_producto = $_GET['id_producto'];
			$producto = new Producto();
			$producto->setIdProducto($id_producto);
			
			$delete = $producto->delete(); //BORRO EL PRODUCTO Y CREO SESIÓN CON EL VALOR CORRESPONDIENTE DE LA ACCIÓN DE BORRADO
			if($delete){
				$_SESSION['delete'] = 'complete';
			}else{
				$_SESSION['delete'] = 'failed';
			}
		}else{
			$_SESSION['delete'] = 'failed';
		}
		
		header('Location:'.base_url.'producto/gestion');
	}

	
	function buscar(){

		if(isset($_POST['search'])){
			$buscar = $_POST['search'];
		
			$producto = new Producto();
			
			$productos = $producto->buscar($buscar); 
		}
		require_once 'views/producto/buscar.php';

	}
	
}