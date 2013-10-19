<?php
session_name('paginacion_php');
session_start();

// Directorio Raíz de la app
// Es utilizado en templateEngine.inc.php
$root = '';

// números de captcha
$_SESSION['inicia_paginacion'] = true;

if(!empty($_SESSION)){
	// Incluimos el template engine
	include('includes/templateEngine.inc.php');

	// Incluimos las funciones
	include('includes/functions.inc.php');

	// Lista de Registro Completa
	// $listaRegistro_comp = lista_completa($mysqli);

	// Inicializamos variables de paginación
	$pagina 	= 1;
	$porPagina 	= 20;

	// validamos la número de página
	if(isset($_GET['pag']) && !empty($_GET['pag']))
		$pagina = $_GET['pag'];

	// llamar función para realizar la recopilación de datos y números de página
	$lista_paginada = paginar_registro($mysqli, $porPagina, $pagina);

	// verificamos que no sea la última pagina
	if($lista_paginada['noPaginas'] < $pagina ){
		$pagina = $lista_paginada['noPaginas'];
		$lista_paginada = paginar_registro($mysqli, $porPagina, $pagina);
	}

	// creamos variables que contengan la página siguiente y página anterior
	// Calculamos pagina siguiente y anterior
	$paginaSiguiente 	= $pagina +1;
    $paginaAnterior		= $pagina -1;

	// Cargamos la plantilla
	$twig->display('index.html',array(
		"titulo"    		=> "Paginación con php, twig y mysql",
		"piePagina" 		=> "<p>cazaresluis.com | &copy; 2013 </p>",
		"paginas"			=> $lista_paginada['paginasNo'],
		"lista_paginada"	=> $lista_paginada['listaRegistro'],
		"pagina_siguiente"	=> $paginaSiguiente,
		"pagina_anterior"	=> $paginaAnterior,
		"ultima_pagina"		=> $lista_paginada['noPaginas'],
		"pagina_actual"		=> $pagina
	));
}
	

?>