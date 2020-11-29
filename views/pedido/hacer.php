<!-- EL USUARIO PUEDE CONSULTAR LOS PRODUCTOS Y EL PRECIO DEL PEDIDO, ADEMÁS DE INDICAR SU DIRECCIÓN. -->

<?php if (isset($_SESSION['identity'])): ?>
	<h1>Hacer pedido</h1>
	<p>
		<a href="<?= base_url ?>carrito/index">Ver los productos y el precio del pedido</a>
	</p>
	<br/>
	
	<h3>Dirección para el envio:</h3>
	<form action="<?=base_url.'pedido/add'?>" method="POST">

		<label for="agencia_transporte">Agencia de transporte</label>
		<select name="agencia_transporte" id="agencia_transporte">
			<option value="seur">SEUR</option>
			<option value="seur">MRW</option>
			<option value="seur">CORREOS</option>
		</select>

		<label for="direccion">Dirección</label>
		<input type="text" name="direccion" required />

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

		<input type="submit" value="Confirmar pedido" />
	</form>
		
<!-- EN CASO DE QUE NECESITE ESTAR IDENTIFICADO O LOGUEADO, SE INDICA -->
<?php else: ?>
	<h1>Necesitas estar identificado</h1>
	<p>Necesitas estar logueado en la web para poder realizar tu pedido.</p>
<?php endif; ?>


