<?php

namespace Juegos\Database;

use PDO;
use Exception;

/**
 * Wrapper para PDO en modo Singleton.
 */
class DBConexion
{

	public const DB_HOST = '127.0.0.1';
	public const DB_USER = 'root';
	public const DB_PASS = '';
	public const DB_BASE = 'dw3_correa_adrian';
	public const DB_DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . 
	self::DB_BASE . ';charset=utf8mb4';
	protected static ?PDO $db = null;

	public static function conectar(){
		try {

			self::$db = new PDO(self::DB_DSN, self::DB_USER, self::DB_PASS);
			self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		} catch (Exception $e) {
			echo "Error al conectar con MySQL<br>";
			echo "Error: " . $e->getMessage();
			exit;
		}
	}

	public static function getConexion(): PDO
	{
		if(self::$db === null){
			self::conectar();
		}
		return self::$db;
	}

}