<?php

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * 
 * @package: paginacion_twig_php_mysql/includes/
 * @author: Luis Fernando Cázares <luis.f.cazares@gmail.com>
 * @version Id: actions.inc.php 2013-10-16 00:00 _CazaresLuis_ ;
 * 
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */

if(isset($_POST) && !empty($_POST['action']) && !empty($_POST['id_estado'])){

	// Incluimos las funciones y la conexión a la base de datos
	include('functions.inc.php');

}

?>