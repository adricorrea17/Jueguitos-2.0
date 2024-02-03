<?php

namespace Juegos\Validaciones;

class ValidarProducto
{
	protected array $datos = [];

	protected array $errores = [];

	public function __construct(array $datos) 
	{
		$this->datos = $datos;
		$this->validar();
	}

	public function erroresEncontrados(): bool
	{
		return count($this->errores) > 0;
	}

	public function obtenerError(): array
	{
		return $this->errores;
	}

	protected function validar(): void
	{
		// Título
		if(empty($this->datos['titulo'])) {
			$this->errores['titulo'] = "Tenés que escribir el nombre del producto.";
		} else if(strlen($this->datos['titulo']) < 3) {
			$this->errores['titulo'] = "Tenés que escribir al menos 3 caracteres para el nombre del producto.";
		}

		// Precio
		if(empty($this->datos['precio'])) {
			$this->errores['precio'] = "Tenés que escribir el precio del producto.";
		} else if (is_nan($this->datos['precio']) == true){
            $this->errores['precio'] = "El precio tiene que ser un número";
        }

		// descripcion
		if(empty($this->datos['descripcion'])) {
			$this->errores['descripcion'] = "Tenés que escribir la capacidad de la batería.";
		}

	}
}