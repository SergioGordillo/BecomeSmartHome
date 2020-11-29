<?php
require_once 'models/usuario.php';

class usuarioController{
	
	public function registro(){ //CARGO LA VISTA DE REGISTRO DE USUARIO

		$listaPaises = Utils::listarPaises();

		

		require_once 'views/usuario/registro.php';
	}
	
	public function save(){ //AQUÍ REALMENTE CREO EL USUARIO Y LO GUARDO
		if(isset($_POST)){
			
			//CHECKEO QUE ME HAN LLEGADO TODOS LOS VALORES
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$password = isset($_POST['password']) ? $_POST['password'] : false;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
			$rol = isset($_POST['rol']) ? $_POST['rol'] : false;
			$imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
			$id_localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
			
			if($nombre && $apellidos && $email && $password && $direccion && $rol && $imagen){
				$usuario = new Usuario();
				$usuario->setNombre($nombre);
				$usuario->setApellidos($apellidos);
				$usuario->setEmail($email);
				$usuario->setPassword($password);
				$usuario->setDireccion($direccion);
				$usuario->setRol($rol);
				$usuario->setImagen($imagen);
				$usuario->setIdLocalidad($id_localidad);

				$save = $usuario->save();
				if($save){ //CREO SESIONES PARA MANTENER LA INFORMACIÓN DEL REGISTRO DURANTE LA SESIÓN
					$_SESSION['register'] = "complete";
				}else{
					$_SESSION['register'] = "failed";
				}
			}else{
				$_SESSION['register'] = "failed";
			}
		}else{
			$_SESSION['register'] = "failed";
		}
		header("Location:".base_url.'usuario/registro');
	}
	
	public function login(){ //ASÍ HAGO EL LOGIN
		if(isset($_POST)){
			// CREO UN USUARIO AL QUE LE PASO EL EMAIL Y LA CONTRASEÑA QUE ME HA LLEGADO POR EL FORMULARIO, Y LLAMO AL MÉTODO LOGIN
			$usuario = new Usuario();
			$usuario->setEmail($_POST['email']);
			$usuario->setPassword($_POST['password']);
			
			$identity = $usuario->login(); //LA IDENTIDAD SERÁ IGUAL AL OBJETO USUARIO QUE DEVUELVE EL MÉTODO LOGIN
			
			if($identity && is_object($identity)){
				$_SESSION['identity'] = $identity; //CREO UNA SESIÓN CON LA IDENTIDAD DEL USUARIO
				
				if($identity->rol == 'administrador'){ //ADEMÁS, SI ES ADMINISTRADOR, CREO UNA SESIÓN DE ADMINISTRADOR
					$_SESSION['admin'] = true;
				}
				
			}else{
				$_SESSION['error_login'] = 'Has introducido mal la contraseña. Prueba de nuevo.'; //EN CASO CONTRARIO, LA IDENTIFICACIÓN ES FALLIDA
			}
		
		}
		header("Location:".base_url);
	}
	
	public function logout(){ //ASÍ HAGO EL LOGOUT

		if(isset($_SESSION['identity'])){ //CIERRO LA SESIÓN
			unset($_SESSION['identity']);
		}
		
		if(isset($_SESSION['admin'])){ //EN CASO DE QUE EL USUARIO TENGA PERMISOS DE ADMINISTRADOR, TAMBIÉN LO CIERRO
			unset($_SESSION['admin']);
		}
		
		
		if(isset($_SESSION['carrito'])){ //UNSETEO EL CARRITO
			unset($_SESSION['carrito']);
		}

		header("Location:".base_url);
	}
	
} 