<?php

namespace Juegos\Modelos;

use Juegos\Database\DBConexion;
use PDO;

class Producto
{
    protected int $id;
    protected int $usuario_fk;
    protected int $categoria_fk;
    protected string $titulo;
    protected string $precio;
    protected string $descripcion;
    protected ?string $imagen;

    public function data(): array
    {

        $db = DBConexion::getConexion();
        $query = "SELECT p.*, c.nombre AS 'categoria' FROM productos p
                INNER JOIN categorias c
                ON p.categoria_fk = c.categoria_id";
        $statement = $db->prepare($query); 
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, self::class);
        return $statement->fetchAll();

    }

    /**
     * Detalle del producto
     */
    public function productoPorId(int $id): ?Producto
    {
        $db = DBConexion::getConexion();
        $query = "SELECT * FROM productos
                WHERE producto_id = ?";
        $statement = $db->prepare($query); 
        $statement->execute([$id]);
        $statement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $producto = $statement->fetch();

        return $producto ? $producto : null;
    }

    /**
     * Crea un producto en la base de datos.
     */
    public function crear(array $data): void
    {
        $db = DBConexion::getConexion();
        $db->beginTransaction();

        try{
            $query = "INSERT INTO productos (usuario_fk, categoria_fk, titulo, precio, descripcion, imagen)
                    VALUES (:usuario_fk, :categoria_fk, :titulo, :precio, :descripcion, :imagen)";
            $stmt = $db->prepare($query);
            $stmt->execute([
                'usuario_fk'                => $data['usuario_fk'],
                'categoria_fk'              => $data['categoria_fk'],
                'titulo'                    => $data['titulo'],
                'precio'                    => $data['precio'],
                'descripcion'                   => $data['descripcion'],
                'imagen'                    => $data['imagen'],

            ]);

            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    }

      /**
    * Editar producto en el panel
    */
    public function editar(int $id, array $data): void
    {
        
        $db = DBConexion::getConexion();
        $db->beginTransaction();

        try{
        $query = "UPDATE productos
                SET usuario_fk      = :usuario_fk,
                    categoria_fk    = :categoria_fk,
                    titulo          = :titulo,
                    precio          = :precio,
                    descripcion         = :descripcion,
                    imagen          = :imagen
                WHERE producto_id = :producto_id";
        $stmt = $db->prepare($query);
        $stmt->execute([
            'producto_id'           => $id,
            'usuario_fk'            => $data['usuario_fk'],
            'categoria_fk'          => $data['categoria_fk'],
            'titulo'                => $data['titulo'],
            'precio'                => $data['precio'],
            'descripcion'               => $data['descripcion'],
            'imagen'                => $data['imagen'],
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
            $query = "DELETE FROM productos
            WHERE producto_id = ?";
            $stmt = $db->prepare($query);
            $stmt->execute([$this->getId()]);
            
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }
    } 


    /*
    Setters & Getters
    */

    public function setCategoria(int $categoria_fk)
    {
        $this->$categoria_fk = $categoria_fk;
    }

    public function getCategoria(): int
    {
        return $this->categoria_fk;
    }

    public function getNombreCategoria(): string
    {
        return $this->categoria;
    }

    public function setId(int $producto_id): void
    {
        $this->producto_id = $producto_id;
    }

    public function getId(): int
    {
        return $this->producto_id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }
 
    public function getdescripcion()
    {
        return $this->descripcion;
    }

    public function setdescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
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