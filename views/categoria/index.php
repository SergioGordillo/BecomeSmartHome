<h1>Gestionar categorias</h1>

<!-- BOTÓN PARA CREAR CATEGORÍA -->
<a href="<?=base_url?>categoria/crear" class="button button-small">
	Crear categoria
</a>

<table>
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>Descripcion</th>
	</tr>
	<!-- CARGO LAS CATEGORÍAS EN LA VISTA -->
	<?php while($cat = $categorias->fetch_object()): ?>
		<tr>
			<td><?=$cat->id_categoria;?></td>
			<td><?=$cat->nombre;?></td>
			<td><?=$cat->descripcion;?></td>
		</tr>
	<?php endwhile; ?>
</table>
