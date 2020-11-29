<!-- EN ESTA PANTALLA MUESTRO LOS DETALLES DE UN PRODUCTO. EN CASO DE QUE NO ESTÉ SETEADO EL PRODUCTO TAMBIÉN INFORMO AL USUARIO DE ELLO -->

<?php if (isset($product)): ?>
	<h1><?= $product->nombre ?></h1>
	<div id="detail-product">
		<div class="image">
			<?php if ($product->imagen != null): ?>
				<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" alt="<?php echo $product->nombre ?>>" />
			<?php else: ?>
				<img src="<?= base_url ?>uploads/images/image-not-found.png" alt="Imagen no encontrada"/>
			<?php endif; ?>
		</div>
		<div class="data">
			<p class="description"><?= $product->descripcion ?></p>
			<p class="price"><?= $product->precio ?> €</p>
			
		
			<a href="<?=base_url?>carrito/add&id_producto=<?=$product->id_producto?>" class="button">Comprar</a>
		</div>
	</div>
<?php else: ?>
	<h1>El producto no existe</h1>
<?php endif; ?>
