<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Become Smart Home</title>
		<link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="<?=base_url?>/assets/css/styles.css" />
		
		<script src="<?=base_url?>/assets/js/main.js"></script>
	</head>
	<body>
		<div id="container">
			<!-- CABECERA -->
			<header id="header">
				<div id="logo">
					<!-- <img src="<?=base_url?>uploads/images/header.png" alt="Header Become Smart Home"/> -->
					<a href="<?=base_url?>">
						Become Smart Home
					</a>
				</div>
			</header>

			<!-- MENU -->
			<!-- MUESTRO TODAS LAS CATEGORÍAS EN EL HEADER -->
			<?php $categorias = Utils::showCategorias(); ?>
			<nav id="menu">
				<ul>
					<li>
						<a href="<?=base_url?>">INICIO</a>
					</li>
					<li>
						<a href="<?=base_url?>categoria/ver_ofertas">OFERTA</a>
					</li>
					<li>
						<a href="<?=base_url?>categoria/ver_populares">POPULAR</a>
					</li>
					<?php while($cat = $categorias->fetch_object()): ?>
						<li>
							<a href="<?=base_url?>categoria/ver&id_categoria=<?=$cat->id_categoria?>"><?=$cat->nombre?></a>
						</li>
					
					<?php endwhile; ?>

						<li>
						<form action="<?=base_url?>producto/buscar" method="POST">
							<div class="search-block">
								<input type="text" class="form-control" name="search">
								<div class="input-group-append">
									<button class="btn btn-icon btn-outline-secondary" type="submit">
										Buscar
									</button>
								</div>
							</div>
						</form>
						</li>
				</ul>


		


			</nav>

			<div id="content">