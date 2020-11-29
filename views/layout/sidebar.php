<!-- BARRA LATERAL -->
<aside id="lateral">

	<div id="carrito" class="block_aside">
		<h3>MI CARRITO</h3>
		<ul>
			<?php $stats = Utils::statsCarrito(); ?>
			<li><a href="<?=base_url?>carrito/index">Productos en el carrito (<?=$stats['count']?>)</a></li>
			<li><a href="<?=base_url?>carrito/index">Coste total: <?=$stats['total']?> €</a></li>
			<li><a href="<?=base_url?>carrito/index">Ver el carrito</a></li>
		</ul>
	</div>
	
	<div id="login" class="block_aside">
		
		<!-- SI EL USUARIO NO HA INICIADO SESIÓN, TE MUESTRO PARA QUE HAGAS EL LOGIN -->
		<?php if(!isset($_SESSION['identity'])): ?>
			<h3>ENTRAR EN LA WEB</h3>
			<form action="<?=base_url?>usuario/login" method="post">
				<label for="email">Email</label>
				<input type="email" name="email" />
				<label for="password">Contraseña</label>
				<input type="password" name="password" />
				<input type="submit" value="Enviar" />
			</form>

			<?php
			if(isset($_SESSION['error_login'])){
				echo "<span class='error'>".$_SESSION['error_login']."</span>";
				unset($_SESSION['error_login']);
			}
			?>

		<?php else: ?>
		<!-- EN CASO DE QUE HAYA INICIADO SESIÓN, TE MUESTRA NOMBRE Y APELLIDOS DEL USUARIO -->
			<h3><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>
		<?php endif; ?>

		<ul>
		<!-- SI EL USUARIO ES ADMINISTRADOR, ADEMÁS TE MUESTRO UN PANEL DE CONTROL DE ADMINISTRADOR -->
			<?php if(isset($_SESSION['admin'])): ?>
				<li><a href="<?=base_url?>categoria/index">Gestión de categorias</a></li>
				<li><a href="<?=base_url?>producto/gestion">Gestión de productos</a></li>
				<li><a href="<?=base_url?>pedido/gestion">Gestión de pedidos</a></li>
			<?php endif; ?>
			
			<!-- SI SE TRATA DE UN USUARIO NORMAL, TE MUESTRO LAS OPCIONES DE USUARIO NORMALES -->
			<?php if(isset($_SESSION['identity'])): ?>
				<li><a href="<?=base_url?>pedido/mis_pedidos"> Consultar mis pedidos</a></li>
				<li><a href="<?=base_url?>usuario/logout">Cerrar sesión</a></li>
			<?php else: ?> 
				<li><a href="<?=base_url?>usuario/registro">Registrate aqui</a></li>
			<?php endif; ?> 
		</ul>
	</div>

</aside>

<!-- CONTENIDO CENTRAL -->
<div id="central">