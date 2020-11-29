<!-- EN ESTA VISTA CONSULTO TODOS LOS DETALLES DEL PEDIDO -->

<h1>Detalle del pedido</h1>
<!-- SI EL PEDIDO ESTÁ SETEADO Y ADEMÁS EL USUARIO ES ADMIN SE PUEDE CAMBIAR EL ESTADO DEL PEDIDO -->
<?php if (isset($pedido)): ?>
		<?php if(isset($_SESSION['admin'])): ?>
			<h3>Cambiar estado del pedido</h3>
			<form action="<?=base_url?>pedido/estado" method="POST">
				<input type="hidden" value="<?=$pedido->id_pedido?>" name="id_pedido"/>
				<select name="estado">
					<option value="confirm" <?=$pedido->estado == "confirm" ? 'selected' : '';?>>Pendiente</option>
					<option value="preparation" <?=$pedido->estado == "preparation" ? 'selected' : '';?>>En preparación</option>
					<option value="ready" <?=$pedido->estado == "ready" ? 'selected' : '';?>>Preparado para enviar</option>
					<option value="sent" <?=$pedido->estado == "sent" ? 'selected' : '';?>>Enviado</option>
				</select>
				<input type="submit" value="Cambiar estado" />
			</form>
			<br/>
		<?php endif; ?>

		<h3>Dirección de envio</h3>
		Direccion: <?= $pedido->direccion ?>   <br/>
		Localidad: <?= Utils::getLocalidad($pedido->id_localidad) ?> <br/>
		Provincia: <?= Utils::getProvincia($pedido->id_localidad) ?>   <br/> </br>
	
	

		<h3>Datos del pedido:</h3>
		Estado: <?=Utils::showStatus($pedido->estado)?> <br/>
		Número de pedido: <?= $pedido->id_pedido ?>   <br/>
		Total a pagar: <?= $pedido->coste ?> € <br/>
		Productos:

		<table>
			<tr>
				<th>Imagen</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Unidades</th>
			</tr>
			<?php while ($producto = $productos->fetch_object()): ?>
				<tr>
					<td>
						<?php if ($producto->imagen != null): ?>
							<img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img_carrito" />
						<?php else: ?>
							<img src="<?= base_url ?>uploads/images/image-not-found.png"  alt="Imagen no encontrada" class="img_carrito" />
						<?php endif; ?>
					</td>
					<td>
						<a href="<?= base_url ?>producto/ver&id_producto=<?= $producto->id_producto ?>"><?= $producto->nombre ?></a>
					</td>
					<td>
						<?= $producto->precio ?>
					</td>
					<td>
						<?= $producto->unidades ?>
					</td>
				</tr>
			<?php endwhile; ?>
		</table>

	<?php endif; ?>