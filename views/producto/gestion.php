<h1>Gestión de productos</h1>

<!-- PARA CREAR PRODUCTO -->
<a href="<?=base_url?>producto/crear" class="button button-small">
	Crear producto
</a>

<!-- PARA INFORMAR ACERCA DE QUE EL PRODUCTO SE HA CREADO DE FORMA CORRECTA O INCORRECTA -->
<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha creado correctamente</strong>
	<?php unset($_SESSION['producto']); ?>

<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>	
	<strong class="alert_red">El producto NO se ha creado correctamente</strong>
	<?php unset($_SESSION['producto']); ?>	
<?php endif; ?>

<?php if(isset($_SESSION['producto_edit']) && $_SESSION['producto_edit'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha editado correctamente</strong>
	<?php unset($_SESSION['producto_edit']); ?>
<?php elseif(isset($_SESSION['producto_edit']) && $_SESSION['producto_edit'] != 'complete'): ?>	
	<strong class="alert_red">El producto NO se ha editado correctamente</strong>
	<?php unset($_SESSION['producto_edit']); ?>
<?php endif; ?>
<!-- BORRO SESIÓN -->
<?php Utils::deleteSession('producto'); ?> 
	
<!-- PARA INFORMAR SI EL PRODUCTO SE HA BORRADO DE FORMA CORRECTA O INCORRECTA -->
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
	<strong class="alert_green">El producto se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>	
	<strong class="alert_red">El producto NO se ha borrado correctamente</strong>
<?php endif; ?>
<!-- BORRO SESIÓN -->
<?php Utils::deleteSession('delete'); ?>
	
<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>PRECIO</th>
		<th>DESCRIPCIÓN</th>
		<th>STOCK</th>
		<th>OFERTA</th>
		<th>POPULAR</th>
		<th>ACCIONES</th>
	</tr>
	<?php while($pro = $productos->fetch_object()): ?>
		<tr>
			<td><?=$pro->id_producto;?></td>
			<td><?=$pro->nombre;?></td>
			<td><?=$pro->precio;?></td>
			<td><?=$pro->descripcion;?></td>
			<td><?=$pro->stock;?></td>
			<td><?=$pro->oferta;?></td>
			<td><?=$pro->popular;?></td>
			<td>
				<a href="<?=base_url?>producto/editar&id_producto=<?=$pro->id_producto?>" class="button button-gestion">Editar</a>
				<a href="<?=base_url?>producto/eliminar&id_producto=<?=$pro->id_producto?>" class="button button-gestion button-red">Eliminar</a>
			</td>
		</tr>
	<?php endwhile; ?>
</table>
