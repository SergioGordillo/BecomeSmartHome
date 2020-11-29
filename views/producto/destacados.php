<!-- MUESTRO ALGUNOS DE LOS PRODUCTOS -->

<h1>Algunos de nuestros productos</h1>

<?php while($product = $productos->fetch_object()): ?>
	<div class="product">
		<a href="<?=base_url?>producto/ver&id_producto=<?=$product->id_producto?>">
			<?php if($product->imagen != null): ?>
				<img src="<?=base_url?>uploads/images/<?=$product->imagen?>" alt="<?php echo $product->nombre ?>" />
			<?php else: ?>
				<img src="<?=base_url?>uploads/images/image-not-found.png"  alt="Imagen no encontrada" />
			<?php endif; ?>
			<h2><?=$product->nombre?></h2>
		</a>
		<p><?=$product->precio?> €</p>
		<div class="bottom-price">
			<a href="<?=base_url?>carrito/add&id_producto=<?=$product->id_producto?>" class="button">Comprar</a>
		</div>
	</div>
<?php endwhile; ?>
