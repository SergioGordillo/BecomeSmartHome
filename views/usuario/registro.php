<h1>Registrarse</h1>

<!-- DEVUELVO INFORMACIÓN SOBRE SI EL REGISTRO DEL USUARIO SE HA REALIZADO DE FORMA CORRECTA O NO -->
<?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
	<strong class="alert_green">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
	<strong class="alert_red">Registro fallido, introduce bien los datos</strong>
<?php endif; ?>
<!-- BORRO LA SESIÓN -->
<?php Utils::deleteSession('register'); ?> 

<form action="<?=base_url?>usuario/save" method="POST">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" required/>
	
	<label for="apellidos">Apellidos</label>
	<input type="text" name="apellidos" required/>
	
	<label for="email">Email</label>
	<input type="email" name="email" required/>
	
	<label for="password">Contraseña</label>
	<input type="password" name="password" required/>

	<label for="direccion">Direccion</label>
    <input type="text" name="direccion" required/>

    <select id="Pais" name="pais">
		<?php
			foreach ($listaPaises as $key => $pais) {
				?>
				<option value="<?php echo $pais['id_pais']; ?>"><?php echo $pais['nombre']; ?></option>	
				<?php
			}

		?>
    </select>

	<select id="Provincia" name="provincia">
    </select>

	<select id="Localidad" name="localidad">
    </select>

        
    <select name="rol">
            <option value="administrador"> Administrador </option> 
            <option value="usuario" selected> Usuario </option>
    </select>

    <label for="imagen">Imagen de perfil</label>
    <input type="file" name="imagen">
	
	<input type="submit" value="Registrarse" />
</form>