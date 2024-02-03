<?php

namespace Juegos\Modelos;

use Juegos\Database\DBConexion;
use PDO;

class Carrito extends Modelo
{
    protected int $carrito_id;
    protected int $usuario_fk;

    protected int $cantidad;
    protected int $total;

    protected string $table = "carrito";
    protected string $primaryKey = "carrito_id";

    protected array $properties = ['carrito_id', 'usuario_fk'];

    public function data(): array
    {
        $db = DBConexion::getConexion();
        $query = "SELECT
            carrito.*,
            SUM(cantidad) AS 'cantidad',
            SUM(subtotal) AS 'total'
            FROM carrito
            INNER JOIN producto_agregado pa ON pa.carrito_fk = carrito.carrito_id
            INNER JOIN productos p ON pa.producto_fk = p.producto_id
            GROUP BY carrito.carrito_id;";
        $statement = $db->prepare($query); 
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $statement->fetchAll();
    }

    /**
    * Crea un carrito para un usuario.
    */
    public function crearCarrito(array $data): void
    {
        $db = DBConexion::getConexion();
        $db->beginTransaction();

        try{
            $query = "INSERT INTO carrito (carrito_id, usuario_fk)
            VALUES (:carrito_id, :usuario_fk)";
            $stmt = $db->prepare($query);
            $stmt->execute([
                'carrito_id'    => $data['carrito_id'],
                'usuario_fk'    => $data['usuario_fk'],
            ]);

            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    } 

    /**
    * Setters y Getters.
    */

    public function getCarritoId()
    {
        return $this->carrito_id;
    }

    public function setCarritoId($carrito_id)
    {
        $this->carrito_id = $carrito_id;

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
}
