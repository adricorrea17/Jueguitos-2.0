<?php

namespace Juegos\Modelos;

use Juegos\Database\DBConexion;
use PDO;

class Compras extends Modelo
{
    protected int $compras_id;
    protected int $carrito_fk;
    protected int $usuario_fk;
    protected string $fecha;
    protected string $cantidad;
    protected string $total;
    protected string $productos;

    protected string $usuario;

    protected string $table = "compras";
    protected string $primaryKey = "compras_id";

    protected array $properties = ['compras_id', 'carrito_fk', 'usuario_fk', 'fecha', 'cantidad', 'total', 'productos'];

    public function data(): array
    {

        $db = DBConexion::getConexion();
        $query = "SELECT 
        compras.*, 
        GROUP_CONCAT(usuarios.nombre, ' ', usuarios.apellido ) AS 'usuario'
        FROM compras 
        INNER JOIN usuarios
        ON compras.usuario_fk = usuarios.usuario_id
        GROUP BY compras.compras_id";
        $statement = $db->prepare($query); 
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $statement->fetchAll();

    }


      /**
    * Guarda la compra realizada.
    */
    public function AddCompras(array $data): void
    {
        $db = DBConexion::getConexion();
        $db->beginTransaction();
        try{
            $query = "INSERT INTO compras (carrito_fk, usuario_fk, fecha, cantidad, total, productos)
            VALUES (:carrito_fk, :usuario_fk, :fecha, :cantidad, :total, :productos)";
            $stmt = $db->prepare($query);
            $stmt->execute([
                'carrito_fk'    => $data['carrito_fk'],
                'usuario_fk'    => $data['usuario_fk'],
                'fecha'         => $data['fecha'],
                'cantidad'      => $data['cantidad'],
                'total'         => $data['total'],
                'productos'     => $data['productos'],
            ]);
            
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }

  /**
    * Busca la compra por usuario.
    */
    public function obtenerPorComprador(int $id): array
	{
		$db = DBConexion::getConexion();
		$query = "SELECT  * FROM Compras
					WHERE carrito_fk = ?";
		$stmt = $db->prepare($query);
		$stmt->execute([$id]);
		$stmt->setFetchMode(PDO::FETCH_CLASS, static::class);

		return $stmt->fetchAll();
	}

  /**
    * Setters y Getters.
    */
    public function getCompraId()
    {
        return $this->compras_id;
    }

    public function getCarritoFk()
    {
        return $this->carrito_fk;
    }

    public function setCarritoFk($carrito_fk)
    {
        $this->carrito_fk = $carrito_fk;

        return $this;
    }

    public function getUsuarioFk()
    {
        return $this->usuario_fk;
    }

    public function setUsuarioFk($usuario_fk)
    {
        $this->usuario_fk = $usuario_fk;

        return $this;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    public function getProductos()
    {
        $items = explode (" | ", $this->productos);
        return $items;
    }

    public function setProductos($productos)
    {
        $this->productos = $productos;

        return $this;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }
}