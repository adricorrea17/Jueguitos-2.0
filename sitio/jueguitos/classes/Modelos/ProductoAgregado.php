<?php

namespace Juegos\Modelos;

use Juegos\Database\DBConexion;
use PDO;

class ProductoAgregado extends Modelo
{
    
    protected int $producto_agregado_id;
    protected int $carrito_fk;
    protected int $producto_fk;
    protected string $nombre;
    protected int $cantidad;
    protected int $subtotal;
    protected string $imagen;

    protected string $table = 'producto_agregado';
	protected string $primaryKey = "producto_agregado_id";

	protected array $properties = ['producto_agregado_id', 'carrito_fk', 'producto_fk', 'nombre', 'cantidad', 'subtotal'];


    public function data(): array
    {

        $db = DBConexion::getConexion();
        $query = "SELECT producto_agregado.*, productos.imagen AS 'imagen' FROM producto_agregado INNER JOIN productos 
        ON producto_agregado.producto_fk = productos.producto_id";
        $statement = $db->prepare($query); 
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $statement->fetchAll();

    }

      /**
    * Agrega productos a la lista de compras.
    */
    public function AddLista(array $data): void
    {
        $db = DBConexion::getConexion();
        $db->beginTransaction();

        try{
            $query = "INSERT INTO producto_agregado (carrito_fk, producto_fk, nombre ,cantidad, subtotal)
                    VALUES (:carrito_fk, :producto_fk, :nombre, :cantidad, :subtotal)";
            $stmt = $db->prepare($query);
            $stmt->execute([
                'carrito_fk' => $data['carrito_fk'],
                'producto_fk' => $data['producto_fk'],
                'nombre' => $data['nombre'],
                'cantidad' => $data['cantidad'],
                'subtotal' => $data['subtotal'],
            ]);
            
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }


  /**
    * Modifica la cantidad de unidades de un producto.
    */    
    public function sumarProducto(int $id, array $data): void
        {
            $db = DBConexion::getConexion();
            $db->beginTransaction();

            try{
                $query = "UPDATE producto_agregado
                            SET cantidad = :cantidad,
                            subtotal = :subtotal
                            WHERE producto_agregado_id = :producto_agregado_id";

                $stmt = $db->prepare($query);
                $stmt->execute([
                    'producto_agregado_id'  => $id,
                    'cantidad'              => $data['cantidad'],
                    'subtotal'              => $data['subtotal'],
                ]);

                $db->commit();
            } catch (Exception $e) {
                $db->rollBack();
                throw $e;
            }
        }
    
    /**
    * Eliminar producto.
    */
    public function eliminar(): void
    {
        $db = DBConexion::getConexion();
        $db->beginTransaction();

        try{
            $query = "DELETE FROM producto_agregado
            WHERE producto_agregado_id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$this->getProductoAgregadoId()]);

            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    } 

    /**
    * Eliminar productos agregados en carrito.
    */
    public function vaciarProductosAgregados($id): void
    {
        $db = DBConexion::getConexion();
        $query = "DELETE FROM producto_agregado
        WHERE carrito_fk = :carrito_fk";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'carrito_fk' => $id,
            ]);
    }

      /**
    * Crea un string de productos y unidades del carrito.
    */
    public function listaProductos($productos, $autenticacion): string
    {
        $array = [];
        foreach($productos as $producto):
            if($producto->getCarritoFk() == $autenticacion):
            $productoCantidad = $producto->getCantidad() . "x " . $producto->getNombre();
            array_push($array, $productoCantidad);
            endif;
        endforeach;
        $stringArray = implode(' | ',$array);

        return  $stringArray;
    }

      /**
    * Getters y Setters
    */

    public function getProductoAgregadoId()
    {
        return $this->producto_agregado_id;
    }

    public function setProductoAgregadoId($producto_agregado_id)
    {
        $this->producto_agregado_id = $producto_agregado_id;

        return $this;
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

    public function getProductoFk()
    {
        return $this->producto_fk;
    }

    public function setProductoFk($producto_fk)
    {
        $this->producto_fk = $producto_fk;

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

    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

}