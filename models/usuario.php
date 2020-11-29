<?php

class Usuario{
    private $id_usuario;
	private $email;
	private $password;
    private $nombre;
    private $apellidos;
	private $direccion;
	private $id_localidad;
	private $rol;
	private $imagen;
	
	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getIdUsuario() {
		return $this->id_usuario;
	}

	function getEmail() {
		return $this->email;
	}

	function getPassword() {
		return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
	}

	function getNombre() {
		return $this->nombre;
	}

	function getApellidos() {
		return $this->apellidos;
	}

	function getDireccion() {
		return $this->direccion;
	}

	function getIdLocalidad() {
		return $this->id_localidad;
	}

	function getRol() {
		return $this->rol;
	}

	function getImagen() {
		return $this->imagen;
	}

	function setIdUsuario($id_usuario) {
		$this->id_usuario = $this->db->$id_usuario;
	}

	function setEmail($email) {
		$this->email = $this->db->real_escape_string($email);
	}

	function setPassword($password) {
		$this->password = $password;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setApellidos($apellidos) {
		$this->apellidos = $this->db->real_escape_string($apellidos);
	}

	function setDireccion($direccion) {
		$this->direccion = $this->db->real_escape_string($direccion);
	}

	function setIdLocalidad($id_localidad) {
		$this->id_localidad = $id_localidad;
    }

	function setRol($rol) { 
		$this->rol = $rol;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	public function save(){ //ME PERMITE CREAR USUARIOS
		$sql = "INSERT INTO usuario VALUES(NULL, '{$this->getEmail()}', '{$this->getPassword()}', '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getDireccion()}', '{$this->getIdLocalidad()}', '{$this->getRol()}', '{$this->getImagen()}');";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}

	
	public function login(){ //ME PERMITE HACER EL LOGIN DE LOS USUARIOS
		$result = false;
		$email = $this->email;
		$password = $this->password;
		
		// CONSULTA PARA COMPROBAR SI EL USUARIO EXISTE
		$sql = "SELECT * FROM usuario WHERE email = '$email'";
		$login = $this->db->query($sql);
		

 
		
		if($login && $login->num_rows == 1){
			$usuario = $login->fetch_object();
			
			// $fichero = fopen("datos.txt", "w");
			// fputs($fichero, password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]));
			// fputs($fichero, $usuario->password);
			// fclose($fichero);
	
			// if(password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]) == $usuario->password){
			// 	$result = $usuario;
			// }
			// // COMPRUEBO QUE LA CONTRASEÑA QUE ME LLEGA POR EL FORMULARIO COINCIDE CON LA QUE TENGO GUARDADA DEL USUARIO
			$verify = password_verify($password, $usuario->password);
			
			if($verify){
				$result = $usuario;
			}
		}
		

		return $result; //DEVUELVE EL OBJETO USUARIO CON SUS DATOS ASOCIADOS
	}
	
	
	
}