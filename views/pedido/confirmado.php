<!-- SI EL PEDIDO SE HA CONFIRMADO, INFORMO AL USUARIO DE QUE HA DE PAGAR EL PEDIDO Y DE LOS PRODUCTOS, PRECIO ETC. QUE LLEVA EN SU PEDIDO. EN CASO CONTRARIO, SE INFORMA DE QUE EL PEDIDO NO HA PODIDO SER PROCESADO. -->

<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
	<h1>Tu pedido se ha confirmado</h1>
	<p>
		Hemos guardado tu pedido con éxito. Realiza la transferencia a la cuenta bancaria 2991 0056 11 6111238752
		con el coste del pedido y una vez que el pago haya sido hecho, procederemos a procesar y enviar tu pedido.
		Muchas gracias por confiar en Become Smart Home para tus compras.
	</p>
	<br/>
	<?php if (isset($pedido)): ?>
		<h3>Datos del pedido:</h3>

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

	<?php	
		if(isset($_SESSION['carrito'])){ //UNSETEO EL CARRITO
			unset($_SESSION['carrito']);
		}

	?>

	<?php endif; ?>

<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>
	<h1>Tu pedido NO ha podido procesarse</h1>
<?php endif; ?>
