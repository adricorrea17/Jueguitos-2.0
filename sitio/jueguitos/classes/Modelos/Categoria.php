<?php

namespace Juegos\Modelos;

use Juegos\Database\DBConexion;
use PDO;

class Categoria extends Modelo
{
    protected int $categoria_id;
    protected string $nombre;

	protected string $table = "categorias";
	protected string $primaryKey = "categoria_id";

	protected array $properties = ['categoria_id', 'nombre'];

	

    // Setters & Getters
   
    public function getId(): int
	{
		return $this->categoria_id;
	}

    public function getNombre(): string
	{
		return $this->nombre;
	}
}

