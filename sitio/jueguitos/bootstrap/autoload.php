<?php
require_once __DIR__ . '/../vendor/autoload.php';

	session_start();

	spl_autoload_register(function ($className) {
	
	$className = substr($className, 7);

	$archivo = __DIR__ . "/../classes/" . $className . ".php";

	$archivo = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $archivo);

	if(file_exists($archivo)) {
		require_once $archivo;
	}
    
});