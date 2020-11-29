
<!-- SI ESTÁ SETEADO EDITAR INFORMO DE QUE SE VA A EDITAR UN PRODUCTO -->
<?php if(isset($edit) && isset($pro) && is_object($pro)): ?>
	<h1>Editar producto <?=$pro->nombre?></h1>
	<?php $url_action = base_url."producto/save&id_producto=".$pro->id_producto; ?>
	
<!-- SI NO ESTÁ SETEADO, INFORMO DE QUE VAMOS A CREAR UN PRODUCTO -->
<?php else: ?>
	<h1>Crear nuevo producto</h1>
	<?php $url_action = base_url."producto/save"; ?>
<?php endif; ?>
	
<div class="form_container">
	
	<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" value="<?=isset($pro) && is_object($pro) ? $pro->nombre : ''; ?>"/>

		<label for="descripcion">Descripción</label>
		<textarea name="descripcion"><?=isset($pro) && is_object($pro) ? $pro->descripcion : ''; ?></textarea>

		<label for="imagen">Imagen</label>
		<?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)): ?>
			<img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" class="thumb"/> 
		<?php endif; ?>
		<input type="file" name="imagen" />

		<label for="precio">Precio</label>
		<input type="text" name="precio" value="<?=isset($pro) && is_object($pro) ? $pro->precio : ''; ?>"/>

		<select name="oferta">
            <option value="1"> En oferta </option> 
            <option value="0" selected> Precio Normal </option>
    	</select>

		<label for="stock">Stock</label>
		<input type="number" name="stock" value="<?=isset($pro) && is_object($pro) ? $pro->stock : ''; ?>"/>

		<select name="popular">
            <option value="1"> Es de lo más vendido </option> 
            <option value="0" selected> Producto vendido dentro de la media </option>
    	</select>

		<label for="categoria">Categoria</label>
		<?php $categorias = Utils::showCategorias(); ?>
		<select name="categoria">
			<?php while ($cat = $categorias->fetch_object()): ?>
				<option value="<?= $cat->id_categoria ?>" <?=isset($pro) && is_object($pro) && $cat->id_categoria == $pro->id_categoria ? 'selected' : ''; ?>>
					<?= $cat->nombre ?>
				</option>
			<?php endwhile; ?>
		</select>
		

		
		<br/>


		<input type="submit" value="Guardar" />
	</form>
</div>