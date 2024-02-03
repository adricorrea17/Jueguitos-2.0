<?php
namespace Juegos\Modelos;

use Juegos\Database\DBConexion;
use PDO;
use PDOException;

class Modelo
{
    protected string $table = "";
    protected string $primaryKey = "";

    protected array $properties = [];
    
    public function loadProperties(array $data)
    {
        foreach($data as $key => $value) {
            if(in_array($key, $this->properties)) {
                $this->{$key} = $value;
            }
        }
    }


      /**
    * Devuelve tabla completa.
    */    
    public function todo(): array
	{
		$db = DBConexion::getConexion();
		$query = "SELECT * FROM {$this->table}";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
		
		return $stmt->fetchAll();
	}

    /** 
    *Busca en la tabla por Id.
    */

    public function obtenerPorId(int $id): ?static
	{
		$db = DBConexion::getConexion();
		$query = "SELECT * FROM {$this->table}
					WHERE {$this->primaryKey} = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, static::class);
		$obj = $stmt->fetch();

		return $obj ? $obj : null;
	}

}