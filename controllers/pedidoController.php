<?php
require_once 'models/pedido.php';

class pedidoController{ 
	
	public function hacer(){ //RENDERIZO LA VISTA PARA HACER EL PEDIDO
		
		$listaPaises = Utils::listarPaises();

		require_once 'views/pedido/hacer.php';
	}
	
	public function add(){ //CREO UN PEDIDO
		if(isset($_SESSION['identity'])){ //COMPRUEBO QUE EL USUARIO ESTÁ SETEADO
			$id_usuario = $_SESSION['identity']->id_usuario;

			//RECOJO LO ENVIADO POR EL FORMULARIO DEL PEDIDO, 
			$agencia_transporte = isset($_POST['agencia_transporte']) ? $_POST['agencia_transporte'] : false;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
			$id_localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
		
			$stats = Utils::statsCarrito(); 
			$coste = $stats['total']; //TE SACO EL PRECIO TOTAL
				
			if($direccion && $id_localidad){
				//CREO EL PEDIDO Y LO GUARDO EN LA BBDD
				$pedido = new Pedido();
				$pedido->setIdUsuario($id_usuario); 
				$pedido->setDireccion($direccion);
				$pedido->setIdLocalidad($id_localidad);
				$pedido->setCoste($coste);
				$pedido->setAgenciaTransporte($agencia_transporte); 
				$pedido->setFecha(date('Y-m-d')); 

				//ME CREO EL PEDIDO
				$save = $pedido->save();
				
				//CON ESTO CREO EL PRODUCTOPEDIDO
				$save_linea = $pedido->save_linea();
				
				if($save && $save_linea){ //SI EL PEDIDO ESTÁ CREADO Y PEDIDO, CREO UNA SESIÓN Y SI NO OTRA
					$_SESSION['pedido'] = "complete";
				}else{
					$_SESSION['pedido'] = "failed";
				}
				
			}else{
				$_SESSION['pedido'] = "failed";
			}
			
			header("Location:".base_url.'pedido/confirmado');			
		}else{
			// REDIRIJO AL INDEX
			header("Location:".base_url);
		}
	}
	
	public function confirmado(){ //CON ESTO RENDERIZO LA VISTA DE CONFIRMACIÓN DEL PEDIDO
		if(isset($_SESSION['identity'])){
			$identity = $_SESSION['identity'];
			$pedido = new Pedido();
			$pedido->setIdUsuario($identity->id_usuario);
			
			$pedido = $pedido->getOneByUser(); //SACO EL PEDIDO DE UN USUARIO
			
			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductosByPedido($pedido->id_pedido); //SACO TODOS LOS PRODUCTOS DE ESE PEDIDO
		}
		require_once 'views/pedido/confirmado.php';
	}
	
	public function mis_pedidos(){ //CONSULTO TODOS LOS PEDIDOS DE UN USUARIO
		Utils::isIdentity(); //SI EL USUARIO ESTÁ IDENTIFICADO
		$id_usuario = $_SESSION['identity']->id_usuario;
		$pedido = new Pedido();
		
		//SACO TODOS LOS PEDIDOS DEL USUARIO Y RENDERIZO LA VISTA
		$pedido->setIdUsuario($id_usuario);
		$pedidos = $pedido->getAllByUser();
		
		require_once 'views/pedido/mis_pedidos.php';
	}
	
	public function detalle(){ //CON ESTA FUNCIÓN PUEDO VER LOS PRODUCTOS DE LOS PEDIDOS DEL USUARIO
		Utils::isIdentity(); //IDENTIFICO QUE EL USUARIO ESTÉ IDENTIFICADO
		
		if(isset($_GET['id_pedido'])){ 
			$id_pedido = $_GET['id_pedido'];
			
			// COJO EL PEDIDO QUE EL USUARIO SOLICITA
			$pedido = new Pedido();
			
			$pedido->setIdPedido($id_pedido);
			$pedido = $pedido->getOne(); 
			
			// SACO LOS PRODUCTOS DE UN DETERMINADO PEDIDO Y RENDERIZO LA VISTA
			$pedido_productos = new Pedido();
			
			$productos = $pedido_productos->getProductosByPedido($id_pedido);
			
			require_once 'views/pedido/detalle.php';
		}else{
			header('Location:'.base_url.'pedido/gestion');
		}
	}
	
	public function gestion(){ //FUNCIÓN QUE ME PERMITE GESTIONAR LOS PEDIDOS DE TODOS LOS USUARIOS
		Utils::isAdmin(); //COMPRUEBO QUE EL USUARIO ES ADMIN
		$gestion = true;
		
		//ME DEVUELVE TODOS LOS PEDIDOS Y RENDERIZO LA VISTA
		$pedido = new Pedido();
		$pedidos = $pedido->getAll(); 
		
		require_once 'views/pedido/mis_pedidos.php';
	}

	
	
	public function estado(){
		Utils::isAdmin();
		if(isset($_POST['id_pedido']) && isset($_POST['estado'])){
			// RECOJO LOS DATOS DEL FORM
			$id_pedido = $_POST['id_pedido'];
			$estado = $_POST['estado'];
			
			//UPDATEO EL PEDIDO
			$pedido = new Pedido();
			$pedido->setIdPedido($id_pedido);
			$pedido->setEstado($estado);
			$pedido->edit();
			
			header("Location:".base_url.'pedido/detalle&id='.$id_pedido);
		}else{
			header("Location:".base_url);
		}
	}
	
	
}