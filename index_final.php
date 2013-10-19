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
	$listaRegistro_comp = lista_completa($mysqli);

	// Lista de registro con paginación

	// verificamos si existe una pagina seleccionada
	$pagina 			= 1;
	$porPagina			= 10;

	if(isset($_GET['pag']) && !empty($_GET['pag']))
		$pagina = $_GET['pag'];

	$lista_paginada = paginar_registro($mysqli, $porPagina, $pagina);

	// verificamos que no sea la última pagina
	if($lista_paginada['noPaginas'] < $pagina ){
		$pagina = $lista_paginada['noPaginas'];
		$lista_paginada = paginar_registro($mysqli, $porPagina, $pagina);
	}

	$paginaInicial		= $pagina;
	$paginaFinal		= $pagina + 5;

	// Calculamos pagina siguiente y anterior
	$paginaSiguiente 	= $pagina +1;
    $paginaAnterior		= $pagina -1;

	// Cargamos la plantilla
	$twig->display('index.html',array(
		"titulo"    		=> "Paginación con php, twig y mysql",
		"piePagina" 		=> "<p>cazaresluis.com | &copy; 2013 </p>",
		"lista_completa"	=> $listaRegistro_comp,
		"paginas"			=> $lista_paginada['paginasNo'],
		"lista_paginada"	=> $lista_paginada['listaRegistro'],
		"pagina_siguiente"	=> $paginaSiguiente,
		"pagina_anterior"	=> $paginaAnterior,
		"pagina_inicial"	=> $paginaInicial,
		"pagina_final"		=> $paginaFinal,
		"pagina_actual"		=> $pagina,
		"ultima_pagina"		=> $lista_paginada['noPaginas']
	));
}
	

?>